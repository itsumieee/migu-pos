@extends('layouts.app')

@section('page-title', 'Manajemen User')

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
    
    /* Role Colors */
    --role-admin: #8b5cf6;
    --role-admin-bg: rgba(139, 92, 246, 0.15);
    --role-cashier: #06b6d4;
    --role-cashier-bg: rgba(6, 182, 212, 0.15);
    
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

/* User Cell */
.user-cell {
    display: flex; align-items: center; gap: 0.875rem;
}
.user-avatar {
    width: 40px; height: 40px; border-radius: var(--radius);
    background: var(--bg-elevated); border: 1px solid var(--border-color);
    display: flex; align-items: center; justify-content: center;
    font-size: 0.9rem; font-weight: 700; color: var(--text-primary);
    flex-shrink: 0; overflow: hidden;
}
.user-avatar img {
    width: 100%; height: 100%; object-fit: cover;
}
.user-info { display: flex; flex-direction: column; gap: 0.125rem; }
.user-name {
    font-weight: 600; color: var(--text-primary);
    font-size: 0.95rem;
}
.user-email {
    font-size: 0.8rem; color: var(--text-muted);
}

/* Role Badge */
.role-badge {
    display: inline-flex; align-items: center; justify-content: center;
    padding: 4px 12px; border-radius: 20px;
    font-size: 0.75rem; font-weight: 600;
}
.role-badge.admin {
    background: var(--role-admin-bg); color: var(--role-admin);
    border: 1px solid rgba(139, 92, 246, 0.3);
}
.role-badge.cashier {
    background: var(--role-cashier-bg); color: var(--role-cashier);
    border: 1px solid rgba(6, 182, 212, 0.3);
}

/* Phone Cell */
.phone-cell {
    font-size: 0.9rem; color: var(--text-secondary);
    font-family: monospace;
}

/* Action Buttons */
.action-buttons {
    display: flex; justify-content: flex-end; gap: 0.5rem;
}
.action-btn {
    width: 36px; height: 36px; border-radius: var(--radius-sm);
    display: flex; align-items: center; justify-content: center;
    background: transparent; border: 1px solid var(--border-color);
    color: var(--text-secondary); cursor: pointer;
    transition: all 0.15s ease;
}
.action-btn:hover {
    background: var(--bg-hover); border-color: var(--border-accent);
}
.action-btn.edit:hover {
    color: var(--role-cashier); border-color: rgba(6, 182, 212, 0.3);
}
.action-btn.delete:hover {
    color: var(--rose); border-color: rgba(244, 63, 94, 0.3);
    background: rgba(244, 63, 94, 0.1);
}
.action-btn svg { width: 18px; height: 18px; }

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

/* ── Responsive ─────────────────────────── */
@media (max-width: 768px) {
    .page-header { flex-direction: column; align-items: flex-start; }
    .add-btn { width: 100%; justify-content: center; }
    .modern-table th, .modern-table td { padding: 0.75rem 1rem; font-size: 0.85rem; }
    .user-cell { flex-direction: column; align-items: flex-start; gap: 0.375rem; }
    .action-buttons { flex-direction: row; }
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
            <div class="page-title-group">
                <h1 class="page-title">Manajemen User</h1>
                <p class="page-subtitle">Kelola akun Admin & Kasir</p>
            </div>
            <a href="{{ route('users.create') }}" class="add-btn">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
                Tambah User
            </a>
        </div>

        <!-- Table -->
        <div class="table-container animate-fade">
            <div class="table-wrapper">
                <table class="modern-table">
                    <thead>
                        <tr>
                            <th>User</th>
                            <th>Role</th>
                            <th>Telepon</th>
                            <th style="text-align: right;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse(($users ?? []) as $user)
                        <tr>
                            <td>
                                <div class="user-cell">
                                    <div class="user-avatar">
                                        @if(!empty($user->photo))
                                        <img src="{{ asset('storage/' . $user->photo) }}" alt="{{ $user->name ?? 'User' }}">
                                        @else
                                        {{ substr(($user->name ?? 'U'), 0, 1) }}
                                        @endif
                                    </div>
                                    <div class="user-info">
                                        <span class="user-name">{{ $user->name ?? '-' }}</span>
                                        <span class="user-email">{{ $user->email ?? '-' }}</span>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <span class="role-badge {{ ($user->role ?? '') === 'admin' ? 'admin' : 'cashier' }}">
                                    {{ ucfirst($user->role ?? 'Cashier') }}
                                </span>
                            </td>
                            <td>
                                <span class="phone-cell">{{ $user->phone ?? '-' }}</span>
                            </td>
                            <td>
                                <div class="action-buttons">
                                    <a href="{{ route('users.edit', $user) }}" class="action-btn edit" title="Edit">
                                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125"/>
                                        </svg>
                                    </a>
                                    <form action="{{ route('users.destroy', $user) }}" method="POST" onsubmit="return confirm('Hapus user ini? Tindakan tidak bisa dibatalkan.')">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="action-btn delete" title="Hapus">
                                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0"/>
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4">
                                <div class="empty-state">
                                    <div class="empty-icon">
                                        <svg width="28" height="28" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/>
                                        </svg>
                                    </div>
                                    <p>Belum ada user selain Anda</p>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            <!-- Pagination -->
            @if(($users ?? collect())->hasPages())
            <div class="pagination-wrapper">
                {{ ($users ?? collect())->links('pagination::tailwind') }}
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