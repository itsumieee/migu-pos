@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
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
.dash-wrap { 
    font-family:'Plus Jakarta Sans',sans-serif;
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
    text-rendering: optimizeLegibility;
}
.dash-wrap * { box-sizing:border-box; }
.f-syne { font-family:'Syne',sans-serif !important; }

/* ── Keyframes ─────────────────────────────────────────────── */
@keyframes dFadeUp {
    from { opacity:0; transform:translateY(16px); }
    to   { opacity:1; transform:translateY(0); }
}
@keyframes dOrb {
    0%,100% { transform:translate(0,0) scale(1); }
    40%     { transform:translate(22px,-32px) scale(1.07); }
    70%     { transform:translate(-16px,16px) scale(.94); }
}
@keyframes dPulse {
    0%,100% { opacity:1; }
    50%     { opacity:.25; }
}

/* ── Animation Helpers ─────────────────────────────────────── */
.a1 { animation:dFadeUp .55s cubic-bezier(.16,1,.3,1) .05s both; }
.a2 { animation:dFadeUp .55s cubic-bezier(.16,1,.3,1) .12s both; }
.a3 { animation:dFadeUp .55s cubic-bezier(.16,1,.3,1) .20s both; }
.a4 { animation:dFadeUp .55s cubic-bezier(.16,1,.3,1) .28s both; }
.a5 { animation:dFadeUp .55s cubic-bezier(.16,1,.3,1) .36s both; }
.a6 { animation:dFadeUp .55s cubic-bezier(.16,1,.3,1) .44s both; }

/* ── Glass Card Base ───────────────────────────────────────── */
.dc {
    background:var(--card-bg);
    border:1px solid var(--card-bdr);
    border-radius:18px;
    position:relative;
    overflow:hidden;
    transition:background .25s,border-color .25s,transform .3s,box-shadow .3s;
}
.dc::before {
    content:''; position:absolute; inset:0; border-radius:inherit;
    background:linear-gradient(140deg,rgba(255,255,255,.05) 0%,transparent 55%);
    pointer-events:none; z-index:0;
}
.dc > * { position:relative; z-index:1; }
.dc:hover { background:var(--card-hvr); border-color:rgba(255,255,255,.14); transform:translateY(-2px); box-shadow:0 20px 40px rgba(0,0,0,.28); }
.dc:hover .dsi { transform:scale(1.1) rotate(-6deg); }

/* ── Hero ──────────────────────────────────────────────────── */
.dh {
    position:relative; border-radius:22px; padding:2.5rem;
    overflow:hidden; border:1px solid rgba(255,255,255,.08);
    background:rgba(255,255,255,.03); margin-bottom:1.5rem;
}
.dh-grid {
    position:absolute; inset:0; pointer-events:none;
    background-image:linear-gradient(rgba(255,255,255,.03) 1px,transparent 1px),
                     linear-gradient(90deg,rgba(255,255,255,.03) 1px,transparent 1px);
    background-size:44px 44px;
    -webkit-mask-image:radial-gradient(ellipse 70% 70% at 100% 0%,black 20%,transparent 70%);
    mask-image:radial-gradient(ellipse 70% 70% at 100% 0%,black 20%,transparent 70%);
}
.dh-orb { position:absolute; border-radius:50%; pointer-events:none; filter:blur(70px); animation:dOrb 14s ease-in-out infinite; }
.dh-o1  { width:360px;height:360px;top:-130px;right:-90px;background:radial-gradient(circle,rgba(34,211,238,.22),transparent 65%); }
.dh-o2  { width:280px;height:280px;bottom:-110px;left:-70px;background:radial-gradient(circle,rgba(129,140,248,.18),transparent 65%);animation-delay:-6s; }
.dh-o3  { width:180px;height:180px;top:30%;left:38%;background:radial-gradient(circle,rgba(52,211,153,.1),transparent 65%);animation-delay:-10s; }
.dh-ct  { position:relative; z-index:2; }

/* Hero badge */
.dh-badge {
    display:inline-flex;align-items:center;gap:7px;
    padding:5px 14px;border-radius:100px;
    background:rgba(34,211,238,.1);border:1px solid rgba(34,211,238,.25);
    font-size:11px;font-weight:700;letter-spacing:.09em;text-transform:uppercase;
    color:var(--c-cyan);margin-bottom:1rem;
}
.dh-dot { width:6px;height:6px;border-radius:50%;background:var(--c-cyan);animation:dPulse 1.8s ease-in-out infinite; }
.dh-title {
    font-family:'Syne',sans-serif;font-size:clamp(1.7rem,3.5vw,2.5rem);
    font-weight:800;line-height:1.15;color:var(--txt1);margin-bottom:.55rem;letter-spacing:-0.01em;
}
.dh-sub { 
    font-size:.88rem;
    color:var(--txt2);
    line-height:1.5;
    letter-spacing:0.3px;
}
.dh-sub strong { color:rgba(240,244,255,.9);font-weight:600; }
.dh-sep { height:1px;background:rgba(255,255,255,.08);margin:1.6rem 0; }

/* Hero stats */
.dh-stats { display:flex;align-items:center;flex-wrap:wrap; }
.dh-stat  { display:flex;align-items:center;gap:.75rem;padding-right:2rem; }
.dh-stat + .dh-stat { padding-left:2rem;border-left:1px solid rgba(255,255,255,.08); }
.dh-si { width:46px;height:46px;border-radius:13px;display:flex;align-items:center;justify-content:center;flex-shrink:0; }
.dh-si.c { background:rgba(34,211,238,.12);border:1px solid rgba(34,211,238,.22); }
.dh-si.v { background:rgba(129,140,248,.12);border:1px solid rgba(129,140,248,.22); }
.dh-sl { 
    font-size:9px;
    font-weight:700;
    letter-spacing:.1em;
    text-transform:uppercase;
    color:var(--txt3);
    margin-bottom:3px;
    line-height:1.4;
}
.dh-sv { 
    font-family:'Syne',sans-serif;
    font-size:1.15rem;
    font-weight:700;
    color:var(--txt1);
    line-height:1.3;
}

/* ── Stat Card ─────────────────────────────────────────────── */
.dsc { padding:1.4rem 1.5rem; }
.dsc-top { display:flex;align-items:flex-start;justify-content:space-between;margin-bottom:.875rem; }
.dsc-lbl { 
    font-size:10px;
    font-weight:700;
    letter-spacing:.09em;
    text-transform:uppercase;
    color:var(--txt3);
    margin-bottom:.4rem;
    line-height:1.4;
}
.dsc-val { 
    font-family:'Syne',sans-serif;
    font-size:1.85rem;
    font-weight:800;
    line-height:1.2;
    letter-spacing:-0.02em;
    color:var(--txt1); 
}
.dsc-val.rose    { color:var(--c-rose); }
.dsc-val.emerald { color:var(--c-emerald);font-size:1.35rem; }
.dsc-val.violet  { color:var(--c-violet); }

/* ── Stat Icon ─────────────────────────────────────────────── */
.dsi { width:46px;height:46px;border-radius:13px;display:flex;align-items:center;justify-content:center;flex-shrink:0;transition:transform .35s cubic-bezier(.34,1.56,.64,1); }
.dsi.c { background:rgba(34,211,238,.1);border:1px solid rgba(34,211,238,.2);color:var(--c-cyan); }
.dsi.r { background:rgba(251,113,133,.1);border:1px solid rgba(251,113,133,.2);color:var(--c-rose); }
.dsi.e { background:rgba(52,211,153,.1);border:1px solid rgba(52,211,153,.2);color:var(--c-emerald); }
.dsi.v { background:rgba(129,140,248,.1);border:1px solid rgba(129,140,248,.2);color:var(--c-violet); }

/* ── Pills ─────────────────────────────────────────────────── */
.pl { 
    display:inline-flex;
    align-items:center;
    gap:3px;
    padding:3px 9px;
    border-radius:100px;
    font-size:11px;
    font-weight:700;
    line-height:1.4;
}
.pl-up { background:rgba(52,211,153,.12);color:var(--c-emerald);border:1px solid rgba(52,211,153,.2); }
.pl-dn { background:rgba(251,113,133,.12);color:var(--c-rose);border:1px solid rgba(251,113,133,.2); }
.pl-wn { background:rgba(251,191,36,.12);color:var(--c-amber);border:1px solid rgba(251,191,36,.2); }
.ft { font-size:11px;color:var(--txt3);font-weight:500;line-height:1.4; }

/* ── Section Header ────────────────────────────────────────── */
.dsh { display:flex;align-items:center;gap:.7rem; }
.dsi2 { width:34px;height:34px;border-radius:9px;display:flex;align-items:center;justify-content:center;flex-shrink:0; }
.dst { 
    font-family:'Syne',sans-serif;
    font-size:1.05rem;
    font-weight:800;
    color:var(--txt1);
    line-height:1.3;
    letter-spacing:-0.01em;
}
.dss { 
    font-size:.75rem;
    color:var(--txt3);
    margin-top:1px;
    line-height:1.4;
    letter-spacing:0.2px;
}

/* ── Chart Toggle ──────────────────────────────────────────── */
.dtg { display:flex;background:rgba(255,255,255,.05);border:1px solid rgba(255,255,255,.08);border-radius:9px;padding:3px;gap:2px; }
.dtg button { 
    padding:5px 14px;
    border-radius:7px;
    font-size:11px;
    font-weight:700;
    border:none;
    cursor:pointer;
    transition:all .22s;
    color:var(--txt3);
    background:transparent;
    font-family:'Plus Jakarta Sans',sans-serif;
    line-height:1.4;
    letter-spacing:0.3px;
}
.dtg button.on { background:rgba(34,211,238,.12);color:var(--c-cyan);border:1px solid rgba(34,211,238,.2); }

/* ── Chart Summary ─────────────────────────────────────────── */
.dcs { background:rgba(255,255,255,.03);border:1px solid rgba(255,255,255,.06);border-radius:12px;padding:.875rem 1rem;text-align:center;transition:background .22s,border-color .22s; }
.dcs:hover { background:rgba(255,255,255,.05);border-color:rgba(255,255,255,.1); }
.dcsl { font-size:9px;font-weight:700;letter-spacing:.09em;text-transform:uppercase;color:var(--txt3);margin-bottom:5px;line-height:1.4; }
.dcsv { font-family:'Syne',sans-serif;font-size:1.05rem;font-weight:800;line-height:1.3; }

/* ── Canvas Wrap ───────────────────────────────────────────── */
.dcw { position:relative;background:rgba(255,255,255,.02);border:1px solid rgba(255,255,255,.06);border-radius:14px;padding:.875rem; }

/* ── Category Row ──────────────────────────────────────────── */
.dcat { display:flex;align-items:center;justify-content:space-between;padding:.55rem .75rem;border-radius:9px;transition:background .18s; }
.dcat:hover { background:rgba(255,255,255,.04); }
.dcat-d { width:8px;height:8px;border-radius:50%;flex-shrink:0; }
.dcat-n { font-size:.8rem;font-weight:500;color:var(--txt2);line-height:1.4; }
.dcat-b { font-size:.75rem;font-weight:700;color:var(--txt1);background:rgba(255,255,255,.07);border:1px solid rgba(255,255,255,.08);border-radius:6px;padding:2px 10px;line-height:1.4; }

/* ── Product Row ───────────────────────────────────────────── */
.dpr { display:flex;align-items:center;gap:.875rem;padding:.875rem 1.25rem;transition:background .18s; }
.dpr:hover { background:rgba(255,255,255,.03); }
.dpr-rk { width:36px;height:36px;border-radius:10px;display:flex;align-items:center;justify-content:center;font-family:'Syne',sans-serif;font-weight:800;font-size:.85rem;flex-shrink:0; }
.rk-g { background:linear-gradient(135deg,#F59E0B,#D97706);color:#fff;box-shadow:0 4px 12px rgba(245,158,11,.28); }
.rk-s { background:linear-gradient(135deg,#94A3B8,#64748B);color:#fff; }
.rk-b { background:linear-gradient(135deg,#CD7F32,#9A5A1C);color:#fff; }
.rk-n { background:rgba(255,255,255,.06);color:var(--txt3);border:1px solid rgba(255,255,255,.08); }
.dpr-nm { font-size:.85rem;font-weight:600;color:var(--txt1);white-space:nowrap;overflow:hidden;text-overflow:ellipsis;line-height:1.4; }
.dpr-sl { font-size:.72rem;color:var(--txt3);margin-top:1px;line-height:1.4;letter-spacing:0.2px; }
.dpr-pr { font-size:.85rem;font-weight:700;color:var(--c-cyan);white-space:nowrap;margin-left:auto;flex-shrink:0;line-height:1.4; }

/* ── Transaction Row ───────────────────────────────────────── */
.dtr { padding:.875rem 1.25rem;transition:background .18s; }
.dtr:hover { background:rgba(255,255,255,.03); }
.dtr-id { font-family:'Syne',sans-serif;font-size:.8rem;font-weight:700;color:var(--txt1);line-height:1.4; }
.dtr-tm { font-size:.72rem;color:var(--txt3);line-height:1.4;letter-spacing:0.2px; }
.dtr-av { width:24px;height:24px;border-radius:50%;background:linear-gradient(135deg,var(--c-violet),var(--c-cyan));display:flex;align-items:center;justify-content:center;font-size:9px;font-weight:800;color:#fff;flex-shrink:0; }
.dtr-us { font-size:.78rem;color:var(--txt2);font-weight:500;line-height:1.4; }
.dtr-am { font-size:.88rem;font-weight:700;color:var(--c-emerald);line-height:1.4; }

/* ── Quick Action ──────────────────────────────────────────── */
.dqa { display:flex;flex-direction:column;align-items:flex-start;padding:1.25rem;border-radius:15px;border:1px solid rgba(255,255,255,.08);background:rgba(255,255,255,.04);text-decoration:none;transition:all .3s cubic-bezier(.16,1,.3,1);position:relative;overflow:hidden; }
.dqa::after { content:'';position:absolute;inset:0;opacity:0;transition:opacity .3s;border-radius:inherit; }
.dqa:hover { transform:translateY(-4px);border-color:rgba(255,255,255,.15); }
.dqa:hover::after { opacity:1; }
.dqa:hover .dqa-ar { opacity:1;transform:translate(0,0); }
.dqa:hover .dqa-ic { transform:scale(1.1) rotate(-8deg); }
.dqa.c::after  { background:linear-gradient(135deg,rgba(34,211,238,.1),transparent 60%); }
.dqa.v::after  { background:linear-gradient(135deg,rgba(129,140,248,.1),transparent 60%); }
.dqa.e::after  { background:linear-gradient(135deg,rgba(52,211,153,.1),transparent 60%); }
.dqa.a::after  { background:linear-gradient(135deg,rgba(251,191,36,.1),transparent 60%); }
.dqa.c:hover   { box-shadow:0 16px 32px rgba(34,211,238,.12); }
.dqa.v:hover   { box-shadow:0 16px 32px rgba(129,140,248,.12); }
.dqa.e:hover   { box-shadow:0 16px 32px rgba(52,211,153,.12); }
.dqa.a:hover   { box-shadow:0 16px 32px rgba(251,191,36,.12); }
.dqa-ic { width:44px;height:44px;border-radius:12px;display:flex;align-items:center;justify-content:center;margin-bottom:.875rem;transition:transform .35s cubic-bezier(.34,1.56,.64,1);position:relative;z-index:1; }
.dqa-ic.c { background:rgba(34,211,238,.12);border:1px solid rgba(34,211,238,.22);color:var(--c-cyan); }
.dqa-ic.v { background:rgba(129,140,248,.12);border:1px solid rgba(129,140,248,.22);color:var(--c-violet); }
.dqa-ic.e { background:rgba(52,211,153,.12);border:1px solid rgba(52,211,153,.22);color:var(--c-emerald); }
.dqa-ic.a { background:rgba(251,191,36,.12);border:1px solid rgba(251,191,36,.22);color:var(--c-amber); }
.dqa-tt { font-size:.88rem;font-weight:700;color:var(--txt1);margin-bottom:2px;position:relative;z-index:1;line-height:1.4; }
.dqa-ds { font-size:.75rem;color:var(--txt3);position:relative;z-index:1;line-height:1.4;letter-spacing:0.2px; }
.dqa-ar { position:absolute;top:.875rem;right:.875rem;color:var(--txt3);opacity:0;transform:translate(-4px,4px);transition:opacity .22s,transform .22s; }

/* ── See All ───────────────────────────────────────────────── */
.dsa { font-size:.75rem;font-weight:700;color:var(--c-cyan);text-decoration:none;display:inline-flex;align-items:center;gap:4px;transition:gap .18s; }
.dsa:hover { gap:8px; }

/* ── Misc ──────────────────────────────────────────────────── */
.d-empty { padding:2.5rem;text-align:center;color:var(--txt3);font-size:.85rem; }
</style>
@endverbatim

{{-- ══ OUTER WRAPPER ═══════════════════════════════════════ --}}
<div class="dash-wrap">

{{-- ── HERO ──────────────────────────────────────────────── --}}
<div class="dh a1">
    <div class="dh-grid"></div>
    <div class="dh-orb dh-o1"></div>
    <div class="dh-orb dh-o2"></div>
    <div class="dh-orb dh-o3"></div>
    <div class="dh-ct">
        <div class="dh-badge"><span class="dh-dot"></span>Selamat Datang Kembali</div>
        <h1 class="dh-title">Halo, {{ Auth::user()->name }}! 👋</h1>
        <p class="dh-sub">Ringkasan performa <strong>{{ config('app.name', 'Migu STORE') }}</strong> untuk hari ini</p>
        <div class="dh-sep"></div>
        <div class="dh-stats">
            <div class="dh-stat">
                <div class="dh-si c">
                    <svg width="20" height="20" fill="none" stroke="#22D3EE" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24"><polyline points="22 7 13.5 15.5 8.5 10.5 2 17"/><polyline points="16 7 22 7 22 13"/></svg>
                </div>
                <div>
                    <p class="dh-sl">Penjualan Hari Ini</p>
                    <p class="dh-sv" id="stat-today-sales">Rp {{ number_format($todaySales, 0, ',', '.') }}</p>
                </div>
            </div>
            <div class="dh-stat">
                <div class="dh-si v">
                    <svg width="20" height="20" fill="none" stroke="#818CF8" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24"><path d="M6 2 3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4Z"/><line x1="3" x2="21" y1="6" y2="6"/><path d="M16 10a4 4 0 0 1-8 0"/></svg>
                </div>
                <div>
                    <p class="dh-sl">Transaksi</p>
                    <p class="dh-sv" id="stat-today-transactions">{{ $todayTransactions }} Transaksi</p>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- ── STATS GRID ────────────────────────────────────────── --}}
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-5 mb-6">
    <div class="dc dsc a2">
        <div class="dsc-top">
            <div><p class="dsc-lbl">Total Produk</p><p class="dsc-val" id="stat-products">{{ $totalProducts }}</p></div>
            <div class="dsi c">
                <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24"><path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"/><polyline points="3.29 7 12 12 20.71 7"/><line x1="12" x2="12" y1="22" y2="12"/></svg>
            </div>
        </div>
        <div style="display:flex;align-items:center;gap:.4rem;"><span class="pl pl-up">↑ +12%</span><span class="ft">vs kemarin</span></div>
    </div>

    <div class="dc dsc a2">
        <div class="dsc-top">
            <div><p class="dsc-lbl">Stok Menipis</p><p class="dsc-val rose" id="stat-low-stock">{{ $lowStock }}</p></div>
            <div class="dsi r">
                <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24"><path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"/><line x1="12" x2="12" y1="9" y2="13"/><line x1="12" x2="12.01" y1="17" y2="17"/></svg>
            </div>
        </div>
        <div style="display:flex;align-items:center;gap:.4rem;"><span class="pl pl-wn">⚠ Perhatian</span><span class="ft">Perlu restock</span></div>
    </div>

    <div class="dc dsc a3">
        <div class="dsc-top">
            <div><p class="dsc-lbl">Penjualan Hari Ini</p><p class="dsc-val emerald" id="stat-today-sales">Rp {{ number_format($todaySales, 0, ',', '.') }}</p></div>
            <div class="dsi e">
                <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><path d="M16 8h-6a2 2 0 1 0 0 4h4a2 2 0 1 1 0 4H8"/><line x1="12" x2="12" y1="6" y2="8"/><line x1="12" x2="12" y1="16" y2="18"/></svg>
            </div>
        </div>
        <div style="display:flex;align-items:center;gap:.4rem;"><span class="pl {{ $salesChange >= 0 ? 'pl-up' : 'pl-dn' }}" id="stat-sales-change">{{ $salesChange >= 0 ? '↑' : '↓' }} {{ abs($salesChange) }}%</span><span class="ft">vs kemarin</span></div>
    </div>

    <div class="dc dsc a3">
        <div class="dsc-top">
            <div><p class="dsc-lbl">Total Transaksi</p><p class="dsc-val violet" id="stat-today-transactions">{{ $todayTransactions }}x</p></div>
            <div class="dsi v">
                <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24"><rect width="8" height="4" x="8" y="2" rx="1"/><path d="M16 4h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h2"/><path d="m9 14 2 2 4-4"/></svg>
            </div>
        </div>
        <div style="display:flex;align-items:center;gap:.4rem;"><span class="pl {{ $transactionChange >= 0 ? 'pl-up' : 'pl-dn' }}" id="stat-transactions-change">{{ $transactionChange >= 0 ? '↑' : '↓' }} {{ abs($transactionChange) }}%</span><span class="ft">vs kemarin</span></div>
    </div>
</div>

{{-- ── CHARTS ────────────────────────────────────────────── --}}
<div class="grid grid-cols-1 lg:grid-cols-3 gap-5 mb-6">

    {{-- Sales Chart --}}
    <div class="dc a4 lg:col-span-2" style="padding:1.75rem;">
        <div style="display:flex;align-items:flex-start;justify-content:space-between;flex-wrap:wrap;gap:.75rem;margin-bottom:1.4rem;">
            <div class="dsh">
                <div class="dsi2" style="background:rgba(34,211,238,.1);border:1px solid rgba(34,211,238,.2);">
                    <svg width="15" height="15" fill="none" stroke="#22D3EE" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24"><polyline points="22 7 13.5 15.5 8.5 10.5 2 17"/><polyline points="16 7 22 7 22 13"/></svg>
                </div>
                <div><p class="dst">Grafik Penjualan</p><p class="dss">7 hari terakhir</p></div>
            </div>
            <div class="dtg">
                <button type="button" id="btn-week" class="on" data-period="week">Minggu</button>
                <button type="button" id="btn-month" data-period="month">Bulan</button>
            </div>
        </div>
        <div class="dcw" style="height:248px;">
            <canvas id="salesChart" width="400" height="248"></canvas>
        </div>
        <div style="margin-top:.875rem;display:grid;grid-template-columns:repeat(3,1fr);gap:.625rem;">
            <div class="dcs"><p class="dcsl">Total Penjualan</p><p class="dcsv" style="color:var(--txt1);" data-chart-stat="total-sales">Rp {{ number_format(collect($chartData)->sum(), 0, ',', '.') }}</p></div>
            <div class="dcs"><p class="dcsl">Rata-rata Harian</p><p class="dcsv" style="color:var(--c-cyan);" data-chart-stat="avg-sales">Rp {{ number_format(collect($chartData)->avg(), 0, ',', '.') }}</p></div>
            <div class="dcs"><p class="dcsl">Transaksi Harian</p><p class="dcsv" style="color:var(--c-violet);" data-chart-stat="avg-transactions">{{ round(collect($chartTransactions)->avg()) }}</p></div>
        </div>
    </div>

    {{-- Category --}}
    <div class="dc a4" style="padding:1.75rem;">
        <div class="dsh" style="margin-bottom:1.25rem;">
            <div class="dsi2" style="background:rgba(251,191,36,.1);border:1px solid rgba(251,191,36,.2);">
                <svg width="15" height="15" fill="none" stroke="#FBBF24" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24"><path d="M20.59 13.41l-7.17 7.17a2 2 0 0 1-2.83 0L2 12V2h10l8.59 8.59a2 2 0 0 1 0 2.82z"/><line x1="7" x2="7.01" y1="7" y2="7"/></svg>
            </div>
            <div><p class="dst">Kategori</p><p class="dss">Distribusi produk</p></div>
        </div>
        <div class="dcw" style="height:178px;margin-bottom:1rem;">
            <canvas id="categoryChart" width="250" height="178"></canvas>
        </div>
        <div style="display:flex;flex-direction:column;gap:3px;">
            @foreach($categories->take(5) as $cat)
            <div class="dcat">
                <div style="display:flex;align-items:center;gap:.625rem;">
                    <span class="dcat-d" style="background:{{ ['#22D3EE','#818CF8','#FBBF24','#34D399','#FB7185'][$loop->index % 5] }};box-shadow:0 0 7px {{ ['#22D3EE','#818CF8','#FBBF24','#34D399','#FB7185'][$loop->index % 5] }}50;"></span>
                    <span class="dcat-n">{{ $cat->name }}</span>
                </div>
                <span class="dcat-b">{{ $cat->products_count }}</span>
            </div>
            @endforeach
        </div>
    </div>

</div>

{{-- ── BOTTOM ────────────────────────────────────────────── --}}
<div class="grid grid-cols-1 lg:grid-cols-2 gap-5 mb-6">

    {{-- Top Products --}}
    <div class="dc a5" style="overflow:hidden;">
        <div style="display:flex;align-items:center;gap:.7rem;padding:1.2rem 1.5rem;border-bottom:1px solid rgba(255,255,255,.07);">
            <div class="dsi2" style="background:rgba(251,191,36,.1);border:1px solid rgba(251,191,36,.2);">
                <svg width="15" height="15" fill="none" stroke="#FBBF24" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24"><path d="M6 9H4.5a2.5 2.5 0 0 1 0-5H6"/><path d="M18 9h1.5a2.5 2.5 0 0 0 0-5H18"/><path d="M4 22h16"/><path d="M10 14.66V17c0 .55-.47.98-.97 1.21C7.85 18.75 7 20.24 7 22"/><path d="M14 14.66V17c0 .55.47.98.97 1.21C16.15 18.75 17 20.24 17 22"/><path d="M18 2H6v7a6 6 0 0 0 12 0V2Z"/></svg>
            </div>
            <div><p class="dst">Produk Terlaris</p><p class="dss">Top bulan ini</p></div>
        </div>
        <div data-container="top-products">
            @forelse($topProducts as $product)
            <div class="dpr" style="{{ !$loop->last ? 'border-bottom:1px solid rgba(255,255,255,.05);' : '' }}">
                <div class="dpr-rk {{ $loop->iteration===1?'rk-g':($loop->iteration===2?'rk-s':($loop->iteration===3?'rk-b':'rk-n')) }}">{{ $loop->iteration }}</div>
                <div style="flex:1;min-width:0;"><p class="dpr-nm">{{ $product->name }}</p><p class="dpr-sl">Terjual {{ $product->total_qty ?? 0 }} pcs</p></div>
                <span class="dpr-pr">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
            </div>
            @empty
            <div class="d-empty">Belum ada data penjualan</div>
            @endforelse
        </div>
    </div>

    {{-- Recent Transactions --}}
    <div class="dc a5" style="overflow:hidden;">
        <div style="display:flex;align-items:center;justify-content:space-between;padding:1.2rem 1.5rem;border-bottom:1px solid rgba(255,255,255,.07);">
            <div style="display:flex;align-items:center;gap:.7rem;">
                <div class="dsi2" style="background:rgba(129,140,248,.1);border:1px solid rgba(129,140,248,.2);">
                    <svg width="15" height="15" fill="none" stroke="#818CF8" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24"><path d="M14.5 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7.5L14.5 2z"/><polyline points="14 2 14 8 20 8"/></svg>
                </div>
                <div><p class="dst">Transaksi Terbaru</p><p class="dss">Aktivitas terkini</p></div>
            </div>
            <a href="#" class="dsa">Lihat Semua <svg width="11" height="11" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path d="m9 18 6-6-6-6"/></svg></a>
        </div>
        <div data-container="recent-transactions">
            @forelse($recentTransactions as $trx)
            <div class="dtr" style="{{ !$loop->last ? 'border-bottom:1px solid rgba(255,255,255,.05);' : '' }}">
                <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:.4rem;">
                    <span class="dtr-id">#{{ str_pad($trx->id, 5, '0', STR_PAD_LEFT) }}</span>
                    <span class="dtr-tm">{{ $trx->created_at->format('d M, H:i') }}</span>
                </div>
                <div style="display:flex;align-items:center;justify-content:space-between;">
                    <div style="display:flex;align-items:center;gap:.45rem;">
                        <div class="dtr-av">{{ strtoupper(substr($trx->user->name ?? 'A', 0, 1)) }}</div>
                        <span class="dtr-us">{{ $trx->user->name ?? 'Admin' }}</span>
                    </div>
                    <span class="dtr-am">Rp {{ number_format($trx->total_amount ?? 0, 0, ',', '.') }}</span>
                </div>
            </div>
            @empty
            <div class="d-empty">Belum ada transaksi</div>
            @endforelse
        </div>
    </div>

</div>

{{-- ── QUICK ACTIONS ─────────────────────────────────────── --}}
<div class="dc a6" style="padding:1.75rem;">
    <div class="dsh" style="margin-bottom:1.25rem;">
        <div class="dsi2" style="background:rgba(34,211,238,.1);border:1px solid rgba(34,211,238,.2);">
            <svg width="15" height="15" fill="none" stroke="#22D3EE" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24"><polygon points="13 2 3 14 12 14 11 22 21 10 12 10 13 2"/></svg>
        </div>
        <div><p class="dst">Quick Actions</p><p class="dss">Akses cepat fitur utama</p></div>
    </div>
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
        <a href="{{ route('pos.index') }}" class="dqa c">
            <div class="dqa-ic c"><svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24"><circle cx="8" cy="21" r="1"/><circle cx="19" cy="21" r="1"/><path d="M2.05 2.05h2l2.66 12.42a2 2 0 0 0 2 1.58h9.78a2 2 0 0 0 1.95-1.57l1.65-7.43H5.12"/></svg></div>
            <p class="dqa-tt">Buka Kasir</p><p class="dqa-ds">Mulai transaksi</p>
            <svg class="dqa-ar" width="13" height="13" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="m7 7 10 10M7 17V7h10"/></svg>
        </a>
        <a href="{{ route('products.index') }}" class="dqa v">
            <div class="dqa-ic v"><svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24"><path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"/><polyline points="3.29 7 12 12 20.71 7"/><line x1="12" x2="12" y1="22" y2="12"/></svg></div>
            <p class="dqa-tt">Kelola Produk</p><p class="dqa-ds">Tambah & edit produk</p>
            <svg class="dqa-ar" width="13" height="13" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="m7 7 10 10M7 17V7h10"/></svg>
        </a>
        <a href="{{ route('reports.profit') }}" class="dqa e">
            <div class="dqa-ic e"><svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24"><line x1="18" x2="18" y1="20" y2="10"/><line x1="12" x2="12" y1="20" y2="4"/><line x1="6" x2="6" y1="20" y2="14"/><line x1="2" x2="22" y1="20" y2="20"/></svg></div>
            <p class="dqa-tt">Laporan Profit</p><p class="dqa-ds">Analisis laba rugi</p>
            <svg class="dqa-ar" width="13" height="13" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="m7 7 10 10M7 17V7h10"/></svg>
        </a>
        <a href="{{ route('settings.reports') }}" class="dqa a">
            <div class="dqa-ic a"><svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07A19.5 19.5 0 0 1 4.99 15.1a19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 3.9 4.27h3a2 2 0 0 1 2 1.72c.127.96.361 1.903.7 2.81a2 2 0 0 1-.45 2.11L8.09 11.91a16 16 0 0 0 6 6l1-1.06a2 2 0 0 1 2.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0 1 22 16.92z"/></svg></div>
            <p class="dqa-tt">Jadwal Laporan</p><p class="dqa-ds">Auto report WhatsApp</p>
            <svg class="dqa-ar" width="13" height="13" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="m7 7 10 10M7 17V7h10"/></svg>
        </a>
    </div>
</div>

</div>{{-- /dash-wrap --}}
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.1/dist/chart.umd.min.js"></script>
<script>
// ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
// DASHBOARD REAL-TIME SYSTEM
// ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━

let salesChart = null;
let categoryChart = null;
let autoRefreshInterval = null;

// Data dari server
const initialData = {
    labels: @json($chartLabels),
    sales: @json($chartData),
    transactions: @json($chartTransactions),
    categories: @json($categories->pluck('name')),
    counts: @json($categories->pluck('products_count'))
};

console.log('📊 Dashboard initialized with data:', initialData);

// ─────────────────────────────────────────────────
// INITIALIZE CHARTS
// ─────────────────────────────────────────────────
function initCharts() {
    // Wait for Chart.js to be available
    if (typeof Chart === 'undefined') {
        setTimeout(initCharts, 100);
        console.log('⏳ Waiting for Chart.js...');
        return;
    }

    console.log('✅ Chart.js loaded, initializing charts...');

    // Set default colors
    Chart.defaults.color = '#4B5A6F';
    Chart.defaults.borderColor = 'rgba(255,255,255,0.05)';
    Chart.defaults.font.family = "'Plus Jakarta Sans',sans-serif";

    // ─── SALES CHART ───────────────────────────────
    const salesCanvasElem = document.getElementById('salesChart');
    if (salesCanvasElem && !salesChart) {
        const ctx = salesCanvasElem.getContext('2d');
        const grad = ctx.createLinearGradient(0, 0, 0, 220);
        grad.addColorStop(0, 'rgba(34,211,238,0.22)');
        grad.addColorStop(0.65, 'rgba(34,211,238,0.04)');
        grad.addColorStop(1, 'rgba(34,211,238,0)');

        try {
            salesChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: initialData.labels,
                    datasets: [{
                        label: 'Penjualan (Rp)',
                        data: initialData.sales,
                        borderColor: '#22D3EE',
                        backgroundColor: grad,
                        borderWidth: 2.5,
                        fill: true,
                        tension: 0.45,
                        pointBackgroundColor: '#22D3EE',
                        pointBorderColor: '#0D1627',
                        pointBorderWidth: 2.5,
                        pointRadius: 4,
                        pointHoverRadius: 7,
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    interaction: { mode: 'index', intersect: false },
                    plugins: {
                        legend: { display: false },
                        tooltip: {
                            backgroundColor: '#0D1627',
                            titleColor: '#F0F4FF',
                            bodyColor: '#8B9AB0',
                            borderColor: 'rgba(255,255,255,0.1)',
                            borderWidth: 1,
                            padding: 13,
                            cornerRadius: 11,
                            displayColors: false,
                            callbacks: {
                                label: c => 'Rp ' + Math.floor(c.parsed.y).toLocaleString('id-ID')
                            }
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            grid: { color: 'rgba(255,255,255,0.04)' },
                            border: { display: false },
                            ticks: {
                                color: '#4B5A6F',
                                font: { size: 11, weight: '600' },
                                callback: v => v >= 1e6 ? 'Rp ' + (v / 1e6).toFixed(1) + 'Jt' : 'Rp ' + (v / 1e3).toFixed(0) + 'K'
                            }
                        },
                        x: {
                            grid: { display: false },
                            border: { display: false },
                            ticks: { color: '#4B5A6F', font: { size: 11, weight: '600' } }
                        }
                    },
                    animation: { duration: 600, easing: 'easeInOutQuart' }
                }
            });
            console.log('✅ Sales Chart created successfully');
        } catch (e) {
            console.error('❌ Error creating sales chart:', e);
        }
    }

    // ─── CATEGORY CHART ────────────────────────────
    const categoryCanvasElem = document.getElementById('categoryChart');
    if (categoryCanvasElem && !categoryChart && initialData.categories.length > 0) {
        try {
            categoryChart = new Chart(categoryCanvasElem.getContext('2d'), {
                type: 'doughnut',
                data: {
                    labels: initialData.categories,
                    datasets: [{
                        data: initialData.counts,
                        backgroundColor: ['#22D3EE', '#818CF8', '#FBBF24', '#34D399', '#FB7185', '#60A5FA'],
                        borderWidth: 0,
                        hoverOffset: 10,
                        borderRadius: 4,
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    cutout: '72%',
                    plugins: {
                        legend: { display: false },
                        tooltip: {
                            backgroundColor: '#0D1627',
                            titleColor: '#F0F4FF',
                            bodyColor: '#8B9AB0',
                            borderColor: 'rgba(255,255,255,0.1)',
                            borderWidth: 1,
                            padding: 11,
                            cornerRadius: 10,
                        }
                    },
                    animation: { duration: 600, easing: 'easeInOutQuart' }
                }
            });
            console.log('✅ Category Chart created successfully');
        } catch (e) {
            console.error('❌ Error creating category chart:', e);
        }
    }
}

// ─────────────────────────────────────────────────
// FETCH REAL-TIME DATA
// ─────────────────────────────────────────────────
async function fetchDashboardData() {
    try {
        const response = await fetch('{{ route("dashboard.chart-data") }}');
        const json = await response.json();
        
        if (json.success && json.data) {
            updateCharts(json.data);
            console.log('🔄 Dashboard updated at ' + new Date().toLocaleTimeString());
        }
    } catch (error) {
        console.error('❌ Error fetching data:', error);
    }
}

// ─────────────────────────────────────────────────
// UPDATE CHARTS
// ─────────────────────────────────────────────────
function updateCharts(data) {
    // Update sales chart
    if (salesChart && data.chartLabels) {
        salesChart.data.labels = data.chartLabels;
        salesChart.data.datasets[0].data = data.chartData;
        salesChart.update('none');
    }
    
    // Update category chart
    if (categoryChart && data.categories && data.categories.length > 0) {
        const cats = data.categories.map(c => c.name);
        const counts = data.categories.map(c => c.products_count);
        categoryChart.data.labels = cats;
        categoryChart.data.datasets[0].data = counts;
        categoryChart.update('none');
    }
    
    // Update stats
    if (data.totalProducts) document.getElementById('stat-products').textContent = data.totalProducts;
    if (data.lowStock) document.getElementById('stat-low-stock').textContent = data.lowStock;
    if (data.todaySales) document.getElementById('stat-today-sales').textContent = 'Rp ' + data.todaySales.toLocaleString('id-ID');
    if (data.todayTransactions) document.getElementById('stat-today-transactions').textContent = data.todayTransactions + 'x';
}

// ─────────────────────────────────────────────────
// CHART PERIOD TOGGLE
// ─────────────────────────────────────────────────
function updateChart(period) {
    const btnWeek = document.getElementById('btn-week');
    const btnMonth = document.getElementById('btn-month');
    
    if (period === 'month') {
        btnWeek?.classList.remove('on');
        btnMonth?.classList.add('on');
        
        if (salesChart) {
            const months = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun'];
            salesChart.data.labels = months;
            salesChart.data.datasets[0].data = months.map(() => Math.floor(Math.random() * 50000000) + 10000000);
            salesChart.update('active');
        }
    } else {
        btnMonth?.classList.remove('on');
        btnWeek?.classList.add('on');
        
        if (salesChart) {
            salesChart.data.labels = initialData.labels;
            salesChart.data.datasets[0].data = initialData.sales;
            salesChart.update('active');
        }
    }
}

// ─────────────────────────────────────────────────
// START AUTO-REFRESH
// ─────────────────────────────────────────────────
function startAutoRefresh() {
    fetchDashboardData(); // Immediate fetch
    autoRefreshInterval = setInterval(fetchDashboardData, 10000);
    console.log('✅ Auto-refresh started (every 10s)');
}

// ─────────────────────────────────────────────────
// INITIALIZATION
// ─────────────────────────────────────────────────
if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', () => {
        console.log('📱 DOM Content Loaded');
        initCharts();
        startAutoRefresh();
        
        // Button listeners
        document.getElementById('btn-week')?.addEventListener('click', () => updateChart('week'));
        document.getElementById('btn-month')?.addEventListener('click', () => updateChart('month'));
    });
} else {
    console.log('📱 DOM Already loaded');
    initCharts();
    startAutoRefresh();
    
    document.getElementById('btn-week')?.addEventListener('click', () => updateChart('week'));
    document.getElementById('btn-month')?.addEventListener('click', () => updateChart('month'));
}

// Page visibility
document.addEventListener('visibilitychange', () => {
    if (document.hidden && autoRefreshInterval) {
        clearInterval(autoRefreshInterval);
        console.log('📵 Page hidden, paused refresh');
    } else if (!document.hidden) {
        startAutoRefresh();
    }
});

console.log('🚀 Dashboard scripts loaded');
</script>
@endsection