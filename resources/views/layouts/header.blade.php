<header class="sticky top-0 z-30 glass border-b border-slate-200 dark:border-slate-800">
    <div class="flex items-center justify-between h-20 px-6 lg:px-8">
        <div class="flex items-center gap-4">
            <button @click="sidebarOpen = true" class="lg:hidden p-2.5 rounded-xl bg-slate-100 dark:bg-slate-800 text-slate-600 dark:text-slate-400 hover:bg-slate-200 dark:hover:bg-slate-700 smooth">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
            </button>
            
            <div>
                <h1 class="text-2xl font-bold text-slate-900 dark:text-white">@yield('page-title', 'Dashboard')</h1>
                <p class="text-xs text-slate-500 dark:text-slate-400 mt-0.5">{{ now()->isoFormat('dddd, D MMMM Y') }}</p>
            </div>
        </div>

        <div class="flex items-center gap-3">
            <!-- Theme Toggle -->
            <button @click="$dispatch('toggle-theme')" class="p-2.5 rounded-xl bg-slate-100 dark:bg-slate-800 text-slate-600 dark:text-slate-400 hover:bg-slate-200 dark:hover:bg-slate-700 smooth">
                <svg class="w-5 h-5" x-show="!$store?.theme?.darkMode" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M21.752 15.002A9.718 9.718 0 0118 15.75c-5.385 0-9.75-4.365-9.75-9.75 0-1.33.266-2.597.748-3.752A9.753 9.753 0 003 11.25C3 16.635 7.365 21 12.75 21a9.753 9.753 0 009.002-5.998z"/></svg>
                <svg class="w-5 h-5" x-show="$store?.theme?.darkMode" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M12 3v2.25m6.364.386l-1.591 1.591M21 12h-2.25m-.386 6.364l-1.591-1.591M12 18.75V21m-4.773-4.227l-1.591 1.591M5.25 12H3m4.227-4.773L5.636 5.636M15.75 12a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0z"/></svg>
            </button>

            <!-- Notifications -->
            <div class="relative" x-data="{ showNotifications: false }">
                <button @click="showNotifications = !showNotifications" class="relative p-2.5 rounded-xl bg-slate-100 dark:bg-slate-800 text-slate-600 dark:text-slate-400 hover:bg-slate-200 dark:hover:bg-slate-700 smooth">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M14.857 17.082a23.848 23.848 0 005.454-1.31A8.967 8.967 0 0118 9.75v-.7V9A6 6 0 006 9v.75a8.967 8.967 0 01-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 01-5.714 0m5.714 0a3 3 0 11-5.714 0"/></svg>
                    <span x-data="{ count: 0 }" x-init="count = Math.floor(Math.random() * 5)" x-text="count" x-show="count > 0" class="absolute top-1 right-1 w-4 h-4 bg-rose-500 text-white text-[9px] font-bold flex items-center justify-center rounded-full animate-pulse"></span>
                </button>

                <!-- Notification Dropdown -->
                <div x-show="showNotifications" @click.outside="showNotifications = false" x-transition class="absolute right-0 top-full mt-2 w-80 bg-white dark:bg-slate-900 rounded-2xl shadow-2xl border border-slate-200 dark:border-slate-800 overflow-hidden z-50">
                    <div class="p-4 border-b border-slate-100 dark:border-slate-800">
                        <h3 class="font-bold text-slate-900 dark:text-white">Notifikasi</h3>
                    </div>
                    <div x-data="{ list: [
                        { icon: '✅', title: 'Transaksi Berhasil', message: 'Penjualan Rp 150.000 berhasil dicatat' },
                        { icon: '📦', title: 'Stok Terbatas', message: 'Kaos Polos Hitam tinggal 5 item' },
                        { icon: '💰', title: 'Laporan Harian', message: 'Total penjualan hari ini: Rp 2.450.000' }
                    ] }" class="max-h-96 overflow-y-auto">
                        <template x-for="notif in list" :key="notif.title">
                            <div class="p-4 border-b border-slate-100 dark:border-slate-800 hover:bg-slate-50 dark:hover:bg-slate-800/50 smooth">
                                <div class="flex items-start gap-3">
                                    <span class="text-2xl" x-text="notif.icon"></span>
                                    <div class="flex-1">
                                        <p class="text-sm font-semibold text-slate-900 dark:text-white" x-text="notif.title"></p>
                                        <p class="text-xs text-slate-500 dark:text-slate-400 mt-1" x-text="notif.message"></p>
                                    </div>
                                </div>
                            </div>
                        </template>
                        <div x-show="list.length === 0" class="p-8 text-center text-slate-400">
                            <p class="text-sm">Tidak ada notifikasi</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Profile Dropdown -->
            <div class="relative" x-data="{ open: false }">
                <button @click="open = !open" @click.outside="open = false" class="flex items-center gap-3 p-2 pr-3 rounded-2xl bg-slate-100 dark:bg-slate-800 hover:bg-slate-200 dark:hover:bg-slate-700 smooth">
                    <div class="w-8 h-8 rounded-xl gradient-primary flex items-center justify-center text-white text-xs font-bold">
                        {{ substr(Auth::user()->name, 0, 1) }}
                    </div>
                    <div class="hidden md:block text-left">
                        <p class="text-sm font-semibold text-slate-900 dark:text-white">{{ Auth::user()->name }}</p>
                        <div class="flex items-center gap-1">
                            <span class="w-1.5 h-1.5 bg-emerald-500 rounded-full animate-pulse"></span>
                            <span class="text-[10px] text-emerald-600 dark:text-emerald-400 font-medium">Online</span>
                        </div>
                    </div>
                    <svg class="w-4 h-4 text-slate-400 hidden md:block" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                </button>

                <div x-show="open" x-transition class="absolute right-0 top-full mt-2 w-64 bg-white dark:bg-slate-900 rounded-2xl shadow-2xl border border-slate-200 dark:border-slate-800 overflow-hidden z-50">
                    <div class="p-4 border-b border-slate-100 dark:border-slate-800">
                        <p class="text-sm font-semibold text-slate-900 dark:text-white">{{ Auth::user()->name }}</p>
                        <p class="text-xs text-slate-500 dark:text-slate-400 mt-0.5">{{ Auth::user()->email }}</p>
                    </div>
                    <div class="p-2">
                        <a href="{{ route('profile.edit') }}" class="flex items-center gap-2.5 px-3 py-2 rounded-xl text-sm text-slate-600 dark:text-slate-300 hover:bg-slate-50 dark:hover:bg-slate-800 smooth">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125"/></svg>
                            Edit Profile
                        </a>
                        <a href="{{ route('settings.index') }}" class="flex items-center gap-2.5 px-3 py-2 rounded-xl text-sm text-slate-600 dark:text-slate-300 hover:bg-slate-50 dark:hover:bg-slate-800 smooth">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                            Pengaturan
                        </a>
                    </div>
                    <div class="p-2 border-t border-slate-100 dark:border-slate-800">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="w-full flex items-center gap-2.5 px-3 py-2 rounded-xl text-sm text-rose-600 dark:text-rose-400 hover:bg-rose-50 dark:hover:bg-rose-900/20 smooth">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15m3 0l3-3m0 0l-3-3m3 3H9"/></svg>
                                Logout
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>

<script>
function notificationCount() {
    return {
        count: 0,
        loadCount() {
            fetch('{{ route("notifications.get") }}')
                .then(r => r.json())
                .then(d => this.count = d.count);
        }
    }
}
function notifications() {
    return {
        list: [],
        loadNotifications() {
            fetch('{{ route("notifications.get") }}')
                .then(r => r.json())
                .then(d => this.list = d.notifications);
        }
    }
}
</script>