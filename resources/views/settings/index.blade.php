@extends('layouts.app')

@section('page-title', 'Pengaturan')

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
    --txt1:      #F0F4FF;
    --txt2:      #8B9AB0;
    --txt3:      #4B5A6F;
}

.settings-wrap {
    font-family: 'Plus Jakarta Sans', sans-serif;
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
    text-rendering: optimizeLegibility;
    background: linear-gradient(135deg, #0F172A 0%, #1E293B 50%, #0F172A 100%);
    min-height: 100vh;
}

.settings-wrap * { box-sizing: border-box; }
.f-syne { font-family: 'Syne', sans-serif !important; }

@keyframes pFadeUp {
    from { opacity: 0; transform: translateY(16px); }
    to { opacity: 1; transform: translateY(0); }
}

@keyframes pSlideIn {
    from { opacity: 0; transform: translateX(20px); }
    to { opacity: 1; transform: translateX(0); }
}

.a1 { animation: pFadeUp 0.55s cubic-bezier(0.16, 1, 0.3, 1) 0.05s both; }
.a2 { animation: pFadeUp 0.55s cubic-bezier(0.16, 1, 0.3, 1) 0.12s both; }
.a3 { animation: pFadeUp 0.55s cubic-bezier(0.16, 1, 0.3, 1) 0.20s both; }
.a4 { animation: pFadeUp 0.55s cubic-bezier(0.16, 1, 0.3, 1) 0.28s both; }

/* ── Header ────────────────────────────────────────────────── */
.sh {
    position: relative;
    border-radius: 22px;
    padding: 2rem;
    overflow: hidden;
    border: 1px solid rgba(255, 255, 255, 0.08);
    background: rgba(255, 255, 255, 0.03);
    margin-bottom: 1.5rem;
    animation: pFadeUp 0.55s cubic-bezier(0.16, 1, 0.3, 1) 0s both;
}

.sh::before {
    content: '';
    position: absolute;
    inset: 0;
    border-radius: inherit;
    background: linear-gradient(140deg, rgba(255, 255, 255, 0.05) 0%, transparent 55%);
    pointer-events: none;
    z-index: 0;
}

.sh-ct { position: relative; z-index: 1; }
.sh-badge {
    display: inline-flex;
    align-items: center;
    gap: 7px;
    padding: 5px 14px;
    border-radius: 100px;
    background: rgba(34, 211, 238, 0.1);
    border: 1px solid rgba(34, 211, 238, 0.25);
    font-size: 11px;
    font-weight: 700;
    letter-spacing: 0.09em;
    text-transform: uppercase;
    color: var(--c-cyan);
    margin-bottom: 1rem;
}

.sh-title {
    font-family: 'Syne', sans-serif;
    font-size: clamp(1.7rem, 3.5vw, 2.2rem);
    font-weight: 800;
    line-height: 1.15;
    color: var(--txt1);
    margin-bottom: 0.55rem;
    letter-spacing: -0.01em;
}

.sh-sub {
    font-size: 0.88rem;
    color: var(--txt2);
    line-height: 1.5;
    letter-spacing: 0.3px;
}

/* ── Tab Navigation ────────────────────────────────────────── */
.tab-nav {
    display: flex;
    gap: 0.75rem;
    margin-bottom: 1.5rem;
    flex-wrap: wrap;
    animation: pFadeUp 0.55s cubic-bezier(0.16, 1, 0.3, 1) 0.1s both;
}

.tab-btn {
    padding: 0.75rem 1.35rem;
    border-radius: 12px;
    border: 1px solid rgba(255, 255, 255, 0.1);
    background: rgba(255, 255, 255, 0.04);
    color: var(--txt2);
    font-size: 0.85rem;
    font-weight: 600;
    font-family: 'Plus Jakarta Sans', sans-serif;
    cursor: pointer;
    transition: all 0.3s;
    position: relative;
    overflow: hidden;
}

.tab-btn::before {
    content: '';
    position: absolute;
    inset: 0;
    background: linear-gradient(140deg, rgba(255, 255, 255, 0.05) 0%, transparent 55%);
    opacity: 0;
    transition: opacity 0.3s;
    pointer-events: none;
}

.tab-btn:hover {
    background: rgba(255, 255, 255, 0.06);
    border-color: rgba(255, 255, 255, 0.15);
    transform: translateY(-2px);
}

.tab-btn.active {
    background: rgba(34, 211, 238, 0.15);
    border-color: rgba(34, 211, 238, 0.4);
    color: var(--c-cyan);
    box-shadow: 0 0 0 3px rgba(34, 211, 238, 0.1);
}

/* ── Glass Card ────────────────────────────────────────────── */
.sc {
    background: var(--card-bg);
    border: 1px solid var(--card-bdr);
    border-radius: 18px;
    position: relative;
    overflow: hidden;
    padding: 1.8rem;
    animation: pFadeUp 0.55s cubic-bezier(0.16, 1, 0.3, 1) 0.15s both;
}

.sc::before {
    content: '';
    position: absolute;
    inset: 0;
    border-radius: inherit;
    background: linear-gradient(140deg, rgba(255, 255, 255, 0.05) 0%, transparent 55%);
    pointer-events: none;
    z-index: 0;
}

.sc > * { position: relative; z-index: 1; }
.sc:hover { background: var(--card-hvr); border-color: rgba(255, 255, 255, 0.14); }

.sc-title {
    font-family: 'Syne', sans-serif;
    font-size: 1.15rem;
    font-weight: 800;
    color: var(--txt1);
    margin-bottom: 1.5rem;
    letter-spacing: -0.01em;
}

/* ── Form Elements ────────────────────────────────────────── */
.s-form-group {
    margin-bottom: 1.25rem;
}

.s-label {
    display: block;
    font-size: 0.8rem;
    font-weight: 700;
    color: var(--txt1);
    margin-bottom: 0.4rem;
    letter-spacing: 0.3px;
    text-transform: uppercase;
}

.s-input,
.s-select,
.s-textarea {
    width: 100%;
    padding: 0.8rem 1rem;
    background: rgba(255, 255, 255, 0.05);
    border: 1px solid rgba(255, 255, 255, 0.1);
    border-radius: 10px;
    color: var(--txt1);
    font-size: 0.9rem;
    font-family: 'Plus Jakarta Sans', sans-serif;
    transition: all 0.3s;
}

.s-input::placeholder {
    color: var(--txt3);
}

.s-input:focus,
.s-select:focus,
.s-textarea:focus {
    outline: none;
    border-color: var(--c-cyan);
    background: rgba(255, 255, 255, 0.08);
    box-shadow: 0 0 0 3px rgba(34, 211, 238, 0.1);
}

.s-textarea {
    resize: vertical;
    min-height: 80px;
}

/* ── Submit Button ────────────────────────────────────────── */
.s-btn {
    padding: 0.85rem 1.6rem;
    border: none;
    border-radius: 10px;
    font-size: 0.85rem;
    font-weight: 700;
    font-family: 'Plus Jakarta Sans', sans-serif;
    cursor: pointer;
    transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
    position: relative;
    overflow: hidden;
    letter-spacing: 0.3px;
    text-transform: uppercase;
}

.s-btn::before {
    content: '';
    position: absolute;
    inset: 0;
    background: linear-gradient(140deg, rgba(255, 255, 255, 0.15) 0%, transparent 60%);
    opacity: 0;
    transition: opacity 0.3s;
}

.s-btn:hover {
    transform: translateY(-2px);
}

.s-btn:hover::before { opacity: 1; }

.s-btn-primary { background: linear-gradient(135deg, #22D3EE 0%, #06B6D4 100%); color: #0F172A; }
.s-btn-primary:hover { box-shadow: 0 12px 28px rgba(34, 211, 238, 0.25); }

.s-btn-secondary { background: linear-gradient(135deg, #818CF8 0%, #6366F1 100%); color: white; }
.s-btn-secondary:hover { box-shadow: 0 12px 28px rgba(129, 140, 248, 0.25); }

.s-btn-success { background: linear-gradient(135deg, #34D399 0%, #10B981 100%); color: #0F172A; }
.s-btn-success:hover { box-shadow: 0 12px 28px rgba(52, 211, 153, 0.25); }

.s-btn-danger { background: linear-gradient(135deg, #FB7185 0%, #F43F5E 100%); color: white; }
.s-btn-danger:hover { box-shadow: 0 12px 28px rgba(251, 113, 133, 0.25); }

/* ── Alert ────────────────────────────────────────────────── */
.s-alert {
    padding: 1rem 1.25rem;
    border-radius: 12px;
    border: 1px solid;
    display: flex;
    align-items: center;
    gap: 0.75rem;
    margin-bottom: 1.5rem;
    animation: pFadeUp 0.55s cubic-bezier(0.16, 1, 0.3, 1) 0s both;
    font-size: 0.9rem;
}

.s-alert-success {
    background: rgba(52, 211, 153, 0.1);
    border-color: rgba(52, 211, 153, 0.25);
    color: var(--c-emerald);
}

.s-alert-error {
    background: rgba(251, 113, 133, 0.1);
    border-color: rgba(251, 113, 133, 0.25);
    color: var(--c-rose);
}

.s-alert svg { width: 18px; height: 18px; flex-shrink: 0; }

/* ── Grid ─────────────────────────────────────────────────── */
.s-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
    gap: 1.25rem;
}

/* ── Divider ──────────────────────────────────────────────── */
.s-divider {
    height: 1px;
    background: linear-gradient(90deg, transparent 0%, rgba(255, 255, 255, 0.1) 50%, transparent 100%);
    margin: 1.25rem 0;
}

/* ── Checkbox ─────────────────────────────────────────────── */
.s-checkbox {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    cursor: pointer;
    margin-bottom: 0.75rem;
}

.s-checkbox input {
    width: 18px;
    height: 18px;
    cursor: pointer;
    accent-color: var(--c-cyan);
}

.s-checkbox label {
    cursor: pointer;
    color: var(--txt1);
    font-weight: 500;
}

/* ── Responsive ───────────────────────────────────────────── */
@media (max-width: 768px) {
    .sh { padding: 1.5rem; }
    .sc { padding: 1.5rem; }
    .tab-nav { gap: 0.5rem; }
    .tab-btn { padding: 0.65rem 1rem; font-size: 0.8rem; }
    .s-grid { grid-template-columns: 1fr; }
}
</style>
@endverbatim

<div class="settings-wrap py-8 px-4">
    <div class="max-w-4xl mx-auto">
        
        <!-- Header -->
        <div class="sh a1">
            <div class="sh-ct">
                <div class="sh-badge">⚙️ Pengaturan</div>
                <h1 class="sh-title">Pengaturan Toko</h1>
                <p class="sh-sub">Kelola informasi, pembayaran, dan preferensi toko Anda</p>
            </div>
        </div>

        <!-- Alerts -->
        @if(session('success'))
            <div class="s-alert s-alert-success a2">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                <span>{{ session('success') }}</span>
            </div>
        @endif

        <!-- Tabs & Content -->
        <div class="a3" x-data="{ activeTab: 'general' }">
            <!-- Tab Navigation -->
            <div class="tab-nav">
                <button @click="activeTab = 'general'; $nextTick(() => window.scrollTo({top: 0, behavior: 'smooth'}))" :class="{ 'active': activeTab === 'general' }" class="tab-btn">
                    📋 Identitas Toko
                </button>
                <button @click="activeTab = 'qris'; $nextTick(() => window.scrollTo({top: 0, behavior: 'smooth'}))" :class="{ 'active': activeTab === 'qris' }" class="tab-btn">
                    📲 QRIS
                </button>
                <button @click="activeTab = 'ewallet'; $nextTick(() => window.scrollTo({top: 0, behavior: 'smooth'}))" :class="{ 'active': activeTab === 'ewallet' }" class="tab-btn">
                    💳 E-Wallet
                </button>
                <button @click="activeTab = 'system'; $nextTick(() => window.scrollTo({top: 0, behavior: 'smooth'}))" :class="{ 'active': activeTab === 'system' }" class="tab-btn">
                    ⚙️ Sistem
                </button>
            </div>

            <!-- GENERAL TAB -->
            <div x-show="activeTab === 'general'" x-transition class="sc">
                <h2 class="sc-title">Identitas Toko</h2>
                <form action="{{ route('settings.update.general') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                    @csrf
                    <div style="display: grid; grid-template-columns: 1fr; gap: 1.25rem;">
                        <div class="s-form-group">
                            <label class="s-label">Nama Toko</label>
                            <input type="text" name="store_name" value="{{ old('store_name', $settings['store_name'] ?? '') }}" required 
                                class="s-input" placeholder="Masukkan nama toko Anda">
                        </div>
                        <div class="s-form-group">
                            <label class="s-label">Alamat</label>
                            <textarea name="store_address" class="s-textarea" placeholder="Masukkan alamat lengkap">{{ old('store_address', $settings['store_address'] ?? '') }}</textarea>
                        </div>
                        <div class="s-form-group">
                            <label class="s-label">Telepon</label>
                            <input type="text" name="store_phone" value="{{ old('store_phone', $settings['store_phone'] ?? '') }}" 
                                class="s-input" placeholder="Nomor telepon">
                        </div>
                        <div class="s-form-group">
                            <label class="s-label">Email</label>
                            <input type="email" name="store_email" value="{{ old('store_email', $settings['store_email'] ?? '') }}" 
                                class="s-input" placeholder="Email toko">
                        </div>
                    </div>
                    <div class="s-divider"></div>
                    <div class="flex justify-end">
                        <button type="submit" class="s-btn s-btn-primary">Simpan Perubahan</button>
                    </div>
                </form>
            </div>

            <!-- QRIS TAB -->
            <div x-show="activeTab === 'qris'" x-transition class="sc">
                <h2 class="sc-title">Pembayaran QRIS</h2>
                <form action="{{ route('settings.update.qris') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div style="display: grid; grid-template-columns: auto 1fr; gap: 1.5rem;">
                        <div class="s-form-group">
                            <label class="s-label">QR Code Saat Ini</label>
                            <div style="width: 160px; height: 160px; border-radius: 10px; border: 1px solid rgba(255,255,255,0.1); background: rgba(255,255,255,0.04); display: flex; align-items: center; justify-content: center; overflow: hidden;">
                                @if(setting('qris_image'))
                                    <img src="{{ asset('storage/' . setting('qris_image')) }}" alt="QRIS" style="width: 100%; height: 100%; object-fit: cover;">
                                @else
                                    <div style="text-align: center;">
                                        <svg style="width: 32px; height: 32px; color: var(--txt3); margin: 0 auto 0.5rem;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm12 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z"/></svg>
                                        <p style="font-size: 0.75rem; color: var(--txt3);">Belum ada</p>
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="s-form-group">
                            <label class="s-label">Upload QR Code Baru</label>
                            <input type="file" name="qris_image" accept="image/*" 
                                class="s-input" style="padding: 2rem; cursor: pointer;" placeholder="Pilih file">
                            <p style="font-size: 0.75rem; color: var(--txt2); margin-top: 0.5rem;">Format: JPG, PNG (Max: 5MB)</p>
                        </div>
                    </div>
                    <div class="s-divider"></div>
                    <div class="flex justify-end">
                        <button type="submit" class="s-btn s-btn-secondary">Update QR Code</button>
                    </div>
                </form>
            </div>

            <!-- EWALLET TAB -->
            <div x-show="activeTab === 'ewallet'" x-transition class="sc">
                <h2 class="sc-title">Pengaturan E-Wallet</h2>
                <form action="{{ route('settings.update.ewallet') }}" method="POST" class="space-y-8">
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
                        <div class="s-divider"></div>
                        <h3 style="font-size: 1rem; font-weight: 700; color: var(--txt1); margin-bottom: 1rem;">
                            <span style="display: inline-block; width: 32px; height: 32px; border-radius: 8px; background: {{ $color }}; color: white; text-align: center; line-height: 32px; font-weight: bold; margin-right: 0.75rem;">{{ substr($name, 0, 1) }}</span>
                            {{ $name }}
                        </h3>
                        <div style="display: grid; grid-template-columns: 1fr; gap: 1.25rem;">
                            <div class="s-form-group">
                                <label class="s-label">Nomor {{ $name }}</label>
                                <input type="text" name="ewallet_{{ $key }}_number" value="{{ setting('ewallet_' . $key . '_number') }}" 
                                    class="s-input" placeholder="Contoh: 081234567890">
                            </div>
                            <div class="s-form-group">
                                <label class="s-label">Instruksi Pembayaran</label>
                                <textarea name="ewallet_{{ $key }}_description" class="s-textarea" placeholder="Berikan instruksi singkat cara pembayaran">{{ setting('ewallet_' . $key . '_description') }}</textarea>
                            </div>
                        </div>
                    @endforeach

                    <div class="s-divider"></div>
                    <div class="flex justify-end">
                        <button type="submit" class="s-btn s-btn-success">Simpan E-Wallet</button>
                    </div>
                </form>
            </div>

            <!-- SYSTEM TAB -->
            <div x-show="activeTab === 'system'" x-transition class="sc">
                <h2 class="sc-title">Pengaturan Sistem</h2>
                <form action="{{ route('settings.update.system') }}" method="POST" class="space-y-6">
                    @csrf
                    <div class="s-form-group">
                        <label class="s-label">Metode Pembayaran Default</label>
                        <select name="default_payment" class="s-select">
                            <option value="cash" {{ setting('default_payment') == 'cash' ? 'selected' : '' }}>💵 Tunai</option>
                            <option value="debit" {{ setting('default_payment') == 'debit' ? 'selected' : '' }}>🏦 Kartu Debit</option>
                            <option value="qris" {{ setting('default_payment') == 'qris' ? 'selected' : '' }}>📲 QRIS</option>
                            <option value="ewallet" {{ setting('default_payment') == 'ewallet' ? 'selected' : '' }}>💳 E-Wallet</option>
                        </select>
                    </div>

                    <div class="s-divider"></div>

                    <div>
                        <p style="font-size: 0.85rem; font-weight: 700; color: var(--txt1); margin-bottom: 1rem; text-transform: uppercase; letter-spacing: 0.3px;">Otomasi & Notifikasi</p>
                        
                        <div class="s-checkbox">
                            <input type="checkbox" id="auto_print" name="auto_print" value="1" {{ setting('auto_print') == '1' ? 'checked' : '' }}>
                            <label for="auto_print">Cetak otomatis setelah transaksi</label>
                        </div>
                        
                        <div class="s-checkbox">
                            <input type="checkbox" id="enable_notifications" name="enable_notifications" value="1" {{ setting('enable_notifications') == '1' ? 'checked' : '' }}>
                            <label for="enable_notifications">Aktifkan notifikasi WhatsApp</label>
                        </div>
                    </div>

                    <div class="s-divider"></div>
                    <div class="flex justify-end">
                        <button type="submit" class="s-btn s-btn-danger">Simpan Sistem</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
@extends('layouts.app')

@section('page-title', 'Pengaturan')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-slate-900 via-slate-800 to-slate-900 py-8 px-4">
    <div class="max-w-4xl mx-auto">
        <!-- Header -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-white">Pengaturan Toko</h1>
            <p class="text-slate-400 mt-2">Kelola informasi dan preferensi toko Anda</p>
        </div>

        <!-- Alerts -->
        @if(session('success'))
            <div class="mb-6 p-4 rounded-lg bg-emerald-500/10 border border-emerald-500/30 text-emerald-400 flex items-center gap-3">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                <span>{{ session('success') }}</span>
            </div>
        @endif

        <!-- Tabs & Content Wrapper -->
        <div x-data="{ activeTab: 'general' }">
            <!-- Tabs Navigation -->
            <div class="flex gap-2 mb-6 border-b border-slate-700/50">
                <button @click="activeTab = 'general'" :class="{ 'border-b-2 border-cyan-500 text-cyan-400': activeTab === 'general', 'text-slate-400': activeTab !== 'general' }" class="px-4 py-3 font-medium transition">
                    Identitas Toko
                </button>
                <button @click="activeTab = 'qris'" :class="{ 'border-b-2 border-purple-500 text-purple-400': activeTab === 'qris', 'text-slate-400': activeTab !== 'qris' }" class="px-4 py-3 font-medium transition">
                    QRIS
                </button>
                <button @click="activeTab = 'ewallet'" :class="{ 'border-b-2 border-emerald-500 text-emerald-400': activeTab === 'ewallet', 'text-slate-400': activeTab !== 'ewallet' }" class="px-4 py-3 font-medium transition">
                    E-Wallet
                </button>
                <button @click="activeTab = 'system'" :class="{ 'border-b-2 border-orange-500 text-orange-400': activeTab === 'system', 'text-slate-400': activeTab !== 'system' }" class="px-4 py-3 font-medium transition">
                    Sistem
                </button>
            </div>

            <!-- Content -->
            <div class="bg-slate-800/50 backdrop-blur-md border border-slate-700/50 rounded-xl p-6">
            
            <!-- GENERAL TAB -->
            <div x-show="activeTab === 'general'" class="animate-fade">
                <h2 class="text-2xl font-bold text-white mb-6">Identitas Toko</h2>
                <form action="{{ route('settings.update.general') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium text-white mb-2">Nama Toko</label>
                            <input type="text" name="store_name" value="{{ old('store_name', $settings['store_name'] ?? '') }}" required 
                                class="w-full px-4 py-2 bg-slate-700/50 border border-slate-600/50 rounded-lg text-white focus:ring-2 focus:ring-cyan-500/50 outline-none">
                        </div>
                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium text-white mb-2">Alamat</label>
                            <textarea name="store_address" rows="2" class="w-full px-4 py-2 bg-slate-700/50 border border-slate-600/50 rounded-lg text-white focus:ring-2 focus:ring-cyan-500/50 outline-none">{{ old('store_address', $settings['store_address'] ?? '') }}</textarea>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-white mb-2">Telepon</label>
                            <input type="text" name="store_phone" value="{{ old('store_phone', $settings['store_phone'] ?? '') }}" class="w-full px-4 py-2 bg-slate-700/50 border border-slate-600/50 rounded-lg text-white focus:ring-2 focus:ring-cyan-500/50 outline-none">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-white mb-2">Email</label>
                            <input type="email" name="store_email" value="{{ old('store_email', $settings['store_email'] ?? '') }}" class="w-full px-4 py-2 bg-slate-700/50 border border-slate-600/50 rounded-lg text-white focus:ring-2 focus:ring-cyan-500/50 outline-none">
                        </div>
                    </div>
                    <div class="flex justify-end pt-6 border-t border-slate-700/50">
                        <button type="submit" class="px-6 py-2 bg-gradient-to-r from-cyan-600 to-blue-600 text-white rounded-lg font-medium hover:from-cyan-500 hover:to-blue-500 transition">
                            Simpan
                        </button>
                    </div>
                </form>
            </div>

            <!-- QRIS TAB -->
            <div x-show="activeTab === 'qris'" class="animate-fade">
                <h2 class="text-2xl font-bold text-white mb-6">Pembayaran QRIS</h2>
                <form action="{{ route('settings.update.qris') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                    @csrf
                    <div class="flex flex-col md:flex-row items-center gap-8">
                        <div class="shrink-0 text-center">
                            <div class="w-40 h-40 rounded-lg border-2 border-slate-600/50 bg-slate-700/30 flex items-center justify-center overflow-hidden">
                                @if(setting('qris_image'))
                                    <img src="{{ asset('storage/' . setting('qris_image')) }}" alt="QRIS" class="w-full h-full object-cover">
                                @else
                                    <div class="text-center">
                                        <svg class="w-12 h-12 text-slate-500 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm12 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z"/></svg>
                                        <p class="text-slate-400 text-sm">Belum ada QR</p>
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="flex-1 w-full">
                            <label class="block text-sm font-medium text-white mb-2">Upload QR Code</label>
                            <input type="file" name="qris_image" accept="image/*" class="w-full px-4 py-2 bg-slate-700/50 border border-slate-600/50 rounded-lg text-slate-300 focus:ring-2 focus:ring-purple-500/50 outline-none">
                        </div>
                    </div>
                    <div class="flex justify-end pt-6 border-t border-slate-700/50">
                        <button type="submit" class="px-6 py-2 bg-gradient-to-r from-purple-600 to-pink-600 text-white rounded-lg font-medium hover:from-purple-500 hover:to-pink-500 transition">
                            Update
                        </button>
                    </div>
                </form>
            </div>

            <!-- EWALLET TAB -->
            <div x-show="activeTab === 'ewallet'" class="animate-fade">
                <h2 class="text-2xl font-bold text-white mb-6">Pengaturan E-Wallet</h2>
                <form action="{{ route('settings.update.ewallet') }}" method="POST" class="space-y-8">
                    @csrf
                    
                    <!-- DANA -->
                    <div class="pb-6 border-b border-slate-700/50">
                        <h3 class="text-lg font-bold text-white mb-4">DANA</h3>
                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-white mb-1">Nomor DANA</label>
                                <input type="text" name="ewallet_dana_number" value="{{ setting('ewallet_dana_number') }}" placeholder="081234567890" 
                                    class="w-full px-4 py-2 bg-slate-700/50 border border-slate-600/50 rounded-lg text-white focus:ring-2 focus:ring-cyan-500/50 outline-none">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-white mb-1">Instruksi</label>
                                <textarea name="ewallet_dana_description" rows="2" placeholder="Transfer ke nomor di atas" class="w-full px-4 py-2 bg-slate-700/50 border border-slate-600/50 rounded-lg text-white focus:ring-2 focus:ring-cyan-500/50 outline-none">{{ setting('ewallet_dana_description') }}</textarea>
                            </div>
                        </div>
                    </div>

                    <!-- GoPay -->
                    <div class="pb-6 border-b border-slate-700/50">
                        <h3 class="text-lg font-bold text-white mb-4">GoPay</h3>
                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-white mb-1">Nomor GoPay</label>
                                <input type="text" name="ewallet_gopay_number" value="{{ setting('ewallet_gopay_number') }}" placeholder="081234567890" 
                                    class="w-full px-4 py-2 bg-slate-700/50 border border-slate-600/50 rounded-lg text-white focus:ring-2 focus:ring-cyan-500/50 outline-none">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-white mb-1">Instruksi</label>
                                <textarea name="ewallet_gopay_description" rows="2" placeholder="Scan atau input nomor" class="w-full px-4 py-2 bg-slate-700/50 border border-slate-600/50 rounded-lg text-white focus:ring-2 focus:ring-cyan-500/50 outline-none">{{ setting('ewallet_gopay_description') }}</textarea>
                            </div>
                        </div>
                    </div>

                    <!-- OVO -->
                    <div class="pb-6 border-b border-slate-700/50">
                        <h3 class="text-lg font-bold text-white mb-4">OVO</h3>
                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-white mb-1">Nomor OVO</label>
                                <input type="text" name="ewallet_ovo_number" value="{{ setting('ewallet_ovo_number') }}" placeholder="081234567890" 
                                    class="w-full px-4 py-2 bg-slate-700/50 border border-slate-600/50 rounded-lg text-white focus:ring-2 focus:ring-cyan-500/50 outline-none">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-white mb-1">Instruksi</label>
                                <textarea name="ewallet_ovo_description" rows="2" placeholder="Gunakan Send Money" class="w-full px-4 py-2 bg-slate-700/50 border border-slate-600/50 rounded-lg text-white focus:ring-2 focus:ring-cyan-500/50 outline-none">{{ setting('ewallet_ovo_description') }}</textarea>
                            </div>
                        </div>
                    </div>

                    <!-- ShopeePay -->
                    <div class="pb-6 border-b border-slate-700/50">
                        <h3 class="text-lg font-bold text-white mb-4">ShopeePay</h3>
                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-white mb-1">Nomor ShopeePay</label>
                                <input type="text" name="ewallet_shopeepay_number" value="{{ setting('ewallet_shopeepay_number') }}" placeholder="081234567890" 
                                    class="w-full px-4 py-2 bg-slate-700/50 border border-slate-600/50 rounded-lg text-white focus:ring-2 focus:ring-cyan-500/50 outline-none">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-white mb-1">Instruksi</label>
                                <textarea name="ewallet_shopeepay_description" rows="2" placeholder="Tap untuk pembayaran" class="w-full px-4 py-2 bg-slate-700/50 border border-slate-600/50 rounded-lg text-white focus:ring-2 focus:ring-cyan-500/50 outline-none">{{ setting('ewallet_shopeepay_description') }}</textarea>
                            </div>
                        </div>
                    </div>

                    <div class="flex justify-end pt-6">
                        <button type="submit" class="px-6 py-2 bg-gradient-to-r from-emerald-600 to-teal-600 text-white rounded-lg font-medium hover:from-emerald-500 hover:to-teal-500 transition">
                            Simpan E-Wallet
                        </button>
                    </div>
                </form>
            </div>

            <!-- SYSTEM TAB -->
            <div x-show="activeTab === 'system'" class="animate-fade">
                <h2 class="text-2xl font-bold text-white mb-6">Pengaturan Sistem</h2>
                <form action="{{ route('settings.update.system') }}" method="POST" class="space-y-6">
                    @csrf
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-white mb-2">Metode Pembayaran Default</label>
                            <select name="default_payment" class="w-full px-4 py-2 bg-slate-700/50 border border-slate-600/50 rounded-lg text-white focus:ring-2 focus:ring-orange-500/50 outline-none">
                                <option value="cash" {{ setting('default_payment') == 'cash' ? 'selected' : '' }}>Tunai</option>
                                <option value="debit" {{ setting('default_payment') == 'debit' ? 'selected' : '' }}>Debit</option>
                                <option value="qris" {{ setting('default_payment') == 'qris' ? 'selected' : '' }}>QRIS</option>
                                <option value="ewallet" {{ setting('default_payment') == 'ewallet' ? 'selected' : '' }}>E-Wallet</option>
                            </select>
                        </div>
                        <div class="space-y-3 pt-4 border-t border-slate-700/50">
                            <label class="flex items-center gap-3 cursor-pointer">
                                <input type="checkbox" name="auto_print" value="1" {{ setting('auto_print') == '1' ? 'checked' : '' }} class="w-4 h-4 rounded">
                                <span class="text-white">Cetak otomatis setelah transaksi</span>
                            </label>
                            <label class="flex items-center gap-3 cursor-pointer">
                                <input type="checkbox" name="enable_notifications" value="1" {{ setting('enable_notifications') == '1' ? 'checked' : '' }} class="w-4 h-4 rounded">
                                <span class="text-white">Aktifkan notifikasi WhatsApp</span>
                            </label>
                        </div>
                    </div>
                    <div class="flex justify-end pt-6 border-t border-slate-700/50">
                        <button type="submit" class="px-6 py-2 bg-gradient-to-r from-orange-600 to-red-600 text-white rounded-lg font-medium hover:from-orange-500 hover:to-red-500 transition">
                            Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<style>
    @keyframes fade {
        from { opacity: 0; }
        to { opacity: 1; }
    }
    .animate-fade {
        animation: fade 0.2s ease-in-out;
    }
</style>
@endsection
@extends('layouts.app')

@section('page-title', 'Pengaturan')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-slate-900 via-slate-800 to-slate-900 py-8 px-4">
    <div class="max-w-4xl mx-auto">
        <!-- Header -->
        <div class="mb-12">
            <div class="flex items-center gap-4 mb-4">
                <div class="w-12 h-12 rounded-2xl bg-gradient-to-br from-cyan-500 to-blue-600 flex items-center justify-center">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                </div>
                <div>
                    <h1 class="text-3xl font-bold text-white">Pengaturan Toko</h1>
                    <p class="text-slate-400 mt-1">Kelola identitas, pembayaran, dan sistem Anda</p>
                </div>
            </div>
        </div>

        <!-- Alerts -->
        @if(session('success'))
            <div class="mb-6 p-4 rounded-xl bg-emerald-500/10 border border-emerald-500/30 text-emerald-400 flex items-center gap-3 backdrop-blur-sm">
                <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                <span>{{ session('success') }}</span>
            </div>
        @endif
        @if(session('error'))
            <div class="mb-6 p-4 rounded-xl bg-rose-500/10 border border-rose-500/30 text-rose-400 flex items-center gap-3 backdrop-blur-sm">
                <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                <span>{{ session('error') }}</span>
            </div>
        @endif

        <!-- Settings Cards Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8" x-data="{ activeCard: 'general' }">
            
            <!-- CARD 1: Identitas Toko -->
            <div @click="activeCard = 'general'" class="group relative text-left hover:z-10 cursor-pointer">
                <div class="absolute inset-0 bg-gradient-to-r from-cyan-600 to-blue-600 rounded-2xl blur-xl opacity-0 group-hover:opacity-20 transition duration-300"></div>
                <div class="relative bg-slate-800/50 backdrop-blur-md border border-slate-700/50 rounded-2xl p-6 cursor-pointer transition-all duration-300 hover:border-cyan-500/50 hover:bg-slate-700/50 h-full">
                    <div class="flex items-center gap-4 mb-4">
                        <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-cyan-500 to-blue-600 flex items-center justify-center flex-shrink-0">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21H5a2 2 0 01-2-2V5a2 2 0 012-2h11l5 5v11a2 2 0 01-2 2z"/></svg>
                        </div>
                        <div>
                            <h3 class="text-lg font-bold text-white">Identitas Toko</h3>
                            <p class="text-sm text-slate-400">Nama, alamat, kontak</p>
                        </div>
                    </div>
                    <p class="text-slate-300 text-sm">Atur informasi identitas dan data kontak toko Anda</p>
                </div>
            </div>

            <!-- CARD 2: QRIS -->
            <div @click="activeCard = 'qris'" class="group relative text-left hover:z-10 cursor-pointer">
                <div class="absolute inset-0 bg-gradient-to-r from-purple-600 to-pink-600 rounded-2xl blur-xl opacity-0 group-hover:opacity-20 transition duration-300"></div>
                <div class="relative bg-slate-800/50 backdrop-blur-md border border-slate-700/50 rounded-2xl p-6 cursor-pointer transition-all duration-300 hover:border-purple-500/50 hover:bg-slate-700/50 h-full">
                    <div class="flex items-center gap-4 mb-4">
                        <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-purple-500 to-pink-600 flex items-center justify-center flex-shrink-0">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm12 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z"/></svg>
                        </div>
                        <div>
                            <h3 class="text-lg font-bold text-white">Pembayaran QRIS</h3>
                            <p class="text-sm text-slate-400">Upload QR Code</p>
                        </div>
                    </div>
                    <p class="text-slate-300 text-sm">Kelola QR Code QRIS untuk pembayaran digital</p>
                </div>
            </div>

            <!-- CARD 3: E-Wallet -->
            <div @click="activeCard = 'ewallet'" class="group relative text-left hover:z-10 cursor-pointer">
                <div class="absolute inset-0 bg-gradient-to-r from-emerald-600 to-teal-600 rounded-2xl blur-xl opacity-0 group-hover:opacity-20 transition duration-300"></div>
                <div class="relative bg-slate-800/50 backdrop-blur-md border border-slate-700/50 rounded-2xl p-6 cursor-pointer transition-all duration-300 hover:border-emerald-500/50 hover:bg-slate-700/50 h-full">
                    <div class="flex items-center gap-4 mb-4">
                        <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-emerald-500 to-teal-600 flex items-center justify-center flex-shrink-0">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M3 14h18m-9-4v8m-7 0h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"/></svg>
                        </div>
                        <div>
                            <h3 class="text-lg font-bold text-white">E-Wallet</h3>
                            <p class="text-sm text-slate-400">DANA, GoPay, OVO, ShopeePay</p>
                        </div>
                    </div>
                    <p class="text-slate-300 text-sm">Atur nomor akun dan instruksi setiap e-wallet</p>
                </div>
            </div>

            <!-- CARD 4: Sistem -->
            <div @click="activeCard = 'system'" class="group relative text-left hover:z-10 cursor-pointer">
                <div class="absolute inset-0 bg-gradient-to-r from-orange-600 to-red-600 rounded-2xl blur-xl opacity-0 group-hover:opacity-20 transition duration-300"></div>
                <div class="relative bg-slate-800/50 backdrop-blur-md border border-slate-700/50 rounded-2xl p-6 cursor-pointer transition-all duration-300 hover:border-orange-500/50 hover:bg-slate-700/50 h-full">
                    <div class="flex items-center gap-4 mb-4">
                        <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-orange-500 to-red-600 flex items-center justify-center flex-shrink-0">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        </div>
                        <div>
                            <h3 class="text-lg font-bold text-white">Sistem</h3>
                            <p class="text-sm text-slate-400">Pengaturan otomasi</p>
                        </div>
                    </div>
                    <p class="text-slate-300 text-sm">Kelola preferensi sistem dan otomasi toko</p>
                </div>
            </div>
        </div>

        <!-- Content Section -->
        <div>
            <!-- GENERAL -->
            <div x-show="activeCard === 'general'" class="animate-fade">
                <div class="bg-slate-800/50 backdrop-blur-md border border-slate-700/50 rounded-2xl p-8">
                    <div class="mb-8 pb-6 border-b border-slate-700/50">
                        <h2 class="text-2xl font-bold text-white mb-1">Identitas Toko</h2>
                        <p class="text-slate-400">Atur informasi dasar tentang toko Anda</p>
                    </div>
                    
                    <form action="{{ route('settings.update.general') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                        @csrf
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="md:col-span-2">
                                <label class="block text-sm font-semibold text-white mb-3">Nama Toko</label>
                                <input type="text" name="store_name" value="{{ old('store_name', $settings['store_name'] ?? '') }}" required 
                                    class="w-full px-4 py-3 bg-slate-700/50 border border-slate-600/50 rounded-xl text-white placeholder-slate-500 focus:ring-2 focus:ring-cyan-500/50 focus:border-cyan-500/50 outline-none transition">
                            </div>
                            <div class="md:col-span-2">
                                <label class="block text-sm font-semibold text-white mb-3">Alamat Toko</label>
                                <textarea name="store_address" rows="2" 
                                    class="w-full px-4 py-3 bg-slate-700/50 border border-slate-600/50 rounded-xl text-white placeholder-slate-500 focus:ring-2 focus:ring-cyan-500/50 focus:border-cyan-500/50 outline-none transition">{{ old('store_address', $settings['store_address'] ?? '') }}</textarea>
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-white mb-3">Telepon</label>
                                <input type="text" name="store_phone" value="{{ old('store_phone', $settings['store_phone'] ?? '') }}" 
                                    class="w-full px-4 py-3 bg-slate-700/50 border border-slate-600/50 rounded-xl text-white placeholder-slate-500 focus:ring-2 focus:ring-cyan-500/50 focus:border-cyan-500/50 outline-none transition">
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-white mb-3">Email</label>
                                <input type="email" name="store_email" value="{{ old('store_email', $settings['store_email'] ?? '') }}" 
                                    class="w-full px-4 py-3 bg-slate-700/50 border border-slate-600/50 rounded-xl text-white placeholder-slate-500 focus:ring-2 focus:ring-cyan-500/50 focus:border-cyan-500/50 outline-none transition">
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-white mb-3">Pajak (%)</label>
                                <input type="number" name="tax_rate" value="{{ old('tax_rate', $settings['tax_rate'] ?? '0') }}" step="0.01" 
                                    class="w-full px-4 py-3 bg-slate-700/50 border border-slate-600/50 rounded-xl text-white placeholder-slate-500 focus:ring-2 focus:ring-cyan-500/50 focus:border-cyan-500/50 outline-none transition">
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-white mb-3">Ganti Logo</label>
                                <input type="file" name="logo" accept="image/*" 
                                    class="block w-full text-sm text-slate-400 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-cyan-600 file:text-white hover:file:bg-cyan-700 transition">
                            </div>
                        </div>
                        <div class="flex justify-end pt-6 border-t border-slate-700/50">
                            <button type="submit" class="px-6 py-3 bg-gradient-to-r from-cyan-600 to-blue-600 text-white rounded-xl font-semibold hover:from-cyan-500 hover:to-blue-500 transition shadow-lg shadow-cyan-500/20">
                                Simpan Perubahan
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- QRIS -->
            <div x-show="activeCard === 'qris'" class="animate-fade">
                <div class="bg-slate-800/50 backdrop-blur-md border border-slate-700/50 rounded-2xl p-8">
                    <div class="mb-8 pb-6 border-b border-slate-700/50">
                        <h2 class="text-2xl font-bold text-white mb-1">Pembayaran QRIS</h2>
                        <p class="text-slate-400">Kelola QR Code QRIS Anda</p>
                    </div>
                    
                    <form action="{{ route('settings.update.qris') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                        @csrf
                        <div class="flex flex-col md:flex-row items-center gap-8">
                            <div class="shrink-0 text-center">
                                <div class="w-48 h-48 rounded-2xl border-2 border-slate-600/50 bg-slate-700/30 flex items-center justify-center overflow-hidden">
                                    @if(setting('qris_image'))
                                        <img src="{{ asset('storage/' . setting('qris_image')) }}" alt="QRIS" class="w-full h-full object-cover">
                                    @else
                                        <div class="text-center">
                                            <svg class="w-12 h-12 text-slate-500 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm12 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z"/></svg>
                                            <p class="text-slate-400 text-sm">Belum ada QR</p>
                                        </div>
                                    @endif
                                </div>
                                <p class="text-slate-400 mt-3 text-sm">QR Code Aktif</p>
                            </div>
                            <div class="flex-1 w-full">
                                <label class="block text-sm font-semibold text-white mb-3">Upload QR Code Baru</label>
                                <div class="border-2 border-dashed border-slate-600/50 rounded-xl p-6 text-center cursor-pointer hover:border-cyan-500/50 transition">
                                    <input type="file" name="qris_image" accept="image/*" required class="hidden" id="qris-input">
                                    <label for="qris-input" class="cursor-pointer">
                                        <svg class="w-8 h-8 text-slate-500 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                                        <p class="text-slate-300 font-medium">Klik untuk upload atau drag & drop</p>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="flex justify-end pt-6 border-t border-slate-700/50">
                            <button type="submit" class="px-6 py-3 bg-gradient-to-r from-purple-600 to-pink-600 text-white rounded-xl font-semibold hover:from-purple-500 hover:to-pink-500 transition shadow-lg shadow-purple-500/20">
                                Update QR Code
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- EWALLET -->
            <div x-show="activeCard === 'ewallet'" class="animate-fade">
                <div class="bg-slate-800/50 backdrop-blur-md border border-slate-700/50 rounded-2xl p-8">
                    <div class="mb-8 pb-6 border-b border-slate-700/50">
                        <h2 class="text-2xl font-bold text-white mb-1">Pengaturan E-Wallet</h2>
                        <p class="text-slate-400">Kelola nomor akun dan instruksi pembayaran</p>
                    </div>
                    
                    <form action="{{ route('settings.update.ewallet') }}" method="POST" class="space-y-8 divide-y divide-slate-700/50">
                        @csrf
                        
                        <!-- DANA -->
                        <div class="pb-8">
                            <div class="flex items-center gap-3 mb-6">
                                <div class="w-12 h-12 rounded-xl flex items-center justify-center text-white font-bold text-lg" style="background:#118EEA;">D</div>
                                <div>
                                    <h3 class="text-lg font-bold text-white">DANA</h3>
                                    <p class="text-sm text-slate-400">Pengaturan akun DANA Anda</p>
                                </div>
                            </div>
                            <div class="space-y-4">
                                <div>
                                    <label for="ewallet_dana_number" class="block text-sm font-medium text-slate-300 mb-2">Nomor DANA</label>
                                    <input type="text" id="ewallet_dana_number" name="ewallet_dana_number" 
                                        value="{{ setting('ewallet_dana_number') }}" 
                                        placeholder="Contoh: 081234567890"
                                        class="w-full px-4 py-3 bg-slate-700/50 border border-slate-600/50 rounded-xl text-white placeholder-slate-500 focus:ring-2 focus:ring-cyan-500/50 outline-none transition">
                                </div>
                                <div>
                                    <label for="ewallet_dana_description" class="block text-sm font-medium text-slate-300 mb-2">Instruksi Pembayaran</label>
                                    <textarea id="ewallet_dana_description" name="ewallet_dana_description" 
                                        rows="2"
                                        placeholder="Contoh: Transfer ke nomor di atas"
                                        class="w-full px-4 py-3 bg-slate-700/50 border border-slate-600/50 rounded-xl text-white placeholder-slate-500 focus:ring-2 focus:ring-cyan-500/50 outline-none transition">{{ setting('ewallet_dana_description') }}</textarea>
                                </div>
                            </div>
                        </div>

                        <!-- GoPay -->
                        <div class="py-8">
                            <div class="flex items-center gap-3 mb-6">
                                <div class="w-12 h-12 rounded-xl flex items-center justify-center text-white font-bold text-lg" style="background:#00AA13;">G</div>
                                <div>
                                    <h3 class="text-lg font-bold text-white">GoPay</h3>
                                    <p class="text-sm text-slate-400">Pengaturan akun GoPay Anda</p>
                                </div>
                            </div>
                            <div class="space-y-4">
                                <div>
                                    <label for="ewallet_gopay_number" class="block text-sm font-medium text-slate-300 mb-2">Nomor GoPay</label>
                                    <input type="text" id="ewallet_gopay_number" name="ewallet_gopay_number" 
                                        value="{{ setting('ewallet_gopay_number') }}" 
                                        placeholder="Contoh: 081234567890"
                                        class="w-full px-4 py-3 bg-slate-700/50 border border-slate-600/50 rounded-xl text-white placeholder-slate-500 focus:ring-2 focus:ring-cyan-500/50 outline-none transition">
                                </div>
                                <div>
                                    <label for="ewallet_gopay_description" class="block text-sm font-medium text-slate-300 mb-2">Instruksi Pembayaran</label>
                                    <textarea id="ewallet_gopay_description" name="ewallet_gopay_description" 
                                        rows="2"
                                        placeholder="Contoh: Scan barcode atau input nomor di atas"
                                        class="w-full px-4 py-3 bg-slate-700/50 border border-slate-600/50 rounded-xl text-white placeholder-slate-500 focus:ring-2 focus:ring-cyan-500/50 outline-none transition">{{ setting('ewallet_gopay_description') }}</textarea>
                                </div>
                            </div>
                        </div>

                        <!-- OVO -->
                        <div class="py-8">
                            <div class="flex items-center gap-3 mb-6">
                                <div class="w-12 h-12 rounded-xl flex items-center justify-center text-white font-bold text-lg" style="background:#4C3494;">O</div>
                                <div>
                                    <h3 class="text-lg font-bold text-white">OVO</h3>
                                    <p class="text-sm text-slate-400">Pengaturan akun OVO Anda</p>
                                </div>
                            </div>
                            <div class="space-y-4">
                                <div>
                                    <label for="ewallet_ovo_number" class="block text-sm font-medium text-slate-300 mb-2">Nomor OVO</label>
                                    <input type="text" id="ewallet_ovo_number" name="ewallet_ovo_number" 
                                        value="{{ setting('ewallet_ovo_number') }}" 
                                        placeholder="Contoh: 081234567890"
                                        class="w-full px-4 py-3 bg-slate-700/50 border border-slate-600/50 rounded-xl text-white placeholder-slate-500 focus:ring-2 focus:ring-cyan-500/50 outline-none transition">
                                </div>
                                <div>
                                    <label for="ewallet_ovo_description" class="block text-sm font-medium text-slate-300 mb-2">Instruksi Pembayaran</label>
                                    <textarea id="ewallet_ovo_description" name="ewallet_ovo_description" 
                                        rows="2"
                                        placeholder="Contoh: Gunakan fitur Send Money"
                                        class="w-full px-4 py-3 bg-slate-700/50 border border-slate-600/50 rounded-xl text-white placeholder-slate-500 focus:ring-2 focus:ring-cyan-500/50 outline-none transition">{{ setting('ewallet_ovo_description') }}</textarea>
                                </div>
                            </div>
                        </div>

                        <!-- ShopeePay -->
                        <div class="py-8">
                            <div class="flex items-center gap-3 mb-6">
                                <div class="w-12 h-12 rounded-xl flex items-center justify-center text-white font-bold text-lg" style="background:#EE4D2D;">S</div>
                                <div>
                                    <h3 class="text-lg font-bold text-white">ShopeePay</h3>
                                    <p class="text-sm text-slate-400">Pengaturan akun ShopeePay Anda</p>
                                </div>
                            </div>
                            <div class="space-y-4">
                                <div>
                                    <label for="ewallet_shopeepay_number" class="block text-sm font-medium text-slate-300 mb-2">Nomor ShopeePay</label>
                                    <input type="text" id="ewallet_shopeepay_number" name="ewallet_shopeepay_number" 
                                        value="{{ setting('ewallet_shopeepay_number') }}" 
                                        placeholder="Contoh: 081234567890"
                                        class="w-full px-4 py-3 bg-slate-700/50 border border-slate-600/50 rounded-xl text-white placeholder-slate-500 focus:ring-2 focus:ring-cyan-500/50 outline-none transition">
                                </div>
                                <div>
                                    <label for="ewallet_shopeepay_description" class="block text-sm font-medium text-slate-300 mb-2">Instruksi Pembayaran</label>
                                    <textarea id="ewallet_shopeepay_description" name="ewallet_shopeepay_description" 
                                        rows="2"
                                        placeholder="Contoh: Tap untuk pembayaran"
                                        class="w-full px-4 py-3 bg-slate-700/50 border border-slate-600/50 rounded-xl text-white placeholder-slate-500 focus:ring-2 focus:ring-cyan-500/50 outline-none transition">{{ setting('ewallet_shopeepay_description') }}</textarea>
                                </div>
                            </div>
                        </div>

                        <div class="pt-8 flex justify-end">
                            <button type="submit" class="px-6 py-3 bg-gradient-to-r from-emerald-600 to-teal-600 text-white rounded-xl font-semibold hover:from-emerald-500 hover:to-teal-500 transition shadow-lg shadow-emerald-500/20">
                                Simpan Pengaturan E-Wallet
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- SYSTEM -->
            <div x-show="activeCard === 'system'" class="animate-fade">
                <div class="bg-slate-800/50 backdrop-blur-md border border-slate-700/50 rounded-2xl p-8">
                    <div class="mb-8 pb-6 border-b border-slate-700/50">
                        <h2 class="text-2xl font-bold text-white mb-1">Pengaturan Sistem</h2>
                        <p class="text-slate-400">Kelola preferensi otomasi dan sistem</p>
                    </div>
                    
                    <form action="{{ route('settings.update.system') }}" method="POST" class="space-y-6">
                        @csrf
                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-semibold text-white mb-3">Metode Pembayaran Default</label>
                                <select name="default_payment" class="w-full px-4 py-3 bg-slate-700/50 border border-slate-600/50 rounded-xl text-white focus:ring-2 focus:ring-cyan-500/50 outline-none transition">
                                    <option value="cash" {{ setting('default_payment') == 'cash' ? 'selected' : '' }}>Tunai (Cash)</option>
                                    <option value="debit" {{ setting('default_payment') == 'debit' ? 'selected' : '' }}>Kartu Debit</option>
                                    <option value="qris" {{ setting('default_payment') == 'qris' ? 'selected' : '' }}>QRIS</option>
                                    <option value="ewallet" {{ setting('default_payment') == 'ewallet' ? 'selected' : '' }}>E-Wallet</option>
                                </select>
                            </div>

                            <div class="space-y-3 pt-4 border-t border-slate-700/50">
                                <label class="flex items-center gap-3 cursor-pointer">
                                    <input type="checkbox" name="auto_print" value="1" {{ setting('auto_print') == '1' ? 'checked' : '' }} class="w-5 h-5 rounded bg-slate-700/50 border-slate-600/50 text-cyan-600 cursor-pointer">
                                    <span class="text-white font-medium">Cetak otomatis setelah transaksi</span>
                                </label>
                                <label class="flex items-center gap-3 cursor-pointer">
                                    <input type="checkbox" name="enable_notifications" value="1" {{ setting('enable_notifications') == '1' ? 'checked' : '' }} class="w-5 h-5 rounded bg-slate-700/50 border-slate-600/50 text-cyan-600 cursor-pointer">
                                    <span class="text-white font-medium">Aktifkan notifikasi WhatsApp</span>
                                </label>
                            </div>
                        </div>

                        <div class="flex justify-end pt-6 border-t border-slate-700/50">
                            <button type="submit" class="px-6 py-3 bg-gradient-to-r from-orange-600 to-red-600 text-white rounded-xl font-semibold hover:from-orange-500 hover:to-red-500 transition shadow-lg shadow-orange-500/20">
                                Simpan Pengaturan Sistem
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    @keyframes fade {
        from { opacity: 0; }
        to { opacity: 1; }
    }
    .animate-fade {
        animation: fade 0.3s ease-in-out;
    }
</style>
@endsection
@extends('layouts.app')

@section('page-title', 'Pengaturan')

@section('content')
<div class="max-w-4xl mx-auto space-y-6 fade-in" x-data="{ tab: 'general' }">
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold text-slate-900 dark:text-white">Pengaturan Toko</h1>
            <p class="text-sm text-slate-500 dark:text-slate-400 mt-1">Kelola identitas, QRIS, dan sistem</p>
        </div>
    </div>

    @if(session('success'))
        <div class="p-4 rounded-xl bg-emerald-50 dark:bg-emerald-900/30 border border-emerald-200 dark:border-emerald-800 text-emerald-700 dark:text-emerald-300 flex items-center gap-2">
            <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
            {{ session('success') }}
        </div>
    @endif
    @if(session('error'))
        <div class="p-4 rounded-xl bg-rose-50 dark:bg-rose-900/30 border border-rose-200 dark:border-rose-800 text-rose-700 dark:text-rose-300 flex items-center gap-2">
            <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            {{ session('error') }}
        </div>
    @endif

    <!-- Tabs -->
    <div class="bg-white dark:bg-slate-900 rounded-3xl border border-slate-200 dark:border-slate-800 shadow-soft overflow-hidden">
        <div class="flex border-b border-slate-200 dark:border-slate-800">
            <button @click="tab = 'general'" :class="tab === 'general' ? 'border-cyan-500 text-cyan-600 dark:text-cyan-400 bg-cyan-50 dark:bg-cyan-900/20' : 'border-transparent text-slate-500 hover:text-slate-700 dark:hover:text-slate-300'" class="flex-1 px-6 py-4 text-sm font-semibold border-b-2 smooth">Umum & Identitas</button>
            <button @click="tab = 'qris'" :class="tab === 'qris' ? 'border-cyan-500 text-cyan-600 dark:text-cyan-400 bg-cyan-50 dark:bg-cyan-900/20' : 'border-transparent text-slate-500 hover:text-slate-700 dark:hover:text-slate-300'" class="flex-1 px-6 py-4 text-sm font-semibold border-b-2 smooth">QR Code & Pembayaran</button>
            <button @click="tab = 'ewallet'" :class="tab === 'ewallet' ? 'border-cyan-500 text-cyan-600 dark:text-cyan-400 bg-cyan-50 dark:bg-cyan-900/20' : 'border-transparent text-slate-500 hover:text-slate-700 dark:hover:text-slate-300'" class="flex-1 px-6 py-4 text-sm font-semibold border-b-2 smooth">E-Wallet</button>
            <button @click="tab = 'system'" :class="tab === 'system' ? 'border-cyan-500 text-cyan-600 dark:text-cyan-400 bg-cyan-50 dark:bg-cyan-900/20' : 'border-transparent text-slate-500 hover:text-slate-700 dark:hover:text-slate-300'" class="flex-1 px-6 py-4 text-sm font-semibold border-b-2 smooth">Sistem</button>
        </div>

        <!-- TAB 1: GENERAL -->
        <div x-show="tab === 'general'" class="p-6 lg:p-8">
            <form action="{{ route('settings.update.general') }}" method="POST" enctype="multipart/form-data" class="space-y-5">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <div class="md:col-span-2">
                        <label class="block text-sm font-semibold text-slate-900 dark:text-white mb-2">Nama Toko</label>
                        <input type="text" name="store_name" value="{{ old('store_name', $settings['store_name'] ?? '') }}" required class="w-full px-4 py-3 bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-xl focus:ring-2 focus:ring-cyan-500/20 focus:border-cyan-500 outline-none smooth dark:text-white">
                        @error('store_name') <p class="text-xs text-rose-500 mt-1">{{ $message }}</p> @enderror
                    </div>
                    <div class="md:col-span-2">
                        <label class="block text-sm font-semibold text-slate-900 dark:text-white mb-2">Alamat Toko</label>
                        <textarea name="store_address" rows="2" class="w-full px-4 py-3 bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-xl focus:ring-2 focus:ring-cyan-500/20 focus:border-cyan-500 outline-none smooth dark:text-white">{{ old('store_address', $settings['store_address'] ?? '') }}</textarea>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-slate-900 dark:text-white mb-2">Telepon</label>
                        <input type="text" name="store_phone" value="{{ old('store_phone', $settings['store_phone'] ?? '') }}" class="w-full px-4 py-3 bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-xl focus:ring-2 focus:ring-cyan-500/20 focus:border-cyan-500 outline-none smooth dark:text-white">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-slate-900 dark:text-white mb-2">Email</label>
                        <input type="email" name="store_email" value="{{ old('store_email', $settings['store_email'] ?? '') }}" class="w-full px-4 py-3 bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-xl focus:ring-2 focus:ring-cyan-500/20 focus:border-cyan-500 outline-none smooth dark:text-white">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-slate-900 dark:text-white mb-2">Pajak (%)</label>
                        <input type="number" name="tax_rate" value="{{ old('tax_rate', $settings['tax_rate'] ?? '0') }}" step="0.01" class="w-full px-4 py-3 bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-xl focus:ring-2 focus:ring-cyan-500/20 focus:border-cyan-500 outline-none smooth dark:text-white">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-slate-900 dark:text-white mb-2">Ganti Logo</label>
                        <input type="file" name="logo" accept="image/*" class="block w-full text-sm text-slate-500 dark:text-slate-400 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-sm file:font-semibold file:bg-cyan-50 file:text-cyan-700 hover:file:bg-cyan-100 dark:file:bg-cyan-900/30 dark:file:text-cyan-400">
                        @error('logo') <p class="text-xs text-rose-500 mt-1">{{ $message }}</p> @enderror
                    </div>
                </div>
                <div class="flex justify-end pt-4 border-t border-slate-200 dark:border-slate-800">
                    <button type="submit" class="px-6 py-3 gradient-primary text-white rounded-xl font-semibold shadow-lg shadow-cyan-500/30 hover:shadow-cyan-500/50 smooth active:scale-95">Simpan Perubahan</button>
                </div>
            </form>
        </div>

        <!-- TAB 2: QRIS -->
        <div x-show="tab === 'qris'" class="p-6 lg:p-8">
            <form action="{{ route('settings.update.qris') }}" method="POST" enctype="multipart/form-data" class="space-y-5">
                @csrf
                <div class="flex flex-col md:flex-row items-center gap-6">
                    <div class="shrink-0 text-center">
                        <img src="{{ setting('qris_image') ? imageUrl(setting('qris_image')) : 'https://placehold.co/200x200/f1f5f9/64748b?text=No+QR' }}" alt="QRIS" class="w-40 h-40 rounded-2xl object-cover border border-slate-200 dark:border-slate-700 shadow-soft">
                        <p class="text-xs text-slate-500 mt-2">QR Code Aktif</p>
                    </div>
                    <div class="flex-1 w-full">
                        <label class="block text-sm font-semibold text-slate-900 dark:text-white mb-2">Upload QR Code Baru</label>
                        <input type="file" name="qris_image" accept="image/*" required class="block w-full text-sm text-slate-500 dark:text-slate-400 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-sm file:font-semibold file:bg-cyan-50 file:text-cyan-700 hover:file:bg-cyan-100 dark:file:bg-cyan-900/30 dark:file:text-cyan-400">
                        @error('qris_image') <p class="text-xs text-rose-500 mt-1">{{ $message }}</p> @enderror
                    </div>
                </div>
                <div class="flex justify-end pt-4 border-t border-slate-200 dark:border-slate-800">
                    <button type="submit" class="px-6 py-3 gradient-primary text-white rounded-xl font-semibold shadow-lg shadow-cyan-500/30 hover:shadow-cyan-500/50 smooth active:scale-95">Update QR Code</button>
                </div>
            </form>
        </div>

        <!-- TAB 3: E-WALLET -->
        <div x-show="tab === 'ewallet'" class="p-6 lg:p-8">
            <form action="{{ route('settings.update.ewallet') }}" method="POST" class="space-y-6 divide-y divide-slate-200 dark:divide-slate-800">
                @csrf
                
                <!-- DANA -->
                <div class="pb-6">
                    <div class="flex items-center gap-3 mb-4">
                        <div class="w-10 h-10 rounded-lg flex items-center justify-center text-white font-bold" style="background:#118EEA;">D</div>
                        <div>
                            <h3 class="text-base font-bold text-slate-900 dark:text-white">DANA</h3>
                            <p class="text-sm text-slate-500 dark:text-slate-400">Pengaturan akun DANA</p>
                        </div>
                    </div>
                    
                    <div class="space-y-4">
                        <div>
                            <label for="ewallet_dana_number" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Nomor DANA</label>
                            <input type="text" id="ewallet_dana_number" name="ewallet_dana_number" 
                                value="{{ setting('ewallet_dana_number') }}" 
                                placeholder="Contoh: 081234567890"
                                class="w-full px-4 py-3 bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-xl focus:ring-2 focus:ring-cyan-500/20 focus:border-cyan-500 outline-none smooth dark:text-white">
                        </div>
                        <div>
                            <label for="ewallet_dana_description" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Instruksi Pembayaran</label>
                            <textarea id="ewallet_dana_description" name="ewallet_dana_description" 
                                rows="2"
                                placeholder="Contoh: Transfer ke nomor di atas"
                                class="w-full px-4 py-3 bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-xl focus:ring-2 focus:ring-cyan-500/20 focus:border-cyan-500 outline-none smooth dark:text-white">{{ setting('ewallet_dana_description') }}</textarea>
                        </div>
                    </div>
                </div>

                <!-- GoPay -->
                <div class="py-6">
                    <div class="flex items-center gap-3 mb-4">
                        <div class="w-10 h-10 rounded-lg flex items-center justify-center text-white font-bold" style="background:#00AA13;">G</div>
                        <div>
                            <h3 class="text-base font-bold text-slate-900 dark:text-white">GoPay</h3>
                            <p class="text-sm text-slate-500 dark:text-slate-400">Pengaturan akun GoPay</p>
                        </div>
                    </div>
                    
                    <div class="space-y-4">
                        <div>
                            <label for="ewallet_gopay_number" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Nomor GoPay</label>
                            <input type="text" id="ewallet_gopay_number" name="ewallet_gopay_number" 
                                value="{{ setting('ewallet_gopay_number') }}" 
                                placeholder="Contoh: 081234567890"
                                class="w-full px-4 py-3 bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-xl focus:ring-2 focus:ring-cyan-500/20 focus:border-cyan-500 outline-none smooth dark:text-white">
                        </div>
                        <div>
                            <label for="ewallet_gopay_description" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Instruksi Pembayaran</label>
                            <textarea id="ewallet_gopay_description" name="ewallet_gopay_description" 
                                rows="2"
                                placeholder="Contoh: Scan barcode atau input nomor di atas"
                                class="w-full px-4 py-3 bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-xl focus:ring-2 focus:ring-cyan-500/20 focus:border-cyan-500 outline-none smooth dark:text-white">{{ setting('ewallet_gopay_description') }}</textarea>
                        </div>
                    </div>
                </div>

                <!-- OVO -->
                <div class="py-6">
                    <div class="flex items-center gap-3 mb-4">
                        <div class="w-10 h-10 rounded-lg flex items-center justify-center text-white font-bold" style="background:#4C3494;">O</div>
                        <div>
                            <h3 class="text-base font-bold text-slate-900 dark:text-white">OVO</h3>
                            <p class="text-sm text-slate-500 dark:text-slate-400">Pengaturan akun OVO</p>
                        </div>
                    </div>
                    
                    <div class="space-y-4">
                        <div>
                            <label for="ewallet_ovo_number" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Nomor OVO</label>
                            <input type="text" id="ewallet_ovo_number" name="ewallet_ovo_number" 
                                value="{{ setting('ewallet_ovo_number') }}" 
                                placeholder="Contoh: 081234567890"
                                class="w-full px-4 py-3 bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-xl focus:ring-2 focus:ring-cyan-500/20 focus:border-cyan-500 outline-none smooth dark:text-white">
                        </div>
                        <div>
                            <label for="ewallet_ovo_description" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Instruksi Pembayaran</label>
                            <textarea id="ewallet_ovo_description" name="ewallet_ovo_description" 
                                rows="2"
                                placeholder="Contoh: Gunakan fitur Send Money"
                                class="w-full px-4 py-3 bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-xl focus:ring-2 focus:ring-cyan-500/20 focus:border-cyan-500 outline-none smooth dark:text-white">{{ setting('ewallet_ovo_description') }}</textarea>
                        </div>
                    </div>
                </div>

                <!-- ShopeePay -->
                <div class="py-6">
                    <div class="flex items-center gap-3 mb-4">
                        <div class="w-10 h-10 rounded-lg flex items-center justify-center text-white font-bold" style="background:#EE4D2D;">S</div>
                        <div>
                            <h3 class="text-base font-bold text-slate-900 dark:text-white">ShopeePay</h3>
                            <p class="text-sm text-slate-500 dark:text-slate-400">Pengaturan akun ShopeePay</p>
                        </div>
                    </div>
                    
                    <div class="space-y-4">
                        <div>
                            <label for="ewallet_shopeepay_number" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Nomor ShopeePay</label>
                            <input type="text" id="ewallet_shopeepay_number" name="ewallet_shopeepay_number" 
                                value="{{ setting('ewallet_shopeepay_number') }}" 
                                placeholder="Contoh: 081234567890"
                                class="w-full px-4 py-3 bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-xl focus:ring-2 focus:ring-cyan-500/20 focus:border-cyan-500 outline-none smooth dark:text-white">
                        </div>
                        <div>
                            <label for="ewallet_shopeepay_description" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Instruksi Pembayaran</label>
                            <textarea id="ewallet_shopeepay_description" name="ewallet_shopeepay_description" 
                                rows="2"
                                placeholder="Contoh: Tap untuk pembayaran"
                                class="w-full px-4 py-3 bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-xl focus:ring-2 focus:ring-cyan-500/20 focus:border-cyan-500 outline-none smooth dark:text-white">{{ setting('ewallet_shopeepay_description') }}</textarea>
                        </div>
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="pt-6 flex justify-end gap-3">
                    <button type="submit" class="px-6 py-3 gradient-primary text-white rounded-xl font-semibold shadow-lg shadow-cyan-500/30 hover:shadow-cyan-500/50 smooth active:scale-95">Simpan Pengaturan E-Wallet</button>
                </div>
            </form>
        </div>

        <!-- TAB 4: SYSTEM -->
        <div x-show="tab === 'system'" class="p-6 lg:p-8">
            <form action="{{ route('settings.update.system') }}" method="POST" class="space-y-5">
                @csrf
                <div>
                    <label class="block text-sm font-semibold text-slate-900 dark:text-white mb-2">Metode Pembayaran Default</label>
                    <select name="default_payment" class="w-full px-4 py-3 bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-xl focus:ring-2 focus:ring-cyan-500/20 focus:border-cyan-500 outline-none smooth dark:text-white">
                        <option value="cash" {{ (\App\Models\Setting::get('default_payment') ?? 'cash') === 'cash' ? 'selected' : '' }}>Tunai</option>
                        <option value="debit" {{ \App\Models\Setting::get('default_payment') === 'debit' ? 'selected' : '' }}>Debit</option>
                        <option value="qris" {{ \App\Models\Setting::get('default_payment') === 'qris' ? 'selected' : '' }}>QRIS</option>
                        <option value="ewallet" {{ \App\Models\Setting::get('default_payment') === 'ewallet' ? 'selected' : '' }}>E-Wallet</option>
                    </select>
                </div>
                <div class="flex items-center justify-between p-4 bg-slate-50 dark:bg-slate-800/50 rounded-xl border border-slate-200 dark:border-slate-700">
                    <div>
                        <p class="text-sm font-medium text-slate-900 dark:text-white">Cetak Struk Otomatis</p>
                        <p class="text-xs text-slate-500 dark:text-slate-400 mt-0.5">Aktifkan jika ingin langsung print setelah bayar</p>
                    </div>
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input type="checkbox" name="auto_print" value="1" {{ \App\Models\Setting::get('auto_print') === '1' ? 'checked' : '' }} class="sr-only peer">
                        <div class="w-11 h-6 bg-slate-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-cyan-300 dark:peer-focus:ring-cyan-800 rounded-full peer dark:bg-slate-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-cyan-500"></div>
                    </label>
                </div>
                <div class="flex justify-end pt-4 border-t border-slate-200 dark:border-slate-800">
                    <button type="submit" class="px-6 py-3 gradient-primary text-white rounded-xl font-semibold shadow-lg shadow-cyan-500/30 hover:shadow-cyan-500/50 smooth active:scale-95">Simpan Pengaturan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection