@extends('layouts.app')

@section('page-title', 'Dashboard')

@section('content')
@verbatim
<style>
/* ── CSS Variables: Neo-Brutalism Theme ───────────────────────────── */
:root {
    /* Bold Color Palette */
    --c-bg:        #FFF9F0;
    --c-surface:   #FFFFFF;
    --c-border:    #000000;
    --c-text:      #1A1A1A;
    --c-text-dim:  #555555;
    
    /* Accent Colors - High Contrast */
    --c-accent-1:  #FF6B6B;  /* Coral Red */
    --c-accent-2:  #4ECDC4;  /* Mint */
    --c-accent-3:  #FFE66D;  /* Sunny Yellow */
    --c-accent-4:  #95E1D3;  /* Seafoam */
    --c-accent-5:  #F38181;  /* Salmon */
    
    /* Shadows - HARD, no blur */
    --shadow-hard: 4px 4px 0px #000000;
    --shadow-hard-lg: 6px 6px 0px #000000;
    --shadow-hard-sm: 2px 2px 0px #000000;
    --shadow-hover: 2px 2px 0px #000000;
    
    /* Borders - Thick & Bold */
    --border-thick: 3px solid #000000;
    --border-medium: 2px solid #000000;
    --border-thin: 1px solid #000000;
    
    /* Typography */
    --font-body: 'Space Grotesk', system-ui, sans-serif;
    --font-display: 'Syne', sans-serif;
    
    /* Transitions */
    --ease-bounce: cubic-bezier(0.34, 1.56, 0.64, 1);
    --ease-smooth: cubic-bezier(0.4, 0, 0.2, 1);
}

/* Dark Mode Variables */
@media (prefers-color-scheme: dark) {
    :root {
        --c-bg: #0a0a0b;
        --c-surface: #16191e;
        --c-text: #ffffff;
        --c-text-dim: #94a3b8;
        --c-border: #ffffff;
        --shadow-hard: 4px 4px 0px #ffffff;
        --shadow-hard-lg: 6px 6px 0px #ffffff;
        --shadow-hard-sm: 2px 2px 0px #ffffff;
        --shadow-hover: 2px 2px 0px #ffffff;
    }
}

/* ── Base Reset & Setup ─────────────────────────────────────────── */
*, *::before, *::after { box-sizing: border-box; }

.fade-in { 
    font-family: var(--font-body);
    background: var(--c-bg);
    color: var(--c-text);
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
    min-height: 100vh;
    padding: 1.5rem;
}
.fade-in * { font-family: inherit; }

/* ── Keyframes ─────────────────────────────────────────────── */
@keyframes nbFadeUp {
    from { opacity: 0; transform: translateY(24px); }
    to   { opacity: 1; transform: translateY(0); }
}
@keyframes nbWobble {
    0%, 100% { transform: rotate(-1deg); }
    50% { transform: rotate(2deg); }
}
@keyframes nbPulse {
    0%, 100% { box-shadow: var(--shadow-hard); }
    50% { box-shadow: var(--shadow-hard-lg); }
}

/* ── Animation Helpers ─────────────────────────────────────── */
.animate-fade-in {
    animation: nbFadeUp 0.5s var(--ease-bounce) both;
}

/* ── Neo-Brutalism Card Base ───────────────────────────────── */
.nb-card {
    background: var(--c-surface);
    border: var(--border-thick);
    border-radius: 0;
    position: relative;
    overflow: visible;
    transition: all 0.15s var(--ease-bounce);
    box-shadow: var(--shadow-hard);
}
.nb-card:hover {
    transform: translate(2px, 2px);
    box-shadow: var(--shadow-hover);
}
.nb-card:active {
    transform: translate(4px, 4px);
    box-shadow: none;
}

/* Decorative corner accent */
.nb-card::before {
    content: '';
    position: absolute;
    top: -3px;
    left: -3px;
    width: 20px;
    height: 20px;
    background: var(--c-accent-3);
    border: var(--border-thick);
    z-index: 2;
}

/* ── Welcome Banner: Bold & Playful ───────────────────────── */
.nb-banner {
    position: relative;
    border-radius: 0;
    padding: 2rem;
    overflow: visible;
    border: var(--border-thick);
    background: linear-gradient(135deg, var(--c-accent-1) 0%, var(--c-accent-5) 100%);
    margin-bottom: 1.5rem;
    box-shadow: var(--shadow-hard-lg);
    color: #fff;
}
.nb-banner::before {
    content: '';
    position: absolute;
    top: -6px;
    left: -6px;
    right: -6px;
    bottom: -6px;
    border: var(--border-thick);
    border-radius: 0;
    pointer-events: none;
    z-index: 0;
}
.nb-banner::after {
    content: '';
    position: absolute;
    top: 8px;
    left: 8px;
    right: 8px;
    bottom: 8px;
    border: 2px dashed rgba(255,255,255,0.4);
    border-radius: 0;
    pointer-events: none;
    opacity: 0.5;
}
.nb-banner-ct { position: relative; z-index: 2; }

.nb-banner-title {
    font-family: var(--font-display);
    font-size: clamp(1.5rem, 4vw, 2rem);
    font-weight: 900;
    line-height: 1.1;
    color: #fff;
    margin-bottom: 0.5rem;
    letter-spacing: -0.03em;
    text-transform: uppercase;
    text-shadow: 3px 3px 0 rgba(0,0,0,0.2);
}
.nb-banner-sub {
    font-size: 0.9rem;
    color: rgba(255,255,255,0.9);
    line-height: 1.5;
    font-weight: 500;
}

/* Decorative blobs for banner */
.nb-banner-blob {
    position: absolute;
    border-radius: 0;
    pointer-events: none;
    opacity: 0.3;
    border: 3px solid rgba(255,255,255,0.5);
}
.nb-banner-blob-1 {
    width: 120px;
    height: 120px;
    top: -30px;
    right: -30px;
    transform: rotate(15deg);
}
.nb-banner-blob-2 {
    width: 80px;
    height: 80px;
    bottom: -20px;
    left: -20px;
    transform: rotate(-10deg);
}

/* ── Stat Card ─────────────────────────────────────────────── */
.nb-stat {
    padding: 1.4rem 1.6rem;
}
.nb-stat-top {
    display: flex;
    align-items: flex-start;
    justify-content: space-between;
    margin-bottom: 1rem;
}
.nb-stat-lbl {
    font-size: 10px;
    font-weight: 800;
    letter-spacing: 0.12em;
    text-transform: uppercase;
    color: var(--c-text-dim);
    margin-bottom: 0.5rem;
    line-height: 1.3;
}
.nb-stat-val {
    font-family: var(--font-display);
    font-size: 2rem;
    font-weight: 900;
    line-height: 1.1;
    letter-spacing: -0.03em;
    color: var(--c-text);
}

/* Stat Icon Box */
.nb-stat-ic {
    width: 50px;
    height: 50px;
    border-radius: 0;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
    transition: transform 0.15s var(--ease-bounce);
    background: var(--c-surface);
    border: var(--border-thick);
    box-shadow: var(--shadow-hard-sm);
}
.nb-stat-ic.c { background: var(--c-accent-2); color: #000; }
.nb-stat-ic.r { background: var(--c-accent-1); color: #fff; }
.nb-stat-ic.e { background: var(--c-accent-3); color: #000; }
.nb-stat-ic.i { background: var(--c-accent-4); color: #000; }
.nb-stat-ic:hover {
    transform: translate(2px, 2px);
    box-shadow: var(--shadow-hover);
}

/* Change Badge */
.nb-change {
    display: inline-flex;
    align-items: center;
    gap: 4px;
    padding: 4px 10px;
    border-radius: 0;
    font-size: 11px;
    font-weight: 800;
    line-height: 1.3;
    border: var(--border-thick);
    text-transform: uppercase;
    letter-spacing: 0.05em;
    margin-top: 0.5rem;
}
.nb-change-up {
    background: var(--c-accent-2);
    color: #000;
}
.nb-change-dn {
    background: var(--c-accent-1);
    color: #fff;
}
.nb-change-txt {
    font-size: 11px;
    color: var(--c-text-dim);
    font-weight: 600;
    line-height: 1.3;
    margin-left: 0.5rem;
}

/* ── Section Header ────────────────────────────────────────── */
.nb-section-hdr {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 1.2rem 1.5rem;
    border-bottom: var(--border-thin);
}
.nb-section-title {
    font-family: var(--font-display);
    font-size: 1.15rem;
    font-weight: 800;
    color: var(--c-text);
    line-height: 1.2;
    letter-spacing: -0.02em;
    text-transform: uppercase;
}
.nb-section-sub {
    font-size: 0.8rem;
    color: var(--c-text-dim);
    margin-top: 2px;
    line-height: 1.3;
    font-weight: 500;
}

/* ── Chart Toggle Buttons ──────────────────────────────────── */
.nb-toggle-group {
    display: flex;
    gap: 3px;
}
.nb-toggle-btn {
    padding: 6px 16px;
    border-radius: 0;
    font-size: 11px;
    font-weight: 800;
    border: var(--border-thick);
    cursor: pointer;
    transition: all 0.15s var(--ease-bounce);
    color: var(--c-text-dim);
    background: var(--c-surface);
    font-family: var(--font-body);
    line-height: 1.3;
    letter-spacing: 0.05em;
    text-transform: uppercase;
}
.nb-toggle-btn:hover {
    background: var(--c-accent-3);
    color: #000;
}
.nb-toggle-btn.active {
    background: var(--c-accent-1);
    color: #fff;
    box-shadow: var(--shadow-hard-sm);
}
.nb-toggle-btn:active {
    transform: translate(2px, 2px);
    box-shadow: none;
}

/* ── Chart Container ───────────────────────────────────────── */
.nb-chart-wrap {
    position: relative;
    background: var(--c-surface);
    border: var(--border-thick);
    border-radius: 0;
    padding: 1rem;
    box-shadow: var(--shadow-hard-sm);
}

/* ── Quick Action: Neo-Brutalism Style ────────────────────── */
.nb-qa {
    display: flex;
    align-items: center;
    gap: 1rem;
    padding: 1rem;
    border-radius: 0;
    border: var(--border-thick);
    background: var(--c-surface);
    text-decoration: none;
    transition: all 0.15s var(--ease-bounce);
    position: relative;
    box-shadow: var(--shadow-hard);
    color: var(--c-text);
}
.nb-qa:hover {
    transform: translate(3px, 3px);
    box-shadow: var(--shadow-hover);
    background: var(--c-accent-3);
}
.nb-qa:active {
    transform: translate(4px, 4px);
    box-shadow: none;
}
.nb-qa-ic {
    width: 44px;
    height: 44px;
    border-radius: 0;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
    transition: transform 0.15s var(--ease-bounce);
    border: var(--border-thick);
    background: var(--c-accent-2);
    color: #000;
}
.nb-qa:hover .nb-qa-ic {
    transform: translate(2px, 2px) rotate(-3deg);
    box-shadow: var(--shadow-hover);
}
.nb-qa-tt {
    font-size: 0.9rem;
    font-weight: 800;
    color: var(--c-text);
    line-height: 1.3;
    text-transform: uppercase;
}
.nb-qa-ds {
    font-size: 0.75rem;
    color: var(--c-text-dim);
    line-height: 1.3;
    font-weight: 500;
}
.nb-qa-arrow {
    margin-left: auto;
    color: var(--c-text);
    opacity: 0.6;
    transition: all 0.15s var(--ease-bounce);
}
.nb-qa:hover .nb-qa-arrow {
    opacity: 1;
    transform: translate(2px, 2px);
}

/* ── Mini Stats Box ───────────────────────────────────────── */
.nb-mini-stat {
    text-align: center;
    padding: 0.8rem;
    border-radius: 0;
    background: var(--c-surface);
    border: var(--border-thick);
    box-shadow: var(--shadow-hard-sm);
    transition: all 0.15s var(--ease-bounce);
}
.nb-mini-stat:hover {
    transform: translate(2px, 2px);
    box-shadow: var(--shadow-hover);
}
.nb-mini-stat-val {
    font-family: var(--font-display);
    font-size: 1.5rem;
    font-weight: 900;
    line-height: 1.1;
}
.nb-mini-stat-val.cyan { color: var(--c-accent-2); }
.nb-mini-stat-val.emerald { color: var(--c-accent-4); }
.nb-mini-stat-lbl {
    font-size: 0.7rem;
    color: var(--c-text-dim);
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.05em;
    margin-top: 0.3rem;
}

/* ── Activity Row ──────────────────────────────────────────── */
.nb-activity {
    display: flex;
    align-items: center;
    gap: 1rem;
    padding: 1rem 1.5rem;
    transition: all 0.15s var(--ease-bounce);
    border-bottom: var(--border-thin);
}
.nb-activity:last-child { border-bottom: none; }
.nb-activity:hover {
    background: var(--c-accent-4);
    transform: translateX(4px);
}
.nb-activity-ic {
    width: 40px;
    height: 40px;
    border-radius: 0;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
    background: var(--c-accent-2);
    border: var(--border-thick);
    color: #000;
}
.nb-activity-title {
    font-size: 0.9rem;
    font-weight: 700;
    color: var(--c-text);
    line-height: 1.3;
}
.nb-activity-meta {
    font-size: 0.75rem;
    color: var(--c-text-dim);
    margin-top: 2px;
    line-height: 1.3;
    font-weight: 500;
}
.nb-activity-amount {
    font-size: 0.9rem;
    font-weight: 800;
    color: var(--c-text);
    line-height: 1.3;
    margin-left: auto;
}
.nb-activity-status {
    font-size: 0.75rem;
    font-weight: 800;
    color: var(--c-accent-2);
    text-transform: uppercase;
    letter-spacing: 0.05em;
}

/* ── Category Legend ───────────────────────────────────────── */
.nb-cat-legend {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    padding: 0.5rem;
    border-radius: 0;
    background: var(--c-surface);
    border: var(--border-thin);
}
.nb-cat-dot {
    width: 10px;
    height: 10px;
    border-radius: 0;
    border: 2px solid var(--c-border);
}
.nb-cat-name {
    font-size: 0.8rem;
    font-weight: 600;
    color: var(--c-text);
    line-height: 1.3;
}

/* ── Empty State ───────────────────────────────────────────── */
.nb-empty {
    padding: 3rem;
    text-align: center;
    color: var(--c-text-dim);
    font-size: 0.9rem;
    font-weight: 600;
    background: var(--c-surface);
    border: var(--border-thick);
    border-radius: 0;
    box-shadow: var(--shadow-hard);
}

/* ── Link Style ────────────────────────────────────────────── */
.nb-link {
    font-size: 0.8rem;
    font-weight: 800;
    color: var(--c-text);
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 4px;
    transition: all 0.15s var(--ease-bounce);
    background: var(--c-accent-1);
    padding: 4px 10px;
    border: var(--border-thin);
}
.nb-link:hover {
    gap: 8px;
    background: var(--c-accent-3);
    transform: translate(2px, 2px);
    box-shadow: var(--shadow-hover);
}

/* ── Typography Enhancements ──────────────────────────────── */
h1, h2, h3, h4, h5, h6 {
    font-family: var(--font-display);
    font-weight: 800;
    line-height: 1.1;
    letter-spacing: -0.02em;
}
p, span, label, a {
    font-weight: 500;
}
strong, b {
    font-weight: 800;
}

/* ── Responsive Tweaks ────────────────────────────────────── */
@media (max-width: 768px) {
    .fade-in { padding: 1rem; }
    .nb-banner { padding: 1.5rem 1rem; }
    .nb-banner-title { font-size: clamp(1.3rem, 5vw, 1.7rem); }
    .nb-stat { padding: 1.2rem; }
    .nb-stat-val { font-size: 1.7rem; }
    .nb-card::before { width: 14px; height: 14px; }
}

/* ── Focus States for Accessibility ───────────────────────── */
button:focus-visible,
a:focus-visible,
.nb-qa:focus-visible {
    outline: 3px solid var(--c-accent-1);
    outline-offset: 2px;
}

/* ── Reduced Motion Preference ────────────────────────────── */
@media (prefers-reduced-motion: reduce) {
    *, *::before, *::after {
        animation-duration: 0.01ms !important;
        animation-iteration-count: 1 !important;
        transition-duration: 0.01ms !important;
    }
}
</style>
@endverbatim

<div class="fade-in">
    <!-- Welcome Banner -->
    <div class="nb-banner animate-fade-in">
        <div class="nb-banner-blob nb-banner-blob-1"></div>
        <div class="nb-banner-blob nb-banner-blob-2"></div>
        <div class="nb-banner-ct">
            <h2 class="nb-banner-title">Selamat Datang, {{ Auth::user()->name }}! 👋</h2>
            <p class="nb-banner-sub">Ini adalah ringkasan performa toko {{ \App\Models\Setting::get('store_name', 'Migu POS') }} hari ini.</p>
        </div>
    </div>

    <!-- Stats Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-5">
        @php
            $todaySales = number_format($stats['today_sales'] ?? 0, 0, ',', '.');
            $products = $stats['products'] ?? 0;
            $lowStock = $stats['low_stock'] ?? 0;
            $todayCount = $stats['today_count'] ?? 0;
            
            $cards = [
                ['title' => 'Total Produk', 'value' => $products, 'icon' => 'M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4', 'color' => 'c', 'change' => '+12%', 'changeType' => 'up'],
                ['title' => 'Stok Menipis', 'value' => $lowStock, 'icon' => 'M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z', 'color' => 'r', 'change' => '-3%', 'changeType' => 'dn'],
                ['title' => 'Penjualan Hari Ini', 'value' => 'Rp ' . $todaySales, 'icon' => 'M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z', 'color' => 'e', 'change' => '+23%', 'changeType' => 'up'],
                ['title' => 'Total Transaksi', 'value' => $todayCount . 'x', 'icon' => 'M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2', 'color' => 'i', 'change' => '+8%', 'changeType' => 'up']
            ];
        @endphp

        @foreach($cards as $c)
        <div class="nb-card nb-stat animate-fade-in">
            <div class="nb-stat-top">
                <div class="flex-1">
                    <p class="nb-stat-lbl">{{ $c['title'] }}</p>
                    <p class="nb-stat-val">{{ $c['value'] }}</p>
                    <div class="flex items-center">
                        <span class="nb-change nb-change-{{ $c['changeType'] }}">
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/></svg>
                            {{ $c['change'] }}
                        </span>
                        <span class="nb-change-txt">vs kemarin</span>
                    </div>
                </div>
                <div class="nb-stat-ic nb-stat-ic-{{ $c['color'] }}">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="{{ $c['icon'] }}"/>
                    </svg>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <!-- Charts & Quick Actions -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Sales Chart -->
        <div class="lg:col-span-2 nb-card">
            <div class="nb-section-hdr">
                <div>
                    <h3 class="nb-section-title">Grafik Penjualan</h3>
                    <p class="nb-section-sub">Analisis penjualan 7 hari terakhir</p>
                </div>
                <div class="nb-toggle-group">
                    <button class="nb-toggle-btn active">Minggu</button>
                    <button class="nb-toggle-btn">Bulan</button>
                    <button class="nb-toggle-btn">Tahun</button>
                </div>
            </div>
            <div class="p-6">
                <div class="nb-chart-wrap">
                    <canvas id="salesChart" height="120"></canvas>
                </div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="nb-card" style="background: linear-gradient(135deg, var(--c-accent-1) 0%, var(--c-accent-5) 100%); border-color: #000; color: #fff;">
            <div style="position:absolute;inset:-3px;border:3px solid #000;border-radius:0;pointer-events:none;z-index:0"></div>
            <div style="position:absolute;inset:5px;border:2px dashed rgba(255,255,255,0.4);border-radius:0;pointer-events:none;opacity:0.5"></div>
            
            <div style="position:relative;z-index:2;padding:1.5rem;">
                <h3 class="nb-section-title" style="color:#fff;margin-bottom:0.3rem">Quick Actions</h3>
                <p style="font-size:0.8rem;color:rgba(255,255,255,0.9);margin-bottom:1.2rem;font-weight:500">Akses cepat fitur penting</p>
                
                <div style="display:flex;flex-direction:column;gap:0.75rem;">
                    <a href="{{ route('pos.index') }}" class="nb-qa" style="background:rgba(255,255,255,0.15);border-color:rgba(255,255,255,0.4);color:#fff">
                        <div class="nb-qa-ic" style="background:rgba(255,255,255,0.2);border-color:rgba(255,255,255,0.4);color:#fff">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                        </div>
                        <div style="flex:1">
                            <p class="nb-qa-tt">Buka Kasir</p>
                            <p class="nb-qa-ds" style="color:rgba(255,255,255,0.85)">Mulai transaksi</p>
                        </div>
                        <svg class="nb-qa-arrow" width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                    </a>

                    <a href="{{ route('products.index') }}" class="nb-qa" style="background:rgba(255,255,255,0.15);border-color:rgba(255,255,255,0.4);color:#fff">
                        <div class="nb-qa-ic" style="background:rgba(255,255,255,0.2);border-color:rgba(255,255,255,0.4);color:#fff">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>
                        </div>
                        <div style="flex:1">
                            <p class="nb-qa-tt">Kelola Produk</p>
                            <p class="nb-qa-ds" style="color:rgba(255,255,255,0.85)">Tambah & edit</p>
                        </div>
                        <svg class="nb-qa-arrow" width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                    </a>

                    <a href="{{ route('reports.sales') }}" class="nb-qa" style="background:rgba(255,255,255,0.15);border-color:rgba(255,255,255,0.4);color:#fff">
                        <div class="nb-qa-ic" style="background:rgba(255,255,255,0.2);border-color:rgba(255,255,255,0.4);color:#fff">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
                        </div>
                        <div style="flex:1">
                            <p class="nb-qa-tt">Laporan</p>
                            <p class="nb-qa-ds" style="color:rgba(255,255,255,0.85)">Analisis data</p>
                        </div>
                        <svg class="nb-qa-arrow" width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                    </a>
                </div>

                <!-- Mini Stats -->
                <div style="margin-top:1.5rem;padding-top:1.5rem;border-top:2px dashed rgba(255,255,255,0.3);display:grid;grid-template-columns:repeat(2,1fr);gap:0.75rem">
                    <div class="nb-mini-stat" style="background:rgba(255,255,255,0.15);border-color:rgba(255,255,255,0.3)">
                        <p class="nb-mini-stat-val cyan" style="color:#4ECDC4">98%</p>
                        <p class="nb-mini-stat-lbl" style="color:rgba(255,255,255,0.8)">Uptime</p>
                    </div>
                    <div class="nb-mini-stat" style="background:rgba(255,255,255,0.15);border-color:rgba(255,255,255,0.3)">
                        <p class="nb-mini-stat-val emerald" style="color:#95E1D3">4.9</p>
                        <p class="nb-mini-stat-lbl" style="color:rgba(255,255,255,0.8)">Rating</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Activity & Category Performance -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Recent Activity -->
        <div class="nb-card">
            <div class="nb-section-hdr">
                <div>
                    <h3 class="nb-section-title">Aktivitas Terbaru</h3>
                    <p class="nb-section-sub">Transaksi terkini</p>
                </div>
                <a href="{{ route('transactions.index') }}" class="nb-link">Lihat Semua →</a>
            </div>
            <div style="max-height:24rem;overflow-y:auto">
                @forelse(\App\Models\Transaction::with('user')->latest()->limit(5)->get() as $transaction)
                <div class="nb-activity">
                    <div class="nb-activity-ic">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                    </div>
                    <div style="flex:1;min-width:0">
                        <p class="nb-activity-title">Transaksi #{{ str_pad($transaction->id, 5, '0', STR_PAD_LEFT) }}</p>
                        <p class="nb-activity-meta">{{ $transaction->created_at->diffForHumans() }} • {{ $transaction->user->name }}</p>
                    </div>
                    <div style="text-align:right">
                        <p class="nb-activity-amount">Rp {{ number_format($transaction->total_amount, 0, ',', '.') }}</p>
                        <p class="nb-activity-status">Selesai</p>
                    </div>
                </div>
                @empty
                <div class="nb-empty">
                    <svg class="w-16 h-16 mx-auto mb-3 opacity-30" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                    <p class="text-sm">Belum ada transaksi</p>
                </div>
                @endforelse
            </div>
        </div>

        <!-- Category Performance -->
        <div class="nb-card">
            <div class="nb-section-hdr" style="border-bottom:2px solid var(--c-border)">
                <div>
                    <h3 class="nb-section-title">Penjualan per Kategori</h3>
                    <p class="nb-section-sub">Distribusi produk terlaris</p>
                </div>
            </div>
            <div class="p-6">
                <div class="nb-chart-wrap">
                    <canvas id="categoryChart" height="200"></canvas>
                </div>
                <div style="margin-top:1rem;display:grid;grid-template-columns:repeat(2,1fr);gap:0.75rem">
                    @foreach(\App\Models\Category::withCount('products')->limit(4)->get() as $cat)
                    <div class="nb-cat-legend">
                        <span class="nb-cat-dot" style="background:{{ ['#FF6B6B','#4ECDC4','#FFE66D','#95E1D3'][$loop->index % 4] }}"></span>
                        <span class="nb-cat-name">{{ $cat->name }} ({{ $cat->products_count }})</span>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function dashboard() {
    return {
        salesChart: null,
        categoryChart: null,
        initCharts() {
            if (this.salesChart) this.salesChart.destroy();
            if (this.categoryChart) this.categoryChart.destroy();

            const isDark = document.documentElement.classList.contains('dark');
            // Neo-Brutalism chart colors
            const textColor = isDark ? '#ffffff' : '#1A1A1A';
            const gridColor = isDark ? '#ffffff' : '#000000';
            const accentColor = '#FF6B6B';
            
            const salesCtx = document.getElementById('salesChart');
            if(salesCtx) {
                this.salesChart = new Chart(salesCtx.getContext('2d'), {
                    type: 'line',
                    data: {
                        labels: ['Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab', 'Min'],
                        datasets: [{
                            label: 'Penjualan',
                            data: [1200000, 1900000, 1500000, 2200000, 1800000, 2800000, 2400000],
                            borderColor: accentColor,
                            backgroundColor: 'rgba(255, 107, 107, 0.15)',
                            borderWidth: 3,
                            tension: 0, // Straight lines for brutalist look
                            fill: true,
                            pointBackgroundColor: accentColor,
                            pointBorderColor: isDark ? '#16191e' : '#fff',
                            pointBorderWidth: 3,
                            pointRadius: 5,
                            pointHoverRadius: 7,
                            pointHoverBackgroundColor: '#FFE66D',
                            pointHoverBorderColor: '#000',
                            pointHoverBorderWidth: 2,
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: true,
                        plugins: {
                            legend: { display: false },
                            tooltip: {
                                backgroundColor: isDark ? '#16191e' : '#fff',
                                titleColor: isDark ? '#fff' : '#1A1A1A',
                                bodyColor: isDark ? '#94a3b8' : '#555555',
                                borderColor: gridColor,
                                borderWidth: 3,
                                padding: 12,
                                cornerRadius: 0, // Sharp corners
                                displayColors: false,
                                titleFont: { weight: '800', size: 12, family: "'Syne', sans-serif" },
                                bodyFont: { weight: '600', size: 11, family: "'Space Grotesk', sans-serif" },
                                callbacks: { label: ctx => 'Rp ' + ctx.parsed.y.toLocaleString('id-ID') }
                            }
                        },
                        scales: {
                            y: {
                                beginAtZero: true,
                                ticks: { 
                                    color: textColor, 
                                    callback: v => 'Rp ' + (v/1000000).toFixed(1) + 'Jt', 
                                    font: { size: 10, weight: '700', family: "'Space Grotesk', sans-serif" } 
                                },
                                grid: { 
                                    color: gridColor, 
                                    lineWidth: 1,
                                    borderDash: [5, 5],
                                    drawBorder: true,
                                    borderColor: gridColor,
                                    borderWidth: 2
                                },
                                border: {
                                    display: true,
                                    color: gridColor,
                                    width: 2
                                }
                            },
                            x: { 
                                ticks: { 
                                    color: textColor, 
                                    font: { size: 10, weight: '700', family: "'Space Grotesk', sans-serif" } 
                                }, 
                                grid: { 
                                    display: true, 
                                    color: gridColor,
                                    lineWidth: 1,
                                    drawBorder: true,
                                    borderColor: gridColor,
                                    borderWidth: 2
                                },
                                border: {
                                    display: true,
                                    color: gridColor,
                                    width: 2
                                }
                            }
                        },
                        animation: { duration: 400, easing: 'linear' }
                    }
                });
            }

            const categoryCtx = document.getElementById('categoryChart');
            if(categoryCtx) {
                this.categoryChart = new Chart(categoryCtx.getContext('2d'), {
                    type: 'doughnut',
                    data: {
                        labels: ['Kaos', 'Hoodie', 'Celana', 'Jaket', 'Aksesoris'],
                        datasets: [{
                            data: [35, 25, 20, 15, 5],
                            backgroundColor: ['#FF6B6B', '#4ECDC4', '#FFE66D', '#95E1D3', '#F38181'],
                            borderWidth: 3,
                            borderColor: gridColor,
                            hoverOffset: 15,
                            borderRadius: 0, // Sharp edges
                            hoverBorderWidth: 4,
                            hoverBorderColor: '#000',
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: true,
                        cutout: '70%',
                        plugins: {
                            legend: { display: false },
                            tooltip: {
                                backgroundColor: isDark ? '#16191e' : '#fff',
                                titleColor: isDark ? '#fff' : '#1A1A1A',
                                bodyColor: isDark ? '#94a3b8' : '#555555',
                                borderColor: gridColor,
                                borderWidth: 3,
                                padding: 12,
                                cornerRadius: 0,
                                titleFont: { weight: '800', size: 11, family: "'Syne', sans-serif" },
                                bodyFont: { weight: '600', size: 10, family: "'Space Grotesk', sans-serif" },
                                callbacks: { label: ctx => ctx.parsed + '%' }
                            }
                        },
                        animation: { duration: 400, easing: 'linear' }
                    }
                });
            }
        }
    }
}
window.dashboardInstance = dashboard();
document.addEventListener('theme-changed', () => setTimeout(() => window.dashboardInstance?.initCharts(), 150));

// Add playful hover effect to all interactive elements
document.querySelectorAll('.nb-card, .nb-qa, .nb-change, .nb-toggle-btn, .nb-link, .nb-mini-stat').forEach(el => {
    el.addEventListener('mouseenter', function() {
        this.style.transform = 'translate(2px, 2px)';
    });
    el.addEventListener('mouseleave', function() {
        this.style.transform = '';
    });
});
</script>
@endsection