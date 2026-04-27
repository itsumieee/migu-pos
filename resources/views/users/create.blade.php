@extends('layouts.app')

@section('page-title', 'Tambah User')

@section('content')
<div class="max-w-2xl mx-auto fade-in">
    <div class="mb-6 flex items-center gap-4">
        <a href="{{ route('users.index') }}" class="p-2 rounded-xl bg-slate-100 dark:bg-slate-800 text-slate-600 dark:text-slate-400 hover:bg-slate-200 dark:hover:bg-slate-700 smooth">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
        </a>
        <div>
            <h1 class="text-2xl font-bold text-slate-900 dark:text-white">Tambah User Baru</h1>
            <p class="text-sm text-slate-500 dark:text-slate-400">Buat akun untuk Admin atau Kasir</p>
        </div>
    </div>

    <form action="{{ route('users.store') }}" method="POST" enctype="multipart/form-data" class="...">
    @csrf
    <!-- input fields -->
</form>
        
        @if($errors->any())
            <div class="mb-6 p-4 rounded-xl bg-rose-50 dark:bg-rose-900/30 border border-rose-200 dark:border-rose-800">
                <ul class="text-sm text-rose-600 dark:text-rose-400 space-y-1">
                    @foreach($errors->all() as $error)
                        <li>⚠️ {{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="md:col-span-2">
                <label class="block text-sm font-semibold text-slate-900 dark:text-white mb-2">Nama Lengkap <span class="text-rose-500">*</span></label>
                <input type="text" name="name" value="{{ old('name') }}" required class="w-full px-4 py-3 bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-xl focus:ring-2 focus:ring-cyan-500/20 focus:border-cyan-500 outline-none smooth dark:text-white">
            </div>
            <div>
                <label class="block text-sm font-semibold text-slate-900 dark:text-white mb-2">Email <span class="text-rose-500">*</span></label>
                <input type="email" name="email" value="{{ old('email') }}" required class="w-full px-4 py-3 bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-xl focus:ring-2 focus:ring-cyan-500/20 focus:border-cyan-500 outline-none smooth dark:text-white">
            </div>
            <div>
                <label class="block text-sm font-semibold text-slate-900 dark:text-white mb-2">Role <span class="text-rose-500">*</span></label>
                <select name="role" required class="w-full px-4 py-3 bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-xl focus:ring-2 focus:ring-cyan-500/20 focus:border-cyan-500 outline-none smooth dark:text-white">
                    <option value="kasir">Kasir</option>
                    <option value="admin">Admin</option>
                </select>
            </div>
            <div>
                <label class="block text-sm font-semibold text-slate-900 dark:text-white mb-2">Password <span class="text-rose-500">*</span></label>
                <input type="password" name="password" required class="w-full px-4 py-3 bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-xl focus:ring-2 focus:ring-cyan-500/20 focus:border-cyan-500 outline-none smooth dark:text-white">
            </div>
            <div>
                <label class="block text-sm font-semibold text-slate-900 dark:text-white mb-2">Konfirmasi Password <span class="text-rose-500">*</span></label>
                <input type="password" name="password_confirmation" required class="w-full px-4 py-3 bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-xl focus:ring-2 focus:ring-cyan-500/20 focus:border-cyan-500 outline-none smooth dark:text-white">
            </div>
            <div>
                <label class="block text-sm font-semibold text-slate-900 dark:text-white mb-2">Telepon</label>
                <input type="text" name="phone" value="{{ old('phone') }}" class="w-full px-4 py-3 bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-xl focus:ring-2 focus:ring-cyan-500/20 focus:border-cyan-500 outline-none smooth dark:text-white">
            </div>
            <div>
                <label class="block text-sm font-semibold text-slate-900 dark:text-white mb-2">Foto Profile</label>
                <input type="file" name="photo" accept="image/*" class="block w-full text-sm text-slate-500 dark:text-slate-400 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-sm file:font-semibold file:bg-cyan-50 file:text-cyan-700 hover:file:bg-cyan-100 dark:file:bg-cyan-900/30 dark:file:text-cyan-400 cursor-pointer">
            </div>
        </div>
        <div class="flex justify-end gap-3 pt-6 border-t border-slate-200 dark:border-slate-800">
            <a href="{{ route('users.index') }}" class="px-6 py-3 bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 text-slate-700 dark:text-slate-300 rounded-xl font-semibold hover:bg-slate-50 dark:hover:bg-slate-700 smooth">Batal</a>
            <button type="submit" class="px-8 py-3 gradient-primary text-white rounded-xl font-semibold shadow-lg shadow-cyan-500/30 hover:shadow-cyan-500/50 smooth active:scale-95">Simpan User</button>
        </div>
    </form>
</div>
@endsection