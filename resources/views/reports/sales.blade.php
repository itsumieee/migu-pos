@extends('layouts.app')

@section('page-title', 'Laporan Penjualan')

@section('content')

<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=JetBrains+Mono:wght@400;500&display=swap" rel="stylesheet">

@verbatim
<style>
/* ── Modern Dark Theme CSS Variables - 🔴 RED ACCENT ───────── */
:root {
    --bg-primary: #0a0a0f;
    --bg-secondary: #12121a;
    --bg-card: #16161f;
    --bg-elevated: #1c1c2e;
    --bg-hover: rgba(255, 51, 102, 0.08);
    
    /* 🔴 RED/PINK ACCENT */
    --accent-primary: #ff3366;
    --accent-secondary: #ff6b6b;
    --accent-gradient: linear-gradient(135deg, #ff3366 0%, #ff6b6b 100%);
    --accent-glow: rgba(255, 51, 102, 0.3);
    
    /* Financial Colors */
    --profit: #10b981;
    --profit-bg: rgba(16, 185, 129, 0.15);
    
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
    --font-mono: 'JetBrains Mono', monospace;
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
    background-image: 
        radial-gradient(at 0% 0%, rgba(255, 51, 102, 0.08) 0px, transparent 50%),
        radial-gradient(at 100% 100%, rgba(255, 107, 107, 0.06) 0px, transparent 50%);
    background-attachment: fixed;
}

/* ── Animations ─────────────────────────────── */
@keyframes fadeIn { from { opacity: 0; } to { opacity: 1; } }
@keyframes slideUp { from { opacity: 0; transform: translateY(16px); } to { opacity: 1; transform: translateY(0); } }

.animate-fade { animation: fadeIn 0.4s ease-out; }
.animate-slide { animation: slideUp 0.5s ease-out both; }

/* ── Utility Classes ───────────────────────── */
.glass {
    background: rgba(18, 18, 26, 0.7);
    backdrop-filter: blur(20px);
    border: 1px solid var(--border-color);
}
.glass-card {
    background: var(--bg-card);
    border: 1px solid var(--border-color);
    border-radius: var(--radius-lg);
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
}
.glass-card:hover {
    border-color: rgba(255, 51, 102, 0.3);
    box-shadow: var(--shadow-lg), var(--shadow-glow);
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

/* ── Decorative Elements ───────────────────── */
.deco-blob {
    position: fixed; border-radius: 50%; filter: blur(60px);
    opacity: 0.1; pointer-events: none; z-index: 0;
}
.deco-blob-1 { top: 5%; right: 10%; width: 300px; height: 300px; background: var(--accent-primary); }
.deco-blob-2 { bottom: 15%; left: 5%; width: 200px; height: 200px; background: var(--profit); }

/* ── Page Header ───────────────────────────── */
.page-header {
    display: flex; flex-wrap: wrap; justify-content: space-between; align-items: flex-start;
    gap: 1rem; margin-bottom: 2rem; padding: 1rem 0;
}
.page-title-group { display: flex; flex-direction: column; gap: 0.25rem; }
.page-title {
    font-size: clamp(1.5rem, 4vw, 2rem);
    font-weight: 800; line-height: 1.2; color: var(--text-primary);
}
.page-subtitle {
    font-size: 0.9rem; color: var(--text-secondary);
}

/* Period Filter Tabs */
.period-filter {
    display: flex; gap: 0.25rem; padding: 0.25rem;
    background: var(--bg-card); border: 1px solid var(--border-color);
    border-radius: var(--radius-lg);
}
.period-btn {
    padding: 0.625rem 1rem; border-radius: var(--radius);
    font-size: 0.8rem; font-weight: 600; color: var(--text-secondary);
    text-decoration: none; transition: all 0.2s ease;
    white-space: nowrap;
}
.period-btn:hover {
    color: var(--text-primary); background: var(--bg-hover);
}
.period-btn.active {
    background: var(--bg-elevated); color: var(--accent-primary);
    box-shadow: 0 2px 8px rgba(255, 51, 102, 0.15);
}

/* Export Button */
.export-btn {
    display: inline-flex; align-items: center; gap: 0.5rem;
    padding: 0.75rem 1.25rem; border-radius: var(--radius-lg);
    background: var(--profit); border: none; color: white;
    font-size: 0.85rem; font-weight: 600; text-decoration: none;
    transition: all 0.2s ease;
    box-shadow: 0 4px 16px rgba(16, 185, 129, 0.3);
}
.export-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 24px rgba(16, 185, 129, 0.4);
}
.export-btn svg { width: 16px; height: 16px; flex-shrink: 0; }

/* ── Table Container ───────────────────────── */
.table-container {
    background: var(--bg-card); border: 1px solid var(--border-color);
    border-radius: var(--radius-xl); overflow: hidden;
}
.table-wrapper { overflow-x: auto; }

/* Modern Table */
.modern-table {
    width: 100%; border-collapse: separate; border-spacing: 0;
}
.modern-table thead {
    background: var(--bg-elevated);
    border-bottom: 1px solid var(--border-light);
}
.modern-table th {
    padding: 1rem 1.25rem;
    font-size: 0.75rem; font-weight: 700; color: var(--text-muted);
    text-transform: uppercase; letter-spacing: 0.05em;
    text-align: left; white-space: nowrap;
}
.modern-table th:last-child { text-align: right; }

.modern-table tbody tr {
    border-bottom: 1px solid var(--border-light);
    transition: all 0.2s ease;
}
.modern-table tbody tr:last-child { border-bottom: none; }
.modern-table tbody tr:hover {
    background: var(--bg-hover);
    border-color: rgba(255, 51, 102, 0.2);
}

.modern-table td {
    padding: 1rem 1.25rem;
    font-size: 0.9rem; color: var(--text-primary);
    vertical-align: middle;
}
.modern-table td:last-child { text-align: right; }

/* Period Cell */
.period-cell {
    font-weight: 600; color: var(--text-primary);
}

/* Count Badge */
.count-badge {
    display: inline-flex; align-items: center; justify-content: center;
    padding: 4px 12px; border-radius: 20px;
    background: var(--bg-elevated); border: 1px solid var(--border-color);
    font-size: 0.75rem; font-weight: 600; color: var(--text-secondary);
}

/* Amount Cell */
.amount-cell {
    font-size: 0.95rem; font-weight: 700; color: var(--profit);
}

/* Table Footer */
.modern-table tfoot {
    background: var(--bg-elevated);
    border-top: 1px solid var(--border-light);
}
.modern-table tfoot td {
    padding: 1rem 1.25rem;
    font-size: 0.95rem; font-weight: 700; color: var(--text-primary);
}
.modern-table tfoot td:last-child {
    font-size: 1.1rem; color: var(--text-primary);
}

/* Empty State */
.empty-state {
    text-align: center; padding: 3rem 1rem; color: var(--text-muted);
}
.empty-icon {
    width: 56px; height: 56px; margin: 0 auto 1rem;
    border-radius: var(--radius-lg); background: var(--bg-elevated);
    display: flex; align-items: center; justify-content: center;
    opacity: 0.5;
}

/* ── Responsive ─────────────────────────── */
@media (max-width: 768px) {
    .page-header { flex-direction: column; align-items: flex-start; }
    .period-filter { width: 100%; overflow-x: auto; padding-bottom: 0.25rem; }
    .period-btn { padding: 0.5rem 0.875rem; font-size: 0.75rem; }
    .export-btn { width: 100%; justify-content: center; }
    .modern-table th, .modern-table td { padding: 0.75rem 1rem; font-size: 0.85rem; }
    .amount-cell { font-size: 0.9rem; }
}

/* ── Scrollbar ───────────────────────────── */
::-webkit-scrollbar { width: 5px; height: 5px; }
::-webkit-scrollbar-track { background: transparent; }
::-webkit-scrollbar-thumb {
    background: var(--bg-elevated); border-radius: 3px;
}
::-webkit-scrollbar-thumb:hover { background: var(--accent-primary); }

/* ── Focus States ───────────────────────── */
a:focus-visible, button:focus-visible {
    outline: 2px solid var(--accent-primary); outline-offset: 2px;
}

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

<div style="padding: 2rem 1.5rem;">
    <div style="max-width: 1200px; margin: 0 auto;">
        
        <!-- Page Header -->
        <div class="page-header animate-slide">
            <div class="page-title-group">
                <h1 class="page-title">Laporan Penjualan</h1>
                <p class="page-subtitle">Analisis pendapatan toko</p>
            </div>
            
            <div style="display: flex; flex-wrap: wrap; gap: 0.75rem; align-items: center;">
                <!-- Period Filter Tabs -->
                <div class="period-filter">
                    <a href="?type=daily" class="period-btn {{ (request('type') ?? 'monthly') === 'daily' ? 'active' : '' }}">Harian</a>
                    <a href="?type=monthly" class="period-btn {{ (request('type') ?? 'monthly') !== 'daily' ? 'active' : '' }}">Bulanan</a>
                </div>
                
                <!-- Export Button -->
                <a href="{{ route('reports.export') }}" class="export-btn">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                    Export CSV
                </a>
            </div>
        </div>

        <!-- Table -->
        <div class="table-container animate-fade">
            <div class="table-wrapper">
                <table class="modern-table">
                    <thead>
                        <tr>
                            <th>Periode</th>
                            <th>Jumlah Transaksi</th>
                            <th style="text-align: right;">Total Pendapatan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse(($data ?? []) as $d)
                        <tr>
                            <td>
                                <span class="period-cell">{{ $d->period ?? '-' }}</span>
                            </td>
                            <td>
                                <span class="count-badge">{{ $d->count ?? 0 }}x</span>
                            </td>
                            <td>
                                <span class="amount-cell">Rp {{ number_format(($d->total ?? 0), 0, ',', '.') }}</span>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="3">
                                <div class="empty-state">
                                    <div class="empty-icon">
                                        <svg width="28" height="28" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                                        </svg>
                                    </div>
                                    <p>Belum ada data laporan</p>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                    
                    @if(!empty($data) && count($data) > 0)
                    <tfoot>
                        <tr>
                            <td>
                                <span style="color: var(--text-primary);">Total Keseluruhan</span>
                            </td>
                            <td></td>
                            <td>
                                <span style="color: var(--text-primary); font-size: 1.1rem;">
                                    Rp {{ number_format((collect($data ?? [])->sum('total') ?? 0), 0, ',', '.') }}
                                </span>
                            </td>
                        </tr>
                    </tfoot>
                    @endif
                </table>
            </div>
        </div>
    </div>
</div>

@endsection