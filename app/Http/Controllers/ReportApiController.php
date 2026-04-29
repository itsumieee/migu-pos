<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportApiController extends Controller
{
    public function sales(Request $request)
    {
        $type = $request->get('type', 'monthly');
        $period = $request->get('period', null);

        if ($type === 'daily') {
            $query = Transaction::select(
                DB::raw('DATE(created_at) as period'),
                DB::raw('SUM(total_amount) as total'),
                DB::raw('COUNT(*) as count')
            )
            ->groupBy('period')
            ->orderByDesc('period');

            if ($period) {
                $query->whereRaw("DATE(created_at) >= ?", [$period]);
            }

            $data = $query->get();
        } else {
            $query = Transaction::select(
                DB::raw("DATE_FORMAT(created_at, '%Y-%m') as period"),
                DB::raw('SUM(total_amount) as total'),
                DB::raw('COUNT(*) as count')
            )
            ->groupBy('period')
            ->orderByDesc('period');

            if ($period) {
                $query->whereRaw("DATE_FORMAT(created_at, '%Y-%m') >= ?", [$period]);
            }

            $data = $query->get();
        }

        return response()->json(['success' => true, 'type' => $type, 'data' => $data]);
    }

    public function inventory(Request $request)
    {
        $data = DB::table('products')
            ->join('categories', 'products.category_id', '=', 'categories.id')
            ->select(
                'products.id',
                'products.name',
                'products.sku',
                'products.stock',
                'products.price',
                'products.cost_price',
                'categories.name as category'
            )
            ->get();

        return response()->json(['success' => true, 'data' => $data]);
    }

    public function summary()
    {
        $totalTransactions = Transaction::count();
        $totalRevenue = Transaction::sum('total_amount');
        $totalProducts = DB::table('products')->count();
        $lowStockProducts = DB::table('products')->where('stock', '<', 10)->count();

        return response()->json([
            'success' => true,
            'data' => [
                'total_transactions' => $totalTransactions,
                'total_revenue' => $totalRevenue,
                'total_products' => $totalProducts,
                'low_stock_products' => $lowStockProducts,
            ]
        ]);
    }
}
