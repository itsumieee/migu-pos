@extends('layouts.app')

@section('title', 'Kasir - Point of Sale')

@section('content')

<!-- Success/Error Alerts -->
@if(session('success'))
<div class="fixed top-4 right-4 z-50 bg-emerald-500/90 backdrop-blur-sm text-white px-6 py-4 rounded-xl shadow-lg flex items-center gap-3 animate-pulse">
    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
    <span>{{ session('success') }}</span>
    <button onclick="this.parentElement.remove()" class="ml-2 hover:opacity-70">×</button>
</div>
@endif

@if(session('error'))
<div class="fixed top-4 right-4 z-50 bg-rose-500/90 backdrop-blur-sm text-white px-6 py-4 rounded-xl shadow-lg flex items-center gap-3 animate-pulse">
    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
    <span>{{ session('error') }}</span>
    <button onclick="this.parentElement.remove()" class="ml-2 hover:opacity-70">×</button>
</div>
@endif

<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Syne:wght@700;800&display=swap" rel="stylesheet">

@verbatim
<style>
/* ── CSS Variables ─────────────────────────────────────────── */
:root {
    --c-cyan:    #22D3EE;
    --c-violet:  #818CF8;
    --c-emerald: #34D399;
    --c-rose:    #FB7185;
    --c-amber:   #FBBF24;
    --card-bg:   rgba(255,255,255,0.04);
    --card-bdr:  rgba(255,255,255,0.08);
    --card-hvr:  rgba(255,255,255,0.065);
    --row-div:   rgba(255,255,255,0.05);
    --txt1:      #F0F4FF;
    --txt2:      #8B9AB0;
    --txt3:      #4B5A6F;
}
.pos-wrap { 
    font-family:'Plus Jakarta Sans',sans-serif;
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
    text-rendering: optimizeLegibility;
}
.pos-wrap * { box-sizing:border-box; }
.f-syne { font-family:'Syne',sans-serif !important; }

/* ── Keyframes ─────────────────────────────────────────────── */
@keyframes pFadeUp {
    from { opacity:0; transform:translateY(16px); }
    to   { opacity:1; transform:translateY(0); }
}
@keyframes pSlideIn {
    from { opacity:0; transform:translateX(20px); }
    to   { opacity:1; transform:translateX(0); }
}

/* ── Animation Helpers ─────────────────────────────────────── */
.a1 { animation:pFadeUp .55s cubic-bezier(.16,1,.3,1) .05s both; }
.a2 { animation:pFadeUp .55s cubic-bezier(.16,1,.3,1) .12s both; }
.a3 { animation:pFadeUp .55s cubic-bezier(.16,1,.3,1) .20s both; }

/* ── Glass Card Base ───────────────────────────────────────── */
.pc {
    background:var(--card-bg);
    border:1px solid var(--card-bdr);
    border-radius:18px;
    position:relative;
    overflow:hidden;
    transition:background .25s,border-color .25s,transform .3s,box-shadow .3s;
}
.pc::before {
    content:''; position:absolute; inset:0; border-radius:inherit;
    background:linear-gradient(140deg,rgba(255,255,255,.05) 0%,transparent 55%);
    pointer-events:none; z-index:0;
}
.pc > * { position:relative; z-index:1; }
.pc:hover { background:var(--card-hvr); border-color:rgba(255,255,255,.14); }

/* ── Header ────────────────────────────────────────────────── */
.ph {
    position:relative; border-radius:22px; padding:2rem;
    overflow:hidden; border:1px solid rgba(255,255,255,.08);
    background:rgba(255,255,255,.03); margin-bottom:1.5rem;
}
.ph-ct { position:relative; z-index:2; }
.ph-badge {
    display:inline-flex;align-items:center;gap:7px;
    padding:5px 14px;border-radius:100px;
    background:rgba(34,211,238,.1);border:1px solid rgba(34,211,238,.25);
    font-size:11px;font-weight:700;letter-spacing:.09em;text-transform:uppercase;
    color:var(--c-cyan);margin-bottom:1rem;
}
.ph-title {
    font-family:'Syne',sans-serif;font-size:clamp(1.7rem,3.5vw,2.2rem);
    font-weight:800;line-height:1.15;color:var(--txt1);margin-bottom:.55rem;letter-spacing:-0.01em;
}
.ph-sub { 
    font-size:.88rem;
    color:var(--txt2);
    line-height:1.5;
    letter-spacing:0.3px;
}

/* ── Search & Filter ──────────────────────────────────────── */
.psf { display:flex;gap:1rem;margin-bottom:1.5rem;flex-wrap:wrap; }
.psf-search {
    flex:1;min-width:280px;position:relative;
}
.psf-input {
    width:100%;padding:1rem 1.25rem 1rem 3rem;
    background:rgba(255,255,255,0.05);
    border:1px solid rgba(255,255,255,0.1);
    border-radius:14px;
    color:var(--txt1);
    font-size:.9rem;
    font-family:'Plus Jakarta Sans',sans-serif;
    transition:all .25s;
}
.psf-input:focus {
    outline:none;
    border-color:var(--c-cyan);
    background:rgba(255,255,255,0.07);
    box-shadow:0 0 0 3px rgba(34,211,238,0.1);
}
.psf-icon {
    position:absolute;left:1rem;top:50%;transform:translateY(-50%);
    color:var(--txt3);
}
.psf-select {
    padding:1rem 1.25rem;
    background:rgba(255,255,255,0.05);
    border:1px solid rgba(255,255,255,0.1);
    border-radius:14px;
    color:var(--txt1);
    font-size:.9rem;
    font-family:'Plus Jakarta Sans',sans-serif;
    cursor:pointer;
    transition:all .25s;
}
.psf-select:focus {
    outline:none;
    border-color:var(--c-cyan);
}

/* ── Product Grid ─────────────────────────────────────────── */
.pgrid {
    display:grid;
    grid-template-columns:repeat(auto-fill,minmax(220px,1fr));
    gap:1rem;
    margin-bottom:1.5rem;
}
.pcard {
    background:rgba(255,255,255,0.04);
    border:1px solid rgba(255,255,255,0.08);
    border-radius:16px;
    padding:1.25rem;
    cursor:pointer;
    transition:all .3s cubic-bezier(.16,1,.3,1);
    position:relative;
    overflow:hidden;
}
.pcard::before {
    content:'';position:absolute;inset:0;border-radius:inherit;
    background:linear-gradient(140deg,rgba(34,211,238,.08) 0%,transparent 60%);
    opacity:0;transition:opacity .3s;pointer-events:none;
}
.pcard:hover {
    transform:translateY(-4px);
    border-color:rgba(34,211,238,0.3);
    box-shadow:0 12px 28px rgba(0,0,0,0.25);
}
.pcard:hover::before { opacity:1; }
.pcard-img {
    width:100%;aspect-ratio:1;
    background:rgba(255,255,255,0.06);
    border-radius:12px;
    margin-bottom:1rem;
    display:flex;align-items:center;justify-content:center;
    overflow:hidden;
}
.pcard-img img {
    width:100%;height:100%;object-fit:cover;
    transition:transform .3s;
}
.pcard:hover .pcard-img img { transform:scale(1.08); }
.pcard-name {
    font-size:.85rem;
    font-weight:600;
    color:var(--txt1);
    margin-bottom:.35rem;
    line-height:1.35;
    white-space:nowrap;
    overflow:hidden;
    text-overflow:ellipsis;
}
.pcard-cat {
    font-size:.72rem;
    color:var(--txt3);
    margin-bottom:.5rem;
}
.pcard-price {
    font-family:'Syne',sans-serif;
    font-size:1.05rem;
    font-weight:700;
    color:var(--c-cyan);
    line-height:1.3;
}
.pcard-stock {
    position:absolute;top:.75rem;right:.75rem;
    padding:3px 9px;
    border-radius:100px;
    font-size:10px;
    font-weight:700;
    letter-spacing:.05em;
}
.pcard-stock.ok {
    background:rgba(52,211,153,.15);
    color:var(--c-emerald);
    border:1px solid rgba(52,211,153,.25);
}
.pcard-stock.low {
    background:rgba(251,191,36,.15);
    color:var(--c-amber);
    border:1px solid rgba(251,191,36,.25);
}
.pcard-stock.out {
    background:rgba(251,113,133,.15);
    color:var(--c-rose);
    border:1px solid rgba(251,113,133,.25);
}

/* ── Cart Panel ───────────────────────────────────────────── */
.pcart {
    background:rgba(255,255,255,0.04);
    border:1px solid rgba(255,255,255,0.08);
    border-radius:18px;
    padding:1.5rem;
    position:sticky;
    top:1.5rem;
    height:fit-content;
}
.pcart-header {
    display:flex;align-items:center;justify-content:space-between;
    margin-bottom:1.25rem;
    padding-bottom:1rem;
    border-bottom:1px solid rgba(255,255,255,0.08);
}
.pcart-title {
    font-family:'Syne',sans-serif;
    font-size:1.15rem;
    font-weight:800;
    color:var(--txt1);
    line-height:1.3;
}
.pcart-count {
    padding:3px 10px;
    background:rgba(34,211,238,.15);
    border:1px solid rgba(34,211,238,.25);
    border-radius:100px;
    font-size:11px;
    font-weight:700;
    color:var(--c-cyan);
}
.pcart-items {
    max-height:420px;
    overflow-y:auto;
    margin-bottom:1.25rem;
}
.pcart-item {
    display:flex;align-items:center;gap:1rem;
    padding:1rem;
    background:rgba(255,255,255,0.03);
    border:1px solid rgba(255,255,255,0.06);
    border-radius:12px;
    margin-bottom:.75rem;
    transition:all .25s;
}
.pcart-item:hover {
    background:rgba(255,255,255,0.05);
    border-color:rgba(255,255,255,0.1);
}
.pcart-item-img {
    width:56px;height:56px;
    background:rgba(255,255,255,0.06);
    border-radius:10px;
    flex-shrink:0;
    overflow:hidden;
}
.pcart-item-img img {
    width:100%;height:100%;object-fit:cover;
}
.pcart-item-info {
    flex:1;min-width:0;
}
.pcart-item-name {
    font-size:.85rem;
    font-weight:600;
    color:var(--txt1);
    margin-bottom:.25rem;
    line-height:1.3;
    white-space:nowrap;
    overflow:hidden;
    text-overflow:ellipsis;
}
.pcart-item-price {
    font-size:.75rem;
    color:var(--c-cyan);
    font-weight:600;
}
.pcart-item-qty {
    display:flex;align-items:center;gap:.5rem;
    margin-top:.5rem;
}
.pcart-qty-btn {
    width:28px;height:28px;
    border-radius:8px;
    border:1px solid rgba(255,255,255,0.15);
    background:rgba(255,255,255,0.06);
    color:var(--txt1);
    font-size:.85rem;
    font-weight:700;
    cursor:pointer;
    display:flex;align-items:center;justify-content:center;
    transition:all .2s;
}
.pcart-qty-btn:hover {
    background:rgba(34,211,238,.15);
    border-color:var(--c-cyan);
    color:var(--c-cyan);
}
.pcart-qty-val {
    font-size:.85rem;
    font-weight:700;
    color:var(--txt1);
    min-width:28px;
    text-align:center;
}
.pcart-item-remove {
    padding:.5rem;
    color:var(--c-rose);
    cursor:pointer;
    transition:all .2s;
}
.pcart-item-remove:hover {
    transform:scale(1.15);
}
.pcart-empty {
    text-align:center;
    padding:3rem 1rem;
    color:var(--txt3);
    font-size:.85rem;
}

/* ── Cart Summary ─────────────────────────────────────────── */
.pcart-summary {
    background:rgba(255,255,255,0.03);
    border:1px solid rgba(255,255,255,0.08);
    border-radius:14px;
    padding:1.25rem;
    margin-bottom:1.25rem;
}
.pcart-row {
    display:flex;justify-content:space-between;
    margin-bottom:.75rem;
    font-size:.85rem;
}
.pcart-row-label {
    color:var(--txt2);
}
.pcart-row-val {
    font-weight:600;
    color:var(--txt1);
}
.pcart-row.total {
    padding-top:1rem;
    border-top:1px solid rgba(255,255,255,0.1);
    margin-top:1rem;
    margin-bottom:0;
}
.pcart-row.total .pcart-row-label {
    font-size:1rem;
    font-weight:700;
    color:var(--txt1);
}
.pcart-row.total .pcart-row-val {
    font-family:'Syne',sans-serif;
    font-size:1.5rem;
    font-weight:800;
    color:var(--c-cyan);
}

/* ── Payment Methods ──────────────────────────────────────── */
.ppay {
    margin-bottom:1.25rem;
}
.ppay-label {
    font-size:.75rem;
    font-weight:700;
    color:var(--txt3);
    text-transform:uppercase;
    letter-spacing:.08em;
    margin-bottom:.75rem;
}
.ppay-options {
    display:grid;
    grid-template-columns:repeat(2,1fr);
    gap:.625rem;
}
.ppay-opt {
    padding:.875rem;
    background:rgba(255,255,255,0.04);
    border:1px solid rgba(255,255,255,0.08);
    border-radius:12px;
    cursor:pointer;
    transition:all .25s;
    text-align:center;
}
.ppay-opt:hover {
    background:rgba(255,255,255,0.06);
    border-color:rgba(255,255,255,0.12);
}
.ppay-opt.active {
    background:rgba(34,211,238,.12);
    border-color:var(--c-cyan);
}
.ppay-opt-icon {
    width:32px;height:32px;
    margin:0 auto .5rem;
    border-radius:10px;
    display:flex;align-items:center;justify-content:center;
}
.ppay-opt.active .ppay-opt-icon {
    background:var(--c-cyan);
}
.ppay-opt-name {
    font-size:.75rem;
    font-weight:600;
    color:var(--txt1);
}

/* ── Checkout Button ──────────────────────────────────────── */
.pcheckout {
    width:100%;
    padding:1.125rem;
    background:linear-gradient(135deg,var(--c-cyan),#0EA5E9);
    border:none;
    border-radius:14px;
    color:#0D1627;
    font-family:'Plus Jakarta Sans',sans-serif;
    font-size:.95rem;
    font-weight:700;
    cursor:pointer;
    transition:all .3s cubic-bezier(.16,1,.3,1);
    box-shadow:0 8px 20px rgba(34,211,238,0.25);
}
.pcheckout:hover {
    transform:translateY(-2px);
    box-shadow:0 12px 28px rgba(34,211,238,0.35);
}
.pcheckout:disabled {
    opacity:.5;
    cursor:not-allowed;
    transform:none;
}

/* ── Modal ────────────────────────────────────────────────── */
.pmodal {
    position:fixed;
    inset:0;
    background:rgba(0,0,0,0.7);
    backdrop-filter:blur(8px);
    z-index:1000;
    display:flex;
    align-items:center;
    justify-content:center;
    padding:2rem;
    opacity:0;
    pointer-events:none;
    transition:opacity .3s;
}
.pmodal.active {
    opacity:1;
    pointer-events:auto;
}
.pmodal-content {
    background:#0f172a;
    border:1px solid rgba(255,255,255,0.1);
    border-radius:24px;
    padding:2.5rem;
    max-width:480px;
    width:100%;
    text-align:center;
    transform:scale(0.95);
    transition:transform .3s cubic-bezier(.16,1,.3,1);
}
.pmodal.active .pmodal-content {
    transform:scale(1);
}
.pmodal-icon {
    width:80px;height:80px;
    margin:0 auto 1.5rem;
    border-radius:50%;
    background:rgba(52,211,153,.15);
    border:2px solid var(--c-emerald);
    display:flex;align-items:center;justify-content:center;
}
.pmodal-title {
    font-family:'Syne',sans-serif;
    font-size:1.75rem;
    font-weight:800;
    color:var(--txt1);
    margin-bottom:.75rem;
}
.pmodal-text {
    font-size:.9rem;
    color:var(--txt2);
    margin-bottom:2rem;
    line-height:1.5;
}
.pmodal-actions {
    display:flex;
    gap:1rem;
}
.pmodal-btn {
    flex:1;
    padding:1rem;
    border-radius:12px;
    font-family:'Plus Jakarta Sans',sans-serif;
    font-size:.9rem;
    font-weight:700;
    cursor:pointer;
    transition:all .25s;
}
.pmodal-btn.primary {
    background:linear-gradient(135deg,var(--c-cyan),#0EA5E9);
    border:none;
    color:#0D1627;
}
.pmodal-btn.secondary {
    background:rgba(255,255,255,0.06);
    border:1px solid rgba(255,255,255,0.12);
    color:var(--txt1);
}

/* ── Hold Transaction Button ───────────────────────────── */
.phold {
    width:100%;
    padding:1.125rem;
    background:rgba(255,255,255,0.06);
    border:1px solid rgba(255,255,255,0.12);
    border-radius:14px;
    color:var(--txt1);
    font-family:'Plus Jakarta Sans',sans-serif;
    font-size:.95rem;
    font-weight:600;
    cursor:pointer;
    transition:all .3s cubic-bezier(.16,1,.3,1);
}
.phold:hover {
    background:rgba(251,191,36,.15);
    border-color:var(--c-amber);
    color:var(--c-amber);
}
.phold:disabled {
    opacity:.5;
    cursor:not-allowed;
}

/* ── Modal Glassmorphism ───────────────────────────────── */
.pmodal-glass {
    position:fixed;
    inset:0;
    background:rgba(0,0,0,0.7);
    backdrop-filter:blur(12px);
    z-index:1000;
    display:flex;
    align-items:center;
    justify-content:center;
    padding:2rem;
    opacity:0;
    pointer-events:none;
    transition:opacity .3s;
}
.pmodal-glass.active {
    opacity:1;
    pointer-events:auto;
}
.pmodal-glass-content {
    background:rgba(15,23,42,0.9);
    border:1px solid rgba(255,255,255,0.1);
    border-radius:24px;
    padding:2rem;
    width:100%;
    max-width:400px;
    transform:scale(0.95);
    transition:transform .3s cubic-bezier(.16,1,.3,1);
}
.pmodal-glass.active .pmodal-glass-content {
    transform:scale(1);
}

/* QRIS Modal Landscape */
.pmodal-qris {
    max-width:700px !important;
}
.pmodal-qris-grid {
    display:grid;
    grid-template-columns:1fr 1.2fr;
    gap:1.5rem;
    align-items:center;
}

/* Payment Option Cards */
.ppay-opt-grid {
    display:grid;
    grid-template-columns:repeat(2,1fr);
    gap:.75rem;
    margin-bottom:1.5rem;
}
.ppay-opt-card {
    padding:1rem;
    background:rgba(255,255,255,0.04);
    border:1px solid rgba(255,255,255,0.08);
    border-radius:12px;
    cursor:pointer;
    transition:all .25s;
    text-align:center;
}
.ppay-opt-card:hover {
    background:rgba(255,255,255,0.08);
    border-color:rgba(255,255,255,0.15);
}
.ppay-opt-card.active {
    background:rgba(34,211,238,.15);
    border-color:var(--c-cyan);
}
.ppay-opt-card-icon {
    width:40px;
    height:40px;
    margin:0 auto .5rem;
    border-radius:10px;
    display:flex;
    align-items:center;
    justify-content:center;
    font-weight:700;
    font-size:.7rem;
    color:#fff;
}
.ppay-opt-card-name {
    font-size:.8rem;
    font-weight:600;
    color:var(--txt1);
}

/* Info Card */
.pinfo-card {
    background:rgba(255,255,255,0.04);
    border:1px solid rgba(255,255,255,0.08);
    border-radius:12px;
    padding:1rem;
    margin-bottom:1.25rem;
}
.pinfo-card-title {
    font-size:.85rem;
    font-weight:600;
    color:var(--c-cyan);
    margin-bottom:.5rem;
    display:flex;
    align-items:center;
    gap:.5rem;
}
.pinfo-card-list {
    font-size:.75rem;
    color:var(--txt2);
    line-height:1.6;
}
.pinfo-card-list li {
    display:flex;
    gap:.5rem;
}
.pinfo-card-list li::before {
    content:"•";
    color:var(--c-cyan);
    font-weight:bold;
}

/* Held Transaction Indicator */
.pcart-held {
    margin-top:.75rem;
    padding:.75rem 1rem;
    background:rgba(251,191,36,.1);
    border:1px solid rgba(251,191,36,.2);
    border-radius:10px;
    display:flex;
    align-items:center;
    justify-content:space-between;
}
.pcart-held-text {
    font-size:.75rem;
    color:var(--c-amber);
    font-weight:500;
}
.pcart-held-btn {
    font-size:.7rem;
    color:var(--c-amber);
    font-weight:600;
    text-decoration:underline;
    cursor:pointer;
}
.pcart-held-btn:hover {
    color:var(--txt1);
}

/* Success Modal Compact */
.pmodal-success {
    max-width:320px !important;
    text-align:center;
}
.pmodal-success-icon {
    width:64px;
    height:64px;
    margin:0 auto 1rem;
    border-radius:50%;
    background:rgba(52,211,153,.15);
    border:2px solid var(--c-emerald);
    display:flex;
    align-items:center;
    justify-content:center;
}
.pmodal-success-title {
    font-size:1.25rem;
    font-weight:700;
    color:var(--txt1);
    margin-bottom:.5rem;
}
.pmodal-success-sub {
    font-size:.8rem;
    color:var(--txt2);
    margin-bottom:1.25rem;
}
.pmodal-success-details {
    background:rgba(255,255,255,0.04);
    border:1px solid rgba(255,255,255,0.08);
    border-radius:12px;
    padding:1rem;
    margin-bottom:1.5rem;
    text-align:left;
}
.pmodal-success-row {
    display:flex;
    justify-content:space-between;
    font-size:.8rem;
    margin-bottom:.5rem;
}
.pmodal-success-row:last-child {
    margin-bottom:0;
    padding-top:.75rem;
    border-top:1px solid rgba(255,255,255,0.1);
}
.pmodal-success-row-label {
    color:var(--txt2);
}
.pmodal-success-row-val {
    font-weight:600;
    color:var(--txt1);
}
.pmodal-success-row-val.total {
    font-size:1.1rem;
    color:var(--c-emerald);
}

/* Button Group */
.pmodal-actions-group {
    display:flex;
    flex-direction:column;
    gap:.75rem;
}
.pmodal-btn-full {
    width:100%;
    padding:.875rem;
    border-radius:12px;
    font-family:'Plus Jakarta Sans',sans-serif;
    font-size:.9rem;
    font-weight:600;
    cursor:pointer;
    transition:all .25s;
    display:flex;
    align-items:center;
    justify-content:center;
    gap:.5rem;
}
.pmodal-btn-full.primary {
    background:linear-gradient(135deg,var(--c-cyan),#0EA5E9);
    border:none;
    color:#0D1627;
}
.pmodal-btn-full.primary:hover {
    transform:translateY(-1px);
    box-shadow:0 8px 20px rgba(34,211,238,0.3);
}
.pmodal-btn-full.secondary {
    background:rgba(255,255,255,0.06);
    border:1px solid rgba(255,255,255,0.12);
    color:var(--txt1);
}
.pmodal-btn-full.secondary:hover {
    background:rgba(255,255,255,0.1);
}

/* Responsive for mobile */
@media (max-width: 768px) {
    .pmodal-qris-grid {
        grid-template-columns:1fr;
        text-align:center;
    }
    .pinfo-card-list li {
        justify-content:center;
    }
}
</style>
@endverbatim

<style>
    /* Fix font agar tidak gepeng - gunakan font normal */
    .pos-wrap, 
    .pos-wrap *, 
    button, 
    input, 
    select,
    h1, h2, h3, h4, h5, h6,
    p, span, label {
        font-family: ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif !important;
        font-weight: 400 !important;
        letter-spacing: normal !important;
        font-stretch: normal !important;
    }
    
    /* Keep bold for specific elements only */
    .font-bold, .font-semibold {
        font-weight: 600 !important;
    }
    
    /* Fix button text */
    button span, .payment-btn span {
        font-weight: 500 !important;
    }
</style>

<div class="pos-wrap">
    {{-- Header --}}
    <div class="ph a1">
        <div class="ph-ct">
            <div style="display: flex; justify-content: space-between; align-items: start;">
                <div>
                    <div class="ph-badge">
                        <span style="width:6px;height:6px;border-radius:50%;background:var(--c-cyan);animation:pulse 1.8s ease-in-out infinite;"></span>
                        Point of Sale
                    </div>
                    <h1 class="ph-title">Kasir - Transaksi</h1>
                    <p class="ph-sub">Pilih produk dan proses pembayaran</p>
                </div>
                <!-- Pending Checkouts Badge -->
                <a href="{{ route('pos.confirmations.index') }}" style="display: inline-flex; align-items: center; gap: 0.75rem; padding: 0.75rem 1.25rem; background: linear-gradient(135deg, rgba(34, 211, 238, 0.1) 0%, rgba(6, 182, 212, 0.05) 100%); border: 1px solid rgba(34, 211, 238, 0.2); border-radius: 12px; color: #22D3EE; text-decoration: none; font-weight: 600; font-size: 0.95rem; transition: all 0.3s; position: relative;">
                    <span style="font-size: 1.2rem;">📋</span>
                    <span id="pendingCountDisplay">Periksa Konfirmasi</span>
                    <span id="pendingBadge" style="display: none; position: absolute; top: -8px; right: -8px; background: #FB7185; color: white; width: 28px; height: 28px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: 700; font-size: 0.85rem; box-shadow: 0 4px 12px rgba(251, 113, 133, 0.3);"></span>
                </a>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        {{-- Left: Products --}}
        <div class="lg:col-span-2">
            {{-- Search & Filter --}}
            <div class="psf a2">
                <div class="psf-search">
                    <svg class="psf-icon" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="m21 21-4.35-4.35M19 11a8 8 0 1 1-16 0 8 8 0 0 1 16 0Z"/></svg>
                    <input type="text" class="psf-input" placeholder="Cari produk..." id="productSearch">
                </div>
                <select class="psf-select" id="categoryFilter">
                    <option value="">Semua Kategori</option>
                    @foreach($categories as $cat)
                    <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                    @endforeach
                </select>
            </div>

            {{-- Product Grid --}}
            <div class="pgrid a3" id="productGrid">
                @forelse($products as $product)
                <div class="pcard" onclick="addToCart({{ $product->id }})" data-product-id="{{ $product->id }}" data-name="{{ $product->name }}" data-price="{{ $product->price }}" data-stock="{{ $product->stock }}">
                    <div class="pcard-img">
                        @if($product->image)
                        <img src="{{ imageUrl($product->image) }}" alt="{{ $product->name }}">
                        @else
                        <svg width="40" height="40" fill="none" stroke="var(--txt3)" stroke-width="1.5" viewBox="0 0 24 24"><path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"/></svg>
                        @endif
                    </div>
                    <div class="pcard-name">{{ $product->name }}</div>
                    <div class="pcard-cat">{{ $product->category->name ?? 'Umum' }}</div>
                    <div class="pcard-price">Rp {{ number_format($product->price, 0, ',', '.') }}</div>
                    @if($product->stock > 5)
                    <span class="pcard-stock ok">Stok: {{ $product->stock }}</span>
                    @elseif($product->stock > 0)
                    <span class="pcard-stock low">Sisa {{ $product->stock }}</span>
                    @else
                    <span class="pcard-stock out">Habis</span>
                    @endif
                </div>
                @empty
                <div style="grid-column:1/-1;text-align:center;padding:3rem;color:var(--txt3);">
                    <svg width="48" height="48" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" style="margin:0 auto 1rem;"><path d="M20 13V6a2 2 0 0 0-2-2H6a2 2 0 0 0-2 2v7m16 0v5a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2v-5m16 0h-2.586a1 1 0 0 0-.707.293l-2.414 2.414a1 1 0 0 1-.707.293h-3.172a1 1 0 0 1-.707-.293l-2.414-2.414A1 1 0 0 0 6.586 13H4"/></svg>
                    <p>Belum ada produk</p>
                </div>
                @endforelse
            </div>
        </div>

        {{-- Right: Cart --}}
        <div class="a2">
            <div class="pcart">
                <div class="pcart-header">
                    <h3 class="pcart-title">Keranjang</h3>
                    <span class="pcart-count" id="cartCount">0 item</span>
                </div>
                
                <div class="pcart-items" id="cartItems">
                    <div class="pcart-empty">
                        <svg width="40" height="40" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" style="margin:0 auto 1rem;"><path d="M6 6h15l-1.5 9h-12z"/><circle cx="9" cy="20" r="1"/><circle cx="18" cy="20" r="1"/><path d="M6 6 5 3H2"/></svg>
                        Keranjang kosong
                    </div>
                </div>

                <div class="pcart-summary">
                    <div class="pcart-row">
                        <span class="pcart-row-label">Subtotal</span>
                        <span class="pcart-row-val" id="cartSubtotal">Rp 0</span>
                    </div>
                    <div class="pcart-row">
                        <span class="pcart-row-label">Pajak (0%)</span>
                        <span class="pcart-row-val">Rp 0</span>
                    </div>
                    <div class="pcart-row total">
                        <span class="pcart-row-label">Total</span>
                        <span class="pcart-row-val" id="cartTotal">Rp 0</span>
                    </div>
                </div>

                <div class="ppay">
                    <div class="ppay-label">Metode Pembayaran</div>
                    <div class="ppay-options">
                        <div class="ppay-opt active" onclick="selectPayment('cash')" data-payment="cash">
                            <div class="ppay-opt-icon" style="background:rgba(34,211,238,.15);color:var(--c-cyan);">
                                <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><path d="M16 8h-6a2 2 0 1 0 0 4h4a2 2 0 1 1 0 4H8"/></svg>
                            </div>
                            <div class="ppay-opt-name">Cash</div>
                        </div>
                        <div class="ppay-opt" onclick="selectPayment('qris')" data-payment="qris">
                            <div class="ppay-opt-icon" style="background:rgba(129,140,248,.15);color:var(--c-violet);">
                                <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><rect width="18" height="18" x="3" y="3" rx="2"/><path d="M3 9h18"/><path d="M9 21V9"/></svg>
                            </div>
                            <div class="ppay-opt-name">QRIS</div>
                        </div>
                        <div class="ppay-opt" onclick="selectPayment('debit')" data-payment="debit">
                            <div class="ppay-opt-icon" style="background:rgba(251,191,36,.15);color:var(--c-amber);">
                                <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><rect width="20" height="14" x="2" y="5" rx="2"/><line x1="2" x2="22" y1="10" y2="10"/></svg>
                            </div>
                            <div class="ppay-opt-name">Debit</div>
                        </div>
                        <div class="ppay-opt" onclick="selectPayment('ewallet')" data-payment="ewallet">
                            <div class="ppay-opt-icon" style="background:rgba(52,211,153,.15);color:var(--c-emerald);">
                                <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M21 12V7H5a2 2 0 0 1 0-4h14v4"/><path d="M3 5v14a2 2 0 0 0 2 2h16v-5"/><path d="M18 12a2 2 0 0 0 0 4h4v-4Z"/></svg>
                            </div>
                            <div class="ppay-opt-name">E-Wallet</div>
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex gap-3 mb-3">
                    <button onclick="openHoldModal()" class="phold" id="holdBtn" disabled>
                        <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 9v6m4-6v6m7-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        Tahan
                    </button>
                    <button class="pcheckout" id="checkoutBtn" onclick="processCheckout()" disabled>
                        Proses Pembayaran
                    </button>
                </div>

                <!-- Held Transaction Indicator -->
                <div id="heldIndicator" class="pcart-held hidden">
                    <span class="pcart-held-text">🕒 1 transaksi ditahan</span>
                    <span class="pcart-held-btn" onclick="resumeTransaction()">Lanjutkan</span>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Hold Transaction Modal -->
<div id="holdModal" class="pmodal-glass" role="dialog" aria-modal="true">
    <div class="pmodal-glass-content pmodal-success">
        <div class="pmodal-success-icon" style="background:rgba(251,191,36,.15);border-color:var(--c-amber);">
            <svg width="32" height="32" fill="none" stroke="var(--c-amber)" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 9v6m4-6v6m7-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
        </div>
        <h3 class="pmodal-success-title">Tahan Transaksi?</h3>
        <p class="pmodal-success-sub">Keranjang saat ini akan disimpan. Anda bisa melanjutkannya nanti.</p>
        <div class="pmodal-actions-group">
            <button onclick="closeHoldModal()" class="pmodal-btn-full secondary">Batal</button>
            <button onclick="saveHoldTransaction()" class="pmodal-btn-full primary">Simpan & Tahan</button>
        </div>
    </div>
</div>

<!-- QRIS Modal - Landscape -->
<div id="qrisModal" class="pmodal-glass" role="dialog" aria-modal="true">
    <div class="pmodal-glass-content pmodal-qris">
        <!-- Header -->
        <div class="flex items-center justify-between mb-6">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-cyan-500 to-blue-600 flex items-center justify-center">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm12 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z"/></svg>
                </div>
                <div>
                    <h3 class="text-lg font-bold text-white">Pembayaran QRIS</h3>
                    <p class="text-xs text-slate-400">Scan & bayar dalam hitungan detik</p>
                </div>
            </div>
            <button onclick="closeQrisModal()" class="p-2 text-slate-400 hover:text-white hover:bg-white/10 rounded-lg transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
        </div>

        <!-- Content Grid -->
        <div class="pmodal-qris-grid">
            <!-- QR Code -->
            <div class="flex flex-col items-center">
                <div class="bg-white rounded-xl p-4 shadow-lg mb-3">
                    @php
                    $qrisImage = setting('qris_image');
                    @endphp
                    @if($qrisImage)
                    <img src="{{ asset('storage/' . $qrisImage) }}" alt="QR Code" class="w-40 h-40 object-contain" id="qrisImage" onerror="console.log('QRIS image load error'); this.style.display='none';">
                    @else
                    <div class="w-40 h-40 bg-slate-100 rounded-lg flex items-center justify-center">
                        <svg class="w-12 h-12 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm12 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z"/></svg>
                    </div>
                    @endif
                </div>
                <p class="text-xs text-slate-400 text-center">Scan dengan e-wallet atau mobile banking</p>
            </div>

            <!-- Info -->
            <div class="flex flex-col justify-center">
                <div class="pinfo-card text-center mb-4">
                    <p class="text-xs text-slate-400 uppercase tracking-wider mb-1">Total Pembayaran</p>
                    <p class="text-2xl font-bold text-cyan-400" id="qrisAmount">Rp 0</p>
                </div>
                <div class="pinfo-card">
                    <p class="pinfo-card-title">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        Cara Bayar:
                    </p>
                    <ul class="pinfo-card-list" style="list-style:none;padding:0;margin:0;">
                        <li>Buka aplikasi e-wallet / m-banking</li>
                        <li>Pilih menu <strong>Scan QRIS</strong></li>
                        <li>Arahkan kamera ke QR di kiri</li>
                        <li>Konfirmasi di aplikasi Anda</li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Actions -->
        <div class="flex gap-3 mt-6">
            <button onclick="closeQrisModal()" class="flex-1 py-3 bg-slate-700 hover:bg-slate-600 text-white rounded-xl font-medium transition">Batal</button>
            <button onclick="confirmQrisPayment()" class="flex-1 py-3 bg-gradient-to-r from-cyan-500 to-blue-600 text-white rounded-xl font-semibold hover:shadow-lg hover:shadow-cyan-500/25 transition">Saya Sudah Bayar</button>
        </div>
    </div>
</div>

<!-- E-Wallet Modal -->
<div id="ewalletModal" class="pmodal-glass" role="dialog" aria-modal="true">
    <div class="pmodal-glass-content">
        <div class="flex items-center justify-between mb-5">
            <div>
                <h3 class="text-lg font-bold text-white">Pilih E-Wallet</h3>
                <p class="text-xs text-slate-400">Pilih metode pembayaran digital</p>
            </div>
            <button onclick="closeEwalletModal()" class="p-2 text-slate-400 hover:text-white hover:bg-white/10 rounded-lg transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
        </div>
        
        <div class="ppay-opt-grid">
            <!-- DANA -->
            <button class="ppay-opt-card ewallet-card" onclick="selectSubPayment('dana', this)" data-ewallet="dana">
                <div class="ppay-opt-card-icon" style="background:#118EEA;">DANA</div>
                <span class="ppay-opt-card-name">DANA</span>
            </button>
            <!-- GoPay -->
            <button class="ppay-opt-card ewallet-card" onclick="selectSubPayment('gopay', this)" data-ewallet="gopay">
                <div class="ppay-opt-card-icon" style="background:#00AA13;">GP</div>
                <span class="ppay-opt-card-name">GoPay</span>
            </button>
            <!-- OVO -->
            <button class="ppay-opt-card ewallet-card" onclick="selectSubPayment('ovo', this)" data-ewallet="ovo">
                <div class="ppay-opt-card-icon" style="background:#4C3494;">OVO</div>
                <span class="ppay-opt-card-name">OVO</span>
            </button>
            <!-- ShopeePay -->
            <button class="ppay-opt-card ewallet-card" onclick="selectSubPayment('shopeepay', this)" data-ewallet="shopeepay">
                <div class="ppay-opt-card-icon" style="background:#EE4D2D;">SP</div>
                <span class="ppay-opt-card-name">ShopeePay</span>
            </button>
        </div>

        <!-- E-Wallet Detail (shown when selected) -->
        <div id="ewalletDetail" class="hidden mt-5 p-4 bg-white/5 border border-white/10 rounded-xl">
            <div id="ewalletDetailContent"></div>
        </div>
        
        <div class="flex gap-3 mt-5">
            <button onclick="closeEwalletModal()" class="flex-1 py-3 bg-slate-700 hover:bg-slate-600 text-white rounded-xl font-medium transition">Batal</button>
            <button id="confirmEwalletBtn" onclick="confirmPayment()" class="flex-1 py-3 bg-slate-600 text-white/50 rounded-xl font-semibold transition cursor-not-allowed" disabled>Lanjut Bayar</button>
        </div>
    </div>
</div>

<!-- Debit Modal -->
<div id="debitModal" class="pmodal-glass" role="dialog" aria-modal="true">
    <div class="pmodal-glass-content">
        <div class="flex items-center justify-between mb-5">
            <div>
                <h3 class="text-lg font-bold text-white">Pilih Kartu Debit</h3>
                <p class="text-xs text-slate-400">Pilih bank penerbit kartu Anda</p>
            </div>
            <button onclick="closeDebitModal()" class="p-2 text-slate-400 hover:text-white hover:bg-white/10 rounded-lg transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
        </div>
        
        <div class="ppay-opt-grid">
            <button class="ppay-opt-card" onclick="selectSubPayment('bca', this)">
                <div class="ppay-opt-card-icon" style="background:#005EB8;">BCA</div>
                <span class="ppay-opt-card-name">BCA</span>
            </button>
            <button class="ppay-opt-card" onclick="selectSubPayment('mandiri', this)">
                <div class="ppay-opt-card-icon" style="background:#FFD700;color:#000;">MDR</div>
                <span class="ppay-opt-card-name">Mandiri</span>
            </button>
            <button class="ppay-opt-card" onclick="selectSubPayment('bni', this)">
                <div class="ppay-opt-card-icon" style="background:#006633;">BNI</div>
                <span class="ppay-opt-card-name">BNI</span>
            </button>
            <button class="ppay-opt-card" onclick="selectSubPayment('bri', this)">
                <div class="ppay-opt-card-icon" style="background:#0066CC;">BRI</div>
                <span class="ppay-opt-card-name">BRI</span>
            </button>
        </div>
        
        <div class="flex gap-3">
            <button onclick="closeDebitModal()" class="flex-1 py-3 bg-slate-700 hover:bg-slate-600 text-white rounded-xl font-medium transition">Batal</button>
            <button id="confirmDebitBtn" onclick="confirmPayment()" class="flex-1 py-3 bg-slate-600 text-white/50 rounded-xl font-semibold transition cursor-not-allowed" disabled>Lanjut Bayar</button>
        </div>
    </div>
</div>

<!-- Success Modal - Compact -->
<div id="successModal" class="pmodal-glass" role="dialog" aria-modal="true">
    <div class="pmodal-glass-content pmodal-success">
        <div class="pmodal-success-icon">
            <svg class="w-8 h-8 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
        </div>
        <h3 class="pmodal-success-title">✅ Transaksi Berhasil!</h3>
        <p class="pmodal-success-sub">No. Invoice: <span id="successInvoice" class="text-cyan-400">#INV-00000</span></p>
        
        <div class="pmodal-success-details">
            <div class="pmodal-success-row">
                <span class="pmodal-success-row-label">Metode</span>
                <span class="pmodal-success-row-val" id="successPayment">Cash</span>
            </div>
            <div class="pmodal-success-row">
                <span class="pmodal-success-row-label">Waktu</span>
                <span class="pmodal-success-row-val" id="successTime">--:--</span>
            </div>
            <div class="pmodal-success-row">
                <span class="pmodal-success-row-label">Total</span>
                <span class="pmodal-success-row-val total" id="successTotal">Rp 0</span>
            </div>
        </div>
        
        <div class="pmodal-actions-group">
            <button onclick="printReceipt()" class="pmodal-btn-full primary">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/></svg>
                Cetak Struk
            </button>
            <button onclick="newTransaction()" class="pmodal-btn-full secondary">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/></svg>
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
    if (!modal) {
        console.error('Modal not found:', modalId);
        return;
    }
    
    // 1. Remove 'hidden' first to make element visible
    modal.classList.remove('hidden');
    
    // 2. Force reflow so browser recognizes the change
    void modal.offsetWidth;
    
    // 3. Add 'active' class to trigger fade-in animation
    modal.classList.add('active');
    
    // 4. Animate content
    const content = modal.querySelector('.pmodal-glass-content');
    if (content) {
        content.classList.remove('scale-95', 'opacity-0');
        content.classList.add('scale-100', 'opacity-100');
    }
    
    // 5. Prevent background scroll
    document.body.style.overflow = 'hidden';
}

function closeModal(modalId) {
    const modal = document.getElementById(modalId);
    if (!modal) return;
    
    // 1. Remove 'active' to trigger fade-out
    modal.classList.remove('active');
    
    // 2. Animate content out
    const content = modal.querySelector('.pmodal-glass-content');
    if (content) {
        content.classList.remove('scale-100', 'opacity-100');
        content.classList.add('scale-95', 'opacity-0');
    }
    
    // 3. Wait for animation, then hide with 'hidden' class
    setTimeout(() => {
        modal.classList.add('hidden');
        document.body.style.overflow = '';
    }, 300); // Match CSS transition duration
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
        els.items.innerHTML = `<div class="pcart-empty text-center py-8"><svg class="w-10 h-10 mx-auto mb-2 text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/></svg><p class="text-sm text-slate-400">Keranjang kosong</p></div>`;
        if (els.checkout) els.checkout.disabled = true;
    } else {
        els.items.innerHTML = cart.map(item => `
            <div class="pcart-item flex gap-3 bg-slate-700/30 rounded-xl p-3">
                <div class="pcart-item-img w-14 h-14 bg-slate-600/50 rounded-lg flex-shrink-0 overflow-hidden">
                    ${item.image ? `<img src="${item.image}" class="w-full h-full object-cover">` : `<svg class="w-6 h-6 text-slate-400 m-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>`}
                </div>
                <div class="pcart-item-info flex-1 min-w-0">
                    <div class="pcart-item-name font-medium text-white text-sm truncate">${escapeHtml(item.name)}</div>
                    <div class="pcart-item-price text-xs text-cyan-400 font-medium">Rp ${item.price.toLocaleString('id-ID')}</div>
                    <div class="pcart-item-qty flex items-center gap-2 mt-2">
                        <button class="pcart-qty-btn w-6 h-6 rounded bg-slate-600 hover:bg-slate-500 flex items-center justify-center text-white text-sm font-bold" onclick="updateQty(${item.id}, -1)">−</button>
                        <span class="pcart-qty-val text-sm font-medium text-white w-6 text-center">${item.qty}</span>
                        <button class="pcart-qty-btn w-6 h-6 rounded bg-slate-600 hover:bg-slate-500 flex items-center justify-center text-white text-sm font-bold" onclick="updateQty(${item.id}, 1)">+</button>
                    </div>
                </div>
                <button class="pcart-item-remove text-rose-400 hover:text-rose-300 transition self-start p-1" onclick="removeFromCart(${item.id})">
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
    const div = document.createElement('div');
    div.textContent = text;
    return div.innerHTML;
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
    item.qty = newQty;
    updateCartUI();
}

function removeFromCart(productId) {
    cart = cart.filter(i => i.id != productId);
    updateCartUI();
}

// ===== PAYMENT SELECTION =====
function selectPayment(method) {
    currentPayment = method;
    selectedSubPayment = null;
    
    document.querySelectorAll('.ppay-opt').forEach(opt => {
        opt.classList.toggle('active', opt.dataset.payment === method);
    });
    
    document.querySelectorAll('.ppay-opt-card').forEach(btn => btn.classList.remove('active'));
    
    ['confirmEwalletBtn', 'confirmDebitBtn'].forEach(id => {
        const btn = document.getElementById(id);
        if (btn) {
            btn.disabled = true;
            btn.className = 'flex-1 py-3 bg-slate-600 text-white/50 rounded-xl font-semibold transition cursor-not-allowed';
        }
    });
}

function selectSubPayment(value, btn) {
    selectedSubPayment = value;
    btn.parentElement.querySelectorAll('.ppay-opt-card').forEach(b => b.classList.remove('active'));
    btn.classList.add('active');
    
    // Show e-wallet details
    showEwalletDetail(value);
    
    const confirmBtn = currentPayment === 'ewallet' ? document.getElementById('confirmEwalletBtn') : document.getElementById('confirmDebitBtn');
    if (confirmBtn) {
        confirmBtn.disabled = false;
        confirmBtn.className = 'flex-1 py-3 bg-gradient-to-r from-cyan-500 to-blue-600 text-white rounded-xl font-semibold transition hover:shadow-lg hover:shadow-cyan-500/25';
    }
}

// E-Wallet Details Data
const ewalletData = {
    dana: {
        name: 'DANA',
        color: '#118EEA',
        number: '{{ setting("ewallet_dana_number") }}',
        description: '{{ setting("ewallet_dana_description") }}'
    },
    gopay: {
        name: 'GoPay',
        color: '#00AA13',
        number: '{{ setting("ewallet_gopay_number") }}',
        description: '{{ setting("ewallet_gopay_description") }}'
    },
    ovo: {
        name: 'OVO',
        color: '#4C3494',
        number: '{{ setting("ewallet_ovo_number") }}',
        description: '{{ setting("ewallet_ovo_description") }}'
    },
    shopeepay: {
        name: 'ShopeePay',
        color: '#EE4D2D',
        number: '{{ setting("ewallet_shopeepay_number") }}',
        description: '{{ setting("ewallet_shopeepay_description") }}'
    }
};

function showEwalletDetail(ewallet) {
    const detail = ewalletData[ewallet];
    const detailDiv = document.getElementById('ewalletDetail');
    const contentDiv = document.getElementById('ewalletDetailContent');
    
    if (detail) {
        contentDiv.innerHTML = `
            <div class="text-center">
                <p class="text-xs text-slate-400 uppercase tracking-wider mb-2">Informasi Pembayaran</p>
                <p class="text-sm font-semibold text-white mb-3">${detail.name}</p>
                <div class="bg-white/5 p-3 rounded-lg mb-3">
                    <p class="text-xs text-slate-400 mb-1">Nomor/ID:</p>
                    <p class="text-lg font-mono font-bold text-cyan-400">${detail.number}</p>
                </div>
                <div class="bg-white/5 p-3 rounded-lg">
                    <p class="text-xs text-slate-400 mb-1">Instruksi:</p>
                    <p class="text-sm text-white">${detail.description}</p>
                </div>
            </div>
        `;
        detailDiv.classList.remove('hidden');
    } else {
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
    } else if (currentPayment === 'ewallet') {
        openModal('ewalletModal');
    } else if (currentPayment === 'debit') {
        openModal('debitModal');
    } else {
        submitForm(total);
    }
}

function confirmQrisPayment() {
    closeModal('qrisModal');
    const total = cart.reduce((s, i) => s + (i.price * i.qty), 0);
    submitForm(total);
}

function confirmPayment() {
    const modalId = currentPayment === 'ewallet' ? 'ewalletModal' : 'debitModal';
    closeModal(modalId);
    const total = cart.reduce((s, i) => s + (i.price * i.qty), 0);
    submitForm(total);
}

// ===== FORM SUBMISSION (SIMPLE) =====
function submitForm(total) {
    const form = document.createElement('form');
    form.method = 'POST';
    form.action = '/pos/checkout';
    
    const csrf = document.querySelector('meta[name="csrf-token"]')?.content;
    if (csrf) {
        const token = document.createElement('input');
        token.type = 'hidden';
        token.name = '_token';
        token.value = csrf;
        form.appendChild(token);
    }
    
    const cartInput = document.createElement('input');
    cartInput.type = 'hidden';
    cartInput.name = 'cart_items';
    cartInput.value = JSON.stringify(cart);
    form.appendChild(cartInput);
    
    const paymentInput = document.createElement('input');
    paymentInput.type = 'hidden';
    paymentInput.name = 'payment_method';
    paymentInput.value = currentPayment;
    form.appendChild(paymentInput);
    
    if (selectedSubPayment) {
        const subInput = document.createElement('input');
        subInput.type = 'hidden';
        subInput.name = 'sub_payment';
        subInput.value = selectedSubPayment;
        form.appendChild(subInput);
    }
    
    const totalInput = document.createElement('input');
    totalInput.type = 'hidden';
    totalInput.name = 'total_amount';
    totalInput.value = total;
    form.appendChild(totalInput);
    
    document.body.appendChild(form);
    form.submit();
}

// ===== HOLD TRANSACTION (Client-side only with sessionStorage) =====
function openHoldModal() {
    if (!cart || cart.length === 0) { alert('Keranjang kosong!'); return; }
    openModal('holdModal');
}

function closeHoldModal() {
    closeModal('holdModal');
}

function saveHoldTransaction() {
    try {
        if (!cart || cart.length === 0) { alert('Keranjang kosong!'); return; }
        sessionStorage.setItem('heldCart', JSON.stringify(cart));
        cart = [];
        updateCartUI();
        closeHoldModal();
        
        const indicator = document.getElementById('heldIndicator');
        if (indicator) indicator.classList.remove('hidden');
        alert('✅ Transaksi berhasil ditahan!');
    } catch (e) {
        console.error('Hold error:', e);
        alert('Gagal menahan transaksi.');
    }
}

function checkHeldTransaction() {
    try {
        if (sessionStorage.getItem('heldCart')) {
            const indicator = document.getElementById('heldIndicator');
            if (indicator) indicator.classList.remove('hidden');
        }
    } catch (e) { console.warn('SessionStorage blocked:', e); }
}

function resumeTransaction() {
    try {
        const heldData = sessionStorage.getItem('heldCart');
        if (!heldData) { alert('Tidak ada transaksi tertahan.'); return; }
        const held = JSON.parse(heldData);
        if (!Array.isArray(held) || held.length === 0) { alert('Data tidak valid.'); return; }
        if (cart.length > 0 && !confirm('Keranjang saat ini akan diganti. Lanjutkan?')) return;
        
        cart = held;
        sessionStorage.removeItem('heldCart');
        
        const indicator = document.getElementById('heldIndicator');
        if (indicator) indicator.classList.add('hidden');
        updateCartUI();
    } catch (e) {
        console.error('Resume error:', e);
        alert('Gagal melanjutkan transaksi.');
    }
}

// ===== SUCCESS MODAL (shown via Laravel session) =====
function showSuccessModal(txn) {
    const modal = document.getElementById('successModal');
    if (!modal) return;
    
    const els = {
        invoice: document.getElementById('successInvoice'),
        payment: document.getElementById('successPayment'),
        time: document.getElementById('successTime'),
        total: document.getElementById('successTotal')
    };
    
    if (els.invoice) els.invoice.textContent = txn?.invoice_code || '#INV-' + Date.now().toString().slice(-6);
    if (els.payment) {
        els.payment.textContent = {cash:'Tunai', qris:'QRIS', debit:'Debit Card', ewallet:'E-Wallet'}[currentPayment] || currentPayment;
    }
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
    w.document.write(`<!DOCTYPE html><html><head><title>Struk</title><style>body{font-family:monospace;padding:20px;max-width:300px;margin:0 auto}h2{text-align:center}.item{display:flex;justify-content:space-between;margin:5px 0;font-size:12px}.total{border-top:2px dashed #000;padding-top:10px;margin-top:10px;font-weight:bold}.footer{text-align:center;margin-top:20px;font-size:11px;color:#666}.time{font-size:11px;color:#999;margin-bottom:10px}</style></head><body><div class="header"><strong>MIGU STORE</strong><br>Fashion Modern<br><div class="time">${new Date().toLocaleString('id-ID')}</div></div><hr>${cart.map(i=>`<div class="item"><span>${escapeHtml(i.name)} x${i.qty}</span><span>Rp ${(i.price*i.qty).toLocaleString('id-ID')}</span></div>`).join('')}<div class="total"><div class="item"><span>TOTAL</span><span>Rp ${total.toLocaleString('id-ID')}</span></div></div><div class="footer"><p>Metode: ${document.getElementById('successPayment')?.textContent||currentPayment}</p><p>Terima kasih!</p><p>Simpan struk ini.</p></div></body></html>`);
    w.document.close();
    w.print();
    closeModal('successModal');
}

function newTransaction() {
    closeModal('successModal');
    cart = [];
    updateCartUI();
    selectPayment('cash');
    window.scrollTo({top:0, behavior:'smooth'});
}

// ===== INIT =====
document.addEventListener('DOMContentLoaded', function() {
    // Search/Filter
    const searchInput = document.getElementById('productSearch');
    const catSelect = document.getElementById('categoryFilter');
    
    if (searchInput) {
        searchInput.addEventListener('input', (e) => {
            const term = e.target.value.toLowerCase();
            document.querySelectorAll('#productGrid .pcard').forEach(card => {
                const name = (card.dataset.name || '').toLowerCase();
                card.style.display = name.includes(term) ? 'block' : 'none';
            });
        });
    }
    if (catSelect) {
        catSelect.addEventListener('change', (e) => {
            const cat = e.target.value;
            document.querySelectorAll('#productGrid .pcard').forEach(card => {
                const catName = (card.querySelector('.pcard-cat')?.textContent || '').toLowerCase();
                card.style.display = !cat || catName.includes(cat.toLowerCase()) ? 'block' : 'none';
            });
        });
    }
    
    // Check for success message from Laravel session
    @if(session('success') && session('transaction_id'))
    showSuccessModal({ invoice_code: @json(session('transaction_id')) });
    cart = [];
    updateCartUI();
    @endif
    
    // Init
    updateCartUI();
    selectPayment('cash');
    checkHeldTransaction();
    
    // Polling for pending checkout count
    checkPendingCheckouts();
    setInterval(checkPendingCheckouts, 3000); // Check every 3 seconds
    
    console.log('✅ POS initialized - modals fixed');
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
                badge.style.display = 'flex';
                badge.textContent = count > 9 ? '9+' : count;
                display.textContent = `${count} Pesanan Menunggu`;
                
                // Play sound if count increased
                if (count > lastPendingCount) {
                    playNotificationSound();
                }
            } else {
                badge.style.display = 'none';
                display.textContent = 'Periksa Konfirmasi';
            }
            
            lastPendingCount = count;
        })
        .catch(e => console.error('Error checking pending:', e));
}

function playNotificationSound() {
    // Create a simple beep sound using Web Audio API
    try {
        const ctx = new (window.AudioContext || window.webkitAudioContext)();
        const oscillator = ctx.createOscillator();
        const gainNode = ctx.createGain();
        
        oscillator.connect(gainNode);
        gainNode.connect(ctx.destination);
        
        oscillator.frequency.value = 800;
        oscillator.type = 'sine';
        
        gainNode.gain.setValueAtTime(0.3, ctx.currentTime);
        gainNode.gain.exponentialRampToValueAtTime(0.01, ctx.currentTime + 0.5);
        
        oscillator.start(ctx.currentTime);
        oscillator.stop(ctx.currentTime + 0.5);
    } catch (e) {
        console.log('Notification sound unavailable:', e);
    }
}
</script>
@endsection