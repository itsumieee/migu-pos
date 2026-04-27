@extends('layouts.app')

@section('page-title', 'Menunggu Konfirmasi Kasir')

@section('content')

<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Syne:wght@700;800&display=swap" rel="stylesheet">

<!-- Success Toast Notification (shown immediately) -->
<div id="successToast" style="position: fixed; top: 2rem; right: 2rem; background: linear-gradient(135deg, #34D399 0%, #10B981 100%); color: white; padding: 1.5rem 2rem; border-radius: 12px; box-shadow: 0 8px 24px rgba(52, 211, 153, 0.3); z-index: 9999; animation: slideIn 0.4s ease-out, slideOut 4s ease-in 5.6s forwards; max-width: 380px;">
  <div style="display: flex; align-items: center; gap: 1rem;">
    <span style="font-size: 1.5rem;">✅</span>
    <div>
      <p style="font-weight: 700; margin-bottom: 0.25rem;">Pesanan Berhasil Dibuat!</p>
      <p style="font-size: 0.9rem; opacity: 0.9;">Pesanan Anda sedang menunggu konfirmasi kasir</p>
    </div>
  </div>
</div>

<style>
  @keyframes slideIn {
    from {
      transform: translateX(400px);
      opacity: 0;
    }
    to {
      transform: translateX(0);
      opacity: 1;
    }
  }

  @keyframes slideOut {
    from {
      transform: translateX(0);
      opacity: 1;
    }
    to {
      transform: translateX(400px);
      opacity: 0;
    }
  }
</style>

<div style="font-family: 'Plus Jakarta Sans', sans-serif; background: linear-gradient(135deg, #0F172A 0%, #1E293B 50%, #0F172A 100%); min-height: 100vh; display: flex; align-items: center; justify-content: center; padding: 2rem;">
    <div style="max-width: 500px; width: 100%;">
        
        <!-- Waiting Card -->
        <div style="background: rgba(255,255,255,0.04); border: 1px solid rgba(255,255,255,0.08); border-radius: 18px; padding: 2rem; position: relative; overflow: hidden;">
            <div style="position: absolute; inset: 0; background: linear-gradient(140deg, rgba(255,255,255,0.05) 0%, transparent 55%); pointer-events: none;"></div>
            
            <div style="position: relative; z-index: 1; text-align: center;">
                
                <!-- Status Icon (Loading) -->
                <div style="margin-bottom: 2rem; display: flex; justify-content: center;">
                    <div style="width: 80px; height: 80px; border-radius: 50%; background: rgba(34, 211, 238, 0.1); border: 2px solid rgba(34, 211, 238, 0.3); display: flex; align-items: center; justify-content: center; animation: spin 3s linear infinite;">
                        <svg style="width: 40px; height: 40px; color: #22D3EE;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                </div>

                <!-- Title -->
                <h2 style="font-family: 'Syne', sans-serif; font-size: 1.5rem; font-weight: 800; color: #F0F4FF; margin-bottom: 0.5rem;">Menunggu Konfirmasi</h2>
                <p style="color: #8B9AB0; font-size: 0.9rem; margin-bottom: 2rem;">Kasir sedang memproses pesanan Anda</p>

                <!-- Order Info -->
                <div style="background: rgba(255,255,255,0.03); border-radius: 12px; padding: 1.5rem; margin-bottom: 2rem; text-align: left;">
                    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1rem; padding-bottom: 1rem; border-bottom: 1px solid rgba(255,255,255,0.1);">
                        <span style="color: #8B9AB0; font-size: 0.9rem;">Nomor Pesanan</span>
                        <span style="color: #F0F4FF; font-weight: 600;">{{ $order->order_number }}</span>
                    </div>
                    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1rem; padding-bottom: 1rem; border-bottom: 1px solid rgba(255,255,255,0.1);">
                        <span style="color: #8B9AB0; font-size: 0.9rem;">Total Pesanan</span>
                        <span style="color: #22D3EE; font-weight: 700; font-size: 1.1rem;">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</span>
                    </div>
                    <div style="display: flex; justify-content: space-between; align-items: center;">
                        <span style="color: #8B9AB0; font-size: 0.9rem;">Metode Pembayaran</span>
                        <span style="color: #F0F4FF; font-weight: 600;">
                            @switch($order->payment_method)
                                @case('cash')
                                    💵 Tunai
                                    @break
                                @case('debit')
                                    🏦 Kartu Debit
                                    @break
                                @case('qris')
                                    📲 QRIS
                                    @break
                                @case('ewallet')
                                    💳 E-Wallet
                                    @break
                                @default
                                    {{ $order->payment_method }}
                            @endswitch
                        </span>
                    </div>
                </div>

                <!-- Countdown -->
                <div style="background: rgba(251, 113, 133, 0.1); border: 1px solid rgba(251, 113, 133, 0.25); border-radius: 10px; padding: 1rem; margin-bottom: 2rem;">
                    <p style="color: #FB7185; font-size: 0.85rem; margin-bottom: 0.35rem;">Batas waktu konfirmasi</p>
                    <div style="font-family: 'Syne', sans-serif; font-size: 1.5rem; font-weight: 800; color: #F0F4FF;" id="countdown">
                        15:00
                    </div>
                </div>

                <!-- Items List -->
                <div style="background: rgba(255,255,255,0.03); border-radius: 12px; padding: 1rem; margin-bottom: 2rem; max-height: 300px; overflow-y: auto;">
                    @foreach($order->items as $item)
                        <div style="display: flex; justify-content: space-between; align-items: center; padding: 0.75rem 0; border-bottom: 1px solid rgba(255,255,255,0.05);">
                            <div style="text-align: left; flex: 1;">
                                <p style="color: #F0F4FF; font-weight: 500; font-size: 0.9rem; margin-bottom: 0.2rem;">{{ $item->product->name }}</p>
                                <p style="color: #8B9AB0; font-size: 0.8rem;">{{ $item->quantity }} x Rp {{ number_format($item->price, 0, ',', '.') }}</p>
                            </div>
                            <p style="color: #22D3EE; font-weight: 600;">Rp {{ number_format($item->subtotal, 0, ',', '.') }}</p>
                        </div>
                    @endforeach
                </div>

                <!-- Status Message -->
                <div id="status-message" style="padding: 1rem; border-radius: 10px; margin-bottom: 2rem; background: rgba(34, 211, 238, 0.1); border: 1px solid rgba(34, 211, 238, 0.25); color: #22D3EE; font-size: 0.9rem;">
                    ⏳ Menunggu konfirmasi kasir...
                </div>

                <!-- Back Button -->
                <a href="{{ route('home') }}" style="display: inline-block; padding: 0.85rem 1.6rem; background: rgba(255,255,255,0.08); border: 1px solid rgba(255,255,255,0.1); color: #8B9AB0; text-decoration: none; border-radius: 10px; font-weight: 600; transition: all 0.3s; font-size: 0.9rem;">
                    ← Kembali ke Toko
                </a>

            </div>
        </div>

    </div>
</div>

<style>
@keyframes spin {
    from { transform: rotate(0deg); }
    to { transform: rotate(360deg); }
}

@keyframes pulse {
    0%, 100% { opacity: 1; }
    50% { opacity: 0.5; }
}

.pulse {
    animation: pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
}
</style>

<script>
    // Auto-refresh status setiap 2 detik
    const orderId = {{ $order->id }};
    let remainingSeconds = {{ $remainingSeconds }};

    function updateStatus() {
        fetch(`/checkout/status/${orderId}`)
            .then(response => response.json())
            .then(data => {
                const statusEl = document.getElementById('status-message');

                if (data.status === 'confirmed') {
                    statusEl.innerHTML = '✅ Pesanan dikonfirmasi! Mengalihkan...';
                    statusEl.style.background = 'rgba(52, 211, 153, 0.1)';
                    statusEl.style.borderColor = 'rgba(52, 211, 153, 0.25)';
                    statusEl.style.color = '#34D399';
                    setTimeout(() => {
                        window.location.href = `/order/success/${orderId}`;
                    }, 2000);
                } else if (data.status === 'rejected') {
                    statusEl.innerHTML = `❌ Pesanan ditolak<br><small>${data.rejection_reason || 'Alasan tidak diberikan'}</small>`;
                    statusEl.style.background = 'rgba(251, 113, 133, 0.1)';
                    statusEl.style.borderColor = 'rgba(251, 113, 133, 0.25)';
                    statusEl.style.color = '#FB7185';
                    document.querySelector('a').style.display = 'block';
                } else if (data.status === 'expired') {
                    statusEl.innerHTML = '⏰ Waktu konfirmasi berakhir';
                    statusEl.style.background = 'rgba(251, 191, 36, 0.1)';
                    statusEl.style.borderColor = 'rgba(251, 191, 36, 0.25)';
                    statusEl.style.color = '#FBBF24';
                }
            })
            .catch(error => console.error('Error:', error));
    }

    function updateCountdown() {
        remainingSeconds--;
        const minutes = Math.floor(remainingSeconds / 60);
        const seconds = remainingSeconds % 60;
        document.getElementById('countdown').textContent = 
            `${String(minutes).padStart(2, '0')}:${String(seconds).padStart(2, '0')}`;

        if (remainingSeconds <= 0) {
            clearInterval(countdownInterval);
            updateStatus();
        }
    }

    // Initial status check
    updateStatus();

    // Check status every 2 seconds
    setInterval(updateStatus, 2000);

    // Update countdown every second
    const countdownInterval = setInterval(updateCountdown, 1000);
</script>

@endsection
