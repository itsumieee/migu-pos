@extends('layouts.customer')

@section('title', 'Keranjang Belanja')

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
        radial-gradient(at 0% 0%, rgba(255, 51, 102, 0.1) 0px, transparent 50%),
        radial-gradient(at 100% 100%, rgba(0, 217, 163, 0.08) 0px, transparent 50%);
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
    opacity: 0.12; pointer-events: none; z-index: 0;
}
.deco-blob-1 { top: 10%; right: 10%; width: 300px; height: 300px; background: var(--accent-primary); }
.deco-blob-2 { bottom: 20%; left: 5%; width: 200px; height: 200px; background: var(--success); }

/* ── Page Header ───────────────────────────── */
.page-header {
    text-align: center; margin-bottom: 3rem; padding: 2rem 1rem;
}
.page-badge {
    display: inline-flex; align-items: center; gap: 8px;
    padding: 6px 14px; border-radius: 20px;
    background: rgba(255, 51, 102, 0.15);
    border: 1px solid rgba(255, 51, 102, 0.3);
    font-size: 11px; font-weight: 700; letter-spacing: 0.1em;
    text-transform: uppercase; color: var(--accent-primary);
    margin-bottom: 1rem;
}
.page-badge-dot {
    width: 6px; height: 6px; border-radius: 50%;
    background: var(--success); animation: pulse 2s ease-in-out infinite;
}
.page-title {
    font-size: clamp(2rem, 5vw, 3rem); font-weight: 800;
    margin: 0.5rem 0; letter-spacing: -0.02em; line-height: 1.1;
}
.page-title-accent {
    background: var(--accent-gradient);
    -webkit-background-clip: text; -webkit-text-fill-color: transparent;
    background-clip: text;
}
.page-divider {
    width: 80px; height: 3px; margin: 1rem auto;
    background: var(--accent-gradient); border-radius: 2px;
}

/* ── Cart Container ───────────────────────── */
.cart-container {
    display: grid; gap: 2rem;
}
@media (min-width: 1024px) {
    .cart-container { grid-template-columns: 2fr 1fr; }
}

/* ── Cart Item Card ───────────────────────── */
.cart-card {
    background: var(--bg-card); border: 1px solid var(--border-color);
    border-radius: var(--radius-lg); padding: 1.25rem;
    display: flex; gap: 1.25rem; transition: all 0.2s ease;
    margin-bottom: 1rem;
}
.cart-card:hover {
    border-color: rgba(255, 51, 102, 0.3);
    box-shadow: var(--shadow-glow);
    transform: translateX(4px);
}

/* Product Image */
.cart-image {
    width: 96px; height: 96px; border-radius: var(--radius);
    object-fit: cover; border: 1px solid var(--border-color);
    flex-shrink: 0; background: var(--bg-elevated);
}

/* Product Info */
.cart-info { flex: 1; min-width: 0; display: flex; flex-direction: column; }
.cart-name {
    font-size: 0.95rem; font-weight: 600; color: var(--text-primary);
    margin-bottom: 0.25rem; line-height: 1.3;
}
.cart-price {
    font-size: 0.85rem; color: var(--text-muted); margin-bottom: 0.75rem;
}

/* Quantity Controls */
.qty-controls {
    display: flex; align-items: center; gap: 0.5rem; margin-bottom: 0.5rem;
}
.qty-btn {
    width: 32px; height: 32px; border-radius: var(--radius-sm);
    border: 1px solid var(--border-color); background: var(--bg-elevated);
    color: var(--text-primary); font-size: 1.1rem; font-weight: 600;
    display: flex; align-items: center; justify-content: center;
    cursor: pointer; transition: all 0.15s ease;
}
.qty-btn:hover {
    background: var(--bg-hover); color: var(--accent-primary);
    border-color: rgba(255, 51, 102, 0.3);
}
.qty-value {
    width: 36px; text-align: center; font-size: 0.9rem;
    font-weight: 600; color: var(--text-primary);
}
.remove-btn {
    font-size: 0.75rem; font-weight: 500; color: var(--accent-primary);
    background: none; border: none; cursor: pointer;
    padding: 0.25rem 0.5rem; transition: all 0.15s ease;
}
.remove-btn:hover { background: rgba(255, 51, 102, 0.1); }

/* Item Total */
.cart-item-total {
    text-align: right; min-width: 100px; flex-shrink: 0;
}
.item-total-val {
    font-size: 1.1rem; font-weight: 700; color: var(--accent-primary);
}

/* ── Order Summary ─────────────────────────── */
.summary-card {
    background: var(--bg-card); border: 1px solid var(--border-color);
    border-radius: var(--radius-lg); padding: 1.5rem;
    position: sticky; top: 1.5rem; height: fit-content;
}
.summary-title {
    font-size: 1.25rem; font-weight: 700; color: var(--text-primary);
    margin-bottom: 1.25rem; letter-spacing: -0.01em;
}

/* Summary Rows */
.summary-row {
    display: flex; justify-content: space-between;
    font-size: 0.9rem; color: var(--text-secondary);
    margin-bottom: 0.75rem;
}
.summary-row.total {
    font-size: 1.1rem; color: var(--text-primary); font-weight: 600;
    margin-top: 1rem; padding-top: 1rem;
    border-top: 1px solid var(--border-light);
}
.total-value {
    font-size: 1.4rem; font-weight: 800; color: var(--accent-primary);
}
.shipping-free { color: var(--success); font-weight: 600; }

.summary-divider {
    height: 1px; background: var(--border-light); margin: 1rem 0;
}

/* Payment Method */
.payment-label {
    font-size: 0.75rem; font-weight: 700; color: var(--text-muted);
    text-transform: uppercase; letter-spacing: 0.08em;
    margin-bottom: 0.75rem;
}
.payment-option {
    display: flex; align-items: center; gap: 0.75rem;
    padding: 0.75rem 1rem; margin-bottom: 0.5rem;
    border: 1px solid var(--border-color); border-radius: var(--radius);
    cursor: pointer; transition: all 0.15s ease;
    background: var(--bg-elevated);
}
.payment-option:hover {
    border-color: rgba(255, 51, 102, 0.3);
    background: var(--bg-hover);
}
.payment-option input[type="radio"] {
    width: 18px; height: 18px; accent-color: var(--accent-primary);
    cursor: pointer;
}
.payment-option span {
    font-size: 0.9rem; font-weight: 500; color: var(--text-primary);
}
.payment-option input:checked + span {
    color: var(--accent-primary); font-weight: 600;
}

/* Checkout Button */
.checkout-btn {
    width: 100%; padding: 1rem; margin-top: 1.25rem;
    border-radius: var(--radius-lg); border: none;
    background: var(--accent-gradient); color: white;
    font-size: 0.9rem; font-weight: 600; cursor: pointer;
    transition: all 0.2s ease;
    box-shadow: 0 4px 20px var(--accent-glow);
}
.checkout-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 32px var(--accent-glow);
}
.checkout-btn:active { transform: translateY(0); }

/* Security Badge */
.security-note {
    display: flex; align-items: center; justify-content: center;
    gap: 0.5rem; font-size: 0.75rem; color: var(--text-muted);
    margin-top: 1rem; font-weight: 500;
}
.security-note svg { color: var(--success); }

/* ── Empty Cart State ─────────────────────── */
.empty-cart {
    padding: 4rem 2rem; text-align: center;
    background: var(--bg-card); border: 1px solid var(--border-color);
    border-radius: var(--radius-lg);
}
.empty-icon {
    width: 72px; height: 72px; margin: 0 auto 1.5rem;
    border-radius: var(--radius-lg); background: var(--bg-elevated);
    display: flex; align-items: center; justify-content: center;
    color: var(--text-muted); opacity: 0.5;
}
.empty-title {
    font-size: 1.5rem; font-weight: 700; color: var(--text-primary);
    margin-bottom: 0.5rem;
}
.empty-desc {
    color: var(--text-muted); margin-bottom: 1.5rem; font-size: 0.95rem;
}
.empty-btn {
    display: inline-flex; align-items: center; gap: 0.5rem;
    padding: 0.875rem 2rem; border-radius: var(--radius-lg);
    background: var(--accent-gradient); color: white;
    font-size: 0.9rem; font-weight: 600; text-decoration: none;
    transition: all 0.2s ease; box-shadow: 0 4px 16px var(--accent-glow);
}
.empty-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 24px var(--accent-glow);
}

/* ── Responsive ─────────────────────────── */
@media (max-width: 1024px) {
    .cart-card { flex-direction: column; text-align: center; }
    .cart-item-total { text-align: center; margin-top: 1rem; }
    .qty-controls { justify-content: center; }
    .summary-card { position: static; }
}
@media (max-width: 768px) {
    .page-header { padding: 1.5rem 1rem; }
    .page-title { font-size: clamp(1.75rem, 6vw, 2.25rem); }
}

/* ── Focus States ───────────────────────── */
button:focus-visible, a:focus-visible, input:focus-visible {
    outline: 2px solid var(--accent-primary); outline-offset: 2px;
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

<div class="max-w-6xl mx-auto px-4 py-8 lg:py-12">
    
    <!-- Page Header -->
    <div class="page-header animate-slide">
        <div class="page-badge">
            <span class="page-badge-dot"></span>
            Checkout
        </div>
        <h1 class="page-title">
            Keranjang <span class="page-title-accent">Belanja</span>
        </h1>
        <div class="page-divider"></div>
    </div>

    @if(session('cart') && count(session('cart')) > 0)
    <form action="{{ route('checkout.process') }}" method="POST">
        @csrf
        
        <div class="cart-container">
            <!-- Cart Items -->
            <div>
                @foreach(session('cart') as $id => $item)
                <div class="cart-card animate-fade">
                    <img src="{{ $item['image'] ?? 'https://images.unsplash.com/photo-1521572163474-6864f9cf17ab?w=200&h=200&fit=crop' }}" 
                         class="cart-image"
                         alt="{{ $item['name'] }}">
                    
                    <div class="cart-info">
                        <h3 class="cart-name">{{ $item['name'] }}</h3>
                        <p class="cart-price">Rp {{ number_format($item['price'], 0, ',', '.') }}</p>
                        
                        <div class="qty-controls">
                            <button type="button" onclick="updateQty({{ $id }}, -1)" class="qty-btn">−</button>
                            <span id="qty-{{ $id }}" class="qty-value">{{ $item['qty'] }}</span>
                            <button type="button" onclick="updateQty({{ $id }}, 1)" class="qty-btn">+</button>
                            <button type="button" onclick="removeItem({{ $id }})" class="remove-btn">Hapus</button>
                        </div>
                    </div>
                    
                    <div class="cart-item-total">
                        <p class="item-total-val">Rp {{ number_format($item['price'] * $item['qty'], 0, ',', '.') }}</p>
                    </div>
                </div>
                @endforeach
            </div>

            <!-- Order Summary -->
            <div>
                <div class="summary-card">
                    <h3 class="summary-title">Ringkasan Pesanan</h3>
                    
                    <div>
                        <div class="summary-row">
                            <span>Subtotal</span>
                            <span>Rp {{ number_format(collect(session('cart'))->sum(fn($i) => $i['price'] * $i['qty']), 0, ',', '.') }}</span>
                        </div>
                        <div class="summary-row">
                            <span>Pengiriman</span>
                            <span class="shipping-free">Gratis</span>
                        </div>
                        <div class="summary-divider"></div>
                        <div class="summary-row total">
                            <span>Total</span>
                            <span class="total-value">Rp {{ number_format(collect(session('cart'))->sum(fn($i) => $i['price'] * $i['qty']), 0, ',', '.') }}</span>
                        </div>
                    </div>

                    <!-- Payment Method -->
                    <div style="margin-top:1.5rem">
                        <p class="payment-label">Metode Pembayaran</p>
                        <div>
                            <label class="payment-option">
                                <input type="radio" name="payment_method" value="transfer" checked>
                                <span>Transfer Bank</span>
                            </label>
                            <label class="payment-option">
                                <input type="radio" name="payment_method" value="qris">
                                <span>QRIS</span>
                            </label>
                        </div>
                    </div>

                    <button type="submit" class="checkout-btn">
                        Bayar Sekarang →
                    </button>

                    <p class="security-note">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                        </svg>
                        Pembayaran aman & terenkripsi
                    </p>
                </div>
            </div>
        </div>
    </form>

    <script>
    function updateQty(id, change) {
        fetch(`/cart/update/${id}`, {
            method: 'PATCH',
            headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}', 'Accept': 'application/json' },
            body: JSON.stringify({ qty: change })
        }).then(r => r.json()).then(d => { if(d.success) location.reload(); });
    }
    function removeItem(id) {
        if(!confirm('Hapus item ini dari keranjang?')) return;
        fetch(`/cart/remove/${id}`, {
            method: 'DELETE',
            headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}', 'Accept': 'application/json' }
        }).then(r => r.json()).then(d => { if(d.success) location.reload(); });
    }
    </script>
    
    @else
    <!-- Empty Cart State -->
    <div class="empty-cart animate-slide">
        <div class="empty-icon">
            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
            </svg>
        </div>
        <h2 class="empty-title">Keranjang Kosong</h2>
        <p class="empty-desc">Mulai belanja untuk menambahkan produk favorit Anda</p>
        <a href="{{ route('home') }}" class="empty-btn">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
            </svg>
            Belanja Sekarang
        </a>
    </div>
    @endif
</div>
@endsection