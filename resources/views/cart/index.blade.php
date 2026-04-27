@extends('layouts.customer')

@section('title', 'Keranjang Belanja')

@push('styles')
<style>
  * {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
  }

  .cart-page {
    background: linear-gradient(160deg, #0A1628 0%, #0F2440 40%, #0D1F3C 70%, #0A1628 100%);
    min-height: 100vh;
    color: #e8e8e8;
    padding: 2.5rem 1.5rem;
    font-family: 'Poppins', -apple-system, system-ui, sans-serif;
  }

  .cart-header {
    max-width: 1200px;
    margin: 0 auto 2.5rem;
    padding-bottom: 1.5rem;
    border-bottom: 1px solid rgba(255,255,255,0.06);
  }

  .cart-title {
    font-size: clamp(24px, 5vw, 32px);
    font-weight: 700;
    color: #fff;
    margin-bottom: 0.5rem;
    letter-spacing: -0.5px;
  }

  .cart-subtitle {
    font-size: 14px;
    color: rgba(255,255,255,0.4);
    font-weight: 500;
  }

  .cart-wrapper {
    max-width: 1200px;
    margin: 0 auto;
  }

  .cart-container {
    display: grid;
    grid-template-columns: 1fr 380px;
    gap: 2rem;
    align-items: start;
  }

  .cart-items {
    display: flex;
    flex-direction: column;
    gap: 1rem;
  }

  .cart-item {
    background: rgba(255,255,255,0.04);
    backdrop-filter: blur(20px);
    border: 1px solid rgba(255,255,255,0.06);
    border-radius: 14px;
    padding: 1.5rem;
    display: grid;
    grid-template-columns: 110px 1fr auto;
    gap: 1.5rem;
    align-items: center;
    transition: all 0.2s ease;
  }

  .cart-item:hover {
    border-color: rgba(0,212,255,0.3);
    background: rgba(255,255,255,0.06);
    box-shadow: inset 0 0 20px rgba(0, 212, 255, 0.08);
  }

  .item-img {
    width: 110px;
    height: 110px;
    background: linear-gradient(135deg, rgba(15,36,64,0.8) 0%, rgba(13,31,60,0.8) 100%);
    border-radius: 10px;
    overflow: hidden;
    flex-shrink: 0;
    border: 1px solid rgba(255,255,255,0.06);
  }

  .item-img img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    display: block;
  }

  .item-details {
    display: flex;
    flex-direction: column;
    gap: 0.75rem;
  }

  .item-name {
    font-size: 15px;
    font-weight: 600;
    color: #fff;
    line-height: 1.4;
  }

  .item-price {
    font-size: 13px;
    color: rgba(255,255,255,0.5);
    font-weight: 500;
  }

  .qty-ctrl {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    background: rgba(255,255,255,0.04);
    border: 1px solid rgba(255,255,255,0.08);
    border-radius: 8px;
    padding: 4px 8px;
    width: fit-content;
    margin-top: 0.25rem;
  }

  .qty-btn {
    width: 28px;
    height: 28px;
    border: 1px solid transparent;
    background: transparent;
    color: rgba(255,255,255,0.4);
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 16px;
    font-weight: 600;
    transition: all 0.15s ease;
    border-radius: 6px;
  }

  .qty-btn:hover {
    color: #00D4FF;
    background: rgba(0,212,255,0.1);
  }

  .qty-btn:active {
    transform: scale(0.95);
  }

  .qty-val {
    font-size: 14px;
    font-weight: 700;
    color: #e8e8e8;
    min-width: 28px;
    text-align: center;
  }

  .item-total {
    display: flex;
    flex-direction: column;
    align-items: flex-end;
    gap: 0.75rem;
  }

  .item-subtotal {
    font-size: 18px;
    font-weight: 700;
    color: #00D4FF;
  }

  .item-remove {
    font-size: 12px;
    color: rgba(255,255,255,0.4);
    background: transparent;
    border: none;
    cursor: pointer;
    transition: all 0.15s ease;
    padding: 4px 8px;
    border-radius: 6px;
  }

  .item-remove:hover {
    color: #ff7b6b;
    background: rgba(255, 123, 107, 0.1);
  }

  .empty-cart {
    grid-column: 1 / -1;
    text-align: center;
    padding: 5rem 2rem;
    background: rgba(255,255,255,0.04);
    backdrop-filter: blur(20px);
    border: 1px solid rgba(255,255,255,0.06);
    border-radius: 14px;
  }

  .empty-icon {
    width: 56px;
    height: 56px;
    margin: 0 auto 1.5rem;
    color: rgba(255,255,255,0.1);
    stroke-width: 1;
  }

  .empty-title {
    font-size: 22px;
    font-weight: 700;
    color: #fff;
    margin-bottom: 0.75rem;
  }

  .empty-desc {
    font-size: 14px;
    color: rgba(255,255,255,0.4);
    margin-bottom: 2rem;
  }

  .btn-continue {
    display: inline-block;
    background: #00D4FF;
    color: #0A1628;
    padding: 12px 32px;
    border-radius: 10px;
    font-size: 14px;
    font-weight: 700;
    text-decoration: none;
    transition: all 0.2s ease;
    border: none;
    cursor: pointer;
    box-shadow: 0 4px 12px rgba(0, 212, 255, 0.25);
  }

  .btn-continue:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 16px rgba(0, 212, 255, 0.35);
  }

  .summary-box {
    background: rgba(255,255,255,0.04);
    backdrop-filter: blur(20px);
    border: 1px solid rgba(255,255,255,0.06);
    border-radius: 14px;
    padding: 1.75rem;
    display: flex;
    flex-direction: column;
    gap: 1.25rem;
    height: fit-content;
    position: sticky;
    top: 2rem;
    box-shadow: 0 8px 24px rgba(0, 0, 0, 0.4);
  }

  .summary-title {
    font-size: 16px;
    font-weight: 700;
    color: #fff;
    padding-bottom: 1rem;
    border-bottom: 1px solid rgba(255,255,255,0.06);
  }

  .summary-row {
    display: flex;
    justify-content: space-between;
    align-items: center;
    font-size: 14px;
    padding: 0.75rem 0;
  }

  .summary-row.total {
    margin-top: 1rem;
    padding-top: 1rem;
    border-top: 1px solid rgba(255,255,255,0.06);
    font-size: 16px;
  }

  .summary-label {
    color: rgba(255,255,255,0.5);
    font-weight: 500;
  }

  .summary-value {
    color: #e8e8e8;
    font-weight: 600;
  }

  .summary-total {
    font-size: 24px;
    font-weight: 700;
    color: #00D4FF;
  }

  .btn-checkout {
    background: #00D4FF;
    color: #0A1628;
    border: none;
    border-radius: 10px;
    padding: 14px;
    font-size: 15px;
    font-weight: 700;
    cursor: pointer;
    transition: all 0.2s ease;
    box-shadow: 0 4px 12px rgba(0, 212, 255, 0.3);
    width: 100%;
    text-transform: uppercase;
    letter-spacing: 0.5px;
  }

  .btn-checkout:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 16px rgba(0, 212, 255, 0.4);
    background: #00E5FF;
  }

  .btn-checkout:active {
    transform: translateY(0);
  }

  .btn-checkout:disabled {
    background: rgba(255,255,255,0.1);
    color: rgba(255,255,255,0.3);
    cursor: not-allowed;
    box-shadow: none;
  }

  .btn-continue-cart {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    margin-top: 0.75rem;
    padding: 12px;
    border: 2px solid rgba(255,255,255,0.2);
    border-radius: 10px;
    text-decoration: none;
    font-size: 14px;
    color: rgba(255,255,255,0.6);
    transition: all 0.2s ease;
    background: transparent;
  }

  .btn-continue-cart:hover {
    border-color: #00D4FF;
    color: #00D4FF;
    background: rgba(0,212,255,0.05);
  }

  @media (max-width: 1024px) {
    .cart-container {
      grid-template-columns: 1fr;
    }

    .summary-box {
      position: static;
    }
  }

  @media (max-width: 768px) {
    .cart-page {
      padding: 1.5rem 1rem;
    }

    .cart-container {
      gap: 1.5rem;
    }

    .cart-item {
      grid-template-columns: 90px 1fr;
      gap: 1rem;
      padding: 1rem;
    }

    .cart-item:hover {
      border-color: rgba(0,212,255,0.2);
    }

    .item-total {
      grid-column: 2;
      grid-row: 2;
      margin-top: 0.5rem;
    }

    .item-img {
      width: 90px;
      height: 90px;
    }

    .cart-title {
      font-size: 24px;
    }

    .summary-box {
      padding: 1.5rem;
    }
  }

  @media (max-width: 480px) {
    .cart-page {
      padding: 1rem 0.75rem;
    }

    .cart-item {
      grid-template-columns: 80px 1fr;
      gap: 0.75rem;
      padding: 0.875rem;
    }

    .item-img {
      width: 80px;
      height: 80px;
    }

    .item-name {
      font-size: 14px;
    }

    .item-price {
      font-size: 12px;
    }

    .item-subtotal {
      font-size: 16px;
    }

    .cart-title {
      font-size: 20px;
    }

    .summary-box {
      padding: 1.25rem;
    }

    .summary-title {
      font-size: 15px;
    }

    .btn-checkout {
      padding: 12px;
      font-size: 14px;
    }
  }
</style>
@endpush

@section('content')
<div class="cart-page">
  <div class="cart-header">
    <h1 class="cart-title">Keranjang Belanja</h1>
    <p class="cart-subtitle">{{ session('cart') ? count(session('cart')) : 0 }} produk</p>
  </div>

  <div class="cart-wrapper">
    @if(session('cart') && count(session('cart')) > 0)
    <form action="{{ route('checkout.process') }}" method="POST" id="checkoutForm">
      @csrf
      <div class="cart-container">
        
        <!-- LEFT: Items List -->
        <div class="cart-items">
          @foreach(session('cart') as $id => $item)
          <div class="cart-item">
            <!-- Image -->
            <div class="item-img">
              <img src="{{ $item['image'] ?? 'data:image/svg+xml,%3Csvg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 24 24%22 fill=%22none%22 stroke=%22%23333%22 stroke-width=%221%22%3E%3Crect x=%223%22 y=%223%22 width=%2218%22 height=%2218%22 rx=%222%22/%3E%3Ccircle cx=%228.5%22 cy=%228.5%22 r=%221.5%22/%3E%3Cpolyline points=%2221 15 16 10 5 21%22/%3E%3C/svg%3E' }}" alt="{{ $item['name'] }}" loading="lazy">
            </div>
            
            <!-- Details & Quantity -->
            <div class="item-details">
              <div class="item-name">{{ $item['name'] }}</div>
              <div class="item-price">Rp {{ number_format($item['price'], 0, ',', '.') }}</div>
              <div class="qty-ctrl">
                <button type="button" class="qty-btn" onclick="updateQty({{ $id }}, -1)" title="Kurangi">−</button>
                <span class="qty-val">{{ $item['qty'] }}</span>
                <button type="button" class="qty-btn" onclick="updateQty({{ $id }}, 1)" title="Tambah">+</button>
              </div>
            </div>
            
            <!-- Total & Remove -->
            <div class="item-total">
              <div class="item-subtotal">Rp {{ number_format($item['price'] * $item['qty'], 0, ',', '.') }}</div>
              <button type="button" class="item-remove" onclick="removeItem({{ $id }})" title="Hapus">Hapus</button>
            </div>
          </div>
          @endforeach
        </div>
        
        <!-- RIGHT: Summary Box -->
        <div class="summary-box">
          <div class="summary-title">Ringkasan Pesanan</div>
          
          @php
            $subtotal = collect(session('cart'))->sum(fn($i) => $i['price'] * $i['qty']);
          @endphp
          
          <div class="summary-row">
            <span class="summary-label">Subtotal</span>
            <span class="summary-value">Rp {{ number_format($subtotal, 0, ',', '.') }}</span>
          </div>
          <div class="summary-row">
            <span class="summary-label">Ongkos Kirim</span>
            <span class="summary-value">Gratis</span>
          </div>
          <div class="summary-row total">
            <span class="summary-label">Total</span>
            <span class="summary-total">Rp {{ number_format($subtotal, 0, ',', '.') }}</span>
          </div>
          
          <button type="button" class="btn-checkout" onclick="showPaymentModal()">Lanjut ke Checkout</button>
          <a href="{{ route('home') }}" class="btn-continue-cart">← Lanjut Belanja</a>
        </div>
      </div>
    </form>

    <!-- Payment Method Modal -->
    <div id="paymentModal" style="display: none; position: fixed; inset: 0; background: rgba(0,0,0,0.7); backdrop-filter: blur(4px); z-index: 1000; align-items: center; justify-content: center; padding: 1rem;">
      <div style="background: #0F2440; border-radius: 20px; padding: 2rem; max-width: 500px; width: 100%; border: 1px solid rgba(255,255,255,0.1); box-shadow: 0 20px 60px rgba(0,0,0,0.5);">
        <h2 style="font-size: 1.5rem; font-weight: 700; color: #00D4FF; margin-bottom: 2rem; text-align: center;">Pilih Metode Pembayaran</h2>
        
        <div style="display: grid; gap: 1rem;">
          <button type="button" onclick="selectPayment('cash')" style="padding: 1.25rem; background: rgba(255,255,255,0.04); border: 2px solid rgba(255,255,255,0.1); border-radius: 12px; color: #e8e8e8; font-size: 1rem; font-weight: 600; cursor: pointer; transition: all 0.2s; display: flex; align-items: center; gap: 1rem;">
            <span style="font-size: 1.5rem;">💵</span>
            <span>Tunai (Bayar Langsung)</span>
          </button>
          
          <button type="button" onclick="selectPayment('debit')" style="padding: 1.25rem; background: rgba(255,255,255,0.04); border: 2px solid rgba(255,255,255,0.1); border-radius: 12px; color: #e8e8e8; font-size: 1rem; font-weight: 600; cursor: pointer; transition: all 0.2s; display: flex; align-items: center; gap: 1rem;">
            <span style="font-size: 1.5rem;">🏦</span>
            <span>Kartu Debit</span>
          </button>
          
          <button type="button" onclick="selectPayment('qris')" style="padding: 1.25rem; background: rgba(255,255,255,0.04); border: 2px solid rgba(255,255,255,0.1); border-radius: 12px; color: #e8e8e8; font-size: 1rem; font-weight: 600; cursor: pointer; transition: all 0.2s; display: flex; align-items: center; gap: 1rem;">
            <span style="font-size: 1.5rem;">📲</span>
            <span>QRIS</span>
          </button>
          
          <button type="button" onclick="selectPayment('ewallet')" style="padding: 1.25rem; background: rgba(255,255,255,0.04); border: 2px solid rgba(255,255,255,0.1); border-radius: 12px; color: #e8e8e8; font-size: 1rem; font-weight: 600; cursor: pointer; transition: all 0.2s; display: flex; align-items: center; gap: 1rem;">
            <span style="font-size: 1.5rem;">💳</span>
            <span>E-Wallet</span>
          </button>
        </div>

        <button type="button" onclick="closePaymentModal()" style="width: 100%; padding: 0.75rem; margin-top: 1.5rem; background: transparent; border: 2px solid rgba(255,255,255,0.2); color: rgba(255,255,255,0.6); border-radius: 10px; font-size: 0.9rem; font-weight: 600; cursor: pointer;">
          Batal
        </button>
      </div>
    </div>

    <style>
      #paymentModal button:hover {
        border-color: #00D4FF !important;
        background: rgba(0, 212, 255, 0.1) !important;
        color: #00D4FF !important;
        transform: translateY(-2px);
      }
    </style>

    <script>
      function showPaymentModal() {
        const modal = document.getElementById('paymentModal');
        modal.style.display = 'flex';
      }

      function closePaymentModal() {
        const modal = document.getElementById('paymentModal');
        modal.style.display = 'none';
      }

      function selectPayment(method) {
        const form = document.getElementById('checkoutForm');
        if (!form) {
          alert('Form tidak ditemukan!');
          return;
        }
        
        const input = document.createElement('input');
        input.type = 'hidden';
        input.name = 'payment_method';
        input.value = method;
        form.appendChild(input);
        
        closePaymentModal();
        setTimeout(() => form.submit(), 100);
      }

      // Close modal when clicking outside
      const modal = document.getElementById('paymentModal');
      if (modal) {
        modal.addEventListener('click', function(e) {
          if (e.target === this) closePaymentModal();
        });
      }

      // Close modal on Escape key
      document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') closePaymentModal();
      });
    </script>
    @else
    <!-- Empty State -->
    <div class="cart-container">
      <div class="empty-cart">
        <svg class="empty-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
        </svg>
        <div class="empty-title">Keranjang Kosong</div>
        <p class="empty-desc">Belum ada produk yang ditambahkan ke keranjang</p>
        <a href="{{ route('home') }}" class="btn-continue">Mulai Belanja</a>
      </div>
    </div>
    @endif
  </div>
</div>
@endsection

@push('scripts')
<script>
function updateQty(id, change) {
    fetch(`/cart/update/${id}`, {
        method: 'PATCH',
        headers: { 
            'Content-Type': 'application/json', 
            'X-CSRF-TOKEN': '{{ csrf_token() }}', 
            'Accept': 'application/json' 
        },
        body: JSON.stringify({ qty: change })
    }).then(r => r.json()).then(d => {
        if(d.success) location.reload();
        else alert(d.message || 'Gagal memperbarui');
    }).catch(() => alert('Kesalahan koneksi'));
}

function removeItem(id) {
    if(!confirm('Hapus produk ini dari keranjang?')) return;
    fetch(`/cart/remove/${id}`, {
        method: 'DELETE',
        headers: { 
            'X-CSRF-TOKEN': '{{ csrf_token() }}', 
            'Accept': 'application/json' 
        }
    }).then(r => r.json()).then(d => {
        if(d.success) location.reload();
        else alert(d.message || 'Gagal menghapus');
    }).catch(() => alert('Kesalahan koneksi'));
}
</script>
@endpush