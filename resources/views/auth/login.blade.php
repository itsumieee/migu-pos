<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Sign In - Migu STORE</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
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
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 1.5rem;
            position: relative;
            overflow-x: hidden;
            background-image: 
                radial-gradient(at 0% 0%, rgba(255, 51, 102, 0.1) 0px, transparent 50%),
                radial-gradient(at 100% 100%, rgba(255, 107, 107, 0.06) 0px, transparent 50%);
            background-attachment: fixed;
        }

        /* ── Animations ─────────────────────────────── */
        @keyframes fadeIn { from { opacity: 0; } to { opacity: 1; } }
        @keyframes slideUp { from { opacity: 0; transform: translateY(24px); } to { opacity: 1; transform: translateY(0); } }
        @keyframes pulse { 0%, 100% { opacity: 1; } 50% { opacity: 0.6; } }
        @keyframes float { 0%, 100% { transform: translateY(0); } 50% { transform: translateY(-4px); } }

        .animate-fade { animation: fadeIn 0.4s ease-out; }
        .animate-slide { animation: slideUp 0.5s ease-out both; }
        .animate-pulse { animation: pulse 2s ease-in-out infinite; }
        .animate-float { animation: float 3s ease-in-out infinite; }

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

        /* ── Login Container ───────────────────────── */
        .login-container {
            width: 100%;
            max-width: 960px;
            min-height: 560px;
            background: var(--bg-card);
            border: 1px solid var(--border-color);
            border-radius: var(--radius-xl);
            overflow: hidden;
            display: grid;
            grid-template-columns: 1fr 1fr;
            box-shadow: var(--shadow-lg), var(--shadow-glow);
            position: relative;
            z-index: 1;
        }
        .login-container::before {
            content: ''; position: absolute; top: 0; left: 0; right: 0; height: 2px;
            background: var(--accent-gradient);
        }

        /* ── Form Side ─────────────────────────────── */
        .form-side {
            padding: 2.5rem;
            display: flex;
            flex-direction: column;
            justify-content: center;
            gap: 1.5rem;
            position: relative;
            z-index: 2;
        }

        /* Brand */
        .brand {
            display: flex; align-items: center; gap: 0.75rem; margin-bottom: 0.5rem;
        }
        .brand-mark {
            width: 40px; height: 40px; border-radius: var(--radius);
            background: var(--accent-gradient);
            display: flex; align-items: center; justify-content: center;
            font-weight: 800; font-size: 1.1rem; color: white;
            box-shadow: 0 4px 16px var(--accent-glow);
        }
        .brand-text {
            font-weight: 800; font-size: 1.1rem; color: var(--text-primary);
            letter-spacing: -0.02em;
        }

        /* Heading */
        .section-label {
            display: inline-flex; align-items: center; gap: 6px;
            padding: 4px 12px; border-radius: 20px;
            background: rgba(255, 51, 102, 0.15);
            border: 1px solid rgba(255, 51, 102, 0.3);
            font-size: 11px; font-weight: 700; letter-spacing: 0.1em;
            text-transform: uppercase; color: var(--accent-primary);
            margin-bottom: 0.75rem;
        }
        .section-label-dot {
            width: 6px; height: 6px; border-radius: 50%;
            background: var(--emerald); animation: pulse 2s ease-in-out infinite;
        }
        .main-heading {
            font-size: clamp(1.5rem, 4vw, 2rem);
            font-weight: 800; line-height: 1.15; color: var(--text-primary);
            margin: 0 0 0.5rem 0; letter-spacing: -0.02em;
        }
        .main-heading-accent {
            background: var(--accent-gradient);
            -webkit-background-clip: text; -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        .sub-link {
            font-size: 0.9rem; color: var(--text-secondary);
        }
        .sub-link a {
            color: var(--accent-primary); text-decoration: none; font-weight: 600;
            transition: all 0.15s ease;
        }
        .sub-link a:hover { text-decoration: underline; }

        /* Error Alert */
        .error-alert {
            background: rgba(244, 63, 94, 0.15);
            border: 1px solid rgba(244, 63, 94, 0.3);
            border-radius: var(--radius);
            padding: 0.75rem 1rem;
            display: flex; align-items: center; gap: 0.5rem;
            font-size: 0.85rem; color: var(--rose);
            font-weight: 500;
        }
        .error-alert svg { width: 18px; height: 18px; flex-shrink: 0; }

        /* Demo Login Section */
        .demo-section { margin-bottom: 0.5rem; }
        .demo-label {
            font-size: 0.75rem; color: var(--accent-primary);
            text-transform: uppercase; letter-spacing: 0.1em;
            font-weight: 700; margin-bottom: 0.75rem;
        }
        .demo-grid {
            display: grid; grid-template-columns: 1fr 1fr; gap: 0.5rem;
        }
        .demo-btn {
            padding: 0.625rem 0.75rem;
            background: var(--bg-elevated);
            border: 1px solid var(--border-color);
            border-radius: var(--radius);
            cursor: pointer;
            display: flex; align-items: center; gap: 0.5rem;
            transition: all 0.2s ease;
        }
        .demo-btn:hover {
            background: var(--bg-hover);
            border-color: rgba(255, 51, 102, 0.3);
            transform: translateY(-2px);
        }
        .demo-btn .avatar {
            width: 32px; height: 32px; border-radius: var(--radius-sm);
            display: flex; align-items: center; justify-content: center;
            font-weight: 700; font-size: 0.8rem; color: white;
            flex-shrink: 0;
        }
        .demo-btn .info p {
            font-size: 0.8rem; font-weight: 600; color: var(--text-primary);
            margin: 0; line-height: 1.2;
        }
        .demo-btn .info span {
            font-size: 0.7rem; color: var(--text-muted);
        }

        /* Input Group */
        .input-group { position: relative; margin-bottom: 1rem; }
        .input-label {
            display: block; font-size: 0.8rem; font-weight: 600;
            color: var(--text-primary); margin-bottom: 0.5rem;
        }
        .input-field {
            width: 100%; padding: 0.875rem 1rem 0.875rem 2.75rem;
            background: var(--bg-elevated); border: 1px solid var(--border-color);
            border-radius: var(--radius); font-size: 0.9rem;
            color: var(--text-primary); transition: all 0.2s ease;
            font-family: var(--font-main);
        }
        .input-field::placeholder { color: var(--text-muted); }
        .input-field:focus {
            outline: none; border-color: var(--accent-primary);
            box-shadow: 0 0 0 3px rgba(255, 51, 102, 0.15);
            background: var(--bg-card);
        }
        .input-icon {
            position: absolute; left: 1rem; top: 50%; transform: translateY(-50%);
            width: 18px; height: 18px; color: var(--text-muted);
        }

        /* Password Toggle */
        .pass-toggle {
            position: absolute; right: 1rem; top: 50%; transform: translateY(-50%);
            background: none; border: none; color: var(--text-muted);
            cursor: pointer; padding: 0.25rem; transition: all 0.15s ease;
        }
        .pass-toggle:hover { color: var(--accent-primary); }
        .pass-toggle svg { width: 18px; height: 18px; }

        /* Buttons */
        .btn-row { display: flex; gap: 0.75rem; margin-top: 1rem; }
        .btn-secondary {
            flex: 1; padding: 0.875rem; border-radius: var(--radius-lg);
            background: var(--bg-elevated); border: 1px solid var(--border-color);
            color: var(--text-primary); font-size: 0.85rem; font-weight: 600;
            cursor: pointer; transition: all 0.2s ease;
        }
        .btn-secondary:hover {
            background: var(--bg-hover); border-color: var(--accent-primary);
            color: var(--accent-primary);
        }
        .btn-primary {
            flex: 1; padding: 0.875rem; border-radius: var(--radius-lg);
            background: var(--accent-gradient); border: none; color: white;
            font-size: 0.85rem; font-weight: 700; cursor: pointer;
            transition: all 0.2s ease;
            box-shadow: 0 4px 20px var(--accent-glow);
        }
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 32px var(--accent-glow);
        }
        .btn-primary:active { transform: translateY(0); }

        /* Social Login */
        .social-section {
            margin-top: 1.5rem; padding-top: 1.25rem;
            border-top: 1px solid var(--border-light);
        }
        .social-label {
            font-size: 0.75rem; color: var(--text-muted);
            text-transform: uppercase; letter-spacing: 0.08em;
            margin-bottom: 0.75rem; text-align: center; font-weight: 600;
        }
        .social-grid {
            display: grid; grid-template-columns: repeat(4, 1fr); gap: 0.5rem;
        }
        .social-btn {
            height: 44px; border-radius: var(--radius);
            border: 1px solid var(--border-color);
            background: var(--bg-elevated);
            display: flex; align-items: center; justify-content: center;
            cursor: pointer; transition: all 0.2s ease;
            color: var(--text-secondary);
        }
        .social-btn:hover {
            background: var(--bg-hover); border-color: var(--accent-primary);
            color: var(--accent-primary);
        }
        .social-btn svg { width: 20px; height: 20px; }

        /* ── Image Side ───────────────────────────── */
        .image-side {
            position: relative;
            background: linear-gradient(135deg, var(--bg-secondary) 0%, var(--bg-card) 100%);
            display: flex; align-items: flex-end; justify-content: flex-end;
            padding: 2rem; overflow: hidden;
        }
        .image-bg {
            position: absolute; inset: 0;
            background: url('https://i.ibb.co.com/pBPT3FQ4/download-19.jpg') center/cover no-repeat;
            z-index: 0; transition: transform 10s ease;
        }
        .login-container:hover .image-bg { transform: scale(1.05); }
        .image-overlay {
            position: absolute; inset: 0;
            background: linear-gradient(to top, rgba(10,10,15,0.7) 0%, transparent 50%);
            z-index: 1;
        }
        .image-text {
            position: relative; z-index: 2; color: white; text-align: right;
        }
        .image-text h2 {
            font-size: 1.5rem; font-weight: 800; margin: 0; line-height: 1.2;
            text-shadow: 0 2px 8px rgba(0,0,0,0.5);
        }
        .image-text p {
            margin: 5px 0 0 0; opacity: 0.8; font-size: 0.9rem;
        }

        /* ── Responsive ─────────────────────────── */
        @media (max-width: 768px) {
            .login-container { grid-template-columns: 1fr; min-height: auto; }
            .image-side { display: none; }
            .form-side { padding: 2rem 1.5rem; }
            .demo-grid { grid-template-columns: 1fr; }
            .social-grid { grid-template-columns: repeat(4, 1fr); }
            .btn-row { flex-direction: column; }
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
</head>
<body>

<!-- Decorative Background Blobs -->
<div class="deco-blob deco-blob-1"></div>
<div class="deco-blob deco-blob-2"></div>

<div class="login-container animate-slide">
    <!-- LEFT: Form Side -->
    <div class="form-side">
        <!-- Brand -->
        <div class="brand">
            <div class="brand-mark">M</div>
            <span class="brand-text">Migu STORE</span>
        </div>
        
        <!-- Heading -->
        <div class="section-label">
            <span class="section-label-dot"></span>
            Start For Free
        </div>
        <h1 class="main-heading">Sign in to your<span class="main-heading-accent">.</span> account</h1>
        <p class="sub-link">Not a member? <a href="{{ route('register') }}">Create account</a></p>
        
        <!-- Error Alert -->
        @if($errors->any())
        <div class="error-alert">
            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            <p>{{ $errors->first() }}</p>
        </div>
        @endif
        
        <!-- Demo Login -->
        <div class="demo-section">
            <p class="demo-label">⚡ Quick Login</p>
            <div class="demo-grid">
                <form action="{{ route('login') }}" method="POST" class="demo-btn" onsubmit="this.submit(); return false;">
                    @csrf
                    <input type="hidden" name="email" value="admin@migu.com">
                    <input type="hidden" name="password" value="admin123">
                    <div class="avatar" style="background: var(--accent-primary);">A</div>
                    <div class="info">
                        <p>Admin</p>
                        <span>admin@migu.com</span>
                    </div>
                </form>
                <form action="{{ route('login') }}" method="POST" class="demo-btn" onsubmit="this.submit(); return false;">
                    @csrf
                    <input type="hidden" name="email" value="kasir@migu.com">
                    <input type="hidden" name="password" value="kasir123">
                    <div class="avatar" style="background: var(--emerald); color: #0a0a0f;">K</div>
                    <div class="info">
                        <p>Kasir</p>
                        <span>kasir@migu.com</span>
                    </div>
                </form>
            </div>
        </div>
        
        <!-- Login Form -->
        <form action="{{ route('login') }}" method="POST">
            @csrf
            
            <div class="input-group">
                <label class="input-label" for="email">Email</label>
                <svg class="input-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                </svg>
                <input type="email" id="email" name="email" value="{{ old('email') }}" placeholder="Enter your email" required class="input-field">
            </div>
            
            <div class="input-group">
                <label class="input-label" for="password">Password</label>
                <svg class="input-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                </svg>
                <input type="password" id="passwordInput" name="password" placeholder="Enter your password" required class="input-field">
                <button type="button" onclick="togglePass()" class="pass-toggle" aria-label="Toggle password visibility">
                    <svg id="eyeIcon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                    </svg>
                </button>
            </div>
            
            <div class="btn-row">
                <button type="button" class="btn-secondary" onclick="window.history.back()">
                    ← Back
                </button>
                <button type="submit" class="btn-primary">
                    Sign In →
                </button>
            </div>
        </form>
        
        <!-- Social Login -->
        <div class="social-section">
            <p class="social-label">Or continue with</p>
            <div class="social-grid">
                <a href="#" class="social-btn" title="Google">
                    <svg viewBox="0 0 24 24" fill="currentColor"><path d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92a5.06 5.06 0 01-2.2 3.32v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.1z"/><path d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/><path d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z"/><path d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z"/></svg>
                </a>
                <a href="#" class="social-btn" title="Twitter">
                    <svg viewBox="0 0 24 24" fill="currentColor"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>
                </a>
                <a href="#" class="social-btn" title="Facebook">
                    <svg viewBox="0 0 24 24" fill="currentColor"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                </a>
                <a href="#" class="social-btn" title="Instagram">
                    <svg viewBox="0 0 24 24" fill="currentColor"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98C8.333 23.986 8.741 24 12 24c3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z"/></svg>
                </a>
            </div>
        </div>
    </div>
    
    <!-- RIGHT: Image Side -->
    <div class="image-side animate-slide" style="animation-delay: 0.15s">
        <div class="image-bg"></div>
        <div class="image-overlay"></div>
        <div class="image-text">
            <h2>Modern Fashion</h2>
            <p>Discover Your Style</p>
        </div>
    </div>
</div>

<script>
    // Password Toggle Function
    function togglePass() {
        const input = document.getElementById('passwordInput');
        const icon = document.getElementById('eyeIcon');
        if (!input || !icon) return;
        
        if (input.type === 'password') {
            input.type = 'text';
            icon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"/>';
        } else {
            input.type = 'password';
            icon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>';
        }
    }
    
    // Page transition animation for register link
    document.addEventListener('DOMContentLoaded', function() {
        const registerLink = document.querySelector('a[href*="register"]');
        if (registerLink) {
            registerLink.addEventListener('click', function(e) {
                if (!e.ctrlKey && !e.metaKey && !e.shiftKey) {
                    e.preventDefault();
                    const container = document.querySelector('.login-container');
                    if (container) {
                        container.style.transition = 'opacity 0.2s ease, transform 0.2s ease';
                        container.style.opacity = '0';
                        container.style.transform = 'translateY(-10px)';
                    }
                    setTimeout(() => {
                        window.location.href = this.href;
                    }, 200);
                }
            });
        }
        
        // Auto-focus email field
        const emailInput = document.getElementById('email');
        if (emailInput && !emailInput.value) {
            emailInput.focus();
        }
    });
</script>
</body>
</html>