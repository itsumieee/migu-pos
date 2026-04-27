<?php
namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\JsonResponse;

class NotificationController extends Controller
{
    public function getNotifications(): JsonResponse
    {
        $lowStock = Product::where('stock', '<=', 5)->count();
        $outOfStock = Product::where('stock', 0)->count();
        $recentOrders = \App\Models\Transaction::latest()->limit(5)->get();

        $notifications = [];

        if ($outOfStock > 0) {
            $notifications[] = [
                'type' => 'error',
                'title' => 'Stok Habis',
                'message' => "Ada {$outOfStock} produk yang stoknya habis",
                'icon' => '❌'
            ];
        }

        if ($lowStock > 0) {
            $notifications[] = [
                'type' => 'warning',
                'title' => 'Stok Menipis',
                'message' => "Ada {$lowStock} produk yang stoknya menipis (≤5)",
                'icon' => '⚠️'
            ];
        }

        return response()->json([
            'notifications' => $notifications,
            'count' => $lowStock + $outOfStock
        ]);
    }
}