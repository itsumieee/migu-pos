<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function index()
    {
        $transactions = Transaction::with(['user', 'transactionItems.product'])
            ->latest()
            ->paginate(15);
        
        return view('admin.transactions.index', compact('transactions'));
    }

    public function show(Transaction $transaction)
    {
        $transaction->load(['user', 'transactionItems.product']);
        return view('admin.transactions.show', compact('transaction'));
    }

    public function print(Transaction $transaction)
    {
        $transaction->load(['user', 'transactionItems.product']);
        return view('admin.transactions.print', compact('transaction'));
    }

    public function exportPDF()
    {
        $transactions = Transaction::with(['user', 'transactionItems.product'])
            ->latest()
            ->get();
        
        $totalRevenue = $transactions->sum('total_amount');
        $totalTransactions = $transactions->count();
        
        $data = [
            'title' => 'Laporan Transaksi',
            'transactions' => $transactions,
            'totalRevenue' => $totalRevenue,
            'totalTransactions' => $totalTransactions,
            'generated_at' => now()->format('d F Y H:i:s')
        ];
        
        $pdf = Pdf::loadView('admin.transactions.export-pdf', $data);
        $pdf->setPaper('A4', 'portrait');
        
        return $pdf->download('transaksi-' . now()->format('Y-m-d') . '.pdf');
    }

    public function exportPDFByDate(Request $request)
    {
        $request->validate([
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date'
        ]);
        
        $transactions = Transaction::with(['user', 'transactionItems.product'])
            ->whereBetween('created_at', [
                $request->start_date . ' 00:00:00',
                $request->end_date . ' 23:59:59'
            ])
            ->latest()
            ->get();
        
        $totalRevenue = $transactions->sum('total_amount');
        $totalTransactions = $transactions->count();
        
        $data = [
            'title' => 'Laporan Transaksi',
            'transactions' => $transactions,
            'totalRevenue' => $totalRevenue,
            'totalTransactions' => $totalTransactions,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'generated_at' => now()->format('d F Y H:i:s')
        ];
        
        $pdf = Pdf::loadView('admin.transactions.export-pdf', $data);
        $pdf->setPaper('A4', 'portrait');
        
        $filename = 'transaksi-' . $request->start_date . '-to-' . $request->end_date . '.pdf';
        return $pdf->download($filename);
    }
}