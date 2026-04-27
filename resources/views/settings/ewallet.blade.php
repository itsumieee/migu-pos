@extends('layouts.app')

@section('page-title', 'Pengaturan E-Wallet')

@section('content')
<div class="max-w-4xl mx-auto space-y-5">
    <div>
        <h1 class="text-xl font-bold text-slate-900 dark:text-white">Pengaturan E-Wallet</h1>
        <p class="text-sm text-slate-500 dark:text-slate-400 mt-0.5">Kelola nomor akun dan instruksi pembayaran untuk setiap e-wallet</p>
    </div>

    <div class="bg-white dark:bg-slate-900 rounded-xl border border-slate-200 dark:border-slate-800 shadow-lg dark-transition overflow-hidden">
        <form action="{{ route('settings.update.ewallet') }}" method="POST" class="divide-y divide-slate-200 dark:divide-slate-800">
            @csrf
            
            <!-- DANA -->
            <div class="p-6">
                <div class="flex items-center gap-3 mb-4">
                    <div class="w-10 h-10 rounded-lg flex items-center justify-center text-white font-bold" style="background:#118EEA;">D</div>
                    <div>
                        <h3 class="text-base font-bold text-slate-900 dark:text-white">DANA</h3>
                        <p class="text-sm text-slate-500 dark:text-slate-400">Pengaturan akun DANA</p>
                    </div>
                </div>
                
                <div class="space-y-4">
                    <div>
                        <label for="ewallet_dana_number" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Nomor DANA</label>
                        <input type="text" id="ewallet_dana_number" name="ewallet_dana_number" 
                            value="{{ setting('ewallet_dana_number') }}" 
                            placeholder="Contoh: 081234567890"
                            class="w-full px-4 py-2 rounded-lg border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-800 text-slate-900 dark:text-white placeholder-slate-400 dark:placeholder-slate-500">
                    </div>
                    <div>
                        <label for="ewallet_dana_description" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Instruksi Pembayaran</label>
                        <textarea id="ewallet_dana_description" name="ewallet_dana_description" 
                            rows="2"
                            placeholder="Contoh: Transfer ke nomor di atas"
                            class="w-full px-4 py-2 rounded-lg border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-800 text-slate-900 dark:text-white placeholder-slate-400 dark:placeholder-slate-500">{{ setting('ewallet_dana_description') }}</textarea>
                    </div>
                </div>
            </div>

            <!-- GoPay -->
            <div class="p-6">
                <div class="flex items-center gap-3 mb-4">
                    <div class="w-10 h-10 rounded-lg flex items-center justify-center text-white font-bold" style="background:#00AA13;">G</div>
                    <div>
                        <h3 class="text-base font-bold text-slate-900 dark:text-white">GoPay</h3>
                        <p class="text-sm text-slate-500 dark:text-slate-400">Pengaturan akun GoPay</p>
                    </div>
                </div>
                
                <div class="space-y-4">
                    <div>
                        <label for="ewallet_gopay_number" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Nomor GoPay</label>
                        <input type="text" id="ewallet_gopay_number" name="ewallet_gopay_number" 
                            value="{{ setting('ewallet_gopay_number') }}" 
                            placeholder="Contoh: 081234567890"
                            class="w-full px-4 py-2 rounded-lg border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-800 text-slate-900 dark:text-white placeholder-slate-400 dark:placeholder-slate-500">
                    </div>
                    <div>
                        <label for="ewallet_gopay_description" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Instruksi Pembayaran</label>
                        <textarea id="ewallet_gopay_description" name="ewallet_gopay_description" 
                            rows="2"
                            placeholder="Contoh: Scan barcode atau input nomor di atas"
                            class="w-full px-4 py-2 rounded-lg border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-800 text-slate-900 dark:text-white placeholder-slate-400 dark:placeholder-slate-500">{{ setting('ewallet_gopay_description') }}</textarea>
                    </div>
                </div>
            </div>

            <!-- OVO -->
            <div class="p-6">
                <div class="flex items-center gap-3 mb-4">
                    <div class="w-10 h-10 rounded-lg flex items-center justify-center text-white font-bold" style="background:#4C3494;">O</div>
                    <div>
                        <h3 class="text-base font-bold text-slate-900 dark:text-white">OVO</h3>
                        <p class="text-sm text-slate-500 dark:text-slate-400">Pengaturan akun OVO</p>
                    </div>
                </div>
                
                <div class="space-y-4">
                    <div>
                        <label for="ewallet_ovo_number" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Nomor OVO</label>
                        <input type="text" id="ewallet_ovo_number" name="ewallet_ovo_number" 
                            value="{{ setting('ewallet_ovo_number') }}" 
                            placeholder="Contoh: 081234567890"
                            class="w-full px-4 py-2 rounded-lg border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-800 text-slate-900 dark:text-white placeholder-slate-400 dark:placeholder-slate-500">
                    </div>
                    <div>
                        <label for="ewallet_ovo_description" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Instruksi Pembayaran</label>
                        <textarea id="ewallet_ovo_description" name="ewallet_ovo_description" 
                            rows="2"
                            placeholder="Contoh: Gunakan fitur Send Money"
                            class="w-full px-4 py-2 rounded-lg border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-800 text-slate-900 dark:text-white placeholder-slate-400 dark:placeholder-slate-500">{{ setting('ewallet_ovo_description') }}</textarea>
                    </div>
                </div>
            </div>

            <!-- ShopeePay -->
            <div class="p-6">
                <div class="flex items-center gap-3 mb-4">
                    <div class="w-10 h-10 rounded-lg flex items-center justify-center text-white font-bold" style="background:#EE4D2D;">S</div>
                    <div>
                        <h3 class="text-base font-bold text-slate-900 dark:text-white">ShopeePay</h3>
                        <p class="text-sm text-slate-500 dark:text-slate-400">Pengaturan akun ShopeePay</p>
                    </div>
                </div>
                
                <div class="space-y-4">
                    <div>
                        <label for="ewallet_shopeepay_number" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Nomor ShopeePay</label>
                        <input type="text" id="ewallet_shopeepay_number" name="ewallet_shopeepay_number" 
                            value="{{ setting('ewallet_shopeepay_number') }}" 
                            placeholder="Contoh: 081234567890"
                            class="w-full px-4 py-2 rounded-lg border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-800 text-slate-900 dark:text-white placeholder-slate-400 dark:placeholder-slate-500">
                    </div>
                    <div>
                        <label for="ewallet_shopeepay_description" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Instruksi Pembayaran</label>
                        <textarea id="ewallet_shopeepay_description" name="ewallet_shopeepay_description" 
                            rows="2"
                            placeholder="Contoh: Tap untuk pembayaran"
                            class="w-full px-4 py-2 rounded-lg border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-800 text-slate-900 dark:text-white placeholder-slate-400 dark:placeholder-slate-500">{{ setting('ewallet_shopeepay_description') }}</textarea>
                    </div>
                </div>
            </div>

            <!-- Submit Button -->
            <div class="p-6 bg-slate-50 dark:bg-slate-800/50 flex justify-end gap-3">
                <a href="{{ route('settings.index') }}" class="px-4 py-2 rounded-lg border border-slate-300 dark:border-slate-600 text-slate-700 dark:text-slate-300 font-medium hover:bg-slate-100 dark:hover:bg-slate-700 transition">
                    Batal
                </a>
                <button type="submit" class="px-6 py-2 rounded-lg bg-cyan-600 hover:bg-cyan-700 text-white font-medium transition">
                    Simpan Pengaturan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
