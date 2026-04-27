<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Create Account - Migu STORE</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background: #1a1c2e;
            margin: 0;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }
        
        /* Main Container */
        .register-container {
            width: 100%;
            max-width: 1000px;
            min-height: 640px;
            background: #1e2035;
            border-radius: 24px;
            overflow: hidden;
            display: grid;
            grid-template-columns: 1fr 1fr;
            box-shadow: 0 40px 80px rgba(0,0,0,0.4);
        }
        
        /* Left Side - Form */
        .form-side {
            padding: 48px 44px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }
        
        /* Logo */
        .brand {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 48px;
        }
        .brand-dot {
            width: 24px;
            height: 24px;
            background: #00D4FF;
            border-radius: 50%;
        }
        .brand-name {
            font-size: 15px;
            font-weight: 600;
            color: #ffffff;
            letter-spacing: 0.3px;
        }
        
        /* Heading */
        .section-label {
            font-size: 11px;
            font-weight: 600;
            color: rgba(255,255,255,0.4);
            text-transform: uppercase;
            letter-spacing: 2px;
            margin-bottom: 12px;
        }
        
        .main-heading {
            font-size: 32px;
            font-weight: 700;
            color: #ffffff;
            margin: 0 0 8px 0;
            line-height: 1.2;
        }
        .main-heading span {
            color: #00D4FF;
        }
        
        .sub-link {
            font-size: 13px;
            color: rgba(255,255,255,0.4);
            margin-bottom: 32px;
        }
        .sub-link a {
            color: #00D4FF;
            text-decoration: none;
            font-weight: 500;
        }
        .sub-link a:hover {
            text-decoration: underline;
        }
        
        /* Input Group */
        .input-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 12px;
            margin-bottom: 12px;
        }
        
        .input-group {
            position: relative;
            margin-bottom: 12px;
        }
        
        .input-label {
            display: block;
            font-size: 11px;
            font-weight: 500;
            color: rgba(255,255,255,0.35);
            margin-bottom: 6px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        
        .input-field {
            width: 100%;
            padding: 12px 40px 12px 16px;
            background: #161829;
            border: 1px solid rgba(255,255,255,0.08);
            border-radius: 12px;
            color: #ffffff;
            font-size: 14px;
            font-family: 'Inter', sans-serif;
            transition: all 0.3s ease;
            outline: none;
        }
        .input-field:focus {
            border-color: #00D4FF;
            box-shadow: 0 0 0 3px rgba(0,212,255,0.1);
        }
        .input-field::placeholder {
            color: rgba(255,255,255,0.25);
        }
        
        /* Input Icon */
        .input-icon {
            position: absolute;
            right: 14px;
            top: 50%;
            transform: translateY(-50%);
            width: 16px;
            height: 16px;
            color: rgba(255,255,255,0.25);
        }
        
        /* Password Toggle */
        .pass-toggle {
            position: absolute;
            right: 12px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            color: rgba(255,255,255,0.25);
            cursor: pointer;
            padding: 4px;
            transition: color 0.2s;
        }
        .pass-toggle:hover { color: rgba(255,255,255,0.6); }
        .pass-toggle svg { width: 18px; height: 18px; }
        
        /* Buttons */
        .btn-row {
            display: flex;
            gap: 12px;
            margin-top: 24px;
        }
        
        .btn-secondary {
            padding: 12px 24px;
            background: rgba(255,255,255,0.08);
            border: none;
            border-radius: 12px;
            color: rgba(255,255,255,0.6);
            font-size: 13px;
            font-weight: 500;
            cursor: pointer;
            font-family: 'Inter', sans-serif;
            transition: all 0.3s ease;
        }
        .btn-secondary:hover {
            background: rgba(255,255,255,0.12);
            color: #ffffff;
        }
        
        .btn-primary {
            padding: 12px 28px;
            background: #00D4FF;
            border: none;
            border-radius: 12px;
            color: #1a1c2e;
            font-size: 13px;
            font-weight: 700;
            cursor: pointer;
            font-family: 'Inter', sans-serif;
            transition: all 0.3s ease;
        }
        .btn-primary:hover {
            background: #00e5ff;
            transform: translateY(-1px);
            box-shadow: 0 8px 24px rgba(0,212,255,0.3);
        }
        
        /* Social Section */
        .social-section {
            margin-top: 28px;
            padding-top: 24px;
            border-top: 1px solid rgba(255,255,255,0.06);
        }
        
        .social-label {
            font-size: 11px;
            color: rgba(255,255,255,0.35);
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 16px;
            text-align: center;
        }
        
        .social-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 10px;
        }
        
        .social-btn {
            height: 44px;
            border-radius: 12px;
            border: 1px solid rgba(255,255,255,0.08);
            background: rgba(255,255,255,0.04);
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        .social-btn:hover {
            transform: translateY(-2px);
            border-color: rgba(255,255,255,0.15);
        }
        .social-btn svg { width: 20px; height: 20px; }
        
        .social-btn.google:hover { background: rgba(234,67,53,0.15); border-color: rgba(234,67,53,0.3); }
        .social-btn.google svg { color: #EA4335; }
        
        .social-btn.twitter:hover { background: rgba(29,161,242,0.15); border-color: rgba(29,161,242,0.3); }
        .social-btn.twitter svg { color: #1DA1F2; }
        
        .social-btn.facebook:hover { background: rgba(24,119,242,0.15); border-color: rgba(24,119,242,0.3); }
        .social-btn.facebook svg { color: #1877F2; }
        
        .social-btn.instagram:hover { background: rgba(225,48,108,0.15); border-color: rgba(225,48,108,0.3); }
        .social-btn.instagram svg { color: #E1306C; }
        
        /* Right Side - Image */
        .image-side {
            position: relative;
            background: url('https://images.unsplash.com/photo-1490481651871-ab68de25d43d?w=800&q=80') center/cover no-repeat;
            display: flex;
            align-items: flex-end;
            justify-content: flex-end;
            padding: 36px;
        }
        .image-overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(to top, rgba(30,32,53,0.9) 0%, rgba(30,32,53,0.2) 60%, transparent 100%);
        }
        
        .watermark {
            position: relative;
            z-index: 1;
            font-size: 36px;
            font-weight: 800;
            color: rgba(255,255,255,0.15);
            letter-spacing: -2px;
        }
        .watermark span {
            color: rgba(0,212,255,0.3);
        }
        
        /* Error Alert */
        .error-alert {
            background: rgba(239,68,68,0.1);
            border: 1px solid rgba(239,68,68,0.2);
            border-radius: 12px;
            padding: 12px 16px;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .error-alert svg { width: 18px; height: 18px; color: #EF4444; flex-shrink: 0; }
        .error-alert p { font-size: 13px; color: #FCA5A5; margin: 0; }
        
        /* Password Strength */
        .strength-bar {
            height: 3px;
            background: rgba(255,255,255,0.08);
            border-radius: 2px;
            margin-top: 6px;
            overflow: hidden;
        }
        .strength-fill {
            height: 100%;
            width: 0%;
            border-radius: 2px;
            transition: all 0.3s ease;
        }
        .strength-weak { width: 33%; background: #EF4444; }
        .strength-medium { width: 66%; background: #F59E0B; }
        .strength-strong { width: 100%; background: #10B981; }
        
        .strength-text {
            font-size: 10px;
            margin-top: 4px;
            color: rgba(255,255,255,0.35);
        }
        
        /* Responsive */
        @media (max-width: 768px) {
            .register-container {
                grid-template-columns: 1fr;
                min-height: auto;
            }
            .image-side { display: none; }
            .form-side { padding: 32px 24px; }
            .input-row { grid-template-columns: 1fr; }
            .social-grid { grid-template-columns: repeat(4, 1fr); }
        }
    </style>
</head>
<body>

<div class="register-container">
    <!-- LEFT: Form Side -->
    <div class="form-side">
        <!-- Brand -->
        <div class="brand">
            <div class="brand-dot"></div>
            <span class="brand-name">Migu STORE</span>
        </div>
        
        <!-- Heading -->
        <p class="section-label">Start For Free</p>
        <h1 class="main-heading">Create new account<span>.</span></h1>
        <p class="sub-link">Already a member? <a href="{{ route('login') }}">Sign in</a></p>
        
        <!-- Error Alert -->
        @if($errors->any())
        <div class="error-alert">
            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            <p>{{ $errors->first() }}</p>
        </div>
        @endif
        
        <!-- Register Form -->
        <form action="{{ route('register') }}" method="POST">
            @csrf
            
            <!-- Name Row -->
            <div class="input-row">
                <div class="input-group" style="margin-bottom: 0;">
                    <label class="input-label">First name</label>
                    <input type="text" name="name" value="{{ old('name') }}" placeholder="Michal" required class="input-field">
                    <svg class="input-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                </div>
                <div class="input-group" style="margin-bottom: 0;">
                    <label class="input-label">Last name</label>
                    <input type="text" name="last_name" placeholder="Maslak" class="input-field">
                    <svg class="input-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                </div>
            </div>
            
            <!-- Email -->
            <div class="input-group">
                <label class="input-label">Email</label>
                <input type="email" name="email" value="{{ old('email') }}" placeholder="michal.maslak@anywhere.co" required class="input-field">
                <svg class="input-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
            </div>
            
            <!-- Password -->
            <div class="input-group">
                <label class="input-label">Password</label>
                <input type="password" name="password" id="passwordInput" placeholder="Min. 8 characters" required class="input-field" oninput="checkStrength(this.value)">
                <button type="button" onclick="togglePass('passwordInput', 'eyeIcon1')" class="pass-toggle">
                    <svg id="eyeIcon1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                </button>
                <!-- Strength Bar -->
                <div class="strength-bar">
                    <div id="strengthFill" class="strength-fill"></div>
                </div>
                <p id="strengthText" class="strength-text"></p>
            </div>
            
            <!-- Confirm Password -->
            <div class="input-group">
                <label class="input-label">Confirm Password</label>
                <input type="password" name="password_confirmation" id="confirmInput" placeholder="Repeat your password" required class="input-field">
                <button type="button" onclick="togglePass('confirmInput', 'eyeIcon2')" class="pass-toggle">
                    <svg id="eyeIcon2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                </button>
            </div>
            
            <div class="btn-row">
                <button type="button" class="btn-secondary" onclick="window.history.back()">
                    ← Back
                </button>
                <button type="submit" class="btn-primary">
                    Create account →
                </button>
            </div>
        </form>
        
        <!-- Social Signup -->
        <div class="social-section">
            <p class="social-label">Or continue with</p>
            <div class="social-grid">
                <!-- Google -->
                <a href="#" class="social-btn google" title="Google">
                    <svg viewBox="0 0 24 24" fill="currentColor"><path d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92a5.06 5.06 0 01-2.2 3.32v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.1z"/><path d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/><path d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z"/><path d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z"/></svg>
                </a>
                <!-- Twitter/X -->
                <a href="#" class="social-btn twitter" title="Twitter">
                    <svg viewBox="0 0 24 24" fill="currentColor"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>
                </a>
                <!-- Facebook -->
                <a href="#" class="social-btn facebook" title="Facebook">
                    <svg viewBox="0 0 24 24" fill="currentColor"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                </a>
                <!-- Instagram -->
                <a href="#" class="social-btn instagram" title="Instagram">
                    <svg viewBox="0 0 24 24" fill="currentColor"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98C8.333 23.986 8.741 24 12 24c3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z"/></svg>
                </a>
            </div>
        </div>
    </div>
    
    <!-- RIGHT: Image Side -->
    <div class="image-side">
        <div class="image-overlay"></div>
        <div class="watermark">M<span>.</span></div>
    </div>
</div>

<style>
        /* ====== PAGE TRANSITION & ANIMATION STYLES ====== */
        
        /* Page entrance animation */
        @keyframes pageSlideIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        /* Stagger animation for form elements */
        @keyframes elementSlideIn {
            from {
                opacity: 0;
                transform: translateX(-20px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }
        
        /* Button shine effect */
        @keyframes buttonShine {
            0%, 100% {
                background-position: -1000px 0;
            }
            50% {
                background-position: 1000px 0;
            }
        }
        
        /* Social button pop animation */
        @keyframes socialPop {
            0%, 100% {
                transform: scale(1);
                opacity: 0.6;
            }
            50% {
                transform: scale(1.1);
                opacity: 1;
            }
        }
        
        /* Smooth floating effect for image side */
        @keyframes floatIn {
            from {
                opacity: 0;
                transform: translateX(30px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }
        
        /* Apply animations to page load */
        .register-container {
            animation: pageSlideIn 0.6s cubic-bezier(0.4, 0, 0.2, 1) both;
        }
        
        .brand {
            animation: elementSlideIn 0.6s cubic-bezier(0.4, 0, 0.2, 1) 0.1s both;
        }
        
        .section-label, .main-heading, .sub-link, .error-alert {
            animation: elementSlideIn 0.6s cubic-bezier(0.4, 0, 0.2, 1) 0.2s both;
        }
        
        .input-group {
            animation: elementSlideIn 0.6s cubic-bezier(0.4, 0, 0.2, 1) 0.4s both;
        }
        
        .password-strength {
            animation: elementSlideIn 0.6s cubic-bezier(0.4, 0, 0.2, 1) 0.45s both;
        }
        
        .btn-row {
            animation: elementSlideIn 0.6s cubic-bezier(0.4, 0, 0.2, 1) 0.5s both;
        }
        
        .social-section {
            animation: elementSlideIn 0.6s cubic-bezier(0.4, 0, 0.2, 1) 0.6s both;
        }
        
        .image-side {
            animation: floatIn 0.8s cubic-bezier(0.4, 0, 0.2, 1) 0.2s both;
        }
        
        /* Button shine effect on hover */
        .btn-primary {
            position: relative;
            overflow: hidden;
        }
        
        .btn-primary::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(
                90deg,
                transparent,
                rgba(255, 255, 255, 0.2),
                transparent
            );
            transition: left 0.5s;
        }
        
        .btn-primary:hover::before {
            left: 100%;
        }
        
        /* Social button pop animation */
        .social-btn {
            animation: socialPop 2s cubic-bezier(0.4, 0, 0.2, 1) infinite;
        }
        
        .social-btn:nth-child(1) { animation-delay: 0s; }
        .social-btn:nth-child(2) { animation-delay: 0.2s; }
        .social-btn:nth-child(3) { animation-delay: 0.4s; }
        .social-btn:nth-child(4) { animation-delay: 0.6s; }
        
        /* Enhanced focus animations for form elements */
        .input-field {
            animation: elementSlideIn 0.6s cubic-bezier(0.4, 0, 0.2, 1) 0.45s both;
        }
        
        .input-field:focus {
            transform: scale(1.02);
        }
        
        /* Accessibility: Reduce motion for users who prefer it */
        @media (prefers-reduced-motion: reduce) {
            * {
                animation-duration: 0.01ms !important;
                animation-iteration-count: 1 !important;
                transition-duration: 0.01ms !important;
            }
        }
    </style>

    <script>
        function togglePass(inputId, iconId) {
            const input = document.getElementById(inputId);
            const icon = document.getElementById(iconId);
            if (input.type === 'password') {
                input.type = 'text';
                icon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"/>';
            } else {
                input.type = 'password';
                icon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>';
            }
        }

        function checkStrength(password) {
            const fill = document.getElementById('strengthFill');
            const text = document.getElementById('strengthText');
            
            fill.className = 'strength-fill';
            
            if (password.length === 0) {
                text.textContent = '';
                return;
            }
            
            let score = 0;
            if (password.length >= 8) score++;
            if (password.match(/[a-z]/) && password.match(/[A-Z]/)) score++;
            if (password.match(/[0-9]/)) score++;
            if (password.match(/[^a-zA-Z0-9]/)) score++;
            
            if (score <= 1) {
                fill.classList.add('strength-weak');
                text.textContent = 'Weak';
                text.style.color = '#EF4444';
            } else if (score <= 2) {
                fill.classList.add('strength-medium');
                text.textContent = 'Medium';
                text.style.color = '#F59E0B';
            } else {
                fill.classList.add('strength-strong');
                text.textContent = 'Strong';
                text.style.color = '#10B981';
            }
        }
        
        // Page transition animation
        document.addEventListener('DOMContentLoaded', function() {
            // Trigger animations on page load
            document.querySelector('.register-container').style.animation = 'pageSlideIn 0.6s cubic-bezier(0.4, 0, 0.2, 1) both';
            
            // Add click handlers for smooth transitions
            const loginLink = document.querySelector('a[href*="login"]');
            if (loginLink) {
                loginLink.addEventListener('click', function(e) {
                    if (!e.ctrlKey && !e.metaKey && !e.shiftKey) {
                        e.preventDefault();
                        document.querySelector('.register-container').style.animation = 'pageSlideIn 0.6s cubic-bezier(0.4, 0, 0.2, 1) reverse forwards';
                        setTimeout(() => {
                            window.location.href = this.href;
                        }, 300);
                    }
                });
            }
        });
    </script>
</body>
</html>