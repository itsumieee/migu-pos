@extends('layouts.app')

@section('page-title', 'Transaksi')

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
@keyframes scaleIn { from { opacity: 0; transform: scale(0.95); } to { opacity: 1; transform: scale(1); } }

.animate-fade { animation: fadeIn 0.4s ease-out; }
.animate-slide { animation: slideUp 0.5s ease-out both; }
.animate-scale { animation: scaleIn 0.3s ease-out both; }

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
.gradient-amber {
    background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
    box-shadow: 0 4px 20px rgba(245, 158, 11, 0.3);
}
.gradient-rose {
    background: linear-gradient(135deg, #f43f5e 0%, #e11d48 100%);
    box-shadow: 0 4px 20px rgba(244, 63, 94, 0.3);
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
.page-title {
    font-size: clamp(1.5rem, 4vw, 2rem);
    font-weight: 800; line-height: 1.2; color: var(--text-primary);
    letter-spacing: -0.02em;
}

/* Action Buttons */
.action-buttons {
    display: flex; flex-wrap: wrap; gap: 0.75rem;
}
.action-btn {
    display: inline-flex; align-items: center; gap: 0.5rem;
    padding: 0.75rem 1.25rem; border-radius: var(--radius-lg);
    font-size: 0.85rem; font-weight: 600; text-decoration: none;
    cursor: pointer; transition: all 0.2s ease;
}
.action-btn-amber {
    background: var(--amber); border: none; color: #0a0a0f;
    box-shadow: 0 4px 16px rgba(245, 158, 11, 0.3);
}
.action-btn-amber:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 24px rgba(245, 158, 11, 0.4);
}
.action-btn-rose {
    background: var(--rose); border: none; color: white;
    box-shadow: 0 4px 16px rgba(244, 63, 94, 0.3);
}
.action-btn-rose:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 24px rgba(244, 63, 94, 0.4);
}
.action-btn svg { width: 18px; height: 18px; }

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
.modern-table th.text-right { text-align: right; }
.modern-table th.text-center { text-align: center; }

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
.modern-table td.text-right { text-align: right; }
.modern-table td.text-center { text-align: center; }

/* Transaction ID */
.trx-id {
    font-family: var(--font-mono); font-size: 0.85rem;
    font-weight: 600; color: var(--text-primary);
}

/* Date Display */
.trx-date {
    font-size: 0.9rem; color: var(--text-primary);
}

/* Cashier Name */
.cashier-name {
    font-size: 0.9rem; color: var(--text-secondary);
}

/* Amount Display */
.trx-amount {
    font-size: 0.95rem; font-weight: 700; color: var(--accent-primary); /* 🔴 RED amount */
}

/* Detail Link */
.detail-link {
    display: inline-flex; align-items: center; justify-content: center;
    padding: 0.5rem 1rem; border-radius: var(--radius-sm);
    background: var(--bg-elevated); border: 1px solid var(--border-color);
    color: var(--text-secondary); font-size: 0.8rem; font-weight: 600;
    text-decoration: none; transition: all 0.15s ease;
}
.detail-link:hover {
    background: var(--bg-hover); border-color: var(--accent-primary);
    color: var(--accent-primary);
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

/* Modal Form Inputs */
.modal-input {
    width: 100%; padding: 0.875rem 1rem;
    background: var(--bg-elevated); border: 1px solid var(--border-color);
    border-radius: var(--radius); font-size: 0.9rem;
    color: var(--text-primary); transition: all 0.2s ease;
    font-family: var(--font-main);
}
.modal-input::placeholder { color: var(--text-muted); }
.modal-input:focus {
    outline: none; border-color: var(--accent-primary);
    box-shadow: 0 0 0 3px rgba(255, 51, 102, 0.15);
    background: var(--bg-card);
}

/* Modal Actions */
.modal-actions {
    display: flex; gap: 0.75rem; margin-top: 1.5rem;
}
.modal-btn {
    flex: 1; padding: 0.875rem; border-radius: var(--radius-lg);
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

/* ── Responsive ─────────────────────────── */
@media (max-width: 768px) {
    .page-header { flex-direction: column; align-items: flex-start; }
    .action-buttons { width: 100%; }
    .action-btn { flex: 1; justify-content: center; }
    .modern-table th, .modern-table td { padding: 0.75rem 1rem; font-size: 0.85rem; }
    .modal-content { padding: 1.5rem; margin: 1rem; }
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
    <div style="max-width: 1200px; margin: 0 auto;">
        
        <!-- Page Header -->
        <div class="page-header animate-slide">
            <h1 class="page-title">Daftar Transaksi</h1>
            
            <!-- Action Buttons -->
            <div class="action-buttons">
                <button type="button" onclick="openModal('dateFilterModal')" class="action-btn action-btn-amber">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                    Export by Date
                </button>
                <a href="{{ route('transactions.export.pdf') }}" class="action-btn action-btn-rose">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                    Export PDF
                </a>
            </div>
        </div>

        <!-- Table -->
        <div class="table-container animate-fade">
            <div class="table-wrapper">
                <table class="modern-table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>No. Transaksi</th>
                            <th>Tanggal</th>
                            <th>Kasir</th>
                            <th class="text-right">Total</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse(($transactions ?? []) as $index => $trx)
                        <tr>
                            <td>{{ ($transactions->firstItem() ?? 0) + $index }}</td>
                            <td>
                                <span class="trx-id">#{{ str_pad(($trx->id ?? 0), 5, '0', STR_PAD_LEFT) }}</span>
                            </td>
                            <td>
                                <span class="trx-date">{{ ($trx->created_at ?? now())->format('d/m/Y H:i') }}</span>
                            </td>
                            <td>
                                <span class="cashier-name">{{ $trx->user->name ?? '-' }}</span>
                            </td>
                            <td class="text-right">
                                <span class="trx-amount">Rp {{ number_format(($trx->total_amount ?? 0), 0, ',', '.') }}</span>
                            </td>
                            <td class="text-center">
                                <a href="{{ route('transactions.show', $trx ?? null) }}" class="detail-link">Detail</a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" style="text-align: center; padding: 3rem; color: var(--text-muted);">
                                Belum ada transaksi
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            <!-- Pagination -->
            @if(($transactions ?? collect())->hasPages())
            <div class="pagination-wrapper">
                {{ ($transactions ?? collect())->links('pagination::tailwind') }}
            </div>
            @endif
        </div>
    </div>
</div>

<!-- Date Filter Modal -->
<div id="dateFilterModal" class="modal-overlay" role="dialog" aria-modal="true">
    <div class="modal-content animate-scale">
        <div class="modal-header">
            <h3 class="modal-title">Export Transaksi Berdasarkan Tanggal</h3>
            <p class="modal-subtitle">Pilih rentang tanggal untuk export PDF</p>
        </div>
        
        <form action="{{ route('transactions.export.pdf.bydate') }}" method="POST">
            @csrf
            <div style="display: grid; grid-template-columns: 1fr; gap: 1rem;">
                <div>
                    <label class="form-label" for="start_date" style="margin-bottom: 0.5rem;">Tanggal Mulai</label>
                    <input type="date" id="start_date" name="start_date" required class="modal-input">
                </div>
                <div>
                    <label class="form-label" for="end_date" style="margin-bottom: 0.5rem;">Tanggal Akhir</label>
                    <input type="date" id="end_date" name="end_date" required class="modal-input">
                </div>
            </div>
            
            <div class="modal-actions">
                <button type="button" onclick="closeModal('dateFilterModal')" class="modal-btn modal-btn-secondary">Batal</button>
                <button type="submit" class="modal-btn modal-btn-primary">Export PDF</button>
            </div>
        </form>
    </div>
</div>

<!-- Modal Functions -->
<script>
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