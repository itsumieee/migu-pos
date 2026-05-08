@extends('layouts.app')

@section('page-title', 'Produk')

@section('content')

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
    
    /* 🔴 RED/PINK ACCENT */
    --accent-primary: #ff3366;
    --accent-secondary: #ff6b6b;
    --accent-gradient: linear-gradient(135deg, #ff3366 0%, #ff6b6b 100%);
    --accent-glow: rgba(255, 51, 102, 0.3);
    
    --emerald: #10b981;
    --amber: #f59e0b;
    --rose: #f43f5e;
    --purple: #8b5cf6;
    
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
    gap: 1rem; margin-bottom: 2rem; padding: 1.5rem 0;
}
.page-title-group { display: flex; flex-direction: column; gap: 0.25rem; }
.page-title {
    font-size: clamp(1.5rem, 4vw, 2rem);
    font-weight: 800; line-height: 1.2; color: var(--text-primary);
}
.page-subtitle {
    font-size: 0.9rem; color: var(--text-secondary);
}

/* Search & Actions */
.page-actions {
    display: flex; flex-wrap: wrap; gap: 0.75rem; align-items: center;
}
.search-wrapper {
    position: relative; flex: 1; min-width: 200px; max-width: 280px;
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
    outline: none; border-color: var(--accent-primary);
    box-shadow: 0 0 0 3px rgba(255, 51, 102, 0.15);
    background: var(--bg-elevated);
}

/* Action Buttons */
.action-btn {
    display: inline-flex; align-items: center; gap: 0.5rem;
    padding: 0.75rem 1.25rem; border-radius: var(--radius-lg);
    font-size: 0.85rem; font-weight: 600; text-decoration: none;
    transition: all 0.2s ease; cursor: pointer;
}
.action-btn-outline {
    background: var(--bg-elevated); border: 1px solid var(--border-color);
    color: var(--text-primary);
}
.action-btn-outline:hover {
    background: var(--bg-hover); border-color: var(--accent-primary);
    color: var(--accent-primary);
}
.action-btn-primary {
    background: var(--accent-gradient); border: none; color: white;
    box-shadow: 0 4px 20px var(--accent-glow);
}
.action-btn-primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 32px var(--accent-glow);
}
.action-btn svg { width: 18px; height: 18px; flex-shrink: 0; }

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
.modern-table th:first-child { border-top-left-radius: var(--radius-lg); }
.modern-table th:last-child { border-top-right-radius: var(--radius-lg); text-align: right; }

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
.modern-table td:first-child { border-top-left-radius: var(--radius-sm); border-bottom-left-radius: var(--radius-sm); }
.modern-table td:last-child { border-top-right-radius: var(--radius-sm); border-bottom-right-radius: var(--radius-sm); text-align: right; }

/* Product Image */
.product-thumb {
    width: 56px; height: 56px; border-radius: var(--radius);
    background: var(--bg-elevated); border: 1px solid var(--border-color);
    overflow: hidden; flex-shrink: 0;
}
.product-thumb img {
    width: 100%; height: 100%; object-fit: cover;
    transition: transform 0.3s ease;
}
.modern-table tbody tr:hover .product-thumb img { transform: scale(1.05); }

/* Product Info */
.product-name {
    font-weight: 600; color: var(--text-primary);
    margin-bottom: 0.25rem; line-height: 1.3;
}
.product-sku {
    font-size: 0.75rem; color: var(--text-muted);
    font-family: monospace;
}

/* Category Badge */
.category-badge {
    display: inline-block; padding: 4px 12px;
    background: var(--bg-elevated); border: 1px solid var(--border-color);
    border-radius: 20px; font-size: 0.75rem; font-weight: 500;
    color: var(--text-secondary);
}

/* Price */
.product-price {
    font-weight: 700; color: var(--accent-primary); /* 🔴 RED price */
    font-size: 0.95rem;
}

/* Stock Badge */
.stock-badge {
    display: inline-flex; align-items: center; gap: 4px;
    padding: 4px 12px; border-radius: 20px;
    font-size: 0.75rem; font-weight: 600;
}
.stock-badge.low {
    background: rgba(244, 63, 94, 0.15); color: var(--rose);
    border: 1px solid rgba(244, 63, 94, 0.3);
}
.stock-badge.ok {
    background: rgba(16, 185, 129, 0.15); color: var(--emerald);
    border: 1px solid rgba(16, 185, 129, 0.3);
}

/* Action Buttons in Table */
.table-actions {
    display: flex; justify-content: flex-end; gap: 0.375rem;
    opacity: 0.7; transition: opacity 0.2s ease;
}
.modern-table tbody tr:hover .table-actions { opacity: 1; }

.action-icon-btn {
    width: 36px; height: 36px; border-radius: var(--radius-sm);
    display: flex; align-items: center; justify-content: center;
    color: var(--text-muted); transition: all 0.15s ease;
    text-decoration: none; background: transparent; border: none;
    cursor: pointer; padding: 0;
}
.action-icon-btn:hover { background: var(--bg-hover); }
.action-icon-btn.purple:hover { color: var(--purple); background: rgba(139, 92, 246, 0.1); }
.action-icon-btn.cyan:hover { color: var(--accent-primary); background: rgba(255, 51, 102, 0.1); } /* 🔴 RED hover */
.action-icon-btn.rose:hover { color: var(--rose); background: rgba(244, 63, 94, 0.1); }
.action-icon-btn svg { width: 18px; height: 18px; }

/* Empty State */
.empty-state {
    text-align: center; padding: 3rem 1rem; color: var(--text-muted);
}
.empty-icon {
    width: 64px; height: 64px; margin: 0 auto 1rem;
    border-radius: var(--radius-lg); background: var(--bg-elevated);
    display: flex; align-items: center; justify-content: center;
    opacity: 0.5;
}
.empty-link {
    color: var(--accent-primary); text-decoration: none; font-weight: 600;
}
.empty-link:hover { text-decoration: underline; }

/* Pagination */
.pagination-wrapper {
    padding: 1rem 1.25rem;
    background: var(--bg-elevated); border-top: 1px solid var(--border-light);
}
.pagination {
    display: flex; gap: 0.375rem; list-style: none; padding: 0; justify-content: center; flex-wrap: wrap;
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
    background: var(--accent-primary); color: white; /* 🔴 RED active */
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
    .page-actions { width: 100%; }
    .search-wrapper { max-width: 100%; }
    .modern-table th, .modern-table td { padding: 0.75rem 1rem; font-size: 0.85rem; }
    .product-thumb { width: 48px; height: 48px; }
    .product-name { font-size: 0.85rem; }
    .table-actions { gap: 0.25rem; }
    .action-icon-btn { width: 32px; height: 32px; }
    .action-icon-btn svg { width: 16px; height: 16px; }
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

<div style="padding: 2rem 1.5rem;">
    <div style="max-width: 1440px; margin: 0 auto;">
        
        <!-- Page Header -->
        <div class="page-header animate-slide">
            <div class="page-title-group">
                <h1 class="page-title">Produk</h1>
                <p class="page-subtitle">Kelola inventori dan stok barang</p>
            </div>
            <div class="page-actions">
                <form method="GET" class="search-wrapper">
                    <svg class="search-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                    <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari produk..." class="search-input">
                </form>
                <a href="{{ route('products.export.pdf') }}" class="action-btn action-btn-outline">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                    Export PDF
                </a>
                <a href="{{ route('products.create') }}" class="action-btn action-btn-primary">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                    Tambah
                </a>
            </div>
        </div>

        <!-- Table -->
        <div class="table-container animate-fade">
            <div class="table-wrapper">
                <table class="modern-table">
                    <thead>
                        <tr>
                            <th style="width: 80px;">Foto</th>
                            <th>Produk</th>
                            <th>Kategori</th>
                            <th>Harga</th>
                            <th>Stok</th>
                            <th style="width: 100px; text-align: right;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($products as $p)
                        <tr>
                            <td>
                                <div class="product-thumb">
                                    @php
                                        $imageUrl = null;
                                        if (!empty($p->image)) {
                                            if (str_starts_with($p->image, 'http')) {
                                                $imageUrl = $p->image;
                                            } else {
                                                $imageUrl = asset('storage/' . $p->image);
                                            }
                                        }
                                    @endphp
                                    <img src="{{ $imageUrl ?? 'https://placehold.co/100x100/1c1c2e/6c6c7e?text=No+Img' }}" 
                                         alt="{{ $p->name ?? 'Produk' }}"
                                         onerror="this.src='https://placehold.co/100x100/1c1c2e/6c6c7e?text=Error'">
                                </div>
                            </td>
                            <td>
                                <div class="product-name">{{ $p->name ?? 'Produk' }}</div>
                                <div class="product-sku">SKU: {{ $p->sku ?? '-' }}</div>
                            </td>
                            <td>
                                <span class="category-badge">{{ $p->category->name ?? '-' }}</span>
                            </td>
                            <td>
                                <span class="product-price">Rp {{ number_format($p->price ?? 0, 0, ',', '.') }}</span>
                            </td>
                            <td>
                                @php $stock = $p->stock ?? 0; @endphp
                                <span class="stock-badge {{ $stock <= 5 ? 'low' : 'ok' }}">
                                    {{ $stock }} pcs
                                </span>
                            </td>
                            <td>
                                <div class="table-actions">
                                    <a href="{{ route('products.barcode', $p) }}" class="action-icon-btn purple" title="Cetak Barcode">
                                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm12 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z"/></svg>
                                    </a>
                                    <a href="{{ route('products.edit', $p) }}" class="action-icon-btn cyan" title="Edit">
                                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125"/></svg>
                                    </a>
                                    <form action="{{ route('products.destroy', $p) }}" method="POST" onsubmit="return confirm('Hapus produk ini?')" style="display:inline;">
                                        @csrf @method('DELETE')
                                        <button type="button" class="action-icon-btn rose" title="Hapus" onclick="this.closest('form').submit()">
                                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0"/></svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6">
                                <div class="empty-state">
                                    <div class="empty-icon">
                                        <svg width="32" height="32" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 0 0 6.586 13H4"/></svg>
                                    </div>
                                    <p style="margin-bottom: 1rem;">Belum ada produk</p>
                                    <a href="{{ route('products.create') }}" class="empty-link">Tambahkan produk pertama</a>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            <!-- Pagination -->
            @if($products->hasPages())
            <div class="pagination-wrapper">
                {{ $products->links('pagination::tailwind') }}
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
});
</script>

@endsection