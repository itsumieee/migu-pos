@extends('layouts.app')

@section('page-title', 'Riwayat Transaksi')

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
    
    --emerald: #10b981;
    --amber: #f59e0b;
    --rose: #f43f5e;
    
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

.animate-fade { animation: fadeIn 0.4s ease-out; }
.animate-slide { animation: slideUp 0.5s ease-out both; }
.animate-pulse { animation: pulse 2s ease-in-out infinite; }

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
.deco-blob-2 { bottom: 15%; left: 5%; width: 200px; height: 200px; background: var(--accent-secondary); }

/* ── Page Header ───────────────────────────── */
.page-header {
    display: flex; flex-wrap: wrap; justify-content: space-between; align-items: flex-start;
    gap: 1rem; margin-bottom: 2rem; padding: 1rem 0;
}
.page-title-group { display: flex; flex-direction: column; gap: 0.25rem; }
.page-title {
    font-size: clamp(1.5rem, 4vw, 2rem);
    font-weight: 800; line-height: 1.2; color: var(--text-primary);
    letter-spacing: -0.02em;
}
.page-subtitle {
    font-size: 0.9rem; color: var(--text-secondary);
}

/* Filter Form */
.filter-form {
    display: flex; flex-wrap: wrap; gap: 0.75rem; align-items: center;
}
.date-input {
    padding: 0.75rem 1rem;
    background: var(--bg-card); border: 1px solid var(--border-color);
    border-radius: var(--radius-lg); font-size: 0.9rem;
    color: var(--text-primary); transition: all 0.2s ease;
    font-family: var(--font-main);
}
.date-input::placeholder { color: var(--text-muted); }
.date-input:focus {
    outline: none; border-color: var(--accent-primary);
    box-shadow: 0 0 0 3px rgba(255, 51, 102, 0.15);
    background: var(--bg-elevated);
}
.filter-btn {
    display: inline-flex; align-items: center; gap: 0.5rem;
    padding: 0.75rem 1.25rem; border-radius: var(--radius-lg);
    background: var(--accent-gradient); border: none; color: white;
    font-size: 0.85rem; font-weight: 600; cursor: pointer;
    transition: all 0.2s ease;
    box-shadow: 0 4px 20px var(--accent-glow);
}
.filter-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 32px var(--accent-glow);
}

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
    cursor: pointer;
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

/* Transaction ID Link */
.trx-id {
    font-family: var(--font-mono); font-size: 0.85rem;
    font-weight: 600; color: var(--text-primary);
    text-decoration: none; transition: color 0.15s ease;
}
.trx-id:hover { color: var(--accent-primary); }

/* Date Display */
.trx-date {
    font-size: 0.9rem; font-weight: 500; color: var(--text-primary);
    margin-bottom: 0.125rem;
}
.trx-time {
    font-size: 0.75rem; color: var(--text-muted);
}

/* Cashier Avatar */
.cashier-cell {
    display: flex; align-items: center; gap: 0.75rem;
}
.cashier-avatar {
    width: 32px; height: 32px; border-radius: 50%;
    background: var(--accent-gradient);
    display: flex; align-items: center; justify-content: center;
    font-size: 0.75rem; font-weight: 700; color: white;
    flex-shrink: 0;
}
.cashier-name {
    font-size: 0.9rem; font-weight: 500; color: var(--text-primary);
}

/* Amount Display */
.trx-amount {
    font-size: 0.95rem; font-weight: 700; color: var(--text-primary);
}

/* Status Badge */
.status-badge {
    display: inline-flex; align-items: center; gap: 4px;
    padding: 4px 12px; border-radius: 20px;
    font-size: 0.75rem; font-weight: 600;
}
.status-badge.completed {
    background: rgba(16, 185, 129, 0.15); color: var(--emerald);
    border: 1px solid rgba(16, 185, 129, 0.3);
}
.status-badge.pending {
    background: rgba(245, 158, 11, 0.15); color: var(--amber);
    border: 1px solid rgba(245, 158, 11, 0.3);
}
.status-badge.cancelled {
    background: rgba(244, 63, 94, 0.15); color: var(--rose);
    border: 1px solid rgba(244, 63, 94, 0.3);
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
    justify-content: flex-end; flex-wrap: wrap;
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
    .filter-form { width: 100%; }
    .date-input { flex: 1; min-width: 150px; }
    .filter-btn { width: 100%; justify-content: center; }
    .modern-table th, .modern-table td { padding: 0.75rem 1rem; font-size: 0.85rem; }
    .cashier-cell { flex-direction: column; align-items: flex-start; gap: 0.375rem; }
    .trx-amount { font-size: 0.9rem; }
}

/* ── Scrollbar ───────────────────────────── */
::-webkit-scrollbar { width: 5px; height: 5px; }
::-webkit-scrollbar-track { background: transparent; }
::-webkit-scrollbar-thumb {
    background: var(--bg-elevated); border-radius: 3px;
}
::-webkit-scrollbar-thumb:hover { background: var(--accent-primary); }

/* ── Focus States ───────────────────────── */
button:focus-visible, a:focus-visible, input:focus-visible {
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
                <h1 class="page-title">Riwayat Transaksi</h1>
                <p class="page-subtitle">Data semua transaksi yang telah terjadi</p>
            </div>
            
            <!-- Filter Form -->
            <form method="GET" class="filter-form">
                <input type="date" name="date" value="{{ request('date') }}" class="date-input">
                <button type="submit" class="filter-btn">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"/>
                    </svg>
                    Filter
                </button>
            </form>
        </div>

        <!-- Table -->
        <div class="table-container animate-fade">
            <div class="table-wrapper">
                <table class="modern-table">
                    <thead>
                        <tr>
                            <th>ID Transaksi</th>
                            <th>Tanggal & Waktu</th>
                            <th>Kasir</th>
                            <th style="text-align: right;">Total</th>
                            <th style="text-align: right;">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse(($transactions ?? []) as $t)
                        <tr onclick="window.location.href='{{ route('transactions.show', $t) }}'" style="cursor: pointer;">
                            <td>
                                <a href="{{ route('transactions.show', $t) }}" class="trx-id">
                                    #{{ str_pad(($t->id ?? 0), 5, '0', STR_PAD_LEFT) }}
                                </a>
                            </td>
                            <td>
                                <div class="trx-date">{{ ($t->created_at ?? now())->format('d M Y') }}</div>
                                <div class="trx-time">{{ ($t->created_at ?? now())->format('H:i') }}</div>
                            </td>
                            <td>
                                <div class="cashier-cell">
                                    <div class="cashier-avatar">
                                        {{ substr(($t->user->name ?? 'A'), 0, 1) }}
                                    </div>
                                    <span class="cashier-name">{{ $t->user->name ?? 'Admin' }}</span>
                                </div>
                            </td>
                            <td>
                                <span class="trx-amount">Rp {{ number_format(($t->total_amount ?? 0), 0, ',', '.') }}</span>
                            </td>
                            <td>
                                <span class="status-badge completed">
                                    Selesai
                                </span>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5">
                                <div class="empty-state">
                                    <div class="empty-icon">
                                        <svg width="28" height="28" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                                        </svg>
                                    </div>
                                    <p>Belum ada transaksi</p>
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

<!-- Custom Pagination Styles Override -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Add smooth hover effects to pagination
    document.querySelectorAll('.pagination a, .pagination span').forEach(el => {
        el.style.transition = 'all 0.15s ease';
    });
    
    // Make table rows clickable (fallback for older browsers)
    document.querySelectorAll('.modern-table tbody tr[onclick]').forEach(row => {
        row.addEventListener('click', function(e) {
            // Don't navigate if clicking on a link or button
            if (e.target.closest('a, button, form')) return;
            window.location.href = this.getAttribute('onclick').match(/'([^']+)'/)[1];
        });
    });
});
</script>

@endsection