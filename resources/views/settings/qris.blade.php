@extends('layouts.app')

@section('page-title', 'Pengaturan QRIS')

@section('content')
<div class="max-w-3xl mx-auto space-y-5">
    <div>
        <h1 class="text-xl font-bold text-slate-900 dark:text-white">Pengaturan QRIS</h1>
        <p class="text-sm text-slate-500 dark:text-slate-400 mt-0.5">Upload dan kelola QR Code pembayaran Anda</p>
    </div>

    <div class="bg-white dark:bg-slate-900 rounded-xl border border-slate-200 dark:border-slate-800 shadow-lg dark-transition overflow-hidden">
        <div class="p-6 border-b border-slate-100 dark:border-slate-800">
            <h3 class="text-base font-bold text-slate-900 dark:text-white mb-1">Upload QR Code</h3>
            <p class="text-sm text-slate-500 dark:text-slate-400">Format: PNG, JPG, Maksimal 2MB</p>
        </div>
        
        <form action="{{ route('settings.update.qris') }}" method="POST" enctype="multipart/form-data" class="p-6 space-y-5">
            @csrf
            
            <!-- Current QR Preview -->
            <div>
                <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">QR Code Saat Ini</label>
                <div class="flex items-center gap-4">
                    @if(setting('qris_image'))
                        <img src="{{ imageUrl(setting('qris_image')) }}" alt="Current QRIS" class="w-32 h-32 rounded-lg border border-slate-200 dark:border-slate-700 object-cover">
                    @else
                        <div class="w-32 h-32 rounded-lg border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-800 flex items-center justify-center">
                            <div class="text-center">
                                <svg class="w-8 h-8 text-slate-300 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm12 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z"/></svg>
                                <p class="text-xs text-slate-400">Belum ada</p>
                            </div>
                        </div>
                    @endif
                    <div class="flex-1">
                        <p class="text-sm text-slate-600 dark:text-slate-400">QR Code ini akan ditampilkan saat pelanggan memilih metode pembayaran QRIS</p>
                    </div>
                </div>
            </div>

            <!-- Upload New QR -->
            <div>
                <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">Upload QR Code Baru</label>
                <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-slate-200 dark:border-slate-700 border-dashed rounded-lg hover:border-cyan-400 hover:bg-cyan-50 dark:hover:bg-cyan-900/10 smooth bg-slate-50 dark:bg-slate-800/30">
                    <div class="space-y-1 text-center">
                        <svg class="mx-auto h-10 w-10 text-slate-400" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                            <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                        <div class="flex text-sm text-slate-500 dark:text-slate-400 justify-center">
                            <label for="qris-upload" class="relative cursor-pointer rounded-md font-medium text-cyan-600 hover:text-cyan-500">
                                <span>Upload file</span>
                                <input id="qris-upload" name="qris_image" type="file" class="sr-only" accept="image/*">
                            </label>
                            <p class="pl-1">atau drag & drop</p>
                        </div>
                        <p class="text-xs text-slate-400">PNG, JPG hingga 2MB</p>
                    </div>
                </div>
                @error('qris_image')
                    <p class="mt-2 text-sm text-rose-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex justify-end gap-3 pt-4 border-t border-slate-200 dark:border-slate-700">
                <a href="{{ route('dashboard') }}" class="px-5 py-2.5 bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 text-slate-700 dark:text-slate-300 rounded-lg text-sm font-medium hover:bg-slate-50 dark:hover:bg-slate-700 smooth">Batal</a>
                <button type="submit" class="px-6 py-2.5 bg-cyan-500 hover:bg-cyan-600 text-white rounded-lg text-sm font-semibold smooth active:scale-95 shadow-lg shadow-cyan-500/30">
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection