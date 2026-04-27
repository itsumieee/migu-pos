@extends('layouts.app')

@section('page-title', 'Jadwal Laporan Otomatis')

@section('content')
<div class="max-w-4xl mx-auto space-y-6 fade-in">
    <div class="flex justify-between items-center">
        <div>
            <h1 class="text-2xl font-bold text-slate-900 dark:text-white">Jadwal Laporan Otomatis</h1>
            <p class="text-sm text-slate-500 dark:text-slate-400 mt-1">Atur pengiriman laporan penjualan via WhatsApp</p>
        </div>
    </div>

    <!-- Notifikasi Sukses -->
    @if(session('success'))
    <div class="p-4 rounded-xl bg-emerald-50 dark:bg-emerald-900/30 border border-emerald-200 dark:border-emerald-800 text-emerald-700 dark:text-emerald-300 flex items-center gap-2">
        <span class="text-lg">✅</span> {{ session('success') }}
    </div>
    @endif

    <!-- Notifikasi Error -->
    @if(session('error'))
    <div class="p-4 rounded-xl bg-rose-50 dark:bg-rose-900/30 border border-rose-200 dark:border-rose-800 text-rose-700 dark:text-rose-300 flex items-center gap-2">
        <span class="text-lg">⚠️</span> {{ session('error') }}
    </div>
    @endif

    <!-- Form Tambah -->
    <div class="bg-white dark:bg-slate-900 rounded-3xl border border-slate-200 dark:border-slate-800 shadow-soft p-6" x-data="{ type: 'interval' }">
        <h3 class="text-lg font-bold text-slate-900 dark:text-white mb-4">Tambah Jadwal Baru</h3>
        <form action="{{ route('settings.reports.store') }}" method="POST" class="grid grid-cols-1 md:grid-cols-2 gap-4">
            @csrf
            <div class="md:col-span-2">
                <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Nama Jadwal</label>
                <input type="text" name="name" value="{{ old('name') }}" placeholder="e.g., Presentasi Sore" required class="w-full px-4 py-2.5 rounded-xl bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 focus:border-cyan-500 outline-none text-sm dark:text-white">
                @error('name') <span class="text-xs text-rose-500">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Tipe Jadwal</label>
                <select name="type" x-model="type" class="w-full px-4 py-2.5 rounded-xl bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 focus:border-cyan-500 outline-none text-sm dark:text-white">
                    <option value="interval">Interval (Menit)</option>
                    <option value="fixed">Waktu Tetap (Jam:Menit)</option>
                </select>
            </div>

            <div>
                <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Nomor WA Tujuan (Opsional)</label>
                <input type="text" name="phone_override" value="{{ old('phone_override') }}" placeholder="6281234567890" class="w-full px-4 py-2.5 rounded-xl bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 focus:border-cyan-500 outline-none text-sm dark:text-white">
            </div>

            <!-- Input Interval (Muncul jika tipe Interval) -->
            <div x-show="type === 'interval'" class="md:col-span-2">
                <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Interval (Menit)</label>
                <input type="number" name="value_interval" value="{{ old('value_interval') }}" placeholder="30" :required="type === 'interval'" class="w-full px-4 py-2.5 rounded-xl bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 focus:border-cyan-500 outline-none text-sm dark:text-white">
                @error('value_interval') <span class="text-xs text-rose-500">{{ $message }}</span> @enderror
                <p class="text-xs text-slate-500 mt-1">Laporan akan dikirim setiap X menit.</p>
            </div>

            <!-- Input Waktu Tetap (Muncul jika tipe Fixed) -->
            <div x-show="type === 'fixed'" class="md:col-span-2">
                <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Waktu (Jam:Menit)</label>
                <input type="time" name="value_fixed" value="{{ old('value_fixed') }}" :required="type === 'fixed'" class="w-full px-4 py-2.5 rounded-xl bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 focus:border-cyan-500 outline-none text-sm dark:text-white">
                @error('value_fixed') <span class="text-xs text-rose-500">{{ $message }}</span> @enderror
                <p class="text-xs text-slate-500 mt-1">Laporan akan dikirim setiap hari pada jam ini.</p>
            </div>

            <div class="md:col-span-2 flex items-center justify-between pt-4 border-t border-slate-200 dark:border-slate-800">
                <label class="flex items-center gap-2 cursor-pointer">
                    <input type="hidden" name="is_active" value="0">
                    <input type="checkbox" name="is_active" value="1" checked class="w-4 h-4 rounded text-cyan-500 focus:ring-cyan-500">
                    <span class="text-sm text-slate-700 dark:text-slate-300 font-medium">Aktifkan Jadwal</span>
                </label>
                <button type="submit" class="px-6 py-2.5 gradient-primary text-white rounded-xl text-sm font-semibold shadow-lg hover:shadow-cyan-500/50 smooth">Simpan Jadwal</button>
            </div>
        </form>
    </div>

    <!-- List Jadwal -->
    <div class="bg-white dark:bg-slate-900 rounded-3xl border border-slate-200 dark:border-slate-800 shadow-soft overflow-hidden">
        <div class="px-6 py-4 border-b border-slate-200 dark:border-slate-800">
            <h3 class="font-bold text-slate-900 dark:text-white">Daftar Jadwal Aktif</h3>
        </div>
        <table class="w-full text-left">
            <thead class="bg-slate-50 dark:bg-slate-800/50 text-xs uppercase text-slate-500 dark:text-slate-400">
                <tr>
                    <th class="px-6 py-3">Nama</th>
                    <th class="px-6 py-3">Tipe</th>
                    <th class="px-6 py-3">Nilai</th>
                    <th class="px-6 py-3">Status</th>
                    <th class="px-6 py-3 text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100 dark:divide-slate-800">
                @forelse($schedules as $s)
                <tr class="hover:bg-slate-50 dark:hover:bg-slate-800/50">
                    <td class="px-6 py-4 font-medium text-slate-900 dark:text-white">{{ $s->name }}</td>
                    <td class="px-6 py-4 text-sm text-slate-600 dark:text-slate-400">
                        {{ $s->type === 'interval' ? '⏱️ Interval' : '⏰ Tetap' }}
                    </td>
                    <td class="px-6 py-4 text-sm font-mono text-slate-900 dark:text-white font-bold">
                        {{ $s->type === 'interval' ? $s->value . ' Menit' : $s->value . ' WIB' }}
                    </td>
                    <td class="px-6 py-4">
                        <span class="px-2 py-1 rounded-lg text-xs font-bold {{ $s->is_active ? 'bg-emerald-50 dark:bg-emerald-900/30 text-emerald-600' : 'bg-slate-100 dark:bg-slate-800 text-slate-500' }}">
                            {{ $s->is_active ? 'AKTIF' : 'NONAKTIF' }}
                        </span>
                    </td>
                    <td class="px-6 py-4 text-right">
                        <form action="{{ route('settings.reports.destroy', $s) }}" method="POST" onsubmit="return confirm('Yakin hapus jadwal ini?')">
                            @csrf @method('DELETE')
                            <button class="p-2 rounded-lg hover:bg-rose-50 dark:hover:bg-rose-900/30 text-rose-500 smooth">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-6 py-12 text-center text-slate-400">
                        <p class="mb-2">📭 Belum ada jadwal laporan.</p>
                        <p class="text-xs">Tambahkan jadwal baru di form atas.</p>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection