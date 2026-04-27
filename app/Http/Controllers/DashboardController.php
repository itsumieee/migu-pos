<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Transaction;
use App\Models\Category;
use Illuminate\Http\Request;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $now = now();
        $data = $this->getChartData($now);
        
        return view('dashboard.index', $data);
    }

    // API endpoint untuk real-time chart updates
    public function chartData(Request $request)
    {
        $now = now();
        $data = $this->getChartData($now);
        
        return response()->json([
            'success' => true,
            'data' => [
                'totalProducts' => $data['totalProducts'],
                'lowStock' => $data['lowStock'],
                'todaySales' => $data['todaySales'],
                'todayTransactions' => $data['todayTransactions'],
                'salesChange' => $data['salesChange'],
                'transactionChange' => $data['transactionChange'],
                'chartLabels' => $data['chartLabels'],
                'chartData' => $data['chartData'],
                'chartTransactions' => $data['chartTransactions'],
                'topProducts' => $data['topProducts'],
                'recentTransactions' => $data['recentTransactions'],
                'categories' => $data['categories'],
            ],
            'timestamp' => now()->format('Y-m-d H:i:s')
        ]);
    }

    // Helper function untuk get semua chart data
    private function getChartData($now)
    {
        // Stats Cards - Real Data
        $totalProducts = Product::count();
        $lowStock = Product::where('stock', '<=', 5)->where('stock', '>', 0)->count();
        $todaySales = Transaction::whereDate('created_at', $now)->sum('total_amount');
        $todayTransactions = Transaction::whereDate('created_at', $now)->count();
        
        // Yesterday comparison
        $yesterday = $now->copy()->subDay();
        $yesterdaySales = Transaction::whereDate('created_at', $yesterday)->sum('total_amount');
        $yesterdayTransactions = Transaction::whereDate('created_at', $yesterday)->count();
        
        // Calculate percentage change
        $salesChange = $yesterdaySales > 0 ? round((($todaySales - $yesterdaySales) / $yesterdaySales) * 100, 0) : 0;
        $transactionChange = $yesterdayTransactions > 0 ? round((($todayTransactions - $yesterdayTransactions) / $yesterdayTransactions) * 100, 0) : 0;
        
        // Chart Data - Last 7 Days from Real Database
        $chartLabels = [];
        $chartData = [];
        $chartTransactions = [];
        
        for ($i = 6; $i >= 0; $i--) {
            $date = $now->copy()->subDays($i);
            $chartLabels[] = $date->format('d M');
            
            // Query real data from database
            $dailySales = Transaction::whereDate('created_at', $date)->sum('total_amount');
            $dailyTransactions = Transaction::whereDate('created_at', $date)->count();
            
            $chartData[] = (float)$dailySales;
            $chartTransactions[] = (int)$dailyTransactions;
        }
        
        // Top Products - Top 5 Best Sellers This Month
        $topProducts = Product::selectRaw('
            products.id,
            products.name,
            products.price,
            COUNT(transaction_items.id) as sales,
            SUM(transaction_items.qty) as total_qty,
            SUM(transaction_items.subtotal) as total_revenue
        ')
            ->leftJoin('transaction_items', 'products.id', '=', 'transaction_items.product_id')
            ->leftJoin('transactions', 'transaction_items.transaction_id', '=', 'transactions.id')
            ->whereMonth('transactions.created_at', $now->month)
            ->whereYear('transactions.created_at', $now->year)
            ->groupBy('products.id', 'products.name', 'products.price')
            ->orderByDesc('total_qty')
            ->limit(5)
            ->get();
        
        // Recent Transactions - Last 5 Transactions
        $recentTransactions = Transaction::with(['user', 'transactionItems.product'])
            ->latest('transactions.created_at')
            ->limit(5)
            ->get();
        
        // Category Distribution Stats
        $categories = Category::withCount('products')
            ->orderByDesc('products_count')
            ->get();
        
        return compact(
            'totalProducts',
            'lowStock',
            'todaySales',
            'todayTransactions',
            'salesChange',
            'transactionChange',
            'chartLabels',
            'chartData',
            'chartTransactions',
            'topProducts',
            'recentTransactions',
            'categories'
        );
    }
}