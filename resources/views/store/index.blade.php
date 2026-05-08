@extends('layouts.customer')

@section('content')
@verbatim
<style>
/* ── Modern Dark Theme CSS Variables ───────────────────────── */
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
*, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

body {
    font-family: var(--font-main);
    background: var(--bg-primary);
    color: var(--text-primary);
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
    min-height: 100vh;
    position: relative;
    overflow-x: hidden;
    background-image: 
        radial-gradient(at 0% 0%, rgba(255, 51, 102, 0.12) 0px, transparent 50%),
        radial-gradient(at 100% 100%, rgba(0, 217, 163, 0.08) 0px, transparent 50%);
    background-attachment: fixed;
}

/* ── Animations ─────────────────────────────── */
@keyframes fadeIn { from { opacity: 0; } to { opacity: 1; } }
@keyframes slideUp { from { opacity: 0; transform: translateY(20px); } to { opacity: 1; transform: translateY(0); } }
@keyframes float { 0%, 100% { transform: translateY(0); } 50% { transform: translateY(-6px); } }
@keyframes pulse { 0%, 100% { opacity: 1; } 50% { opacity: 0.6; } }
@keyframes shimmer { 0% { background-position: -200% 0; } 100% { background-position: 200% 0; } }

.animate-fade { animation: fadeIn 0.4s ease-out; }
.animate-slide { animation: slideUp 0.5s ease-out both; }
.animate-float { animation: float 4s ease-in-out infinite; }
.animate-pulse-custom { animation: pulse 2s ease-in-out infinite; }
.animate-shimmer {
    background: linear-gradient(90deg, transparent, rgba(255,255,255,0.05), transparent);
    background-size: 200% 100%;
    animation: shimmer 2s infinite;
}

/* ── Utility Classes ───────────────────────── */
.glass {
    background: rgba(18, 18, 26, 0.7);
    backdrop-filter: blur(20px);
    border: 1px solid var(--border-color);
}
.gradient-primary {
    background: var(--accent-gradient);
    box-shadow: 0 4px 24px var(--accent-glow);
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

/* ── Decorative Elements ───────────────────── */
.deco-blob {
    position: fixed; border-radius: 50%; filter: blur(60px);
    opacity: 0.15; pointer-events: none; z-index: 0;
}
.deco-blob-1 { top: 10%; right: 10%; width: 300px; height: 300px; background: var(--accent-primary); }
.deco-blob-2 { bottom: 20%; left: 5%; width: 200px; height: 200px; background: var(--success); }
.deco-blob-3 { top: 60%; right: 20%; width: 150px; height: 150px; background: var(--info); }

/* ── Navbar ───────────────────────────────── */
.modern-navbar {
    position: sticky; top: 0; z-index: 100;
    background: rgba(18, 18, 26, 0.8);
    backdrop-filter: blur(20px);
    border-bottom: 1px solid var(--border-color);
}
.navbar-container {
    max-width: 1440px; margin: 0 auto; padding: 0 1.5rem;
    display: flex; align-items: center; justify-content: space-between;
    height: 4.5rem;
}
.navbar-left, .navbar-right { display: flex; align-items: center; gap: 0.75rem; }

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
    font-weight: 800; font-size: 1.1rem; color: var(--text-primary);
    letter-spacing: -0.02em;
}

/* Search */
.search-wrapper {
    position: relative; display: none;
}
@media (min-width: 1024px) { .search-wrapper { display: block; } }
.search-icon {
    position: absolute; left: 1rem; top: 50%; transform: translateY(-50%);
    width: 16px; height: 16px; color: var(--text-muted);
}
.search-input {
    width: 240px; padding: 0.625rem 1rem 0.625rem 2.5rem;
    background: var(--bg-card); border: 1px solid var(--border-color);
    border-radius: var(--radius-lg); font-size: 0.875rem;
    color: var(--text-primary); transition: all 0.2s ease;
}
.search-input::placeholder { color: var(--text-muted); }
.search-input:focus {
    outline: none; border-color: var(--accent-primary);
    box-shadow: 0 0 0 3px rgba(255, 51, 102, 0.15);
    background: var(--bg-elevated); width: 260px;
}

/* Cart Button */
.cart-btn {
    position: relative;
    width: 40px; height: 40px;
    border-radius: var(--radius);
    border: 1px solid var(--border-color);
    background: var(--bg-card);
    color: var(--text-secondary);
    display: flex; align-items: center; justify-content: center;
    text-decoration: none; transition: all 0.2s ease;
}
.cart-btn:hover {
    background: var(--bg-hover); color: var(--accent-primary);
    border-color: rgba(255, 51, 102, 0.3);
}
.cart-count {
    position: absolute; top: -4px; right: -4px;
    min-width: 18px; height: 18px; padding: 0 5px;
    border-radius: 9px; background: var(--accent-primary);
    color: white; font-size: 10px; font-weight: 700;
    display: flex; align-items: center; justify-content: center;
    box-shadow: 0 2px 8px rgba(255, 51, 102, 0.4);
    animation: pulse 2s ease-in-out infinite;
}

/* Auth Buttons */
.auth-link {
    font-size: 0.875rem; font-weight: 500; color: var(--text-secondary);
    text-decoration: none; padding: 0.5rem 0.75rem;
    border-radius: var(--radius); transition: all 0.15s ease;
}
.auth-link:hover { color: var(--text-primary); background: var(--bg-hover); }
.auth-btn {
    padding: 0.5rem 1.25rem; border-radius: var(--radius);
    font-size: 0.875rem; font-weight: 600; text-decoration: none;
    transition: all 0.2s ease; display: inline-flex;
    align-items: center; justify-content: center;
}
.auth-btn-ghost {
    background: transparent; color: var(--text-secondary);
    border: 1px solid var(--border-color);
}
.auth-btn-ghost:hover {
    background: var(--bg-hover); color: var(--accent-primary);
    border-color: rgba(255, 51, 102, 0.3);
}
.auth-btn-primary {
    background: var(--accent-gradient); color: white; border: none;
    box-shadow: 0 4px 16px var(--accent-glow);
}
.auth-btn-primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 24px var(--accent-glow);
}

/* ── Hero Section ─────────────────────────── */
.modern-hero {
    position: relative; padding: 4rem 1.5rem; overflow: hidden;
    background: linear-gradient(135deg, var(--bg-secondary) 0%, var(--bg-card) 100%);
    border-bottom: 1px solid var(--border-color);
}
.modern-hero::before {
    content: ''; position: absolute; top: 0; left: 0; right: 0; height: 2px;
    background: var(--accent-gradient);
}
.hero-container {
    max-width: 1440px; margin: 0 auto;
    display: grid; grid-template-columns: 1fr; gap: 3rem;
    align-items: center; position: relative; z-index: 2;
}
@media (min-width: 1024px) {
    .hero-container { grid-template-columns: 1fr 1fr; gap: 4rem; }
}

/* Hero Badge */
.hero-badge {
    display: inline-flex; align-items: center; gap: 8px;
    padding: 6px 14px; border-radius: 20px;
    background: rgba(255, 51, 102, 0.15);
    border: 1px solid rgba(255, 51, 102, 0.3);
    font-size: 11px; font-weight: 700; letter-spacing: 0.1em;
    text-transform: uppercase; color: var(--accent-primary);
    margin-bottom: 1.25rem;
}
.hero-badge-dot {
    width: 6px; height: 6px; border-radius: 50%;
    background: var(--success); animation: pulse 2s ease-in-out infinite;
}

/* Hero Title */
.hero-title {
    font-size: clamp(2rem, 5vw, 3.5rem);
    font-weight: 800; line-height: 1.1; margin-bottom: 1rem;
    letter-spacing: -0.03em;
}
.hero-title-accent {
    background: var(--accent-gradient);
    -webkit-background-clip: text; -webkit-text-fill-color: transparent;
    background-clip: text;
}

/* Hero Description */
.hero-desc {
    font-size: 1.05rem; color: var(--text-secondary);
    line-height: 1.7; margin-bottom: 2rem; max-width: 28rem;
}

/* Hero CTAs */
.hero-ctas {
    display: flex; flex-direction: column; gap: 0.75rem;
    margin-bottom: 2.5rem;
}
@media (min-width: 640px) { .hero-ctas { flex-direction: row; } }

.hero-btn {
    display: inline-flex; align-items: center; justify-content: center;
    gap: 0.5rem; padding: 0.875rem 1.5rem;
    border-radius: var(--radius-lg); font-weight: 600;
    font-size: 0.9rem; text-decoration: none;
    transition: all 0.2s ease; cursor: pointer;
}
.hero-btn-primary {
    background: var(--accent-gradient); color: white;
    border: none; box-shadow: 0 4px 20px var(--accent-glow);
}
.hero-btn-primary:hover {
    transform: translateY(-3px);
    box-shadow: 0 12px 32px var(--accent-glow);
}
.hero-btn-outline {
    background: transparent; color: var(--text-primary);
    border: 1px solid var(--border-color);
}
.hero-btn-outline:hover {
    background: var(--bg-hover); border-color: var(--accent-primary);
    color: var(--accent-primary);
}

/* Hero Stats */
.hero-stats {
    display: flex; align-items: center; gap: 1.5rem;
    padding-top: 2rem; border-top: 1px solid var(--border-light);
}
.hero-stat {
    display: flex; align-items: center; gap: 0.5rem;
    color: var(--text-secondary); font-size: 0.85rem; font-weight: 500;
}
.hero-stat svg { width: 18px; height: 18px; color: var(--accent-primary); }

/* Hero Image */
.hero-image-wrapper {
    position: relative; max-width: 28rem; margin: 0 auto;
}
.hero-image-card {
    position: relative; border-radius: var(--radius-xl);
    overflow: hidden; aspect-ratio: 3/4;
    border: 1px solid var(--border-color);
    box-shadow: var(--shadow-lg), var(--shadow-glow);
}
.hero-image-card img {
    width: 100%; height: 100%; object-fit: cover;
    transition: transform 0.5s ease;
}
.hero-image-card:hover img { transform: scale(1.03); }
.hero-image-overlay {
    position: absolute; inset: 0;
    background: linear-gradient(to top, rgba(10,10,15,0.6), transparent 40%);
}

/* Floating Cards */
.floating-card {
    position: absolute; padding: 0.875rem 1rem;
    border-radius: var(--radius-lg);
    background: var(--bg-card); border: 1px solid var(--border-color);
    box-shadow: var(--shadow-md); z-index: 3;
    animation: float 4s ease-in-out infinite;
}
.floating-card-1 { top: -1rem; right: -1rem; animation-delay: 0s; }
.floating-card-2 { bottom: -1rem; left: -1rem; animation-delay: -2s; }

.floating-card-stars { display: flex; gap: 2px; margin-bottom: 0.25rem; }
.floating-card-star { color: var(--warning); font-size: 0.75rem; }
.floating-card-label {
    font-size: 0.7rem; font-weight: 500; color: var(--text-muted);
    text-transform: uppercase; letter-spacing: 0.05em;
}
.floating-card-value {
    font-size: 1.1rem; font-weight: 700; color: var(--accent-primary);
}

/* ── Section Header ───────────────────────── */
.section-header {
    display: flex; align-items: center; justify-content: space-between;
    margin-bottom: 2rem; padding-bottom: 1rem;
    border-bottom: 1px solid var(--border-light);
}
.section-title-group { display: flex; flex-direction: column; gap: 0.5rem; }
.section-label {
    font-size: 0.75rem; font-weight: 700; color: var(--accent-primary);
    text-transform: uppercase; letter-spacing: 0.15em;
}
.section-title {
    font-size: 1.5rem; font-weight: 700; color: var(--text-primary);
    margin: 0; letter-spacing: -0.02em;
}
.section-desc {
    font-size: 0.9rem; color: var(--text-muted); margin: 0;
}
.section-link {
    font-size: 0.875rem; font-weight: 500; color: var(--accent-primary);
    text-decoration: none; display: inline-flex; align-items: center;
    gap: 4px; transition: gap 0.2s ease;
}
.section-link:hover { gap: 8px; }

/* ── Category Cards ───────────────────────── */
.category-grid {
    display: grid; grid-template-columns: repeat(3, 1fr);
    gap: 0.75rem;
}
@media (min-width: 768px) {
    .category-grid { grid-template-columns: repeat(6, 1fr); }
}

.category-card {
    padding: 1.25rem 1rem; border-radius: var(--radius-lg);
    background: var(--bg-card); border: 1px solid var(--border-color);
    text-align: center; cursor: pointer;
    transition: all 0.2s ease;
}
.category-card:hover {
    background: var(--bg-hover); border-color: rgba(255, 51, 102, 0.3);
    transform: translateY(-3px);
}
.category-icon {
    font-size: 1.75rem; margin-bottom: 0.5rem; display: block;
    transition: transform 0.2s ease;
}
.category-card:hover .category-icon { transform: scale(1.1) rotate(-3deg); }
.category-name {
    font-size: 0.8rem; font-weight: 600; color: var(--text-primary);
    text-transform: uppercase; letter-spacing: 0.05em;
}

/* ── Modern Product Card ─────────────────── */
.product-grid {
    display: grid; grid-template-columns: repeat(2, 1fr);
    gap: 1rem;
}
@media (min-width: 640px) { .product-grid { grid-template-columns: repeat(3, 1fr); } }
@media (min-width: 1024px) { .product-grid { grid-template-columns: repeat(4, 1fr); } }
@media (min-width: 1280px) { .product-grid { grid-template-columns: repeat(5, 1fr); } }

.product-card {
    background: var(--bg-card); border: 1px solid var(--border-color);
    border-radius: var(--radius-lg); overflow: hidden;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    display: flex; flex-direction: column;
}
.product-card:hover {
    border-color: rgba(255, 51, 102, 0.3);
    box-shadow: var(--shadow-lg), var(--shadow-glow);
    transform: translateY(-4px);
}

/* Product Image */
.product-image-wrapper {
    position: relative; aspect-ratio: 3/4; overflow: hidden;
    background: linear-gradient(135deg, var(--bg-elevated), var(--bg-card));
}
.product-image {
    width: 100%; height: 100%; object-fit: cover;
    transition: transform 0.5s ease;
}
.product-card:hover .product-image { transform: scale(1.08); }

/* Stock Badge */
.stock-badge {
    position: absolute; top: 0.75rem; left: 0.75rem;
    padding: 3px 10px; border-radius: 20px;
    font-size: 0.65rem; font-weight: 700;
    text-transform: uppercase; letter-spacing: 0.05em;
    z-index: 2;
}
.stock-badge.in { background: rgba(0, 217, 163, 0.15); color: var(--success); }
.stock-badge.low { background: rgba(255, 193, 7, 0.15); color: var(--warning); }
.stock-badge.out { background: rgba(255, 51, 102, 0.15); color: var(--accent-primary); }

/* Quick Actions */
.product-actions {
    position: absolute; bottom: 0; left: 0; right: 0;
    padding: 1rem; background: linear-gradient(to top, rgba(10,10,15,0.9), transparent);
    display: flex; justify-content: center;
    opacity: 0; transform: translateY(8px);
    transition: all 0.3s ease;
}
.product-card:hover .product-actions {
    opacity: 1; transform: translateY(0);
}
.add-to-cart-btn {
    width: 44px; height: 44px; border-radius: var(--radius);
    background: var(--accent-gradient); color: white;
    border: none; display: flex; align-items: center; justify-content: center;
    cursor: pointer; transition: all 0.2s ease;
    box-shadow: 0 4px 12px rgba(255, 51, 102, 0.3);
}
.add-to-cart-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 20px rgba(255, 51, 102, 0.4);
}
.add-to-cart-btn:disabled {
    opacity: 0.4; cursor: not-allowed; transform: none;
}

/* Product Info */
.product-info {
    padding: 1rem; flex: 1; display: flex; flex-direction: column; gap: 0.75rem;
}
.product-name {
    font-size: 0.9rem; font-weight: 600; color: var(--text-primary);
    line-height: 1.4; margin: 0;
    display: -webkit-box; -webkit-line-clamp: 2;
    -webkit-box-orient: vertical; overflow: hidden;
    min-height: 2.8rem;
}
.product-meta {
    display: flex; align-items: center; justify-content: space-between;
    gap: 0.5rem;
}
.product-price {
    font-size: 1rem; font-weight: 700; color: var(--accent-primary);
}
.product-rating {
    display: flex; gap: 1px;
}
.product-rating .star { color: var(--warning); font-size: 0.75rem; }
.product-rating .star-empty { color: var(--text-muted); font-size: 0.75rem; }

.product-category {
    display: inline-block; padding: 3px 10px;
    background: var(--bg-elevated); border: 1px solid var(--border-color);
    border-radius: 20px; font-size: 0.7rem; font-weight: 500;
    color: var(--text-secondary); text-transform: uppercase;
    letter-spacing: 0.05em; align-self: flex-start; margin-top: auto;
}

/* ── Empty State ─────────────────────────── */
.empty-state {
    padding: 4rem 2rem; text-align: center;
    background: var(--bg-card); border: 1px solid var(--border-color);
    border-radius: var(--radius-lg);
}
.empty-icon {
    width: 64px; height: 64px; margin: 0 auto 1.5rem;
    border-radius: var(--radius-lg);
    background: var(--bg-elevated);
    display: flex; align-items: center; justify-content: center;
    color: var(--text-muted); opacity: 0.5;
}
.empty-text {
    font-size: 1rem; color: var(--text-muted); font-weight: 500;
}

/* ── Scrollbar ───────────────────────────── */
::-webkit-scrollbar { width: 6px; }
::-webkit-scrollbar-track { background: transparent; }
::-webkit-scrollbar-thumb {
    background: var(--bg-elevated); border-radius: 3px;
}
::-webkit-scrollbar-thumb:hover { background: var(--accent-primary); }

/* ── Responsive ─────────────────────────── */
@media (max-width: 768px) {
    .modern-hero { padding: 3rem 1rem; }
    .hero-title { font-size: clamp(1.75rem, 6vw, 2.5rem); }
    .hero-desc { font-size: 0.95rem; }
    .section-title { font-size: 1.25rem; }
    .product-grid { gap: 0.75rem; }
    .navbar-container { padding: 0 1rem; height: 4rem; }
}

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
@endverbatim

<!-- Decorative Background Blobs -->
<div class="deco-blob deco-blob-1"></div>
<div class="deco-blob deco-blob-2"></div>
<div class="deco-blob deco-blob-3"></div>

<!-- Modern Navbar -->
<nav class="modern-navbar">
    <div class="navbar-container">
        <div class="navbar-left">
            <a href="{{ route('home') }}" class="logo-link">
                <div class="logo-mark">
                    <span>M</span>
                    <div class="logo-glow"></div>
                </div>
                <span class="logo-text">Migu STORE</span>
            </a>
            
            <form action="{{ route('home') }}" method="GET" class="search-wrapper">
                <svg class="search-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                </svg>
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari produk..." class="search-input">
            </form>
        </div>
        
        <div class="navbar-right">
            <a href="{{ route('cart.index') }}" class="cart-btn" title="Keranjang">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/>
                </svg>
                @if(session('cart_count', 0) > 0)
                <span class="cart-count">{{ session('cart_count') }}</span>
                @endif
            </a>
            
            @auth
                <span class="text-sm text-muted hidden lg:block">{{ Auth::user()->name }}</span>
                <form method="POST" action="{{ route('logout') }}" class="inline">
                    @csrf
                    <button type="submit" class="auth-link">Keluar</button>
                </form>
            @else
                <a href="{{ route('login') }}" class="auth-link">Masuk</a>
                <a href="{{ route('register') }}" class="auth-btn auth-btn-primary">Daftar</a>
            @endauth
        </div>
    </div>
</nav>

<!-- Modern Hero Section -->
<section class="modern-hero">
    <div class="hero-container">
        <div class="order-2 lg:order-1 animate-slide">
            <div class="hero-badge">
                <span class="hero-badge-dot"></span>
                Premium Quality
            </div>
            <h1 class="hero-title">
                Discover Your <br>
                <span class="hero-title-accent">Perfect Style</span>
            </h1>
            <p class="hero-desc">
                Explore our curated collection of premium fashion pieces. 
                From casual tees to statement jackets, find outfits that define who you are.
            </p>
            <div class="hero-ctas">
                <a href="#products" class="hero-btn hero-btn-primary">
                    Shop Collection
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                    </svg>
                </a>
                <a href="#" class="hero-btn hero-btn-outline">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    Watch Lookbook
                </a>
            </div>
            <div class="hero-stats">
                <div class="hero-stat">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <span>Fast Delivery</span>
                </div>
                <div class="hero-stat">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                    </svg>
                    <span>Secure Payment</span>
                </div>
                <div class="hero-stat">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                    </svg>
                    <span>Easy Returns</span>
                </div>
            </div>
        </div>
        
        <div class="relative order-1 lg:order-2 flex justify-center animate-slide">
            <div class="hero-image-wrapper">
                <div class="hero-image-card">
                    <img src="https://images.unsplash.com/photo-1552374196-1ab2a1c593e8?w=600&h=800&fit=crop" alt="Fashion Model">
                    <div class="hero-image-overlay"></div>
                </div>
                
                <div class="floating-card floating-card-1">
                    <div class="floating-card-stars">
                        <span class="floating-card-star">★</span>
                        <span class="floating-card-star">★</span>
                        <span class="floating-card-star">★</span>
                        <span class="floating-card-star">★</span>
                        <span class="floating-card-star">★</span>
                    </div>
                    <p class="floating-card-label">5.0 Rating</p>
                </div>
                
                <div class="floating-card floating-card-2">
                    <p class="floating-card-value">500+</p>
                    <p class="floating-card-label">Products</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Categories Section -->
<section class="py-14">
    <div class="max-w-7xl mx-auto px-6">
        <div class="section-header">
            <div class="section-title-group">
                <span class="section-label">Categories</span>
                <h2 class="section-title">Browse Categories</h2>
            </div>
            <a href="#" class="section-link">View All →</a>
        </div>
        
        <div class="category-grid">
            @foreach([['name'=>'Kaos','icon'=>'👕'], ['name'=>'Hoodie','icon'=>'🧥'], ['name'=>'Jaket','icon'=>'🧥'], ['name'=>'Celana','icon'=>'👖'], ['name'=>'Aksesoris','icon'=>'⌚'], ['name'=>'Sepatu','icon'=>'👟']] as $cat)
            <div class="category-card animate-fade">
                <span class="category-icon">{{ $cat['icon'] }}</span>
                <h3 class="category-name">{{ $cat['name'] }}</h3>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Products Section -->
<section id="products" class="py-16">
    <div class="max-w-7xl mx-auto px-6">
        <div class="section-header">
            <div class="section-title-group">
                <span class="section-label">Our Collection</span>
                <h2 class="section-title">Latest Products</h2>
                <p class="section-desc">Curated selection of premium fashion items</p>
            </div>
        </div>

        @if(isset($products) && count($products) > 0)
        <div class="product-grid">
            @foreach($products as $product)
            <div class="product-card animate-slide">
                <div class="product-image-wrapper">
                    <img src="{{ $product['image'] }}" alt="{{ $product['name'] }}" class="product-image">
                    
                    @if($product['stock'] <= 0)
                        <span class="stock-badge out">Out</span>
                    @elseif($product['stock'] <= 5)
                        <span class="stock-badge low">Low</span>
                    @else
                        <span class="stock-badge in">In Stock</span>
                    @endif
                    
                    <div class="product-actions">
                        <form action="{{ route('cart.add', $product['id']) }}" method="POST">
                            @csrf
                            <button type="submit" {{ $product['stock'] <= 0 ? 'disabled' : '' }} class="add-to-cart-btn" title="Add to Cart">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                                </svg>
                            </button>
                        </form>
                    </div>
                </div>
                
                <div class="product-info">
                    <h3 class="product-name">{{ Str::limit($product['name'], 35) }}</h3>
                    <div class="product-meta">
                        <span class="product-price">Rp {{ number_format($product['price'], 0, ',', '.') }}</span>
                        <div class="product-rating">
                            <span class="star">★</span>
                            <span class="star">★</span>
                            <span class="star">★</span>
                            <span class="star">★</span>
                            <span class="star-empty">★</span>
                        </div>
                    </div>
                    <span class="product-category">{{ $product['category_name'] ?? 'Fashion' }}</span>
                </div>
            </div>
            @endforeach
        </div>
        @else
        <div class="empty-state">
            <div class="empty-icon">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/>
                </svg>
            </div>
            <p class="empty-text">No products available yet</p>
        </div>
        @endif
    </div>
</section>
@endsection