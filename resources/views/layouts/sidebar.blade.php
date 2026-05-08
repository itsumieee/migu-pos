<aside class="modern-sidebar fixed lg:static inset-y-0 left-0 z-50 w-72 transform -translate-x-full lg:translate-x-0 transition-transform duration-300 ease-out" :class="{ 'translate-x-0': sidebarOpen }">
    <!-- Logo -->
    <div class="sidebar-header">
        <div class="sidebar-logo">
            <div class="logo-mark">
                <span>M</span>
                <div class="logo-glow"></div>
            </div>
            <div class="logo-text-wrapper">
                <span class="logo-text">{{ \App\Models\Setting::get('store_name', 'MIGU') }}</span>
                <span class="logo-sub">POS System</span>
            </div>
        </div>
        <button @click="sidebarOpen = false" class="close-btn lg:hidden">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
        </button>
    </div>

    <!-- Navigation -->
    <nav class="sidebar-nav">
        @php
            $role = Auth::check() ? Auth::user()->role : 'guest';
            $links = [
                ['route' => 'dashboard', 'icon' => 'M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6', 'label' => 'Dashboard', 'roles' => ['admin']],
                ['route' => 'pos.index', 'icon' => 'M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z', 'label' => 'Kasir', 'roles' => ['admin', 'kasir']],
                ['route' => 'products.index', 'icon' => 'M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4', 'label' => 'Produk', 'roles' => ['admin']],
                ['route' => 'categories.index', 'icon' => 'M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A2 2 0 013 12V7a4 4 0 014-4z', 'label' => 'Kategori', 'roles' => ['admin']],
                ['route' => 'transactions.index', 'icon' => 'M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z', 'label' => 'Riwayat', 'roles' => ['admin']],
                ['route' => 'reports.sales', 'icon' => 'M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z', 'label' => 'Laporan', 'roles' => ['admin']],
                ['route' => 'settings.index', 'icon' => 'M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z M15 12a3 3 0 11-6 0 3 3 0 016 0z', 'label' => 'Pengaturan', 'roles' => ['admin']],
            ];
        @endphp

        @foreach($links as $link)
            @if(in_array($role, $link['roles']))
            <a href="{{ route($link['route']) }}" class="nav-link {{ request()->routeIs($link['route']) ? 'active' : '' }}">
                <div class="nav-icon-wrapper">
                    <svg class="nav-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="{{ $link['icon'] }}"/></svg>
                    @if(request()->routeIs($link['route']))
                    <span class="nav-indicator"></span>
                    @endif
                </div>
                <span class="nav-label">{{ $link['label'] }}</span>
                <svg class="nav-arrow" width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
            </a>
            @endif
        @endforeach

        <!-- Manajemen User (Hanya Admin) -->
        @if(Auth::check() && Auth::user()->role === 'admin')
        <a href="{{ route('users.index') }}" class="nav-link {{ request()->routeIs('users.*') ? 'active' : '' }}">
            <div class="nav-icon-wrapper">
                <svg class="nav-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/>
                </svg>
                @if(request()->routeIs('users.*'))
                <span class="nav-indicator"></span>
                @endif
            </div>
            <span class="nav-label">Manajemen User</span>
            <svg class="nav-arrow" width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
        </a>

        <!-- Laporan Profit (Hanya Admin) -->
        <a href="{{ route('reports.profit') }}" class="nav-link {{ request()->routeIs('reports.profit') ? 'active' : '' }}">
            <div class="nav-icon-wrapper">
                <svg class="nav-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                @if(request()->routeIs('reports.profit'))
                <span class="nav-indicator"></span>
                @endif
            </div>
            <span class="nav-label">Laporan Profit</span>
            <svg class="nav-arrow" width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
        </a>

        <!-- Jadwal Laporan (Hanya Admin) -->
        <a href="{{ route('settings.reports') }}" class="nav-link {{ request()->routeIs('settings.reports') ? 'active' : '' }}">
            <div class="nav-icon-wrapper">
                <svg class="nav-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                @if(request()->routeIs('settings.reports'))
                <span class="nav-indicator"></span>
                @endif
            </div>
            <span class="nav-label">Jadwal Laporan</span>
            <svg class="nav-arrow" width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
        </a>
        @endif
    </nav>

    <!-- User Profile -->
    <div class="sidebar-footer">
        <div class="user-card">
            <div class="user-avatar">
                <span>{{ substr(Auth::user()->name, 0, 1) }}</span>
                <span class="avatar-status"></span>
            </div>
            <div class="user-info">
                <p class="user-name">{{ Auth::user()->name }}</p>
                <p class="user-role">
                    <span class="role-badge {{ Auth::user()->role }}">{{ Auth::user()->role }}</span>
                </p>
            </div>
            <button class="user-menu-btn">
                <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z"/></svg>
            </button>
        </div>
    </div>
</aside>

<style>
/* ── Modern Dark Sidebar Theme ───────────────────────────── */
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

/* ── Base Sidebar ───────────────────────────────── */
.modern-sidebar {
    font-family: var(--font-main);
    background: var(--bg-secondary);
    border-right: 1px solid var(--border-color);
    display: flex;
    flex-direction: column;
    backdrop-filter: blur(20px);
}

/* ── Header / Logo ───────────────────────────── */
.sidebar-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 1.25rem 1.5rem;
    border-bottom: 1px solid var(--border-color);
    height: 4.5rem;
    position: relative;
}
.sidebar-header::after {
    content: '';
    position: absolute;
    bottom: 0; left: 1.5rem; right: 1.5rem;
    height: 1px;
    background: linear-gradient(90deg, transparent, var(--border-color), transparent);
}

.sidebar-logo {
    display: flex;
    align-items: center;
    gap: 0.875rem;
}

.logo-mark {
    position: relative;
    width: 40px; height: 40px;
    border-radius: var(--radius);
    background: var(--accent-gradient);
    display: flex; align-items: center; justify-content: center;
    font-weight: 800; font-size: 1.1rem; color: white;
    box-shadow: 0 4px 16px var(--accent-glow);
    flex-shrink: 0;
}
.logo-mark span { position: relative; z-index: 2; }
.logo-glow {
    position: absolute;
    inset: -2px;
    border-radius: var(--radius-lg);
    background: var(--accent-gradient);
    filter: blur(8px);
    opacity: 0.6;
    z-index: 1;
}

.logo-text-wrapper { display: flex; flex-direction: column; }
.logo-text {
    font-weight: 800; font-size: 0.95rem; color: var(--text-primary);
    letter-spacing: 0.02em; line-height: 1.2;
}
.logo-sub {
    font-size: 0.7rem; color: var(--text-muted);
    font-weight: 600; text-transform: uppercase;
    letter-spacing: 0.12em; margin-top: 2px;
}

.close-btn {
    width: 36px; height: 36px;
    border-radius: var(--radius);
    border: 1px solid var(--border-color);
    background: var(--bg-card);
    color: var(--text-muted);
    display: flex; align-items: center; justify-content: center;
    cursor: pointer; transition: all 0.2s ease;
}
.close-btn:hover {
    background: var(--bg-elevated);
    color: var(--accent-primary);
    border-color: rgba(255, 51, 102, 0.3);
}

/* ── Navigation ────────────────────────────── */
.sidebar-nav {
    flex: 1;
    padding: 1rem 0.75rem;
    overflow-y: auto;
    display: flex;
    flex-direction: column;
    gap: 0.375rem;
}

.nav-link {
    display: flex;
    align-items: center;
    gap: 0.875rem;
    padding: 0.75rem 1rem;
    border-radius: var(--radius-lg);
    color: var(--text-secondary);
    font-size: 0.9rem;
    font-weight: 500;
    text-decoration: none;
    transition: all 0.2s ease;
    position: relative;
    background: transparent;
}
.nav-link:hover {
    background: var(--bg-hover);
    color: var(--text-primary);
    transform: translateX(4px);
}
.nav-link.active {
    background: linear-gradient(135deg, rgba(255, 51, 102, 0.15), rgba(255, 107, 107, 0.08));
    color: var(--text-primary);
    font-weight: 600;
    border: 1px solid rgba(255, 51, 102, 0.2);
}
.nav-link.active::before {
    content: '';
    position: absolute;
    left: 0; top: 50%; transform: translateY(-50%);
    width: 3px; height: 60%;
    background: var(--accent-gradient);
    border-radius: 0 4px 4px 0;
}

.nav-icon-wrapper {
    position: relative;
    width: 36px; height: 36px;
    border-radius: var(--radius);
    display: flex; align-items: center; justify-content: center;
    flex-shrink: 0;
}
.nav-icon {
    width: 18px; height: 18px;
    transition: all 0.2s ease;
}
.nav-link:hover .nav-icon { transform: scale(1.05); }
.nav-link.active .nav-icon { color: var(--accent-primary); }

.nav-indicator {
    position: absolute;
    top: 50%; left: -8px; transform: translateY(-50%);
    width: 6px; height: 6px;
    border-radius: 50%;
    background: var(--accent-primary);
    box-shadow: 0 0 12px var(--accent-glow);
    animation: pulse 2s ease-in-out infinite;
}

.nav-label { flex: 1; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }

.nav-arrow {
    width: 16px; height: 16px;
    color: var(--text-muted);
    opacity: 0;
    transition: all 0.2s ease;
    flex-shrink: 0;
}
.nav-link:hover .nav-arrow { opacity: 0.6; transform: translateX(2px); }
.nav-link.active .nav-arrow { opacity: 1; color: var(--accent-primary); }

/* ── Footer / User Profile ─────────────────── */
.sidebar-footer {
    padding: 0.75rem;
    border-top: 1px solid var(--border-color);
}

.user-card {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    padding: 0.875rem;
    border-radius: var(--radius-lg);
    background: var(--bg-card);
    border: 1px solid var(--border-color);
    transition: all 0.2s ease;
}
.user-card:hover {
    border-color: rgba(255, 51, 102, 0.2);
    box-shadow: var(--shadow-glow);
}

.user-avatar {
    position: relative;
    width: 40px; height: 40px;
    border-radius: var(--radius);
    background: var(--accent-gradient);
    display: flex; align-items: center; justify-content: center;
    font-weight: 700; font-size: 0.9rem; color: white;
    flex-shrink: 0;
}
.avatar-status {
    position: absolute;
    bottom: -2px; right: -2px;
    width: 12px; height: 12px;
    border-radius: 50%;
    background: var(--success);
    border: 2px solid var(--bg-secondary);
}

.user-info { flex: 1; min-width: 0; }
.user-name {
    font-size: 0.9rem; font-weight: 600; color: var(--text-primary);
    white-space: nowrap; overflow: hidden; text-overflow: ellipsis;
}
.user-role { margin-top: 2px; }

.role-badge {
    display: inline-block;
    padding: 2px 8px;
    border-radius: 20px;
    font-size: 0.7rem; font-weight: 600;
    text-transform: uppercase; letter-spacing: 0.05em;
}
.role-badge.admin {
    background: rgba(255, 51, 102, 0.15);
    color: var(--accent-primary);
}
.role-badge.kasir {
    background: rgba(0, 217, 163, 0.15);
    color: var(--success);
}
.role-badge.guest {
    background: var(--bg-elevated);
    color: var(--text-muted);
}

.user-menu-btn {
    width: 32px; height: 32px;
    border-radius: var(--radius);
    border: none;
    background: var(--bg-elevated);
    color: var(--text-muted);
    display: flex; align-items: center; justify-content: center;
    cursor: pointer; transition: all 0.2s ease;
}
.user-menu-btn:hover {
    background: var(--bg-hover);
    color: var(--accent-primary);
}

/* ── Animations ───────────────────────────── */
@keyframes pulse {
    0%, 100% { opacity: 1; transform: translateY(-50%) scale(1); }
    50% { opacity: 0.7; transform: translateY(-50%) scale(0.9); }
}

/* ── Scrollbar ───────────────────────────── */
.sidebar-nav::-webkit-scrollbar { width: 4px; }
.sidebar-nav::-webkit-scrollbar-track { background: transparent; }
.sidebar-nav::-webkit-scrollbar-thumb {
    background: var(--bg-elevated);
    border-radius: 4px;
}
.sidebar-nav::-webkit-scrollbar-thumb:hover {
    background: var(--accent-primary);
}

/* ── Responsive ─────────────────────────── */
@media (max-width: 1024px) {
    .modern-sidebar {
        box-shadow: var(--shadow-lg);
        background: var(--bg-secondary);
    }
}

@media (max-width: 640px) {
    .modern-sidebar { width: 280px; }
    .logo-text { font-size: 0.9rem; }
    .nav-label { font-size: 0.875rem; }
}

/* ── Focus States ───────────────────────── */
.nav-link:focus-visible,
.close-btn:focus-visible,
.user-menu-btn:focus-visible {
    outline: 2px solid var(--accent-primary);
    outline-offset: 2px;
}

/* ── Reduced Motion ─────────────────────── */
@media (prefers-reduced-motion: reduce) {
    *, *::before, *::after {
        animation-duration: 0.01ms !important;
        transition-duration: 0.01ms !important;
    }
}
</style>