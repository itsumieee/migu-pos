<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Struk - #{{ str_pad($transaction->id, 5, '0', STR_PAD_LEFT) }}</title>
    <style>
        body { font-family: 'Courier New', Courier, monospace; margin: 0; padding: 10px; font-size: 12px; width: 100%; max-width: 300px; margin: 0 auto; }
        .text-center { text-align: center; }
        .bold { font-weight: bold; }
        .border-b { border-bottom: 1px dashed #000; margin: 5px 0; }
        .row { display: flex; justify-content: space-between; margin-bottom: 2px; }
        .total-row { font-size: 14px; font-weight: bold; border-top: 1px dashed #000; padding-top: 5px; margin-top: 5px; }
        .hidden-print { display: none; }
        
        @media print {
            .no-print { display: none; }
            body { margin: 0; padding: 0; }
        }
    </style>
</head>
<body>
    <!-- Tombol Cetak (Hanya tampil di layar) -->
    <div class="no-print" style="text-align: center; margin-bottom: 20px;">
        <button onclick="window.print()" style="background: #06b6d4; color: white; padding: 10px 20px; border: none; border-radius: 5px; cursor: pointer; font-weight: bold; font-size: 14px;">🖨️ Cetak Struk</button>
        <a href="{{ route('dashboard') }}" style="margin-left: 10px; text-decoration: none; color: #333;">Kembali</a>
    </div>

    <!-- Konten Struk -->
    <div class="content">
        <div class="text-center">
            <h2 style="margin: 0; font-size: 18px;">{{ \App\Models\Setting::get('store_name', 'MIGU POS') }}</h2>
            <p style="margin: 5px 0;">{{ \App\Models\Setting::get('store_address', 'Jl. Contoh No. 123') }}</p>
            <p style="margin: 5px 0;">Telp: {{ \App\Models\Setting::get('store_phone', '08123456789') }}</p>
        </div>

        <div class="border-b"></div>

        <div class="row">
            <span>ID: #{{ str_pad($transaction->id, 5, '0', STR_PAD_LEFT) }}</span>
            <span>{{ $transaction->created_at->format('d/m/Y H:i') }}</span>
        </div>
        <div class="row">
            <span>Kasir: {{ $transaction->user->name }}</span>
        </div>

        <div class="border-b"></div>

        <!-- Item List -->
        @foreach($transaction->transactionItems as $item)
        <div style="margin-bottom: 5px;">
            <div style="font-weight: bold;">{{ $item->product->name }}</div>
            <div class="row">
                <span>{{ $item->qty }} x Rp {{ number_format($item->price, 0, ',', '.') }}</span>
                <span>Rp {{ number_format($item->subtotal, 0, ',', '.') }}</span>
            </div>
        </div>
        @endforeach

        <div class="border-b"></div>

        <!-- Totals -->
        <div class="row">
            <span>Subtotal</span>
            <span>Rp {{ number_format($transaction->total_amount, 0, ',', '.') }}</span>
        </div>
        <div class="row">
            <span>Bayar ({{ strtoupper($transaction->payment_method) }})</span>
            <span>Rp {{ number_format($transaction->payment_amount, 0, ',', '.') }}</span>
        </div>
        <div class="row total-row">
            <span>KEMBALIAN</span>
            <span>Rp {{ number_format($transaction->change_amount, 0, ',', '.') }}</span>
        </div>

        <div class="text-center" style="margin-top: 15px;">
            <p>*** TERIMA KASIH ***</p>
            <p>Barang yang sudah dibeli<br>tidak dapat ditukar/dikembalikan</p>
        </div>
    </div>

    <script>
        // Auto print saat halaman dibuka (opsional)
        // window.onload = function() { window.print(); }
    </script>
</body>
</html>