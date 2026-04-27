<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\TransactionItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;

class ProfitController extends Controller
{
    public function index(Request $request)
    {
        $period = $request->get('period', 'today');
        $now = Carbon::now();

        // Set start dan end date
        switch($period) {
            case 'today':
                $start = $now->copy()->startOfDay();
                $end = $now->copy()->endOfDay();
                $title = 'Hari Ini';
                break;
            case 'week':
                $start = $now->copy()->startOfWeek();
                $end = $now->copy()->endOfWeek();
                $title = 'Minggu Ini';
                break;
            case 'month':
                $start = $now->copy()->startOfMonth();
                $end = $now->copy()->endOfMonth();
                $title = 'Bulan Ini';
                break;
            case 'year':
                $start = $now->copy()->startOfYear();
                $end = $now->copy()->endOfYear();
                $title = 'Tahun Ini';
                break;
            default:
                $start = $now->copy()->startOfMonth();
                $end = $now->copy()->endOfMonth();
                $title = 'Bulan Ini';
        }

        // Query langsung ke database
        $transactions = Transaction::with(['transactionItems'])
            ->whereBetween('created_at', [$start, $end])
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        // Hitung total dari transactions table
        $totalRevenue = Transaction::whereBetween('created_at', [$start, $end])->sum('total_amount');
        $totalTransactions = Transaction::whereBetween('created_at', [$start, $end])->count();

        // Hitung modal dan profit dari transaction_items
        $costAndProfit = TransactionItem::join('transactions', 'transaction_items.transaction_id', '=', 'transactions.id')
            ->whereBetween('transactions.created_at', [$start, $end])
            ->select(
                DB::raw('SUM(transaction_items.cost_price * transaction_items.qty) as total_cost'),
                DB::raw('SUM(transaction_items.profit) as total_profit')
            )
            ->first();

        $totalCost = $costAndProfit->total_cost ?? 0;
        $totalProfit = $costAndProfit->total_profit ?? 0;
        $margin = $totalRevenue > 0 ? round(($totalProfit / $totalRevenue) * 100, 2) : 0;

        $summary = [
            'total_revenue' => $totalRevenue,
            'total_cost' => $totalCost,
            'total_profit' => $totalProfit,
            'margin' => $margin,
            'count' => $totalTransactions,
        ];

        // Top products by profit
        $topProducts = Product::select('products.id', 'products.name', 'products.image')
            ->join('transaction_items', 'products.id', '=', 'transaction_items.product_id')
            ->join('transactions', 'transaction_items.transaction_id', '=', 'transactions.id')
            ->whereBetween('transactions.created_at', [$start, $end])
            ->groupBy('products.id', 'products.name', 'products.image')
            ->orderByRaw('SUM(transaction_items.profit) DESC')
            ->limit(5)
            ->get(['products.*', DB::raw('SUM(transaction_items.profit) as total_profit')]);

        return view('reports.profit', compact('transactions', 'summary', 'topProducts', 'period', 'title', 'start', 'end'));
    }

    public function exportPDF(Request $request)
    {
        $period = $request->get('period', 'month');
        $now = Carbon::now();
        
        // Logic periode (sama seperti index)
        switch($period) {
            case 'today':
                $start = $now->copy()->startOfDay();
                $end = $now->copy()->endOfDay();
                $title = 'Hari Ini';
                break;
            case 'week':
                $start = $now->copy()->startOfWeek();
                $end = $now->copy()->endOfWeek();
                $title = 'Minggu Ini';
                break;
            case 'month':
                $start = $now->copy()->startOfMonth();
                $end = $now->copy()->endOfMonth();
                $title = 'Bulan Ini';
                break;
            case 'year':
                $start = $now->copy()->startOfYear();
                $end = $now->copy()->endOfYear();
                $title = 'Tahun Ini';
                break;
            default:
                $start = $now->copy()->startOfMonth();
                $end = $now->copy()->endOfMonth();
                $title = 'Bulan Ini';
        }
        
        $transactions = Transaction::whereBetween('created_at', [$start, $end])->get();
        $totalRevenue = $transactions->sum('total_amount');
        $totalProfit = 0;
        
        foreach($transactions as $trx) {
            $totalProfit += $trx->transactionItems->sum('profit');
        }
        
        $data = [
            'title' => 'Laporan Profit & Rugi',
            'period' => $title,
            'transactions' => $transactions,
            'totalRevenue' => $totalRevenue,
            'totalProfit' => $totalProfit,
            'totalCost' => $totalRevenue - $totalProfit,
            'generated_at' => now()->format('d F Y H:i:s')
        ];
        
        $pdf = Pdf::loadView('admin.reports.export-profit-pdf', $data);
        $pdf->setPaper('A4', 'portrait');
        
        return $pdf->download('laporan-profit-' . now()->format('Y-m-d') . '.pdf');
    }
}