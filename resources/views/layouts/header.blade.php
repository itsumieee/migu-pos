<header class="modern-header">
    <div class="header-inner">
        <div class="header-left">
            <!-- Mobile Sidebar Toggle -->
            <button @click="sidebarOpen = true" class="header-btn lg:hidden" title="Menu">
                <svg class="icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
            </button>
            
            <!-- Page Title -->
            <div class="page-info">
                <h1 class="page-title">@yield('page-title', 'Dashboard')</h1>
                <p class="page-date">{{ now()->isoFormat('dddd, D MMMM Y') }}</p>
            </div>
        </div>

        <div class="header-right">
            <!-- Theme Toggle -->
            <button @click="$dispatch('toggle-theme')" class="header-btn" title="Toggle Theme">
                <svg class="icon icon-light" x-show="!$store?.theme?.darkMode" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M21.752 15.002A9.718 9.718 0 0118 15.75c-5.385 0-9.75-4.365-9.75-9.75 0-1.33.266-2.597.748-3.752A9.753 9.753 0 003 11.25C3 16.635 7.365 21 12.75 21a9.753 9.753 0 009.002-5.998z"/></svg>
                <svg class="icon icon-dark" x-show="$store?.theme?.darkMode" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M12 3v2.25m6.364.386l-1.591 1.591M21 12h-2.25m-.386 6.364l-1.591-1.591M12 18.75V21m-4.773-4.227l-1.591 1.591M5.25 12H3m4.227-4.773L5.636 5.636M15.75 12a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0z"/></svg>
            </button>

            <!-- Notifications -->
            <div class="relative" x-data="{ showNotifications: false }">
                <button @click="showNotifications = !showNotifications" class="header-btn relative" title="Notifikasi">
                    <svg class="icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M14.857 17.082a23.848 23.848 0 005.454-1.31A8.967 8.967 0 0118 9.75v-.7V9A6 6 0 006 9v.75a8.967 8.967 0 01-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 01-5.714 0m5.714 0a3 3 0 11-5.714 0"/></svg>
                    <span x-data="{ count: 0 }" x-init="count = Math.floor(Math.random() * 5)" x-text="count" x-show="count > 0" class="notification-badge" x-cloak></span>
                </button>

                <!-- Notification Dropdown -->
                <div x-show="showNotifications" @click.outside="showNotifications = false" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 translate-y-2" x-transition:enter-end="opacity-100 translate-y-0" x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100 translate-y-0" x-transition:leave-end="opacity-0 translate-y-2" class="dropdown-menu notification-dropdown" x-cloak>
                    <div class="dropdown-header">
                        <h3 class="dropdown-title">Notifikasi</h3>
                        <button class="dropdown-action" title="Tandai semua dibaca">
                            <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                        </button>
                    </div>
                    
                    <div x-data="{ list: [
                        { icon: '✅', title: 'Transaksi Berhasil', message: 'Penjualan Rp 150.000 berhasil dicatat', time: '2m lalu', read: false },
                        { icon: '📦', title: 'Stok Terbatas', message: 'Kaos Polos Hitam tinggal 5 item', time: '15m lalu', read: false },
                        { icon: '💰', title: 'Laporan Harian', message: 'Total penjualan hari ini: Rp 2.450.000', time: '1j lalu', read: true }
                    ] }" class="dropdown-content">
                        <template x-for="(notif, index) in list" :key="index">
                            <div class="notification-item" :class="{ 'unread': !notif.read }">
                                <div class="notification-icon" x-text="notif.icon"></div>
                                <div class="notification-body">
                                    <p class="notification-title" x-text="notif.title"></p>
                                    <p class="notification-message" x-text="notif.message"></p>
                                    <p class="notification-time" x-text="notif.time"></p>
                                </div>
                                <span x-show="!notif.read" class="notification-dot"></span>
                            </div>
                        </template>
                        
                        <div x-show="list.length === 0" class="dropdown-empty">
                            <svg class="empty-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/></svg>
                            <p class="empty-text">Tidak ada notifikasi</p>
                        </div>
                        
                        <div class="dropdown-footer">
                            <a href="#" class="view-all">Lihat Semua Notifikasi</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Profile Dropdown -->
            <div class="relative" x-data="{ open: false }">
                <button @click="open = !open" @click.outside="open = false" class="profile-btn">
                    <div class="profile-avatar">
                        <span>{{ substr(Auth::user()->name, 0, 1) }}</span>
                        <span class="avatar-status"></span>
                    </div>
                    <div class="profile-info">
                        <p class="profile-name">{{ Auth::user()->name }}</p>
                        <span class="profile-status">
                            <span class="status-dot"></span>
                            Online
                        </span>
                    </div>
                    <svg class="profile-arrow" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                </button>

                <div x-show="open" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 translate-y-2" x-transition:enter-end="opacity-100 translate-y-0" x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100 translate-y-0" x-transition:leave-end="opacity-0 translate-y-2" class="dropdown-menu profile-dropdown" x-cloak>
                    <div class="profile-header">
                        <div class="profile-avatar-lg">
                            <span>{{ substr(Auth::user()->name, 0, 1) }}</span>
                        </div>
                        <div>
                            <p class="profile-header-name">{{ Auth::user()->name }}</p>
                            <p class="profile-header-email">{{ Auth::user()->email }}</p>
                        </div>
                    </div>
                    
                    <div class="profile-menu">
                        <a href="{{ route('profile.edit') }}" class="profile-menu-item">
                            <svg class="menu-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125"/></svg>
                            <span>Edit Profile</span>
                        </a>
                        <a href="{{ route('settings.index') }}" class="profile-menu-item">
                            <svg class="menu-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                            <span>Pengaturan</span>
                        </a>
                        <a href="{{ route('reports.sales') }}" class="profile-menu-item">
                            <svg class="menu-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
                            <span>Laporan</span>
                        </a>
                    </div>
                    
                    <div class="profile-footer">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="profile-logout">
                                <svg class="menu-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15m3 0l3-3m0 0l-3-3m3 3H9"/></svg>
                                <span>Logout</span>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>

<style>
/* ── Modern Dark Header Theme ───────────────────────────── */
:root {
    --bg-primary: #0a0a0f;
    --bg-secondary: #12121a;
    --bg-card: #16161f;
    --bg-elevated: #1c1c2e;
    --bg-hover: rgba(255, 51, 102, 0.08);
    
    --accent-primary: #ff3366;
    --accent-secondary: #ff6b6b;
    --accent-gradient: linear-gradient(135deg, #ff3366 0%, #ff6b6b 100%);
    --accent-glow: rgba(255, 51, 102, 0.4);
    
    --success: #00d9a3;
    --warning: #ffc107;
    --info: #4dabf7;
    
    --text-primary: #ffffff;
    --text-secondary: #a0a0b0;
    --text-muted: #6c6c7e;
    
    --border-color: rgba(255, 255, 255, 0.08);
    --border-light: rgba(255, 255, 255, 0.05);
    
    --shadow-sm: 0 2px 8px rgba(0, 0, 0, 0.3);
    --shadow-md: 0 8px 24px rgba(0, 0, 0, 0.4);
    --shadow-lg: 0 16px 48px rgba(0, 0, 0, 0.5);
    --shadow-glow: 0 0 32px rgba(255, 51, 102, 0.25);
    
    --radius-sm: 8px;
    --radius: 12px;
    --radius-lg: 16px;
    --radius-xl: 20px;
    
    --font-main: 'Plus Jakarta Sans', 'Inter', system-ui, sans-serif;
}

/* ── Base Header ───────────────────────────────── */
.modern-header {
    font-family: var(--font-main);
    background: rgba(18, 18, 26, 0.8);
    backdrop-filter: blur(20px);
    border-bottom: 1px solid var(--border-color);
    position: sticky;
    top: 0;
    z-index: 100;
}

.header-inner {
    max-width: 1440px;
    margin: 0 auto;
    padding: 0 1.5rem;
    display: flex;
    align-items: center;
    justify-content: space-between;
    height: 4.5rem;
}

.header-left,
.header-right {
    display: flex;
    align-items: center;
    gap: 0.75rem;
}

/* ── Header Buttons ───────────────────────── */
.header-btn {
    width: 40px; height: 40px;
    border-radius: var(--radius);
    border: 1px solid var(--border-color);
    background: var(--bg-card);
    color: var(--text-secondary);
    display: flex; align-items: center; justify-content: center;
    cursor: pointer; transition: all 0.2s ease;
    position: relative;
}
.header-btn:hover {
    background: var(--bg-hover);
    color: var(--accent-primary);
    border-color: rgba(255, 51, 102, 0.3);
    transform: translateY(-1px);
}
.header-btn:active { transform: translateY(0); }

.icon { width: 18px; height: 18px; }
.icon-light, .icon-dark { display: none; }
[x-show*="darkMode"] + .icon-dark { display: block; }
[x-show*="!darkMode"] + .icon-light { display: block; }

/* ── Page Info ─────────────────────────── */
.page-info { margin-left: 0.5rem; }
.page-title {
    font-size: 1.25rem; font-weight: 700; color: var(--text-primary);
    margin: 0; line-height: 1.2;
}
.page-date {
    font-size: 0.8rem; color: var(--text-muted);
    margin: 2px 0 0 0; font-weight: 400;
}

/* ── Notification Badge ───────────────── */
.notification-badge {
    position: absolute;
    top: 8px; right: 8px;
    min-width: 18px; height: 18px;
    padding: 0 5px;
    border-radius: 9px;
    background: var(--accent-primary);
    color: white;
    font-size: 10px; font-weight: 700;
    display: flex; align-items: center; justify-content: center;
    box-shadow: 0 2px 8px rgba(255, 51, 102, 0.4);
    animation: pulse 2s ease-in-out infinite;
}

/* ── Dropdown Menu Base ───────────────── */
.dropdown-menu {
    position: absolute;
    right: 0; top: calc(100% + 8px);
    min-width: 320px;
    background: var(--bg-card);
    border: 1px solid var(--border-color);
    border-radius: var(--radius-lg);
    box-shadow: var(--shadow-lg), var(--shadow-glow);
    overflow: hidden;
    z-index: 1000;
}

.dropdown-header {
    display: flex; align-items: center; justify-content: space-between;
    padding: 1rem 1.25rem;
    border-bottom: 1px solid var(--border-light);
}
.dropdown-title {
    font-size: 0.95rem; font-weight: 600; color: var(--text-primary);
    margin: 0;
}
.dropdown-action {
    width: 28px; height: 28px;
    border-radius: var(--radius-sm);
    border: none; background: var(--bg-elevated);
    color: var(--text-muted);
    display: flex; align-items: center; justify-content: center;
    cursor: pointer; transition: all 0.15s ease;
}
.dropdown-action:hover {
    background: var(--bg-hover);
    color: var(--accent-primary);
}

.dropdown-content {
    max-height: 360px; overflow-y: auto;
}

.dropdown-footer {
    padding: 0.75rem 1rem;
    border-top: 1px solid var(--border-light);
    text-align: center;
}
.view-all {
    font-size: 0.85rem; font-weight: 500;
    color: var(--accent-primary); text-decoration: none;
    transition: color 0.15s ease;
}
.view-all:hover { color: var(--accent-secondary); }

.dropdown-empty {
    padding: 2rem; text-align: center; color: var(--text-muted);
}
.empty-icon { width: 48px; height: 48px; margin: 0 auto 1rem; opacity: 0.5; }
.empty-text { font-size: 0.9rem; margin: 0; }

/* ── Notification Items ───────────────── */
.notification-item {
    display: flex; align-items: flex-start; gap: 0.875rem;
    padding: 0.875rem 1.25rem;
    border-bottom: 1px solid var(--border-light);
    transition: background 0.15s ease;
    position: relative;
}
.notification-item:hover { background: var(--bg-hover); }
.notification-item:last-child { border-bottom: none; }
.notification-item.unread::before {
    content: ''; position: absolute; left: 0; top: 50%; transform: translateY(-50%);
    width: 3px; height: 60%; background: var(--accent-gradient); border-radius: 0 4px 4px 0;
}

.notification-icon {
    width: 36px; height: 36px;
    border-radius: var(--radius);
    background: var(--bg-elevated);
    display: flex; align-items: center; justify-content: center;
    font-size: 1.1rem; flex-shrink: 0;
}

.notification-body { flex: 1; min-width: 0; }
.notification-title {
    font-size: 0.9rem; font-weight: 600; color: var(--text-primary);
    margin: 0 0 4px 0; line-height: 1.3;
}
.notification-message {
    font-size: 0.85rem; color: var(--text-secondary);
    margin: 0 0 4px 0; line-height: 1.4;
}
.notification-time {
    font-size: 0.75rem; color: var(--text-muted);
    margin: 0;
}

.notification-dot {
    width: 8px; height: 8px;
    border-radius: 50%;
    background: var(--accent-primary);
    flex-shrink: 0;
    margin-top: 14px;
}

/* ── Profile Button ───────────────────── */
.profile-btn {
    display: flex; align-items: center; gap: 0.625rem;
    padding: 0.375rem 0.75rem 0.375rem 0.375rem;
    border-radius: var(--radius-xl);
    background: var(--bg-card);
    border: 1px solid var(--border-color);
    cursor: pointer; transition: all 0.2s ease;
}
.profile-btn:hover {
    border-color: rgba(255, 51, 102, 0.3);
    box-shadow: var(--shadow-glow);
}

.profile-avatar {
    position: relative;
    width: 36px; height: 36px;
    border-radius: var(--radius);
    background: var(--accent-gradient);
    display: flex; align-items: center; justify-content: center;
    font-weight: 700; font-size: 0.9rem; color: white;
    flex-shrink: 0;
}
.avatar-status {
    position: absolute;
    bottom: -2px; right: -2px;
    width: 11px; height: 11px;
    border-radius: 50%;
    background: var(--success);
    border: 2px solid var(--bg-card);
}

.profile-info {
    display: none; text-align: left;
}
@media (min-width: 768px) { .profile-info { display: block; } }

.profile-name {
    font-size: 0.9rem; font-weight: 600; color: var(--text-primary);
    margin: 0; line-height: 1.2;
}
.profile-status {
    display: flex; align-items: center; gap: 4px;
    font-size: 0.75rem; color: var(--success);
    margin-top: 2px; font-weight: 500;
}
.status-dot {
    width: 6px; height: 6px;
    border-radius: 50%;
    background: var(--success);
    animation: pulse 2s ease-in-out infinite;
}

.profile-arrow {
    width: 14px; height: 14px;
    color: var(--text-muted);
    transition: transform 0.2s ease;
}
.profile-btn:hover .profile-arrow { transform: rotate(180deg); color: var(--accent-primary); }

/* ── Profile Dropdown ─────────────────── */
.profile-dropdown { min-width: 280px; }

.profile-header {
    display: flex; align-items: center; gap: 0.875rem;
    padding: 1rem 1.25rem;
    border-bottom: 1px solid var(--border-light);
}
.profile-avatar-lg {
    width: 48px; height: 48px;
    border-radius: var(--radius-lg);
    background: var(--accent-gradient);
    display: flex; align-items: center; justify-content: center;
    font-weight: 700; font-size: 1.1rem; color: white;
    flex-shrink: 0;
}
.profile-header-name {
    font-size: 0.95rem; font-weight: 600; color: var(--text-primary);
    margin: 0; line-height: 1.2;
}
.profile-header-email {
    font-size: 0.8rem; color: var(--text-muted);
    margin: 2px 0 0 0;
}

.profile-menu { padding: 0.5rem; }
.profile-menu-item {
    display: flex; align-items: center; gap: 0.75rem;
    padding: 0.625rem 0.875rem;
    border-radius: var(--radius);
    font-size: 0.9rem; font-weight: 500;
    color: var(--text-secondary);
    text-decoration: none;
    transition: all 0.15s ease;
}
.profile-menu-item:hover {
    background: var(--bg-hover);
    color: var(--text-primary);
}
.profile-menu-item:hover .menu-icon { color: var(--accent-primary); }

.menu-icon {
    width: 18px; height: 18px;
    color: var(--text-muted);
    flex-shrink: 0;
    transition: color 0.15s ease;
}

.profile-footer {
    padding: 0.5rem;
    border-top: 1px solid var(--border-light);
}
.profile-logout {
    display: flex; align-items: center; gap: 0.75rem;
    width: 100%; padding: 0.625rem 0.875rem;
    border: none; border-radius: var(--radius);
    background: transparent;
    font-size: 0.9rem; font-weight: 500;
    color: var(--accent-primary);
    cursor: pointer; transition: all 0.15s ease;
    text-align: left;
}
.profile-logout:hover {
    background: rgba(255, 51, 102, 0.1);
}
.profile-logout .menu-icon { color: var(--accent-primary); }

/* ── Animations ───────────────────────── */
@keyframes pulse {
    0%, 100% { opacity: 1; transform: scale(1); }
    50% { opacity: 0.7; transform: scale(0.9); }
}

/* ── Scrollbar ───────────────────────── */
.dropdown-content::-webkit-scrollbar { width: 4px; }
.dropdown-content::-webkit-scrollbar-track { background: transparent; }
.dropdown-content::-webkit-scrollbar-thumb {
    background: var(--bg-elevated);
    border-radius: 4px;
}
.dropdown-content::-webkit-scrollbar-thumb:hover {
    background: var(--accent-primary);
}

/* ── Responsive ───────────────────────── */
@media (max-width: 768px) {
    .header-inner { padding: 0 1rem; height: 4rem; }
    .page-title { font-size: 1.1rem; }
    .page-date { font-size: 0.75rem; }
    .dropdown-menu {
        position: fixed;
        left: 1rem; right: 1rem;
        top: auto; bottom: auto;
        min-width: auto;
        max-width: calc(100vw - 2rem);
    }
    .notification-dropdown { min-width: auto; }
}

/* ── x-cloak Utility ─────────────────── */
[x-cloak] { display: none !important; }

/* ── Focus States ───────────────────── */
.header-btn:focus-visible,
.profile-btn:focus-visible,
.dropdown-action:focus-visible,
.profile-menu-item:focus-visible,
.profile-logout:focus-visible {
    outline: 2px solid var(--accent-primary);
    outline-offset: 2px;
}

/* ── Reduced Motion ─────────────────── */
@media (prefers-reduced-motion: reduce) {
    *, *::before, *::after {
        animation-duration: 0.01ms !important;
        transition-duration: 0.01ms !important;
    }
}
</style>

<!-- Keep existing Alpine.js functions -->
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