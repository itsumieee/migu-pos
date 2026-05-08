@extends('layouts.app')

@section('page-title', 'Laporan Profit')

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
    --loss: #f43f5e;
    --loss-bg: rgba(244, 63, 94, 0.15);
    --warning: #f59e0b;
    
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
@keyframes pulse { 0%, 100% { opacity: 1; } 50% { opacity: 0.6; } }
@keyframes float { 0%, 100% { transform: translateY(0); } 50% { transform: translateY(-4px); } }

.animate-fade { animation: fadeIn 0.4s ease-out; }
.animate-slide { animation: slideUp 0.5s ease-out both; }
.animate-pulse { animation: pulse 2s ease-in-out infinite; }
.animate-float { animation: float 3s ease-in-out infinite; }

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
.period-badge {
    display: inline-flex; align-items: center; gap: 6px;
    padding: 4px 12px; border-radius: 20px;
    background: var(--accent-bg); border: 1px solid var(--accent-border);
    font-size: 0.8rem; font-weight: 600; color: var(--accent-primary);
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

/* ── Summary Cards ────────────────────────── */
.summary-grid {
    display: grid; grid-template-columns: repeat(1, 1fr); gap: 1rem;
}
@media (min-width: 768px) { .summary-grid { grid-template-columns: repeat(2, 1fr); } }
@media (min-width: 1024px) { .summary-grid { grid-template-columns: repeat(4, 1fr); } }

.summary-card {
    background: var(--bg-card); border: 1px solid var(--border-color);
    border-radius: var(--radius-xl); padding: 1.5rem;
    transition: all 0.3s ease;
}
.summary-card:hover {
    border-color: rgba(255, 51, 102, 0.3);
    box-shadow: var(--shadow-glow);
}
.summary-label {
    font-size: 0.75rem; font-weight: 700; color: var(--text-muted);
    text-transform: uppercase; letter-spacing: 0.05em;
}
.summary-value {
    font-size: 1.75rem; font-weight: 800; color: var(--text-primary);
    margin: 0.5rem 0; line-height: 1.2;
}
.summary-value.revenue { color: var(--text-primary); }
.summary-value.cost { color: var(--loss); }
.summary-value.profit { color: var(--profit); }
.summary-value.count { color: var(--text-primary); }

.summary-desc {
    font-size: 0.8rem; color: var(--text-muted);
}
.summary-margin {
    display: inline-flex; align-items: center; gap: 4px;
    padding: 3px 10px; border-radius: 20px;
    background: var(--profit-bg); color: var(--profit);
    font-size: 0.75rem; font-weight: 600; margin-top: 0.5rem;
}

/* ── Content Grid ─────────────────────────── */
.content-grid {
    display: grid; grid-template-columns: 1fr; gap: 1.5rem;
}
@media (min-width: 1024px) {
    .content-grid { grid-template-columns: 1fr 2fr; }
}

/* Section Card */
.section-card {
    background: var(--bg-card); border: 1px solid var(--border-color);
    border-radius: var(--radius-xl); overflow: hidden;
}
.section-header {
    padding: 1.25rem 1.5rem;
    border-bottom: 1px solid var(--border-light);
    display: flex; align-items: center; justify-content: space-between;
}
.section-title {
    font-size: 1.1rem; font-weight: 700; color: var(--text-primary);
}

/* Top Products List */
.products-list {
    padding: 0.5rem 0;
}
.product-item {
    display: flex; align-items: center; justify-content: space-between;
    padding: 1rem 1.5rem; border-bottom: 1px solid var(--border-light);
    transition: background 0.15s ease;
}
.product-item:last-child { border-bottom: none; }
.product-item:hover { background: var(--bg-hover); }

.product-rank {
    width: 28px; height: 28px; border-radius: 50%;
    background: var(--accent-gradient); color: white;
    display: flex; align-items: center; justify-content: center;
    font-size: 0.75rem; font-weight: 700; margin-right: 0.75rem;
    flex-shrink: 0;
}
.product-info { flex: 1; min-width: 0; }
.product-name {
    font-size: 0.9rem; font-weight: 600; color: var(--text-primary);
    margin-bottom: 0.125rem; line-height: 1.3;
    white-space: nowrap; overflow: hidden; text-overflow: ellipsis;
}
.product-sku {
    font-size: 0.75rem; color: var(--text-muted);
    font-family: var(--font-mono);
}
.product-profit {
    font-size: 0.95rem; font-weight: 700; color: var(--profit);
    text-align: right; flex-shrink: 0;
}

/* Transactions Table */
.table-wrapper { overflow-x: auto; }
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

.trx-id {
    font-family: var(--font-mono); font-size: 0.8rem;
    color: var(--text-primary); font-weight: 500;
}
.trx-time {
    font-size: 0.85rem; color: var(--text-secondary);
}
.trx-total {
    font-weight: 600; color: var(--text-primary);
}
.trx-profit {
    font-weight: 700; color: var(--profit);
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

/* Pagination */
.pagination-wrapper {
    padding: 1rem 1.25rem;
    background: var(--bg-elevated); border-top: 1px solid var(--border-light);
}
.pagination {
    display: flex; gap: 0.375rem; list-style: none; padding: 0;
    justify-content: center; flex-wrap: wrap;
}
.pagination li span, .pagination li a {
    display: flex; align-items: center; justify-content: center;
    min-width: 36px; height: 36px; padding: 0 0.5rem;
    border-radius: var(--radius-sm);
    background: var(--bg-card); border: 1px solid var(--border-color);
    color: var(--text-secondary); font-size: 0.85rem; font-weight: 500;
    text-decoration: none; transition: all 0.15s ease;
}
.pagination li.active span {
    background: var(--accent-primary); color: white;
    border-color: var(--accent-primary); font-weight: 600;
}
.pagination li a:hover {
    background: var(--bg-hover); color: var(--accent-primary);
    border-color: rgba(255, 51, 102, 0.3);
}
.pagination .disabled span { opacity: 0.5; cursor: not-allowed; }

/* ── Responsive ─────────────────────────── */
@media (max-width: 768px) {
    .page-header { flex-direction: column; align-items: flex-start; }
    .period-filter { width: 100%; overflow-x: auto; padding-bottom: 0.25rem; }
    .period-btn { padding: 0.5rem 0.875rem; font-size: 0.75rem; }
    .summary-value { font-size: 1.5rem; }
    .product-item { padding: 0.875rem 1rem; }
    .modern-table th, .modern-table td { padding: 0.75rem 1rem; font-size: 0.85rem; }
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
    <div style="max-width: 1440px; margin: 0 auto;">
        
        <!-- Page Header -->
        <div class="page-header animate-slide">
            <div class="page-title-group">
                <h1 class="page-title">Laporan Profit & Rugi</h1>
                <p class="page-subtitle">
                    Periode: <span style="color: var(--accent-primary); font-weight: 600;">{{ $title ?? 'Semua Waktu' }}</span>
                </p>
            </div>
            
            <!-- Period Filter Tabs -->
            <div class="period-filter">
                <a href="?period=today" class="period-btn {{ ($period ?? 'today') === 'today' ? 'active' : '' }}">Hari Ini</a>
                <a href="?period=week" class="period-btn {{ ($period ?? 'today') === 'week' ? 'active' : '' }}">Minggu Ini</a>
                <a href="?period=month" class="period-btn {{ ($period ?? 'today') === 'month' ? 'active' : '' }}">Bulan Ini</a>
                <a href="?period=year" class="period-btn {{ ($period ?? 'today') === 'year' ? 'active' : '' }}">Tahun Ini</a>
            </div>
        </div>

        <!-- Summary Cards -->
        <div class="summary-grid">
            <div class="summary-card animate-fade">
                <p class="summary-label">Total Pendapatan</p>
                <p class="summary-value revenue">Rp {{ number_format(($summary['total_revenue'] ?? 0), 0, ',', '.') }}</p>
                <p class="summary-desc">Omzet kotor</p>
            </div>

            <div class="summary-card animate-fade" style="animation-delay: 0.1s;">
                <p class="summary-label">Total Modal</p>
                <p class="summary-value cost">Rp {{ number_format(($summary['total_cost'] ?? 0), 0, ',', '.') }}</p>
                <p class="summary-desc">Harga beli produk</p>
            </div>

            <div class="summary-card animate-fade" style="animation-delay: 0.2s;">
                <p class="summary-label">Laba Bersih</p>
                <p class="summary-value profit">Rp {{ number_format(($summary['total_profit'] ?? 0), 0, ',', '.') }}</p>
                <span class="summary-margin">
                    Margin: {{ ($summary['margin'] ?? 0) }}%
                </span>
            </div>

            <div class="summary-card animate-fade" style="animation-delay: 0.3s;">
                <p class="summary-label">Transaksi</p>
                <p class="summary-value count">{{ $summary['count'] ?? 0 }}</p>
                <p class="summary-desc">Total transaksi</p>
            </div>
        </div>

        <!-- Content Grid -->
        <div class="content-grid" style="margin-top: 1.5rem;">
            
            <!-- Top Products -->
            <div class="section-card animate-slide">
                <div class="section-header">
                    <h3 class="section-title">🏆 Produk Terlaris</h3>
                </div>
                <div class="products-list">
                    @forelse(($topProducts ?? []) as $index => $product)
                    <div class="product-item">
                        <div style="display: flex; align-items: center; gap: 0.75rem; min-width: 0; flex: 1;">
                            <span class="product-rank">{{ $index + 1 }}</span>
                            <div class="product-info">
                                <p class="product-name">{{ $product->name ?? 'Produk' }}</p>
                                <p class="product-sku">{{ $product->sku ?? '-' }}</p>
                            </div>
                        </div>
                        <p class="product-profit">+Rp {{ number_format(($product->total_profit ?? 0), 0, ',', '.') }}</p>
                    </div>
                    @empty
                    <div class="empty-state">
                        <div class="empty-icon">
                            <svg width="28" height="28" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                            </svg>
                        </div>
                        <p>Belum ada data produk</p>
                    </div>
                    @endforelse
                </div>
            </div>

            <!-- Transactions Table -->
            <div class="section-card animate-slide" style="animation-delay: 0.1s;">
                <div class="section-header">
                    <h3 class="section-title">📋 Riwayat Transaksi</h3>
                </div>
                <div class="table-wrapper">
                    <table class="modern-table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Waktu</th>
                                <th style="text-align: right;">Total</th>
                                <th style="text-align: right;">Profit</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse(($transactions ?? []) as $trx)
                            <tr>
                                <td>
                                    <span class="trx-id">#{{ str_pad(($trx->id ?? 0), 5, '0', STR_PAD_LEFT) }}</span>
                                </td>
                                <td>
                                    <span class="trx-time">
                                        {{ ($trx->created_at ?? now())->format('d M Y, H:i') }}
                                    </span>
                                </td>
                                <td>
                                    <span class="trx-total">Rp {{ number_format(($trx->total_amount ?? 0), 0, ',', '.') }}</span>
                                </td>
                                <td>
                                    <span class="trx-profit">
                                        +Rp {{ number_format((($trx->transactionItems ?? collect())->sum('profit') ?? 0), 0, ',', '.') }}
                                    </span>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4">
                                    <div class="empty-state">
                                        <div class="empty-icon">
                                            <svg width="28" height="28" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                                            </svg>
                                        </div>
                                        <p>Belum ada transaksi di periode {{ $title ?? 'ini' }}</p>
                                    </div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                
                <!-- Pagination -->
                @if(($transactions ?? collect())->hasPages())
                <div class="pagination-wrapper">
                    {{ ($transactions ?? collect())->links('pagination::tailwind') }}
                </div>
                @endif
            </div>
        </div>
    </div>
</div>

<!-- Custom Pagination Styles Override -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Add smooth hover effects to pagination
    document.querySelectorAll('.pagination a, .pagination span').forEach(el => {
        el.style.transition = 'all 0.15s ease';
    });
});
</script>

@endsection