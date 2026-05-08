@extends('layouts.app')

@section('page-title', 'Pengaturan')

@section('content')

<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

@verbatim
<style>
/* ── Modern Dark Theme CSS Variables - RED ACCENT ────────── */
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
    
    --emerald: #10b981;
    --amber: #f59e0b;
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
        radial-gradient(at 0% 0%, rgba(255, 51, 102, 0.1) 0px, transparent 50%),
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

/* 🔴 Gradient Buttons - RED */
.gradient-primary { 
    background: var(--accent-gradient); 
    box-shadow: 0 4px 20px var(--accent-glow); 
}
.gradient-purple { 
    background: linear-gradient(135deg, var(--purple) 0%, #a78bfa 100%); 
}
.gradient-emerald { 
    background: linear-gradient(135deg, var(--emerald) 0%, #059669 100%); 
}
.gradient-rose { 
    background: linear-gradient(135deg, var(--accent-primary) 0%, var(--accent-secondary) 100%); 
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
    margin-bottom: 2rem; padding: 1.5rem 0;
}
.page-title-group { display: flex; align-items: center; gap: 1rem; }
.page-icon {
    width: 48px; height: 48px; border-radius: var(--radius-lg);
    background: var(--accent-gradient); display: flex;
    align-items: center; justify-content: center;
    box-shadow: 0 4px 16px var(--accent-glow);
}
.page-title {
    font-size: clamp(1.5rem, 4vw, 2rem);
    font-weight: 800; line-height: 1.2; color: var(--text-primary);
}
.page-subtitle {
    font-size: 0.9rem; color: var(--text-secondary);
    margin-top: 0.25rem;
}

/* ── Alerts ───────────────────────────────── */
.alert {
    padding: 0.875rem 1.25rem; border-radius: var(--radius-lg);
    display: flex; align-items: center; gap: 0.75rem;
    margin-bottom: 1.5rem; font-size: 0.9rem;
}
.alert-success {
    background: rgba(16, 185, 129, 0.15);
    border: 1px solid rgba(16, 185, 129, 0.3);
    color: var(--emerald);
}
.alert-error {
    background: rgba(255, 51, 102, 0.15);
    border: 1px solid rgba(255, 51, 102, 0.3);
    color: var(--accent-primary);
}
.alert svg { width: 18px; height: 18px; flex-shrink: 0; }

/* ── Tabs Navigation ───────────────────────── */
.tabs-nav {
    display: flex; gap: 0.25rem; margin-bottom: 1.5rem;
    background: var(--bg-card); padding: 0.375rem;
    border-radius: var(--radius-lg); border: 1px solid var(--border-color);
    overflow-x: auto;
}
.tabs-nav::-webkit-scrollbar { display: none; }
.tab-btn {
    flex: 1; min-width: 120px;
    padding: 0.75rem 1rem; border-radius: var(--radius);
    font-size: 0.85rem; font-weight: 600; color: var(--text-secondary);
    background: transparent; border: none; cursor: pointer;
    transition: all 0.2s ease; white-space: nowrap;
}
.tab-btn:hover { color: var(--text-primary); background: var(--bg-hover); }
.tab-btn.active {
    background: var(--bg-elevated); color: var(--accent-primary);
    box-shadow: 0 2px 8px rgba(255, 51, 102, 0.15);
}

/* ── Settings Card ─────────────────────────── */
.settings-card {
    background: var(--bg-card); border: 1px solid var(--border-color);
    border-radius: var(--radius-xl); padding: 1.75rem;
}
.card-header {
    margin-bottom: 1.5rem; padding-bottom: 1.25rem;
    border-bottom: 1px solid var(--border-light);
}
.card-title {
    font-size: 1.25rem; font-weight: 700; color: var(--text-primary);
    margin-bottom: 0.25rem;
}
.card-subtitle {
    font-size: 0.9rem; color: var(--text-secondary);
}

/* ── Form Elements ─────────────────────────── */
.form-group { margin-bottom: 1.25rem; }
.form-label {
    display: block; font-size: 0.85rem; font-weight: 600;
    color: var(--text-primary); margin-bottom: 0.5rem;
}
.form-input, .form-select, .form-textarea {
    width: 100%; padding: 0.75rem 1rem;
    background: var(--bg-elevated); border: 1px solid var(--border-color);
    border-radius: var(--radius); font-size: 0.9rem;
    color: var(--text-primary); transition: all 0.2s ease;
    font-family: var(--font-main);
}
.form-input::placeholder, .form-textarea::placeholder { color: var(--text-muted); }
.form-input:focus, .form-select:focus, .form-textarea:focus {
    outline: none; border-color: var(--accent-primary);
    box-shadow: 0 0 0 3px rgba(255, 51, 102, 0.15);
    background: var(--bg-card);
}
.form-textarea { resize: vertical; min-height: 80px; }
.form-error {
    font-size: 0.75rem; color: var(--accent-primary);
    margin-top: 0.25rem; display: block;
}

/* File Upload */
.file-upload {
    border: 2px dashed var(--border-color); border-radius: var(--radius-lg);
    padding: 1.5rem; text-align: center; cursor: pointer;
    transition: all 0.2s ease; background: var(--bg-elevated);
    display: block;
}
.file-upload:hover {
    border-color: var(--accent-primary); background: var(--bg-hover);
}
.file-upload input { display: none; }
.file-upload-icon {
    width: 32px; height: 32px; margin: 0 auto 0.5rem;
    color: var(--text-muted);
}
.file-upload-text {
    font-size: 0.85rem; color: var(--text-secondary);
}
.file-upload-hint {
    font-size: 0.75rem; color: var(--text-muted);
    margin-top: 0.5rem;
}

/* QR Preview */
.qr-preview {
    width: 160px; height: 160px; border-radius: var(--radius-lg);
    background: var(--bg-elevated); border: 1px solid var(--border-color);
    display: flex; align-items: center; justify-content: center;
    overflow: hidden; margin-bottom: 0.75rem;
}
.qr-preview img { width: 100%; height: 100%; object-fit: cover; }
.qr-preview-placeholder {
    text-align: center; color: var(--text-muted);
}
.qr-preview-placeholder svg { width: 40px; height: 40px; margin: 0 auto 0.5rem; }
.qr-preview-label {
    font-size: 0.8rem; color: var(--text-muted);
    text-align: center;
}

/* E-Wallet Card */
.ewallet-section {
    padding: 1.25rem 0; border-bottom: 1px solid var(--border-light);
}
.ewallet-section:last-child { border-bottom: none; padding-bottom: 0; }
.ewallet-header {
    display: flex; align-items: center; gap: 0.875rem;
    margin-bottom: 1rem;
}
.ewallet-icon {
    width: 40px; height: 40px; border-radius: var(--radius);
    display: flex; align-items: center; justify-content: center;
    font-weight: 700; font-size: 0.85rem; color: white;
    flex-shrink: 0;
}
.ewallet-title {
    font-size: 1rem; font-weight: 700; color: var(--text-primary);
}
.ewallet-subtitle {
    font-size: 0.8rem; color: var(--text-muted);
}

/* Toggle Switch */
.toggle-group {
    display: flex; align-items: center; justify-content: space-between;
    padding: 1rem; background: var(--bg-elevated);
    border: 1px solid var(--border-color); border-radius: var(--radius-lg);
}
.toggle-info { flex: 1; }
.toggle-title {
    font-size: 0.9rem; font-weight: 600; color: var(--text-primary);
}
.toggle-desc {
    font-size: 0.8rem; color: var(--text-muted);
    margin-top: 0.25rem;
}
.toggle-switch {
    position: relative; width: 44px; height: 24px;
    flex-shrink: 0;
}
.toggle-switch input { opacity: 0; width: 0; height: 0; }
.toggle-slider {
    position: absolute; inset: 0; background: var(--border-color);
    border-radius: 24px; transition: 0.3s; cursor: pointer;
}
.toggle-slider::before {
    position: absolute; content: ""; height: 18px; width: 18px;
    left: 3px; bottom: 3px; background: white;
    border-radius: 50%; transition: 0.3s;
}
.toggle-switch input:checked + .toggle-slider {
    background: var(--accent-primary);
}
.toggle-switch input:checked + .toggle-slider::before {
    transform: translateX(20px);
}

/* Submit Button - 🔴 RED */
.submit-btn {
    padding: 0.875rem 1.75rem; border-radius: var(--radius-lg);
    border: none; font-size: 0.9rem; font-weight: 700;
    cursor: pointer; transition: all 0.2s ease;
    display: inline-flex; align-items: center; gap: 0.5rem;
}
.submit-btn-primary {
    background: var(--accent-gradient); color: white;
    box-shadow: 0 4px 20px var(--accent-glow);
}
.submit-btn-primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 32px var(--accent-glow);
}
.submit-btn-purple {
    background: linear-gradient(135deg, var(--purple) 0%, #a78bfa 100%);
    color: white; box-shadow: 0 4px 20px rgba(139, 92, 246, 0.3);
}
.submit-btn-purple:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 32px rgba(139, 92, 246, 0.4);
}
.submit-btn-emerald {
    background: linear-gradient(135deg, var(--emerald) 0%, #059669 100%);
    color: #0a0a0f; box-shadow: 0 4px 20px rgba(16, 185, 129, 0.3);
}
.submit-btn-emerald:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 32px rgba(16, 185, 129, 0.4);
}
.submit-btn-rose {
    background: var(--accent-gradient); color: white;
    box-shadow: 0 4px 20px var(--accent-glow);
}
.submit-btn-rose:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 32px var(--accent-glow);
}

/* ── Responsive ─────────────────────────── */
.settings-container {
    max-width: 900px; margin: 0 auto; padding: 2rem 1.5rem;
}
@media (max-width: 768px) {
    .settings-container { padding: 1.5rem 1rem; }
    .settings-card { padding: 1.25rem; }
    .tabs-nav { flex-wrap: nowrap; }
    .tab-btn { min-width: 100px; padding: 0.625rem 0.75rem; font-size: 0.8rem; }
}

/* ── Scrollbar ───────────────────────────── */
::-webkit-scrollbar { width: 5px; }
::-webkit-scrollbar-track { background: transparent; }
::-webkit-scrollbar-thumb {
    background: var(--bg-elevated); border-radius: 3px;
}
::-webkit-scrollbar-thumb:hover { background: var(--accent-primary); }

/* ── Focus States ───────────────────────── */
button:focus-visible, input:focus-visible, select:focus-visible, textarea:focus-visible {
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

<div class="settings-container">
    
    <!-- Page Header -->
    <div class="page-header animate-slide">
        <div class="page-title-group">
            <div class="page-icon">
                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                </svg>
            </div>
            <div>
                <h1 class="page-title">Pengaturan Toko</h1>
                <p class="page-subtitle">Kelola identitas, pembayaran, dan sistem Anda</p>
            </div>
        </div>
    </div>

    <!-- Alerts -->
    @if(session('success'))
        <div class="alert alert-success animate-fade">
            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
            </svg>
            <span>{{ session('success') }}</span>
        </div>
    @endif
    @if(session('error'))
        <div class="alert alert-error animate-fade">
            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            <span>{{ session('error') }}</span>
        </div>
    @endif

    <!-- Tabs & Content -->
    <div class="animate-slide" x-data="{ activeTab: 'general' }">
        
        <!-- Tabs Navigation -->
        <div class="tabs-nav">
            <button type="button" @click="activeTab = 'general'" :class="{ 'active': activeTab === 'general' }" class="tab-btn">
                📋 Identitas
            </button>
            <button type="button" @click="activeTab = 'qris'" :class="{ 'active': activeTab === 'qris' }" class="tab-btn">
                📲 QRIS
            </button>
            <button type="button" @click="activeTab = 'ewallet'" :class="{ 'active': activeTab === 'ewallet' }" class="tab-btn">
                💳 E-Wallet
            </button>
            <button type="button" @click="activeTab = 'system'" :class="{ 'active': activeTab === 'system' }" class="tab-btn">
                ⚙️ Sistem
            </button>
        </div>

        <!-- GENERAL TAB -->
        <div x-show="activeTab === 'general'" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4" x-transition:enter-end="opacity-100 translate-y-0" class="settings-card">
            <div class="card-header">
                <h2 class="card-title">Identitas Toko</h2>
                <p class="card-subtitle">Atur informasi dasar tentang toko Anda</p>
            </div>
            
            <form action="{{ route('settings.update.general') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div style="display: grid; grid-template-columns: 1fr; gap: 1.25rem;">
                    <div class="form-group">
                        <label class="form-label" for="store_name">Nama Toko</label>
                        <input type="text" id="store_name" name="store_name" value="{{ old('store_name', $settings['store_name'] ?? '') }}" required 
                            class="form-input" placeholder="Masukkan nama toko Anda">
                        @error('store_name') <span class="form-error">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="store_address">Alamat Toko</label>
                        <textarea id="store_address" name="store_address" class="form-textarea" placeholder="Masukkan alamat lengkap">{{ old('store_address', $settings['store_address'] ?? '') }}</textarea>
                        @error('store_address') <span class="form-error">{{ $message }}</span> @enderror
                    </div>
                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
                        <div class="form-group">
                            <label class="form-label" for="store_phone">Telepon</label>
                            <input type="text" id="store_phone" name="store_phone" value="{{ old('store_phone', $settings['store_phone'] ?? '') }}" 
                                class="form-input" placeholder="Nomor telepon">
                            @error('store_phone') <span class="form-error">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="store_email">Email</label>
                            <input type="email" id="store_email" name="store_email" value="{{ old('store_email', $settings['store_email'] ?? '') }}" 
                                class="form-input" placeholder="Email toko">
                            @error('store_email') <span class="form-error">{{ $message }}</span> @enderror
                        </div>
                    </div>
                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
                        <div class="form-group">
                            <label class="form-label" for="tax_rate">Pajak (%)</label>
                            <input type="number" id="tax_rate" name="tax_rate" value="{{ old('tax_rate', $settings['tax_rate'] ?? '0') }}" step="0.01" 
                                class="form-input" placeholder="0.00">
                            @error('tax_rate') <span class="form-error">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group">
                            <label class="form-label">Ganti Logo</label>
                            <label class="file-upload">
                                <input type="file" name="logo" accept="image/*">
                                <svg class="file-upload-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                                </svg>
                                <p class="file-upload-text">Klik untuk upload</p>
                                <p class="file-upload-hint">JPG, PNG (Max: 5MB)</p>
                            </label>
                            @error('logo') <span class="form-error">{{ $message }}</span> @enderror
                        </div>
                    </div>
                </div>
                <div style="display: flex; justify-content: flex-end; margin-top: 1.5rem;">
                    <button type="submit" class="submit-btn submit-btn-primary">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>

        <!-- QRIS TAB -->
        <div x-show="activeTab === 'qris'" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4" x-transition:enter-end="opacity-100 translate-y-0" class="settings-card">
            <div class="card-header">
                <h2 class="card-title">Pembayaran QRIS</h2>
                <p class="card-subtitle">Kelola QR Code QRIS Anda</p>
            </div>
            
            <form action="{{ route('settings.update.qris') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div style="display: flex; flex-wrap: wrap; gap: 2rem; align-items: flex-start;">
                    <div>
                        <div class="qr-preview">
                            @php $qrisImage = setting('qris_image'); @endphp
                            @if($qrisImage)
                                <img src="{{ asset('storage/' . $qrisImage) }}" alt="QRIS" onerror="this.parentElement.innerHTML='<div class=\'qr-preview-placeholder\'><svg fill=\'none\' stroke=\'currentColor\' viewBox=\'0 0 24 24\'><path stroke-linecap=\'round\' stroke-linejoin=\'round\' stroke-width=\'1.5\' d=\'M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm12 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z\'/></svg><p>QR tidak ditemukan</p></div>'">
                            @else
                                <div class="qr-preview-placeholder">
                                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm12 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z"/>
                                    </svg>
                                    <p>Belum ada QR</p>
                                </div>
                            @endif
                        </div>
                        <p class="qr-preview-label">QR Code Aktif</p>
                    </div>
                    <div style="flex: 1; min-width: 240px;">
                        <div class="form-group">
                            <label class="form-label">Upload QR Code Baru</label>
                            <label class="file-upload">
                                <input type="file" name="qris_image" accept="image/*" required>
                                <svg class="file-upload-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/>
                                </svg>
                                <p class="file-upload-text">Drag & drop atau klik upload</p>
                                <p class="file-upload-hint">Format: JPG, PNG (Max: 5MB)</p>
                            </label>
                            @error('qris_image') <span class="form-error">{{ $message }}</span> @enderror
                        </div>
                    </div>
                </div>
                <div style="display: flex; justify-content: flex-end; margin-top: 1.5rem;">
                    <button type="submit" class="submit-btn submit-btn-rose">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                        </svg>
                        Update QR Code
                    </button>
                </div>
            </form>
        </div>

        <!-- EWALLET TAB -->
        <div x-show="activeTab === 'ewallet'" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4" x-transition:enter-end="opacity-100 translate-y-0" class="settings-card">
            <div class="card-header">
                <h2 class="card-title">Pengaturan E-Wallet</h2>
                <p class="card-subtitle">Kelola nomor akun dan instruksi pembayaran</p>
            </div>
            
            <form action="{{ route('settings.update.ewallet') }}" method="POST">
                @csrf
                
                @php 
                $ewallets = [
                    ['dana', 'DANA', '#118EEA'],
                    ['gopay', 'GoPay', '#00AA13'],
                    ['ovo', 'OVO', '#4C3494'],
                    ['shopeepay', 'ShopeePay', '#EE4D2D']
                ]; 
                @endphp

                @foreach($ewallets as $wallet)
                    @php [$key, $name, $color] = $wallet; @endphp
                    <div class="ewallet-section">
                        <div class="ewallet-header">
                            <div class="ewallet-icon" style="background: {{ $color }};">
                                {{ substr($name, 0, 1) }}
                            </div>
                            <div>
                                <h3 class="ewallet-title">{{ $name }}</h3>
                                <p class="ewallet-subtitle">Pengaturan akun {{ $name }} Anda</p>
                            </div>
                        </div>
                        <div style="display: grid; grid-template-columns: 1fr; gap: 1rem;">
                            <div class="form-group">
                                <label class="form-label" for="ewallet_{{ $key }}_number">Nomor {{ $name }}</label>
                                <input type="text" id="ewallet_{{ $key }}_number" name="ewallet_{{ $key }}_number" value="{{ old('ewallet_' . $key . '_number', setting('ewallet_' . $key . '_number') ?? '') }}" 
                                    class="form-input" placeholder="Contoh: 081234567890">
                                @error('ewallet_' . $key . '_number') <span class="form-error">{{ $message }}</span> @enderror
                            </div>
                            <div class="form-group">
                                <label class="form-label" for="ewallet_{{ $key }}_description">Instruksi Pembayaran</label>
                                <textarea id="ewallet_{{ $key }}_description" name="ewallet_{{ $key }}_description" class="form-textarea" placeholder="Berikan instruksi singkat cara pembayaran">{{ old('ewallet_' . $key . '_description', setting('ewallet_' . $key . '_description') ?? '') }}</textarea>
                                @error('ewallet_' . $key . '_description') <span class="form-error">{{ $message }}</span> @enderror
                            </div>
                        </div>
                    </div>
                @endforeach

                <div style="display: flex; justify-content: flex-end; margin-top: 1.5rem;">
                    <button type="submit" class="submit-btn submit-btn-emerald">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                        Simpan E-Wallet
                    </button>
                </div>
            </form>
        </div>

        <!-- SYSTEM TAB -->
        <div x-show="activeTab === 'system'" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4" x-transition:enter-end="opacity-100 translate-y-0" class="settings-card">
            <div class="card-header">
                <h2 class="card-title">Pengaturan Sistem</h2>
                <p class="card-subtitle">Kelola preferensi otomasi dan sistem</p>
            </div>
            
            <form action="{{ route('settings.update.system') }}" method="POST">
                @csrf
                <div style="display: grid; grid-template-columns: 1fr; gap: 1.25rem;">
                    <div class="form-group">
                        <label class="form-label" for="default_payment">Metode Pembayaran Default</label>
                        <select id="default_payment" name="default_payment" class="form-select">
                            <option value="cash" {{ (setting('default_payment') ?? 'cash') == 'cash' ? 'selected' : '' }}>💵 Tunai</option>
                            <option value="debit" {{ (setting('default_payment') ?? 'cash') == 'debit' ? 'selected' : '' }}>🏦 Kartu Debit</option>
                            <option value="qris" {{ (setting('default_payment') ?? 'cash') == 'qris' ? 'selected' : '' }}>📲 QRIS</option>
                            <option value="ewallet" {{ (setting('default_payment') ?? 'cash') == 'ewallet' ? 'selected' : '' }}>💳 E-Wallet</option>
                        </select>
                        @error('default_payment') <span class="form-error">{{ $message }}</span> @enderror
                    </div>

                    <div style="display: grid; grid-template-columns: 1fr; gap: 0.75rem;">
                        <label class="toggle-group">
                            <div class="toggle-info">
                                <p class="toggle-title">Cetak Struk Otomatis</p>
                                <p class="toggle-desc">Aktifkan untuk print langsung setelah transaksi</p>
                            </div>
                            <label class="toggle-switch">
                                <input type="checkbox" name="auto_print" value="1" {{ (setting('auto_print') ?? '0') == '1' ? 'checked' : '' }}>
                                <span class="toggle-slider"></span>
                            </label>
                        </label>
                        
                        <label class="toggle-group">
                            <div class="toggle-info">
                                <p class="toggle-title">Notifikasi WhatsApp</p>
                                <p class="toggle-desc">Kirim notifikasi ke pelanggan setelah bayar</p>
                            </div>
                            <label class="toggle-switch">
                                <input type="checkbox" name="enable_notifications" value="1" {{ (setting('enable_notifications') ?? '0') == '1' ? 'checked' : '' }}>
                                <span class="toggle-slider"></span>
                            </label>
                        </label>
                    </div>
                </div>

                <div style="display: flex; justify-content: flex-end; margin-top: 1.5rem;">
                    <button type="submit" class="submit-btn submit-btn-rose">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                        Simpan Sistem
                    </button>
                </div>
            </form>
        </div>

    </div>
</div>

@endsection