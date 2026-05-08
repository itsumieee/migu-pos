@extends('layouts.app')

@section('page-title', 'Konfirmasi Pembayaran')

@section('content')

<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

@verbatim
<style>
/* ── Modern Dark Theme CSS Variables ───────────────────────── */
:root {
    --bg-primary: #0a0a0f;
    --bg-secondary: #12121a;
    --bg-card: #16161f;
    --bg-elevated: #1c1c2e;
    --bg-hover: rgba(34, 211, 238, 0.08);
    
    --cyan: #22d3ee;
    --cyan-gradient: linear-gradient(135deg, #22d3ee 0%, #06b6d4 100%);
    --cyan-glow: rgba(34, 211, 238, 0.3);
    
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
    --shadow-glow: 0 0 32px rgba(34, 211, 238, 0.25);
    
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
    background-image: 
        radial-gradient(at 0% 0%, rgba(34, 211, 238, 0.08) 0px, transparent 50%),
        radial-gradient(at 100% 100%, rgba(16, 185, 129, 0.06) 0px, transparent 50%);
    background-attachment: fixed;
}

/* ── Animations ─────────────────────────────── */
@keyframes fadeIn { from { opacity: 0; } to { opacity: 1; } }
@keyframes slideUp { from { opacity: 0; transform: translateY(20px); } to { opacity: 1; transform: translateY(0); } }
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
    border-color: rgba(34, 211, 238, 0.3);
    box-shadow: var(--shadow-lg), var(--shadow-glow);
    transform: translateY(-4px);
}
.gradient-cyan {
    background: var(--cyan-gradient);
    box-shadow: 0 4px 20px var(--cyan-glow);
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
.deco-blob-1 { top: 5%; right: 10%; width: 300px; height: 300px; background: var(--cyan); }
.deco-blob-2 { bottom: 15%; left: 5%; width: 200px; height: 200px; background: var(--emerald); }

/* ── Page Header ───────────────────────────── */
.page-header {
    position: relative; border-radius: var(--radius-xl); padding: 2rem;
    background: linear-gradient(135deg, var(--bg-secondary) 0%, var(--bg-card) 100%);
    border: 1px solid var(--border-color); margin-bottom: 2rem;
}
.page-header::before {
    content: ''; position: absolute; top: 0; left: 0; right: 0; height: 2px;
    background: var(--cyan-gradient);
}
.page-header-content { position: relative; z-index: 2; }

.page-badge {
    display: inline-flex; align-items: center; gap: 8px;
    padding: 6px 14px; border-radius: 20px;
    background: rgba(34, 211, 238, 0.15);
    border: 1px solid rgba(34, 211, 238, 0.3);
    font-size: 11px; font-weight: 700; letter-spacing: 0.1em;
    text-transform: uppercase; color: var(--cyan);
    margin-bottom: 1rem;
}
.page-badge-dot {
    width: 6px; height: 6px; border-radius: 50%;
    background: var(--emerald); animation: pulse 2s ease-in-out infinite;
}

.page-title {
    font-size: clamp(1.75rem, 4vw, 2.25rem);
    font-weight: 800; line-height: 1.15; margin-bottom: 0.5rem;
    letter-spacing: -0.02em; color: var(--text-primary);
}
.page-subtitle {
    font-size: 0.95rem; color: var(--text-secondary);
    line-height: 1.5;
}

/* ── Checkout Card ─────────────────────────── */
.checkout-card {
    display: block; text-decoration: none; color: inherit;
}
.checkout-card:hover { transform: translateY(-4px); }

.checkout-content {
    background: var(--bg-card); border: 1px solid var(--border-color);
    border-radius: var(--radius-lg); padding: 1.5rem;
    position: relative; overflow: hidden;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
}
.checkout-content::before {
    content: ''; position: absolute; inset: 0; border-radius: inherit;
    background: linear-gradient(140deg, rgba(34, 211, 238, 0.05) 0%, transparent 55%);
    pointer-events: none; opacity: 0; transition: opacity 0.3s;
}
.checkout-card:hover .checkout-content {
    border-color: rgba(34, 211, 238, 0.3);
    box-shadow: var(--shadow-lg), var(--shadow-glow);
}
.checkout-card:hover .checkout-content::before { opacity: 1; }

/* Card Header */
.checkout-header {
    display: flex; justify-content: space-between; align-items: flex-start;
    margin-bottom: 1.25rem; padding-bottom: 1rem;
    border-bottom: 1px solid var(--border-light);
}
.checkout-order { display: flex; flex-direction: column; gap: 0.25rem; }
.checkout-order-label {
    font-size: 0.8rem; color: var(--text-muted);
}
.checkout-order-number {
    font-size: 1.1rem; font-weight: 700; color: var(--text-primary);
    font-family: monospace;
}
.checkout-status {
    display: inline-flex; align-items: center; gap: 6px;
    padding: 4px 12px; border-radius: 20px;
    background: rgba(245, 158, 11, 0.15);
    border: 1px solid rgba(245, 158, 11, 0.3);
    font-size: 10px; font-weight: 700; color: var(--amber);
    text-transform: uppercase; letter-spacing: 0.05em;
}

/* Customer Info */
.checkout-customer {
    background: var(--bg-elevated); border-radius: var(--radius);
    padding: 0.875rem; margin-bottom: 1rem;
}
.checkout-customer-label {
    font-size: 0.8rem; color: var(--text-muted);
    margin-bottom: 0.25rem;
}
.checkout-customer-name {
    font-size: 0.95rem; font-weight: 600; color: var(--text-primary);
    margin-bottom: 0.125rem;
}
.checkout-customer-email {
    font-size: 0.8rem; color: var(--text-muted);
}

/* Amount & Payment Grid */
.checkout-details {
    display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;
    margin-bottom: 1rem;
}
.checkout-detail { display: flex; flex-direction: column; gap: 0.25rem; }
.checkout-detail-label {
    font-size: 0.8rem; color: var(--text-muted);
}
.checkout-detail-value {
    font-size: 1.3rem; font-weight: 800; color: var(--cyan);
    line-height: 1.2;
}
.checkout-payment {
    font-size: 0.95rem; font-weight: 600; color: var(--text-primary);
    display: flex; align-items: center; gap: 0.375rem;
}

/* Items Badge */
.checkout-items {
    background: rgba(16, 185, 129, 0.15);
    border: 1px solid rgba(16, 185, 129, 0.3);
    border-radius: var(--radius);
    padding: 0.75rem 1rem; text-align: center;
}
.checkout-items-count {
    font-size: 0.9rem; font-weight: 600; color: var(--emerald);
}

/* Timestamp */
.checkout-time {
    font-size: 0.75rem; color: var(--text-muted);
    text-align: right; margin-top: 1rem;
}

/* ── Empty State ───────────────────────────── */
.empty-state {
    background: var(--bg-card); border: 1px solid var(--border-color);
    border-radius: var(--radius-lg); padding: 3rem 2rem;
    text-align: center;
}
.empty-icon {
    font-size: 3rem; margin-bottom: 1rem; display: block;
}
.empty-title {
    font-size: 1.3rem; font-weight: 800; color: var(--text-primary);
    margin-bottom: 0.5rem;
}
.empty-desc {
    color: var(--text-secondary); margin-bottom: 2rem; font-size: 0.95rem;
}
.empty-btn {
    display: inline-flex; align-items: center; gap: 0.5rem;
    padding: 0.875rem 1.75rem; border-radius: var(--radius-lg);
    background: var(--cyan-gradient); color: #0a0a0f;
    font-size: 0.85rem; font-weight: 700; text-decoration: none;
    transition: all 0.2s ease;
    box-shadow: 0 4px 20px var(--cyan-glow);
    text-transform: uppercase; letter-spacing: 0.05em;
}
.empty-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 32px var(--cyan-glow);
}

/* ── Pagination ───────────────────────────── */
.pagination-wrapper {
    margin-top: 2rem; display: flex; justify-content: center;
}
.pagination {
    display: flex; gap: 0.375rem; list-style: none; padding: 0;
}
.pagination li span, .pagination li a {
    display: flex; align-items: center; justify-content: center;
    min-width: 36px; height: 36px; padding: 0 0.5rem;
    border-radius: var(--radius-sm);
    background: var(--bg-elevated); border: 1px solid var(--border-color);
    color: var(--text-secondary); font-size: 0.85rem; font-weight: 500;
    text-decoration: none; transition: all 0.15s ease;
}
.pagination li.active span {
    background: var(--cyan); color: #0a0a0f;
    border-color: var(--cyan); font-weight: 600;
}
.pagination li a:hover {
    background: var(--bg-hover); color: var(--cyan);
    border-color: rgba(34, 211, 238, 0.3);
}
.pagination .disabled span {
    opacity: 0.5; cursor: not-allowed;
}

/* ── Responsive ─────────────────────────── */
.checkout-grid {
    display: grid; grid-template-columns: repeat(auto-fill, minmax(380px, 1fr));
    gap: 1.25rem;
}
@media (max-width: 640px) {
    .checkout-grid { grid-template-columns: 1fr; }
    .checkout-details { grid-template-columns: 1fr; }
    .page-header { padding: 1.5rem 1rem; }
}

/* ── Scrollbar ───────────────────────────── */
::-webkit-scrollbar { width: 5px; }
::-webkit-scrollbar-track { background: transparent; }
::-webkit-scrollbar-thumb {
    background: var(--bg-elevated); border-radius: 3px;
}
::-webkit-scrollbar-thumb:hover { background: var(--cyan); }

/* ── Focus States ───────────────────────── */
a:focus-visible, button:focus-visible {
    outline: 2px solid var(--cyan); outline-offset: 2px;
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

<div style="padding: 2rem;">
    <div style="max-width: 1200px; margin: 0 auto;">

        <!-- Page Header -->
        <div class="page-header animate-slide">
            <div class="page-header-content">
                <div class="page-badge">
                    <span class="page-badge-dot"></span>
                    Konfirmasi Pembayaran
                </div>
                <h1 class="page-title">Pesanan Menunggu</h1>
                <p class="page-subtitle">Total {{ $pendingCheckouts->total() }} pesanan menunggu konfirmasi Anda</p>
            </div>
        </div>

        <!-- Pending Checkouts Grid -->
        @if($pendingCheckouts->count() > 0)
            <div class="checkout-grid">
                @foreach($pendingCheckouts as $checkout)
                    <a href="{{ route('pos.confirmations.show', $checkout->id) }}" class="checkout-card animate-fade">
                        <div class="checkout-content">
                            <!-- Card Header -->
                            <div class="checkout-header">
                                <div class="checkout-order">
                                    <span class="checkout-order-label">Nomor Pesanan</span>
                                    <span class="checkout-order-number">{{ $checkout->order->order_number }}</span>
                                </div>
                                <div class="checkout-status">
                                    <span>⏳</span> Pending
                                </div>
                            </div>

                            <!-- Customer Info -->
                            <div class="checkout-customer">
                                <p class="checkout-customer-label">Pelanggan</p>
                                <p class="checkout-customer-name">{{ $checkout->customer->name }}</p>
                                <p class="checkout-customer-email">{{ $checkout->customer->email }}</p>
                            </div>

                            <!-- Amount & Payment Method -->
                            <div class="checkout-details">
                                <div class="checkout-detail">
                                    <span class="checkout-detail-label">Total Amount</span>
                                    <span class="checkout-detail-value">Rp {{ number_format($checkout->total_amount, 0, ',', '.') }}</span>
                                </div>
                                <div class="checkout-detail">
                                    <span class="checkout-detail-label">Metode Bayar</span>
                                    <span class="checkout-payment">
                                        @switch($checkout->payment_method)
                                            @case('cash') 💵 @break
                                            @case('debit') 🏦 @break
                                            @case('qris') 📲 @break
                                            @case('ewallet') 💳 @break
                                            @default 💰
                                        @endswitch
                                        @switch($checkout->payment_method)
                                            @case('cash') Tunai @break
                                            @case('debit') Kartu Debit @break
                                            @case('qris') QRIS @break
                                            @case('ewallet') E-Wallet @break
                                            @default {{ $checkout->payment_method }}
                                        @endswitch
                                    </span>
                                </div>
                            </div>

                            <!-- Items Count -->
                            <div class="checkout-items">
                                <span class="checkout-items-count">
                                    {{ $checkout->order->items->sum('quantity') }} item pesanan
                                </span>
                            </div>

                            <!-- Timestamp -->
                            <p class="checkout-time">
                                {{ $checkout->created_at->diffForHumans() }}
                            </p>
                        </div>
                    </a>
                @endforeach
            </div>

            <!-- Pagination -->
            @if($pendingCheckouts->hasPages())
                <div class="pagination-wrapper">
                    {{ $pendingCheckouts->links('pagination::tailwind') }}
                </div>
            @endif

        @else
            <!-- Empty State -->
            <div class="empty-state animate-slide">
                <span class="empty-icon">✅</span>
                <h3 class="empty-title">Tidak Ada Pesanan Menunggu</h3>
                <p class="empty-desc">Semua pesanan telah dikonfirmasi</p>
                <a href="{{ route('pos.index') }}" class="empty-btn">
                    ← Kembali ke POS
                </a>
            </div>
        @endif

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