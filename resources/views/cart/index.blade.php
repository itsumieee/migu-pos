@extends('layouts.customer')

@section('title', 'Keranjang Belanja')

@push('styles')
<style>
/* ── CSS Variables: Neo-Brutalism Theme ───────────────────────────── */
:root {
    --c-bg:        #FFF9F0;
    --c-surface:   #FFFFFF;
    --c-border:    #000000;
    --c-text:      #1A1A1A;
    --c-text-dim:  #555555;
    --c-accent-1:  #FF6B6B;
    --c-accent-2:  #4ECDC4;
    --c-accent-3:  #FFE66D;
    --c-accent-4:  #95E1D3;
    --c-accent-5:  #F38181;
    --shadow-hard: 4px 4px 0px #000000;
    --shadow-hard-lg: 6px 6px 0px #000000;
    --shadow-hard-sm: 2px 2px 0px #000000;
    --shadow-hover: 2px 2px 0px #000000;
    --border-thick: 3px solid #000000;
    --border-medium: 2px solid #000000;
    --border-thin: 1px solid #000000;
    --font-body: 'Space Grotesk', system-ui, sans-serif;
    --font-display: 'Syne', sans-serif;
    --ease-bounce: cubic-bezier(0.34, 1.56, 0.64, 1);
    --ease-smooth: cubic-bezier(0.4, 0, 0.2, 1);
}

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

/* ── Base Reset ─────────────────────────────────────────── */
*, *::before, *::after { box-sizing: border-box; }

body { 
    font-family: var(--font-body);
    background: var(--c-bg);
    color: var(--c-text);
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
    min-height: 100vh;
    margin: 0;
    padding: 0;
}

/* Decorative background */
body::before {
    content: '';
    position: fixed;
    inset: 0;
    background: 
        radial-gradient(600px circle at 15% 10%, rgba(255, 107, 107, 0.08), transparent 65%),
        radial-gradient(400px circle at 85% 20%, rgba(255, 230, 109, 0.06), transparent 65%);
    pointer-events: none;
    z-index: 0;
}

.nb-deco {
    position: fixed;
    pointer-events: none;
    z-index: 0;
    opacity: 0.04;
}
.nb-deco-1 { top: 8%; right: 12%; width: 100px; height: 100px; border: var(--border-thick); transform: rotate(30deg); }
.nb-deco-2 { bottom: 12%; left: 10%; width: 70px; height: 70px; border: var(--border-thick); transform: rotate(-20deg); }

/* ── Keyframes ─────────────────────────────────────────────── */
@keyframes nbFadeUp {
    from { opacity: 0; transform: translateY(24px); }
    to   { opacity: 1; transform: translateY(0); }
}
@keyframes nbWobble {
    0%, 100% { transform: rotate(-1deg); }
    50% { transform: rotate(2deg); }
}

.animate-fade-in { animation: nbFadeUp 0.5s var(--ease-bounce) both; }
.animate-wobble { animation: nbWobble 3s ease-in-out infinite; }

/* ── Page Layout ───────────────────────────────────────── */
.cart-page {
    padding: 2rem 1.5rem;
    min-height: 100vh;
    position: relative;
    z-index: 1;
}

.cart-header {
    max-width: 1200px;
    margin: 0 auto 2rem;
    text-align: center;
}

.cart-title {
    font-family: var(--font-display);
    font-size: clamp(1.8rem, 5vw, 2.5rem);
    font-weight: 900;
    color: var(--c-text);
    margin-bottom: 0.5rem;
    text-transform: uppercase;
    letter-spacing: -0.02em;
}

.cart-subtitle {
    font-size: 0.9rem;
    color: var(--c-text-dim);
    font-weight: 600;
}

.cart-wrapper {
    max-width: 1200px;
    margin: 0 auto;
}

/* ── Cart Container Grid ───────────────────────────────── */
.cart-container {
    display: grid;
    grid-template-columns: 1fr 360px;
    gap: 2rem;
    align-items: start;
}

/* ── Cart Item Card ────────────────────────────────────── */
.nb-cart-item {
    background: var(--c-surface);
    border: var(--border-thick);
    border-radius: 0;
    padding: 1.25rem;
    display: grid;
    grid-template-columns: 100px 1fr auto;
    gap: 1.25rem;
    align-items: center;
    transition: all 0.15s var(--ease-bounce);
    box-shadow: var(--shadow-hard);
    position: relative;
}

.nb-cart-item::before {
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

.nb-cart-item:hover {
    transform: translate(2px, 2px);
    box-shadow: var(--shadow-hover);
    border-color: var(--c-accent-1);
}

/* Item Image */
.nb-cart-img {
    width: 100px;
    height: 100px;
    border-radius: 0;
    overflow: hidden;
    border: var(--border-thick);
    flex-shrink: 0;
    background: var(--c-surface);
    box-shadow: var(--shadow-hard-sm);
}
.nb-cart-img img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

/* Item Details */
.nb-cart-details {
    display: flex;
    flex-direction: column;
    gap: 0.5rem;
}
.nb-cart-name {
    font-size: 0.95rem;
    font-weight: 700;
    color: var(--c-text);
    line-height: 1.3;
}
.nb-cart-price {
    font-size: 0.85rem;
    color: var(--c-text-dim);
    font-weight: 500;
}

/* Quantity Controls */
.nb-qty-ctrl {
    display: inline-flex;
    align-items: center;
    gap: 0.25rem;
    border: var(--border-thick);
    border-radius: 0;
    background: var(--c-surface);
    padding: 2px;
}
.nb-qty-btn {
    width: 32px;
    height: 32px;
    border: none;
    background: var(--c-surface);
    color: var(--c-text);
    font-size: 1.2rem;
    font-weight: 700;
    cursor: pointer;
    transition: all 0.15s var(--ease-bounce);
    border-radius: 0;
}
.nb-qty-btn:hover {
    background: var(--c-accent-3);
    transform: translate(1px, 1px);
}
.nb-qty-val {
    font-size: 0.9rem;
    font-weight: 700;
    color: var(--c-text);
    min-width: 28px;
    text-align: center;
}

/* Remove Button */
.nb-remove-btn {
    font-size: 0.75rem;
    font-weight: 700;
    color: var(--c-accent-1);
    background: none;
    border: none;
    cursor: pointer;
    padding: 0.25rem 0.5rem;
    text-transform: uppercase;
    letter-spacing: 0.05em;
    transition: all 0.15s var(--ease-bounce);
}
.nb-remove-btn:hover {
    background: var(--c-accent-1);
    color: #fff;
    transform: translate(1px, 1px);
}

/* Item Total */
.nb-cart-total {
    text-align: right;
    flex-shrink: 0;
}
.nb-cart-total-val {
    font-family: var(--font-display);
    font-size: 1.1rem;
    font-weight: 900;
    color: var(--c-accent-1);
}

/* ── Empty Cart State ──────────────────────────────────── */
.nb-empty {
    grid-column: 1 / -1;
    text-align: center;
    padding: 4rem 2rem;
    background: var(--c-surface);
    border: var(--border-thick);
    border-radius: 0;
    box-shadow: var(--shadow-hard);
}
.nb-empty-icon {
    width: 4rem;
    height: 4rem;
    margin: 0 auto 1.5rem;
    border: var(--border-thick);
    border-radius: 0;
    display: flex;
    align-items: center;
    justify-content: center;
    color: var(--c-text-dim);
    opacity: 0.4;
}
.nb-empty-title {
    font-family: var(--font-display);
    font-size: 1.5rem;
    font-weight: 800;
    color: var(--c-text);
    margin-bottom: 0.5rem;
    text-transform: uppercase;
}
.nb-empty-desc {
    color: var(--c-text-dim);
    margin-bottom: 1.5rem;
    font-weight: 500;
}
.nb-empty-btn {
    display: inline-block;
    padding: 0.75rem 2rem;
    border-radius: 0;
    border: var(--border-thick);
    background: var(--c-accent-1);
    color: #fff;
    font-size: 0.85rem;
    font-weight: 800;
    text-transform: uppercase;
    letter-spacing: 0.1em;
    text-decoration: none;
    transition: all 0.15s var(--ease-bounce);
    box-shadow: var(--shadow-hard-sm);
}
.nb-empty-btn:hover {
    background: var(--c-accent-3);
    color: #000;
    transform: translate(2px, 2px);
    box-shadow: var(--shadow-hover);
}

/* ── Summary Box ───────────────────────────────────────── */
.nb-summary {
    background: var(--c-surface);
    border: var(--border-thick);
    border-radius: 0;
    padding: 1.5rem;
    display: flex;
    flex-direction: column;
    gap: 1.25rem;
    position: sticky;
    top: 2rem;
    box-shadow: var(--shadow-hard);
}
.nb-summary::before {
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
.nb-summary-title {
    font-family: var(--font-display);
    font-size: 1.2rem;
    font-weight: 800;
    color: var(--c-text);
    padding-bottom: 1rem;
    border-bottom: var(--border-thin);
    text-transform: uppercase;
    letter-spacing: -0.02em;
}

/* Summary Rows */
.nb-summary-row {
    display: flex;
    justify-content: space-between;
    align-items: center;
    font-size: 0.9rem;
    color: var(--c-text-dim);
    font-weight: 500;
}
.nb-summary-row.total {
    margin-top: 1rem;
    padding-top: 1rem;
    border-top: var(--border-thin);
    font-size: 1.1rem;
    color: var(--c-text);
    font-weight: 700;
}
.nb-summary-total {
    font-family: var(--font-display);
    font-size: 1.4rem;
    font-weight: 900;
    color: var(--c-accent-1);
}
.nb-summary-free {
    color: var(--c-accent-2);
    font-weight: 700;
}

/* Checkout Button */
.nb-checkout-btn {
    width: 100%;
    padding: 1rem;
    border-radius: 0;
    border: var(--border-thick);
    background: var(--c-accent-1);
    color: #fff;
    font-family: var(--font-body);
    font-size: 0.85rem;
    font-weight: 800;
    text-transform: uppercase;
    letter-spacing: 0.1em;
    cursor: pointer;
    transition: all 0.15s var(--ease-bounce);
    box-shadow: var(--shadow-hard-sm);
}
.nb-checkout-btn:hover {
    background: var(--c-accent-3);
    color: #000;
    transform: translate(2px, 2px);
    box-shadow: var(--shadow-hover);
}
.nb-checkout-btn:active {
    transform: translate(4px, 4px);
    box-shadow: none;
}
.nb-checkout-btn:disabled {
    opacity: 0.5;
    cursor: not-allowed;
    transform: none;
}

/* Continue Shopping Link */
.nb-continue-link {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 0.5rem;
    padding: 0.75rem;
    border-radius: 0;
    border: var(--border-thin);
    background: transparent;
    color: var(--c-text);
    font-size: 0.85rem;
    font-weight: 700;
    text-decoration: none;
    transition: all 0.15s var(--ease-bounce);
}
.nb-continue-link:hover {
    background: var(--c-accent-3);
    border-color: var(--c-border);
    transform: translate(1px, 1px);
}

/* ── Payment Modal ─────────────────────────────────────── */
.nb-modal {
    display: none;
    position: fixed;
    inset: 0;
    background: rgba(0, 0, 0, 0.8);
    z-index: 1000;
    align-items: center;
    justify-content: center;
    padding: 1rem;
    backdrop-filter: blur(4px);
}
.nb-modal.active {
    display: flex;
}
.nb-modal-content {
    background: var(--c-surface);
    border: var(--border-thick);
    border-radius: 0;
    padding: 2rem;
    max-width: 500px;
    width: 100%;
    box-shadow: var(--shadow-hard-lg);
    position: relative;
}
.nb-modal-content::before {
    content: '';
    position: absolute;
    top: -3px;
    left: -3px;
    width: 24px;
    height: 24px;
    background: var(--c-accent-3);
    border: var(--border-thick);
    z-index: 2;
}
.nb-modal-title {
    font-family: var(--font-display);
    font-size: 1.4rem;
    font-weight: 800;
    color: var(--c-text);
    margin-bottom: 1.5rem;
    text-align: center;
    text-transform: uppercase;
    letter-spacing: -0.02em;
}

/* Payment Options */
.nb-payment-options {
    display: grid;
    gap: 0.75rem;
}
.nb-payment-option {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    padding: 1rem;
    border: var(--border-thick);
    border-radius: 0;
    background: var(--c-surface);
    cursor: pointer;
    transition: all 0.15s var(--ease-bounce);
    font-weight: 600;
    color: var(--c-text);
}
.nb-payment-option:hover {
    background: var(--c-accent-3);
    transform: translate(2px, 2px);
    box-shadow: var(--shadow-hover);
}
.nb-payment-option .icon {
    font-size: 1.5rem;
}

/* Modal Cancel Button */
.nb-modal-cancel {
    width: 100%;
    padding: 0.75rem;
    margin-top: 1.25rem;
    border-radius: 0;
    border: var(--border-thick);
    background: transparent;
    color: var(--c-text);
    font-size: 0.85rem;
    font-weight: 700;
    cursor: pointer;
    transition: all 0.15s var(--ease-bounce);
}
.nb-modal-cancel:hover {
    background: var(--c-accent-1);
    color: #fff;
    transform: translate(2px, 2px);
}

/* ── Typography ───────────────────────────────────────── */
h1, h2, h3, h4 {
    font-family: var(--font-display);
    font-weight: 800;
    line-height: 1.1;
    letter-spacing: -0.02em;
    text-transform: uppercase;
}
p, span, label { font-weight: 500; }
strong, b { font-weight: 800; }

/* ── Responsive ───────────────────────────────────────── */
@media (max-width: 1024px) {
    .cart-container {
        grid-template-columns: 1fr;
    }
    .nb-summary {
        position: static;
    }
}

@media (max-width: 768px) {
    .cart-page { padding: 1.5rem 1rem; }
    .nb-cart-item {
        grid-template-columns: 80px 1fr;
        gap: 1rem;
        padding: 1rem;
    }
    .nb-cart-total {
        grid-column: 2;
        grid-row: 2;
        margin-top: 0.5rem;
        text-align: left;
    }
    .nb-cart-img {
        width: 80px;
        height: 80px;
    }
}

@media (max-width: 480px) {
    .cart-page { padding: 1rem 0.75rem; }
    .nb-cart-item {
        grid-template-columns: 70px 1fr;
        gap: 0.75rem;
        padding: 0.875rem;
    }
    .nb-cart-img {
        width: 70px;
        height: 70px;
    }
    .nb-cart-name { font-size: 0.9rem; }
    .nb-cart-total-val { font-size: 1rem; }
}

/* ── Focus States ─────────────────────────────────────── */
button:focus-visible,
a:focus-visible,
input:focus-visible {
    outline: 3px solid var(--c-accent-1);
    outline-offset: 2px;
}

/* ── Reduced Motion ───────────────────────────────────── */
@media (prefers-reduced-motion: reduce) {
    *, *::before, *::after {
        animation-duration: 0.01ms !important;
        animation-iteration-count: 1 !important;
        transition-duration: 0.01ms !important;
    }
}
</style>
@endpush

@section('content')
<!-- Decorative Background Elements -->
<div class="nb-deco nb-deco-1"></div>
<div class="nb-deco nb-deco-2"></div>

<div class="cart-page">
    <div class="cart-header animate-fade-in">
        <h1 class="cart-title">Keranjang Belanja</h1>
        <p class="cart-subtitle">{{ session('cart') ? count(session('cart')) : 0 }} produk</p>
    </div>

    <div class="cart-wrapper">
        @if(session('cart') && count(session('cart')) > 0)
        <form action="{{ route('checkout.process') }}" method="POST" id="checkoutForm">
            @csrf
            <div class="cart-container">
                
                <!-- LEFT: Items List -->
                <div class="cart-items">
                    @foreach(session('cart') as $id => $item)
                    <div class="nb-cart-item animate-fade-in">
                        <!-- Image -->
                        <div class="nb-cart-img">
                            <img src="{{ $item['image'] ?? 'https://via.placeholder.com/100x100?text=Product' }}" alt="{{ $item['name'] }}" loading="lazy">
                        </div>
                        
                        <!-- Details & Quantity -->
                        <div class="nb-cart-details">
                            <div class="nb-cart-name">{{ $item['name'] }}</div>
                            <div class="nb-cart-price">Rp {{ number_format($item['price'], 0, ',', '.') }}</div>
                            <div class="nb-qty-ctrl">
                                <button type="button" class="nb-qty-btn" onclick="updateQty({{ $id }}, -1)" title="Kurangi">−</button>
                                <span class="nb-qty-val">{{ $item['qty'] }}</span>
                                <button type="button" class="nb-qty-btn" onclick="updateQty({{ $id }}, 1)" title="Tambah">+</button>
                            </div>
                        </div>
                        
                        <!-- Total & Remove -->
                        <div class="nb-cart-total">
                            <div class="nb-cart-total-val">Rp {{ number_format($item['price'] * $item['qty'], 0, ',', '.') }}</div>
                            <button type="button" class="nb-remove-btn" onclick="removeItem({{ $id }})" title="Hapus">Hapus</button>
                        </div>
                    </div>
                    @endforeach
                </div>
                
                <!-- RIGHT: Summary Box -->
                <div class="nb-summary animate-fade-in" style="animation-delay: 0.1s">
                    <div class="nb-summary-title">Ringkasan Pesanan</div>
                    
                    @php
                        $subtotal = collect(session('cart'))->sum(fn($i) => $i['price'] * $i['qty']);
                    @endphp
                    
                    <div class="nb-summary-row">
                        <span class="summary-label">Subtotal</span>
                        <span class="summary-value">Rp {{ number_format($subtotal, 0, ',', '.') }}</span>
                    </div>
                    <div class="nb-summary-row">
                        <span class="summary-label">Ongkos Kirim</span>
                        <span class="nb-summary-free">Gratis</span>
                    </div>
                    <div class="nb-summary-row total">
                        <span class="summary-label">Total</span>
                        <span class="nb-summary-total">Rp {{ number_format($subtotal, 0, ',', '.') }}</span>
                    </div>
                    
                    <button type="button" class="nb-checkout-btn" onclick="showPaymentModal()">Lanjut ke Checkout</button>
                    <a href="{{ route('home') }}" class="nb-continue-link">← Lanjut Belanja</a>
                </div>
            </div>
        </form>

        <!-- Payment Method Modal -->
        <div id="paymentModal" class="nb-modal">
            <div class="nb-modal-content animate-fade-in">
                <h2 class="nb-modal-title">Pilih Metode Pembayaran</h2>
                
                <div class="nb-payment-options">
                    <button type="button" onclick="selectPayment('cash')" class="nb-payment-option">
                        <span class="icon">💵</span>
                        <span>Tunai (Bayar Langsung)</span>
                    </button>
                    
                    <button type="button" onclick="selectPayment('debit')" class="nb-payment-option">
                        <span class="icon">🏦</span>
                        <span>Kartu Debit</span>
                    </button>
                    
                    <button type="button" onclick="selectPayment('qris')" class="nb-payment-option">
                        <span class="icon">📲</span>
                        <span>QRIS</span>
                    </button>
                    
                    <button type="button" onclick="selectPayment('ewallet')" class="nb-payment-option">
                        <span class="icon">💳</span>
                        <span>E-Wallet</span>
                    </button>
                </div>

                <button type="button" onclick="closePaymentModal()" class="nb-modal-cancel">
                    Batal
                </button>
            </div>
        </div>

        <script>
        function showPaymentModal() {
            const modal = document.getElementById('paymentModal');
            modal.classList.add('active');
            document.body.style.overflow = 'hidden';
        }

        function closePaymentModal() {
            const modal = document.getElementById('paymentModal');
            modal.classList.remove('active');
            document.body.style.overflow = '';
        }

        function selectPayment(method) {
            const form = document.getElementById('checkoutForm');
            if (!form) {
                alert('Form tidak ditemukan!');
                return;
            }
            
            const input = document.createElement('input');
            input.type = 'hidden';
            input.name = 'payment_method';
            input.value = method;
            form.appendChild(input);
            
            closePaymentModal();
            setTimeout(() => form.submit(), 100);
        }

        // Close modal when clicking outside
        const modal = document.getElementById('paymentModal');
        if (modal) {
            modal.addEventListener('click', function(e) {
                if (e.target === this) closePaymentModal();
            });
        }

        // Close modal on Escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') closePaymentModal();
        });
        </script>
        @else
        <!-- Empty State -->
        <div class="cart-container">
            <div class="nb-empty animate-fade-in">
                <div class="nb-empty-icon">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                    </svg>
                </div>
                <h2 class="nb-empty-title">Keranjang Kosong</h2>
                <p class="nb-empty-desc">Belum ada produk yang ditambahkan ke keranjang</p>
                <a href="{{ route('home') }}" class="nb-empty-btn">Mulai Belanja</a>
            </div>
        </div>
        @endif
    </div>
</div>
@endsection

@push('scripts')
<script>
function updateQty(id, change) {
    fetch(`/cart/update/${id}`, {
        method: 'PATCH',
        headers: { 
            'Content-Type': 'application/json', 
            'X-CSRF-TOKEN': '{{ csrf_token() }}', 
            'Accept': 'application/json' 
        },
        body: JSON.stringify({ qty: change })
    }).then(r => r.json()).then(d => {
        if(d.success) location.reload();
        else alert(d.message || 'Gagal memperbarui');
    }).catch(() => alert('Kesalahan koneksi'));
}

function removeItem(id) {
    if(!confirm('Hapus produk ini dari keranjang?')) return;
    fetch(`/cart/remove/${id}`, {
        method: 'DELETE',
        headers: { 
            'X-CSRF-TOKEN': '{{ csrf_token() }}', 
            'Accept': 'application/json' 
        }
    }).then(r => r.json()).then(d => {
        if(d.success) location.reload();
        else alert(d.message || 'Gagal menghapus');
    }).catch(() => alert('Kesalahan koneksi'));
}
</script>
@endpush