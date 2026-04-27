@extends('layouts.customer')

@section('content')
<!-- Glow Orbs -->
<div class="glow-orb w-[500px] h-[500px] bg-cyan/20 top-0 -left-64"></div>
<div class="glow-orb w-[400px] h-[400px] bg-blue-600/15 bottom-0 right-0"></div>

<!-- Navbar -->
<nav class="glass sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-6">
        <div class="flex items-center justify-between h-18 py-4">
            <!-- Logo -->
            <a href="{{ route('home') }}" class="flex items-center gap-3">
                <div class="w-9 h-9 bg-cyan rounded-lg flex items-center justify-center shadow-lg shadow-cyan/30">
                    <span class="text-[#0A1628] font-bold text-sm">M</span>
                </div>
                <span class="text-sm font-bold tracking-widest uppercase">Migu STORE</span>
            </a>

            <!-- Right Side -->
            <div class="flex items-center gap-5">
                <!-- Search -->
                <form action="{{ route('home') }}" method="GET" class="relative hidden lg:block">
                    <svg class="absolute left-4 top-1/2 -translate-y-1/2 w-4 h-4 text-white/30" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Search" class="search-input">
                </form>

                <!-- Cart Icon -->
                <a href="{{ route('cart.index') }}" class="relative p-2.5 text-white/60 hover:text-cyan transition group">
                    <svg class="w-6 h-6 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                    @if(session('cart_count', 0) > 0)
                    <span class="absolute -top-0.5 -right-0.5 w-5 h-5 bg-cyan text-[#0A1628] text-[10px] font-bold rounded-full flex items-center justify-center animate-pulse">{{ session('cart_count') }}</span>
                    @endif
                </a>

                @auth
                    <span class="text-xs text-white/40 hidden lg:block">{{ Auth::user()->name }}</span>
                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <button type="submit" class="nav-link">Logout</button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="nav-link">Masuk</a>
                    <a href="{{ route('register') }}" class="btn-white text-xs py-2.5 px-6">Daftar</a>
                @endauth
            </div>
        </div>
    </div>
</nav>

<!-- ========================================== -->
<!-- HERO SECTION - Fashion Theme              -->
<!-- ========================================== -->
<section class="relative overflow-hidden hero-pattern py-20 lg:py-28">
    <div class="max-w-7xl mx-auto px-6">
        <div class="grid lg:grid-cols-2 gap-12 lg:gap-16 items-center">
            
            <!-- Left: Text Content -->
            <div class="relative z-10 text-center lg:text-left order-2 lg:order-1">
                <!-- Rating Badge -->
                <div class="inline-flex items-center gap-3 mb-8 glass rounded-full px-5 py-2.5">
                    <div class="stars">
                        <span class="star">★</span><span class="star">★</span><span class="star">★</span><span class="star">★</span><span class="star">★</span>
                    </div>
                    <span class="text-xs text-white/50 uppercase tracking-wider font-medium">Premium Quality</span>
                </div>
                
                <!-- Main Heading -->
                <h1 class="text-4xl sm:text-5xl lg:text-6xl font-extrabold leading-[1.1] mb-6">
                    <span class="text-white/90 block">Discover Your</span>
                    <span class="text-cyan block mt-1">Perfect Style</span>
                </h1>
                
                <!-- Description -->
                <p class="text-white/45 text-base lg:text-lg leading-relaxed mb-10 max-w-lg mx-auto lg:mx-0">
                    Explore our curated collection of premium fashion pieces. 
                    From casual tees to statement jackets, find outfits that define who you are.
                </p>
                
                <!-- CTA Buttons -->
                <div class="flex flex-col sm:flex-row gap-4 justify-center lg:justify-start">
                    <a href="#products" class="btn-white">
                        Shop Collection
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                    </a>
                    <a href="#" class="btn-ghost">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        Watch Lookbook
                    </a>
                </div>

                <!-- Bottom Stats -->
                <div class="flex items-center gap-6 mt-12 pt-8 border-t border-white/5 justify-center lg:justify-start">
                    <div class="flex items-center gap-2 text-white/35">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        <span class="text-xs">Fast Delivery</span>
                    </div>
                    <div class="flex items-center gap-2 text-white/35">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                        <span class="text-xs">Secure Payment</span>
                    </div>
                    <div class="flex items-center gap-2 text-white/35">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/></svg>
                        <span class="text-xs">Easy Returns</span>
                    </div>
                </div>
            </div>

            <!-- Right: Fashion Image Collage -->
            <div class="relative order-1 lg:order-2 flex justify-center">
                <div class="relative w-full max-w-md">
                    <!-- Main Image -->
                    <div class="relative rounded-3xl overflow-hidden border border-white/10 shadow-2xl shadow-cyan/10">
                        <img src="https://images.unsplash.com/photo-1552374196-1ab2a1c593e8?w=600&h=800&fit=crop" 
                             alt="Fashion Model" 
                             class="w-full aspect-[3/4] object-cover">
                        <!-- Gradient Overlay -->
                        <div class="absolute inset-0 bg-gradient-to-t from-[#0A1628] via-transparent to-transparent opacity-60"></div>
                    </div>
                    
                    <!-- Floating Card - Top Right -->
                    <div class="absolute -top-4 -right-4 glass rounded-2xl p-4 shadow-xl animate-bounce" style="animation-duration: 3s;">
                        <div class="stars mb-1">
                            <span class="star">★</span><span class="star">★</span><span class="star">★</span><span class="star">★</span><span class="star">★</span>
                        </div>
                        <p class="text-[10px] text-white/50 uppercase tracking-wider">5.0 Rating</p>
                    </div>
                    
                    <!-- Floating Card - Bottom Left -->
                    <div class="absolute -bottom-4 -left-4 glass rounded-2xl p-4 shadow-xl animate-bounce" style="animation-duration: 4s;">
                        <p class="text-lg font-bold text-cyan">500+</p>
                        <p class="text-[10px] text-white/50 uppercase tracking-wider">Products</p>
                    </div>
                    
                    <!-- Decorative Dots -->
                    <div class="absolute -top-8 left-1/4 flex gap-1.5">
                        <div class="w-2 h-2 rounded-full bg-cyan/40"></div>
                        <div class="w-2 h-2 rounded-full bg-cyan/20"></div>
                        <div class="w-2 h-2 rounded-full bg-cyan/10"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Categories -->
<section class="py-14">
    <div class="max-w-7xl mx-auto px-6">
        <div class="flex items-center justify-between mb-8">
            <h2 class="text-xl font-bold">Browse Categories</h2>
            <a href="#" class="text-sm text-cyan hover:underline">View All →</a>
        </div>
        <div class="grid grid-cols-3 md:grid-cols-6 gap-4">
            @foreach([['name'=>'Kaos','icon'=>'👕'], ['name'=>'Hoodie','icon'=>'🧥'], ['name'=>'Jaket','icon'=>'🧥'], ['name'=>'Celana','icon'=>'👖'], ['name'=>'Aksesoris','icon'=>'⌚'], ['name'=>'Sepatu','icon'=>'👟']] as $cat)
            <div class="product-card p-5 text-center cursor-pointer group">
                <div class="text-3xl mb-2 group-hover:scale-110 transition-transform">{{ $cat['icon'] }}</div>
                <h3 class="text-xs font-semibold text-white/80 group-hover:text-cyan transition">{{ $cat['name'] }}</h3>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- ========================================== -->
<!-- PRODUCTS GRID - Fixed Spacing             -->
<!-- ========================================== -->
<section id="products" class="py-16">
    <div class="max-w-7xl mx-auto px-6">
        <div class="flex flex-col md:flex-row md:items-end md:justify-between mb-12 gap-4">
            <div>
                <span class="text-xs text-cyan uppercase tracking-[0.3em] font-semibold">Our Collection</span>
                <h2 class="text-3xl lg:text-4xl font-bold mt-2">Latest Products</h2>
                <p class="text-white/35 mt-2 text-sm">Curated selection of premium fashion items</p>
            </div>
        </div>

        @if(isset($products) && count($products) > 0)
        <!-- Grid with proper spacing (gap-8) -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
            @foreach($products as $product)
            <div class="product-card group">
                <!-- Image + Add to Cart Overlay -->
                <div class="product-img-wrap">
                    <img src="{{ $product['image'] }}" alt="{{ $product['name'] }}">
                    
                    <!-- Stock Badge -->
                    @if($product['stock'] <= 0)
                    <span class="stock-badge stock-out">Out of Stock</span>
                    @elseif($product['stock'] <= 5)
                    <span class="stock-badge stock-low">Only {{ $product['stock'] }} Left</span>
                    @else
                    <span class="stock-badge stock-in">In Stock</span>
                    @endif

                    <!-- Add to Cart Button (shows on hover) -->
                    <div class="add-cart-overlay">
                        <form action="{{ route('cart.add', $product['id']) }}" method="POST" class="w-full max-w-[200px]">
                            @csrf
                            <button type="submit" {{ $product['stock'] <= 0 ? 'disabled' : '' }}
                                    class="w-full py-3.5 bg-cyan text-[#0A1628] font-bold text-sm rounded-xl hover:bg-white transition disabled:opacity-40 disabled:cursor-not-allowed flex items-center justify-center gap-2 shadow-lg">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                                Add to Cart
                            </button>
                        </form>
                    </div>
                </div>

                <!-- Product Info -->
                <div class="p-5">
                    <span class="cat-badge">{{ $product['category_name'] ?? 'Fashion' }}</span>
                    <h3 class="font-semibold text-white mt-3 mb-3 line-clamp-2 text-sm leading-snug">{{ $product['name'] }}</h3>
                    <div class="flex items-center justify-between">
                        <span class="text-lg font-bold text-cyan">Rp {{ number_format($product['price'], 0, ',', '.') }}</span>
                        <div class="stars">
                            <span class="star">★</span><span class="star">★</span><span class="star">★</span><span class="star">★</span><span class="star">★</span>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @else
        <div class="text-center py-24 glass rounded-3xl">
            <div class="w-20 h-20 mx-auto mb-6 rounded-full bg-white/5 flex items-center justify-center">
                <svg class="w-10 h-10 text-white/20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/></svg>
            </div>
            <p class="text-white/40 text-lg">No products available</p>
        </div>
        @endif
    </div>
</section>
@endsection