<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Migu STORE')</title>
    
    <!-- Modern Font -->
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <style>
    /* ── Modern Dark Theme CSS Variables ───────────────────── */
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
        
        --font-main: 'Plus Jakarta Sans', system-ui, sans-serif;
    }

    /* ── Base Reset ───────────────────────────────── */
    * { box-sizing: border-box; margin: 0; padding: 0; }
    
    body {
        font-family: var(--font-main);
        background: var(--bg-primary);
        color: var(--text-primary);
        -webkit-font-smoothing: antialiased;
        -moz-osx-font-smoothing: grayscale;
        min-height: 100vh;
        background-image: 
            radial-gradient(at 0% 0%, rgba(255, 51, 102, 0.1) 0px, transparent 50%),
            radial-gradient(at 100% 100%, rgba(0, 217, 163, 0.08) 0px, transparent 50%);
        background-attachment: fixed;
    }

    /* ── Animations ─────────────────────────────── */
    @keyframes fadeIn { from { opacity: 0; } to { opacity: 1; } }
    @keyframes slideUp { from { opacity: 0; transform: translateY(12px); } to { opacity: 1; transform: translateY(0); } }
    @keyframes pulse { 0%, 100% { opacity: 1; } 50% { opacity: 0.6; } }
    @keyframes float { 0%, 100% { transform: translateY(0); } 50% { transform: translateY(-4px); } }

    .animate-fade { animation: fadeIn 0.3s ease-out; }
    .animate-slide { animation: slideUp 0.4s ease-out; }
    .animate-pulse-custom { animation: pulse 2s ease-in-out infinite; }
    .animate-float { animation: float 3s ease-in-out infinite; }

    /* ── Utility Classes ───────────────────────── */
    .glass {
        background: rgba(18, 18, 26, 0.7);
        backdrop-filter: blur(20px);
        border: 1px solid var(--border-color);
    }
    .gradient-primary {
        background: var(--accent-gradient);
        box-shadow: 0 4px 20px var(--accent-glow);
    }
    .text-gradient {
        background: linear-gradient(135deg, var(--text-primary) 0%, var(--text-secondary) 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }
    .border-subtle { border-color: var(--border-color) !important; }
    .bg-card { background: var(--bg-card); }
    .bg-elevated { background: var(--bg-elevated); }
    .text-muted { color: var(--text-muted); }
    .text-secondary { color: var(--text-secondary); }

    /* ── Scrollbar ───────────────────────────── */
    ::-webkit-scrollbar { width: 6px; height: 6px; }
    ::-webkit-scrollbar-track { background: transparent; }
    ::-webkit-scrollbar-thumb {
        background: var(--bg-elevated);
        border-radius: 3px;
    }
    ::-webkit-scrollbar-thumb:hover { background: var(--accent-primary); }

    /* ── Focus States ───────────────────────── */
    a:focus-visible, button:focus-visible, input:focus-visible {
        outline: 2px solid var(--accent-primary);
        outline-offset: 2px;
    }

    /* ── x-cloak for Alpine.js ─────────────── */
    [x-cloak] { display: none !important; }

    /* ── Reduced Motion ───────────────────── */
    @media (prefers-reduced-motion: reduce) {
        *, *::before, *::after {
            animation-duration: 0.01ms !important;
            transition-duration: 0.01ms !important;
        }
    }
    </style>
    
    @yield('styles')
</head>
<body class="antialiased">

    <!-- MODERN NAVBAR -->
    <nav class="modern-navbar sticky top-0 z-50">
        <div class="navbar-container">
            
            <!-- Logo & Auth Buttons -->
            <div class="navbar-left">
                <a href="{{ route('home') }}" class="logo-link">
                    <div class="logo-mark">
                        <span>M</span>
                        <div class="logo-glow"></div>
                    </div>
                    <span class="logo-text">Migu STORE</span>
                </a>

                <!-- Login/Register (Guest Only) -->
                @guest
                <div class="auth-buttons">
                    <a href="{{ route('login') }}" class="btn btn-ghost">Masuk</a>
                    <a href="{{ route('register') }}" class="btn btn-primary">Daftar</a>
                </div>
                @endguest
            </div>

            <!-- Search Bar -->
            <div class="navbar-center">
                <div class="search-wrapper">
                    <svg class="search-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                    <input type="text" placeholder="Cari produk..." class="search-input">
                    <kbd class="search-hint">⌘K</kbd>
                </div>
            </div>

            <!-- User Menu -->
            <div class="navbar-right">
                @auth
                    <!-- Cart Button -->
                    <a href="#" class="icon-btn" title="Keranjang">
                        <svg class="icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                        </svg>
                        <span class="badge badge-danger">3</span>
                    </a>
                    
                    <!-- Profile Dropdown -->
                    <div class="relative" x-data="{ open: false }">
                        <button @click="open = !open" class="profile-btn">
                            <div class="profile-avatar">
                                <img src="https://ui-avatars.com/api/?name={{ Auth::user()->name }}&background=ff3366&color=fff" alt="{{ Auth::user()->name }}" class="avatar-img">
                                <span class="avatar-status"></span>
                            </div>
                            <span class="profile-name">{{ Auth::user()->name }}</span>
                            <svg class="profile-arrow" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </button>
                        
                        <!-- Dropdown Menu -->
                        <div x-show="open" @click.outside="open = false" 
                             x-transition:enter="transition ease-out duration-200"
                             x-transition:enter-start="opacity-0 translate-y-2"
                             x-transition:enter-end="opacity-100 translate-y-0"
                             x-transition:leave="transition ease-in duration-150"
                             x-transition:leave-start="opacity-100 translate-y-0"
                             x-transition:leave-end="opacity-0 translate-y-2"
                             class="dropdown-menu profile-dropdown" x-cloak>
                            
                            <div class="dropdown-header">
                                <div class="dropdown-avatar">
                                    <img src="https://ui-avatars.com/api/?name={{ Auth::user()->name }}&background=ff3366&color=fff" alt="{{ Auth::user()->name }}">
                                </div>
                                <div>
                                    <p class="dropdown-name">{{ Auth::user()->name }}</p>
                                    <p class="dropdown-email">{{ Auth::user()->email }}</p>
                                </div>
                            </div>
                            
                            <div class="dropdown-items">
                                <a href="#" class="dropdown-item">
                                    <svg class="item-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                                    <span>Profil Saya</span>
                                </a>
                                <a href="#" class="dropdown-item">
                                    <svg class="item-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/></svg>
                                    <span>Pesanan</span>
                                    <span class="item-badge">2 baru</span>
                                </a>
                                <a href="#" class="dropdown-item">
                                    <svg class="item-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/></svg>
                                    <span>Wishlist</span>
                                </a>
                            </div>
                            
                            <div class="dropdown-divider"></div>
                            
                            <div class="dropdown-footer">
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="dropdown-logout">
                                        <svg class="item-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                                        <span>Keluar</span>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @else
                    <!-- Mobile Login Button -->
                    <a href="{{ route('login') }}" class="btn btn-primary md:hidden">Masuk</a>
                @endauth
            </div>

        </div>
    </nav>

    <!-- MAIN CONTENT -->
    <main class="main-content">
        @yield('content')
    </main>

    <!-- MODERN FOOTER -->
    <footer class="modern-footer">
        <div class="footer-container">
            <div class="footer-brand">
                <div class="footer-logo">
                    <div class="logo-mark logo-mark-sm">
                        <span>M</span>
                    </div>
                    <span class="footer-logo-text">Migu STORE</span>
                </div>
                <p class="footer-tagline">Fashion Modern & Terpercaya</p>
            </div>
            
            <div class="footer-links">
                <div class="footer-column">
                    <h4 class="footer-heading">Toko</h4>
                    <a href="#" class="footer-link">Produk Terbaru</a>
                    <a href="#" class="footer-link">Promo</a>
                    <a href="#" class="footer-link">Kategori</a>
                </div>
                <div class="footer-column">
                    <h4 class="footer-heading">Bantuan</h4>
                    <a href="#" class="footer-link">FAQ</a>
                    <a href="#" class="footer-link">Pengiriman</a>
                    <a href="#" class="footer-link">Retur</a>
                </div>
                <div class="footer-column">
                    <h4 class="footer-heading">Legal</h4>
                    <a href="#" class="footer-link">Privacy</a>
                    <a href="#" class="footer-link">Terms</a>
                    <a href="#" class="footer-link">Kontak</a>
                </div>
            </div>
        </div>
        
        <div class="footer-bottom">
            <p class="copyright">&copy; {{ date('Y') }} Migu STORE. All rights reserved.</p>
            <div class="social-links">
                <a href="#" class="social-link" title="Instagram">
                    <svg width="18" height="18" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
                </a>
                <a href="#" class="social-link" title="Twitter">
                    <svg width="18" height="18" fill="currentColor" viewBox="0 0 24 24"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>
                </a>
                <a href="#" class="social-link" title="WhatsApp">
                    <svg width="18" height="18" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
                </a>
            </div>
        </div>
    </footer>

    <!-- Inline Styles for Components -->
    <style>
    /* ── Navbar Styles ───────────────────────── */
    .modern-navbar {
        background: rgba(18, 18, 26, 0.8);
        backdrop-filter: blur(20px);
        border-bottom: 1px solid var(--border-color);
    }
    .navbar-container {
        max-width: 1440px;
        margin: 0 auto;
        padding: 0 1.5rem;
        display: flex;
        align-items: center;
        justify-content: space-between;
        height: 4.5rem;
    }
    .navbar-left, .navbar-right {
        display: flex; align-items: center; gap: 0.75rem;
    }
    .navbar-center { flex: 1; max-width: 480px; margin: 0 2rem; }

    /* Logo */
    .logo-link {
        display: flex; align-items: center; gap: 0.75rem;
        text-decoration: none;
    }
    .logo-mark {
        position: relative;
        width: 36px; height: 36px;
        border-radius: var(--radius);
        background: var(--accent-gradient);
        display: flex; align-items: center; justify-content: center;
        font-weight: 800; font-size: 1rem; color: white;
        box-shadow: 0 4px 16px var(--accent-glow);
        flex-shrink: 0;
    }
    .logo-mark span { position: relative; z-index: 2; }
    .logo-glow {
        position: absolute; inset: -2px;
        border-radius: var(--radius-lg);
        background: var(--accent-gradient);
        filter: blur(8px); opacity: 0.6; z-index: 1;
    }
    .logo-text {
        font-weight: 800; font-size: 1.1rem;
        background: linear-gradient(135deg, var(--text-primary), var(--text-secondary));
        -webkit-background-clip: text; -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    /* Auth Buttons */
    .auth-buttons {
        display: none; align-items: center; gap: 0.5rem;
        margin-left: 1rem; padding-left: 1rem;
        border-left: 1px solid var(--border-color);
    }
    @media (min-width: 768px) { .auth-buttons { display: flex; } }

    /* Buttons */
    .btn {
        padding: 0.5rem 1.25rem;
        border-radius: var(--radius);
        font-size: 0.875rem; font-weight: 600;
        text-decoration: none; transition: all 0.2s ease;
        display: inline-flex; align-items: center; justify-content: center;
    }
    .btn-ghost {
        background: transparent; color: var(--text-secondary);
        border: 1px solid var(--border-color);
    }
    .btn-ghost:hover {
        background: var(--bg-hover); color: var(--accent-primary);
        border-color: rgba(255, 51, 102, 0.3);
    }
    .btn-primary {
        background: var(--accent-gradient); color: white;
        border: none; box-shadow: 0 4px 16px var(--accent-glow);
    }
    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 24px var(--accent-glow);
    }

    /* Search */
    .search-wrapper {
        position: relative;
        display: flex; align-items: center;
    }
    .search-icon {
        position: absolute; left: 1rem;
        width: 16px; height: 16px; color: var(--text-muted);
    }
    .search-input {
        width: 100%;
        padding: 0.625rem 1rem 0.625rem 2.5rem;
        background: var(--bg-card);
        border: 1px solid var(--border-color);
        border-radius: var(--radius-lg);
        font-size: 0.875rem; color: var(--text-primary);
        transition: all 0.2s ease;
    }
    .search-input::placeholder { color: var(--text-muted); }
    .search-input:focus {
        outline: none;
        border-color: var(--accent-primary);
        box-shadow: 0 0 0 3px rgba(255, 51, 102, 0.15);
        background: var(--bg-elevated);
    }
    .search-hint {
        position: absolute; right: 0.75rem;
        font-size: 0.7rem; color: var(--text-muted);
        background: var(--bg-elevated); padding: 2px 6px;
        border-radius: 4px; border: 1px solid var(--border-color);
    }

    /* Icon Buttons */
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
        background: var(--bg-hover); color: var(--accent-primary);
        border-color: rgba(255, 51, 102, 0.3);
    }
    .icon { width: 18px; height: 18px; }

    /* Badges */
    .badge {
        position: absolute; top: 6px; right: 6px;
        min-width: 16px; height: 16px; padding: 0 4px;
        border-radius: 8px; font-size: 9px; font-weight: 700;
        display: flex; align-items: center; justify-content: center;
    }
    .badge-danger { background: var(--accent-primary); color: white; }

    /* Profile Button */
    .profile-btn {
        display: flex; align-items: center; gap: 0.5rem;
        padding: 0.25rem 0.5rem 0.25rem 0.25rem;
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
        width: 32px; height: 32px;
        border-radius: var(--radius);
        overflow: hidden; flex-shrink: 0;
    }
    .avatar-img { width: 100%; height: 100%; object-fit: cover; }
    .avatar-status {
        position: absolute; bottom: 0; right: 0;
        width: 10px; height: 10px;
        border-radius: 50%; background: var(--success);
        border: 2px solid var(--bg-card);
    }
    .profile-name {
        font-size: 0.875rem; font-weight: 600; color: var(--text-primary);
        display: none;
    }
    @media (min-width: 640px) { .profile-name { display: block; } }
    .profile-arrow {
        width: 14px; height: 14px; color: var(--text-muted);
        transition: transform 0.2s ease;
    }
    .profile-btn:hover .profile-arrow { transform: rotate(180deg); }

    /* Dropdown Menu */
    .dropdown-menu {
        position: absolute; right: 0; top: calc(100% + 8px);
        min-width: 260px;
        background: var(--bg-card);
        border: 1px solid var(--border-color);
        border-radius: var(--radius-lg);
        box-shadow: var(--shadow-lg), var(--shadow-glow);
        overflow: hidden; z-index: 1000;
    }
    .profile-dropdown { min-width: 240px; }

    .dropdown-header {
        display: flex; align-items: center; gap: 0.75rem;
        padding: 1rem 1.25rem;
        border-bottom: 1px solid var(--border-light);
    }
    .dropdown-avatar {
        width: 40px; height: 40px;
        border-radius: var(--radius);
        overflow: hidden; flex-shrink: 0;
    }
    .dropdown-avatar img { width: 100%; height: 100%; object-fit: cover; }
    .dropdown-name {
        font-size: 0.9rem; font-weight: 600; color: var(--text-primary);
        margin: 0; line-height: 1.2;
    }
    .dropdown-email {
        font-size: 0.75rem; color: var(--text-muted);
        margin: 2px 0 0 0;
    }

    .dropdown-items { padding: 0.5rem; }
    .dropdown-item {
        display: flex; align-items: center; gap: 0.75rem;
        padding: 0.625rem 0.875rem;
        border-radius: var(--radius);
        font-size: 0.875rem; font-weight: 500;
        color: var(--text-secondary);
        text-decoration: none; transition: all 0.15s ease;
    }
    .dropdown-item:hover {
        background: var(--bg-hover); color: var(--text-primary);
    }
    .dropdown-item:hover .item-icon { color: var(--accent-primary); }
    .item-icon {
        width: 18px; height: 18px; color: var(--text-muted);
        flex-shrink: 0; transition: color 0.15s ease;
    }
    .item-badge {
        margin-left: auto;
        font-size: 0.7rem; font-weight: 600;
        background: var(--accent-primary); color: white;
        padding: 2px 8px; border-radius: 10px;
    }

    .dropdown-divider {
        height: 1px; background: var(--border-light);
        margin: 0.375rem 0.5rem;
    }

    .dropdown-footer { padding: 0.5rem; }
    .dropdown-logout {
        display: flex; align-items: center; gap: 0.75rem;
        width: 100%; padding: 0.625rem 0.875rem;
        border: none; border-radius: var(--radius);
        background: transparent;
        font-size: 0.875rem; font-weight: 500;
        color: var(--accent-primary);
        cursor: pointer; transition: all 0.15s ease;
        text-align: left;
    }
    .dropdown-logout:hover { background: rgba(255, 51, 102, 0.1); }

    /* ── Main Content ───────────────────────── */
    .main-content {
        min-height: calc(100vh - 18rem);
        padding: 2rem 1.5rem;
    }

    /* ── Footer Styles ─────────────────────── */
    .modern-footer {
        background: var(--bg-secondary);
        border-top: 1px solid var(--border-color);
        padding: 2.5rem 1.5rem 1.5rem;
        margin-top: 3rem;
    }
    .footer-container {
        max-width: 1440px; margin: 0 auto;
        display: grid; grid-template-columns: 1fr auto;
        gap: 2rem; align-items: start;
    }
    @media (max-width: 768px) {
        .footer-container { grid-template-columns: 1fr; text-align: center; }
    }

    .footer-brand { display: flex; flex-direction: column; gap: 0.75rem; }
    @media (max-width: 768px) { .footer-brand { align-items: center; } }
    
    .footer-logo { display: flex; align-items: center; gap: 0.5rem; }
    @media (max-width: 768px) { .footer-logo { justify-content: center; } }
    
    .logo-mark-sm { width: 32px; height: 32px; font-size: 0.9rem; }
    
    .footer-logo-text {
        font-weight: 800; font-size: 1rem; color: var(--text-primary);
    }
    .footer-tagline {
        font-size: 0.875rem; color: var(--text-muted); margin: 0;
    }

    .footer-links {
        display: flex; gap: 3rem;
    }
    @media (max-width: 768px) {
        .footer-links {
            justify-content: center;
            flex-wrap: wrap; gap: 1.5rem;
        }
    }

    .footer-column { display: flex; flex-direction: column; gap: 0.5rem; }
    .footer-heading {
        font-size: 0.8rem; font-weight: 700;
        color: var(--text-muted); text-transform: uppercase;
        letter-spacing: 0.08em; margin: 0 0 0.5rem 0;
    }
    .footer-link {
        font-size: 0.875rem; color: var(--text-secondary);
        text-decoration: none; transition: color 0.15s ease;
    }
    .footer-link:hover { color: var(--accent-primary); }

    .footer-bottom {
        max-width: 1440px; margin: 2rem auto 0;
        padding-top: 1.5rem; border-top: 1px solid var(--border-light);
        display: flex; align-items: center; justify-content: space-between;
        flex-wrap: wrap; gap: 1rem;
    }
    @media (max-width: 768px) {
        .footer-bottom { justify-content: center; text-align: center; }
    }
    
    .copyright {
        font-size: 0.8rem; color: var(--text-muted); margin: 0;
    }
    
    .social-links { display: flex; gap: 0.5rem; }
    .social-link {
        width: 36px; height: 36px;
        border-radius: var(--radius);
        background: var(--bg-card);
        border: 1px solid var(--border-color);
        color: var(--text-muted);
        display: flex; align-items: center; justify-content: center;
        text-decoration: none; transition: all 0.2s ease;
    }
    .social-link:hover {
        background: var(--bg-hover); color: var(--accent-primary);
        border-color: rgba(255, 51, 102, 0.3);
        transform: translateY(-2px);
    }

    /* ── Responsive ───────────────────────── */
    @media (max-width: 1024px) {
        .navbar-center { margin: 0 1rem; }
    }
    @media (max-width: 768px) {
        .navbar-container { padding: 0 1rem; height: 4rem; }
        .navbar-center { display: none; }
        .logo-text { font-size: 1rem; }
        .main-content { padding: 1.5rem 1rem; }
    }
    </style>

    @yield('scripts')
</body>
</html>