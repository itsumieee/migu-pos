<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Migu STORE')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-slate-50 dark:bg-slate-950 text-slate-900 dark:text-white antialiased">

    <!-- NAVBAR CUSTOMER (MODERN) -->
    <nav class="sticky top-0 z-50 bg-white/80 dark:bg-slate-900/80 backdrop-blur-md border-b border-slate-200 dark:border-slate-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">
                
                <!-- 1. LOGO & LOGIN/REGISTER BUTTON (Kiri Atas) -->
                <div class="flex items-center gap-4">
                    <a href="{{ route('home') }}" class="flex items-center gap-2 group">
                        <div class="w-8 h-8 rounded-lg bg-gradient-to-br from-cyan-500 to-blue-600 flex items-center justify-center text-white font-bold shadow-lg shadow-cyan-500/30 group-hover:scale-105 transition">
                            M
                        </div>
                        <span class="text-xl font-bold bg-clip-text text-transparent bg-gradient-to-r from-slate-900 to-slate-700 dark:from-white dark:to-slate-300">
                            Migu STORE
                        </span>
                    </a>

                    <!-- Tombol Login & Register (Hanya muncul jika BELUM login) -->
                    @guest
                    <div class="hidden md:flex items-center gap-2 ml-4 pl-4 border-l border-slate-200 dark:border-slate-700">
                        <a href="{{ route('login') }}" class="px-4 py-1.5 text-sm font-medium text-slate-600 dark:text-slate-400 hover:text-cyan-600 dark:hover:text-cyan-400 transition rounded-lg hover:bg-slate-100 dark:hover:bg-slate-800">
                            Masuk
                        </a>
                        <a href="{{ route('register') }}" class="px-4 py-1.5 text-sm font-bold text-white bg-gradient-to-r from-cyan-500 to-blue-600 rounded-lg shadow-md shadow-cyan-500/20 hover:shadow-cyan-500/40 hover:scale-105 transition">
                            Daftar
                        </a>
                    </div>
                    @endguest
                </div>

                <!-- 2. SEARCH BAR (Tengah) -->
                <div class="flex-1 max-w-md mx-8 hidden md:block">
                    <div class="relative group">
                        <input type="text" placeholder="Cari produk..." 
                               class="w-full pl-10 pr-4 py-2 bg-slate-100 dark:bg-slate-800 border border-transparent focus:border-cyan-500 rounded-xl text-sm outline-none transition group-hover:bg-white dark:group-hover:bg-slate-900">
                        <svg class="w-4 h-4 absolute left-3 top-2.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                    </div>
                </div>

                <!-- 3. USER MENU (Kanan Atas) -->
                <div class="flex items-center gap-3">
                    @auth
                        <!-- Jika Sudah Login -->
                        <a href="#" class="relative p-2 text-slate-500 hover:text-cyan-600 transition">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/></svg>
                            <span class="absolute top-0 right-0 w-2.5 h-2.5 bg-red-500 rounded-full border-2 border-white dark:border-slate-900"></span>
                        </a>
                        
                        <div class="relative" x-data="{ open: false }">
                            <button @click="open = !open" class="flex items-center gap-2 pl-2 pr-1 py-1 rounded-full hover:bg-slate-100 dark:hover:bg-slate-800 transition">
                                <img src="https://ui-avatars.com/api/?name={{ Auth::user()->name }}&background=06b6d4&color=fff" class="w-8 h-8 rounded-full shadow-sm">
                                <span class="text-sm font-medium hidden sm:block">{{ Auth::user()->name }}</span>
                            </button>
                            
                            <!-- Dropdown Menu -->
                            <div x-show="open" @click.outside="open = false" class="absolute right-0 mt-2 w-48 bg-white dark:bg-slate-800 rounded-xl shadow-xl border border-slate-200 dark:border-slate-700 py-1 z-50">
                                <a href="#" class="block px-4 py-2 text-sm text-slate-700 dark:text-slate-300 hover:bg-slate-50 dark:hover:bg-slate-700">Profil Saya</a>
                                <a href="#" class="block px-4 py-2 text-sm text-slate-700 dark:text-slate-300 hover:bg-slate-50 dark:hover:bg-slate-700">Pesanan</a>
                                <div class="border-t border-slate-100 dark:border-slate-700 my-1"></div>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-red-50 dark:hover:bg-red-900/20">Keluar</button>
                                </form>
                            </div>
                        </div>
                    @else
                        <!-- Jika BELUM Login (Mobile Button) -->
                        <a href="{{ route('login') }}" class="md:hidden px-4 py-2 bg-cyan-500 text-white rounded-lg text-sm font-bold">
                            Masuk
                        </a>
                    @endauth
                </div>

            </div>
        </div>
    </nav>

    <!-- MAIN CONTENT AREA -->
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 min-h-screen">
        @yield('content')
    </main>

    <!-- FOOTER -->
    <footer class="bg-white dark:bg-slate-900 border-t border-slate-200 dark:border-slate-800 py-8 mt-12">
        <div class="max-w-7xl mx-auto px-4 text-center text-slate-500 text-sm">
            &copy; {{ date('Y') }} Migu STORE. Fashion Modern & Terpercaya.
        </div>
    </footer>

</body>
</html>