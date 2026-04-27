<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Migu STORE</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <style>
        body { font-family: 'Poppins', sans-serif; background: #0A1628; color: #ffffff; }
        
        /* Background */
        .bg-store {
            background: linear-gradient(160deg, #0A1628 0%, #0F2440 40%, #0D1F3C 70%, #0A1628 100%);
            min-height: 100vh;
        }
        
        /* Glass */
        .glass { background: rgba(255,255,255,0.04); backdrop-filter: blur(20px); border: 1px solid rgba(255,255,255,0.06); }
        
        /* Cyan */
        .text-cyan { color: #00D4FF; }
        .bg-cyan { background: #00D4FF; }
        .border-cyan { border-color: #00D4FF; }
        
        /* Buttons */
        .btn-white {
            background: #ffffff;
            color: #0A1628;
            padding: 14px 36px;
            border-radius: 50px;
            font-weight: 700;
            font-size: 14px;
            display: inline-flex;
            align-items: center;
            gap: 10px;
            transition: all 0.3s ease;
            border: none;
            cursor: pointer;
            text-decoration: none;
        }
        .btn-white:hover { background: #00D4FF; transform: translateY(-2px); box-shadow: 0 12px 35px rgba(0,212,255,0.35); }
        
        .btn-ghost {
            border: 2px solid rgba(255,255,255,0.2);
            padding: 12px 36px;
            border-radius: 50px;
            font-weight: 600;
            font-size: 14px;
            color: #ffffff;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
        }
        .btn-ghost:hover { border-color: #00D4FF; color: #00D4FF; }
        
        /* Product Card */
        .product-card {
            background: rgba(255,255,255,0.04);
            border: 1px solid rgba(255,255,255,0.08);
            border-radius: 20px;
            overflow: hidden;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .product-card:hover {
            transform: translateY(-10px);
            border-color: rgba(0,212,255,0.4);
            box-shadow: 0 25px 60px rgba(0,212,255,0.12);
        }
        
        /* Product Image */
        .product-img-wrap {
            aspect-ratio: 3/4;
            background: linear-gradient(145deg, #0F2440, #162D50);
            position: relative;
            overflow: hidden;
        }
        .product-img-wrap img { width: 100%; height: 100%; object-fit: cover; transition: transform 0.6s ease; }
        .product-card:hover .product-img-wrap img { transform: scale(1.06); }
        
        /* Stock Badge */
        .stock-badge {
            position: absolute;
            top: 14px;
            right: 14px;
            padding: 5px 12px;
            border-radius: 10px;
            font-size: 10px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        .stock-in { background: rgba(16,185,129,0.2); color: #10B981; border: 1px solid rgba(16,185,129,0.3); }
        .stock-low { background: rgba(245,158,11,0.2); color: #F59E0B; border: 1px solid rgba(245,158,11,0.3); }
        .stock-out { background: rgba(239,68,68,0.2); color: #EF4444; border: 1px solid rgba(239,68,68,0.3); }
        
        /* Add to Cart Overlay */
        .add-cart-overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(to top, rgba(10,22,40,0.9) 0%, rgba(10,22,40,0.3) 40%, transparent 70%);
            opacity: 0;
            transition: opacity 0.35s ease;
            display: flex;
            align-items: flex-end;
            justify-content: center;
            padding: 24px;
        }
        .product-card:hover .add-cart-overlay { opacity: 1; }
        
        /* Category Badge */
        .cat-badge {
            background: rgba(0,212,255,0.15);
            color: #00D4FF;
            padding: 4px 14px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: 600;
            display: inline-block;
        }
        
        /* Star Rating */
        .stars { display: flex; gap: 2px; }
        .stars .star { color: #FFD700; font-size: 12px; }
        .stars .star-empty { color: rgba(255,255,255,0.15); font-size: 12px; }
        
        /* Search Bar */
        .search-input {
            background: rgba(255,255,255,0.08);
            border: 1px solid rgba(255,255,255,0.1);
            border-radius: 50px;
            padding: 10px 20px 10px 42px;
            color: #fff;
            width: 220px;
            transition: all 0.3s ease;
            font-size: 13px;
        }
        .search-input:focus { outline: none; border-color: #00D4FF; background: rgba(255,255,255,0.12); width: 280px; }
        .search-input::placeholder { color: rgba(255,255,255,0.35); }
        
        /* Nav Link */
        .nav-link { color: rgba(255,255,255,0.65); font-size: 13px; font-weight: 500; transition: color 0.3s; letter-spacing: 0.3px; }
        .nav-link:hover { color: #00D4FF; }
        
        /* Glow Orbs */
        .glow-orb { position: fixed; border-radius: 50%; filter: blur(100px); pointer-events: none; z-index: 0; }
        
        /* Scrollbar */
        ::-webkit-scrollbar { width: 5px; }
        ::-webkit-scrollbar-track { background: #0A1628; }
        ::-webkit-scrollbar-thumb { background: #00D4FF; border-radius: 3px; }
        
        /* Hero Background Pattern */
        .hero-pattern {
            background-image: 
                radial-gradient(circle at 20% 50%, rgba(0,212,255,0.08) 0%, transparent 50%),
                radial-gradient(circle at 80% 20%, rgba(0,100,255,0.06) 0%, transparent 40%);
        }
        
        .line-clamp-2 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
    </style>
    @stack('styles')
</head>
<body class="bg-store antialiased">
    @yield('content')
    
    <!-- Footer -->
    <footer class="bg-[#060F1C] border-t border-white/5 py-14">
        <div class="max-w-7xl mx-auto px-6">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-10 mb-10">
                <div>
                    <div class="flex items-center gap-3 mb-4">
                        <div class="w-9 h-9 bg-cyan rounded-lg flex items-center justify-center"><span class="text-[#0A1628] font-bold text-sm">M</span></div>
                        <span class="text-lg font-bold">Migu STORE</span>
                    </div>
                    <p class="text-sm text-white/35 leading-relaxed">Premium fashion store with the best quality products for your style.</p>
                </div>
                <div>
                    <h4 class="text-xs font-semibold text-cyan mb-4 uppercase tracking-widest">Navigation</h4>
                    <ul class="space-y-2.5">
                        <li><a href="#" class="text-sm text-white/35 hover:text-white transition">Home</a></li>
                        <li><a href="#" class="text-sm text-white/35 hover:text-white transition">Products</a></li>
                        <li><a href="#" class="text-sm text-white/35 hover:text-white transition">About</a></li>
                        <li><a href="#" class="text-sm text-white/35 hover:text-white transition">Contact</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-xs font-semibold text-cyan mb-4 uppercase tracking-widest">Services</h4>
                    <ul class="space-y-2.5">
                        <li><a href="#" class="text-sm text-white/35 hover:text-white transition">Shipping</a></li>
                        <li><a href="#" class="text-sm text-white/35 hover:text-white transition">Returns</a></li>
                        <li><a href="#" class="text-sm text-white/35 hover:text-white transition">Size Guide</a></li>
                        <li><a href="#" class="text-sm text-white/35 hover:text-white transition">FAQ</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-xs font-semibold text-cyan mb-4 uppercase tracking-widest">Contact</h4>
                    <ul class="space-y-2.5 text-sm text-white/35">
                        <li>📧 support@migustore.com</li>
                        <li>📱 0812-3456-7890</li>
                        <li>📍 Jakarta, Indonesia</li>
                    </ul>
                </div>
            </div>
            <div class="border-t border-white/5 pt-8 text-center">
                <p class="text-xs text-white/25 uppercase tracking-wider">© {{ date('Y') }} Migu STORE. All rights reserved.</p>
            </div>
        </div>
    </footer>

    @yield('scripts')
    @stack('scripts')
</body>
</html>