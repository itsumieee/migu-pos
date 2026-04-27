@extends('layouts.app')

@section('page-title', 'Laporan Profit')

@section('content')
<div class="space-y-6 fade-in">
    <!-- Header -->
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
        <div>
            <h1 class="text-2xl font-bold text-slate-900 dark:text-white">Laporan Profit & Rugi</h1>
            <p class="text-sm text-slate-500 dark:text-slate-400 mt-1">Periode: <span class="font-semibold text-cyan-500">{{ $title }}</span></p>
        </div>
        
        <!-- Filter Buttons -->
        <div class="flex bg-slate-100 dark:bg-slate-800 p-1 rounded-xl">
            <a href="?period=today" class="px-4 py-2 rounded-lg text-sm font-semibold smooth {{ $period === 'today' ? 'bg-white dark:bg-slate-700 text-cyan-600 shadow-sm' : 'text-slate-500' }}">Hari Ini</a>
            <a href="?period=week" class="px-4 py-2 rounded-lg text-sm font-semibold smooth {{ $period === 'week' ? 'bg-white dark:bg-slate-700 text-cyan-600 shadow-sm' : 'text-slate-500' }}">Minggu Ini</a>
            <a href="?period=month" class="px-4 py-2 rounded-lg text-sm font-semibold smooth {{ $period === 'month' ? 'bg-white dark:bg-slate-700 text-cyan-600 shadow-sm' : 'text-slate-500' }}">Bulan Ini</a>
            <a href="?period=year" class="px-4 py-2 rounded-lg text-sm font-semibold smooth {{ $period === 'year' ? 'bg-white dark:bg-slate-700 text-cyan-600 shadow-sm' : 'text-slate-500' }}">Tahun Ini</a>
        </div>
    </div>

    <!-- Summary Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-5">
        <div class="bg-white dark:bg-slate-900 rounded-3xl p-6 border border-slate-200 dark:border-slate-800 shadow-soft">
            <p class="text-xs font-semibold text-slate-500 uppercase">TOTAL PENDAPATAN</p>
            <p class="text-3xl font-bold text-slate-900 dark:text-white mt-2">Rp {{ number_format($summary['total_revenue'], 0, ',', '.') }}</p>
            <p class="text-xs text-slate-400 mt-1">Omzet kotor</p>
        </div>

        <div class="bg-white dark:bg-slate-900 rounded-3xl p-6 border border-slate-200 dark:border-slate-800 shadow-soft">
            <p class="text-xs font-semibold text-slate-500 uppercase">TOTAL MODAL</p>
            <p class="text-3xl font-bold text-rose-600 mt-2">Rp {{ number_format($summary['total_cost'], 0, ',', '.') }}</p>
            <p class="text-xs text-slate-400 mt-1">Harga beli produk</p>
        </div>

        <div class="bg-white dark:bg-slate-900 rounded-3xl p-6 border border-slate-200 dark:border-slate-800 shadow-soft">
            <p class="text-xs font-semibold text-slate-500 uppercase">LABA BERSIH</p>
            <p class="text-3xl font-bold text-emerald-600 mt-2">Rp {{ number_format($summary['total_profit'], 0, ',', '.') }}</p>
            <p class="text-xs text-emerald-600 mt-1 font-semibold">Margin: {{ $summary['margin'] }}%</p>
        </div>

        <div class="bg-white dark:bg-slate-900 rounded-3xl p-6 border border-slate-200 dark:border-slate-800 shadow-soft">
            <p class="text-xs font-semibold text-slate-500 uppercase">TRANSAKSI</p>
            <p class="text-3xl font-bold text-slate-900 dark:text-white mt-2">{{ $summary['count'] }}</p>
            <p class="text-xs text-slate-400 mt-1">Total transaksi</p>
        </div>
    </div>

    <!-- Content Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Top Products -->
        <div class="bg-white dark:bg-slate-900 rounded-3xl border border-slate-200 dark:border-slate-800 shadow-soft overflow-hidden">
            <div class="px-6 py-4 border-b border-slate-100 dark:border-slate-800">
                <h3 class="text-lg font-bold text-slate-900 dark:text-white">🏆 Produk Terlaris</h3>
            </div>
            <div class="divide-y divide-slate-100 dark:divide-slate-800">
                @forelse($topProducts as $product)
                <div class="px-6 py-4">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-cyan-500 to-blue-600 flex items-center justify-center text-white font-bold">
                                {{ substr($product->name, 0, 1) }}
                            </div>
                            <div>
                                <p class="font-semibold text-sm text-slate-900 dark:text-white">{{ $product->name }}</p>
                            </div>
                        </div>
                        <p class="text-sm font-bold text-emerald-600">Rp {{ number_format($product->total_profit, 0, ',', '.') }}</p>
                    </div>
                </div>
                @empty
                <div class="px-6 py-12 text-center text-slate-400 text-sm">Belum ada data</div>
                @endforelse
            </div>
        </div>

        <!-- Transactions Table -->
        <div class="lg:col-span-2 bg-white dark:bg-slate-900 rounded-3xl border border-slate-200 dark:border-slate-800 shadow-soft overflow-hidden">
            <div class="px-6 py-4 border-b border-slate-100 dark:border-slate-800">
                <h3 class="text-lg font-bold text-slate-900 dark:text-white">📋 Riwayat Transaksi</h3>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm">
                    <thead class="bg-slate-50 dark:bg-slate-800/50 text-slate-500">
                        <tr>
                            <th class="px-6 py-3 font-semibold">ID</th>
                            <th class="px-6 py-3 font-semibold">Waktu</th>
                            <th class="px-6 py-3 font-semibold text-right">Total</th>
                            <th class="px-6 py-3 font-semibold text-right">Profit</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 dark:divide-slate-800">
                        @forelse($transactions as $trx)
                        <tr class="hover:bg-slate-50 dark:hover:bg-slate-800/50">
                            <td class="px-6 py-4 font-mono text-slate-900 dark:text-white">#{{ str_pad($trx->id, 5, '0', STR_PAD_LEFT) }}</td>
                            <td class="px-6 py-4 text-slate-600 dark:text-slate-400">{{ $trx->created_at->format('d M Y, H:i') }}</td>
                            <td class="px-6 py-4 text-right font-semibold text-slate-900 dark:text-white">Rp {{ number_format($trx->total_amount, 0, ',', '.') }}</td>
                            <td class="px-6 py-4 text-right font-bold text-emerald-600">
                                +Rp {{ number_format($trx->transactionItems->sum('profit'), 0, ',', '.') }}
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="px-6 py-12 text-center text-slate-400">
                                Belum ada transaksi di periode {{ $title }}
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            @if($transactions->hasPages())
            <div class="px-6 py-4 border-t border-slate-200 dark:border-slate-800 bg-slate-50 dark:bg-slate-800/30">
                {{ $transactions->links() }}
            </div>
            @endif
        </div>
    </div>
</div>
@endsection