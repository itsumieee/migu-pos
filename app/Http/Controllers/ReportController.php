<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function sales(Request $request)
    {
        $type = $request->get('type', 'monthly');
        
        if ($type === 'daily') {
            $data = Transaction::select(
                    DB::raw('DATE(created_at) as period'),
                    DB::raw('SUM(total_amount) as total'),
                    DB::raw('COUNT(*) as count')
                )
                ->groupBy('period')
                ->orderByDesc('period')
                ->get();
        } else {
            $data = Transaction::select(
                    DB::raw("DATE_FORMAT(created_at, '%Y-%m') as period"),
                    DB::raw('SUM(total_amount) as total'),
                    DB::raw('COUNT(*) as count')
                )
                ->groupBy('period')
                ->orderByDesc('period')
                ->get();
        }

        return view('reports.sales', compact('data', 'type'));
    }

    public function export()
    {
        $filename = "Laporan_Penjualan_" . date('Y-m-d') . ".csv";
        $transactions = \App\Models\Transaction::with('user')->latest()->get();

        $headers = [
            "Content-type" => "text/csv",
            "Content-Disposition" => "attachment; filename=$filename",
            "Pragma" => "no-cache",
            "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
            "Expires" => "0"
        ];

        $columns = ['ID', 'Tanggal', 'Kasir', 'Total', 'Metode', 'Status'];

        $callback = function() use($transactions, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach ($transactions as $row) {
                fputcsv($file, [
                    $row->id,
                    $row->created_at,
                    $row->user->name,
                    $row->total_amount,
                    $row->payment_method,
                    'Selesai'
                ]);
            }
            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}