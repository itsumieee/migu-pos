<nav x-data="{ open: false }" class="modern-navbar">
    <!-- Primary Navigation Menu -->
    <div class="navbar-inner">
        <div class="navbar-left">
            <!-- Logo -->
            <div class="navbar-logo">
                <a href="{{ route('dashboard') }}" class="logo-link">
                    <x-application-logo class="logo-icon" />
                    <span class="logo-text">{{ \App\Models\Setting::get('store_name', 'MIGU') }}</span>
                </a>
            </div>

            <!-- Desktop Navigation Links -->
            <div class="desktop-nav">
                <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" class="nav-link">
                    {{ __('Dashboard') }}
                    <span class="nav-indicator"></span>
                </x-nav-link>
            </div>
        </div>

        <!-- Right Side: User + Actions -->
        <div class="navbar-right">
            <!-- Notifications (Optional) -->
            <button class="icon-btn" title="Notifikasi">
                <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                </svg>
                <span class="badge-dot"></span>
            </button>

            <!-- Settings Dropdown -->
            <x-dropdown align="right" width="48">
                <x-slot name="trigger">
                    <button class="user-btn">
                        <div class="user-avatar">
                            <span>{{ substr(Auth::user()->name, 0, 1) }}</span>
                            <span class="avatar-status"></span>
                        </div>
                        <span class="user-name">{{ Auth::user()->name }}</span>
                        <svg class="user-arrow" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                    </button>
                </x-slot>

                <x-slot name="content">
                    <div class="dropdown-header">
                        <p class="dropdown-user">{{ Auth::user()->name }}</p>
                        <p class="dropdown-email">{{ Auth::user()->email }}</p>
                    </div>
                    
                    <x-dropdown-link :href="route('profile.edit')" class="dropdown-item">
                        <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                        {{ __('Profile') }}
                    </x-dropdown-link>

                    <x-dropdown-link :href="route('settings.index')" class="dropdown-item">
                        <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                        {{ __('Settings') }}
                    </x-dropdown-link>

                    <div class="dropdown-divider"></div>

                    <!-- Authentication -->
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <x-dropdown-link :href="route('logout')"
                                onclick="event.preventDefault();
                                            this.closest('form').submit();"
                                class="dropdown-item dropdown-logout">
                            <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                            {{ __('Log Out') }}
                        </x-dropdown-link>
                    </form>
                </x-slot>
            </x-dropdown>

            <!-- Hamburger (Mobile) -->
            <div class="mobile-toggle">
                <button @click="open = ! open" class="hamburger-btn">
                    <svg class="hamburger-icon" :class="{'hidden': open, 'block': ! open }" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                    <svg class="hamburger-icon" :class="{'hidden': ! open, 'block': open }" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu (Mobile) -->
    <div :class="{'block': open, 'hidden': ! open}" class="mobile-menu">
        <div class="mobile-nav-links">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" class="mobile-link">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>
        </div>

        <!-- Mobile User Section -->
        <div class="mobile-user-section">
            <div class="mobile-user-card">
                <div class="mobile-avatar">
                    <span>{{ substr(Auth::user()->name, 0, 1) }}</span>
                </div>
                <div class="mobile-user-details">
                    <p class="mobile-user-name">{{ Auth::user()->name }}</p>
                    <p class="mobile-user-email">{{ Auth::user()->email }}</p>
                </div>
            </div>
            
            <div class="mobile-actions">
                <x-responsive-nav-link :href="route('profile.edit')" class="mobile-link">
                    <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                    {{ __('Profile') }}
                </x-responsive-nav-link>
                
                <x-responsive-nav-link :href="route('settings.index')" class="mobile-link">
                    <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                    {{ __('Settings') }}
                </x-responsive-nav-link>
                
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();"
                            class="mobile-link mobile-logout">
                        <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>

<style>
/* ── Modern Dark Navbar Theme ───────────────────────────── */
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

/* ── Base Navbar ───────────────────────────────── */
.modern-navbar {
    font-family: var(--font-main);
    background: rgba(18, 18, 26, 0.8);
    backdrop-filter: blur(20px);
    border-bottom: 1px solid var(--border-color);
    position: sticky;
    top: 0;
    z-index: 100;
}

.navbar-inner {
    max-width: 1440px;
    margin: 0 auto;
    padding: 0 1.5rem;
    display: flex;
    align-items: center;
    justify-content: space-between;
    height: 4.5rem;
}

.navbar-left,
.navbar-right {
    display: flex;
    align-items: center;
    gap: 1rem;
}

/* ── Logo ───────────────────────────────── */
.navbar-logo { display: flex; align-items: center; }

.logo-link {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    text-decoration: none;
}

.logo-icon {
    height: 2rem;
    width: auto;
    color: var(--text-primary);
    transition: transform 0.2s ease;
}
.logo-link:hover .logo-icon { transform: scale(1.05); }

.logo-text {
    font-weight: 800;
    font-size: 1.1rem;
    color: var(--text-primary);
    letter-spacing: -0.02em;
}

/* ── Desktop Nav Links ───────────────────── */
.desktop-nav { display: none; }
@media (min-width: 768px) { .desktop-nav { display: flex; } }

.nav-link {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    padding: 0.625rem 1rem;
    border-radius: var(--radius);
    font-size: 0.9rem;
    font-weight: 500;
    color: var(--text-secondary);
    text-decoration: none;
    transition: all 0.2s ease;
    position: relative;
}
.nav-link:hover {
    color: var(--text-primary);
    background: var(--bg-hover);
}
.nav-link.active {
    color: var(--text-primary);
    background: linear-gradient(135deg, rgba(255, 51, 102, 0.15), rgba(255, 107, 107, 0.08));
}
.nav-link.active .nav-indicator {
    opacity: 1;
    transform: scaleX(1);
}

.nav-indicator {
    position: absolute;
    bottom: -1px; left: 1rem; right: 1rem;
    height: 2px;
    background: var(--accent-gradient);
    border-radius: 2px;
    opacity: 0;
    transform: scaleX(0);
    transition: all 0.2s ease;
}

/* ── Icon Buttons ───────────────────────── */
.icon-btn {
    position: relative;
    width: 40px; height: 40px;
    border-radius: var(--radius);
    border: 1px solid var(--border-color);
    background: var(--bg-card);
    color: var(--text-secondary);
    display: flex; align-items: center; justify-content: center;
    cursor: pointer; transition: all 0.2s ease;
}
.icon-btn:hover {
    background: var(--bg-hover);
    color: var(--accent-primary);
    border-color: rgba(255, 51, 102, 0.3);
}

.badge-dot {
    position: absolute;
    top: 10px; right: 10px;
    width: 8px; height: 8px;
    border-radius: 50%;
    background: var(--accent-primary);
    border: 2px solid var(--bg-secondary);
    animation: pulse 2s ease-in-out infinite;
}

/* ── User Button ────────────────────────── */
.user-btn {
    display: flex;
    align-items: center;
    gap: 0.625rem;
    padding: 0.375rem 0.75rem 0.375rem 0.375rem;
    border-radius: var(--radius-xl);
    background: var(--bg-card);
    border: 1px solid var(--border-color);
    cursor: pointer; transition: all 0.2s ease;
}
.user-btn:hover {
    border-color: rgba(255, 51, 102, 0.3);
    box-shadow: var(--shadow-glow);
}

.user-avatar {
    position: relative;
    width: 32px; height: 32px;
    border-radius: var(--radius);
    background: var(--accent-gradient);
    display: flex; align-items: center; justify-content: center;
    font-weight: 700; font-size: 0.85rem; color: white;
    flex-shrink: 0;
}
.avatar-status {
    position: absolute;
    bottom: -2px; right: -2px;
    width: 10px; height: 10px;
    border-radius: 50%;
    background: var(--success);
    border: 2px solid var(--bg-card);
}

.user-name {
    font-size: 0.9rem;
    font-weight: 600;
    color: var(--text-primary);
    max-width: 120px;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}
@media (max-width: 640px) { .user-name { display: none; } }

.user-arrow {
    width: 14px; height: 14px;
    color: var(--text-muted);
    transition: transform 0.2s ease;
}
.user-btn:hover .user-arrow { transform: rotate(180deg); color: var(--accent-primary); }

/* ── Dropdown Menu Override ─────────────── */
.modern-navbar .dropdown-menu {
    background: var(--bg-card) !important;
    border: 1px solid var(--border-color) !important;
    border-radius: var(--radius-lg) !important;
    box-shadow: var(--shadow-lg), var(--shadow-glow) !important;
    padding: 0.5rem !important;
    min-width: 220px !important;
    margin-top: 0.5rem !important;
}

.dropdown-header {
    padding: 0.75rem 1rem;
    border-bottom: 1px solid var(--border-light);
    margin-bottom: 0.25rem;
}
.dropdown-user {
    font-weight: 600; color: var(--text-primary);
    font-size: 0.9rem; margin-bottom: 2px;
}
.dropdown-email {
    font-size: 0.75rem; color: var(--text-muted);
}

.dropdown-item {
    display: flex; align-items: center; gap: 0.625rem;
    padding: 0.625rem 0.875rem !important;
    border-radius: var(--radius) !important;
    font-size: 0.875rem; font-weight: 500;
    color: var(--text-secondary) !important;
    text-decoration: none !important;
    transition: all 0.15s ease !important;
}
.dropdown-item:hover {
    background: var(--bg-hover) !important;
    color: var(--text-primary) !important;
}
.dropdown-item svg { color: var(--text-muted); transition: color 0.15s; }
.dropdown-item:hover svg { color: var(--accent-primary); }

.dropdown-divider {
    height: 1px;
    background: var(--border-light);
    margin: 0.375rem 0.5rem;
}

.dropdown-logout { color: var(--accent-primary) !important; }
.dropdown-logout:hover {
    background: rgba(255, 51, 102, 0.15) !important;
}

/* ── Mobile Toggle ──────────────────────── */
.mobile-toggle { display: flex; }
@media (min-width: 768px) { .mobile-toggle { display: none; } }

.hamburger-btn {
    width: 40px; height: 40px;
    border-radius: var(--radius);
    border: 1px solid var(--border-color);
    background: var(--bg-card);
    color: var(--text-secondary);
    display: flex; align-items: center; justify-content: center;
    cursor: pointer; transition: all 0.2s ease;
}
.hamburger-btn:hover {
    background: var(--bg-hover);
    color: var(--accent-primary);
    border-color: rgba(255, 51, 102, 0.3);
}
.hamburger-icon { width: 20px; height: 20px; }

/* ── Mobile Menu ───────────────────────── */
.mobile-menu {
    background: var(--bg-secondary);
    border-top: 1px solid var(--border-color);
    padding: 1rem 1.5rem;
}

.mobile-nav-links {
    display: flex; flex-direction: column; gap: 0.375rem;
    padding-bottom: 1rem; border-bottom: 1px solid var(--border-light);
}

.mobile-link {
    display: flex; align-items: center; gap: 0.75rem;
    padding: 0.75rem 1rem;
    border-radius: var(--radius);
    font-size: 0.9rem; font-weight: 500;
    color: var(--text-secondary);
    text-decoration: none;
    transition: all 0.15s ease;
}
.mobile-link:hover {
    background: var(--bg-hover);
    color: var(--text-primary);
}
.mobile-link.active {
    background: linear-gradient(135deg, rgba(255, 51, 102, 0.15), rgba(255, 107, 107, 0.08));
    color: var(--text-primary);
}
.mobile-link svg { color: var(--text-muted); }
.mobile-link:hover svg { color: var(--accent-primary); }

.mobile-link.mobile-logout { color: var(--accent-primary); }

/* ── Mobile User Section ───────────────── */
.mobile-user-section { padding-top: 1rem; }

.mobile-user-card {
    display: flex; align-items: center; gap: 0.875rem;
    padding: 0.875rem;
    background: var(--bg-card);
    border: 1px solid var(--border-color);
    border-radius: var(--radius-lg);
    margin-bottom: 1rem;
}

.mobile-avatar {
    width: 40px; height: 40px;
    border-radius: var(--radius);
    background: var(--accent-gradient);
    display: flex; align-items: center; justify-content: center;
    font-weight: 700; font-size: 0.9rem; color: white;
    flex-shrink: 0;
}

.mobile-user-details { flex: 1; min-width: 0; }
.mobile-user-name {
    font-weight: 600; color: var(--text-primary);
    font-size: 0.9rem; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;
}
.mobile-user-email {
    font-size: 0.75rem; color: var(--text-muted);
    margin-top: 2px;
}

.mobile-actions {
    display: flex; flex-direction: column; gap: 0.25rem;
}

/* ── Animations ───────────────────────── */
@keyframes pulse {
    0%, 100% { opacity: 1; transform: scale(1); }
    50% { opacity: 0.7; transform: scale(0.9); }
}

/* ── Scrollbar ───────────────────────── */
.mobile-menu::-webkit-scrollbar { width: 4px; }
.mobile-menu::-webkit-scrollbar-track { background: transparent; }
.mobile-menu::-webkit-scrollbar-thumb {
    background: var(--bg-elevated);
    border-radius: 4px;
}
.mobile-menu::-webkit-scrollbar-thumb:hover {
    background: var(--accent-primary);
}

/* ── Responsive ───────────────────────── */
@media (max-width: 640px) {
    .navbar-inner { padding: 0 1rem; height: 4rem; }
    .logo-text { font-size: 1rem; }
    .user-btn { padding: 0.25rem; }
    .user-name { display: none; }
}

/* ── Focus States ─────────────────────── */
.icon-btn:focus-visible,
.user-btn:focus-visible,
.hamburger-btn:focus-visible,
.nav-link:focus-visible,
.mobile-link:focus-visible,
.dropdown-item:focus-visible {
    outline: 2px solid var(--accent-primary);
    outline-offset: 2px;
}

/* ── Reduced Motion ───────────────────── */
@media (prefers-reduced-motion: reduce) {
    *, *::before, *::after {
        animation-duration: 0.01ms !important;
        transition-duration: 0.01ms !important;
    }
}
</style>