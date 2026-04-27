@extends('layouts.app')

@section('page-title', 'Tambah Produk')

@section('content')
<div class="max-w-3xl mx-auto fade-in">
    <div class="mb-6 flex items-center gap-4">
        <a href="{{ route('products.index') }}" class="p-2 rounded-xl bg-slate-100 dark:bg-slate-800 text-slate-600 dark:text-slate-400 hover:bg-slate-200 dark:hover:bg-slate-700 smooth">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
        </a>
        <div>
            <h1 class="text-2xl font-bold text-slate-900 dark:text-white">Tambah Produk Baru</h1>
            <p class="text-sm text-slate-500 dark:text-slate-400">Isi detail produk dengan lengkap</p>
        </div>
    </div>

    <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data" class="bg-white dark:bg-slate-900 rounded-3xl border border-slate-200 dark:border-slate-800 shadow-soft p-6 lg:p-8 space-y-6">
        @csrf
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="md:col-span-2">
                <label class="block text-sm font-semibold text-slate-900 dark:text-white mb-2">Nama Produk <span class="text-rose-500">*</span></label>
                <input type="text" name="name" value="{{ old('name') }}" required class="w-full px-4 py-3 bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-xl focus:ring-2 focus:ring-cyan-500/20 focus:border-cyan-500 outline-none smooth dark:text-white">
            </div>
            <div>
                <label class="block text-sm font-semibold text-slate-900 dark:text-white mb-2">Kategori <span class="text-rose-500">*</span></label>
                <select name="category_id" required class="w-full px-4 py-3 bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-xl focus:ring-2 focus:ring-cyan-500/20 focus:border-cyan-500 outline-none smooth dark:text-white">
                    <option value="">Pilih Kategori</option>
                    @foreach($categories as $cat)
                    <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block text-sm font-semibold text-slate-900 dark:text-white mb-2">SKU <span class="text-rose-500">*</span></label>
                <input type="text" name="sku" value="{{ old('sku') }}" required class="w-full px-4 py-3 bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-xl focus:ring-2 focus:ring-cyan-500/20 focus:border-cyan-500 outline-none smooth dark:text-white font-mono">
            </div>
            <div>
                <label class="block text-sm font-semibold text-slate-900 dark:text-white mb-2">Harga Jual (Rp) <span class="text-rose-500">*</span></label>
                <input type="number" name="price" value="{{ old('price') }}" required min="0" class="w-full px-4 py-3 bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-xl focus:ring-2 focus:ring-cyan-500/20 focus:border-cyan-500 outline-none smooth dark:text-white">
            </div>
            <div>
                <label class="block text-sm font-semibold text-slate-900 dark:text-white mb-2">Harga Modal/Beli (Rp) <span class="text-rose-500">*</span></label>
                <input type="number" name="cost_price" value="{{ old('cost_price', 0) }}" required min="0" class="w-full px-4 py-3 bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-xl focus:ring-2 focus:ring-cyan-500/20 focus:border-cyan-500 outline-none smooth dark:text-white">
                <p class="text-xs text-slate-500 dark:text-slate-400 mt-1">Harga beli dari supplier</p>
            </div>
            <div>
                <label class="block text-sm font-semibold text-slate-900 dark:text-white mb-2">Stok Awal <span class="text-rose-500">*</span></label>
                <input type="number" name="stock" value="{{ old('stock', 0) }}" required min="0" class="w-full px-4 py-3 bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-xl focus:ring-2 focus:ring-cyan-500/20 focus:border-cyan-500 outline-none smooth dark:text-white">
            </div>
            <div class="md:col-span-2">
                <label class="block text-sm font-semibold text-slate-900 dark:text-white mb-2">Gambar Produk</label>
                <div class="flex items-center gap-4">
                    <div class="w-24 h-24 rounded-2xl bg-slate-100 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 flex items-center justify-center overflow-hidden shrink-0">
                        <img id="preview-image" src="#" class="w-full h-full object-cover hidden">
                        <svg id="placeholder-icon" class="w-8 h-8 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                    </div>
                    <div class="flex-1">
                        <input type="file" name="image" accept="image/*" onchange="previewFile(this)" class="block w-full text-sm text-slate-500 dark:text-slate-400 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-sm file:font-semibold file:bg-cyan-50 file:text-cyan-700 hover:file:bg-cyan-100 dark:file:bg-cyan-900/30 dark:file:text-cyan-400 cursor-pointer">
                        <p class="text-xs text-slate-500 dark:text-slate-400 mt-1">PNG, JPG, WEBP hingga 2MB</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="flex justify-end gap-3 pt-6 border-t border-slate-200 dark:border-slate-800">
            <a href="{{ route('products.index') }}" class="px-6 py-3 bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 text-slate-700 dark:text-slate-300 rounded-xl font-semibold hover:bg-slate-50 dark:hover:bg-slate-700 smooth">Batal</a>
            <button type="submit" class="px-8 py-3 gradient-primary text-white rounded-xl font-semibold shadow-lg shadow-cyan-500/30 hover:shadow-cyan-500/50 smooth active:scale-95">Simpan Produk</button>
        </div>
    </form>
</div>

<script>
function previewFile(input) {
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('preview-image').src = e.target.result;
            document.getElementById('preview-image').classList.remove('hidden');
            document.getElementById('placeholder-icon').classList.add('hidden');
        }
        reader.readAsDataURL(input.files[0]);
    }
}
</script>
@endsection