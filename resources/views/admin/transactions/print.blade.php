<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Struk Transaksi #{{ str_pad($transaction->id, 6, '0', STR_PAD_LEFT) }}</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Courier New', monospace;
            font-size: 12px;
            line-height: 1.6;
            color: #333;
            background: white;
            padding: 20px;
        }
        
        .receipt {
            max-width: 300px;
            margin: 0 auto;
            border: 1px solid #000;
            padding: 20px;
        }
        
        .header {
            text-align: center;
            margin-bottom: 20px;
            border-bottom: 2px solid #000;
            padding-bottom: 10px;
        }
        
        .store-name {
            font-size: 16px;
            font-weight: bold;
            margin-bottom: 5px;
        }
        
        .receipt-title {
            font-size: 10px;
            color: #666;
        }
        
        .receipt-number {
            text-align: center;
            font-weight: bold;
            margin: 10px 0;
            border-bottom: 1px dashed #000;
            padding-bottom: 10px;
        }
        
        .datetime {
            text-align: center;
            font-size: 10px;
            margin-bottom: 15px;
            border-bottom: 1px solid #000;
            padding-bottom: 10px;
        }
        
        .items {
            margin: 15px 0;
        }
        
        .item-row {
            margin-bottom: 8px;
            font-size: 11px;
        }
        
        .item-name {
            font-weight: bold;
        }
        
        .item-detail {
            display: flex;
            justify-content: space-between;
            font-size: 10px;
            color: #666;
        }
        
        .divider {
            border-top: 1px dashed #000;
            margin: 15px 0;
        }
        
        .summary {
            margin: 10px 0;
        }
        
        .summary-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 5px;
            font-size: 11px;
        }
        
        .total-row {
            display: flex;
            justify-content: space-between;
            margin: 10px 0;
            font-weight: bold;
            font-size: 12px;
            border-top: 2px solid #000;
            border-bottom: 2px solid #000;
            padding: 10px 0;
        }
        
        .footer {
            text-align: center;
            margin-top: 20px;
            font-size: 10px;
            color: #666;
        }
        
        .payment-method {
            text-align: center;
            font-weight: bold;
            margin: 10px 0;
            padding: 10px;
            border: 1px solid #000;
            border-radius: 4px;
        }
        
        .thank-you {
            text-align: center;
            font-weight: bold;
            margin-top: 15px;
            font-size: 11px;
        }
        
        @media print {
            body {
                margin: 0;
                padding: 0;
            }
        }
    </style>
</head>
<body>
    <div class="receipt">
        <div class="header">
            <div class="store-name">Migu STORE</div>
            <div class="receipt-title">INVOICE PENJUALAN</div>
        </div>
        
        <div class="receipt-number">
            No. Transaksi: {{ str_pad($transaction->id, 6, '0', STR_PAD_LEFT) }}
        </div>
        
        <div class="datetime">
            {{ $transaction->created_at->format('d/m/Y H:i:s') }}<br>
            Kasir: {{ $transaction->user->name ?? 'System' }}
        </div>
        
        <div class="items">
            @foreach($transaction->transactionItems as $item)
            <div class="item-row">
                <div class="item-name">{{ $item->product->name }}</div>
                <div class="item-detail">
                    <span>{{ $item->qty }} x Rp {{ number_format($item->price, 0, ',', '.') }}</span>
                    <span>Rp {{ number_format($item->price * $item->qty, 0, ',', '.') }}</span>
                </div>
            </div>
            @endforeach
        </div>
        
        <div class="divider"></div>
        
        <div class="summary">
            <div class="summary-row">
                <span>Subtotal:</span>
                <span>Rp {{ number_format($transaction->transactionItems->sum('price') * $transaction->transactionItems->sum('qty'), 0, ',', '.') }}</span>
            </div>
        </div>
        
        <div class="total-row">
            <span>TOTAL</span>
            <span>Rp {{ number_format($transaction->total_amount, 0, ',', '.') }}</span>
        </div>
        
        <div class="payment-method">
            @php
                $method = $transaction->payment_method ?? 'cash';
                $methodLabel = match($method) {
                    'transfer' => 'TRANSFER BANK',
                    'qris' => 'QRIS',
                    default => 'TUNAI'
                };
            @endphp
            {{ $methodLabel }}
        </div>
        
        <div class="thank-you">
            Terima Kasih!<br>
            Telah Berbelanja
        </div>
        
        <div class="footer">
            <p>⭐ Kualitas Terjamin</p>
            <p>Garansi 100% Kepuasan Pelanggan</p>
            <p style="margin-top: 10px; border-top: 1px solid #666; padding-top: 10px;">
                {{ now()->format('d M Y H:i:s') }}
            </p>
        </div>
    </div>
    
    <script>
        window.onload = function() {
            window.print();
        };
    </script>
</body>
</html>
