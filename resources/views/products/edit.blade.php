@extends('layouts.app')

@section('page-title', 'Edit Produk')

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
    background-image: 
        radial-gradient(at 0% 0%, rgba(255, 51, 102, 0.08) 0px, transparent 50%),
        radial-gradient(at 100% 100%, rgba(255, 107, 107, 0.06) 0px, transparent 50%);
    background-attachment: fixed;
}

/* ── Animations ─────────────────────────────── */
@keyframes fadeIn { from { opacity: 0; } to { opacity: 1; } }
@keyframes slideUp { from { opacity: 0; transform: translateY(16px); } to { opacity: 1; transform: translateY(0); } }

.animate-fade { animation: fadeIn 0.4s ease-out; }
.animate-slide { animation: slideUp 0.5s ease-out both; }

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
    display: flex; align-items: center; gap: 1rem;
    margin-bottom: 2rem; padding: 1rem 0;
}
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
.page-title-group { display: flex; flex-direction: column; gap: 0.25rem; }
.page-title {
    font-size: clamp(1.5rem, 4vw, 2rem);
    font-weight: 800; line-height: 1.2; color: var(--text-primary);
}
.page-subtitle {
    font-size: 0.9rem; color: var(--text-secondary);
}

/* ── Form Card ─────────────────────────────── */
.form-card {
    background: var(--bg-card); border: 1px solid var(--border-color);
    border-radius: var(--radius-xl); padding: 1.75rem;
}
.form-section { margin-bottom: 1.5rem; }
.form-section-title {
    font-size: 1.1rem; font-weight: 700; color: var(--text-primary);
    margin-bottom: 1rem; padding-bottom: 0.75rem;
    border-bottom: 1px solid var(--border-light);
}

/* Form Elements */
.form-group { margin-bottom: 1.25rem; }
.form-label {
    display: flex; align-items: center; gap: 0.375rem;
    font-size: 0.85rem; font-weight: 600; color: var(--text-primary);
    margin-bottom: 0.5rem;
}
.form-label .required { color: var(--rose); font-weight: 700; }
.form-input, .form-select, .form-textarea {
    width: 100%; padding: 0.875rem 1rem;
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
.form-textarea { resize: vertical; min-height: 100px; }
.form-error {
    font-size: 0.75rem; color: var(--rose);
    margin-top: 0.375rem; display: block;
}

/* File Upload */
.file-upload-wrapper {
    display: flex; align-items: center; gap: 1.25rem; flex-wrap: wrap;
}
.file-preview {
    width: 96px; height: 96px; border-radius: var(--radius-lg);
    background: var(--bg-elevated); border: 1px solid var(--border-color);
    display: flex; align-items: center; justify-content: center;
    overflow: hidden; flex-shrink: 0; position: relative;
}
.file-preview img {
    width: 100%; height: 100%; object-fit: cover;
}
.file-preview-placeholder {
    color: var(--text-muted); text-align: center;
}
.file-preview-placeholder svg { width: 32px; height: 32px; margin-bottom: 0.5rem; }
.file-input-wrapper { flex: 1; min-width: 200px; }
.file-input {
    display: block; width: 100%;
    padding: 0.75rem 1rem;
    background: var(--bg-elevated); border: 1px solid var(--border-color);
    border-radius: var(--radius); font-size: 0.85rem;
    color: var(--text-secondary);
    cursor: pointer; transition: all 0.2s ease;
}
.file-input::-webkit-file-upload-button { display: none; }
.file-input:hover {
    border-color: var(--accent-primary);
    background: var(--bg-hover);
}
.file-hint {
    font-size: 0.75rem; color: var(--text-muted);
    margin-top: 0.5rem;
}
.file-remove {
    position: absolute; top: -8px; right: -8px;
    width: 24px; height: 24px; border-radius: 50%;
    background: var(--rose); color: white;
    display: flex; align-items: center; justify-content: center;
    font-size: 14px; cursor: pointer;
    border: 2px solid var(--bg-card);
    transition: all 0.15s ease;
}
.file-remove:hover { background: #e11d48; transform: scale(1.1); }

/* Form Actions */
.form-actions {
    display: flex; justify-content: flex-end; gap: 0.75rem;
    padding-top: 1.5rem; margin-top: 1.5rem;
    border-top: 1px solid var(--border-light);
}
.btn {
    display: inline-flex; align-items: center; justify-content: center;
    gap: 0.5rem; padding: 0.875rem 1.5rem;
    border-radius: var(--radius-lg); font-size: 0.9rem; font-weight: 600;
    text-decoration: none; cursor: pointer; transition: all 0.2s ease;
}
.btn-secondary {
    background: var(--bg-elevated); border: 1px solid var(--border-color);
    color: var(--text-primary);
}
.btn-secondary:hover {
    background: var(--bg-hover); border-color: var(--accent-primary);
    color: var(--accent-primary);
}
.btn-primary {
    background: var(--accent-gradient); border: none; color: white;
    box-shadow: 0 4px 20px var(--accent-glow);
}
.btn-primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 32px var(--accent-glow);
}
.btn-primary:active { transform: translateY(0); }
.btn-primary:disabled {
    opacity: 0.6; cursor: not-allowed; transform: none;
}

/* ── Responsive ─────────────────────────── */
.form-grid {
    display: grid; grid-template-columns: 1fr; gap: 1.25rem;
}
@media (min-width: 768px) {
    .form-grid { grid-template-columns: repeat(2, 1fr); }
    .form-grid .col-span-2 { grid-column: span 2; }
}
@media (max-width: 768px) {
    .page-header { flex-direction: column; align-items: flex-start; }
    .form-card { padding: 1.25rem; }
    .file-upload-wrapper { flex-direction: column; align-items: flex-start; }
    .form-actions { flex-direction: column-reverse; }
    .btn { width: 100%; }
}

/* ── Scrollbar ───────────────────────────── */
::-webkit-scrollbar { width: 5px; }
::-webkit-scrollbar-track { background: transparent; }
::-webkit-scrollbar-thumb {
    background: var(--bg-elevated); border-radius: 3px;
}
::-webkit-scrollbar-thumb:hover { background: var(--accent-primary); }

/* ── Focus States ───────────────────────── */
button:focus-visible, a:focus-visible, input:focus-visible, select:focus-visible, textarea:focus-visible {
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
    <div style="max-width: 900px; margin: 0 auto;">
        
        <!-- Page Header -->
        <div class="page-header animate-slide">
            <a href="{{ route('products.index') }}" class="back-btn" title="Kembali">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
            </a>
            <div class="page-title-group">
                <h1 class="page-title">Edit Produk</h1>
                <p class="page-subtitle">Perbarui detail produk</p>
            </div>
        </div>

        <!-- Form Card -->
        <form action="{{ route('products.update', $product) }}" method="POST" enctype="multipart/form-data" class="form-card animate-fade">
            @csrf @method('PUT')
            
            <div class="form-section">
                <h2 class="form-section-title">Informasi Dasar</h2>
                <div class="form-grid">
                    <div class="form-group col-span-2">
                        <label class="form-label" for="name">
                            Nama Produk
                            <span class="required">*</span>
                        </label>
                        <input type="text" id="name" name="name" value="{{ old('name', $product->name ?? '') }}" required 
                            class="form-input" placeholder="Masukkan nama produk">
                        @error('name') <span class="form-error">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="category_id">
                            Kategori
                            <span class="required">*</span>
                        </label>
                        <select id="category_id" name="category_id" required class="form-select">
                            <option value="">Pilih Kategori</option>
                            @foreach($categories ?? [] as $cat)
                            <option value="{{ $cat->id ?? '' }}" {{ (old('category_id', $product->category_id ?? '') ?? '') == ($cat->id ?? '') ? 'selected' : '' }}>
                                {{ $cat->name ?? '' }}
                            </option>
                            @endforeach
                        </select>
                        @error('category_id') <span class="form-error">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="sku">
                            SKU
                            <span class="required">*</span>
                        </label>
                        <input type="text" id="sku" name="sku" value="{{ old('sku', $product->sku ?? '') }}" required 
                            class="form-input font-mono" placeholder="Contoh: PRD-001">
                        @error('sku') <span class="form-error">{{ $message }}</span> @enderror
                    </div>
                </div>
            </div>

            <div class="form-section">
                <h2 class="form-section-title">Harga & Stok</h2>
                <div class="form-grid">
                    <div class="form-group">
                        <label class="form-label" for="price">Harga Jual (Rp)</label>
                        <input type="number" id="price" name="price" value="{{ old('price', $product->price ?? 0) }}" required min="0" 
                            class="form-input" placeholder="0">
                        @error('price') <span class="form-error">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="cost_price">Harga Modal (Rp)</label>
                        <input type="number" id="cost_price" name="cost_price" value="{{ old('cost_price', $product->cost_price ?? 0) }}" required min="0" 
                            class="form-input" placeholder="0">
                        <p class="file-hint">Harga beli dari supplier</p>
                        @error('cost_price') <span class="form-error">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="stock">
                            Stok
                            <span class="required">*</span>
                        </label>
                        <input type="number" id="stock" name="stock" value="{{ old('stock', $product->stock ?? 0) }}" required min="0" 
                            class="form-input" placeholder="0">
                        @error('stock') <span class="form-error">{{ $message }}</span> @enderror
                    </div>
                </div>
            </div>

            <div class="form-section">
                <h2 class="form-section-title">Gambar Produk</h2>
                <div class="form-group">
                    <label class="form-label" for="image">Upload Foto</label>
                    <div class="file-upload-wrapper">
                        <div class="file-preview">
                            @php
                                $currentImage = null;
                                if (!empty($product->image)) {
                                    if (str_starts_with($product->image, 'http')) {
                                        $currentImage = $product->image;
                                    } else {
                                        $currentImage = asset('storage/' . $product->image);
                                    }
                                }
                            @endphp
                            <img id="preview-image" src="{{ $currentImage ?? '#' }}" alt="Preview" class="{{ $currentImage ? '' : 'hidden' }}">
                            <div id="file-preview-placeholder" class="file-preview-placeholder {{ $currentImage ? 'hidden' : '' }}">
                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                                <p style="font-size: 0.7rem;">No Image</p>
                            </div>
                            @if($currentImage)
                            <button type="button" class="file-remove" onclick="removeImage()" title="Hapus gambar">×</button>
                            @endif
                        </div>
                        <div class="file-input-wrapper">
                            <input type="file" id="image" name="image" accept="image/*" class="file-input" onchange="previewFile(this)">
                            <p class="file-hint">PNG, JPG, WEBP (Max: 2MB) - Kosongkan jika tidak ingin mengganti</p>
                            @error('image') <span class="form-error">{{ $message }}</span> @enderror
                        </div>
                    </div>
                </div>
            </div>

            <!-- Form Actions -->
            <div class="form-actions">
                <a href="{{ route('products.index') }}" class="btn btn-secondary">Batal</a>
                <button type="submit" class="btn btn-primary">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                    Update Produk
                </button>
            </div>
        </form>
    </div>
</div>

<script>
// Image Preview Function - ✅ Improved with error handling
function previewFile(input) {
    const preview = document.getElementById('preview-image');
    const placeholder = document.getElementById('file-preview-placeholder');
    const removeBtn = document.querySelector('.file-remove');
    
    if (input.files && input.files[0]) {
        const file = input.files[0];
        
        // Validate file size (2MB max)
        if (file.size > 2 * 1024 * 1024) {
            alert('Ukuran file maksimal 2MB');
            input.value = '';
            return;
        }
        
        // Validate file type
        const validTypes = ['image/jpeg', 'image/jpg', 'image/png', 'image/webp'];
        if (!validTypes.includes(file.type)) {
            alert('Format file harus PNG, JPG, atau WEBP');
            input.value = '';
            return;
        }
        
        const reader = new FileReader();
        reader.onload = function(e) {
            if (preview && placeholder) {
                preview.src = e.target.result;
                preview.classList.remove('hidden');
                placeholder.classList.add('hidden');
                // Show remove button if it exists
                if (removeBtn) removeBtn.style.display = 'flex';
            }
        };
        reader.onerror = function() {
            alert('Gagal memuat preview gambar');
        };
        reader.readAsDataURL(file);
    }
}

// Remove current image (sets hidden input or flag)
function removeImage() {
    const preview = document.getElementById('preview-image');
    const placeholder = document.getElementById('file-preview-placeholder');
    const fileInput = document.getElementById('image');
    const removeBtn = document.querySelector('.file-remove');
    
    if (preview && placeholder) {
        preview.src = '#';
        preview.classList.add('hidden');
        placeholder.classList.remove('hidden');
    }
    if (fileInput) fileInput.value = '';
    if (removeBtn) removeBtn.style.display = 'none';
    
    // Optional: Add hidden input to signal server to delete image
    // Create hidden input if not exists
    let deleteInput = document.getElementById('delete_image');
    if (!deleteInput) {
        deleteInput = document.createElement('input');
        deleteInput.type = 'hidden';
        deleteInput.id = 'delete_image';
        deleteInput.name = 'delete_image';
        deleteInput.value = '1';
        document.querySelector('form').appendChild(deleteInput);
    } else {
        deleteInput.value = '1';
    }
}

// Auto-scroll to first error on page load if validation failed
document.addEventListener('DOMContentLoaded', function() {
    const firstError = document.querySelector('.form-error');
    if (firstError) {
        setTimeout(() => {
            firstError.scrollIntoView({ behavior: 'smooth', block: 'center' });
            firstError.parentElement.querySelector('input, select, textarea')?.focus();
        }, 100);
    }
    
    // Optional: Real-time price formatting
    ['price', 'cost_price'].forEach(fieldId => {
        const field = document.getElementById(fieldId);
        if (field) {
            field.addEventListener('blur', function() {
                let value = this.value.replace(/\D/g, '');
                if (value) {
                    this.value = parseInt(value).toLocaleString('id-ID');
                }
            });
            field.addEventListener('focus', function() {
                // Remove formatting for editing
                this.value = this.value.replace(/\./g, '');
            });
        }
    });
});
</script>

@endsection