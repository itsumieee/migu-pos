<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductApiController extends Controller
{
    public function index(Request $request)
    {
        // Validasi parameter search dan pagination
        $validated = $request->validate([
            'q' => 'nullable|string|max:255',
            'page' => 'nullable|integer|min:1',
            'per_page' => 'nullable|integer|min:1|max:100',
        ]);

        $perPage = $validated['per_page'] ?? 12;
        $search = $validated['q'] ?? '';

        $products = Product::with('category')
            ->when($search, fn($query) => $query->where('name', 'like', "%{$search}%")
                ->orWhere('sku', 'like', "%{$search}%"))
            ->latest()
            ->paginate($perPage);

        return response()->json([
            'success' => true,
            'data' => $products->items(),
            'pagination' => [
                'current_page' => $products->currentPage(),
                'per_page' => $products->perPage(),
                'total' => $products->total(),
                'last_page' => $products->lastPage(),
                'from' => $products->firstItem(),
                'to' => $products->lastItem(),
            ]
        ]);
    }

    public function show($id)
    {
        $product = Product::with('category')->find($id);
        if (!$product) {
            return response()->json(['success' => false, 'message' => 'Not found'], 404);
        }
        return response()->json(['success' => true, 'data' => $product]);
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'sku' => 'required|string|unique:products',
                'price' => 'required|numeric|min:0',
                'cost_price' => 'required|numeric|min:0',
                'stock' => 'required|integer|min:0',
                'category_id' => 'required|exists:categories,id',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            ]);

            if ($request->hasFile('image')) {
                $validated['image'] = $request->file('image')->store('products', 'public');
            }

            $product = Product::create($validated);
            return response()->json([
                'success' => true,
                'message' => 'Produk berhasil dibuat',
                'data' => $product->load('category')
            ], 201);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error: ' . $e->getMessage()
            ], 500);
        }
    }

    public function update(Request $request, $id)
    {
        $product = Product::find($id);
        if (!$product) {
            return response()->json(['success' => false, 'message' => 'Produk tidak ditemukan'], 404);
        }

        try {
            // Get input dari JSON atau form-data
            $input = $request->all();
            
            // Jika kosong, coba parse JSON dari raw content
            if (empty($input) && $request->getContent()) {
                $decoded = json_decode($request->getContent(), true);
                if (is_array($decoded)) {
                    $input = $decoded;
                }
            }

            // Validate input
            $validated = [];
            $rules = [
                'name' => 'nullable|string|max:255',
                'sku' => 'nullable|string|unique:products,sku,' . $id,
                'price' => 'nullable|numeric|min:0',
                'cost_price' => 'nullable|numeric|min:0',
                'stock' => 'nullable|integer|min:0',
                'category_id' => 'nullable|exists:categories,id',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            ];

            // Validate setiap field
            foreach ($rules as $field => $rule) {
                if ($field === 'image') {
                    if ($request->hasFile('image')) {
                        $validated[$field] = $request->validate([$field => $rule])[$field];
                    }
                } else {
                    if (isset($input[$field])) {
                        $validated[$field] = $input[$field];
                    }
                }
            }

            // Handle image upload
            if ($request->hasFile('image')) {
                if ($product->image && Storage::disk('public')->exists($product->image)) {
                    Storage::disk('public')->delete($product->image);
                }
                $validated['image'] = $request->file('image')->store('products', 'public');
            }

            // Filter hanya field yang tidak null
            $updateData = array_filter($validated, fn($v) => $v !== null);

            // Update product
            if (!empty($updateData)) {
                $product->update($updateData);
                $product->refresh();
            }

            return response()->json([
                'success' => true, 
                'message' => '✅ Produk berhasil diperbarui!',
                'data' => $product->load('category')
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error: ' . $e->getMessage()
            ], 500);
        }
    }

    public function destroy($id)
    {
        $product = Product::find($id);
        if (!$product) {
            return response()->json(['success' => false, 'message' => 'Not found'], 404);
        }
        
        try {
            $product->delete();
            return response()->json(['success' => true, 'message' => 'Deleted']);
        } catch (\Illuminate\Database\QueryException $e) {
            if ($e->getCode() == 23000) {
                return response()->json([
                    'success' => false, 
                    'message' => 'Tidak bisa menghapus produk yang memiliki transaksi'
                ], 422);
            }
            return response()->json(['success' => false, 'message' => 'Server error'], 500);
        }
    }
}
