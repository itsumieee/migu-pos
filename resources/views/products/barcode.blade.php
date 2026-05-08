@extends('layouts.app')

@section('page-title', 'Cetak Barcode - ' . ($product->name ?? 'Produk'))

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
}
.page-subtitle {
    font-size: 0.9rem; color: var(--text-secondary);
}

/* Print Button */
.print-btn {
    display: inline-flex; align-items: center; gap: 0.5rem;
    padding: 0.875rem 1.5rem; border-radius: var(--radius-lg);
    background: var(--accent-gradient); border: none; color: white;
    font-size: 0.9rem; font-weight: 600; cursor: pointer;
    transition: all 0.2s ease;
    box-shadow: 0 4px 20px var(--accent-glow);
}
.print-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 32px var(--accent-glow);
}
.print-btn:active { transform: translateY(0); }
.print-btn svg { width: 18px; height: 18px; }

/* ── Barcode Card (Screen View) ───────────── */
.barcode-container {
    background: var(--bg-card); border: 1px solid var(--border-color);
    border-radius: var(--radius-xl); padding: 1.75rem;
}
.barcode-grid {
    display: grid; grid-template-columns: repeat(2, 1fr); gap: 1rem;
}
@media (min-width: 768px) {
    .barcode-grid { grid-template-columns: repeat(3, 1fr); }
}

.barcode-card {
    background: var(--bg-elevated); border: 2px solid var(--border-color);
    border-radius: var(--radius-lg); padding: 1.25rem;
    text-align: center; transition: all 0.2s ease;
}
.barcode-card:hover {
    border-color: rgba(255, 51, 102, 0.3);
    box-shadow: var(--shadow-glow);
}

/* Barcode Image Wrapper */
.barcode-wrapper {
    background: white; border-radius: var(--radius-sm);
    padding: 0.75rem; margin-bottom: 0.75rem;
    display: flex; align-items: center; justify-content: center;
    min-height: 60px;
}
.barcode-wrapper img, .barcode-wrapper svg {
    max-width: 100%; height: auto;
}

/* Product Info */
.barcode-name {
    font-weight: 600; color: var(--text-primary);
    font-size: 0.85rem; margin-bottom: 0.25rem;
    line-height: 1.3; min-height: 2.4rem;
    display: -webkit-box; -webkit-line-clamp: 2;
    -webkit-box-orient: vertical; overflow: hidden;
}
.barcode-sku {
    font-size: 0.7rem; color: var(--text-muted);
    font-family: var(--font-mono); margin-bottom: 0.5rem;
}
.barcode-price {
    font-size: 1.1rem; font-weight: 700; color: var(--accent-primary); /* 🔴 RED price */
}

/* ── Print Layout ─────────────────────────── */
.print-layout {
    display: none;
}

/* ── Print Optimization ───────────────────── */
@media print {
    /* Hide screen elements */
    .no-print, .page-header, .barcode-container { display: none !important; }
    
    /* Show print layout */
    .print-layout { display: block !important; }
    
    /* Reset body for print */
    body {
        background: white; color: black;
        margin: 0; padding: 0; width: 100%;
        font-size: 10pt; font-family: monospace;
    }
    
    /* Print grid */
    .print-grid {
        display: grid; grid-template-columns: repeat(3, 1fr);
        gap: 0.5rem; width: 100%;
    }
    
    /* Print barcode card */
    .print-card {
        border: 1px solid #000; border-radius: 4px;
        padding: 0.5rem; text-align: center;
        page-break-inside: avoid;
    }
    
    /* Print barcode */
    .print-barcode {
        background: white; padding: 0.5rem;
        margin-bottom: 0.25rem;
    }
    .print-barcode img, .print-barcode svg {
        max-width: 100%; height: auto;
    }
    
    /* Print text */
    .print-name {
        font-weight: bold; font-size: 9pt;
        margin: 0.25rem 0; line-height: 1.2;
    }
    .print-price {
        font-weight: bold; font-size: 10pt;
    }
    
    /* Force black & white */
    * {
        -webkit-print-color-adjust: exact !important;
        print-color-adjust: exact !important;
    }
}

/* ── Responsive ─────────────────────────── */
@media (max-width: 640px) {
    .page-header { flex-direction: column; align-items: flex-start; }
    .print-btn { width: 100%; justify-content: center; }
    .barcode-grid { grid-template-columns: repeat(2, 1fr); }
}

/* ── Scrollbar ───────────────────────────── */
::-webkit-scrollbar { width: 5px; }
::-webkit-scrollbar-track { background: transparent; }
::-webkit-scrollbar-thumb {
    background: var(--bg-elevated); border-radius: 3px;
}
::-webkit-scrollbar-thumb:hover { background: var(--accent-primary); }

/* ── Focus States ───────────────────────── */
button:focus-visible, a:focus-visible {
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
    <div style="max-width: 1100px; margin: 0 auto;">
        
        <!-- Page Header -->
        <div class="page-header animate-slide">
            <div class="page-title-group">
                <a href="{{ route('products.index') }}" class="back-btn" title="Kembali">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>
                </a>
                <div>
                    <h1 class="page-title">Barcode Produk</h1>
                    <p class="page-subtitle">{{ $product->name ?? 'Produk' }}</p>
                </div>
            </div>
            <button type="button" onclick="window.print()" class="print-btn">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/>
                </svg>
                Cetak Barcode
            </button>
        </div>

        <!-- Screen View: Barcode Preview -->
        <div class="barcode-container animate-fade no-print">
            <div class="barcode-grid">
                @for($i = 0; $i < 6; $i++)
                <div class="barcode-card">
                    <!-- Barcode Image -->
                    <div class="barcode-wrapper">
                        @php
                            $sku = $product->sku ?? 'N/A';
                        @endphp
                        {!! DNS1D::getBarcodeHTML($sku, 'C128', 2, 50) !!}
                    </div>
                    
                    <!-- Product Info -->
                    <p class="barcode-name">{{ $product->name ?? 'Produk' }}</p>
                    <p class="barcode-sku">SKU: {{ $sku }}</p>
                    <p class="barcode-price">Rp {{ number_format($product->price ?? 0, 0, ',', '.') }}</p>
                </div>
                @endfor
            </div>
        </div>

        <!-- Print Layout (Hidden on Screen) -->
        <div class="print-layout">
            <div class="print-grid">
                @for($i = 0; $i < 12; $i++)
                <div class="print-card">
                    <div class="print-barcode">
                        @php
                            $sku = $product->sku ?? 'N/A';
                        @endphp
                        {!! DNS1D::getBarcodeHTML($sku, 'C128', 1.5, 40) !!}
                    </div>
                    <p class="print-name">{{ $product->name ?? 'Produk' }}</p>
                    <p class="print-price">Rp {{ number_format($product->price ?? 0, 0, ',', '.') }}</p>
                </div>
                @endfor
            </div>
        </div>
    </div>
</div>

<script>
// Auto-print hint after page load (optional)
document.addEventListener('DOMContentLoaded', function() {
    // Show toast hint for first-time users
    const hasPrinted = sessionStorage.getItem('barcodePrinted');
    if (!hasPrinted) {
        setTimeout(() => {
            // Optional: Show subtle hint
            console.log('💡 Tip: Klik "Cetak Barcode" atau tekan Ctrl+P untuk mencetak');
        }, 2000);
    }
});

// Track print action
window.addEventListener('beforeprint', function() {
    sessionStorage.setItem('barcodePrinted', 'true');
});
</script>

@endsection