@extends('layouts.app')

@section('page-title', 'Detail Konfirmasi Pembayaran')

@section('content')

<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Syne:wght@700;800&display=swap" rel="stylesheet">

<div style="font-family: 'Plus Jakarta Sans', sans-serif; background: linear-gradient(135deg, #0F172A 0%, #1E293B 50%, #0F172A 100%); min-height: 100vh; padding: 2rem;">
    <div style="max-width: 900px; margin: 0 auto;">

        <!-- Back Button -->
        <a href="{{ route('pos.confirmations.index') }}" style="display: inline-flex; align-items: center; gap: 0.5rem; padding: 0.75rem 1.25rem; background: rgba(255,255,255,0.06); border: 1px solid rgba(255,255,255,0.1); color: #8B9AB0; text-decoration: none; border-radius: 10px; font-weight: 600; margin-bottom: 1.5rem; transition: all 0.3s; font-size: 0.85rem;">
            ← Kembali
        </a>

        <!-- Main Card -->
        <div style="background: rgba(255,255,255,0.04); border: 1px solid rgba(255,255,255,0.08); border-radius: 22px; padding: 2rem; position: relative; overflow: hidden;">
            <div style="position: absolute; inset: 0; background: linear-gradient(140deg, rgba(255,255,255,0.05) 0%, transparent 55%); pointer-events: none;"></div>

            <div style="position: relative; z-index: 1;">

                <!-- Header -->
                <div style="display: flex; justify-content: space-between; align-items: start; margin-bottom: 2rem; padding-bottom: 1.5rem; border-bottom: 1px solid rgba(255,255,255,0.1);">
                    <div>
                        <div style="display: inline-flex; align-items: center; gap: 7px; padding: 5px 14px; border-radius: 100px; background: rgba(34, 211, 238, 0.1); border: 1px solid rgba(34, 211, 238, 0.25); font-size: 11px; font-weight: 700; letter-spacing: 0.09em; text-transform: uppercase; color: #22D3EE; margin-bottom: 1rem;">
                            📋 Konfirmasi Pembayaran
                        </div>
                        <h1 style="font-family: 'Syne', sans-serif; font-size: 1.8rem; font-weight: 800; color: #F0F4FF;">{{ $checkoutRequest->order->order_number }}</h1>
                    </div>
                    <div style="text-align: right;">
                        <p style="color: #8B9AB0; font-size: 0.8rem; margin-bottom: 0.5rem;">Status</p>
                        <div style="display: inline-flex; gap: 7px; padding: 6px 12px; border-radius: 8px; background: rgba(251, 191, 36, 0.1); border: 1px solid rgba(251, 191, 36, 0.25); font-size: 11px; font-weight: 700; color: #FBBF24; text-transform: uppercase;">
                            ⏳ Menunggu
                        </div>
                    </div>
                </div>

                <!-- Grid: Customer & Amount -->
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 2rem; margin-bottom: 2rem;">

                    <!-- Customer Section -->
                    <div>
                        <p style="color: #8B9AB0; font-size: 0.8rem; font-weight: 700; text-transform: uppercase; margin-bottom: 1rem; letter-spacing: 0.3px;">Informasi Pelanggan</p>
                        <div style="background: rgba(255,255,255,0.03); border-radius: 12px; padding: 1.5rem; border: 1px solid rgba(255,255,255,0.06);">
                            <p style="color: #F0F4FF; font-weight: 600; font-size: 1.1rem; margin-bottom: 0.5rem;">{{ $checkoutRequest->customer->name }}</p>
                            <p style="color: #8B9AB0; font-size: 0.9rem; margin-bottom: 1rem;">{{ $checkoutRequest->customer->email }}</p>
                            <p style="color: #8B9AB0; font-size: 0.8rem;">
                                <strong>Telepon:</strong> {{ $checkoutRequest->customer->phone ?? 'Tidak tersedia' }}
                            </p>
                        </div>
                    </div>

                    <!-- Amount Section -->
                    <div>
                        <p style="color: #8B9AB0; font-size: 0.8rem; font-weight: 700; text-transform: uppercase; margin-bottom: 1rem; letter-spacing: 0.3px;">Total Pembayaran</p>
                        <div style="background: linear-gradient(135deg, rgba(34, 211, 238, 0.1) 0%, rgba(6, 182, 212, 0.05) 100%); border-radius: 12px; padding: 1.5rem; border: 1px solid rgba(34, 211, 238, 0.2);">
                            <p style="color: #22D3EE; font-family: 'Syne', sans-serif; font-weight: 800; font-size: 2rem; margin-bottom: 0.5rem;">
                                Rp {{ number_format($checkoutRequest->total_amount, 0, ',', '.') }}
                            </p>
                            <p style="color: #8B9AB0; font-size: 0.9rem;">
                                @switch($checkoutRequest->payment_method)
                                    @case('cash')
                                        💵 Tunai (Pembayaran Langsung)
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
                                @endswitch
                            </p>
                        </div>
                    </div>

                </div>

                <!-- Items List -->
                <div style="margin-bottom: 2rem;">
                    <p style="color: #8B9AB0; font-size: 0.8rem; font-weight: 700; text-transform: uppercase; margin-bottom: 1rem; letter-spacing: 0.3px;">Barang Pesanan</p>
                    <div style="background: rgba(255,255,255,0.03); border-radius: 12px; border: 1px solid rgba(255,255,255,0.06); overflow: hidden;">
                        @foreach($checkoutRequest->order->items as $item)
                            <div style="padding: 1rem; border-bottom: 1px solid rgba(255,255,255,0.06); display: flex; gap: 1rem;" @if($loop->last)style="border-bottom: none;"@endif>
                                <!-- Product Image -->
                                <div style="width: 80px; height: 80px; flex-shrink: 0; background: rgba(255,255,255,0.06); border-radius: 10px; overflow: hidden;">
                                    @if($item->product->image)
                                        <img src="{{ asset('storage/' . $item->product->image) }}" alt="{{ $item->product->name }}" style="width: 100%; height: 100%; object-fit: cover;">
                                    @else
                                        <div style="width: 100%; height: 100%; display: flex; align-items: center; justify-content: center; color: #8B9AB0;">📦</div>
                                    @endif
                                </div>

                                <!-- Item Details -->
                                <div style="flex: 1;">
                                    <p style="color: #F0F4FF; font-weight: 600; margin-bottom: 0.25rem;">{{ $item->product->name }}</p>
                                    <p style="color: #8B9AB0; font-size: 0.85rem; margin-bottom: 0.5rem;">Kategori: {{ $item->product->category->name ?? 'Uncategorized' }}</p>
                                    <p style="color: #8B9AB0; font-size: 0.85rem;">
                                        {{ $item->quantity }} x Rp {{ number_format($item->price, 0, ',', '.') }}
                                    </p>
                                </div>

                                <!-- Subtotal -->
                                <div style="text-align: right; min-width: 120px;">
                                    <p style="color: #22D3EE; font-family: 'Syne', sans-serif; font-weight: 800; font-size: 1.05rem;">
                                        Rp {{ number_format($item->subtotal, 0, ',', '.') }}
                                    </p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Action Buttons -->
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
                    <!-- Approve Button -->
                    <button onclick="approveCheckout({{ $checkoutRequest->id }})" style="padding: 1rem; background: linear-gradient(135deg, #34D399 0%, #10B981 100%); color: #0F172A; border: none; border-radius: 12px; font-weight: 700; cursor: pointer; font-size: 0.95rem; letter-spacing: 0.3px; text-transform: uppercase; transition: all 0.3s; box-shadow: 0 12px 28px rgba(52, 211, 153, 0.25);">
                        ✅ SETUJUI PEMBAYARAN
                    </button>

                    <!-- Reject Button -->
                    <button onclick="showRejectModal()" style="padding: 1rem; background: linear-gradient(135deg, #FB7185 0%, #F43F5E 100%); color: white; border: none; border-radius: 12px; font-weight: 700; cursor: pointer; font-size: 0.95rem; letter-spacing: 0.3px; text-transform: uppercase; transition: all 0.3s; box-shadow: 0 12px 28px rgba(251, 113, 133, 0.25);">
                        ❌ TOLAK PEMBAYARAN
                    </button>
                </div>

            </div>
        </div>

    </div>
</div>

<!-- Reject Modal -->
<div id="reject-modal" style="display: none; position: fixed; inset: 0; background: rgba(0,0,0,0.6); backdrop-filter: blur(4px); z-index: 1000; display: flex; align-items: center; justify-content: center; padding: 1rem;">
    <div style="background: #1E293B; border-radius: 18px; padding: 2rem; max-width: 400px; width: 100%; border: 1px solid rgba(255,255,255,0.1);">
        <h2 style="font-family: 'Syne', sans-serif; font-size: 1.3rem; font-weight: 800; color: #F0F4FF; margin-bottom: 1rem;">Alasan Penolakan</h2>
        
        <textarea id="reject-reason" placeholder="Masukkan alasan penolakan pembayaran..." style="width: 100%; padding: 0.85rem; background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1); border-radius: 10px; color: #F0F4FF; font-size: 0.9rem; min-height: 100px; resize: vertical; outline: none; margin-bottom: 1.5rem; font-family: 'Plus Jakarta Sans', sans-serif;" onkeydown="if(event.keyCode===27) closeRejectModal()"></textarea>

        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
            <button onclick="closeRejectModal()" style="padding: 0.85rem; background: rgba(255,255,255,0.08); border: 1px solid rgba(255,255,255,0.1); color: #8B9AB0; border-radius: 10px; font-weight: 600; cursor: pointer; font-size: 0.9rem;">
                Batal
            </button>
            <button onclick="rejectCheckout({{ $checkoutRequest->id }})" style="padding: 0.85rem; background: linear-gradient(135deg, #FB7185 0%, #F43F5E 100%); color: white; border: none; border-radius: 10px; font-weight: 700; cursor: pointer; font-size: 0.9rem;">
                Tolak Pembayaran
            </button>
        </div>
    </div>
</div>

<script>
function showRejectModal() {
    document.getElementById('reject-modal').style.display = 'flex';
}

function closeRejectModal() {
    document.getElementById('reject-modal').style.display = 'none';
}

function approveCheckout(checkoutRequestId) {
    if (confirm('Apakah Anda yakin ingin menyetujui pembayaran ini?')) {
        fetch(`/pos/confirmations/${checkoutRequestId}/approve`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Content-Type': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert('Pembayaran berhasil dikonfirmasi!');
                window.location.href = data.redirect;
            } else {
                alert('Error: ' + data.error);
            }
        })
        .catch(error => console.error('Error:', error));
    }
}

function rejectCheckout(checkoutRequestId) {
    const reason = document.getElementById('reject-reason').value.trim();
    if (!reason) {
        alert('Silakan masukkan alasan penolakan');
        return;
    }

    if (confirm('Apakah Anda yakin ingin menolak pembayaran ini?')) {
        fetch(`/pos/confirmations/${checkoutRequestId}/reject`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ reason: reason })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert('Pembayaran berhasil ditolak!');
                window.location.href = data.redirect;
            } else {
                alert('Error: ' + data.error);
            }
        })
        .catch(error => console.error('Error:', error));
    }
}

// Close modal when clicking outside
document.getElementById('reject-modal').onclick = function(event) {
    if (event.target === this) closeRejectModal();
}
</script>

@endsection
