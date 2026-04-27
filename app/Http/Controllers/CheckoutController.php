<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\CheckoutRequest;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class CheckoutController extends Controller
{
    public function process(Request $request)
    {
        // Ensure user is authenticated
        if (!auth()->check()) {
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu');
        }

        // Validate payment method
        try {
            $request->validate([
                'payment_method' => 'required|in:cash,debit,qris,ewallet',
            ]);
        } catch (\Exception $e) {
            return back()->with('error', 'Metode pembayaran tidak valid: ' . $e->getMessage());
        }

        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return back()->with('error', 'Keranjang kosong!');
        }

        DB::beginTransaction();
        try {
            // Create Order (status: pending)
            $order = Order::create([
                'user_id'     => auth()->id(),
                'order_number' => 'ORD-' . strtoupper(uniqid()),
                'total_amount' => $totalAmount,
                'status'      => 'pending',
                'payment_method' => $request->payment_method,
            ]);

            if (!$order) {
                throw new \Exception('Gagal membuat order');
            }

            // Create Order Items
            foreach ($cart as $id => $item) {
                $orderItem = OrderItem::create([
                    'order_id'   => $order->id,
                    'product_id' => $id,
                    'quantity'   => $item['qty'],
                    'price'      => $item['price'],
                    'subtotal'   => $item['price'] * $item['qty'],
                ]);
                
                if (!$orderItem) {
                    throw new \Exception('Gagal membuat order item untuk produk: ' . $id);
                }
            }

            // Create Checkout Request untuk Cashier Confirmation
            $checkoutRequest = CheckoutRequest::create([
                'order_id'        => $order->id,
                'customer_id'     => auth()->id(),
                'total_amount'    => $totalAmount,
                'payment_method'  => $request->payment_method,
                'status'          => 'pending',
                'expired_at'      => Carbon::now()->addMinutes(15), // 15 menit timeout
            ]);
            
            if (!$checkoutRequest) {
                throw new \Exception('Gagal membuat checkout request');
            }

            DB::commit();

            // Clear cart
            session()->forget('cart');
            session()->forget('cart_count');

            // Return waiting page (bukan langsung success)
            return redirect()->route('checkout.waiting', $order->id)
                ->with('success', 'Pesanan dibuat! Menunggu konfirmasi kasir...');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Gagal memproses pesanan: ' . $e->getMessage());
        }
    }

    // Halaman menunggu konfirmasi kasir
    public function waiting($orderId)
    {
        $order = Order::with(['items.product', 'user', 'checkoutRequest'])->findOrFail($orderId);
        
        // Cek apakah ada checkout request
        if (!$order->checkoutRequest) {
            return redirect()->route('cart.index')->with('error', 'Checkout request tidak ditemukan');
        }

        // Cek status
        $checkoutRequest = $order->checkoutRequest;
        
        // Jika sudah confirmed
        if ($checkoutRequest->status === 'confirmed') {
            return redirect()->route('order.success', $order->id);
        }

        // Jika rejected
        if ($checkoutRequest->status === 'rejected') {
            session()->put('cart', $order->items->mapWithKeys(fn($item) => [
                $item->product_id => [
                    'name' => $item->product->name,
                    'price' => $item->price,
                    'qty' => $item->quantity,
                    'image' => $item->product->image,
                ]
            ])->toArray());
            
            return redirect()->route('cart.index')
                ->with('error', 'Pesanan ditolak: ' . ($checkoutRequest->rejection_reason ?? 'Alasan tidak diberikan'));
        }

        // Jika expired
        if ($checkoutRequest->expired_at && $checkoutRequest->expired_at < now()) {
            $checkoutRequest->update(['status' => 'expired']);
            session()->put('cart', $order->items->mapWithKeys(fn($item) => [
                $item->product_id => [
                    'name' => $item->product->name,
                    'price' => $item->price,
                    'qty' => $item->quantity,
                    'image' => $item->product->image,
                ]
            ])->toArray());
            
            return redirect()->route('cart.index')
                ->with('error', 'Waktu menunggu konfirmasi kasir telah berakhir');
        }

        // Hitung sisa waktu
        $remainingSeconds = $checkoutRequest->expired_at->diffInSeconds(now());

        return view('checkout.waiting', compact('order', 'checkoutRequest', 'remainingSeconds'));
    }

    // API untuk check status (real-time polling)
    public function checkStatus($orderId)
    {
        $order = Order::with('checkoutRequest')->findOrFail($orderId);
        
        if (!$order->checkoutRequest) {
            return response()->json(['error' => 'Checkout request not found'], 404);
        }

        $checkoutRequest = $order->checkoutRequest;

        return response()->json([
            'status' => $checkoutRequest->status,
            'expired_at' => $checkoutRequest->expired_at,
            'rejection_reason' => $checkoutRequest->rejection_reason,
        ]);
    }

    public function success($orderId)
    {
        $order = Order::with(['items.product', 'user'])->findOrFail($orderId);
        
        // Verify status
        if ($order->status !== 'paid') {
            return redirect()->route('checkout.waiting', $order->id)
                ->with('error', 'Status pesanan belum dikonfirmasi');
        }

        return view('order.success', compact('order'));
    }
}