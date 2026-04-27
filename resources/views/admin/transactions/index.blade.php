@extends('layouts.app')

@section('page-title', 'Transaksi')

@section('content')
<div class="flex justify-between items-center mb-6">
    <h2 class="text-2xl font-bold text-white">Daftar Transaksi</h2>
    <div class="flex gap-3">
        <button onclick="document.getElementById('dateFilterModal').classList.remove('hidden')" 
                class="px-4 py-2 bg-amber-500 hover:bg-amber-600 text-white rounded-lg text-sm font-semibold flex items-center gap-2 transition">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
            </svg>
            Export by Date
        </button>
        <a href="{{ route('transactions.export.pdf') }}" class="px-4 py-2 bg-rose-500 hover:bg-rose-600 text-white rounded-lg text-sm font-semibold flex items-center gap-2 transition">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
            </svg>
            Export PDF
        </a>
    </div>
</div>

<!-- Table Transactions -->
<div class="bg-white dark:bg-slate-900 rounded-2xl border border-slate-200 dark:border-slate-800 overflow-hidden">
    <table class="w-full">
        <thead class="bg-slate-50 dark:bg-slate-800 border-b border-slate-200 dark:border-slate-700">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase">No</th>
                <th class="px-6 py-3 text-left text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase">No. Transaksi</th>
                <th class="px-6 py-3 text-left text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase">Tanggal</th>
                <th class="px-6 py-3 text-left text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase">Kasir</th>
                <th class="px-6 py-3 text-right text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase">Total</th>
                <th class="px-6 py-3 text-center text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase">Aksi</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-slate-200 dark:divide-slate-700">
            @foreach($transactions as $index => $trx)
            <tr class="hover:bg-slate-50 dark:hover:bg-slate-800/50">
                <td class="px-6 py-4 text-sm text-slate-600 dark:text-slate-400">{{ $transactions->firstItem() + $index }}</td>
                <td class="px-6 py-4 text-sm font-medium text-white">#{{ str_pad($trx->id, 5, '0', STR_PAD_LEFT) }}</td>
                <td class="px-6 py-4 text-sm text-slate-600 dark:text-slate-400">{{ $trx->created_at->format('d/m/Y H:i') }}</td>
                <td class="px-6 py-4 text-sm text-slate-600 dark:text-slate-400">{{ $trx->user->name ?? '-' }}</td>
                <td class="px-6 py-4 text-sm font-bold text-cyan-400 text-right">Rp {{ number_format($trx->total_amount, 0, ',', '.') }}</td>
                <td class="px-6 py-4 text-center">
                    <a href="#" class="text-cyan-400 hover:text-cyan-300 text-xs font-medium">Detail</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="px-6 py-4 border-t border-slate-200 dark:border-slate-800">
        {{ $transactions->links() }}
    </div>
</div>

<!-- Modal Date Filter -->
<div id="dateFilterModal" class="hidden fixed inset-0 z-50 flex items-center justify-center bg-black/60 backdrop-blur-sm">
    <div class="bg-white dark:bg-slate-900 rounded-2xl p-6 w-full max-w-md mx-4 border border-slate-200 dark:border-slate-700">
        <h3 class="text-lg font-bold text-white mb-4">Export Transaksi Berdasarkan Tanggal</h3>
        <form action="{{ route('transactions.export.pdf.bydate') }}" method="POST">
            @csrf
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-slate-300 mb-2">Tanggal Mulai</label>
                    <input type="date" name="start_date" required class="w-full px-4 py-2 bg-slate-800 border border-slate-700 rounded-lg text-white outline-none focus:border-cyan-500">
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-300 mb-2">Tanggal Akhir</label>
                    <input type="date" name="end_date" required class="w-full px-4 py-2 bg-slate-800 border border-slate-700 rounded-lg text-white outline-none focus:border-cyan-500">
                </div>
            </div>
            <div class="flex gap-3 mt-6">
                <button type="button" onclick="document.getElementById('dateFilterModal').classList.add('hidden')" 
                        class="flex-1 px-4 py-2 bg-slate-700 hover:bg-slate-600 text-white rounded-lg text-sm font-semibold transition">
                    Batal
                </button>
                <button type="submit" class="flex-1 px-4 py-2 bg-cyan-500 hover:bg-cyan-600 text-white rounded-lg text-sm font-semibold transition">
                    Export PDF
                </button>
            </div>
        </form>
    </div>
</div>
@endsection