<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>{{ $title }}</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Arial', sans-serif;
            font-size: 11px;
            line-height: 1.6;
            color: #333;
        }
        
        .header {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 3px solid #0891b2;
            padding-bottom: 15px;
        }
        
        .header h1 {
            font-size: 24px;
            color: #0891b2;
            margin-bottom: 5px;
        }
        
        .header .subtitle {
            font-size: 12px;
            color: #666;
        }
        
        .summary {
            margin: 20px 0;
            background-color: #f0f9ff;
            padding: 15px;
            border-left: 4px solid #0891b2;
            border-radius: 4px;
        }
        
        .summary-row {
            display: flex;
            justify-content: space-between;
            margin: 8px 0;
            font-weight: bold;
        }
        
        .meta {
            margin-bottom: 20px;
            font-size: 11px;
            color: #666;
        }
        
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }
        
        thead {
            background-color: #0891b2;
            color: white;
        }
        
        th {
            padding: 12px;
            text-align: left;
            font-weight: bold;
            border: 1px solid #0891b2;
        }
        
        td {
            padding: 10px 12px;
            border: 1px solid #e5e7eb;
        }
        
        tbody tr:nth-child(odd) {
            background-color: #f9fafb;
        }
        
        .price {
            text-align: right;
            font-weight: bold;
        }
        
        .method-badge {
            padding: 4px 8px;
            border-radius: 4px;
            font-size: 10px;
            font-weight: bold;
            display: inline-block;
        }
        
        .method-transfer {
            background-color: #dbeafe;
            color: #1e40af;
        }
        
        .method-qris {
            background-color: #e0e7ff;
            color: #3730a3;
        }
        
        .method-cash {
            background-color: #dcfce7;
            color: #166534;
        }
        
        .items-list {
            font-size: 10px;
            line-height: 1.4;
        }
        
        .items-list small {
            display: block;
            margin: 2px 0;
        }
        
        .footer {
            margin-top: 30px;
            text-align: right;
            font-size: 10px;
            color: #999;
            border-top: 1px solid #e5e7eb;
            padding-top: 10px;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>{{ $title }}</h1>
        <p class="subtitle">Migu POS - Sistem Manajemen Penjualan</p>
    </div>
    
    <div class="summary">
        <div class="summary-row">
            <span>Total Transaksi:</span>
            <span>{{ $totalTransactions }}</span>
        </div>
        <div class="summary-row" style="font-size: 13px; border-top: 2px solid #ccc; padding-top: 10px; margin-top: 10px;">
            <span>Total Penjualan:</span>
            <span class="price">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</span>
        </div>
    </div>
    
    <div class="meta">
        <p><strong>Tanggal Cetak:</strong> {{ $generated_at }}</p>
    </div>
    
    <table>
        <thead>
            <tr>
                <th width="5%">#</th>
                <th width="12%">Tanggal</th>
                <th width="15%">Kasir</th>
                <th width="30%">Produk</th>
                <th width="15%">Metode</th>
                <th width="15%">Total</th>
            </tr>
        </thead>
        <tbody>
            @forelse($transactions as $index => $transaction)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $transaction->created_at->format('d/m/Y H:i') }}</td>
                <td>{{ $transaction->user->name ?? '-' }}</td>
                <td class="items-list">
                    @foreach($transaction->transactionItems as $item)
                        <small>• {{ $item->product->name }} ({{ $item->qty }}x @ Rp {{ number_format($item->price, 0, ',', '.') }})</small>
                    @endforeach
                </td>
                <td>
                    @php
                        $method = $transaction->payment_method ?? 'cash';
                        $methodLabel = match($method) {
                            'transfer' => 'Transfer Bank',
                            'qris' => 'QRIS',
                            default => 'Tunai'
                        };
                        $methodClass = 'method-' . ($method ?: 'cash');
                    @endphp
                    <span class="method-badge {{ $methodClass }}">{{ $methodLabel }}</span>
                </td>
                <td class="price">Rp {{ number_format($transaction->total_amount, 0, ',', '.') }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="6" style="text-align: center; color: #999;">Tidak ada transaksi tersedia</td>
            </tr>
            @endforelse
        </tbody>
    </table>
    
    <div class="footer">
        <p>Dokumen ini secara otomatis dibuat oleh Migu POS</p>
        <p style="color: #999; font-size: 9px;">© {{ date('Y') }} Migu STORE - All Rights Reserved</p>
    </div>
</body>
</html>
