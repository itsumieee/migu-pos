@extends('layouts.app')

@section('page-title', 'Detail Transaksi')

@section('content')
<div class="space-y-6 fade-in">
    <!-- Header -->
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-3xl font-bold text-slate-900 dark:text-white">Detail Transaksi</h1>
            <p class="text-sm text-slate-500 dark:text-slate-400 mt-1">ID: #{{ str_pad($transaction->id, 6, '0', STR_PAD_LEFT) }}</p>
        </div>
        <div class="flex gap-3">
            <a href="{{ route('transactions.index') }}" class="px-5 py-2.5 bg-slate-100 dark:bg-slate-800 text-slate-700 dark:text-slate-300 rounded-xl font-semibold hover:bg-slate-200 dark:hover:bg-slate-700 transition">
                Kembali
            </a>
            <a href="{{ route('transactions.print', $transaction) }}" target="_blank" class="px-5 py-2.5 bg-cyan-500 hover:bg-cyan-600 text-white rounded-xl font-semibold shadow-lg shadow-cyan-500/30 transition flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/></svg>
                Cetak
            </a>
        </div>
    </div>

    <div class="grid lg:grid-cols-3 gap-6">
        <!-- Main Content -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Transaction Info -->
            <div class="bg-white dark:bg-slate-900 rounded-3xl border border-slate-200 dark:border-slate-800 shadow-soft p-6">
                <h2 class="text-xl font-bold text-slate-900 dark:text-white mb-6 flex items-center gap-2">
                    <div class="w-6 h-6 rounded-lg gradient-primary flex items-center justify-center text-white text-sm font-bold">📋</div>
                    Informasi Transaksi
                </h2>
                
                <div class="grid md:grid-cols-2 gap-6">
                    <div>
                        <label class="text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Tanggal & Waktu</label>
                        <p class="text-lg font-bold text-slate-900 dark:text-white mt-1">{{ $transaction->created_at->format('d M Y H:i:s') }}</p>
                    </div>
                    
                    <div>
                        <label class="text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Metode Pembayaran</label>
                        <p class="mt-1">
                            @php
                                $method = $transaction->payment_method ?? 'cash';
                                $methodLabel = match($method) {
                                    'transfer' => 'Transfer Bank',
                                    'qris' => 'QRIS',
                                    default => 'Tunai'
                                };
                                $methodBg = match($method) {
                                    'transfer' => 'bg-blue-100 dark:bg-blue-900/30 text-blue-600 dark:text-blue-400',
                                    'qris' => 'bg-purple-100 dark:bg-purple-900/30 text-purple-600 dark:text-purple-400',
                                    default => 'bg-emerald-100 dark:bg-emerald-900/30 text-emerald-600 dark:text-emerald-400'
                                };
                            @endphp
                            <span class="px-4 py-2 rounded-lg {{ $methodBg }} font-semibold text-sm">{{ $methodLabel }}</span>
                        </p>
                    </div>
                    
                    <div>
                        <label class="text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Kasir</label>
                        <p class="text-lg font-bold text-slate-900 dark:text-white mt-1">{{ $transaction->user->name ?? '-' }}</p>
                    </div>
                    
                    <div>
                        <label class="text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Status</label>
                        <p class="mt-1">
                            <span class="px-4 py-2 rounded-lg bg-emerald-100 dark:bg-emerald-900/30 text-emerald-600 dark:text-emerald-400 font-semibold text-sm">✓ Selesai</span>
                        </p>
                    </div>
                </div>
            </div>

            <!-- Items Table -->
            <div class="bg-white dark:bg-slate-900 rounded-3xl border border-slate-200 dark:border-slate-800 shadow-soft overflow-hidden">
                <div class="p-6 border-b border-slate-200 dark:border-slate-800">
                    <h3 class="text-xl font-bold text-slate-900 dark:text-white flex items-center gap-2">
                        <div class="w-6 h-6 rounded-lg gradient-primary flex items-center justify-center text-white text-sm font-bold">🛍️</div>
                        Item Pembelian
                    </h3>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead class="bg-slate-50 dark:bg-slate-800/50 border-b border-slate-200 dark:border-slate-800">
                            <tr>
                                <th class="px-6 py-4 text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase">Produk</th>
                                <th class="px-6 py-4 text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase text-right">Harga</th>
                                <th class="px-6 py-4 text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase text-right">Qty</th>
                                <th class="px-6 py-4 text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase text-right">Subtotal</th>
                                <th class="px-6 py-4 text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase text-right">Profit</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 dark:divide-slate-800">
                            @foreach($transaction->transactionItems as $item)
                            <tr class="hover:bg-slate-50 dark:hover:bg-slate-800/50 transition">
                                <td class="px-6 py-4">
                                    <div class="font-semibold text-slate-900 dark:text-white">{{ $item->product->name }}</div>
                                    <div class="text-xs text-slate-500 dark:text-slate-400">SKU: {{ $item->product->sku }}</div>
                                </td>
                                <td class="px-6 py-4 text-right font-semibold text-slate-900 dark:text-white">Rp {{ number_format($item->price, 0, ',', '.') }}</td>
                                <td class="px-6 py-4 text-right font-semibold text-slate-900 dark:text-white">{{ $item->qty }} pcs</td>
                                <td class="px-6 py-4 text-right font-bold text-cyan-600 dark:text-cyan-400">Rp {{ number_format($item->price * $item->qty, 0, ',', '.') }}</td>
                                <td class="px-6 py-4 text-right font-bold {{ $item->profit >= 0 ? 'text-emerald-600 dark:text-emerald-400' : 'text-rose-600 dark:text-rose-400' }}">
                                    Rp {{ number_format($item->profit, 0, ',', '.') }}
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Summary Sidebar -->
        <div class="space-y-6">
            <!-- Total Summary -->
            <div class="bg-gradient-to-br from-cyan-500/10 to-blue-500/10 dark:from-cyan-900/20 dark:to-blue-900/20 rounded-3xl border border-cyan-200 dark:border-cyan-800 p-6">
                <h3 class="text-lg font-bold text-slate-900 dark:text-white mb-6">Ringkasan Total</h3>
                
                <div class="space-y-4">
                    <div class="flex justify-between items-center pb-4 border-b border-slate-200 dark:border-slate-700">
                        <span class="text-slate-600 dark:text-slate-400">Subtotal</span>
                        <span class="font-bold text-slate-900 dark:text-white">Rp {{ number_format($transaction->transactionItems->sum('price') * $transaction->transactionItems->sum('qty'), 0, ',', '.') }}</span>
                    </div>
                    
                    <div class="flex justify-between items-center pb-4 border-b border-slate-200 dark:border-slate-700">
                        <span class="text-slate-600 dark:text-slate-400">Total Modal</span>
                        <span class="font-bold text-slate-900 dark:text-white">Rp {{ number_format($transaction->transactionItems->sum('cost_price') * $transaction->transactionItems->sum('qty'), 0, ',', '.') }}</span>
                    </div>
                    
                    <div class="flex justify-between items-center py-4 border-t-2 border-b-2 border-cyan-300 dark:border-cyan-700 bg-white dark:bg-slate-800 px-4 rounded-xl">
                        <span class="font-bold text-slate-900 dark:text-white">Total Penjualan</span>
                        <span class="text-2xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-cyan-600 to-blue-600 dark:from-cyan-400 dark:to-blue-400">Rp {{ number_format($transaction->total_amount, 0, ',', '.') }}</span>
                    </div>
                    
                    <div class="flex justify-between items-center pt-4">
                        <span class="font-bold text-slate-900 dark:text-white">Total Profit</span>
                        <span class="text-xl font-bold {{ $transaction->transactionItems->sum('profit') >= 0 ? 'text-emerald-600 dark:text-emerald-400' : 'text-rose-600 dark:text-rose-400' }}">
                            Rp {{ number_format($transaction->transactionItems->sum('profit'), 0, ',', '.') }}
                        </span>
                    </div>
                    
                    @php
                        $totalRevenue = $transaction->total_amount;
                        $totalProfit = $transaction->transactionItems->sum('profit');
                        $profitMargin = $totalRevenue > 0 ? round(($totalProfit / $totalRevenue) * 100, 1) : 0;
                    @endphp
                    
                    <div class="flex justify-between items-center pt-2">
                        <span class="text-slate-600 dark:text-slate-400">Margin Profit</span>
                        <span class="font-bold {{ $profitMargin >= 0 ? 'text-emerald-600' : 'text-rose-600' }}">{{ $profitMargin }}%</span>
                    </div>
                </div>
            </div>

            <!-- Items Count -->
            <div class="bg-white dark:bg-slate-900 rounded-3xl border border-slate-200 dark:border-slate-800 shadow-soft p-6">
                <h3 class="text-lg font-bold text-slate-900 dark:text-white mb-6">Statistik</h3>
                
                <div class="space-y-4">
                    <div class="flex items-center justify-between">
                        <span class="text-slate-600 dark:text-slate-400">Total Item</span>
                        <span class="px-4 py-2 rounded-lg bg-blue-100 dark:bg-blue-900/30 text-blue-600 dark:text-blue-400 font-bold">{{ $transaction->transactionItems->count() }} item</span>
                    </div>
                    
                    <div class="flex items-center justify-between">
                        <span class="text-slate-600 dark:text-slate-400">Total Qty</span>
                        <span class="px-4 py-2 rounded-lg bg-purple-100 dark:bg-purple-900/30 text-purple-600 dark:text-purple-400 font-bold">{{ $transaction->transactionItems->sum('qty') }} pcs</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
