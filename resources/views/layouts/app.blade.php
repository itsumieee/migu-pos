<!DOCTYPE html>
@php
    $storeName = \App\Models\Setting::get('store_name', 'Migu POS');
@endphp

<html lang="id" class="h-full" x-data="theme()" x-init="initTheme()" :class="{ 'dark': darkMode }">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <!-- 🔥 FIX TITLE -->
    <title>@yield('page-title', 'Dashboard') - {{ $storeName }}</title>
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/print.css') }}" media="print">
    
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        [x-cloak] { display: none !important; }

        .glass { background: rgba(255, 255, 255, 0.7); backdrop-filter: blur(20px); }
        .dark .glass { background: rgba(15, 23, 42, 0.7); }

        .gradient-primary { background: linear-gradient(135deg, #06b6d4 0%, #3b82f6 100%); }
        .gradient-dark { background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%); }

        .shadow-soft {
            box-shadow: 0 2px 15px -3px rgba(0, 0, 0, 0.07),
                        0 10px 20px -2px rgba(0, 0, 0, 0.04);
        }

        .dark .shadow-soft {
            box-shadow: 0 2px 15px -3px rgba(0, 0, 0, 0.3),
                        0 10px 20px -2px rgba(0, 0, 0, 0.2);
        }

        .smooth { transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); }

        .scroll-custom::-webkit-scrollbar { width: 6px; height: 6px; }
        .scroll-custom::-webkit-scrollbar-track { background: transparent; }
        .scroll-custom::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 99px; }
        .scroll-custom::-webkit-scrollbar-thumb:hover { background: #94a3b8; }

        .dark .scroll-custom::-webkit-scrollbar-thumb { background: #475569; }
        .dark .scroll-custom::-webkit-scrollbar-thumb:hover { background: #64748b; }
    </style>
</head>

<body class="h-full bg-slate-50 dark:bg-slate-950 text-slate-900 dark:text-slate-100 antialiased smooth"
      x-data="{ sidebarOpen: false }">

    <!-- Overlay -->
    <div x-show="sidebarOpen" @click="sidebarOpen = false"
         x-transition
         class="fixed inset-0 bg-black/50 z-40 lg:hidden"
         x-cloak></div>

    <div class="flex h-screen overflow-hidden">

        <!-- SIDEBAR -->
        @include('layouts.sidebar')

        <!-- MAIN -->
        <div class="flex-1 flex flex-col min-w-0 overflow-hidden">

            <!-- HEADER -->
            @include('layouts.header')

            <!-- CONTENT -->
            <main class="flex-1 overflow-x-hidden overflow-y-auto bg-slate-50 dark:bg-slate-950 p-4 md:p-6 lg:p-8 smooth">

                {{-- SUCCESS --}}
                @if(session('success'))
                    <div x-data="{ show: true }"
                         x-show="show"
                         x-init="setTimeout(() => show = false, 4000)"
                         x-transition
                         class="mb-6 p-4 rounded-2xl bg-emerald-50 dark:bg-emerald-900/30 border border-emerald-200 dark:border-emerald-800 text-emerald-700 dark:text-emerald-300 flex items-center gap-3 shadow-soft">

                        <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>

                        <span class="font-medium">{{ session('success') }}</span>
                    </div>
                @endif

                {{-- ERROR --}}
                @if(session('error'))
                    <div x-data="{ show: true }"
                         x-init="setTimeout(() => show = false, 5000)"
                         x-transition
                         class="mb-6 p-4 rounded-2xl bg-rose-50 dark:bg-rose-900/30 border border-rose-200 dark:border-rose-800 text-rose-700 dark:text-rose-300 flex items-center gap-3 shadow-soft">

                        <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>

                        <span class="font-medium">{{ session('error') }}</span>
                    </div>
                @endif

                {{-- CONTENT --}}
                @yield('content')

            </main>
        </div>
    </div>

    <!-- THEME SCRIPT -->
    <script>
        function theme() {
            return {
                darkMode: false,

                initTheme() {
                    const saved = localStorage.getItem('theme');

                    if (saved === 'dark') {
                        this.darkMode = true;
                        document.documentElement.classList.add('dark');
                    } else if (saved === 'light') {
                        this.darkMode = false;
                        document.documentElement.classList.remove('dark');
                    } else if (window.matchMedia('(prefers-color-scheme: dark)').matches) {
                        this.darkMode = true;
                        document.documentElement.classList.add('dark');
                    }
                },

                toggle() {
                    this.darkMode = !this.darkMode;

                    localStorage.setItem('theme', this.darkMode ? 'dark' : 'light');

                    if (this.darkMode) {
                        document.documentElement.classList.add('dark');
                    } else {
                        document.documentElement.classList.remove('dark');
                    }

                    document.dispatchEvent(new CustomEvent('theme-changed'));
                }
            }
        }
    </script>

    @yield('scripts')

</body>
</html>