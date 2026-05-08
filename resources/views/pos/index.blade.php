@extends('layouts.app')

@section('title', 'Kasir - Point of Sale')

@section('content')

<!-- Success/Error Alerts - Modern Style with RED accent -->
@if(session('success'))
<div class="fixed top-4 right-4 z-50 bg-emerald-500/90 backdrop-blur-md text-white px-5 py-3.5 rounded-2xl shadow-lg flex items-center gap-3 animate-fade-in border border-emerald-400/20">
    <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
    <span class="text-sm font-medium">{{ session('success') }}</span>
    <button type="button" onclick="this.parentElement.remove()" class="ml-2 w-6 h-6 flex items-center justify-center rounded-lg hover:bg-white/10 transition">×</button>
</div>
@endif

@if(session('error'))
<div class="fixed top-4 right-4 z-50 bg-rose-500/90 backdrop-blur-md text-white px-5 py-3.5 rounded-2xl shadow-lg flex items-center gap-3 animate-fade-in border border-rose-400/20">
    <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
    <span class="text-sm font-medium">{{ session('error') }}</span>
    <button type="button" onclick="this.parentElement.remove()" class="ml-2 w-6 h-6 flex items-center justify-center rounded-lg hover:bg-white/10 transition">×</button>
</div>
@endif

<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

@verbatim
<style>
/* ── Modern Dark Theme CSS Variables - 🔴 RED ACCENT ───────── */
:root {
    --bg-primary: #0a0a0f;
    --bg-secondary: #12121a;
    --bg-card: #16161f;
    --bg-elevated: #1c1c2e;
    --bg-hover: rgba(255, 51, 102, 0.08);
    
    /* 🔴 RED/PINK ACCENT (sesuai request) */
    --accent-primary: #ff3366;
    --accent-secondary: #ff6b6b;
    --accent-gradient: linear-gradient(135deg, #ff3366 0%, #ff6b6b 100%);
    --accent-glow: rgba(255, 51, 102, 0.3);
    
    /* Secondary accents for specific elements */
    --emerald: #10b981;
    --amber: #f59e0b;
    --rose: #f43f5e;
    --violet: #8b5cf6;
    
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
        radial-gradient(at 100% 100%, rgba(255, 107, 107, 0.06) 0px, transparent 50%);
    background-attachment: fixed;
}

/* ── Animations ─────────────────────────────── */
@keyframes fadeIn { from { opacity: 0; } to { opacity: 1; } }
@keyframes slideUp { from { opacity: 0; transform: translateY(16px); } to { opacity: 1; transform: translateY(0); } }
@keyframes slideInRight { from { opacity: 0; transform: translateX(20px); } to { opacity: 1; transform: translateX(0); } }
@keyframes pulse { 0%, 100% { opacity: 1; } 50% { opacity: 0.6; } }
@keyframes float { 0%, 100% { transform: translateY(0); } 50% { transform: translateY(-4px); } }

.animate-fade { animation: fadeIn 0.3s ease-out; }
.animate-slide { animation: slideUp 0.4s ease-out both; }
.animate-slide-right { animation: slideInRight 0.4s ease-out both; }
.animate-pulse-custom { animation: pulse 2s ease-in-out infinite; }
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
    transition: all 0.2s ease;
}
.glass-card:hover {
    border-color: rgba(255, 51, 102, 0.3);
    box-shadow: var(--shadow-glow);
}

/* 🔴 Gradient Buttons - RED ACCENT */
.gradient-primary { 
    background: var(--accent-gradient); 
    box-shadow: 0 4px 20px var(--accent-glow); 
}
.gradient-emerald { 
    background: linear-gradient(135deg, var(--emerald) 0%, #059669 100%); 
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
.deco-blob-1 { top: 5%; right: 15%; width: 280px; height: 280px; background: var(--accent-primary); }
.deco-blob-2 { bottom: 10%; left: 10%; width: 200px; height: 200px; background: var(--accent-secondary); }

/* ── Page Header ───────────────────────────── */
.pos-header {
    position: relative; border-radius: var(--radius-xl); padding: 1.75rem 2rem;
    background: linear-gradient(135deg, var(--bg-secondary) 0%, var(--bg-card) 100%);
    border: 1px solid var(--border-color); margin-bottom: 1.5rem;
}
.pos-header::before {
    content: ''; position: absolute; top: 0; left: 0; right: 0; height: 2px;
    background: var(--accent-gradient); /* 🔴 RED gradient */
}
.pos-header-content { position: relative; z-index: 2; display: flex; justify-content: space-between; align-items: flex-start; gap: 1rem; flex-wrap: wrap; }

.pos-badge {
    display: inline-flex; align-items: center; gap: 8px;
    padding: 6px 14px; border-radius: 20px;
    background: rgba(255, 51, 102, 0.15); /* 🔴 RED background */
    border: 1px solid rgba(255, 51, 102, 0.3);
    font-size: 11px; font-weight: 700; letter-spacing: 0.1em;
    text-transform: uppercase; color: var(--accent-primary); /* 🔴 RED text */
    margin-bottom: 0.75rem;
}
.pos-badge-dot {
    width: 6px; height: 6px; border-radius: 50%;
    background: var(--emerald); animation: pulse 2s ease-in-out infinite;
}

.pos-title {
    font-size: clamp(1.75rem, 4vw, 2.25rem);
    font-weight: 800; line-height: 1.15; margin-bottom: 0.5rem;
    letter-spacing: -0.02em; color: var(--text-primary);
}
.pos-subtitle {
    font-size: 0.9rem; color: var(--text-secondary);
    line-height: 1.5;
}

/* Pending Checkouts Link - 🔴 RED */
.pending-link {
    display: inline-flex; align-items: center; gap: 0.75rem;
    padding: 0.75rem 1.25rem;
    background: linear-gradient(135deg, rgba(255, 51, 102, 0.1) 0%, rgba(255, 107, 107, 0.05) 100%);
    border: 1px solid rgba(255, 51, 102, 0.2);
    border-radius: var(--radius-lg);
    color: var(--accent-primary); text-decoration: none;
    font-weight: 600; font-size: 0.9rem;
    transition: all 0.2s ease;
    position: relative;
}
.pending-link:hover {
    border-color: var(--accent-primary);
    transform: translateY(-2px);
    box-shadow: 0 8px 24px var(--accent-glow);
}
.pending-badge {
    position: absolute; top: -8px; right: -8px;
    background: var(--rose); color: white;
    width: 24px; height: 24px; border-radius: 50%;
    display: flex; align-items: center; justify-content: center;
    font-weight: 700; font-size: 0.75rem;
    box-shadow: 0 4px 12px rgba(244, 63, 94, 0.4);
}

/* ── Search & Filter ───────────────────────── */
.pos-filters {
    display: flex; gap: 0.75rem; margin-bottom: 1.5rem; flex-wrap: wrap;
}
.search-wrapper {
    flex: 1; min-width: 240px; position: relative;
}
.search-icon {
    position: absolute; left: 1rem; top: 50%; transform: translateY(-50%);
    width: 18px; height: 18px; color: var(--text-muted);
}
.search-input {
    width: 100%; padding: 0.75rem 1rem 0.75rem 2.75rem;
    background: var(--bg-card); border: 1px solid var(--border-color);
    border-radius: var(--radius-lg); font-size: 0.9rem;
    color: var(--text-primary); transition: all 0.2s ease;
}
.search-input::placeholder { color: var(--text-muted); }
.search-input:focus {
    outline: none; border-color: var(--accent-primary); /* 🔴 RED focus */
    box-shadow: 0 0 0 3px rgba(255, 51, 102, 0.15);
    background: var(--bg-elevated);
}
.filter-select {
    padding: 0.75rem 1rem;
    background: var(--bg-card); border: 1px solid var(--border-color);
    border-radius: var(--radius-lg); font-size: 0.9rem;
    color: var(--text-primary); cursor: pointer;
    transition: all 0.2s ease; min-width: 180px;
}
.filter-select:focus {
    outline: none; border-color: var(--accent-primary);
}

/* ── Product Grid ─────────────────────────── */
.product-grid {
    display: grid; grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
    gap: 1rem; margin-bottom: 1.5rem;
}
@media (min-width: 1024px) {
    .product-grid { grid-template-columns: repeat(auto-fill, minmax(220px, 1fr)); }
}

.product-card {
    background: var(--bg-card); border: 1px solid var(--border-color);
    border-radius: var(--radius-lg); padding: 1.25rem;
    cursor: pointer; transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    position: relative; overflow: hidden;
}
.product-card:hover {
    transform: translateY(-4px);
    border-color: rgba(255, 51, 102, 0.3); /* 🔴 RED border on hover */
    box-shadow: var(--shadow-lg), var(--shadow-glow);
}
.product-card::before {
    content: ''; position: absolute; inset: 0; border-radius: inherit;
    background: linear-gradient(140deg, rgba(255, 51, 102, 0.08) 0%, transparent 60%); /* 🔴 RED gradient */
    opacity: 0; transition: opacity 0.3s; pointer-events: none;
}
.product-card:hover::before { opacity: 1; }

.product-image {
    width: 100%; aspect-ratio: 1; border-radius: var(--radius);
    background: var(--bg-elevated); margin-bottom: 1rem;
    display: flex; align-items: center; justify-content: center;
    overflow: hidden; border: 1px solid var(--border-color);
}
.product-image img {
    width: 100%; height: 100%; object-fit: cover;
    transition: transform 0.4s ease;
}
.product-card:hover .product-image img { transform: scale(1.08); }

.product-name {
    font-size: 0.9rem; font-weight: 600; color: var(--text-primary);
    margin-bottom: 0.25rem; line-height: 1.35;
    display: -webkit-box; -webkit-line-clamp: 2;
    -webkit-box-orient: vertical; overflow: hidden;
    min-height: 2.4rem;
}
.product-category {
    font-size: 0.75rem; color: var(--text-muted);
    margin-bottom: 0.5rem; text-transform: uppercase;
    letter-spacing: 0.05em;
}
.product-price {
    font-size: 1.1rem; font-weight: 700; color: var(--accent-primary); /* 🔴 RED price */
    line-height: 1.2;
}

/* Stock Badges */
.stock-badge {
    position: absolute; top: 0.75rem; right: 0.75rem;
    padding: 3px 10px; border-radius: 20px;
    font-size: 0.65rem; font-weight: 700;
    text-transform: uppercase; letter-spacing: 0.05em;
}
.stock-badge.in {
    background: rgba(16, 185, 129, 0.15); color: var(--emerald);
    border: 1px solid rgba(16, 185, 129, 0.3);
}
.stock-badge.low {
    background: rgba(245, 158, 11, 0.15); color: var(--amber);
    border: 1px solid rgba(245, 158, 11, 0.3);
}
.stock-badge.out {
    background: rgba(244, 63, 94, 0.15); color: var(--rose);
    border: 1px solid rgba(244, 63, 94, 0.3);
}

/* Empty State */
.empty-products {
    grid-column: 1 / -1; text-align: center; padding: 3rem 1rem;
    color: var(--text-muted);
}
.empty-icon {
    width: 56px; height: 56px; margin: 0 auto 1rem;
    border-radius: var(--radius-lg); background: var(--bg-elevated);
    display: flex; align-items: center; justify-content: center;
    opacity: 0.5;
}

/* ── Cart Panel ───────────────────────────── */
.cart-panel {
    background: var(--bg-card); border: 1px solid var(--border-color);
    border-radius: var(--radius-xl); padding: 1.5rem;
    position: sticky; top: 1.5rem; height: fit-content;
}
.cart-header {
    display: flex; align-items: center; justify-content: space-between;
    margin-bottom: 1.25rem; padding-bottom: 1rem;
    border-bottom: 1px solid var(--border-light);
}
.cart-title {
    font-size: 1.15rem; font-weight: 700; color: var(--text-primary);
}
.cart-count {
    padding: 3px 12px; border-radius: 20px;
    background: rgba(255, 51, 102, 0.15); /* 🔴 RED background */
    border: 1px solid rgba(255, 51, 102, 0.3);
    font-size: 11px; font-weight: 700; color: var(--accent-primary);
}

/* Cart Items */
.cart-items {
    max-height: 380px; overflow-y: auto; margin-bottom: 1.25rem;
}
.cart-item {
    display: flex; gap: 0.875rem; padding: 0.875rem;
    background: var(--bg-elevated); border: 1px solid var(--border-light);
    border-radius: var(--radius); margin-bottom: 0.75rem;
    transition: all 0.2s ease;
}
.cart-item:hover {
    border-color: rgba(255, 51, 102, 0.3);
}
.cart-item-image {
    width: 56px; height: 56px; border-radius: var(--radius-sm);
    background: var(--bg-card); flex-shrink: 0; overflow: hidden;
    border: 1px solid var(--border-color);
}
.cart-item-image img { width: 100%; height: 100%; object-fit: cover; }

.cart-item-info { flex: 1; min-width: 0; }
.cart-item-name {
    font-size: 0.875rem; font-weight: 600; color: var(--text-primary);
    margin-bottom: 0.25rem; line-height: 1.3;
    white-space: nowrap; overflow: hidden; text-overflow: ellipsis;
}
.cart-item-price {
    font-size: 0.8rem; color: var(--accent-primary); font-weight: 600; /* 🔴 RED price */
}

/* Quantity Controls */
.qty-controls {
    display: flex; align-items: center; gap: 0.5rem; margin-top: 0.5rem;
}
.qty-btn {
    width: 28px; height: 28px; border-radius: var(--radius-sm);
    border: 1px solid var(--border-color); background: var(--bg-card);
    color: var(--text-primary); font-size: 1rem; font-weight: 600;
    display: flex; align-items: center; justify-content: center;
    cursor: pointer; transition: all 0.15s ease;
}
.qty-btn:hover {
    background: var(--bg-hover); color: var(--accent-primary);
    border-color: rgba(255, 51, 102, 0.3);
}
.qty-value {
    font-size: 0.85rem; font-weight: 600; color: var(--text-primary);
    min-width: 28px; text-align: center;
}
.remove-btn {
    padding: 0.375rem; color: var(--rose); cursor: pointer;
    transition: all 0.15s ease; margin-left: auto;
}
.remove-btn:hover { transform: scale(1.1); color: var(--accent-primary); }

/* Empty Cart */
.cart-empty {
    text-align: center; padding: 2.5rem 1rem; color: var(--text-muted);
}
.cart-empty-icon {
    width: 48px; height: 48px; margin: 0 auto 0.75rem;
    border-radius: var(--radius-lg); background: var(--bg-elevated);
    display: flex; align-items: center; justify-content: center;
    opacity: 0.5;
}

/* Cart Summary */
.cart-summary {
    background: var(--bg-elevated); border: 1px solid var(--border-light);
    border-radius: var(--radius-lg); padding: 1.25rem;
    margin-bottom: 1.25rem;
}
.summary-row {
    display: flex; justify-content: space-between;
    font-size: 0.875rem; margin-bottom: 0.75rem;
}
.summary-label { color: var(--text-secondary); }
.summary-value { font-weight: 600; color: var(--text-primary); }
.summary-row.total {
    padding-top: 1rem; margin-top: 1rem;
    border-top: 1px solid var(--border-light);
    margin-bottom: 0; font-size: 1rem;
}
.summary-row.total .summary-label {
    font-weight: 700; color: var(--text-primary);
}
.summary-row.total .summary-value {
    font-size: 1.5rem; font-weight: 800; color: var(--accent-primary); /* 🔴 RED total */
}

/* Payment Methods */
.payment-section { margin-bottom: 1.25rem; }
.payment-label {
    font-size: 0.75rem; font-weight: 700; color: var(--text-muted);
    text-transform: uppercase; letter-spacing: 0.08em;
    margin-bottom: 0.75rem;
}
.payment-options {
    display: grid; grid-template-columns: repeat(2, 1fr); gap: 0.625rem;
}
.payment-option {
    padding: 0.875rem; background: var(--bg-elevated);
    border: 1px solid var(--border-color); border-radius: var(--radius);
    cursor: pointer; transition: all 0.2s ease; text-align: center;
}
.payment-option:hover {
    border-color: rgba(255, 51, 102, 0.3);
    background: var(--bg-hover);
}
.payment-option.active {
    background: rgba(255, 51, 102, 0.15); /* 🔴 RED active */
    border-color: var(--accent-primary);
}
.payment-icon {
    width: 32px; height: 32px; margin: 0 auto 0.5rem;
    border-radius: var(--radius-sm);
    display: flex; align-items: center; justify-content: center;
}
.payment-option.active .payment-icon {
    background: var(--accent-primary); color: white; /* 🔴 RED icon */
}
.payment-name {
    font-size: 0.75rem; font-weight: 600; color: var(--text-primary);
}

/* Action Buttons */
.action-buttons { display: flex; gap: 0.75rem; margin-bottom: 0.75rem; }
.hold-btn {
    flex: 1; padding: 1rem; border-radius: var(--radius-lg);
    background: var(--bg-elevated); border: 1px solid var(--border-color);
    color: var(--text-primary); font-size: 0.9rem; font-weight: 600;
    cursor: pointer; transition: all 0.2s ease;
    display: flex; align-items: center; justify-content: center; gap: 0.5rem;
}
.hold-btn:hover:not(:disabled) {
    background: rgba(245, 158, 11, 0.15);
    border-color: var(--amber); color: var(--amber);
}
.hold-btn:disabled { opacity: 0.5; cursor: not-allowed; }

.checkout-btn {
    flex: 1; padding: 1rem; border-radius: var(--radius-lg);
    background: var(--accent-gradient); /* 🔴 RED gradient */
    border: none;
    color: white; font-size: 0.9rem; font-weight: 700;
    cursor: pointer; transition: all 0.2s ease;
    box-shadow: 0 4px 20px var(--accent-glow);
}
.checkout-btn:hover:not(:disabled) {
    transform: translateY(-2px);
    box-shadow: 0 8px 32px var(--accent-glow);
}
.checkout-btn:disabled { opacity: 0.5; cursor: not-allowed; transform: none; }

/* Held Transaction Indicator */
.held-indicator {
    margin-top: 0.75rem; padding: 0.75rem 1rem;
    background: rgba(245, 158, 11, 0.1);
    border: 1px solid rgba(245, 158, 11, 0.2);
    border-radius: var(--radius);
    display: flex; align-items: center; justify-content: space-between;
}
.held-indicator.hidden { display: none; } /* ✅ Bug fix: ensure hidden works */
.held-text {
    font-size: 0.75rem; color: var(--amber); font-weight: 500;
}
.held-btn {
    font-size: 0.7rem; color: var(--amber); font-weight: 600;
    text-decoration: underline; cursor: pointer;
}
.held-btn:hover { color: var(--text-primary); }

/* ── Modal Base ───────────────────────────── */
.modal-overlay {
    position: fixed; inset: 0; background: rgba(0, 0, 0, 0.7);
    backdrop-filter: blur(12px); z-index: 1000;
    display: none; /* ✅ Bug fix: start hidden */
    align-items: center; justify-content: center;
    padding: 2rem; opacity: 0; pointer-events: none;
    transition: opacity 0.3s ease;
}
.modal-overlay.active { 
    display: flex; /* ✅ Show when active */
    opacity: 1; pointer-events: auto; 
}

.modal-content {
    background: var(--bg-card); border: 1px solid var(--border-color);
    border-radius: var(--radius-xl); padding: 2rem;
    width: 100%; max-width: 420px;
    transform: scale(0.95); transition: transform 0.3s ease;
}
.modal-overlay.active .modal-content { transform: scale(1); }

/* Success Modal Compact */
.modal-success { max-width: 340px !important; text-align: center; }
.success-icon {
    width: 64px; height: 64px; margin: 0 auto 1rem;
    border-radius: 50%; background: rgba(16, 185, 129, 0.15);
    border: 2px solid var(--emerald);
    display: flex; align-items: center; justify-content: center;
}
.success-title {
    font-size: 1.25rem; font-weight: 700; color: var(--text-primary);
    margin-bottom: 0.5rem;
}
.success-subtitle {
    font-size: 0.8rem; color: var(--text-secondary);
    margin-bottom: 1.25rem;
}
.success-details {
    background: var(--bg-elevated); border: 1px solid var(--border-light);
    border-radius: var(--radius-lg); padding: 1rem;
    margin-bottom: 1.5rem; text-align: left;
}
.success-row {
    display: flex; justify-content: space-between;
    font-size: 0.8rem; margin-bottom: 0.5rem;
}
.success-row:last-child {
    margin-bottom: 0; padding-top: 0.75rem;
    border-top: 1px solid var(--border-light);
}
.success-label { color: var(--text-muted); }
.success-value { font-weight: 600; color: var(--text-primary); }
.success-value.total { font-size: 1.1rem; color: var(--emerald); }

/* Modal Actions */
.modal-actions { display: flex; flex-direction: column; gap: 0.75rem; }
.modal-btn {
    width: 100%; padding: 0.875rem; border-radius: var(--radius-lg);
    font-size: 0.9rem; font-weight: 600; cursor: pointer;
    transition: all 0.2s ease; display: flex;
    align-items: center; justify-content: center; gap: 0.5rem;
}
.modal-btn.primary {
    background: var(--accent-gradient); border: none; /* 🔴 RED */
    color: white; box-shadow: 0 4px 16px var(--accent-glow);
}
.modal-btn.primary:hover {
    transform: translateY(-1px);
    box-shadow: 0 8px 24px var(--accent-glow);
}
.modal-btn.secondary {
    background: var(--bg-elevated); border: 1px solid var(--border-color);
    color: var(--text-primary);
}
.modal-btn.secondary:hover {
    background: var(--bg-hover); border-color: rgba(255, 51, 102, 0.3);
}

/* Hold Modal */
.modal-hold { max-width: 360px !important; text-align: center; }
.hold-icon {
    width: 64px; height: 64px; margin: 0 auto 1rem;
    border-radius: 50%; background: rgba(245, 158, 11, 0.15);
    border: 2px solid var(--amber);
    display: flex; align-items: center; justify-content: center;
}

/* QRIS Modal - Landscape */
.modal-qris { max-width: 720px !important; }
.modal-qris-header {
    display: flex; align-items: center; justify-content: space-between;
    margin-bottom: 1.5rem;
}
.modal-qris-grid {
    display: grid; grid-template-columns: 1fr 1.3fr; gap: 1.5rem;
    align-items: center;
}
.qr-wrapper {
    background: white; border-radius: var(--radius-lg);
    padding: 1rem; display: flex; justify-content: center;
    box-shadow: var(--shadow-md);
}
.qr-image { width: 160px; height: 160px; object-fit: contain; }
.qr-placeholder {
    width: 160px; height: 160px; background: var(--bg-elevated);
    border-radius: var(--radius); display: flex;
    align-items: center; justify-content: center;
}
.qr-hint {
    font-size: 0.75rem; color: var(--text-muted);
    text-align: center; margin-top: 0.75rem;
}

.qris-info { display: flex; flex-direction: column; gap: 1rem; }
.qris-amount {
    text-align: center; padding: 1rem;
    background: var(--bg-elevated); border-radius: var(--radius-lg);
}
.qris-amount-label {
    font-size: 0.7rem; color: var(--text-muted);
    text-transform: uppercase; letter-spacing: 0.08em;
    margin-bottom: 0.5rem;
}
.qris-amount-value {
    font-size: 1.75rem; font-weight: 800; color: var(--accent-primary); /* 🔴 RED */
}
.qris-steps {
    background: var(--bg-elevated); border: 1px solid var(--border-light);
    border-radius: var(--radius-lg); padding: 1rem;
}
.qris-steps-title {
    font-size: 0.85rem; font-weight: 600; color: var(--accent-primary); /* 🔴 RED */
    margin-bottom: 0.5rem; display: flex; align-items: center; gap: 0.5rem;
}
.qris-steps-list {
    font-size: 0.75rem; color: var(--text-secondary);
    line-height: 1.8; margin: 0; padding-left: 1.25rem;
}
.qris-steps-list li { list-style: disc; }

.modal-qris-actions {
    display: flex; gap: 0.75rem; margin-top: 1.5rem;
}
.modal-qris-actions .modal-btn { flex: 1; }

/* E-Wallet / Debit Modal */
.modal-wallet { max-width: 400px !important; }
.modal-wallet-header {
    display: flex; align-items: center; justify-content: space-between;
    margin-bottom: 1.25rem;
}
.wallet-options {
    display: grid; grid-template-columns: repeat(2, 1fr); gap: 0.75rem;
    margin-bottom: 1.25rem;
}
.wallet-card {
    padding: 1rem; background: var(--bg-elevated);
    border: 1px solid var(--border-color); border-radius: var(--radius-lg);
    cursor: pointer; transition: all 0.2s ease; text-align: center;
}
.wallet-card:hover {
    border-color: rgba(255, 51, 102, 0.3);
    background: var(--bg-hover);
}
.wallet-card.active {
    background: rgba(255, 51, 102, 0.15); /* 🔴 RED active */
    border-color: var(--accent-primary);
}
.wallet-card-icon {
    width: 40px; height: 40px; margin: 0 auto 0.5rem;
    border-radius: var(--radius-sm); display: flex;
    align-items: center; justify-content: center;
    font-weight: 700; font-size: 0.7rem; color: white;
}
.wallet-card-name {
    font-size: 0.8rem; font-weight: 600; color: var(--text-primary);
}

/* Wallet Details */
.wallet-detail {
    margin-top: 1rem; padding: 1rem;
    background: var(--bg-elevated); border: 1px solid var(--border-light);
    border-radius: var(--radius-lg);
}
.wallet-detail-title {
    font-size: 0.7rem; color: var(--text-muted);
    text-transform: uppercase; letter-spacing: 0.08em;
    margin-bottom: 0.5rem; text-align: center;
}
.wallet-detail-name {
    font-size: 0.9rem; font-weight: 600; color: var(--text-primary);
    text-align: center; margin-bottom: 0.75rem;
}
.wallet-detail-number {
    background: var(--bg-card); padding: 0.75rem;
    border-radius: var(--radius); margin-bottom: 0.75rem;
}
.wallet-detail-number-label {
    font-size: 0.7rem; color: var(--text-muted);
    margin-bottom: 0.25rem;
}
.wallet-detail-number-value {
    font-family: monospace; font-size: 1.1rem;
    font-weight: 700; color: var(--accent-primary); /* 🔴 RED */
}
.wallet-detail-instruction {
    font-size: 0.8rem; color: var(--text-secondary);
    line-height: 1.5;
}

.modal-wallet-actions {
    display: flex; gap: 0.75rem; margin-top: 1.25rem;
}
.modal-wallet-actions .modal-btn { flex: 1; }

/* ── Scrollbar ───────────────────────────── */
::-webkit-scrollbar { width: 5px; }
::-webkit-scrollbar-track { background: transparent; }
::-webkit-scrollbar-thumb {
    background: var(--bg-elevated); border-radius: 3px;
}
::-webkit-scrollbar-thumb:hover { background: var(--accent-primary); }

/* ── Responsive ─────────────────────────── */
@media (max-width: 1024px) {
    .pos-header-content { flex-direction: column; align-items: flex-start; }
    .pending-link { width: 100%; justify-content: center; }
}
@media (max-width: 768px) {
    .pos-header { padding: 1.25rem 1rem; }
    .pos-title { font-size: clamp(1.5rem, 5vw, 2rem); }
    .product-grid { grid-template-columns: repeat(2, 1fr); gap: 0.75rem; }
    .cart-panel { position: static; }
    .modal-qris-grid { grid-template-columns: 1fr; text-align: center; }
    .qris-steps-list { padding-left: 0; text-align: center; }
    .qris-steps-list li { list-style: none; }
}

/* ── Focus States ───────────────────────── */
button:focus-visible, a:focus-visible, input:focus-visible, select:focus-visible {
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

<div class="pos-wrap">
    {{-- Header --}}
    <div class="pos-header animate-slide">
        <div class="pos-header-content">
            <div>
                <div class="pos-badge">
                    <span class="pos-badge-dot"></span>
                    Point of Sale
                </div>
                <h1 class="pos-title">Kasir - Transaksi</h1>
                <p class="pos-subtitle">Pilih produk dan proses pembayaran</p>
            </div>
            <!-- Pending Checkouts Badge -->
            <a href="{{ route('pos.confirmations.index') }}" class="pending-link">
                <span style="font-size: 1.2rem;">📋</span>
                <span id="pendingCountDisplay">Periksa Konfirmasi</span>
                <span id="pendingBadge" class="pending-badge" style="display: none;"></span>
            </a>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        {{-- Left: Products --}}
        <div class="lg:col-span-2">
            {{-- Search & Filter --}}
            <div class="pos-filters animate-slide">
                <div class="search-wrapper">
                    <svg class="search-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m21 21-4.35-4.35M19 11a8 8 0 1 1-16 0 8 8 0 0 1 16 0Z"/>
                    </svg>
                    <input type="text" class="search-input" placeholder="Cari produk..." id="productSearch">
                </div>
                <select class="filter-select" id="categoryFilter">
                    <option value="">Semua Kategori</option>
                    @foreach($categories as $cat)
                    <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                    @endforeach
                </select>
            </div>

            {{-- Product Grid --}}
            <div class="product-grid" id="productGrid">
                @forelse($products as $product)
                <div class="product-card animate-fade" onclick="addToCart({{ $product->id }})" 
                     data-product-id="{{ $product->id }}" 
                     data-name="{{ $product->name }}" 
                     data-price="{{ $product->price }}" 
                     data-stock="{{ $product->stock ?? 0 }}">
                    <div class="product-image">
                        @if($product->image)
                        <img src="{{ imageUrl($product->image) ?? asset('images/placeholder.png') }}" alt="{{ $product->name }}" onerror="this.src='{{ asset('images/placeholder.png') }}'">
                        @else
                        <svg width="40" height="40" fill="none" stroke="var(--text-muted)" stroke-width="1.5" viewBox="0 0 24 24">
                            <path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"/>
                        </svg>
                        @endif
                    </div>
                    <div class="product-name">{{ $product->name }}</div>
                    <div class="product-category">{{ $product->category->name ?? 'Umum' }}</div>
                    <div class="product-price">Rp {{ number_format($product->price, 0, ',', '.') }}</div>
                    @php $stock = $product->stock ?? 0; @endphp
                    @if($stock > 5)
                    <span class="stock-badge in">Stok: {{ $stock }}</span>
                    @elseif($stock > 0)
                    <span class="stock-badge low">Sisa {{ $stock }}</span>
                    @else
                    <span class="stock-badge out">Habis</span>
                    @endif
                </div>
                @empty
                <div class="empty-products">
                    <div class="empty-icon">
                        <svg width="24" height="24" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                            <path d="M20 13V6a2 2 0 0 0-2-2H6a2 2 0 0 0-2 2v7m16 0v5a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2v-5m16 0h-2.586a1 1 0 0 0-.707.293l-2.414 2.414a1 1 0 0 1-.707.293h-3.172a1 1 0 0 1-.707-.293l-2.414-2.414A1 1 0 0 0 6.586 13H4"/>
                        </svg>
                    </div>
                    <p>Belum ada produk</p>
                </div>
                @endforelse
            </div>
        </div>

        {{-- Right: Cart --}}
        <div class="animate-slide-right">
            <div class="cart-panel">
                <div class="cart-header">
                    <h3 class="cart-title">Keranjang</h3>
                    <span class="cart-count" id="cartCount">0 item</span>
                </div>
                
                <div class="cart-items" id="cartItems">
                    <div class="cart-empty">
                        <div class="cart-empty-icon">
                            <svg width="24" height="24" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                <path d="M6 6h15l-1.5 9h-12z"/><circle cx="9" cy="20" r="1"/><circle cx="18" cy="20" r="1"/><path d="M6 6 5 3H2"/>
                            </svg>
                        </div>
                        <p class="text-sm">Keranjang kosong</p>
                    </div>
                </div>

                <div class="cart-summary">
                    <div class="summary-row">
                        <span class="summary-label">Subtotal</span>
                        <span class="summary-value" id="cartSubtotal">Rp 0</span>
                    </div>
                    <div class="summary-row">
                        <span class="summary-label">Pajak (0%)</span>
                        <span class="summary-value">Rp 0</span>
                    </div>
                    <div class="summary-row total">
                        <span class="summary-label">Total</span>
                        <span class="summary-value" id="cartTotal">Rp 0</span>
                    </div>
                </div>

                <div class="payment-section">
                    <div class="payment-label">Metode Pembayaran</div>
                    <div class="payment-options">
                        <div class="payment-option active" onclick="selectPayment('cash')" data-payment="cash">
                            <div class="payment-icon" style="background:rgba(255,51,102,.15);color:var(--accent-primary);">
                                <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <circle cx="12" cy="12" r="10"/><path d="M16 8h-6a2 2 0 1 0 0 4h4a2 2 0 1 1 0 4H8"/>
                                </svg>
                            </div>
                            <div class="payment-name">Cash</div>
                        </div>
                        <div class="payment-option" onclick="selectPayment('qris')" data-payment="qris">
                            <div class="payment-icon" style="background:rgba(255,51,102,.15);color:var(--accent-primary);">
                                <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <rect width="18" height="18" x="3" y="3" rx="2"/><path d="M3 9h18"/><path d="M9 21V9"/>
                                </svg>
                            </div>
                            <div class="payment-name">QRIS</div>
                        </div>
                        <div class="payment-option" onclick="selectPayment('debit')" data-payment="debit">
                            <div class="payment-icon" style="background:rgba(255,51,102,.15);color:var(--accent-primary);">
                                <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <rect width="20" height="14" x="2" y="5" rx="2"/><line x1="2" x2="22" y1="10" y2="10"/>
                                </svg>
                            </div>
                            <div class="payment-name">Debit</div>
                        </div>
                        <div class="payment-option" onclick="selectPayment('ewallet')" data-payment="ewallet">
                            <div class="payment-icon" style="background:rgba(255,51,102,.15);color:var(--accent-primary);">
                                <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path d="M21 12V7H5a2 2 0 0 1 0-4h14v4"/><path d="M3 5v14a2 2 0 0 0 2 2h16v-5"/><path d="M18 12a2 2 0 0 0 0 4h4v-4Z"/>
                                </svg>
                            </div>
                            <div class="payment-name">E-Wallet</div>
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="action-buttons">
                    <button type="button" onclick="openHoldModal()" class="hold-btn" id="holdBtn" disabled>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 9v6m4-6v6m7-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        Tahan
                    </button>
                    <button type="button" class="checkout-btn" id="checkoutBtn" onclick="processCheckout()" disabled>
                        Proses Pembayaran
                    </button>
                </div>

                <!-- Held Transaction Indicator -->
                <div id="heldIndicator" class="held-indicator hidden">
                    <span class="held-text">🕒 1 transaksi ditahan</span>
                    <span class="held-btn" onclick="resumeTransaction()">Lanjutkan</span>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Hold Transaction Modal -->
<div id="holdModal" class="modal-overlay" role="dialog" aria-modal="true">
    <div class="modal-content modal-hold">
        <div class="hold-icon">
            <svg width="32" height="32" fill="none" stroke="var(--amber)" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 9v6m4-6v6m7-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
        </div>
        <h3 class="success-title">Tahan Transaksi?</h3>
        <p class="success-subtitle">Keranjang saat ini akan disimpan. Anda bisa melanjutkannya nanti.</p>
        <div class="modal-actions">
            <button type="button" onclick="closeHoldModal()" class="modal-btn secondary">Batal</button>
            <button type="button" onclick="saveHoldTransaction()" class="modal-btn primary">Simpan & Tahan</button>
        </div>
    </div>
</div>

<!-- QRIS Modal - Landscape -->
<div id="qrisModal" class="modal-overlay" role="dialog" aria-modal="true">
    <div class="modal-content modal-qris">
        <!-- Header -->
        <div class="modal-qris-header">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl gradient-primary flex items-center justify-center">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm12 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z"/>
                    </svg>
                </div>
                <div>
                    <h3 class="text-lg font-bold text-white">Pembayaran QRIS</h3>
                    <p class="text-xs text-muted">Scan & bayar dalam hitungan detik</p>
                </div>
            </div>
            <button type="button" onclick="closeQrisModal()" class="p-2 text-muted hover:text-white hover:bg-white/10 rounded-lg transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>

        <!-- Content Grid -->
        <div class="modal-qris-grid">
            <!-- QR Code -->
            <div class="flex flex-col items-center">
                <div class="qr-wrapper">
                    @php $qrisImage = setting('qris_image') ?? null; @endphp
                    @if($qrisImage)
                    <img src="{{ asset('storage/' . $qrisImage) }}" alt="QR Code" class="qr-image" id="qrisImage" onerror="this.style.display='none'; this.parentElement.querySelector('.qr-placeholder').style.display='flex'">
                    @endif
                    <div class="qr-placeholder" style="{{ $qrisImage ? 'display:none' : 'display:flex' }}">
                        <svg class="w-12 h-12 text-muted" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm12 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z"/>
                        </svg>
                    </div>
                </div>
                <p class="qr-hint">Scan dengan e-wallet atau mobile banking</p>
            </div>

            <!-- Info -->
            <div class="qris-info">
                <div class="qris-amount">
                    <p class="qris-amount-label">Total Pembayaran</p>
                    <p class="qris-amount-value" id="qrisAmount">Rp 0</p>
                </div>
                <div class="qris-steps">
                    <p class="qris-steps-title">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        Cara Bayar:
                    </p>
                    <ul class="qris-steps-list">
                        <li>Buka aplikasi e-wallet / m-banking</li>
                        <li>Pilih menu <strong>Scan QRIS</strong></li>
                        <li>Arahkan kamera ke QR di kiri</li>
                        <li>Konfirmasi di aplikasi Anda</li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Actions -->
        <div class="modal-qris-actions">
            <button type="button" onclick="closeQrisModal()" class="modal-btn secondary">Batal</button>
            <button type="button" onclick="confirmQrisPayment()" class="modal-btn primary">Saya Sudah Bayar</button>
        </div>
    </div>
</div>

<!-- E-Wallet Modal -->
<div id="ewalletModal" class="modal-overlay" role="dialog" aria-modal="true">
    <div class="modal-content modal-wallet">
        <div class="modal-wallet-header">
            <div>
                <h3 class="text-lg font-bold text-white">Pilih E-Wallet</h3>
                <p class="text-xs text-muted">Pilih metode pembayaran digital</p>
            </div>
            <button type="button" onclick="closeEwalletModal()" class="p-2 text-muted hover:text-white hover:bg-white/10 rounded-lg transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>
        
        <div class="wallet-options">
            <!-- DANA -->
            <button type="button" class="wallet-card ewallet-card" onclick="selectSubPayment('dana', this)" data-ewallet="dana">
                <div class="wallet-card-icon" style="background:#118EEA;">DANA</div>
                <span class="wallet-card-name">DANA</span>
            </button>
            <!-- GoPay -->
            <button type="button" class="wallet-card ewallet-card" onclick="selectSubPayment('gopay', this)" data-ewallet="gopay">
                <div class="wallet-card-icon" style="background:#00AA13;">GP</div>
                <span class="wallet-card-name">GoPay</span>
            </button>
            <!-- OVO -->
            <button type="button" class="wallet-card ewallet-card" onclick="selectSubPayment('ovo', this)" data-ewallet="ovo">
                <div class="wallet-card-icon" style="background:#4C3494;">OVO</div>
                <span class="wallet-card-name">OVO</span>
            </button>
            <!-- ShopeePay -->
            <button type="button" class="wallet-card ewallet-card" onclick="selectSubPayment('shopeepay', this)" data-ewallet="shopeepay">
                <div class="wallet-card-icon" style="background:#EE4D2D;">SP</div>
                <span class="wallet-card-name">ShopeePay</span>
            </button>
        </div>

        <!-- E-Wallet Detail (shown when selected) -->
        <div id="ewalletDetail" class="wallet-detail hidden">
            <div id="ewalletDetailContent"></div>
        </div>
        
        <div class="modal-wallet-actions">
            <button type="button" onclick="closeEwalletModal()" class="modal-btn secondary">Batal</button>
            <button type="button" id="confirmEwalletBtn" onclick="confirmPayment()" class="modal-btn primary" disabled>Lanjut Bayar</button>
        </div>
    </div>
</div>

<!-- Debit Modal -->
<div id="debitModal" class="modal-overlay" role="dialog" aria-modal="true">
    <div class="modal-content modal-wallet">
        <div class="modal-wallet-header">
            <div>
                <h3 class="text-lg font-bold text-white">Pilih Kartu Debit</h3>
                <p class="text-xs text-muted">Pilih bank penerbit kartu Anda</p>
            </div>
            <button type="button" onclick="closeDebitModal()" class="p-2 text-muted hover:text-white hover:bg-white/10 rounded-lg transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>
        
        <div class="wallet-options">
            <button type="button" class="wallet-card" onclick="selectSubPayment('bca', this)">
                <div class="wallet-card-icon" style="background:#005EB8;">BCA</div>
                <span class="wallet-card-name">BCA</span>
            </button>
            <button type="button" class="wallet-card" onclick="selectSubPayment('mandiri', this)">
                <div class="wallet-card-icon" style="background:#FFD700;color:#000;">MDR</div>
                <span class="wallet-card-name">Mandiri</span>
            </button>
            <button type="button" class="wallet-card" onclick="selectSubPayment('bni', this)">
                <div class="wallet-card-icon" style="background:#006633;">BNI</div>
                <span class="wallet-card-name">BNI</span>
            </button>
            <button type="button" class="wallet-card" onclick="selectSubPayment('bri', this)">
                <div class="wallet-card-icon" style="background:#0066CC;">BRI</div>
                <span class="wallet-card-name">BRI</span>
            </button>
        </div>
        
        <div class="modal-wallet-actions">
            <button type="button" onclick="closeDebitModal()" class="modal-btn secondary">Batal</button>
            <button type="button" id="confirmDebitBtn" onclick="confirmPayment()" class="modal-btn primary" disabled>Lanjut Bayar</button>
        </div>
    </div>
</div>

<!-- Success Modal - Compact -->
<div id="successModal" class="modal-overlay" role="dialog" aria-modal="true">
    <div class="modal-content modal-success">
        <div class="success-icon">
            <svg class="w-8 h-8 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/>
            </svg>
        </div>
        <h3 class="success-title">✅ Transaksi Berhasil!</h3>
        <p class="success-subtitle">No. Invoice: <span id="successInvoice" class="text-emerald-400">#INV-00000</span></p>
        
        <div class="success-details">
            <div class="success-row">
                <span class="success-label">Metode</span>
                <span class="success-value" id="successPayment">Cash</span>
            </div>
            <div class="success-row">
                <span class="success-label">Waktu</span>
                <span class="success-value" id="successTime">--:--</span>
            </div>
            <div class="success-row">
                <span class="success-label">Total</span>
                <span class="success-value total" id="successTotal">Rp 0</span>
            </div>
        </div>
        
        <div class="modal-actions">
            <button type="button" onclick="printReceipt()" class="modal-btn primary">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/>
                </svg>
                Cetak Struk
            </button>
            <button type="button" onclick="newTransaction()" class="modal-btn secondary">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                </svg>
                Transaksi Baru
            </button>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script>
// ===== SIMPLE STATE =====
let cart = [];
let currentPayment = 'cash';
let selectedSubPayment = null;

// ===== MODAL HELPERS - FIXED =====
function openModal(modalId) {
    const modal = document.getElementById(modalId);
    if (!modal) { console.error('Modal not found:', modalId); return; }
    modal.classList.remove('hidden');
    modal.style.display = 'flex';
    void modal.offsetWidth;
    modal.classList.add('active');
    const content = modal.querySelector('.modal-content');
    if (content) { content.classList.remove('scale-95', 'opacity-0'); content.classList.add('scale-100', 'opacity-100'); }
    document.body.style.overflow = 'hidden';
}

function closeModal(modalId) {
    const modal = document.getElementById(modalId);
    if (!modal) return;
    modal.classList.remove('active');
    const content = modal.querySelector('.modal-content');
    if (content) { content.classList.remove('scale-100', 'opacity-100'); content.classList.add('scale-95', 'opacity-0'); }
    setTimeout(() => { 
        modal.classList.add('hidden'); 
        modal.style.display = 'none';
        document.body.style.overflow = ''; 
    }, 300);
}

// ===== CART FUNCTIONS =====
function updateCartUI() {
    if (!Array.isArray(cart)) cart = [];
    const els = {
        items: document.getElementById('cartItems'),
        count: document.getElementById('cartCount'),
        subtotal: document.getElementById('cartSubtotal'),
        total: document.getElementById('cartTotal'),
        checkout: document.getElementById('checkoutBtn')
    };
    if (!els.items) return;
    
    if (cart.length === 0) {
        els.items.innerHTML = `<div class="cart-empty text-center py-6"><div class="cart-empty-icon"><svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/></svg></div><p class="text-sm text-muted">Keranjang kosong</p></div>`;
        if (els.checkout) els.checkout.disabled = true;
    } else {
        els.items.innerHTML = cart.map(item => `
            <div class="cart-item">
                <div class="cart-item-image">
                    ${item.image ? `<img src="${item.image}" alt="${escapeHtml(item.name)}" onerror="this.src='{{ asset('images/placeholder.png') }}'">` : `<svg class="w-6 h-6 text-muted m-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>`}
                </div>
                <div class="cart-item-info">
                    <div class="cart-item-name">${escapeHtml(item.name)}</div>
                    <div class="cart-item-price">Rp ${item.price.toLocaleString('id-ID')}</div>
                    <div class="qty-controls">
                        <button type="button" class="qty-btn" onclick="updateQty(${item.id}, -1)">−</button>
                        <span class="qty-value">${item.qty}</span>
                        <button type="button" class="qty-btn" onclick="updateQty(${item.id}, 1)">+</button>
                    </div>
                </div>
                <button type="button" class="remove-btn" onclick="removeFromCart(${item.id})">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                </button>
            </div>
        `).join('');
        if (els.checkout) els.checkout.disabled = false;
    }
    const total = cart.reduce((s, i) => s + (i.price * i.qty), 0);
    if (els.count) els.count.textContent = `${cart.length} item`;
    if (els.subtotal) els.subtotal.textContent = `Rp ${total.toLocaleString('id-ID')}`;
    if (els.total) els.total.textContent = `Rp ${total.toLocaleString('id-ID')}`;
}

function escapeHtml(text) {
    if (!text) return '';
    const div = document.createElement('div'); div.textContent = text; return div.innerHTML;
}

function addToCart(productId) {
    const card = document.querySelector(`[data-product-id="${productId}"]`);
    if (!card) return;
    const stock = parseInt(card.dataset.stock) || 0;
    if (stock <= 0) { alert('Stok produk habis!'); return; }
    const existing = cart.find(i => i.id == productId);
    if (existing) {
        if (existing.qty >= stock) { alert('Stok tidak mencukupi!'); return; }
        existing.qty++;
    } else {
        cart.push({
            id: productId, 
            name: card.dataset.name || 'Produk',
            price: parseInt(card.dataset.price) || 0,
            image: card.querySelector('img')?.src || null,
            stock: stock, 
            qty: 1
        });
    }
    updateCartUI();
}

function updateQty(productId, change) {
    const item = cart.find(i => i.id == productId);
    if (!item) return;
    const newQty = item.qty + change;
    if (newQty <= 0) { removeFromCart(productId); return; }
    if (newQty > item.stock) { alert('Stok tidak mencukupi!'); return; }
    item.qty = newQty; updateCartUI();
}

function removeFromCart(productId) {
    cart = cart.filter(i => i.id != productId); updateCartUI();
}

// ===== PAYMENT SELECTION =====
function selectPayment(method) {
    currentPayment = method; selectedSubPayment = null;
    document.querySelectorAll('.payment-option').forEach(opt => {
        opt.classList.toggle('active', opt.dataset.payment === method);
    });
    document.querySelectorAll('.wallet-card').forEach(btn => btn.classList.remove('active'));
    ['confirmEwalletBtn', 'confirmDebitBtn'].forEach(id => {
        const btn = document.getElementById(id);
        if (btn) { 
            btn.disabled = true; 
            btn.className = 'modal-btn primary'; 
            btn.style.opacity = '0.5'; 
            btn.style.cursor = 'not-allowed'; 
        }
    });
}

function selectSubPayment(value, btn) {
    selectedSubPayment = value;
    btn.parentElement.querySelectorAll('.wallet-card').forEach(b => b.classList.remove('active'));
    btn.classList.add('active');
    showEwalletDetail(value);
    const confirmBtn = currentPayment === 'ewallet' ? document.getElementById('confirmEwalletBtn') : document.getElementById('confirmDebitBtn');
    if (confirmBtn) {
        confirmBtn.disabled = false;
        confirmBtn.className = 'modal-btn primary';
        confirmBtn.style.opacity = '1';
        confirmBtn.style.cursor = 'pointer';
    }
}

// E-Wallet Details Data - ✅ Null safe
const ewalletData = {
    dana: { 
        name: 'DANA', 
        color: '#118EEA', 
        number: '{{ setting("ewallet_dana_number") ?? "" }}', 
        description: '{{ setting("ewallet_dana_description") ?? "" }}' 
    },
    gopay: { 
        name: 'GoPay', 
        color: '#00AA13', 
        number: '{{ setting("ewallet_gopay_number") ?? "" }}', 
        description: '{{ setting("ewallet_gopay_description") ?? "" }}' 
    },
    ovo: { 
        name: 'OVO', 
        color: '#4C3494', 
        number: '{{ setting("ewallet_ovo_number") ?? "" }}', 
        description: '{{ setting("ewallet_ovo_description") ?? "" }}' 
    },
    shopeepay: { 
        name: 'ShopeePay', 
        color: '#EE4D2D', 
        number: '{{ setting("ewallet_shopeepay_number") ?? "" }}', 
        description: '{{ setting("ewallet_shopeepay_description") ?? "" }}' 
    }
};

function showEwalletDetail(ewallet) {
    const detail = ewalletData[ewallet];
    const detailDiv = document.getElementById('ewalletDetail');
    const contentDiv = document.getElementById('ewalletDetailContent');
    if (detail && contentDiv) {
        contentDiv.innerHTML = `
            <div class="text-center">
                <p class="wallet-detail-title">Informasi Pembayaran</p>
                <p class="wallet-detail-name">${detail.name}</p>
                <div class="wallet-detail-number">
                    <p class="wallet-detail-number-label">Nomor/ID:</p>
                    <p class="wallet-detail-number-value">${detail.number || '-'}</p>
                </div>
                <p class="wallet-detail-instruction">${detail.description || 'Ikuti instruksi di aplikasi'}</p>
            </div>
        `;
        detailDiv.classList.remove('hidden');
    } else if (detailDiv) { 
        detailDiv.classList.add('hidden'); 
    }
}

function processCheckout() {
    if (!cart || cart.length === 0) { alert('Keranjang masih kosong!'); return; }
    const total = cart.reduce((s, i) => s + (i.price * i.qty), 0);
    if (currentPayment === 'qris') {
        const amountEl = document.getElementById('qrisAmount');
        if (amountEl) amountEl.textContent = `Rp ${total.toLocaleString('id-ID')}`;
        openModal('qrisModal');
    } else if (currentPayment === 'ewallet') { openModal('ewalletModal'); }
    else if (currentPayment === 'debit') { openModal('debitModal'); }
    else { submitForm(total); }
}

function confirmQrisPayment() { closeModal('qrisModal'); submitForm(cart.reduce((s, i) => s + (i.price * i.qty), 0)); }
function confirmPayment() { closeModal(currentPayment === 'ewallet' ? 'ewalletModal' : 'debitModal'); submitForm(cart.reduce((s, i) => s + (i.price * i.qty), 0)); }

// ===== FORM SUBMISSION =====
function submitForm(total) {
    const form = document.createElement('form');
    form.method = 'POST'; form.action = '/pos/checkout';
    const csrf = document.querySelector('meta[name="csrf-token"]')?.content;
    if (csrf) { const token = document.createElement('input'); token.type = 'hidden'; token.name = '_token'; token.value = csrf; form.appendChild(token); }
    const cartInput = document.createElement('input'); cartInput.type = 'hidden'; cartInput.name = 'cart_items'; cartInput.value = JSON.stringify(cart); form.appendChild(cartInput);
    const paymentInput = document.createElement('input'); paymentInput.type = 'hidden'; paymentInput.name = 'payment_method'; paymentInput.value = currentPayment; form.appendChild(paymentInput);
    if (selectedSubPayment) { const subInput = document.createElement('input'); subInput.type = 'hidden'; subInput.name = 'sub_payment'; subInput.value = selectedSubPayment; form.appendChild(subInput); }
    const totalInput = document.createElement('input'); totalInput.type = 'hidden'; totalInput.name = 'total_amount'; totalInput.value = total; form.appendChild(totalInput);
    document.body.appendChild(form); form.submit();
}

// ===== HOLD TRANSACTION =====
function openHoldModal() { if (!cart || cart.length === 0) { alert('Keranjang kosong!'); return; } openModal('holdModal'); }
function closeHoldModal() { closeModal('holdModal'); }
function saveHoldTransaction() {
    try {
        if (!cart || cart.length === 0) { alert('Keranjang kosong!'); return; }
        sessionStorage.setItem('heldCart', JSON.stringify(cart));
        cart = []; updateCartUI(); closeHoldModal();
        const indicator = document.getElementById('heldIndicator');
        if (indicator) indicator.classList.remove('hidden');
        alert('✅ Transaksi berhasil ditahan!');
    } catch (e) { console.error('Hold error:', e); alert('Gagal menahan transaksi.'); }
}
function checkHeldTransaction() {
    try { if (sessionStorage.getItem('heldCart')) { const indicator = document.getElementById('heldIndicator'); if (indicator) indicator.classList.remove('hidden'); } }
    catch (e) { console.warn('SessionStorage blocked:', e); }
}
function resumeTransaction() {
    try {
        const heldData = sessionStorage.getItem('heldCart');
        if (!heldData) { alert('Tidak ada transaksi tertahan.'); return; }
        const held = JSON.parse(heldData);
        if (!Array.isArray(held) || held.length === 0) { alert('Data tidak valid.'); return; }
        if (cart.length > 0 && !confirm('Keranjang saat ini akan diganti. Lanjutkan?')) return;
        cart = held; sessionStorage.removeItem('heldCart');
        const indicator = document.getElementById('heldIndicator');
        if (indicator) indicator.classList.add('hidden');
        updateCartUI();
    } catch (e) { console.error('Resume error:', e); alert('Gagal melanjutkan transaksi.'); }
}

// ===== SUCCESS MODAL =====
function showSuccessModal(txn) {
    const modal = document.getElementById('successModal'); if (!modal) return;
    const els = { 
        invoice: document.getElementById('successInvoice'), 
        payment: document.getElementById('successPayment'), 
        time: document.getElementById('successTime'), 
        total: document.getElementById('successTotal') 
    };
    if (els.invoice) els.invoice.textContent = txn?.invoice_code || '#INV-' + Date.now().toString().slice(-6);
    if (els.payment) els.payment.textContent = {cash:'Tunai', qris:'QRIS', debit:'Debit Card', ewallet:'E-Wallet'}[currentPayment] || currentPayment;
    if (els.time) els.time.textContent = new Date().toLocaleTimeString('id-ID', {hour:'2-digit', minute:'2-digit'});
    const total = cart.reduce((s,i) => s + i.price*i.qty, 0);
    if (els.total) els.total.textContent = `Rp ${total.toLocaleString('id-ID')}`;
    openModal('successModal');
}

// ===== PRINT & NEW TRANSACTION =====
function printReceipt() {
    if (!cart || cart.length === 0) { alert('Tidak ada item!'); return; }
    const total = cart.reduce((s,i) => s + i.price*i.qty, 0);
    const w = window.open('', '_blank');
    if (!w) { alert('Popup diblokir. Izinkan popup untuk cetak struk.'); return; }
    w.document.write(`<!DOCTYPE html><html><head><title>Struk</title><style>body{font-family:monospace;padding:20px;max-width:300px;margin:0 auto}h2{text-align:center}.item{display:flex;justify-content:space-between;margin:5px 0;font-size:12px}.total{border-top:2px dashed #000;padding-top:10px;margin-top:10px;font-weight:bold}.footer{text-align:center;margin-top:20px;font-size:11px;color:#666}.time{font-size:11px;color:#999;margin-bottom:10px}</style></head><body><div class="header"><strong>MIGU STORE</strong><br>Fashion Modern<br><div class="time">${new Date().toLocaleString('id-ID')}</div></div><hr>${cart.map(i=>`<div class="item"><span>${escapeHtml(i.name)} x${i.qty}</span><span>Rp ${(i.price*i.qty).toLocaleString('id-ID')}</span></div>`).join('')}<div class="total"><div class="item"><span>TOTAL</span><span>Rp ${total.toLocaleString('id-ID')}</span></div></div><div class="footer"><p>Metode: ${document.getElementById('successPayment')?.textContent||currentPayment}</p><p>Terima kasih!</p><p>Simpan struk ini.</p></div></body></html>`);
    w.document.close(); 
    setTimeout(() => { w.print(); closeModal('successModal'); }, 500);
}
function newTransaction() { closeModal('successModal'); cart = []; updateCartUI(); selectPayment('cash'); window.scrollTo({top:0, behavior:'smooth'}); }

// ===== INIT =====
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('productSearch');
    const catSelect = document.getElementById('categoryFilter');
    if (searchInput) {
        searchInput.addEventListener('input', (e) => {
            const term = e.target.value.toLowerCase();
            document.querySelectorAll('#productGrid .product-card').forEach(card => {
                const name = (card.dataset.name || '').toLowerCase();
                card.style.display = name.includes(term) ? 'block' : 'none';
            });
        });
    }
    if (catSelect) {
        catSelect.addEventListener('change', (e) => {
            const cat = e.target.value;
            document.querySelectorAll('#productGrid .product-card').forEach(card => {
                const catName = (card.querySelector('.product-category')?.textContent || '').toLowerCase();
                card.style.display = !cat || catName.includes(cat.toLowerCase()) ? 'block' : 'none';
            });
        });
    }
    @if(session('success') && session('transaction_id'))
    showSuccessModal({ invoice_code: @json(session('transaction_id')) }); cart = []; updateCartUI();
    @endif
    updateCartUI(); selectPayment('cash'); checkHeldTransaction();
    checkPendingCheckouts(); setInterval(checkPendingCheckouts, 3000);
    console.log('✅ POS initialized - modern UI with RED accent');
});

// ===== PENDING CHECKOUTS NOTIFICATION =====
let lastPendingCount = 0;
function checkPendingCheckouts() {
    fetch('/pos/confirmations/pending-count')
        .then(r => r.json())
        .then(data => {
            const count = data.count || 0;
            const badge = document.getElementById('pendingBadge');
            const display = document.getElementById('pendingCountDisplay');
            if (count > 0) {
                if (badge) {
                    badge.style.display = 'flex';
                    badge.textContent = count > 9 ? '9+' : count;
                }
                if (display) display.textContent = `${count} Pesanan Menunggu`;
                if (count > lastPendingCount) playNotificationSound();
            } else {
                if (badge) badge.style.display = 'none';
                if (display) display.textContent = 'Periksa Konfirmasi';
            }
            lastPendingCount = count;
        })
        .catch(e => console.error('Error checking pending:', e));
}
function playNotificationSound() {
    try {
        const ctx = new (window.AudioContext || window.webkitAudioContext)();
        const oscillator = ctx.createOscillator();
        const gainNode = ctx.createGain();
        oscillator.connect(gainNode); gainNode.connect(ctx.destination);
        oscillator.frequency.value = 800; oscillator.type = 'sine';
        gainNode.gain.setValueAtTime(0.3, ctx.currentTime);
        gainNode.gain.exponentialRampToValueAtTime(0.01, ctx.currentTime + 0.5);
        oscillator.start(ctx.currentTime); oscillator.stop(ctx.currentTime + 0.5);
    } catch (e) { console.log('Notification sound unavailable:', e); }
}
</script>
@endsection