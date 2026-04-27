<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        return view('cart.index');
    }

    public function add($productId)
    {
        $product = Product::findOrFail($productId);
        $cart = session()->get('cart', []);
        
        if (isset($cart[$productId])) {
            $cart[$productId]['qty']++;
        } else {
            $cart[$productId] = [
                'name' => $product->name,
                'price' => $product->price,
                'qty' => 1,
                'image' => $product->image ? imageUrl($product->image) : null
            ];
        }
        
        session()->put('cart', $cart);
        session()->put('cart_count', count($cart));
        
        return back()->with('success', 'Produk ditambahkan ke keranjang!');
    }

    public function update($productId, Request $request)
    {
        $cart = session()->get('cart', []);
        
        if (isset($cart[$productId])) {
            $newQty = $cart[$productId]['qty'] + $request->qty;
            
            if ($newQty > 0) {
                $product = Product::find($productId);
                if ($product && $newQty <= $product->stock) {
                    $cart[$productId]['qty'] = $newQty;
                    session()->put('cart', $cart);
                    return response()->json(['success' => true]);
                }
                return response()->json(['success' => false, 'message' => 'Stok tidak mencukupi']);
            }
            
            unset($cart[$productId]);
        }
        
        session()->put('cart', $cart);
        session()->put('cart_count', count($cart));
        return response()->json(['success' => true]);
    }

    public function remove($productId)
    {
        $cart = session()->get('cart', []);
        
        if (isset($cart[$productId])) {
            unset($cart[$productId]);
        }
        
        session()->put('cart', $cart);
        session()->put('cart_count', count($cart));
        
        return response()->json(['success' => true]);
    }
}