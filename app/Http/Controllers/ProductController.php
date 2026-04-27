<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Services\WhatsAppService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Barryvdh\DomPDF\Facade\Pdf;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $products = Product::with('category')
            ->when($request->q, fn($q) => $q->where('name', 'like', "%{$request->q}%"))
            ->latest()
            ->paginate(12);
        return view('products.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'sku' => 'required|string|unique:products',
            'price' => 'required|numeric|min:0',
            'cost_price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('products', 'public');
        }

        $product = Product::create($validated);

        // 🚀 AUTO WA: Cek stok setelah simpan
        if ($product->stock <= 5) {
            try { (new WhatsAppService())->sendLowStockAlert($product); } 
            catch (\Exception $e) { Log::error('WA Store: ' . $e->getMessage()); }
        }

        return redirect()->route('products.index')->with('success', '✅ Produk berhasil ditambahkan!');
    }

    public function edit(Product $product)
    {
        $categories = Category::all();
        return view('products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'sku' => 'required|string|unique:products,sku,' . $product->id,
            'price' => 'required|numeric|min:0',
            'cost_price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($request->hasFile('image')) {
            if ($product->image) Storage::disk('public')->delete($product->image);
            $validated['image'] = $request->file('image')->store('products', 'public');
        }

        $oldStock = $product->stock;
        $product->update($validated);

        // 🚀 AUTO WA: Jika stok berubah jadi <= 5
        if ($product->stock <= 5 && $product->stock !== $oldStock) {
            try { (new WhatsAppService())->sendLowStockAlert($product); } 
            catch (\Exception $e) { Log::error('WA Update: ' . $e->getMessage()); }
        }

        return redirect()->route('products.index')->with('success', '✅ Produk berhasil diperbarui!');
    }

    public function destroy(Product $product)
    {
        if ($product->image) Storage::disk('public')->delete($product->image);
        $product->delete();
        return back()->with('success', '🗑️ Produk berhasil dihapus.');
    }

    // Barcode Methods
    public function showBarcode(Product $product)
    {
        return view('products.barcode', compact('product'));
    }

    public function printBarcode(Request $request)
    {
        $productIds = $request->input('product_ids', []);
        $products = Product::whereIn('id', $productIds)->get();
        return view('products.barcode-print', compact('products'));
    }

    public function exportPDF()
    {
        $products = Product::with('category')->latest()->get();
        
        $data = [
            'title' => 'Daftar Produk',
            'products' => $products,
            'generated_at' => now()->format('d F Y H:i:s')
        ];
        
        $pdf = Pdf::loadView('admin.products.export-pdf', $data);
        $pdf->setPaper('A4', 'portrait');
        
        return $pdf->download('produk-' . now()->format('Y-m-d') . '.pdf');
    }
}