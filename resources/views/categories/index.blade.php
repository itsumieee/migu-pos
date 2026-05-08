@extends('layouts.app')

@section('page-title', 'Kategori')

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
        radial-gradient(at 0% 0%, rgba(255, 51, 102, 0.08) 0px, transparent 50%),
        radial-gradient(at 100% 100%, rgba(255, 107, 107, 0.06) 0px, transparent 50%);
    background-attachment: fixed;
}

/* ── Animations ─────────────────────────────── */
@keyframes fadeIn { from { opacity: 0; } to { opacity: 1; } }
@keyframes slideUp { from { opacity: 0; transform: translateY(24px); } to { opacity: 1; transform: translateY(0); } }
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

/* Add Button */
.add-btn {
    display: inline-flex; align-items: center; gap: 0.5rem;
    padding: 0.875rem 1.5rem; border-radius: var(--radius-lg);
    background: var(--accent-gradient); border: none; color: white;
    font-size: 0.85rem; font-weight: 700; text-decoration: none;
    cursor: pointer; transition: all 0.2s ease;
    box-shadow: 0 4px 20px var(--accent-glow);
}
.add-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 32px var(--accent-glow);
}
.add-btn:active { transform: translateY(0); }
.add-btn svg { width: 18px; height: 18px; }

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

/* Category Name */
.category-name {
    font-weight: 600; color: var(--text-primary);
}

/* Product Count Badge */
.count-badge {
    display: inline-flex; align-items: center; justify-content: center;
    padding: 4px 12px; border-radius: 20px;
    background: var(--bg-elevated); border: 1px solid var(--border-color);
    font-size: 0.75rem; font-weight: 600; color: var(--text-secondary);
}

/* Action Buttons */
.delete-btn {
    padding: 0.5rem 1rem; border-radius: var(--radius-sm);
    background: rgba(244, 63, 94, 0.15); border: 1px solid rgba(244, 63, 94, 0.3);
    color: var(--rose); font-size: 0.8rem; font-weight: 600;
    cursor: pointer; transition: all 0.15s ease;
}
.delete-btn:hover {
    background: rgba(244, 63, 94, 0.25);
    color: white;
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

/* ── Modal ───────────────────────────────── */
.modal-overlay {
    position: fixed; inset: 0; background: rgba(0, 0, 0, 0.7);
    backdrop-filter: blur(12px); z-index: 1000;
    display: none; align-items: center; justify-content: center;
    padding: 2rem; opacity: 0; pointer-events: none;
    transition: opacity 0.3s ease;
}
.modal-overlay.active {
    display: flex; opacity: 1; pointer-events: auto;
}
.modal-content {
    background: var(--bg-card); border: 1px solid var(--border-color);
    border-radius: var(--radius-xl); padding: 2rem;
    width: 100%; max-width: 480px;
    transform: scale(0.95); transition: transform 0.3s ease;
}
.modal-overlay.active .modal-content { transform: scale(1); }

.modal-header {
    margin-bottom: 1.5rem; padding-bottom: 1rem;
    border-bottom: 1px solid var(--border-light);
}
.modal-title {
    font-size: 1.25rem; font-weight: 700; color: var(--text-primary);
    margin-bottom: 0.25rem;
}
.modal-subtitle {
    font-size: 0.9rem; color: var(--text-secondary);
}

/* Form Input */
.form-input {
    width: 100%; padding: 0.875rem 1rem;
    background: var(--bg-elevated); border: 1px solid var(--border-color);
    border-radius: var(--radius); font-size: 0.9rem;
    color: var(--text-primary); transition: all 0.2s ease;
    font-family: var(--font-main);
}
.form-input::placeholder { color: var(--text-muted); }
.form-input:focus {
    outline: none; border-color: var(--accent-primary);
    box-shadow: 0 0 0 3px rgba(255, 51, 102, 0.15);
    background: var(--bg-card);
}

/* Modal Actions */
.modal-actions {
    display: flex; justify-content: flex-end; gap: 0.75rem;
    margin-top: 1.5rem; padding-top: 1.5rem;
    border-top: 1px solid var(--border-light);
}
.modal-btn {
    padding: 0.875rem 1.5rem; border-radius: var(--radius-lg);
    font-size: 0.85rem; font-weight: 600; cursor: pointer;
    transition: all 0.2s ease;
}
.modal-btn-secondary {
    background: var(--bg-elevated); border: 1px solid var(--border-color);
    color: var(--text-primary);
}
.modal-btn-secondary:hover {
    background: var(--bg-hover); border-color: var(--accent-primary);
    color: var(--accent-primary);
}
.modal-btn-primary {
    background: var(--accent-gradient); border: none; color: white;
    box-shadow: 0 4px 20px var(--accent-glow);
}
.modal-btn-primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 32px var(--accent-glow);
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

/* ── Responsive ─────────────────────────── */
@media (max-width: 768px) {
    .page-header { flex-direction: column; align-items: flex-start; }
    .add-btn { width: 100%; justify-content: center; }
    .modern-table th, .modern-table td { padding: 0.75rem 1rem; font-size: 0.85rem; }
    .modal-content { padding: 1.5rem; margin: 1rem; }
}

/* ── Scrollbar ───────────────────────────── */
::-webkit-scrollbar { width: 5px; }
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
                <h1 class="page-title">Kategori Produk</h1>
                <p class="page-subtitle">Kelompokkan barang agar lebih rapi</p>
            </div>
            <button type="button" onclick="openModal('catModal')" class="add-btn">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
                Tambah Kategori
            </button>
        </div>

        <!-- Table -->
        <div class="table-container animate-fade">
            <div class="table-wrapper">
                <table class="modern-table">
                    <thead>
                        <tr>
                            <th>Nama Kategori</th>
                            <th>Jumlah Produk</th>
                            <th style="text-align: right;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse(($categories ?? []) as $cat)
                        <tr>
                            <td>
                                <span class="category-name">{{ $cat->name ?? '-' }}</span>
                            </td>
                            <td>
                                <span class="count-badge">{{ $cat->products_count ?? 0 }} item</span>
                            </td>
                            <td>
                                <form action="{{ route('categories.destroy', $cat) }}" method="POST" onsubmit="return confirm('Hapus kategori ini?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="delete-btn">Hapus</button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="3">
                                <div class="empty-state">
                                    <div class="empty-icon">
                                        <svg width="28" height="28" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                                        </svg>
                                    </div>
                                    <p>Belum ada kategori</p>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            <!-- Pagination -->
            @if(($categories ?? collect())->hasPages())
            <div class="pagination-wrapper">
                {{ ($categories ?? collect())->links('pagination::tailwind') }}
            </div>
            @endif
        </div>
    </div>
</div>

<!-- Modal -->
<div id="catModal" class="modal-overlay" role="dialog" aria-modal="true">
    <div class="modal-content">
        <div class="modal-header">
            <h3 class="modal-title">Tambah Kategori Baru</h3>
            <p class="modal-subtitle">Nama akan otomatis dibuatkan slug unik</p>
        </div>
        
        <form action="{{ route('categories.store') }}" method="POST">
            @csrf
            <input type="text" name="name" placeholder="Contoh: Kaos, Hoodie, Celana..." required 
                class="form-input" autofocus>
            
            <div class="modal-actions">
                <button type="button" onclick="closeModal('catModal')" class="modal-btn modal-btn-secondary">Batal</button>
                <button type="submit" class="modal-btn modal-btn-primary">Simpan</button>
            </div>
        </form>
    </div>
</div>

<script>
// Modal Functions
function openModal(modalId) {
    const modal = document.getElementById(modalId);
    if (!modal) return;
    modal.classList.add('active');
    document.body.style.overflow = 'hidden';
    
    // Focus first input
    setTimeout(() => {
        modal.querySelector('input')?.focus();
    }, 300);
}

function closeModal(modalId) {
    const modal = document.getElementById(modalId);
    if (!modal) return;
    modal.classList.remove('active');
    document.body.style.overflow = '';
}

// Close modal on outside click
document.querySelectorAll('.modal-overlay').forEach(modal => {
    modal.addEventListener('click', function(e) {
        if (e.target === this) closeModal(this.id);
    });
});

// Close modal on Escape key
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        document.querySelectorAll('.modal-overlay.active').forEach(modal => {
            closeModal(modal.id);
        });
    }
});

// Custom Pagination Styles
document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.pagination a, .pagination span').forEach(el => {
        el.style.transition = 'all 0.15s ease';
    });
});
</script>

@endsection