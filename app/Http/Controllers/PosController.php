<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Transaction;
use App\Models\TransactionItem;
use App\Services\WhatsAppService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class PosController extends Controller
{
    /**
     * Tampilkan halaman POS/Kasir
     */
    public function index(Request $request)
    {
        $query = Product::with('category')->where('stock', '>', 0);
        
        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }
        
        if ($request->filled('q')) {
            $search = $request->q;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('sku', 'like', "%{$search}%");
            });
        }
        
        $products = $query->orderBy('id')->paginate(20)->withQueryString();
        $categories = Category::orderBy('name')->get();
        
        return view('pos.index', compact('products', 'categories'));
    }

    /**
     * Process Checkout - Simple Form POST
     */
    public function checkout(Request $request)
    {
        try {
            // Validate cart data from form
            $validated = $request->validate([
                'cart_items' => 'required|string', // JSON string of cart items
                'payment_method' => 'required|in:cash,qris,debit,ewallet',
                'sub_payment' => 'nullable|string|max:50',
                'total_amount' => 'required|numeric|min:0'
            ]);

            // Decode cart items
            $cartItems = json_decode($validated['cart_items'], true);
            
            if (!is_array($cartItems) || empty($cartItems)) {
                return back()->with('error', 'Keranjang belanja kosong.');
            }

            $total = 0;
            $itemsToSave = [];
            $notifiedIds = [];

            // Validate & prepare items
            foreach ($cartItems as $item) {
                $product = Product::find($item['product_id'] ?? $item['id'] ?? null);
                
                if (!$product) {
                    return back()->with('error', "Produk tidak ditemukan.");
                }
                
                $qty = $item['qty'] ?? 1;
                $price = $item['price'] ?? $product->price;
                
                if ($product->stock < $qty) {
                    return back()->with('error', "Stok {$product->name} tidak cukup (Sisa: {$product->stock}).");
                }

                $subtotal = $price * $qty;
                $total += $subtotal;
                
                $itemsToSave[] = [
                    'product_id' => $product->id,
                    'qty' => (int) $qty,
                    'price' => $price,
                    'cost_price' => $product->cost_price ?? 0,
                    'subtotal' => $subtotal,
                    'profit' => ($price - ($product->cost_price ?? 0)) * $qty,
                ];
            }

            // Verify total matches
            if (abs($validated['total_amount'] - $total) > 0.01) {
                return back()->with('error', 'Total pembayaran tidak valid.');
            }

            // Process transaction
            DB::beginTransaction();
            
            try {
                $transaction = Transaction::create([
                    'invoice_code' => $this->generateInvoiceCode(),
                    'user_id' => Auth::id(),
                    'total_amount' => $total,
                    'payment_amount' => $total,
                    'change_amount' => 0,
                    'payment_method' => $validated['payment_method'],
                    'payment_detail' => $validated['sub_payment'] ?? null,
                    'payment_status' => 'paid',
                ]);

                foreach ($itemsToSave as $item) {
                    TransactionItem::create([
                        'transaction_id' => $transaction->id,
                        'product_id' => $item['product_id'],
                        'qty' => $item['qty'],
                        'price' => $item['price'],
                        'cost_price' => $item['cost_price'],
                        'subtotal' => $item['subtotal'],
                        'profit' => $item['profit'],
                    ]);

                    // Update stock
                    Product::where('id', $item['product_id'])->decrement('stock', $item['qty']);

                    // Low stock WhatsApp notification
                    $updatedProduct = Product::find($item['product_id']);
                    if ($updatedProduct && $updatedProduct->stock <= 5 && !in_array($updatedProduct->id, $notifiedIds)) {
                        $notifiedIds[] = $updatedProduct->id;
                        try { 
                            app(WhatsAppService::class)->sendLowStockAlert($updatedProduct); 
                        } catch (\Exception $e) { 
                            Log::warning('WA Low Stock: ' . $e->getMessage()); 
                        }
                    }
                }

                DB::commit();
                
                // Store transaction ID for receipt
                session(['last_transaction_id' => $transaction->id]);
                
                return redirect()->route('pos.index')
                    ->with('success', '✅ Transaksi berhasil!')
                    ->with('transaction_id', $transaction->id);

            } catch (\Exception $e) {
                DB::rollBack();
                Log::error('Checkout DB Error: ' . $e->getMessage());
                return back()->with('error', 'Gagal menyimpan transaksi.');
            }

        } catch (\Illuminate\Validation\ValidationException $e) {
            return back()->with('error', 'Data tidak valid.');
        } catch (\Exception $e) {
            Log::error('Checkout Fatal: ' . $e->getMessage());
            return back()->with('error', 'Terjadi kesalahan sistem.');
        }
    }

    /**
     * Generate unique invoice code
     */
    private function generateInvoiceCode()
    {
        $date = now()->format('Ymd');
        $random = strtoupper(substr(md5(uniqid(mt_rand(), true)), 0, 6));
        return "INV-{$date}-{$random}";
    }

    /**
     * Print receipt
     */
    public function printReceipt($id)
    {
        $transaction = Transaction::with(['transactionItems.product.category', 'user'])
            ->findOrFail($id);
            
        if ($transaction->user_id !== auth()->id() && !auth()->user()->isAdmin()) {
            abort(403);
        }
        
        return view('pos.receipt', compact('transaction'));
    }
}