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
        
        .profit-positive {
            color: #059669;
        }
        
        .profit-negative {
            color: #dc2626;
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
        <p class="subtitle">Periode: {{ $period }} | Migu POS</p>
    </div>
    
    <div class="summary">
        <div class="summary-row">
            <span>Total Transaksi:</span>
            <span>{{ count($transactions) }}</span>
        </div>
        <div class="summary-row">
            <span>Total Penjualan:</span>
            <span class="price">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</span>
        </div>
        <div class="summary-row">
            <span>Total Modal:</span>
            <span class="price">Rp {{ number_format($totalCost, 0, ',', '.') }}</span>
        </div>
        <div class="summary-row" style="color: {{ $totalProfit >= 0 ? '#059669' : '#dc2626' }}; font-size: 13px; border-top: 2px solid #ccc; padding-top: 10px; margin-top: 10px;">
            <span>Total Profit:</span>
            <span class="price">Rp {{ number_format($totalProfit, 0, ',', '.') }}</span>
        </div>
    </div>
    
    <div class="meta">
        <p><strong>Periode:</strong> {{ $period }}</p>
        <p><strong>Tanggal Cetak:</strong> {{ $generated_at }}</p>
    </div>
    
    <table>
        <thead>
            <tr>
                <th width="5%">#</th>
                <th width="15%">Tanggal</th>
                <th width="20%">Produk (Qty)</th>
                <th width="15%">Total Penjualan</th>
                <th width="15%">Total Modal</th>
                <th width="15%">Profit</th>
            </tr>
        </thead>
        <tbody>
            @forelse($transactions as $index => $transaction)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $transaction->created_at->format('d/m/Y H:i') }}</td>
                <td>
                    @foreach($transaction->transactionItems as $item)
                        <small>• {{ $item->product->name }} ({{ $item->qty }}x)<br></small>
                    @endforeach
                </td>
                <td class="price">Rp {{ number_format($transaction->total_amount, 0, ',', '.') }}</td>
                <td class="price">Rp {{ number_format($transaction->transactionItems->sum('cost_price') * $transaction->transactionItems->sum('qty'), 0, ',', '.') }}</td>
                <td class="price {{ $transaction->transactionItems->sum('profit') >= 0 ? 'profit-positive' : 'profit-negative' }}">
                    Rp {{ number_format($transaction->transactionItems->sum('profit'), 0, ',', '.') }}
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" style="text-align: center; color: #999;">Tidak ada transaksi dalam periode ini</td>
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
