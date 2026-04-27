@extends('layouts.app')

@section('page-title', 'Profile')

@section('content')
<div class="max-w-3xl mx-auto fade-in">
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-slate-900 dark:text-white">Profile Saya</h1>
        <p class="text-sm text-slate-500 dark:text-slate-400 mt-1">Kelola informasi akun Anda</p>
    </div>

    @if(session('success'))
    <div class="mb-4 p-4 rounded-xl bg-emerald-50 dark:bg-emerald-900/30 border border-emerald-200 dark:border-emerald-800 text-emerald-700 dark:text-emerald-300">
        {{ session('success') }}
    </div>
    @endif

    <div class="bg-white dark:bg-slate-900 rounded-3xl border border-slate-200 dark:border-slate-800 shadow-soft p-6 lg:p-8 space-y-6">
        <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf @method('PUT')

            <!-- Photo Upload -->
            <div class="flex items-center gap-6">
                <div class="shrink-0">
                    <div class="w-24 h-24 rounded-2xl overflow-hidden border-2 border-slate-200 dark:border-slate-700 bg-slate-100 dark:bg-slate-800 flex items-center justify-center">
                        @if(Auth::user()->photo)
                        <img src="{{ asset('storage/' . Auth::user()->photo) }}" alt="Profile" class="w-full h-full object-cover">
                        @else
                        <div class="w-12 h-12 rounded-xl gradient-primary flex items-center justify-center text-white text-xl font-bold">
                            {{ substr(Auth::user()->name, 0, 1) }}
                        </div>
                        @endif
                    </div>
                </div>
                <div class="flex-1">
                    <label class="block text-sm font-semibold text-slate-900 dark:text-white mb-2">Foto Profile</label>
                    <input type="file" name="photo" accept="image/*" class="block w-full text-sm text-slate-500 dark:text-slate-400 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-sm file:font-semibold file:bg-cyan-50 file:text-cyan-700 hover:file:bg-cyan-100 dark:file:bg-cyan-900/30 dark:file:text-cyan-400">
                    <p class="text-xs text-slate-500 dark:text-slate-400 mt-1">PNG, JPG hingga 2MB</p>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                <div class="md:col-span-2">
                    <label class="block text-sm font-semibold text-slate-900 dark:text-white mb-2">Nama Lengkap</label>
                    <input type="text" name="name" value="{{ old('name', Auth::user()->name) }}" required class="w-full px-4 py-3 bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-xl focus:ring-2 focus:ring-cyan-500/20 focus:border-cyan-500 outline-none smooth dark:text-white">
                    @error('name') <p class="text-xs text-rose-500 mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="block text-sm font-semibold text-slate-900 dark:text-white mb-2">Email</label>
                    <input type="email" name="email" value="{{ old('email', Auth::user()->email) }}" required class="w-full px-4 py-3 bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-xl focus:ring-2 focus:ring-cyan-500/20 focus:border-cyan-500 outline-none smooth dark:text-white">
                    @error('email') <p class="text-xs text-rose-500 mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="block text-sm font-semibold text-slate-900 dark:text-white mb-2">Telepon</label>
                    <input type="text" name="phone" value="{{ old('phone', Auth::user()->phone) }}" class="w-full px-4 py-3 bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-xl focus:ring-2 focus:ring-cyan-500/20 focus:border-cyan-500 outline-none smooth dark:text-white">
                </div>
            </div>

            <div class="flex justify-between pt-6 border-t border-slate-200 dark:border-slate-800">
                <button type="button" onclick="document.getElementById('deleteForm').classList.remove('hidden')" class="px-6 py-3 bg-rose-50 dark:bg-rose-900/30 text-rose-600 dark:text-rose-400 rounded-xl font-semibold hover:bg-rose-100 dark:hover:bg-rose-900/50 smooth">
                    Hapus Akun
                </button>
                <button type="submit" class="px-8 py-3 gradient-primary text-white rounded-xl font-semibold shadow-lg shadow-cyan-500/30 hover:shadow-cyan-500/50 smooth active:scale-95">
                    Simpan Perubahan
                </button>
            </div>
        </form>

        <!-- Delete Account Form (Hidden by default) -->
        <form id="deleteForm" action="{{ route('profile.destroy') }}" method="POST" class="hidden p-4 rounded-xl bg-rose-50 dark:bg-rose-900/30 border border-rose-200 dark:border-rose-800 space-y-3">
            @csrf @method('DELETE')
            <h3 class="font-bold text-rose-700 dark:text-rose-400">Hapus Akun</h3>
            <p class="text-sm text-rose-600 dark:text-rose-300">Masukkan password untuk konfirmasi:</p>
            <input type="password" name="password" required class="w-full px-4 py-2 bg-white dark:bg-slate-800 border border-rose-200 dark:border-rose-800 rounded-lg focus:ring-2 focus:ring-rose-500/20 outline-none">
            <div class="flex gap-3">
                <button type="submit" class="px-4 py-2 bg-rose-500 text-white rounded-lg text-sm font-semibold hover:bg-rose-600 smooth">Ya, Hapus</button>
                <button type="button" onclick="document.getElementById('deleteForm').classList.add('hidden')" class="px-4 py-2 bg-slate-200 dark:bg-slate-700 text-slate-700 dark:text-slate-300 rounded-lg text-sm font-semibold hover:bg-slate-300 smooth">Batal</button>
            </div>
        </form>
    </div>
</div>
@endsection