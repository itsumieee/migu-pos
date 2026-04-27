@extends('layouts.app')

@section('page-title', 'Kategori')

@section('content')
<div class="max-w-4xl mx-auto space-y-5">
    <div class="flex justify-between items-center">
        <div>
            <h1 class="text-xl font-bold text-slate-900 dark:text-white">Kategori Produk</h1>
            <p class="text-sm text-slate-500 dark:text-slate-400 mt-0.5">Kelompokkan barang agar lebih rapi</p>
        </div>
        <button onclick="document.getElementById('catModal').showModal()" class="flex items-center gap-2 px-4 py-2.5 bg-cyan-500 hover:bg-cyan-600 text-white rounded-lg text-sm font-medium smooth shadow-lg shadow-cyan-500/30 active:scale-95">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
            Tambah Kategori
        </button>
    </div>

    <div class="bg-white dark:bg-slate-900 rounded-xl border border-slate-200 dark:border-slate-800 shadow-lg dark-transition overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left">
                <thead class="bg-slate-50 dark:bg-slate-800/50 text-slate-500 dark:text-slate-400 uppercase text-xs font-semibold">
                    <tr><th class="px-6 py-3.5 border-b border-slate-200 dark:border-slate-700">Nama Kategori</th><th class="px-6 py-3.5 border-b border-slate-200 dark:border-slate-700">Jumlah Produk</th><th class="px-6 py-3.5 border-b border-slate-200 dark:border-slate-700 text-right">Aksi</th></tr>
                </thead>
                <tbody class="divide-y divide-slate-100 dark:divide-slate-800">
                    @foreach($categories as $cat)
                    <tr class="hover:bg-slate-50 dark:hover:bg-slate-800/30 smooth">
                        <td class="px-6 py-4 font-medium text-slate-900 dark:text-white">{{ $cat->name }}</td>
                        <td class="px-6 py-4"><span class="px-2.5 py-1 rounded-lg bg-cyan-50 dark:bg-cyan-900/30 text-cyan-700 dark:text-cyan-400 text-xs font-bold border border-cyan-200 dark:border-cyan-800">{{ $cat->products_count }} item</span></td>
                        <td class="px-6 py-4 text-right">
                            <form action="{{ route('categories.destroy', $cat) }}" method="POST" onsubmit="return confirm('Hapus kategori ini?')" class="inline">
                                @csrf @method('DELETE')
                                <button class="text-rose-600 dark:text-rose-400 hover:text-rose-700 dark:hover:text-rose-300 text-sm font-medium px-3 py-1.5 rounded-lg hover:bg-rose-50 dark:hover:bg-rose-900/30 smooth">Hapus</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="px-6 py-4 border-t border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-800/30">{{ $categories->links() }}</div>
    </div>
</div>

<dialog id="catModal" class="p-0 rounded-xl backdrop:bg-black/50 w-full max-w-md bg-transparent">
    <div class="bg-white dark:bg-slate-900 p-6 rounded-xl border border-slate-200 dark:border-slate-800 shadow-2xl dark-transition">
        <h3 class="text-base font-bold text-slate-900 dark:text-white mb-1">Tambah Kategori Baru</h3>
        <p class="text-sm text-slate-500 dark:text-slate-400 mb-5">Nama akan otomatis dibuatkan slug unik</p>
        <form action="{{ route('categories.store') }}" method="POST" class="space-y-4">
            @csrf
            <input type="text" name="name" placeholder="Contoh: Kaos, Hoodie, Celana..." required class="w-full px-4 py-2.5 bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-lg focus:ring-2 focus:ring-cyan-500/20 focus:border-cyan-500 outline-none smooth dark:text-white">
            <div class="flex justify-end gap-3 pt-2">
                <button type="button" onclick="document.getElementById('catModal').close()" class="px-4 py-2.5 bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 text-slate-700 dark:text-slate-300 rounded-lg text-sm font-medium hover:bg-slate-50 dark:hover:bg-slate-700 smooth">Batal</button>
                <button type="submit" class="px-5 py-2.5 bg-cyan-500 hover:bg-cyan-600 text-white rounded-lg text-sm font-semibold smooth active:scale-95">Simpan</button>
            </div>
        </form>
    </div>
</dialog>
@endsection