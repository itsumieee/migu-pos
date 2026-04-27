@extends('layouts.app')

@section('page-title', 'Cetak Barcode Produk')

@section('content')
<div class="max-w-6xl mx-auto fade-in">
    <div class="mb-6 flex items-center justify-between">
        <div class="flex items-center gap-4">
            <a href="{{ route('products.index') }}" class="p-2 rounded-xl bg-slate-100 dark:bg-slate-800 text-slate-600 dark:text-slate-400 hover:bg-slate-200 dark:hover:bg-slate-700 smooth">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
            </a>
            <div>
                <h1 class="text-2xl font-bold text-slate-900 dark:text-white">Cetak Barcode</h1>
                <p class="text-sm text-slate-500 dark:text-slate-400">{{ $products->count() }} produk terpilih</p>
            </div>
        </div>
        <button onclick="window.print()" class="px-6 py-3 gradient-primary text-white rounded-xl font-semibold shadow-lg shadow-cyan-500/30 hover:shadow-cyan-500/50 smooth">
            🖨️ Cetak Semua
        </button>
    </div>

    <div class="bg-white dark:bg-slate-900 rounded-3xl border border-slate-200 dark:border-slate-800 shadow-soft p-8">
        <!-- Print Version -->
        <div class="grid grid-cols-4 gap-3">
            @foreach($products as $product)
                @for($i = 0; $i < 3; $i++)
                <div class="border border-slate-300 rounded-lg p-2 text-center" style="page-break-inside: avoid;">
                    <div class="mb-1" style="display: flex; justify-content: center;">
                        {!! DNS1D::getBarcodeHTML($product->sku, 'C128', 1, 40) !!}
                    </div>
                    <p class="font-bold text-xs text-slate-900 dark:text-white truncate">{{ $product->name }}</p>
                    <p class="text-[10px] text-slate-600 dark:text-slate-400">{{ $product->sku }}</p>
                    <p class="text-xs font-bold text-cyan-600 dark:text-cyan-400">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                </div>
                @endfor
            @endforeach
        </div>

        <!-- Screen Preview (Hidden on Print) -->
        <div class="no-print mt-6 pt-6 border-t border-slate-200 dark:border-slate-700">
            <h3 class="text-lg font-bold text-slate-900 dark:text-white mb-4">Preview Cetak</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                @foreach($products as $product)
                <div class="bg-slate-50 dark:bg-slate-800 rounded-xl border border-slate-200 dark:border-slate-700 p-4 text-center">
                    <div class="mb-2">
                        {!! DNS1D::getBarcodeHTML($product->sku, 'C128', 1.2, 35) !!}
                    </div>
                    <p class="font-bold text-sm text-slate-900 dark:text-white truncate">{{ $product->name }}</p>
                    <p class="text-xs text-slate-500 dark:text-slate-400 mb-2">{{ $product->sku }}</p>
                    <p class="text-cyan-600 dark:text-cyan-400 font-bold">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

<style media="print">
    body {
        background: white;
    }
    .no-print {
        display: none !important;
    }
</style>
@endsection
