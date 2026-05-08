@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

@verbatim
<style>
/* ── Modern Dark Theme UI ───────────────────────────── */
:root {
    --bg-primary: #0a0a0f;
    --bg-secondary: #12121a;
    --bg-card: #16161f;
    --bg-elevated: #1c1c2e;
    
    --accent-primary: #ff3366;
    --accent-secondary: #ff6b6b;
    --accent-gradient: linear-gradient(135deg, #ff3366 0%, #ff6b6b 100%);
    --accent-glow: rgba(255, 51, 102, 0.3);
    
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
    --shadow-glow: 0 0 32px rgba(255, 51, 102, 0.2);
    
    --radius-sm: 8px;
    --radius: 16px;
    --radius-lg: 24px;
    --radius-xl: 32px;
    
    --font-main: 'Plus Jakarta Sans', sans-serif;
}

* { box-sizing: border-box; margin: 0; padding: 0; }

.dash-wrap {
    font-family: var(--font-main);
    background: var(--bg-primary);
    color: var(--text-primary);
    min-height: 100vh;
    padding: 2rem;
    background-image: 
        radial-gradient(at 0% 0%, rgba(255, 51, 102, 0.15) 0px, transparent 50%),
        radial-gradient(at 100% 0%, rgba(255, 107, 107, 0.1) 0px, transparent 50%);
    background-attachment: fixed;
}

/* ── Animations ───────────────────────────────── */
@keyframes fadeInUp {
    from { opacity: 0; transform: translateY(24px); }
    to { opacity: 1; transform: translateY(0); }
}
@keyframes pulse {
    0%, 100% { opacity: 1; }
    50% { opacity: 0.5; }
}
@keyframes float {
    0%, 100% { transform: translateY(0px); }
    50% { transform: translateY(-8px); }
}

.a1 { animation: fadeInUp 0.6s ease-out 0.05s both; }
.a2 { animation: fadeInUp 0.6s ease-out 0.12s both; }
.a3 { animation: fadeInUp 0.6s ease-out 0.20s both; }
.a4 { animation: fadeInUp 0.6s ease-out 0.28s both; }
.a5 { animation: fadeInUp 0.6s ease-out 0.36s both; }
.a6 { animation: fadeInUp 0.6s ease-out 0.44s both; }

/* ── Modern Card ─────────────────────────────── */
.dc {
    background: var(--bg-card);
    border: 1px solid var(--border-color);
    border-radius: var(--radius-lg);
    backdrop-filter: blur(12px);
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    overflow: hidden;
}
.dc:hover {
    border-color: rgba(255, 51, 102, 0.3);
    box-shadow: var(--shadow-glow), var(--shadow-lg);
    transform: translateY(-4px);
}

/* ── Hero Section ───────────────────────────── */
.dh {
    background: linear-gradient(135deg, var(--bg-elevated) 0%, var(--bg-card) 100%);
    border: 1px solid var(--border-color);
    border-radius: var(--radius-xl);
    padding: 2.5rem;
    margin-bottom: 2rem;
    position: relative;
    overflow: hidden;
}
.dh::before {
    content: '';
    position: absolute;
    top: 0; left: 0; right: 0; height: 2px;
    background: var(--accent-gradient);
}
.dh::after {
    content: '';
    position: absolute;
    top: -50%; right: -10%;
    width: 400px; height: 400px;
    background: radial-gradient(circle, var(--accent-glow) 0%, transparent 70%);
    pointer-events: none;
}
.dh-ct { position: relative; z-index: 2; }

.dh-badge {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 8px 16px;
    background: rgba(255, 51, 102, 0.15);
    border: 1px solid rgba(255, 51, 102, 0.3);
    border-radius: 20px;
    font-size: 11px;
    font-weight: 700;
    letter-spacing: 0.1em;
    text-transform: uppercase;
    color: var(--accent-primary);
    margin-bottom: 1.25rem;
}
.dh-dot {
    width: 6px; height: 6px;
    border-radius: 50%;
    background: var(--success);
    animation: pulse 2s ease-in-out infinite;
}

.dh-title {
    font-size: clamp(2rem, 5vw, 3rem);
    font-weight: 800;
    line-height: 1.1;
    margin-bottom: 0.75rem;
    background: linear-gradient(135deg, #fff 0%, var(--text-secondary) 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}

.dh-sub {
    font-size: 1rem;
    color: var(--text-secondary);
    margin-bottom: 1.5rem;
}
.dh-sub strong {
    color: var(--accent-primary);
    font-weight: 700;
}

.dh-sep {
    height: 1px;
    background: linear-gradient(90deg, transparent, var(--border-color), transparent);
    margin: 1.5rem 0;
}

.dh-stats {
    display: flex;
    gap: 2rem;
    flex-wrap: wrap;
}
.dh-stat {
    display: flex;
    align-items: center;
    gap: 1rem;
    padding-right: 2rem;
    border-right: 1px solid var(--border-color);
}
.dh-stat:last-child { border-right: none; }

.dh-si {
    width: 56px; height: 56px;
    border-radius: var(--radius);
    background: var(--accent-gradient);
    display: flex; align-items: center; justify-content: center;
    box-shadow: 0 8px 24px rgba(255, 51, 102, 0.3);
}
.dh-si svg { stroke: white; }

.dh-sl {
    font-size: 11px;
    font-weight: 600;
    letter-spacing: 0.08em;
    text-transform: uppercase;
    color: var(--text-muted);
    margin-bottom: 4px;
}
.dh-sv {
    font-size: 1.75rem;
    font-weight: 800;
    color: var(--text-primary);
}

/* ── Stats Grid ────────────────────────────── */
.dsc {
    padding: 1.75rem;
    position: relative;
}
.dsc::before {
    content: '';
    position: absolute;
    top: 0; left: 0; right: 0;
    height: 3px;
    background: var(--accent-gradient);
    opacity: 0;
    transition: opacity 0.3s;
}
.dc:hover .dsc::before { opacity: 1; }

.dsc-top {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    margin-bottom: 1rem;
}

.dsc-lbl {
    font-size: 11px;
    font-weight: 600;
    letter-spacing: 0.08em;
    text-transform: uppercase;
    color: var(--text-muted);
    margin-bottom: 0.5rem;
}

.dsc-val {
    font-size: 2rem;
    font-weight: 800;
    color: var(--text-primary);
    line-height: 1;
}
.dsc-val.rose { color: var(--accent-primary); }
.dsc-val.emerald { color: var(--success); }
.dsc-val.violet { color: var(--info); }

.dsi {
    width: 48px; height: 48px;
    border-radius: var(--radius);
    display: flex; align-items: center; justify-content: center;
    background: var(--bg-elevated);
    border: 1px solid var(--border-color);
}
.dsi.c { background: rgba(0, 217, 163, 0.15); color: var(--success); }
.dsi.r { background: rgba(255, 51, 102, 0.15); color: var(--accent-primary); }
.dsi.e { background: rgba(255, 193, 7, 0.15); color: var(--warning); }
.dsi.v { background: rgba(77, 171, 247, 0.15); color: var(--info); }

/* ── Pills & Badges ───────────────────────── */
.pl {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    padding: 6px 12px;
    border-radius: 20px;
    font-size: 11px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.05em;
}
.pl-up { background: rgba(0, 217, 163, 0.15); color: var(--success); }
.pl-dn { background: rgba(255, 51, 102, 0.15); color: var(--accent-primary); }
.pl-wn { background: rgba(255, 193, 7, 0.15); color: var(--warning); }

.ft { font-size: 11px; color: var(--text-muted); }

/* ── Section Header ───────────────────────── */
.dsh {
    display: flex;
    align-items: center;
    gap: 1rem;
    margin-bottom: 1.5rem;
}
.dsi2 {
    width: 40px; height: 40px;
    border-radius: var(--radius);
    background: var(--bg-elevated);
    border: 1px solid var(--border-color);
    display: flex; align-items: center; justify-content: center;
}

.dst {
    font-size: 1.125rem;
    font-weight: 700;
    color: var(--text-primary);
}
.dss {
    font-size: 0.875rem;
    color: var(--text-secondary);
}

/* ── Chart Toggle ─────────────────────────── */
.dtg {
    display: flex;
    background: var(--bg-elevated);
    border-radius: 12px;
    padding: 4px;
    gap: 4px;
}
.dtg button {
    padding: 8px 20px;
    border-radius: 8px;
    border: none;
    background: transparent;
    color: var(--text-secondary);
    font-family: var(--font-main);
    font-size: 12px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.2s;
}
.dtg button:hover { color: var(--text-primary); }
.dtg button.on {
    background: var(--accent-gradient);
    color: white;
    box-shadow: 0 4px 12px rgba(255, 51, 102, 0.3);
}

/* ── Chart Summary ────────────────────────── */
.dcs {
    background: var(--bg-elevated);
    border: 1px solid var(--border-light);
    border-radius: var(--radius);
    padding: 1rem;
    text-align: center;
    transition: all 0.2s;
}
.dcs:hover {
    background: var(--bg-card);
    border-color: rgba(255, 51, 102, 0.2);
}
.dcsl {
    font-size: 10px;
    font-weight: 600;
    letter-spacing: 0.08em;
    text-transform: uppercase;
    color: var(--text-muted);
    margin-bottom: 0.5rem;
}
.dcsv {
    font-size: 1.125rem;
    font-weight: 700;
    color: var(--text-primary);
}

/* ── Canvas Wrap ─────────────────────────── */
.dcw {
    background: var(--bg-elevated);
    border: 1px solid var(--border-color);
    border-radius: var(--radius);
    padding: 1rem;
}

/* ── Category Row ────────────────────────── */
.dcat {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 0.875rem 1rem;
    border-radius: var(--radius);
    transition: all 0.2s;
    margin-bottom: 0.5rem;
}
.dcat:hover {
    background: var(--bg-elevated);
}
.dcat-d {
    width: 10px; height: 10px;
    border-radius: 3px;
    margin-right: 0.75rem;
}
.dcat-n {
    font-size: 0.875rem;
    font-weight: 500;
    color: var(--text-primary);
    flex: 1;
}
.dcat-b {
    font-size: 0.875rem;
    font-weight: 700;
    color: var(--text-primary);
    background: var(--bg-elevated);
    padding: 4px 12px;
    border-radius: 20px;
}

/* ── Product Row ─────────────────────────── */
.dpr {
    display: flex;
    align-items: center;
    gap: 1rem;
    padding: 1rem 1.25rem;
    border-bottom: 1px solid var(--border-light);
    transition: all 0.2s;
}
.dpr:hover { background: var(--bg-elevated); }
.dpr:last-child { border-bottom: none; }

.dpr-rk {
    width: 36px; height: 36px;
    border-radius: var(--radius);
    display: flex; align-items: center; justify-content: center;
    font-weight: 700;
    font-size: 0.875rem;
}
.rk-g { background: var(--accent-gradient); color: white; }
.rk-s { background: var(--bg-elevated); color: var(--text-primary); border: 1px solid var(--border-color); }
.rk-b { background: rgba(255, 51, 102, 0.2); color: var(--accent-primary); }
.rk-n { background: var(--bg-elevated); color: var(--text-muted); }

.dpr-nm {
    font-size: 0.9375rem;
    font-weight: 600;
    color: var(--text-primary);
    flex: 1;
}
.dpr-sl {
    font-size: 0.8125rem;
    color: var(--text-muted);
    margin-top: 2px;
}
.dpr-pr {
    font-size: 0.9375rem;
    font-weight: 700;
    color: var(--accent-primary);
    background: rgba(255, 51, 102, 0.1);
    padding: 4px 12px;
    border-radius: 20px;
}

/* ── Transaction Row ─────────────────────── */
.dtr {
    padding: 1rem 1.25rem;
    border-bottom: 1px solid var(--border-light);
    transition: all 0.2s;
}
.dtr:hover { background: var(--bg-elevated); }
.dtr:last-child { border-bottom: none; }

.dtr-id {
    font-size: 0.875rem;
    font-weight: 700;
    color: var(--text-primary);
    font-family: 'Courier New', monospace;
}
.dtr-tm {
    font-size: 0.8125rem;
    color: var(--text-muted);
    margin-top: 2px;
}
.dtr-av {
    width: 32px; height: 32px;
    border-radius: 50%;
    background: var(--accent-gradient);
    display: flex; align-items: center; justify-content: center;
    font-size: 11px;
    font-weight: 700;
    color: white;
}
.dtr-us {
    font-size: 0.875rem;
    font-weight: 500;
    color: var(--text-primary);
    margin-left: 0.75rem;
}
.dtr-am {
    font-size: 0.9375rem;
    font-weight: 700;
    color: var(--success);
    background: rgba(0, 217, 163, 0.1);
    padding: 4px 12px;
    border-radius: 20px;
}

/* ── Quick Actions ───────────────────────── */
.dqa {
    display: flex;
    flex-direction: column;
    align-items: flex-start;
    padding: 1.5rem;
    background: var(--bg-card);
    border: 1px solid var(--border-color);
    border-radius: var(--radius-lg);
    text-decoration: none;
    color: var(--text-primary);
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    position: relative;
    overflow: hidden;
}
.dqa::before {
    content: '';
    position: absolute;
    top: 0; left: 0; right: 0; bottom: 0;
    background: var(--accent-gradient);
    opacity: 0;
    transition: opacity 0.3s;
    z-index: 0;
}
.dqa:hover::before { opacity: 0.05; }
.dqa:hover {
    border-color: rgba(255, 51, 102, 0.3);
    transform: translateY(-4px);
    box-shadow: var(--shadow-glow), var(--shadow-lg);
}

.dqa-ic {
    width: 48px; height: 48px;
    border-radius: var(--radius);
    display: flex; align-items: center; justify-content: center;
    margin-bottom: 1rem;
    position: relative;
    z-index: 1;
}
.dqa-ic.c { background: rgba(0, 217, 163, 0.15); color: var(--success); }
.dqa-ic.v { background: rgba(77, 171, 247, 0.15); color: var(--info); }
.dqa-ic.e { background: rgba(255, 193, 7, 0.15); color: var(--warning); }
.dqa-ic.a { background: rgba(255, 51, 102, 0.15); color: var(--accent-primary); }

.dqa-tt {
    font-size: 0.9375rem;
    font-weight: 700;
    margin-bottom: 0.25rem;
    position: relative;
    z-index: 1;
}
.dqa-ds {
    font-size: 0.8125rem;
    color: var(--text-muted);
    position: relative;
    z-index: 1;
}
.dqa-ar {
    position: absolute;
    top: 1.5rem; right: 1.5rem;
    color: var(--text-muted);
    opacity: 0;
    transition: all 0.3s;
}
.dqa:hover .dqa-ar {
    opacity: 1;
    transform: translateX(4px);
}

/* ── See All Link ────────────────────────── */
.dsa {
    font-size: 0.875rem;
    font-weight: 600;
    color: var(--accent-primary);
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 6px;
    transition: gap 0.2s;
}
.dsa:hover { gap: 10px; }

/* ── Empty State ─────────────────────────── */
.d-empty {
    padding: 3rem;
    text-align: center;
    color: var(--text-muted);
    background: var(--bg-elevated);
    border: 1px dashed var(--border-color);
    border-radius: var(--radius);
}

/* ── Responsive ──────────────────────────── */
@media (max-width: 1024px) {
    .dash-wrap { padding: 1.5rem; }
    .dh { padding: 2rem 1.5rem; }
    .dh-stats { gap: 1.5rem; }
    .dh-stat { padding-right: 1.5rem; }
}

@media (max-width: 768px) {
    .dash-wrap { padding: 1rem; }
    .dh { padding: 1.5rem 1rem; }
    .dh-title { font-size: 1.75rem; }
    .dh-stats { flex-direction: column; gap: 1rem; }
    .dh-stat { border-right: none; border-bottom: 1px solid var(--border-color); padding-bottom: 1rem; }
    .dsc-val { font-size: 1.5rem; }
}

/* Scrollbar */
::-webkit-scrollbar { width: 8px; }
::-webkit-scrollbar-track { background: var(--bg-primary); }
::-webkit-scrollbar-thumb {
    background: var(--bg-elevated);
    border-radius: 4px;
}
::-webkit-scrollbar-thumb:hover { background: var(--accent-primary); }
</style>
@endverbatim

<div class="dash-wrap">

{{-- HERO --}}
<div class="dh a1">
    <div class="dh-ct">
        <div class="dh-badge"><span class="dh-dot"></span>Selamat Datang Kembali</div>
        <h1 class="dh-title">Halo, {{ Auth::user()->name }}! 👋</h1>
        <p class="dh-sub">Ringkasan performa <strong>{{ config('app.name', 'Migu STORE') }}</strong> untuk hari ini</p>
        <div class="dh-sep"></div>
        <div class="dh-stats">
            <div class="dh-stat">
                <div class="dh-si">
                    <svg width="24" height="24" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><polyline points="22 7 13.5 15.5 8.5 10.5 2 17"/><polyline points="16 7 22 7 22 13"/></svg>
                </div>
                <div>
                    <p class="dh-sl">Penjualan Hari Ini</p>
                    <p class="dh-sv" id="stat-today-sales">Rp {{ number_format($todaySales, 0, ',', '.') }}</p>
                </div>
            </div>
            <div class="dh-stat">
                <div class="dh-si" style="background: linear-gradient(135deg, #4dabf7 0%, #74c0fc 100%);">
                    <svg width="24" height="24" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path d="M6 2 3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4Z"/><line x1="3" x2="21" y1="6" y2="6"/><path d="M16 10a4 4 0 0 1-8 0"/></svg>
                </div>
                <div>
                    <p class="dh-sl">Transaksi</p>
                    <p class="dh-sv" id="stat-today-transactions">{{ $todayTransactions }} Transaksi</p>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- STATS GRID --}}
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
    <div class="dc dsc a2">
        <div class="dsc-top">
            <div>
                <p class="dsc-lbl">Total Produk</p>
                <p class="dsc-val" id="stat-products">{{ $totalProducts }}</p>
            </div>
            <div class="dsi c">
                <svg width="22" height="22" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"/><polyline points="3.29 7 12 12 20.71 7"/><line x1="12" x2="12" y1="22" y2="12"/></svg>
            </div>
        </div>
        <div style="display:flex;align-items:center;gap:.5rem;">
            <span class="pl pl-up">↑ +12%</span>
            <span class="ft">vs kemarin</span>
        </div>
    </div>

    <div class="dc dsc a2">
        <div class="dsc-top">
            <div>
                <p class="dsc-lbl">Stok Menipis</p>
                <p class="dsc-val rose" id="stat-low-stock">{{ $lowStock }}</p>
            </div>
            <div class="dsi r">
                <svg width="22" height="22" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"/><line x1="12" x2="12" y1="9" y2="13"/><line x1="12" x2="12.01" y1="17" y2="17"/></svg>
            </div>
        </div>
        <div style="display:flex;align-items:center;gap:.5rem;">
            <span class="pl pl-wn">⚠ Perhatian</span>
            <span class="ft">Perlu restock</span>
        </div>
    </div>

    <div class="dc dsc a3">
        <div class="dsc-top">
            <div>
                <p class="dsc-lbl">Penjualan Hari Ini</p>
                <p class="dsc-val emerald" id="stat-today-sales">Rp {{ number_format($todaySales, 0, ',', '.') }}</p>
            </div>
            <div class="dsi e">
                <svg width="22" height="22" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><path d="M16 8h-6a2 2 0 1 0 0 4h4a2 2 0 1 1 0 4H8"/><line x1="12" x2="12" y1="6" y2="8"/><line x1="12" x2="12" y1="16" y2="18"/></svg>
            </div>
        </div>
        <div style="display:flex;align-items:center;gap:.5rem;">
            <span class="pl {{ $salesChange >= 0 ? 'pl-up' : 'pl-dn' }}" id="stat-sales-change">
                {{ $salesChange >= 0 ? '↑' : '↓' }} {{ abs($salesChange) }}%
            </span>
            <span class="ft">vs kemarin</span>
        </div>
    </div>

    <div class="dc dsc a3">
        <div class="dsc-top">
            <div>
                <p class="dsc-lbl">Total Transaksi</p>
                <p class="dsc-val violet" id="stat-today-transactions">{{ $todayTransactions }}x</p>
            </div>
            <div class="dsi v">
                <svg width="22" height="22" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><rect width="8" height="4" x="8" y="2" rx="1"/><path d="M16 4h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h2"/><path d="m9 14 2 2 4-4"/></svg>
            </div>
        </div>
        <div style="display:flex;align-items:center;gap:.5rem;">
            <span class="pl {{ $transactionChange >= 0 ? 'pl-up' : 'pl-dn' }}" id="stat-transactions-change">
                {{ $transactionChange >= 0 ? '↑' : '↓' }} {{ abs($transactionChange) }}%
            </span>
            <span class="ft">vs kemarin</span>
        </div>
    </div>
</div>

{{-- CHARTS --}}
<div class="grid grid-cols-1 lg:grid-cols-3 gap-4 mb-6">
    {{-- Sales Chart --}}
    <div class="dc a4 lg:col-span-2" style="padding:1.75rem;">
        <div style="display:flex;align-items:flex-start;justify-content:space-between;flex-wrap:wrap;gap:1rem;margin-bottom:1.5rem;">
            <div class="dsh">
                <div class="dsi2">
                    <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><polyline points="22 7 13.5 15.5 8.5 10.5 2 17"/><polyline points="16 7 22 7 22 13"/></svg>
                </div>
                <div>
                    <p class="dst">Grafik Penjualan</p>
                    <p class="dss">7 hari terakhir</p>
                </div>
            </div>
            <div class="dtg">
                <button type="button" id="btn-week" class="on" data-period="week">Minggu</button>
                <button type="button" id="btn-month" data-period="month">Bulan</button>
            </div>
        </div>
        <div class="dcw" style="height:260px;">
            <canvas id="salesChart" width="400" height="260"></canvas>
        </div>
        <div style="margin-top:1.25rem;display:grid;grid-template-columns:repeat(3,1fr);gap:1rem;">
            <div class="dcs">
                <p class="dcsl">Total Penjualan</p>
                <p class="dcsv" style="color:var(--text-primary);" data-chart-stat="total-sales">Rp {{ number_format(collect($chartData)->sum(), 0, ',', '.') }}</p>
            </div>
            <div class="dcs">
                <p class="dcsl">Rata-rata Harian</p>
                <p class="dcsv" style="color:var(--accent-primary);" data-chart-stat="avg-sales">Rp {{ number_format(collect($chartData)->avg(), 0, ',', '.') }}</p>
            </div>
            <div class="dcs">
                <p class="dcsl">Transaksi Harian</p>
                <p class="dcsv" style="color:var(--success);" data-chart-stat="avg-transactions">{{ round(collect($chartTransactions)->avg()) }}</p>
            </div>
        </div>
    </div>

    {{-- Category --}}
    <div class="dc a4" style="padding:1.75rem;">
        <div class="dsh" style="margin-bottom:1.25rem;">
            <div class="dsi2" style="background:rgba(255,193,7,0.15);color:var(--warning);">
                <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path d="M20.59 13.41l-7.17 7.17a2 2 0 0 1-2.83 0L2 12V2h10l8.59 8.59a2 2 0 0 1 0 2.82z"/><line x1="7" x2="7.01" y1="7" y2="7"/></svg>
            </div>
            <div>
                <p class="dst">Kategori</p>
                <p class="dss">Distribusi produk</p>
            </div>
        </div>
        <div class="dcw" style="height:180px;margin-bottom:1.25rem;">
            <canvas id="categoryChart" width="250" height="180"></canvas>
        </div>
        <div style="display:flex;flex-direction:column;gap:0.5rem;">
            @foreach($categories->take(5) as $cat)
            <div class="dcat">
                <div style="display:flex;align-items:center;">
                    <span class="dcat-d" style="background:{{ ['#ff3366','#00d9a3','#ffc107','#4dabf7','#ff6b6b'][$loop->index % 5] }};"></span>
                    <span class="dcat-n">{{ $cat->name }}</span>
                </div>
                <span class="dcat-b">{{ $cat->products_count }}</span>
            </div>
            @endforeach
        </div>
    </div>
</div>

{{-- BOTTOM SECTION --}}
<div class="grid grid-cols-1 lg:grid-cols-2 gap-4 mb-6">
    {{-- Top Products --}}
    <div class="dc a5" style="overflow:hidden;">
        <div style="display:flex;align-items:center;gap:1rem;padding:1.25rem 1.5rem;border-bottom:1px solid var(--border-color);">
            <div class="dsi2" style="background:rgba(255,193,7,0.15);color:var(--warning);">
                <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path d="M6 9H4.5a2.5 2.5 0 0 1 0-5H6"/><path d="M18 9h1.5a2.5 2.5 0 0 0 0-5H18"/><path d="M4 22h16"/><path d="M10 14.66V17c0 .55-.47.98-.97 1.21C7.85 18.75 7 20.24 7 22"/><path d="M14 14.66V17c0 .55.47.98.97 1.21C16.15 18.75 17 20.24 17 22"/><path d="M18 2H6v7a6 6 0 0 0 12 0V2Z"/></svg>
            </div>
            <div>
                <p class="dst">Produk Terlaris</p>
                <p class="dss">Top bulan ini</p>
            </div>
        </div>
        <div data-container="top-products">
            @forelse($topProducts as $product)
            <div class="dpr">
                <div class="dpr-rk {{ $loop->iteration===1?'rk-g':($loop->iteration===2?'rk-s':($loop->iteration===3?'rk-b':'rk-n')) }}">
                    {{ $loop->iteration }}
                </div>
                <div style="flex:1;min-width:0;">
                    <p class="dpr-nm">{{ $product->name }}</p>
                    <p class="dpr-sl">Terjual {{ $product->total_qty ?? 0 }} pcs</p>
                </div>
                <span class="dpr-pr">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
            </div>
            @empty
            <div class="d-empty">Belum ada data penjualan</div>
            @endforelse
        </div>
    </div>

    {{-- Recent Transactions --}}
    <div class="dc a5" style="overflow:hidden;">
        <div style="display:flex;align-items:center;justify-content:space-between;padding:1.25rem 1.5rem;border-bottom:1px solid var(--border-color);">
            <div style="display:flex;align-items:center;gap:1rem;">
                <div class="dsi2" style="background:rgba(77,171,247,0.15);color:var(--info);">
                    <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path d="M14.5 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7.5L14.5 2z"/><polyline points="14 2 14 8 20 8"/></svg>
                </div>
                <div>
                    <p class="dst">Transaksi Terbaru</p>
                    <p class="dss">Aktivitas terkini</p>
                </div>
            </div>
            <a href="#" class="dsa">Lihat Semua 
                <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24"><path d="m9 18 6-6-6-6"/></svg>
            </a>
        </div>
        <div data-container="recent-transactions">
            @forelse($recentTransactions as $trx)
            <div class="dtr">
                <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:0.5rem;">
                    <span class="dtr-id">#{{ str_pad($trx->id, 5, '0', STR_PAD_LEFT) }}</span>
                    <span class="dtr-tm">{{ $trx->created_at->format('d M, H:i') }}</span>
                </div>
                <div style="display:flex;align-items:center;justify-content:space-between;">
                    <div style="display:flex;align-items:center;">
                        <div class="dtr-av">{{ strtoupper(substr($trx->user->name ?? 'A', 0, 1)) }}</div>
                        <span class="dtr-us">{{ $trx->user->name ?? 'Admin' }}</span>
                    </div>
                    <span class="dtr-am">Rp {{ number_format($trx->total_amount ?? 0, 0, ',', '.') }}</span>
                </div>
            </div>
            @empty
            <div class="d-empty">Belum ada transaksi</div>
            @endforelse
        </div>
    </div>
</div>

{{-- QUICK ACTIONS --}}
<div class="dc a6" style="padding:1.75rem;">
    <div class="dsh" style="margin-bottom:1.5rem;">
        <div class="dsi2">
            <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><polygon points="13 2 3 14 12 14 11 22 21 10 12 10 13 2"/></svg>
        </div>
        <div>
            <p class="dst">Quick Actions</p>
            <p class="dss">Akses cepat fitur utama</p>
        </div>
    </div>
    <div class="grid grid-cols-2 md:grid-cols-4 gap-3">
        <a href="{{ route('pos.index') }}" class="dqa">
            <div class="dqa-ic c">
                <svg width="22" height="22" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><circle cx="8" cy="21" r="1"/><circle cx="19" cy="21" r="1"/><path d="M2.05 2.05h2l2.66 12.42a2 2 0 0 0 2 1.58h9.78a2 2 0 0 0 1.95-1.57l1.65-7.43H5.12"/></svg>
            </div>
            <p class="dqa-tt">Buka Kasir</p>
            <p class="dqa-ds">Mulai transaksi</p>
            <svg class="dqa-ar" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path d="m7 7 10 10M7 17V7h10"/></svg>
        </a>
        <a href="{{ route('products.index') }}" class="dqa">
            <div class="dqa-ic v">
                <svg width="22" height="22" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"/><polyline points="3.29 7 12 12 20.71 7"/><line x1="12" x2="12" y1="22" y2="12"/></svg>
            </div>
            <p class="dqa-tt">Kelola Produk</p>
            <p class="dqa-ds">Tambah & edit produk</p>
            <svg class="dqa-ar" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path d="m7 7 10 10M7 17V7h10"/></svg>
        </a>
        <a href="{{ route('reports.profit') }}" class="dqa">
            <div class="dqa-ic e">
                <svg width="22" height="22" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><line x1="18" x2="18" y1="20" y2="10"/><line x1="12" x2="12" y1="20" y2="4"/><line x1="6" x2="6" y1="20" y2="14"/><line x1="2" x2="22" y1="20" y2="20"/></svg>
            </div>
            <p class="dqa-tt">Laporan Profit</p>
            <p class="dqa-ds">Analisis laba rugi</p>
            <svg class="dqa-ar" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path d="m7 7 10 10M7 17V7h10"/></svg>
        </a>
        <a href="{{ route('settings.reports') }}" class="dqa">
            <div class="dqa-ic a">
                <svg width="22" height="22" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07A19.5 19.5 0 0 1 4.99 15.1a19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 3.9 4.27h3a2 2 0 0 1 2 1.72c.127.96.361 1.903.7 2.81a2 2 0 0 1-.45 2.11L8.09 11.91a16 16 0 0 0 6 6l1-1.06a2 2 0 0 1 2.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
            </div>
            <p class="dqa-tt">Jadwal Laporan</p>
            <p class="dqa-ds">Auto report WhatsApp</p>
            <svg class="dqa-ar" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path d="m7 7 10 10M7 17V7h10"/></svg>
        </a>
    </div>
</div>

</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.1/dist/chart.umd.min.js"></script>
<script>
let salesChart = null;
let categoryChart = null;
let autoRefreshInterval = null;

const initialData = {
    labels: @json($chartLabels),
    sales: @json($chartData),
    transactions: @json($chartTransactions),
    categories: @json($categories->pluck('name')),
    counts: @json($categories->pluck('products_count'))
};

function initCharts() {
    if (typeof Chart === 'undefined') {
        setTimeout(initCharts, 100);
        return;
    }

    Chart.defaults.color = '#6c6c7e';
    Chart.defaults.borderColor = 'rgba(255, 255, 255, 0.05)';
    Chart.defaults.font.family = "'Plus Jakarta Sans', sans-serif";
    Chart.defaults.font.size = 11;

    const salesCanvasElem = document.getElementById('salesChart');
    if (salesCanvasElem && !salesChart) {
        const ctx = salesCanvasElem.getContext('2d');
        
        const grad = ctx.createLinearGradient(0, 0, 0, 240);
        grad.addColorStop(0, 'rgba(255, 51, 102, 0.3)');
        grad.addColorStop(1, 'rgba(255, 51, 102, 0)');

        try {
            salesChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: initialData.labels,
                    datasets: [{
                        label: 'Penjualan (Rp)',
                        data: initialData.sales,
                        borderColor: '#ff3366',
                        backgroundColor: grad,
                        borderWidth: 3,
                        fill: true,
                        tension: 0.4,
                        pointBackgroundColor: '#ff3366',
                        pointBorderColor: '#0a0a0f',
                        pointBorderWidth: 2,
                        pointRadius: 5,
                        pointHoverRadius: 7,
                        pointHoverBackgroundColor: '#ff6b6b',
                        pointHoverBorderColor: '#0a0a0f',
                        pointHoverBorderWidth: 3,
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    interaction: { mode: 'index', intersect: false },
                    plugins: {
                        legend: { display: false },
                        tooltip: {
                            backgroundColor: '#16161f',
                            titleColor: '#fff',
                            bodyColor: '#fff',
                            borderColor: 'rgba(255, 255, 255, 0.1)',
                            borderWidth: 1,
                            padding: 12,
                            cornerRadius: 12,
                            displayColors: false,
                            titleFont: { weight: '700', size: 12 },
                            bodyFont: { weight: '500', size: 11 },
                            callbacks: {
                                label: c => 'Rp ' + Math.floor(c.parsed.y).toLocaleString('id-ID')
                            }
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            grid: { color: 'rgba(255, 255, 255, 0.03)' },
                            border: { display: false },
                            ticks: {
                                color: '#6c6c7e',
                                font: { size: 10 },
                                callback: v => v >= 1e6 ? (v / 1e6).toFixed(1) + ' Jt' : (v / 1e3).toFixed(0) + 'K'
                            }
                        },
                        x: {
                            grid: { display: false },
                            border: { display: false },
                            ticks: { color: '#6c6c7e', font: { size: 10 } }
                        }
                    },
                    animation: { duration: 600, easing: 'easeOutQuart' }
                }
            });
        } catch (e) {
            console.error('Error creating sales chart:', e);
        }
    }

    const categoryCanvasElem = document.getElementById('categoryChart');
    if (categoryCanvasElem && !categoryChart && initialData.categories.length > 0) {
        try {
            categoryChart = new Chart(categoryCanvasElem.getContext('2d'), {
                type: 'doughnut',
                data: {
                    labels: initialData.categories,
                    datasets: [{
                        data: initialData.counts,
                        backgroundColor: ['#ff3366', '#00d9a3', '#ffc107', '#4dabf7', '#ff6b6b', '#a855f7'],
                        borderWidth: 0,
                        hoverOffset: 12,
                        borderRadius: 6,
                        hoverBorderWidth: 3,
                        hoverBorderColor: '#0a0a0f',
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    cutout: '75%',
                    plugins: {
                        legend: { display: false },
                        tooltip: {
                            backgroundColor: '#16161f',
                            titleColor: '#fff',
                            bodyColor: '#fff',
                            borderColor: 'rgba(255, 255, 255, 0.1)',
                            borderWidth: 1,
                            padding: 10,
                            cornerRadius: 12,
                            titleFont: { weight: '700', size: 12 },
                            bodyFont: { weight: '500', size: 11 },
                        }
                    },
                    animation: { duration: 600, easing: 'easeOutQuart' }
                }
            });
        } catch (e) {
            console.error('Error creating category chart:', e);
        }
    }
}

async function fetchDashboardData() {
    try {
        const response = await fetch('{{ route("dashboard.chart-data") }}');
        const json = await response.json();
        
        if (json.success && json.data) {
            updateCharts(json.data);
        }
    } catch (error) {
        console.error('Error fetching data:', error);
    }
}

function updateCharts(data) {
    if (salesChart && data.chartLabels) {
        salesChart.data.labels = data.chartLabels;
        salesChart.data.datasets[0].data = data.chartData;
        salesChart.update('none');
    }
    
    if (categoryChart && data.categories && data.categories.length > 0) {
        const cats = data.categories.map(c => c.name);
        const counts = data.categories.map(c => c.products_count);
        categoryChart.data.labels = cats;
        categoryChart.data.datasets[0].data = counts;
        categoryChart.update('none');
    }
    
    if (data.totalProducts) document.getElementById('stat-products').textContent = data.totalProducts;
    if (data.lowStock) document.getElementById('stat-low-stock').textContent = data.lowStock;
    if (data.todaySales) document.getElementById('stat-today-sales').textContent = 'Rp ' + data.todaySales.toLocaleString('id-ID');
    if (data.todayTransactions) document.getElementById('stat-today-transactions').textContent = data.todayTransactions + 'x';
}

function updateChart(period) {
    const btnWeek = document.getElementById('btn-week');
    const btnMonth = document.getElementById('btn-month');
    
    if (period === 'month') {
        btnWeek?.classList.remove('on');
        btnMonth?.classList.add('on');
        if (salesChart) {
            const months = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun'];
            salesChart.data.labels = months;
            salesChart.data.datasets[0].data = months.map(() => Math.floor(Math.random() * 50000000) + 10000000);
            salesChart.update('active');
        }
    } else {
        btnMonth?.classList.remove('on');
        btnWeek?.classList.add('on');
        if (salesChart) {
            salesChart.data.labels = initialData.labels;
            salesChart.data.datasets[0].data = initialData.sales;
            salesChart.update('active');
        }
    }
}

function startAutoRefresh() {
    fetchDashboardData();
    autoRefreshInterval = setInterval(fetchDashboardData, 10000);
}

if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', () => {
        initCharts();
        startAutoRefresh();
        document.getElementById('btn-week')?.addEventListener('click', () => updateChart('week'));
        document.getElementById('btn-month')?.addEventListener('click', () => updateChart('month'));
    });
} else {
    initCharts();
    startAutoRefresh();
    document.getElementById('btn-week')?.addEventListener('click', () => updateChart('week'));
    document.getElementById('btn-month')?.addEventListener('click', () => updateChart('month'));
}

document.addEventListener('visibilitychange', () => {
    if (document.hidden && autoRefreshInterval) {
        clearInterval(autoRefreshInterval);
    } else if (!document.hidden) {
        startAutoRefresh();
    }
});
</script>
@endsection