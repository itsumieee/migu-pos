<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class ProfitApiController extends Controller
{
    public function index(Request $request)
    {
        $period = $request->get('period', 'month');
        $now = Carbon::now();

        switch($period) {
            case 'today':
                $start = $now->copy()->startOfDay();
                $end = $now->copy()->endOfDay();
                break;
            case 'week':
                $start = $now->copy()->startOfWeek();
                $end = $now->copy()->endOfWeek();
                break;
            case 'month':
                $start = $now->copy()->startOfMonth();
                $end = $now->copy()->endOfMonth();
                break;
            case 'year':
                $start = $now->copy()->startOfYear();
                $end = $now->copy()->endOfYear();
                break;
            default:
                $start = $now->copy()->startOfMonth();
                $end = $now->copy()->endOfMonth();
        }

        $transactions = Transaction::with(['transactionItems'])
            ->whereBetween('created_at', [$start, $end])
            ->get();

        $totalRevenue = $transactions->sum('total_amount');
        
        $totalCost = $transactions->flatMap(function($t) {
            return $t->transactionItems;
        })->sum(function($item) {
            return $item->quantity * ($item->product->cost_price ?? 0);
        });

        $profit = $totalRevenue - $totalCost;
        $profitMargin = $totalRevenue > 0 ? ($profit / $totalRevenue) * 100 : 0;

        return response()->json([
            'success' => true,
            'period' => $period,
            'data' => [
                'total_revenue' => $totalRevenue,
                'total_cost' => $totalCost,
                'total_profit' => $profit,
                'profit_margin' => round($profitMargin, 2),
                'transaction_count' => $transactions->count(),
            ]
        ]);
    }

    public function show($id)
    {
        $transaction = Transaction::with('transactionItems.product')->find($id);
        if (!$transaction) {
            return response()->json(['success' => false, 'message' => 'Transaction not found'], 404);
        }

        $cost = $transaction->transactionItems->sum(function($item) {
            return $item->quantity * ($item->product->cost_price ?? 0);
        });

        $profit = $transaction->total_amount - $cost;

        return response()->json([
            'success' => true,
            'data' => [
                'transaction' => $transaction,
                'cost' => $cost,
                'profit' => $profit,
            ]
        ]);
    }
}
