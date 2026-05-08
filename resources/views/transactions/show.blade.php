@extends('layouts.app')

@section('page-title', 'Detail Transaksi #' . str_pad(($transaction->id ?? 0), 5, '0', STR_PAD_LEFT))

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
    display: flex; flex-wrap: wrap; justify-content: space-between; align-items: center;
    gap: 1rem; margin-bottom: 2rem; padding: 1rem 0;
}
.page-title-group { display: flex; align-items: center; gap: 1rem; }
.back-btn {
    width: 44px; height: 44px; border-radius: var(--radius-lg);
    background: var(--bg-card); border: 1px solid var(--border-color);
    display: flex; align-items: center; justify-content: center;
    color: var(--text-secondary); text-decoration: none;
    transition: all 0.2s ease;
}
.back-btn:hover {
    background: var(--bg-hover); color: var(--accent-primary);
    border-color: rgba(255, 51, 102, 0.3);
}
.page-title {
    font-size: clamp(1.5rem, 4vw, 2rem);
    font-weight: 800; line-height: 1.2; color: var(--text-primary);
    letter-spacing: -0.02em;
}

/* Print Button */
.print-btn {
    display: inline-flex; align-items: center; gap: 0.5rem;
    padding: 0.75rem 1.25rem; border-radius: var(--radius-lg);
    background: var(--bg-elevated); border: 1px solid var(--border-color);
    color: var(--text-primary); font-size: 0.85rem; font-weight: 600;
    text-decoration: none; transition: all 0.2s ease;
}
.print-btn:hover {
    background: var(--bg-hover); border-color: var(--accent-primary);
    color: var(--accent-primary);
}
.print-btn svg { width: 18px; height: 18px; }

/* ── Transaction Card ───────────────────────── */
.txn-card {
    background: var(--bg-card); border: 1px solid var(--border-color);
    border-radius: var(--radius-xl); overflow: hidden;
    margin-bottom: 1.5rem;
}

/* Card Header - Transaction Info */
.txn-info-grid {
    display: grid; grid-template-columns: 1fr; gap: 1.25rem;
    padding: 1.5rem; border-bottom: 1px solid var(--border-light);
}
@media (min-width: 768px) {
    .txn-info-grid { grid-template-columns: repeat(3, 1fr); }
}
.txn-info-item { display: flex; flex-direction: column; gap: 0.375rem; }
.txn-info-label {
    font-size: 0.75rem; font-weight: 700; color: var(--text-muted);
    text-transform: uppercase; letter-spacing: 0.05em;
}
.txn-info-value {
    font-size: 1.1rem; font-weight: 700; color: var(--text-primary);
}
.txn-info-sub {
    font-size: 0.85rem; color: var(--text-secondary);
}

/* Item Table */
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
.modern-table th.text-center { text-align: center; }
.modern-table th.text-right { text-align: right; }

.modern-table tbody tr {
    border-bottom: 1px solid var(--border-light);
    transition: background 0.15s ease;
}
.modern-table tbody tr:last-child { border-bottom: none; }
.modern-table tbody tr:hover {
    background: var(--bg-hover);
}

.modern-table td {
    padding: 1rem 1.25rem;
    font-size: 0.9rem; color: var(--text-primary);
    vertical-align: middle;
}
.modern-table td.text-center { text-align: center; }
.modern-table td.text-right { text-align: right; }

/* Product Name */
.product-name {
    font-weight: 600; color: var(--text-primary);
    margin-bottom: 0.25rem;
}
.product-sku {
    font-size: 0.75rem; color: var(--text-muted);
    font-family: var(--font-mono);
}

/* Price & Amount */
.price-cell, .amount-cell {
    font-weight: 600; color: var(--text-primary);
}
.qty-cell {
    font-weight: 700; color: var(--text-primary);
}

/* Footer Totals */
.totals-section {
    background: var(--bg-elevated);
    padding: 1.5rem; border-top: 1px solid var(--border-light);
}
.totals-grid {
    display: flex; flex-direction: column; align-items: flex-end;
    gap: 0.75rem; max-width: 320px; margin-left: auto;
}
.total-row {
    display: flex; justify-content: space-between; width: 100%;
    font-size: 0.9rem;
}
.total-row.label { color: var(--text-secondary); }
.total-row.value { 
    font-weight: 700; color: var(--text-primary);
    font-size: 1.25rem;
}
.total-row.small { font-size: 0.85rem; }
.total-row.change {
    color: var(--emerald); font-weight: 700;
}

/* ── Responsive ─────────────────────────── */
@media (max-width: 768px) {
    .page-header { flex-direction: column; align-items: flex-start; }
    .print-btn { width: 100%; justify-content: center; }
    .txn-info-grid { grid-template-columns: 1fr; }
    .totals-grid { max-width: 100%; }
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
    <div style="max-width: 1000px; margin: 0 auto;">
        
        <!-- Page Header -->
        <div class="page-header animate-slide">
            <div class="page-title-group">
                <a href="{{ route('transactions.index') }}" class="back-btn" title="Kembali">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>
                </a>
                <h1 class="page-title">Detail Transaksi</h1>
            </div>
            <a href="{{ route('transactions.print', $transaction ?? null) }}" target="_blank" class="print-btn">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/>
                </svg>
                Cetak Struk
            </a>
        </div>

        <!-- Transaction Card -->
        <div class="txn-card animate-fade">
            
            <!-- Transaction Info Header -->
            <div class="txn-info-grid">
                <div class="txn-info-item">
                    <span class="txn-info-label">ID Transaksi</span>
                    <span class="txn-info-value" style="font-family: var(--font-mono);">
                        #{{ str_pad(($transaction->id ?? 0), 5, '0', STR_PAD_LEFT) }}
                    </span>
                </div>
                <div class="txn-info-item">
                    <span class="txn-info-label">Waktu</span>
                    <span class="txn-info-value">
                        {{ ($transaction->created_at ?? now())->isoFormat('dddd, D MMMM Y') }}
                    </span>
                    <span class="txn-info-sub">
                        {{ ($transaction->created_at ?? now())->format('H:i') }} WIB
                    </span>
                </div>
                <div class="txn-info-item">
                    <span class="txn-info-label">Kasir</span>
                    <span class="txn-info-value">{{ $transaction->user->name ?? 'Admin' }}</span>
                </div>
            </div>
            
            <!-- Items Table -->
            <div class="table-wrapper">
                <table class="modern-table">
                    <thead>
                        <tr>
                            <th>Produk</th>
                            <th class="text-center">Harga</th>
                            <th class="text-center">Qty</th>
                            <th class="text-right">Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse(($transaction->transactionItems ?? []) as $item)
                        <tr>
                            <td>
                                <div class="product-name">{{ $item->product->name ?? 'Produk' }}</div>
                                <div class="product-sku">SKU: {{ $item->product->sku ?? '-' }}</div>
                            </td>
                            <td class="text-center price-cell">
                                Rp {{ number_format(($item->price ?? 0), 0, ',', '.') }}
                            </td>
                            <td class="text-center qty-cell">
                                {{ $item->qty ?? 1 }}
                            </td>
                            <td class="text-right amount-cell">
                                Rp {{ number_format(($item->subtotal ?? 0), 0, ',', '.') }}
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" style="text-align: center; padding: 2rem; color: var(--text-muted);">
                                Tidak ada item dalam transaksi ini
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Footer Totals -->
            <div class="totals-section">
                <div class="totals-grid">
                    <div class="total-row">
                        <span class="label">Total Transaksi</span>
                        <span class="value">Rp {{ number_format(($transaction->total_amount ?? 0), 0, ',', '.') }}</span>
                    </div>
                    <div class="total-row small">
                        <span class="label">Metode: {{ strtoupper($transaction->payment_method ?? 'CASH') }}</span>
                        <span class="label">Bayar: Rp {{ number_format(($transaction->payment_amount ?? 0), 0, ',', '.') }}</span>
                    </div>
                    <div class="total-row change">
                        <span>Kembalian</span>
                        <span>Rp {{ number_format(($transaction->change_amount ?? 0), 0, ',', '.') }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection