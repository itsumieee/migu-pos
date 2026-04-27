<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class StoreController extends Controller
{
    public function index(Request $request)
    {
        // 1. Query Dasar
        $query = Product::query();

        // 2. Filter Search
        if ($request->has('search') && $request->search != '') {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        // 3. Filter Kategori
        if ($request->has('category') && $request->category != '') {
            $query->where('category_id', $request->category);
        }

        // 4. Ambil Data
        $products = $query->latest()->get()->map(function($product) {
            return [
                'id'            => $product->id,
                'name'          => $product->name,
                'price'         => $product->price,
                'stock'         => $product->stock,
                'image'         => $product->image ? imageUrl($product->image) : 'https://placehold.co/600x800/f1f5f9/94a3b8?text=No+Image',
                'category_name' => $product->category->name ?? 'Fashion',
            ];
        });

        $categories = Category::all();

        return view('store.index', compact('products', 'categories'));
    }
}