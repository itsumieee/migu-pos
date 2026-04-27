@extends('layouts.customer')

@section('title', 'Keranjang Belanja')

@section('content')
<div class="max-w-5xl mx-auto px-4 py-12">
    <!-- Page Header -->
    <div class="text-center mb-12">
        <span class="text-xs uppercase tracking-[0.3em] text-[#c9a96e]">Checkout</span>
        <h1 class="font-luxury text-4xl md:text-5xl font-bold mt-4 mb-4">Keranjang <span class="gold-text">Belanja</span></h1>
        <div class="divider-gold w-24 mx-auto"></div>
    </div>

    @if(session('cart') && count(session('cart')) > 0)
    <form action="{{ route('checkout.process') }}" method="POST">
        @csrf
        
        <div class="grid lg:grid-cols-3 gap-8">
            <!-- Cart Items -->
            <div class="lg:col-span-2 space-y-4">
                @foreach(session('cart') as $id => $item)
                <div class="card-luxury rounded-2xl p-6 flex gap-6 items-center">
                    <img src="{{ $item['image'] ?? 'https://images.unsplash.com/photo-1521572163474-6864f9cf17ab?w=200&h=200&fit=crop' }}" 
                         class="w-24 h-24 rounded-xl object-cover border border-white/10 shrink-0">
                    
                    <div class="flex-1 min-w-0">
                        <h3 class="font-semibold text-white mb-1 truncate">{{ $item['name'] }}</h3>
                        <p class="text-sm text-white/40 mb-3">Rp {{ number_format($item['price'], 0, ',', '.') }}</p>
                        
                        <div class="flex items-center gap-4">
                            <div class="flex items-center gap-1 bg-white/5 rounded-lg border border-white/10">
                                <button type="button" onclick="updateQty({{ $id }}, -1)" class="w-8 h-8 flex items-center justify-center text-white/50 hover:text-[#c9a96e] transition">−</button>
                                <span id="qty-{{ $id }}" class="w-8 text-center text-sm font-semibold">{{ $item['qty'] }}</span>
                                <button type="button" onclick="updateQty({{ $id }}, 1)" class="w-8 h-8 flex items-center justify-center text-white/50 hover:text-[#c9a96e] transition">+</button>
                            </div>
                            <button type="button" onclick="removeItem({{ $id }})" class="text-xs text-rose-400/60 hover:text-rose-400 transition uppercase tracking-wider">Hapus</button>
                        </div>
                    </div>
                    
                    <div class="text-right shrink-0">
                        <p class="text-lg font-luxury font-bold gold-text">Rp {{ number_format($item['price'] * $item['qty'], 0, ',', '.') }}</p>
                    </div>
                </div>
                @endforeach
            </div>

            <!-- Order Summary -->
            <div class="lg:col-span-1">
                <div class="card-luxury rounded-2xl p-6 sticky top-24 space-y-6">
                    <h3 class="font-luxury text-xl font-bold text-white">Ringkasan</h3>
                    
                    <div class="space-y-3 text-sm">
                        <div class="flex justify-between text-white/50">
                            <span>Subtotal</span>
                            <span>Rp {{ number_format(collect(session('cart'))->sum(fn($i) => $i['price'] * $i['qty']), 0, ',', '.') }}</span>
                        </div>
                        <div class="flex justify-between text-white/50">
                            <span>Pengiriman</span>
                            <span class="text-emerald-400">Gratis</span>
                        </div>
                        <div class="divider-gold my-4"></div>
                        <div class="flex justify-between">
                            <span class="text-white font-semibold">Total</span>
                            <span class="text-xl font-luxury font-bold gold-text">Rp {{ number_format(collect(session('cart'))->sum(fn($i) => $i['price'] * $i['qty']), 0, ',', '.') }}</span>
                        </div>
                    </div>

                    <!-- Payment Method -->
                    <div>
                        <p class="text-xs uppercase tracking-widest text-white/40 mb-3">Metode Pembayaran</p>
                        <div class="space-y-2">
                            <label class="flex items-center gap-3 p-3 rounded-xl border border-white/10 hover:border-[#c9a96e]/30 cursor-pointer transition">
                                <input type="radio" name="payment_method" value="transfer" class="accent-[#c9a96e]" checked>
                                <span class="text-sm text-white/70">Transfer Bank</span>
                            </label>
                            <label class="flex items-center gap-3 p-3 rounded-xl border border-white/10 hover:border-[#c9a96e]/30 cursor-pointer transition">
                                <input type="radio" name="payment_method" value="qris" class="accent-[#c9a96e]">
                                <span class="text-sm text-white/70">QRIS</span>
                            </label>
                        </div>
                    </div>

                    <button type="submit" class="w-full py-4 btn-luxury text-black rounded-xl font-bold text-sm uppercase tracking-widest">
                        Bayar Sekarang
                    </button>

                    <p class="text-[10px] text-center text-white/30 uppercase tracking-wider">🔒 Pembayaran aman & terenkripsi</p>
                </div>
            </div>
        </div>
    </form>

    <script>
    function updateQty(id, change) {
        fetch(`/cart/update/${id}`, {
            method: 'PATCH',
            headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}', 'Accept': 'application/json' },
            body: JSON.stringify({ qty: change })
        }).then(r => r.json()).then(d => { if(d.success) location.reload(); });
    }
    function removeItem(id) {
        if(!confirm('Hapus item?')) return;
        fetch(`/cart/remove/${id}`, {
            method: 'DELETE',
            headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}', 'Accept': 'application/json' }
        }).then(r => r.json()).then(d => { if(d.success) location.reload(); });
    }
    </script>
    @else
    <div class="text-center py-20">
        <div class="w-24 h-24 mx-auto mb-6 rounded-full bg-white/5 flex items-center justify-center">
            <svg class="w-12 h-12 text-white/20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
            </svg>
        </div>
        <h2 class="font-luxury text-2xl font-bold text-white mb-2">Keranjang Kosong</h2>
        <p class="text-white/40 mb-8">Mulai belanja untuk menambahkan produk</p>
        <a href="{{ route('home') }}" class="px-10 py-4 btn-luxury text-black rounded-xl font-semibold text-sm uppercase tracking-widest">
            Belanja Sekarang
        </a>
    </div>
    @endif
</div>
@endsection