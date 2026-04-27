@extends('layouts.app')

@section('page-title', 'Detail Transaksi #' . str_pad($transaction->id, 5, '0', STR_PAD_LEFT))

@section('content')
<div class="max-w-4xl mx-auto fade-in">
    <!-- Header Actions -->
    <div class="flex justify-between items-center mb-6">
        <div class="flex items-center gap-4">
            <a href="{{ route('transactions.index') }}" class="p-2 rounded-xl bg-slate-100 dark:bg-slate-800 text-slate-600 dark:text-slate-400 hover:bg-slate-200 dark:hover:bg-slate-700 smooth">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
            </a>
            <h1 class="text-2xl font-bold text-slate-900 dark:text-white">Detail Transaksi</h1>
        </div>
        <div class="flex gap-3">
            <a href="{{ route('transactions.print', $transaction) }}" target="_blank" class="flex items-center gap-2 px-4 py-2 bg-slate-800 dark:bg-slate-700 text-white rounded-xl text-sm font-semibold hover:bg-slate-700 smooth">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/></svg>
                Cetak Struk
            </a>
        </div>
    </div>

    <!-- Info Card -->
    <div class="bg-white dark:bg-slate-900 rounded-3xl border border-slate-200 dark:border-slate-800 shadow-soft overflow-hidden mb-6">
        <div class="p-6 border-b border-slate-100 dark:border-slate-800 grid grid-cols-1 md:grid-cols-3 gap-4">
            <div>
                <p class="text-xs text-slate-500 dark:text-slate-400 uppercase font-semibold mb-1">ID Transaksi</p>
                <p class="text-lg font-bold text-slate-900 dark:text-white">#{{ str_pad($transaction->id, 5, '0', STR_PAD_LEFT) }}</p>
            </div>
            <div>
                <p class="text-xs text-slate-500 dark:text-slate-400 uppercase font-semibold mb-1">Waktu</p>
                <p class="text-lg font-bold text-slate-900 dark:text-white">{{ $transaction->created_at->isoFormat('dddd, D MMMM Y') }}</p>
                <p class="text-sm text-slate-500">{{ $transaction->created_at->format('H:i') }} WIB</p>
            </div>
            <div>
                <p class="text-xs text-slate-500 dark:text-slate-400 uppercase font-semibold mb-1">Kasir</p>
                <p class="text-lg font-bold text-slate-900 dark:text-white">{{ $transaction->user->name }}</p>
            </div>
        </div>
        
        <!-- Item Table -->
        <div class="p-0">
            <table class="w-full text-left">
                <thead class="bg-slate-50 dark:bg-slate-800/50">
                    <tr>
                        <th class="px-6 py-3 text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase">Produk</th>
                        <th class="px-6 py-3 text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase text-center">Harga</th>
                        <th class="px-6 py-3 text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase text-center">Qty</th>
                        <th class="px-6 py-3 text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase text-right">Subtotal</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 dark:divide-slate-800">
                    @foreach($transaction->transactionItems as $item)
                    <tr>
                        <td class="px-6 py-4">
                            <div class="font-semibold text-slate-900 dark:text-white">{{ $item->product->name }}</div>
                            <div class="text-xs text-slate-500">SKU: {{ $item->product->sku }}</div>
                        </td>
                        <td class="px-6 py-4 text-center text-slate-600 dark:text-slate-300">Rp {{ number_format($item->price, 0, ',', '.') }}</td>
                        <td class="px-6 py-4 text-center text-slate-900 dark:text-white font-bold">{{ $item->qty }}</td>
                        <td class="px-6 py-4 text-right font-bold text-slate-900 dark:text-white">Rp {{ number_format($item->subtotal, 0, ',', '.') }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Footer Totals -->
        <div class="bg-slate-50 dark:bg-slate-800/50 p-6 border-t border-slate-200 dark:border-slate-800 flex flex-col items-end gap-2">
            <div class="flex justify-between w-full md:w-64">
                <span class="text-slate-600 dark:text-slate-400">Total Transaksi</span>
                <span class="text-xl font-bold text-slate-900 dark:text-white">Rp {{ number_format($transaction->total_amount, 0, ',', '.') }}</span>
            </div>
            <div class="flex justify-between w-full md:w-64 text-sm">
                <span class="text-slate-500">Metode: {{ strtoupper($transaction->payment_method) }}</span>
                <span class="text-slate-500">Bayar: Rp {{ number_format($transaction->payment_amount, 0, ',', '.') }}</span>
            </div>
            <div class="flex justify-between w-full md:w-64 text-sm">
                <span class="text-emerald-600 dark:text-emerald-400 font-bold">Kembalian</span>
                <span class="text-emerald-600 dark:text-emerald-400 font-bold">Rp {{ number_format($transaction->change_amount, 0, ',', '.') }}</span>
            </div>
        </div>
    </div>
</div>
@endsection