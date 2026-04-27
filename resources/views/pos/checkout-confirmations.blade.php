@extends('layouts.app')

@section('page-title', 'Konfirmasi Pembayaran')

@section('content')

<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Syne:wght@700;800&display=swap" rel="stylesheet">

<div style="font-family: 'Plus Jakarta Sans', sans-serif; background: linear-gradient(135deg, #0F172A 0%, #1E293B 50%, #0F172A 100%); min-height: 100vh; padding: 2rem;">
    <div style="max-width: 1200px; margin: 0 auto;">

        <!-- Header -->
        <div style="background: rgba(255,255,255,0.03); border: 1px solid rgba(255,255,255,0.08); border-radius: 22px; padding: 2rem; margin-bottom: 1.5rem; overflow: hidden; position: relative;">
            <div style="position: absolute; inset: 0; background: linear-gradient(140deg, rgba(255,255,255,0.05) 0%, transparent 55%); pointer-events: none;"></div>
            <div style="position: relative; z-index: 1;">
                <div style="display: inline-flex; align-items: center; gap: 7px; padding: 5px 14px; border-radius: 100px; background: rgba(34, 211, 238, 0.1); border: 1px solid rgba(34, 211, 238, 0.25); font-size: 11px; font-weight: 700; letter-spacing: 0.09em; text-transform: uppercase; color: #22D3EE; margin-bottom: 1rem;">
                    ✅ Konfirmasi Pembayaran
                </div>
                <h1 style="font-family: 'Syne', sans-serif; font-size: 2rem; font-weight: 800; color: #F0F4FF; margin-bottom: 0.5rem;">Pesanan Menunggu</h1>
                <p style="color: #8B9AB0; font-size: 0.95rem;">Total {{ $pendingCheckouts->total() }} pesanan menunggu konfirmasi Anda</p>
            </div>
        </div>

        <!-- Pending Checkouts Grid -->
        @if($pendingCheckouts->count() > 0)
            <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(420px, 1fr)); gap: 1.5rem;">
                @foreach($pendingCheckouts as $checkout)
                    <a href="{{ route('pos.confirmations.show', $checkout->id) }}" style="text-decoration: none; display: block; transition: all 0.3s;">
                        <div style="background: rgba(255,255,255,0.04); border: 1px solid rgba(255,255,255,0.08); border-radius: 18px; padding: 1.5rem; position: relative; overflow: hidden; cursor: pointer; hover_transform: translateY(-4px); hover_border_color: rgba(34, 211, 238, 0.3);">
                            <div style="position: absolute; inset: 0; background: linear-gradient(140deg, rgba(255,255,255,0.05) 0%, transparent 55%); pointer-events: none;"></div>

                            <div style="position: relative; z-index: 1;">
                                <!-- Top Info -->
                                <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 1rem; padding-bottom: 1rem; border-bottom: 1px solid rgba(255,255,255,0.1);">
                                    <div>
                                        <p style="color: #8B9AB0; font-size: 0.8rem; margin-bottom: 0.25rem;">Nomor Pesanan</p>
                                        <p style="color: #F0F4FF; font-weight: 700; font-size: 1.1rem;">{{ $checkout->order->order_number }}</p>
                                    </div>
                                    <div style="text-align: right;">
                                        <div style="display: inline-flex; gap: 7px; padding: 4px 10px; border-radius: 8px; background: rgba(251, 191, 36, 0.1); border: 1px solid rgba(251, 191, 36, 0.25); font-size: 10px; font-weight: 700; color: #FBBF24; text-transform: uppercase;">
                                            ⏳ Pending
                                        </div>
                                    </div>
                                </div>

                                <!-- Customer Info -->
                                <div style="background: rgba(255,255,255,0.03); border-radius: 12px; padding: 0.75rem; margin-bottom: 1rem;">
                                    <p style="color: #8B9AB0; font-size: 0.8rem; margin-bottom: 0.25rem;">Pelanggan</p>
                                    <p style="color: #F0F4FF; font-weight: 600;">{{ $checkout->customer->name }}</p>
                                    <p style="color: #8B9AB0; font-size: 0.8rem;">{{ $checkout->customer->email }}</p>
                                </div>

                                <!-- Amount & Payment Method -->
                                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; margin-bottom: 1rem;">
                                    <div>
                                        <p style="color: #8B9AB0; font-size: 0.8rem; margin-bottom: 0.25rem;">Total Amount</p>
                                        <p style="color: #22D3EE; font-family: 'Syne', sans-serif; font-weight: 800; font-size: 1.3rem;">Rp {{ number_format($checkout->total_amount, 0, ',', '.') }}</p>
                                    </div>
                                    <div>
                                        <p style="color: #8B9AB0; font-size: 0.8rem; margin-bottom: 0.25rem;">Metode Bayar</p>
                                        <p style="color: #F0F4FF; font-weight: 600;">
                                            @switch($checkout->payment_method)
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
                                                    {{ $checkout->payment_method }}
                                            @endswitch
                                        </p>
                                    </div>
                                </div>

                                <!-- Items Count -->
                                <div style="background: rgba(52, 211, 153, 0.1); border: 1px solid rgba(52, 211, 153, 0.25); border-radius: 10px; padding: 0.75rem; text-align: center;">
                                    <p style="color: #34D399; font-weight: 600;">
                                        {{ $checkout->order->items->sum('quantity') }} item pesanan
                                    </p>
                                </div>

                                <!-- Timestamp -->
                                <p style="color: #8B9AB0; font-size: 0.75rem; margin-top: 1rem; text-align: right;">
                                    {{ $checkout->created_at->diffForHumans() }}
                                </p>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>

            <!-- Pagination -->
            @if($pendingCheckouts->hasPages())
                <div style="margin-top: 2rem; display: flex; justify-content: center; gap: 1rem;">
                    {{ $pendingCheckouts->links('pagination::tailwind') }}
                </div>
            @endif

        @else
            <!-- Empty State -->
            <div style="background: rgba(255,255,255,0.04); border: 1px solid rgba(255,255,255,0.08); border-radius: 18px; padding: 3rem; text-align: center;">
                <div style="font-size: 3rem; margin-bottom: 1rem;">✅</div>
                <h3 style="font-family: 'Syne', sans-serif; font-size: 1.3rem; font-weight: 800; color: #F0F4FF; margin-bottom: 0.5rem;">Tidak Ada Pesanan Menunggu</h3>
                <p style="color: #8B9AB0; margin-bottom: 2rem;">Semua pesanan telah dikonfirmasi</p>
                <a href="{{ route('pos.index') }}" style="display: inline-block; padding: 0.85rem 1.6rem; background: linear-gradient(135deg, #22D3EE 0%, #06B6D4 100%); color: #0F172A; text-decoration: none; border-radius: 10px; font-weight: 700; letter-spacing: 0.3px; text-transform: uppercase; transition: all 0.3s; box-shadow: 0 12px 28px rgba(34, 211, 238, 0.25); font-size: 0.85rem;">
                    ← Kembali ke POS
                </a>
            </div>
        @endif

    </div>
</div>

<style>
[hover_transform] {
    transition: all 0.3s;
}

[hover_transform]:hover {
    transform: translateY(-4px);
    border-color: rgba(34, 211, 238, 0.3) !important;
    box-shadow: 0 12px 28px rgba(34, 211, 238, 0.2);
}
</style>

@endsection
