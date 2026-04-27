<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Struk #{{ str_pad($transaction->id, 5, '0', STR_PAD_LEFT) }}</title>
    <style>
        /* Reset & Base Thermal Print Styles */
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { 
            font-family: 'Courier New', Courier, monospace; 
            font-size: 12px; 
            line-height: 1.4; 
            color: #000; 
            background: #fff;
            width: 80mm; /* Ubah ke 58mm jika pakai printer kecil */
            margin: 0 auto;
            padding: 10px;
        }
        .header { text-align: center; margin-bottom: 10px; border-bottom: 1px dashed #000; padding-bottom: 8px; }
        .header h1 { font-size: 16px; font-weight: bold; margin-bottom: 4px; }
        .header p { font-size: 11px; margin: 2px 0; }
        
        .info { margin: 8px 0; font-size: 11px; }
        .info div { display: flex; justify-content: space-between; }
        
        .items { margin: 8px 0; border-top: 1px dashed #000; border-bottom: 1px dashed #000; padding: 6px 0; }
        .item { display: flex; justify-content: space-between; margin-bottom: 4px; }
        .item-name { flex: 1; padding-right: 5px; }
        .item-qty { width: 40px; text-align: center; }
        .item-price { width: 80px; text-align: right; }
        
        .totals { margin: 8px 0; }
        .totals div { display: flex; justify-content: space-between; margin-bottom: 3px; }
        .totals .grand { font-weight: bold; font-size: 14px; border-top: 1px dashed #000; padding-top: 5px; margin-top: 5px; }
        
        .footer { text-align: center; margin-top: 15px; font-size: 11px; border-top: 1px dashed #000; padding-top: 8px; }
        .footer p { margin: 3px 0; }
        
        .btn-print {
            display: block; width: 100%; padding: 10px; margin-top: 20px;
            background: #000; color: #fff; border: none; font-family: inherit;
            font-size: 14px; font-weight: bold; cursor: pointer; text-align: center;
        }
        .btn-print:hover { background: #333; }

        /* Print Optimization */
        @media print {
            body { width: 100%; margin: 0; padding: 0; }
            .btn-print { display: none !important; }
            @page { margin: 0; size: auto; }
        }
    </style>
</head>
<body>
    <div id="receipt-content">
        <div class="header">
            <h1>MIGU STORE</h1>
            <p>Jl. Fashion Modern No. 88, Jakarta</p>
            <p>Telp: 0812-3456-7890</p>
        </div>

        <div class="info">
            <div><span>No. Transaksi</span><span>#{{ str_pad($transaction->id, 5, '0', STR_PAD_LEFT) }}</span></div>
            <div><span>Tanggal</span><span>{{ $transaction->created_at->format('d/m/Y H:i') }}</span></div>
            <div><span>Kasir</span><span>{{ $transaction->user->name ?? 'Admin' }}</span></div>
        </div>

        <div class="items">
            @foreach($transaction->transactionItems as $item)
            <div class="item">
                <span class="item-name">{{ $item->product->name }}</span>
                <span class="item-qty">{{ $item->qty }}x</span>
                <span class="item-price">{{ number_format($item->subtotal, 0, ',', '.') }}</span>
            </div>
            @endforeach
        </div>

        <div class="totals">
            <div><span>Subtotal</span><span>Rp {{ number_format($transaction->total_amount, 0, ',', '.') }}</span></div>
            <div><span>Bayar ({{ strtoupper($transaction->payment_method) }})</span><span>Rp {{ number_format($transaction->payment_amount, 0, ',', '.') }}</span></div>
            <div class="grand"><span>KEMBALIAN</span><span>Rp {{ number_format($transaction->change_amount, 0, ',', '.') }}</span></div>
        </div>

        <div class="footer">
            <p>*** TERIMA KASIH ***</p>
            <p>Barang yang sudah dibeli tidak dapat ditukar/dikembalikan</p>
            <p style="margin-top: 8px; font-size: 10px;">Dicetak: {{ now()->format('d/m/Y H:i:s') }}</p>
        </div>
    </div>

    <button class="btn-print" onclick="window.print()">🖨️ CETAK STRUK</button>

    <script>
        // Auto print saat halaman dibuka
        window.onload = function() {
            setTimeout(() => window.print(), 500);
        }
    </script>
</body>
</html>