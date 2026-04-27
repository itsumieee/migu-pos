@extends('layouts.app')

@section('page-title', 'Riwayat Transaksi')

@section('content')
<div class="space-y-6 fade-in">
    <!-- Header & Filter -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
        <div>
            <h1 class="text-2xl font-bold text-slate-900 dark:text-white">Riwayat Transaksi</h1>
            <p class="text-sm text-slate-500 dark:text-slate-400 mt-0.5">Data semua transaksi yang telah terjadi</p>
        </div>
        
        <form method="GET" class="flex gap-3 w-full md:w-auto">
            <input type="date" name="date" value="{{ request('date') }}" class="px-4 py-2.5 bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-xl text-sm focus:ring-2 focus:ring-cyan-500/20 focus:border-cyan-500 outline-none smooth dark:text-white shadow-soft">
            <button type="submit" class="px-5 py-2.5 gradient-primary text-white rounded-xl text-sm font-semibold shadow-lg shadow-cyan-500/30 hover:shadow-cyan-500/50 smooth active:scale-95">Filter</button>
        </form>
    </div>

    <!-- Table -->
    <div class="bg-white dark:bg-slate-900 rounded-3xl border border-slate-200 dark:border-slate-800 shadow-soft overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead class="bg-slate-50 dark:bg-slate-800/50 border-b border-slate-200 dark:border-slate-800">
                    <tr>
                        <th class="px-6 py-4 text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider">ID Transaksi</th>
                        <th class="px-6 py-4 text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Tanggal & Waktu</th>
                        <th class="px-6 py-4 text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Kasir</th>
                        <th class="px-6 py-4 text-right text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Total</th>
                        <th class="px-6 py-4 text-right text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 dark:divide-slate-800">
                    @forelse($transactions as $t)
                    <tr class="hover:bg-slate-50 dark:hover:bg-slate-800/50 smooth transition-colors">
                        <td class="px-6 py-4">
                            <a href="{{ route('transactions.show', $t) }}" class="font-mono text-sm font-bold text-slate-900 dark:text-white hover:text-cyan-600 dark:hover:text-cyan-400 smooth">#{{ str_pad($t->id, 5, '0', STR_PAD_LEFT) }}</a>
                        </td>
                        <td class="px-6 py-4">
                            <div class="text-sm text-slate-900 dark:text-white font-medium">{{ $t->created_at->format('d M Y') }}</div>
                            <div class="text-xs text-slate-500 dark:text-slate-400">{{ $t->created_at->format('H:i') }}</div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-2">
                                <div class="w-6 h-6 rounded-full bg-gradient-to-br from-slate-200 to-slate-300 dark:from-slate-700 dark:to-slate-600 flex items-center justify-center text-[10px] font-bold text-slate-600 dark:text-slate-300">
                                    {{ substr($t->user->name, 0, 1) }}
                                </div>
                                <span class="text-sm text-slate-600 dark:text-slate-300">{{ $t->user->name }}</span>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-right">
                            <span class="text-sm font-bold text-slate-900 dark:text-white">Rp {{ number_format($t->total_amount, 0, ',', '.') }}</span>
                        </td>
                        <td class="px-6 py-4 text-right">
                            <span class="px-3 py-1 rounded-full text-xs font-bold bg-emerald-50 dark:bg-emerald-900/30 text-emerald-600 dark:text-emerald-400 border border-emerald-200 dark:border-emerald-800">
                                Selesai
                            </span>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="5" class="px-6 py-16 text-center text-slate-400">Belum ada transaksi.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="px-6 py-4 border-t border-slate-200 dark:border-slate-800 bg-slate-50 dark:bg-slate-800/30">
            {{ $transactions->links() }}
        </div>
    </div>
</div>
@endsection