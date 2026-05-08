<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Create Account - Migu STORE</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <style>
        /* ── Modern Dark Theme CSS Variables - 🔴 PREMIUM RED ACCENT ───────── */
        :root {
            --bg-primary: #0a0a0f;
            --bg-secondary: #12121a;
            --bg-card: #16161f;
            --bg-elevated: #1c1c2e;
            --bg-glass: rgba(22, 22, 31, 0.7);
            --bg-hover: rgba(255, 51, 102, 0.08);
            
            /* 🔴 PREMIUM RED/PINK ACCENT */
            --accent-primary: #ff3366;
            --accent-secondary: #ff6b6b;
            --accent-tertiary: #ff1a4d;
            --accent-gradient: linear-gradient(135deg, #ff3366 0%, #ff6b6b 50%, #ff1a4d 100%);
            --accent-gradient-reverse: linear-gradient(135deg, #ff1a4d 0%, #ff6b6b 100%);
            --accent-glow: rgba(255, 51, 102, 0.4);
            --accent-glow-soft: rgba(255, 51, 102, 0.15);
            
            /* Supporting Colors */
            --emerald: #10b981;
            --emerald-glow: rgba(16, 185, 129, 0.3);
            --amber: #f59e0b;
            --rose: #f43f5e;
            --violet: #8b5cf6;
            
            --text-primary: #ffffff;
            --text-secondary: #a0a0b0;
            --text-muted: #6c6c7e;
            --text-dim: #4a4a5e;
            
            --border-color: rgba(255, 255, 255, 0.08);
            --border-light: rgba(255, 255, 255, 0.05);
            --border-accent: rgba(255, 51, 102, 0.3);
            
            --shadow-sm: 0 2px 8px rgba(0, 0, 0, 0.3);
            --shadow-md: 0 8px 24px rgba(0, 0, 0, 0.4);
            --shadow-lg: 0 16px 48px rgba(0, 0, 0, 0.5);
            --shadow-glow: 0 0 40px rgba(255, 51, 102, 0.3);
            --shadow-glow-soft: 0 0 60px rgba(255, 51, 102, 0.15);
            
            --radius-sm: 8px;
            --radius: 12px;
            --radius-lg: 16px;
            --radius-xl: 24px;
            --radius-2xl: 32px;
            
            --font-main: 'Plus Jakarta Sans', system-ui, sans-serif;
            
            /* Animation Timing */
            --ease-smooth: cubic-bezier(0.4, 0, 0.2, 1);
            --ease-bounce: cubic-bezier(0.34, 1.56, 0.64, 1);
            --ease-spring: cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }

        /* ── Base Reset ───────────────────────────────── */
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        html { scroll-behavior: smooth; }

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
                radial-gradient(ellipse at 20% 10%, rgba(255, 51, 102, 0.12) 0%, transparent 50%),
                radial-gradient(ellipse at 80% 90%, rgba(255, 107, 107, 0.08) 0%, transparent 50%),
                radial-gradient(ellipse at 50% 50%, rgba(139, 92, 246, 0.05) 0%, transparent 70%);
            background-attachment: fixed;
        }

        /* ── Animated Background Particles ───────────── */
        .bg-particles {
            position: fixed; inset: 0; pointer-events: none; z-index: 0;
            background-image: 
                radial-gradient(2px 2px at 20px 30px, rgba(255, 51, 102, 0.3), transparent),
                radial-gradient(2px 2px at 40px 70px, rgba(255, 107, 107, 0.2), transparent),
                radial-gradient(2px 2px at 90px 40px, rgba(139, 92, 246, 0.2), transparent),
                radial-gradient(2px 2px at 160px 120px, rgba(255, 51, 102, 0.15), transparent);
            background-size: 200px 200px;
            animation: particlesFloat 20s linear infinite;
            opacity: 0.5;
        }
        @keyframes particlesFloat {
            0% { background-position: 0 0, 0 0, 0 0, 0 0; }
            100% { background-position: 200px 200px, 150px 100px, 100px 200px, 50px 150px; }
        }

        /* ── Decorative Blobs ────────────────────────── */
        .deco-blob {
            position: fixed; border-radius: 50%; filter: blur(80px);
            opacity: 0.15; pointer-events: none; z-index: 0;
            animation: blobFloat 8s ease-in-out infinite;
        }
        .deco-blob-1 { 
            top: -10%; right: -5%; width: 400px; height: 400px; 
            background: var(--accent-primary); animation-delay: 0s; 
        }
        .deco-blob-2 { 
            bottom: -10%; left: -5%; width: 350px; height: 350px; 
            background: var(--accent-secondary); animation-delay: -4s; 
        }
        .deco-blob-3 {
            top: 50%; left: 50%; transform: translate(-50%, -50%);
            width: 500px; height: 500px; background: var(--violet);
            opacity: 0.08; animation-delay: -2s;
        }
        @keyframes blobFloat {
            0%, 100% { transform: translate(0, 0) scale(1); }
            33% { transform: translate(20px, -20px) scale(1.05); }
            66% { transform: translate(-15px, 15px) scale(0.95); }
        }

        /* ── Animations ─────────────────────────────── */
        @keyframes fadeIn { from { opacity: 0; } to { opacity: 1; } }
        @keyframes slideUp { from { opacity: 0; transform: translateY(24px); } to { opacity: 1; transform: translateY(0); } }
        @keyframes slideInRight { from { opacity: 0; transform: translateX(30px); } to { opacity: 1; transform: translateX(0); } }
        @keyframes pulse { 0%, 100% { opacity: 1; transform: scale(1); } 50% { opacity: 0.7; transform: scale(0.95); } }
        @keyframes shimmer { 0% { background-position: -200% 0; } 100% { background-position: 200% 0; } }
        @keyframes float { 0%, 100% { transform: translateY(0); } 50% { transform: translateY(-8px); } }

        .animate-fade { animation: fadeIn 0.5s var(--ease-smooth) both; }
        .animate-slide { animation: slideUp 0.6s var(--ease-smooth) both; }
        .animate-slide-right { animation: slideInRight 0.6s var(--ease-smooth) both; }
        .animate-pulse { animation: pulse 2s ease-in-out infinite; }
        .animate-shimmer {
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.1), transparent);
            background-size: 200% 100%; animation: shimmer 2s infinite;
        }
        .animate-float { animation: float 4s ease-in-out infinite; }

        /* Staggered animation delays */
        .animate-delay-1 { animation-delay: 0.1s; }
        .animate-delay-2 { animation-delay: 0.2s; }
        .animate-delay-3 { animation-delay: 0.3s; }
        .animate-delay-4 { animation-delay: 0.4s; }
        .animate-delay-5 { animation-delay: 0.5s; }

        /* ── Utility Classes ───────────────────────── */
        .glass {
            background: var(--bg-glass);
            backdrop-filter: blur(24px);
            -webkit-backdrop-filter: blur(24px);
            border: 1px solid var(--border-color);
        }
        .glass-card {
            background: var(--bg-card);
            border: 1px solid var(--border-color);
            border-radius: var(--radius-xl);
            transition: all 0.3s var(--ease-smooth);
        }
        .glass-card:hover {
            border-color: var(--border-accent);
            box-shadow: var(--shadow-lg), var(--shadow-glow-soft);
            transform: translateY(-2px);
        }
        .gradient-primary { 
            background: var(--accent-gradient); 
            box-shadow: 0 8px 32px var(--accent-glow);
            position: relative;
            overflow: hidden;
        }
        .gradient-primary::after {
            content: ''; position: absolute; inset: 0;
            background: linear-gradient(135deg, transparent 0%, rgba(255,255,255,0.1) 50%, transparent 100%);
            opacity: 0; transition: opacity 0.3s ease;
        }
        .gradient-primary:hover::after { opacity: 1; }
        .text-gradient {
            background: var(--accent-gradient);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        .border-subtle { border-color: var(--border-color) !important; }
        .bg-card { background: var(--bg-card); }
        .bg-elevated { background: var(--bg-elevated); }
        .text-muted { color: var(--text-muted); }
        .text-secondary { color: var(--text-secondary); }
        .text-dim { color: var(--text-dim); }

        /* ── Register Container ─────────────────────── */
        .register-container {
            width: 100%;
            max-width: 1100px;
            min-height: 680px;
            background: var(--bg-card);
            border: 1px solid var(--border-color);
            border-radius: var(--radius-2xl);
            overflow: hidden;
            display: grid;
            grid-template-columns: 1.1fr 0.9fr;
            box-shadow: var(--shadow-lg), var(--shadow-glow-soft);
            position: relative;
            z-index: 1;
        }
        .register-container::before {
            content: ''; position: absolute; top: 0; left: 0; right: 0; height: 2px;
            background: var(--accent-gradient);
        }

        /* ── Form Side ──────────────────────────────── */
        .form-side {
            padding: 2.5rem 2.75rem;
            display: flex;
            flex-direction: column;
            justify-content: center;
            gap: 1.25rem;
            position: relative;
            z-index: 2;
            overflow-y: auto;
            max-height: 100vh;
        }
        .form-side::-webkit-scrollbar { width: 4px; }
        .form-side::-webkit-scrollbar-track { background: transparent; }
        .form-side::-webkit-scrollbar-thumb {
            background: var(--bg-elevated); border-radius: 2px;
        }

        /* Brand */
        .brand {
            display: flex; align-items: center; gap: 0.875rem; margin-bottom: 0.5rem;
        }
        .brand-mark {
            width: 44px; height: 44px; border-radius: var(--radius-lg);
            background: var(--accent-gradient);
            display: flex; align-items: center; justify-content: center;
            font-weight: 800; font-size: 1.2rem; color: white;
            box-shadow: 0 6px 24px var(--accent-glow);
            position: relative;
        }
        .brand-mark::after {
            content: ''; position: absolute; inset: -2px;
            border-radius: var(--radius-xl);
            background: var(--accent-gradient);
            filter: blur(12px); opacity: 0.5; z-index: -1;
        }
        .brand-text {
            font-weight: 800; font-size: 1.2rem; color: var(--text-primary);
            letter-spacing: -0.02em;
        }
        .brand-text span { color: var(--accent-primary); }

        /* Heading */
        .section-badge {
            display: inline-flex; align-items: center; gap: 6px;
            padding: 5px 14px; border-radius: 24px;
            background: var(--accent-glow-soft);
            border: 1px solid var(--border-accent);
            font-size: 11px; font-weight: 700; letter-spacing: 0.12em;
            text-transform: uppercase; color: var(--accent-primary);
            margin-bottom: 0.75rem;
        }
        .section-badge-dot {
            width: 6px; height: 6px; border-radius: 50%;
            background: var(--emerald); animation: pulse 2s ease-in-out infinite;
        }
        .main-heading {
            font-size: clamp(1.75rem, 4vw, 2.25rem);
            font-weight: 800; line-height: 1.15; color: var(--text-primary);
            margin: 0 0 0.5rem 0; letter-spacing: -0.02em;
        }
        .main-heading .accent { color: var(--accent-primary); }
        .sub-text {
            font-size: 0.95rem; color: var(--text-secondary);
            line-height: 1.5; margin-bottom: 1.5rem;
        }
        .sub-text a {
            color: var(--accent-primary); text-decoration: none; font-weight: 600;
            transition: all 0.15s ease; position: relative;
        }
        .sub-text a::after {
            content: ''; position: absolute; bottom: -2px; left: 0;
            width: 0; height: 2px; background: var(--accent-primary);
            transition: width 0.2s ease;
        }
        .sub-text a:hover::after { width: 100%; }

        /* Error Alert */
        .error-alert {
            background: rgba(244, 63, 94, 0.12);
            border: 1px solid rgba(244, 63, 94, 0.25);
            border-left: 3px solid var(--rose);
            border-radius: var(--radius);
            padding: 0.875rem 1rem;
            display: flex; align-items: flex-start; gap: 0.75rem;
            font-size: 0.85rem; color: var(--rose);
            margin-bottom: 0.5rem;
            animation: slideUp 0.4s var(--ease-smooth) both;
        }
        .error-alert svg { width: 18px; height: 18px; flex-shrink: 0; margin-top: 2px; }

        /* Input Grid */
        .input-grid {
            display: grid; grid-template-columns: 1fr; gap: 1rem;
        }
        @media (min-width: 480px) {
            .input-grid { grid-template-columns: repeat(2, 1fr); }
            .input-grid .col-span-2 { grid-column: span 2; }
        }

        /* Input Group */
        .input-group { position: relative; }
        .input-label {
            display: flex; align-items: center; gap: 0.375rem;
            font-size: 0.8rem; font-weight: 600; color: var(--text-primary);
            margin-bottom: 0.5rem;
        }
        .input-label .required { color: var(--rose); font-weight: 700; }
        .input-field {
            width: 100%; padding: 0.875rem 1rem 0.875rem 2.75rem;
            background: var(--bg-elevated); border: 1px solid var(--border-color);
            border-radius: var(--radius-lg); font-size: 0.9rem;
            color: var(--text-primary); transition: all 0.25s var(--ease-smooth);
            font-family: var(--font-main);
        }
        .input-field::placeholder { color: var(--text-muted); }
        .input-field:focus {
            outline: none; border-color: var(--accent-primary);
            box-shadow: 0 0 0 4px var(--accent-glow-soft);
            background: var(--bg-card);
        }
        .input-field.error {
            border-color: var(--rose);
            box-shadow: 0 0 0 4px rgba(244, 63, 94, 0.15);
        }
        .input-icon {
            position: absolute; left: 1rem; top: 50%; transform: translateY(-50%);
            width: 18px; height: 18px; color: var(--text-muted);
            transition: color 0.2s ease;
        }
        .input-field:focus + .input-icon,
        .input-field:not(:placeholder-shown) + .input-icon {
            color: var(--accent-primary);
        }

        /* Password Toggle */
        .pass-toggle {
            position: absolute; right: 0.875rem; top: 50%; transform: translateY(-50%);
            background: none; border: none; color: var(--text-muted);
            cursor: pointer; padding: 0.375rem; border-radius: var(--radius-sm);
            transition: all 0.15s ease; display: flex; align-items: center; justify-content: center;
        }
        .pass-toggle:hover { 
            color: var(--accent-primary); background: var(--bg-hover); 
        }
        .pass-toggle:focus-visible {
            outline: 2px solid var(--accent-primary); outline-offset: 2px;
        }
        .pass-toggle svg { width: 18px; height: 18px; transition: transform 0.2s ease; }
        .pass-toggle:hover svg { transform: scale(1.1); }

        /* Password Strength Meter */
        .strength-meter {
            margin-top: 0.5rem;
        }
        .strength-track {
            height: 4px; background: var(--border-color);
            border-radius: 2px; overflow: hidden; margin-bottom: 0.375rem;
        }
        .strength-fill {
            height: 100%; width: 0%; border-radius: 2px;
            transition: all 0.4s var(--ease-spring);
            background: var(--accent-primary);
        }
        .strength-fill.weak { width: 33%; background: var(--rose); }
        .strength-fill.medium { width: 66%; background: var(--amber); }
        .strength-fill.strong { width: 100%; background: var(--emerald); }
        .strength-label {
            font-size: 0.7rem; font-weight: 500;
            display: flex; justify-content: space-between;
        }
        .strength-text { color: var(--text-muted); }
        .strength-text.weak { color: var(--rose); }
        .strength-text.medium { color: var(--amber); }
        .strength-text.strong { color: var(--emerald); }

        /* Password Match Indicator */
        .match-indicator {
            display: flex; align-items: center; gap: 0.375rem;
            margin-top: 0.375rem; font-size: 0.75rem;
        }
        .match-indicator svg { width: 14px; height: 14px; }
        .match-indicator.match { color: var(--emerald); }
        .match-indicator.no-match { color: var(--rose); }

        /* Form Actions */
        .form-actions {
            display: flex; gap: 0.75rem; margin-top: 1rem;
        }
        .btn {
            display: inline-flex; align-items: center; justify-content: center;
            gap: 0.5rem; padding: 0.875rem 1.5rem;
            border-radius: var(--radius-lg); font-size: 0.9rem; font-weight: 600;
            text-decoration: none; cursor: pointer; transition: all 0.25s var(--ease-smooth);
            position: relative; overflow: hidden;
        }
        .btn::after {
            content: ''; position: absolute; inset: 0;
            background: linear-gradient(135deg, transparent, rgba(255,255,255,0.15), transparent);
            transform: translateX(-100%); transition: transform 0.4s ease;
        }
        .btn:hover::after { transform: translateX(100%); }
        .btn-secondary {
            background: var(--bg-elevated); border: 1px solid var(--border-color);
            color: var(--text-primary);
        }
        .btn-secondary:hover {
            background: var(--bg-hover); border-color: var(--border-accent);
            color: var(--accent-primary);
        }
        .btn-primary {
            background: var(--accent-gradient); border: none; color: white;
            box-shadow: 0 6px 24px var(--accent-glow);
        }
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 12px 40px var(--accent-glow);
        }
        .btn-primary:active { transform: translateY(0); }
        .btn-primary:disabled {
            opacity: 0.6; cursor: not-allowed; transform: none;
            box-shadow: none;
        }

        /* Social Login */
        .social-section {
            margin-top: 1.5rem; padding-top: 1.25rem;
            border-top: 1px solid var(--border-light);
        }
        .social-label {
            font-size: 0.75rem; color: var(--text-muted);
            text-transform: uppercase; letter-spacing: 0.08em;
            margin-bottom: 0.875rem; text-align: center; font-weight: 600;
            position: relative;
        }
        .social-label::before,
        .social-label::after {
            content: ''; position: absolute; top: 50%;
            width: 30%; height: 1px; background: var(--border-light);
        }
        .social-label::before { left: 0; }
        .social-label::after { right: 0; }
        .social-grid {
            display: grid; grid-template-columns: repeat(4, 1fr); gap: 0.625rem;
        }
        .social-btn {
            height: 48px; border-radius: var(--radius-lg);
            border: 1px solid var(--border-color);
            background: var(--bg-elevated);
            display: flex; align-items: center; justify-content: center;
            cursor: pointer; transition: all 0.2s ease;
            color: var(--text-secondary);
        }
        .social-btn:hover {
            background: var(--bg-hover); border-color: var(--border-accent);
            color: var(--accent-primary); transform: translateY(-2px);
        }
        .social-btn svg { width: 22px; height: 22px; transition: transform 0.2s ease; }
        .social-btn:hover svg { transform: scale(1.1); }

        /* ── Image Side ─────────────────────────────── */
        .image-side {
            position: relative;
            background: linear-gradient(135deg, var(--bg-secondary) 0%, var(--bg-card) 100%);
            display: flex; align-items: flex-end; justify-content: center;
            padding: 2.5rem; overflow: hidden;
        }
        .image-bg {
            position: absolute; inset: 0;
            background: url('https://images.unsplash.com/photo-1490481651871-ab68de25d43d?w=1200&q=80') center/cover no-repeat;
            z-index: 0; transition: transform 12s ease;
            filter: brightness(0.85) contrast(1.1);
        }
        .register-container:hover .image-bg { transform: scale(1.08); }
        .image-overlay {
            position: absolute; inset: 0;
            background: linear-gradient(
                to top,
                rgba(10, 10, 15, 0.95) 0%,
                rgba(10, 10, 15, 0.6) 40%,
                rgba(255, 51, 102, 0.1) 70%,
                transparent 100%
            );
            z-index: 1;
        }
        .image-content {
            position: relative; z-index: 2; text-align: center; color: white;
            max-width: 280px;
        }
        .image-content h2 {
            font-size: 1.75rem; font-weight: 800; margin: 0 0 0.5rem 0;
            line-height: 1.2; text-shadow: 0 4px 20px rgba(0,0,0,0.4);
        }
        .image-content h2 .accent {
            background: var(--accent-gradient);
            -webkit-background-clip: text; -webkit-text-fill-color: transparent;
        }
        .image-content p {
            margin: 0; opacity: 0.9; font-size: 0.95rem; line-height: 1.5;
            color: rgba(255, 255, 255, 0.85);
        }
        .image-badge {
            display: inline-flex; align-items: center; gap: 6px;
            padding: 6px 14px; border-radius: 20px;
            background: rgba(255, 255, 255, 0.15);
            border: 1px solid rgba(255, 255, 255, 0.2);
            font-size: 0.75rem; font-weight: 600;
            margin-bottom: 1rem; backdrop-filter: blur(8px);
        }

        /* ── Responsive ─────────────────────────── */
        @media (max-width: 900px) {
            .register-container { grid-template-columns: 1fr; min-height: auto; }
            .image-side { display: none; }
            .form-side { padding: 2rem 1.5rem; }
            .input-grid { grid-template-columns: 1fr; }
            .social-grid { grid-template-columns: repeat(4, 1fr); }
            .form-actions { flex-direction: column; }
            .btn { width: 100%; }
        }
        @media (max-width: 480px) {
            .social-grid { grid-template-columns: repeat(2, 1fr); }
            .main-heading { font-size: 1.5rem; }
        }

        /* ── Scrollbar ───────────────────────────── */
        ::-webkit-scrollbar { width: 6px; height: 6px; }
        ::-webkit-scrollbar-track { background: transparent; }
        ::-webkit-scrollbar-thumb {
            background: var(--bg-elevated); border-radius: 3px;
        }
        ::-webkit-scrollbar-thumb:hover { background: var(--accent-primary); }

        /* ── Focus States ───────────────────────── */
        button:focus-visible, a:focus-visible, input:focus-visible, select:focus-visible {
            outline: 2px solid var(--accent-primary); outline-offset: 2px;
        }

        /* ── Reduced Motion ───────────────────── */
        @media (prefers-reduced-motion: reduce) {
            *, *::before, *::after {
                animation-duration: 0.01ms !important;
                animation-iteration-count: 1 !important;
                transition-duration: 0.01ms !important;
            }
        }

        /* ── Loading State ──────────────────────── */
        .btn-loading {
            position: relative; color: transparent !important; pointer-events: none;
        }
        .btn-loading::after {
            content: ''; position: absolute;
            width: 20px; height: 20px;
            border: 2px solid rgba(255,255,255,0.3);
            border-top-color: white; border-radius: 50%;
            animation: spin 0.8s linear infinite;
        }
        @keyframes spin { to { transform: rotate(360deg); } }
    </style>
</head>
<body>

<!-- Animated Background -->
<div class="bg-particles"></div>
<div class="deco-blob deco-blob-1"></div>
<div class="deco-blob deco-blob-2"></div>
<div class="deco-blob deco-blob-3"></div>

<div class="register-container animate-slide">
    <!-- LEFT: Form Side -->
    <div class="form-side">
        <!-- Brand -->
        <div class="brand animate-fade">
            <div class="brand-mark">M</div>
            <span class="brand-text">Migu <span>.</span> STORE</span>
        </div>
        
        <!-- Heading -->
        <div class="section-badge animate-fade animate-delay-1">
            <span class="section-badge-dot"></span>
            Start For Free
        </div>
        <h1 class="main-heading animate-fade animate-delay-2">
            Create new <span class="accent">account</span>.
        </h1>
        <p class="sub-text animate-fade animate-delay-3">
            Already a member? <a href="{{ route('login') }}">Sign in to your account</a>
        </p>
        
        <!-- Error Alert -->
        @if($errors->any())
        <div class="error-alert animate-slide">
            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            <p>{{ $errors->first() }}</p>
        </div>
        @endif
        
        <!-- Register Form -->
        <form action="{{ route('register') }}" method="POST" id="registerForm">
            @csrf
            
            <div class="input-grid">
                <!-- First Name -->
                <div class="input-group col-span-2 animate-fade animate-delay-4">
                    <label class="input-label" for="name">
                        Full Name
                        <span class="required">*</span>
                    </label>
                    <svg class="input-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                    </svg>
                    <input type="text" id="name" name="name" value="{{ old('name') }}" 
                        placeholder="Enter your full name" required 
                        class="input-field" autocomplete="name">
                </div>
                
                <!-- Email -->
                <div class="input-group col-span-2 animate-fade animate-delay-4">
                    <label class="input-label" for="email">
                        Email Address
                        <span class="required">*</span>
                    </label>
                    <svg class="input-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                    </svg>
                    <input type="email" id="email" name="email" value="{{ old('email') }}" 
                        placeholder="you@example.com" required 
                        class="input-field" autocomplete="email">
                </div>
                
                <!-- Password -->
                <div class="input-group animate-fade animate-delay-5">
                    <label class="input-label" for="password">
                        Password
                        <span class="required">*</span>
                    </label>
                    <svg class="input-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                    </svg>
                    <input type="password" id="passwordInput" name="password" 
                        placeholder="Min. 8 characters" required 
                        class="input-field" autocomplete="new-password"
                        oninput="checkStrength(this.value); checkMatch()">
                    <button type="button" onclick="togglePass('passwordInput', 'eyeIcon1')" 
                        class="pass-toggle" aria-label="Toggle password visibility">
                        <svg id="eyeIcon1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                        </svg>
                    </button>
                    <!-- Strength Meter -->
                    <div class="strength-meter">
                        <div class="strength-track">
                            <div id="strengthFill" class="strength-fill"></div>
                        </div>
                        <div class="strength-label">
                            <span class="strength-text" id="strengthText"></span>
                            <span class="text-dim">8+ chars recommended</span>
                        </div>
                    </div>
                </div>
                
                <!-- Confirm Password -->
                <div class="input-group animate-fade animate-delay-5">
                    <label class="input-label" for="password_confirmation">
                        Confirm Password
                        <span class="required">*</span>
                    </label>
                    <svg class="input-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                    </svg>
                    <input type="password" id="confirmInput" name="password_confirmation" 
                        placeholder="Repeat your password" required 
                        class="input-field" autocomplete="new-password"
                        oninput="checkMatch()">
                    <button type="button" onclick="togglePass('confirmInput', 'eyeIcon2')" 
                        class="pass-toggle" aria-label="Toggle password visibility">
                        <svg id="eyeIcon2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                        </svg>
                    </button>
                    <!-- Match Indicator -->
                    <div class="match-indicator" id="matchIndicator">
                        <svg id="matchIcon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                        <span id="matchText">Passwords match</span>
                    </div>
                </div>
            </div>
            
            <!-- Form Actions -->
            <div class="form-actions animate-fade animate-delay-5">
                <button type="button" class="btn btn-secondary" onclick="window.history.back()">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>
                    Back
                </button>
                <button type="submit" class="btn btn-primary" id="submitBtn">
                    Create Account
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                    </svg>
                </button>
            </div>
        </form>
        
        <!-- Social Signup -->
        <div class="social-section animate-fade animate-delay-5">
            <p class="social-label">Or continue with</p>
            <div class="social-grid">
                <a href="#" class="social-btn" title="Continue with Google" aria-label="Continue with Google">
                    <svg viewBox="0 0 24 24" fill="currentColor">
                        <path d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92a5.06 5.06 0 01-2.2 3.32v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.1z"/>
                        <path d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/>
                        <path d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z"/>
                        <path d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z"/>
                    </svg>
                </a>
                <a href="#" class="social-btn" title="Continue with Twitter" aria-label="Continue with Twitter">
                    <svg viewBox="0 0 24 24" fill="currentColor">
                        <path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/>
                    </svg>
                </a>
                <a href="#" class="social-btn" title="Continue with Facebook" aria-label="Continue with Facebook">
                    <svg viewBox="0 0 24 24" fill="currentColor">
                        <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                    </svg>
                </a>
                <a href="#" class="social-btn" title="Continue with Instagram" aria-label="Continue with Instagram">
                    <svg viewBox="0 0 24 24" fill="currentColor">
                        <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98C8.333 23.986 8.741 24 12 24c3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z"/>
                    </svg>
                </a>
            </div>
        </div>
    </div>
    
    <!-- RIGHT: Image Side -->
    <div class="image-side animate-slide-right">
        <div class="image-bg"></div>
        <div class="image-overlay"></div>
        <div class="image-content animate-float">
            <div class="image-badge">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"/>
                </svg>
                Premium Fashion
            </div>
            <h2>Join the <span class="accent">future</span> of fashion retail</h2>
            <p>Manage your store, track sales, and grow your business with our powerful POS system.</p>
        </div>
    </div>
</div>

<script>
    // Password Toggle Function with Animation
    function togglePass(inputId, iconId) {
        const input = document.getElementById(inputId);
        const icon = document.getElementById(iconId);
        if (!input || !icon) return;
        
        const isHidden = input.type === 'password';
        input.type = isHidden ? 'text' : 'password';
        
        // Animate icon change
        icon.style.transform = 'scale(0.8) rotate(180deg)';
        setTimeout(() => {
            icon.innerHTML = isHidden 
                ? '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"/>'
                : '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>';
            icon.style.transform = 'scale(1) rotate(0deg)';
        }, 150);
    }

    // Password Strength Checker
    function checkStrength(password) {
        const fill = document.getElementById('strengthFill');
        const text = document.getElementById('strengthText');
        if (!fill || !text) return;
        
        // Reset classes
        fill.className = 'strength-fill';
        text.className = 'strength-text';
        
        if (!password) {
            text.textContent = '';
            return;
        }
        
        let score = 0;
        if (password.length >= 8) score++;
        if (password.length >= 12) score++;
        if (/[a-z]/.test(password) && /[A-Z]/.test(password)) score++;
        if (/\d/.test(password)) score++;
        if (/[^a-zA-Z0-9]/.test(password)) score++;
        
        if (score <= 2) {
            fill.classList.add('weak');
            text.textContent = 'Weak';
            text.classList.add('weak');
        } else if (score <= 3) {
            fill.classList.add('medium');
            text.textContent = 'Medium';
            text.classList.add('medium');
        } else {
            fill.classList.add('strong');
            text.textContent = 'Strong ✓';
            text.classList.add('strong');
        }
        
        // Check match after strength update
        checkMatch();
    }

    // Password Match Checker
    function checkMatch() {
        const password = document.getElementById('passwordInput')?.value || '';
        const confirm = document.getElementById('confirmInput')?.value || '';
        const indicator = document.getElementById('matchIndicator');
        const icon = document.getElementById('matchIcon');
        const text = document.getElementById('matchText');
        
        if (!indicator || !icon || !text) return;
        
        if (!confirm) {
            indicator.style.display = 'none';
            return;
        }
        
        indicator.style.display = 'flex';
        
        if (password === confirm && password.length > 0) {
            indicator.className = 'match-indicator match';
            icon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/>';
            text.textContent = 'Passwords match';
        } else {
            indicator.className = 'match-indicator no-match';
            icon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>';
            text.textContent = 'Passwords do not match';
        }
    }

    // Form Submission with Loading State
    document.getElementById('registerForm')?.addEventListener('submit', function(e) {
        const submitBtn = document.getElementById('submitBtn');
        const password = document.getElementById('passwordInput')?.value || '';
        const confirm = document.getElementById('confirmInput')?.value || '';
        
        // Validate password match before submit
        if (password !== confirm) {
            e.preventDefault();
            const confirmInput = document.getElementById('confirmInput');
            if (confirmInput) {
                confirmInput.classList.add('error');
                confirmInput.focus();
                setTimeout(() => confirmInput.classList.remove('error'), 2000);
            }
            return;
        }
        
        // Show loading state
        if (submitBtn) {
            submitBtn.classList.add('btn-loading');
            submitBtn.disabled = true;
        }
    });

    // Real-time validation hints
    document.querySelectorAll('.input-field').forEach(input => {
        input.addEventListener('blur', function() {
            if (this.validity.valid) {
                this.classList.remove('error');
            }
        });
        input.addEventListener('input', function() {
            if (this.validity.valid) {
                this.classList.remove('error');
            }
        });
    });

    // Page transition for login link
    document.addEventListener('DOMContentLoaded', function() {
        const loginLink = document.querySelector('a[href*="login"]');
        if (loginLink) {
            loginLink.addEventListener('click', function(e) {
                if (!e.ctrlKey && !e.metaKey && !e.shiftKey) {
                    e.preventDefault();
                    const container = document.querySelector('.register-container');
                    if (container) {
                        container.style.transition = 'opacity 0.3s ease, transform 0.3s ease';
                        container.style.opacity = '0';
                        container.style.transform = 'translateY(-12px)';
                    }
                    setTimeout(() => {
                        window.location.href = this.href;
                    }, 300);
                }
            });
        }
        
        // Auto-focus first empty field
        const firstEmpty = document.querySelector('.input-field:not([value])');
        if (firstEmpty) {
            setTimeout(() => firstEmpty.focus(), 300);
        }
        
        // Initialize password match check
        checkMatch();
    });

    // Keyboard navigation enhancement
    document.addEventListener('keydown', function(e) {
        // Ctrl+Enter to submit
        if ((e.ctrlKey || e.metaKey) && e.key === 'Enter') {
            e.preventDefault();
            document.getElementById('registerForm')?.requestSubmit();
        }
    });
</script>
</body>
</html>