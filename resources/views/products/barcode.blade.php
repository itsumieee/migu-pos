@extends('layouts.app')

@section('page-title', 'Cetak Barcode - ' . $product->name)

@section('content')
<div class="max-w-4xl mx-auto fade-in">
    <div class="mb-6 flex items-center justify-between">
        <div class="flex items-center gap-4">
            <a href="{{ route('products.index') }}" class="p-2 rounded-xl bg-slate-100 dark:bg-slate-800 text-slate-600 dark:text-slate-400 hover:bg-slate-200 dark:hover:bg-slate-700 smooth">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
            </a>
            <div>
                <h1 class="text-2xl font-bold text-slate-900 dark:text-white">Barcode Produk</h1>
                <p class="text-sm text-slate-500 dark:text-slate-400">{{ $product->name }}</p>
            </div>
        </div>
        <button onclick="window.print()" class="px-6 py-3 gradient-primary text-white rounded-xl font-semibold shadow-lg shadow-cyan-500/30 hover:shadow-cyan-500/50 smooth">
            🖨️ Cetak Barcode
        </button>
    </div>

    <div class="bg-white dark:bg-slate-900 rounded-3xl border border-slate-200 dark:border-slate-800 shadow-soft p-8">
        <div class="grid grid-cols-2 md:grid-cols-3 gap-6">
            @for($i = 0; $i < 6; $i++)
            <div class="border-2 border-slate-200 dark:border-slate-700 rounded-2xl p-4 text-center no-print">
                <!-- Barcode Image -->
                <div class="mb-3">
                    {!! DNS1D::getBarcodeHTML($product->sku, 'C128', 2, 50) !!}
                </div>
                
                <!-- Product Info -->
                <p class="font-bold text-slate-900 dark:text-white text-sm mb-1">{{ $product->name }}</p>
                <p class="text-xs text-slate-500 dark:text-slate-400 mb-2">SKU: {{ $product->sku }}</p>
                <p class="text-lg font-bold text-cyan-600 dark:text-cyan-400">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
            </div>
            @endfor
        </div>

        <!-- Print Version (Hidden on Screen) -->
        <div class="hidden print:block">
            <div class="grid grid-cols-3 gap-4">
                @for($i = 0; $i < 12; $i++)
                <div class="border border-slate-300 rounded-lg p-3 text-center" style="page-break-inside: avoid;">
                    {!! DNS1D::getBarcodeHTML($product->sku, 'C128', 1.5, 40) !!}
                    <p class="font-bold text-xs mt-2">{{ $product->name }}</p>
                    <p class="text-xs text-slate-600">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                </div>
                @endfor
            </div>
        </div>
    </div>
</div>

<style>
@media print {
    .no-print { display: none !important; }
    .print\\:block { display: block !important; }
    body * { visibility: hidden; }
    .print\\:block, .print\\:block * { visibility: visible; }
    .print\\:block { position: absolute; left: 0; top: 0; width: 100%; }
}
</style>
@endsection