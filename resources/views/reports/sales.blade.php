@extends('layouts.app')

@section('page-title', 'Laporan Penjualan')

@section('content')
<div class="space-y-6 fade-in">
    <!-- Header -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
        <div>
            <h1 class="text-2xl font-bold text-slate-900 dark:text-white">Laporan Penjualan</h1>
            <p class="text-sm text-slate-500 dark:text-slate-400 mt-0.5">Analisis pendapatan toko</p>
        </div>
        <div class="flex bg-slate-100 dark:bg-slate-800 p-1 rounded-xl">
            <a href="?type=daily" class="px-4 py-2 rounded-lg text-sm font-semibold smooth {{ request('type') === 'daily' ? 'bg-white dark:bg-slate-700 text-cyan-600 dark:text-cyan-400 shadow-sm' : 'text-slate-500 dark:text-slate-400' }}">Harian</a>
            <a href="?type=monthly" class="px-4 py-2 rounded-lg text-sm font-semibold smooth {{ request('type') !== 'daily' ? 'bg-white dark:bg-slate-700 text-cyan-600 dark:text-cyan-400 shadow-sm' : 'text-slate-500 dark:text-slate-400' }}">Bulanan</a>
        </div>
        <a href="{{ route('reports.export') }}" class="flex items-center gap-2 px-4 py-2 bg-emerald-500 text-white rounded-xl text-sm font-semibold hover:bg-emerald-600 smooth shadow-lg shadow-emerald-500/30">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
            Export CSV
        </a>
    </div>

    <!-- Table -->
    <div class="bg-white dark:bg-slate-900 rounded-3xl border border-slate-200 dark:border-slate-800 shadow-soft overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead class="bg-slate-50 dark:bg-slate-800/50 border-b border-slate-200 dark:border-slate-800">
                    <tr>
                        <th class="px-6 py-4 text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Periode</th>
                        <th class="px-6 py-4 text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Jumlah Transaksi</th>
                        <th class="px-6 py-4 text-right text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Total Pendapatan</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 dark:divide-slate-800">
                    @forelse($data as $d)
                    <tr class="hover:bg-slate-50 dark:hover:bg-slate-800/50 smooth transition-colors">
                        <td class="px-6 py-4 text-sm font-semibold text-slate-900 dark:text-white">{{ $d->period }}</td>
                        <td class="px-6 py-4">
                            <span class="px-3 py-1 rounded-lg bg-slate-100 dark:bg-slate-800 text-slate-600 dark:text-slate-400 text-xs font-bold">{{ $d->count }}x</span>
                        </td>
                        <td class="px-6 py-4 text-right">
                            <span class="text-sm font-bold text-emerald-600 dark:text-emerald-400">Rp {{ number_format($d->total, 0, ',', '.') }}</span>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="3" class="px-6 py-16 text-center text-slate-400">Belum ada data laporan.</td></tr>
                    @endforelse
                </tbody>
                @if($data->count() > 0)
                <tfoot class="bg-slate-50 dark:bg-slate-800/50 border-t border-slate-200 dark:border-slate-800">
                    <tr>
                        <td class="px-6 py-4 text-sm font-bold text-slate-900 dark:text-white">Total Keseluruhan</td>
                        <td></td>
                        <td class="px-6 py-4 text-right text-lg font-bold text-slate-900 dark:text-white">Rp {{ number_format($data->sum('total'), 0, ',', '.') }}</td>
                    </tr>
                </tfoot>
                @endif
            </table>
        </div>
    </div>
</div>
@endsection