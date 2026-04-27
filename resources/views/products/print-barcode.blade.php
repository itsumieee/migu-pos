<!DOCTYPE html>
<html>
<head>
    <title>Cetak Barcode Produk</title>
    <style>
        @page { size: auto; margin: 10mm; }
        body { font-family: Arial, sans-serif; margin: 0; padding: 10px; }
        .barcode-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 10px;
        }
        .barcode-item {
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 10px;
            text-align: center;
            page-break-inside: avoid;
        }
        .barcode-item img {
            max-width: 100%;
            height: auto;
        }
        .product-name {
            font-size: 11px;
            font-weight: bold;
            margin: 5px 0 3px 0;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }
        .product-price {
            font-size: 12px;
            font-weight: bold;
            color: #06b6d4;
        }
        .product-sku {
            font-size: 9px;
            color: #666;
            margin-top: 2px;
        }
    </style>
</head>
<body>
    <div class="barcode-grid">
        @foreach($products as $product)
            @for($i = 0; $i < 2; $i++) <!-- Print 2 labels per product -->
            <div class="barcode-item">
                <img src="data:image/png;base64,{{ DNS1D::getBarcodePNG($product->sku, 'C128', 2, 50) }}" alt="barcode" />
                <div class="product-name">{{ $product->name }}</div>
                <div class="product-sku">SKU: {{ $product->sku }}</div>
                <div class="product-price">Rp {{ number_format($product->price, 0, ',', '.') }}</div>
            </div>
            @endfor
        @endforeach
    </div>

    <script>
        window.onload = function() {
            setTimeout(function() {
                window.print();
                window.location.href = '{{ route('products.index') }}';
            }, 500);
        }
    </script>
</body>
</html>