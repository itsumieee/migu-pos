<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=space-grotesk:400,500,600,700|syne:700,800,900" rel="stylesheet" />

        <!-- Styles / Scripts -->
        @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
            @vite(['resources/css/app.css', 'resources/js/app.js'])
        @else
            <style>
                /*! tailwindcss v4.0.7 | MIT License | https://tailwindcss.com */
                @layer theme {
                    :root, :host {
                        --font-sans: 'Space Grotesk', ui-sans-serif, system-ui, sans-serif;
                        --font-display: 'Syne', sans-serif;
                        --font-mono: ui-monospace, SFMono-Regular, Menlo, Monaco, Consolas, monospace;
                        
                        /* Neo-Brutalism Color Palette */
                        --c-bg: #FFF9F0;
                        --c-surface: #FFFFFF;
                        --c-border: #000000;
                        --c-text: #1A1A1A;
                        --c-text-dim: #555555;
                        --c-accent-1: #FF6B6B;
                        --c-accent-2: #4ECDC4;
                        --c-accent-3: #FFE66D;
                        --c-accent-4: #95E1D3;
                        --c-accent-5: #F38181;
                        
                        /* Hard Shadows - NO BLUR */
                        --shadow-hard: 4px 4px 0px #000000;
                        --shadow-hard-lg: 6px 6px 0px #000000;
                        --shadow-hard-sm: 2px 2px 0px #000000;
                        --shadow-hover: 2px 2px 0px #000000;
                        
                        /* Thick Borders */
                        --border-thick: 3px solid #000000;
                        --border-medium: 2px solid #000000;
                        
                        /* Spacing & Layout */
                        --spacing: 0.25rem;
                        --breakpoint-lg: 64rem;
                        
                        /* Typography */
                        --text-sm: 0.875rem;
                        --text-base: 1rem;
                        --text-lg: 1.125rem;
                        --text-xl: 1.25rem;
                        --text-2xl: 1.5rem;
                        --text-3xl: 1.875rem;
                        --text-4xl: 2.25rem;
                        --text-5xl: 3rem;
                        --font-weight-medium: 500;
                        --font-weight-bold: 700;
                        --font-weight-extrabold: 800;
                        --font-weight-black: 900;
                        
                        /* Transitions */
                        --ease-bounce: cubic-bezier(0.34, 1.56, 0.64, 1);
                        --ease-smooth: cubic-bezier(0.4, 0, 0.2, 1);
                    }
                }
                
                @layer base {
                    *, ::after, ::before, ::backdrop {
                        box-sizing: border-box;
                        border: 0 solid;
                        margin: 0;
                        padding: 0;
                    }
                    html, :host {
                        -webkit-text-size-adjust: 100%;
                        tab-size: 4;
                        line-height: 1.5;
                        font-family: var(--font-sans);
                        -webkit-tap-highlight-color: transparent;
                    }
                    body {
                        line-height: inherit;
                        background: var(--c-bg);
                        color: var(--c-text);
                        min-height: 100vh;
                    }
                    a { color: inherit; text-decoration: none; }
                    h1, h2, h3, h4, h5, h6 {
                        font-family: var(--font-display);
                        font-weight: 800;
                        line-height: 1.1;
                        letter-spacing: -0.02em;
                        text-transform: uppercase;
                    }
                    img, svg, video { display: block; max-width: 100%; height: auto; }
                    button, input, select, textarea {
                        font: inherit;
                        color: inherit;
                        background: transparent;
                        border-radius: 0;
                    }
                    [hidden]:where(:not([hidden=until-found])) { display: none !important; }
                }
                
                @layer utilities {
                    /* Neo-Brutalism Base Classes */
                    .nb-card {
                        background: var(--c-surface);
                        border: var(--border-thick);
                        border-radius: 0;
                        box-shadow: var(--shadow-hard);
                        transition: all 0.15s var(--ease-bounce);
                    }
                    .nb-card:hover {
                        transform: translate(2px, 2px);
                        box-shadow: var(--shadow-hover);
                    }
                    .nb-card:active {
                        transform: translate(4px, 4px);
                        box-shadow: none;
                    }
                    
                    .nb-btn {
                        display: inline-flex;
                        align-items: center;
                        justify-content: center;
                        gap: 0.5rem;
                        padding: 0.6rem 1.2rem;
                        border-radius: 0;
                        border: var(--border-thick);
                        font-weight: 700;
                        font-size: 0.875rem;
                        text-transform: uppercase;
                        letter-spacing: 0.05em;
                        transition: all 0.15s var(--ease-bounce);
                        cursor: pointer;
                        box-shadow: var(--shadow-hard-sm);
                    }
                    .nb-btn-primary {
                        background: var(--c-accent-1);
                        color: #fff;
                        border-color: #000;
                    }
                    .nb-btn-primary:hover {
                        background: var(--c-accent-3);
                        color: #000;
                        transform: translate(2px, 2px);
                        box-shadow: var(--shadow-hover);
                    }
                    .nb-btn-primary:active {
                        transform: translate(4px, 4px);
                        box-shadow: none;
                    }
                    .nb-btn-outline {
                        background: transparent;
                        color: var(--c-text);
                        border-color: var(--c-border);
                    }
                    .nb-btn-outline:hover {
                        background: var(--c-accent-3);
                        transform: translate(2px, 2px);
                        box-shadow: var(--shadow-hover);
                    }
                    
                    .nb-input {
                        width: 100%;
                        padding: 0.6rem 1rem;
                        border: var(--border-thick);
                        border-radius: 0;
                        background: var(--c-surface);
                        color: var(--c-text);
                        font-size: 0.875rem;
                        font-weight: 500;
                        transition: all 0.15s var(--ease-bounce);
                    }
                    .nb-input:focus {
                        outline: 3px solid var(--c-accent-1);
                        outline-offset: 2px;
                    }
                    
                    .nb-link {
                        color: var(--c-text);
                        font-weight: 600;
                        text-decoration: none;
                        padding: 0.4rem 0.6rem;
                        border: 2px solid transparent;
                        border-radius: 0;
                        transition: all 0.15s var(--ease-bounce);
                        display: inline-flex;
                        align-items: center;
                        gap: 0.3rem;
                    }
                    .nb-link:hover {
                        background: var(--c-accent-3);
                        border-color: var(--c-border);
                        transform: translate(1px, 1px);
                    }
                    
                    .nb-badge {
                        display: inline-flex;
                        align-items: center;
                        gap: 0.4rem;
                        padding: 0.3rem 0.8rem;
                        border-radius: 0;
                        border: var(--border-thick);
                        font-size: 0.7rem;
                        font-weight: 800;
                        text-transform: uppercase;
                        letter-spacing: 0.08em;
                        background: var(--c-accent-3);
                        color: #000;
                        box-shadow: var(--shadow-hard-sm);
                    }
                    
                    .nb-title {
                        font-family: var(--font-display);
                        font-weight: 900;
                        text-transform: uppercase;
                        letter-spacing: -0.03em;
                        text-shadow: 3px 3px 0 var(--c-accent-3);
                    }
                    
                    .nb-subtitle {
                        font-weight: 500;
                        color: var(--c-text-dim);
                    }
                    
                    /* Layout Utilities */
                    .flex { display: flex; }
                    .flex-col { flex-direction: column; }
                    .items-center { align-items: center; }
                    .justify-center { justify-content: center; }
                    .justify-end { justify-content: flex-end; }
                    .gap-3 { gap: 0.75rem; }
                    .gap-4 { gap: 1rem; }
                    .gap-6 { gap: 1.5rem; }
                    
                    .w-full { width: 100%; }
                    .max-w-4xl { max-width: 56rem; }
                    .max-w-md { max-width: 28rem; }
                    
                    .p-6 { padding: 1.5rem; }
                    .p-8 { padding: 2rem; }
                    .px-5 { padding-left: 1.25rem; padding-right: 1.25rem; }
                    .py-2 { padding-top: 0.5rem; padding-bottom: 0.5rem; }
                    .py-4 { padding-top: 1rem; padding-bottom: 1rem; }
                    .pb-12 { padding-bottom: 3rem; }
                    
                    .mb-2 { margin-bottom: 0.5rem; }
                    .mb-4 { margin-bottom: 1rem; }
                    .mb-6 { margin-bottom: 1.5rem; }
                    
                    .text-sm { font-size: 0.875rem; }
                    .text-base { font-size: 1rem; }
                    .text-lg { font-size: 1.125rem; }
                    .text-xl { font-size: 1.25rem; }
                    .text-2xl { font-size: 1.5rem; }
                    .text-3xl { font-size: 1.875rem; }
                    .text-4xl { font-size: 2.25rem; }
                    .text-5xl { font-size: 3rem; }
                    
                    .font-medium { font-weight: 500; }
                    .font-bold { font-weight: 700; }
                    .font-extrabold { font-weight: 800; }
                    
                    .text-primary { color: var(--c-text); }
                    .text-dim { color: var(--c-text-dim); }
                    .text-accent { color: var(--c-accent-1); }
                    
                    .bg-surface { background: var(--c-surface); }
                    .bg-accent { background: var(--c-accent-3); }
                    
                    .border-thick { border: var(--border-thick); }
                    .border-medium { border: var(--border-medium); }
                    
                    .rounded-none { border-radius: 0; }
                    .rounded-sm { border-radius: 0.25rem; }
                    
                    .shadow-hard { box-shadow: var(--shadow-hard); }
                    .shadow-hard-lg { box-shadow: var(--shadow-hard-lg); }
                    
                    .transition-all { transition: all 0.15s var(--ease-bounce); }
                    .duration-150 { transition-duration: 150ms; }
                    
                    .hidden { display: none; }
                    .block { display: block; }
                    .inline-block { display: inline-block; }
                    .inline-flex { display: inline-flex; }
                    
                    .min-h-screen { min-height: 100vh; }
                    
                    /* Responsive */
                    @media (min-width: 64rem) {
                        .lg\:flex-row { flex-direction: row; }
                        .lg\:p-8 { padding: 2rem; }
                        .lg\:p-20 { padding: 5rem; }
                        .lg\:text-5xl { font-size: 3rem; }
                        .lg\:mb-0 { margin-bottom: 0; }
                    }
                    
                    /* Dark Mode */
                    @media (prefers-color-scheme: dark) {
                        :root {
                            --c-bg: #0a0a0b;
                            --c-surface: #16191e;
                            --c-text: #ffffff;
                            --c-text-dim: #94a3b8;
                            --c-border: #ffffff;
                            --shadow-hard: 4px 4px 0px #ffffff;
                            --shadow-hard-lg: 6px 6px 0px #ffffff;
                            --shadow-hard-sm: 2px 2px 0px #ffffff;
                            --shadow-hover: 2px 2px 0px #ffffff;
                        }
                        .dark\:block { display: block; }
                        .dark\:hidden { display: none; }
                        .dark\:nb-card {
                            background: var(--c-surface);
                            border-color: var(--c-border);
                            box-shadow: var(--shadow-hard);
                        }
                        .dark\:nb-btn-outline {
                            color: var(--c-text);
                            border-color: var(--c-border);
                        }
                        .dark\:nb-btn-outline:hover {
                            background: var(--c-accent-3);
                            color: #000;
                        }
                        .dark\:text-primary { color: var(--c-text); }
                        .dark\:text-dim { color: var(--c-text-dim); }
                    }
                    
                    /* Animations */
                    @keyframes nbFadeIn {
                        from { opacity: 0; transform: translateY(20px); }
                        to { opacity: 1; transform: translateY(0); }
                    }
                    .animate-fade-in {
                        animation: nbFadeIn 0.5s var(--ease-bounce) both;
                    }
                    
                    /* Focus States */
                    button:focus-visible,
                    a:focus-visible,
                    input:focus-visible {
                        outline: 3px solid var(--c-accent-1);
                        outline-offset: 2px;
                    }
                    
                    /* Reduced Motion */
                    @media (prefers-reduced-motion: reduce) {
                        *, *::before, *::after {
                            animation-duration: 0.01ms !important;
                            transition-duration: 0.01ms !important;
                        }
                    }
                }
            </style>
        @endif
    </head>
    <body class="min-h-screen flex flex-col items-center justify-center p-6 lg:p-8">
        
        <!-- Decorative Background Elements -->
        <div style="position:fixed;inset:0;pointer-events:none;z-index:0;opacity:0.03">
            <div style="position:absolute;top:10%;left:10%;width:200px;height:200px;border:3px solid #000;border-radius:0;transform:rotate(15deg)"></div>
            <div style="position:absolute;bottom:15%;right:15%;width:150px;height:150px;border:3px solid #000;border-radius:0;transform:rotate(-10deg)"></div>
            <div style="position:absolute;top:50%;left:50%;transform:translate(-50%,-50%) rotate(45deg);width:100px;height:100px;background:var(--c-accent-3);border:3px solid #000"></div>
        </div>
        
        <!-- Header / Nav -->
        <header class="w-full max-w-4xl mb-6 z-10 relative">
            @if (Route::has('login'))
                <nav class="flex items-center justify-end gap-4">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="nb-btn nb-btn-outline">
                            Dashboard
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="nb-link">
                            Log in
                        </a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="nb-btn nb-btn-primary">
                                Register
                            </a>
                        @endif
                    @endauth
                </nav>
            @endif
        </header>
        
        <!-- Main Content -->
        <main class="flex flex-col-reverse lg:flex-row w-full max-w-md lg:max-w-4xl animate-fade-in z-10 relative">
            
            <!-- Left: Text Content -->
            <div class="flex-1 p-6 lg:p-20 pb-12 nb-card bg-surface rounded-none lg:rounded-tr-none">
                <h1 class="nb-title text-2xl lg:text-4xl mb-2">Let's get started</h1>
                <p class="nb-subtitle text-sm mb-4">
                    Laravel has an incredibly rich ecosystem.<br>
                    We suggest starting with the following.
                </p>
                
                <!-- Timeline List -->
                <ul class="flex flex-col mb-4 lg:mb-6">
                    <li class="flex items-center gap-4 py-2 relative pl-8">
                        <span class="absolute left-0 top-1/2 -translate-y-1/2 w-4 h-4 rounded-none border-thick flex items-center justify-center bg-surface">
                            <span class="w-2 h-2 bg-accent rounded-none"></span>
                        </span>
                        <span class="absolute left-0 top-1/2 bottom-0 w-px border-l-2 border-dashed" style="border-color:var(--c-border);opacity:0.3"></span>
                        <span>
                            Read the
                            <a href="https://laravel.com/docs" target="_blank" class="nb-link text-accent ml-1">
                                <span class="font-bold">Documentation</span>
                                <svg width="10" height="11" viewBox="0 0 10 11" fill="none" class="inline w-3 h-3">
                                    <path d="M7.70833 6.95834V2.79167H3.54167M2.5 8L7.5 3.00001" stroke="currentColor" stroke-width="2" stroke-linecap="square"/>
                                </svg>
                            </a>
                        </span>
                    </li>
                    <li class="flex items-center gap-4 py-2 relative pl-8">
                        <span class="absolute left-0 top-1/2 -translate-y-1/2 w-4 h-4 rounded-none border-thick flex items-center justify-center bg-surface">
                            <span class="w-2 h-2 bg-accent rounded-none"></span>
                        </span>
                        <span class="absolute left-0 top-0 bottom-1/2 w-px border-l-2 border-dashed" style="border-color:var(--c-border);opacity:0.3"></span>
                        <span>
                            Watch video tutorials at
                            <a href="https://laracasts.com" target="_blank" class="nb-link text-accent ml-1">
                                <span class="font-bold">Laracasts</span>
                                <svg width="10" height="11" viewBox="0 0 10 11" fill="none" class="inline w-3 h-3">
                                    <path d="M7.70833 6.95834V2.79167H3.54167M2.5 8L7.5 3.00001" stroke="currentColor" stroke-width="2" stroke-linecap="square"/>
                                </svg>
                            </a>
                        </span>
                    </li>
                </ul>
                
                <!-- Action Button -->
                <ul class="flex gap-3">
                    <li>
                        <a href="https://cloud.laravel.com" target="_blank" class="nb-btn nb-btn-primary">
                            Deploy now
                        </a>
                    </li>
                </ul>
            </div>
            
            <!-- Right: Visual Panel -->
            <div class="bg-accent relative lg:ml-0 mb-px lg:mb-0 w-full lg:w-[438px] shrink-0 overflow-hidden nb-card rounded-none lg:rounded-tl-none lg:rounded-tr-none">
                
                {{-- Laravel Logo --}}
                <svg class="w-full text-[#FF6B6B] dark:text-[#FF4433] transition-all max-w-none" viewBox="0 0 438 104" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M17.2036 -3H0V102.197H49.5189V86.7187H17.2036V-3Z" fill="currentColor" stroke="#000" stroke-width="2"/>
                    <path d="M110.256 41.6337C108.061 38.1275 104.945 35.3731 100.905 33.3681C96.8667 31.3647 92.8016 30.3618 88.7131 30.3618C83.4247 30.3618 78.5885 31.3389 74.201 33.2923C69.8111 35.2456 66.0474 37.928 62.9059 41.3333C59.7643 44.7401 57.3198 48.6726 55.5754 53.1293C53.8287 57.589 52.9572 62.274 52.9572 67.1813C52.9572 72.1925 53.8287 76.8995 55.5754 81.3069C57.3191 85.7173 59.7636 89.6241 62.9059 93.0293C66.0474 96.4361 69.8119 99.1155 74.201 101.069C78.5885 103.022 83.4247 103.999 88.7131 103.999C92.8016 103.999 96.8667 102.997 100.905 100.994C104.945 98.9911 108.061 96.2359 110.256 92.7282V102.195H126.563V32.1642H110.256V41.6337ZM108.76 75.7472C107.762 78.4531 106.366 80.8078 104.572 82.8112C102.776 84.8161 100.606 86.4183 98.0637 87.6206C95.5202 88.823 92.7004 89.4238 89.6103 89.4238C86.5178 89.4238 83.7252 88.823 81.2324 87.6206C78.7388 86.4183 76.5949 84.8161 74.7998 82.8112C73.004 80.8078 71.6319 78.4531 70.6856 75.7472C69.7356 73.0421 69.2644 70.1868 69.2644 67.1821C69.2644 64.1758 69.7356 61.3205 70.6856 58.6154C71.6319 55.9102 73.004 53.5571 74.7998 51.5522C76.5949 49.5495 78.738 47.9451 81.2324 46.7427C83.7252 45.5404 86.5178 44.9396 89.6103 44.9396C92.7012 44.9396 95.5202 45.5404 98.0637 46.7427C100.606 47.9451 102.776 49.5487 104.572 51.5522C106.367 53.5571 107.762 55.9102 108.76 58.6154C109.756 61.3205 110.256 64.1758 110.256 67.1821C110.256 70.1868 109.756 73.0421 108.76 75.7472Z" fill="currentColor" stroke="#000" stroke-width="2"/>
                    <path d="M242.805 41.6337C240.611 38.1275 237.494 35.3731 233.455 33.3681C229.416 31.3647 225.351 30.3618 221.262 30.3618C215.974 30.3618 211.138 31.3389 206.75 33.2923C202.36 35.2456 198.597 37.928 195.455 41.3333C192.314 44.7401 189.869 48.6726 188.125 53.1293C186.378 57.589 185.507 62.274 185.507 67.1813C185.507 72.1925 186.378 76.8995 188.125 81.3069C189.868 85.7173 192.313 89.6241 195.455 93.0293C198.597 96.4361 202.361 99.1155 206.75 101.069C211.138 103.022 215.974 103.999 221.262 103.999C225.351 103.999 229.416 102.997 233.455 100.994C237.494 98.9911 240.611 96.2359 242.805 92.7282V102.195H259.112V32.1642H242.805V41.6337ZM241.31 75.7472C240.312 78.4531 238.916 80.8078 237.122 82.8112C235.326 84.8161 233.156 86.4183 230.614 87.6206C228.07 88.823 225.251 89.4238 222.16 89.4238C219.068 89.4238 216.275 88.823 213.782 87.6206C211.289 86.4183 209.145 84.8161 207.35 82.8112C205.554 80.8078 204.182 78.4531 203.236 75.7472C202.286 73.0421 201.814 70.1868 201.814 67.1821C201.814 64.1758 202.286 61.3205 203.236 58.6154C204.182 55.9102 205.554 53.5571 207.35 51.5522C209.145 49.5495 211.288 47.9451 213.782 46.7427C216.275 45.5404 219.068 44.9396 222.16 44.9396C225.251 44.9396 228.07 45.5404 230.614 46.7427C233.156 47.9451 235.326 49.5487 237.122 51.5522C238.917 53.5571 240.312 55.9102 241.31 58.6154C242.306 61.3205 242.806 64.1758 242.806 67.1821C242.805 70.1868 242.305 73.0421 241.31 75.7472Z" fill="currentColor" stroke="#000" stroke-width="2"/>
                    <path d="M438 -3H421.694V102.197H438V-3Z" fill="currentColor" stroke="#000" stroke-width="2"/>
                    <path d="M139.43 102.197H155.735V48.2834H183.712V32.1665H139.43V102.197Z" fill="currentColor" stroke="#000" stroke-width="2"/>
                    <path d="M324.49 32.1665L303.995 85.794L283.498 32.1665H266.983L293.748 102.197H314.242L341.006 32.1665H324.49Z" fill="currentColor" stroke="#000" stroke-width="2"/>
                    <path d="M376.571 30.3656C356.603 30.3656 340.797 46.8497 340.797 67.1828C340.797 89.6597 356.094 104 378.661 104C391.29 104 399.354 99.1488 409.206 88.5848L398.189 80.0226C398.183 80.031 389.874 90.9895 377.468 90.9895C363.048 90.9895 356.977 79.3111 356.977 73.269H411.075C413.917 50.1328 398.775 30.3656 376.571 30.3656ZM357.02 61.0967C357.145 59.7487 359.023 43.3761 376.442 43.3761C393.861 43.3761 395.978 59.7464 396.099 61.0967H357.02Z" fill="currentColor" stroke="#000" stroke-width="2"/>
                </svg>

                {{-- Decorative Geometric Pattern --}}
                <div style="position:absolute;inset:0;pointer-events:none;opacity:0.15">
                    <div style="position:absolute;top:20%;left:10%;width:60px;height:60px;border:3px solid #000;transform:rotate(25deg)"></div>
                    <div style="position:absolute;bottom:25%;right:15%;width:45px;height:45px;border:3px solid #000;transform:rotate(-15deg)"></div>
                    <div style="position:absolute;top:60%;left:30%;width:35px;height:35px;background:#000;transform:rotate(45deg)"></div>
                    <div style="position:absolute;top:10%;right:25%;width:50px;height:50px;border:3px solid #000;border-radius:0"></div>
                </div>
                
                {{-- Overlay Border --}}
                <div style="position:absolute;inset:3px;border:2px solid #000;pointer-events:none"></div>
            </div>
        </main>
        
        <!-- Footer Decorative Element -->
        @if (Route::has('login'))
            <div class="h-6 hidden lg:block"></div>
        @endif
        
        <footer class="mt-8 text-center z-10 relative">
            <span class="nb-badge">
                <span style="width:6px;height:6px;background:#000;border-radius:0"></span>
                Neo-Brutalism Edition
            </span>
        </footer>
        
    </body>
</html>