<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Struk #{{ str_pad($transaction->id, 5, '0', STR_PAD_LEFT) }}</title>
    
    <!-- Modern Font for Screen (falls back to monospace for print) -->
    <link href="https://fonts.googleapis.com/css2?family=JetBrains+Mono:wght@400;500;700&display=swap" rel="stylesheet">
    
    <style>
        /* ── CSS Variables: Modern Receipt Theme - 🔴 RED ACCENT ───── */
        :root {
            --receipt-width: 80mm;
            --font-receipt: 'JetBrains Mono', 'Courier New', Courier, monospace;
            
            --color-bg: #ffffff;
            --color-text: #0f172a;
            --color-text-dim: #64748b;
            --color-border: #e2e8f0;
            
            /* 🔴 RED ACCENT for important elements */
            --color-accent: #ff3366;
            --color-accent-light: #ff6b6b;
            --color-accent-bg: rgba(255, 51, 102, 0.1);
            
            --spacing-xs: 4px;
            --spacing-sm: 8px;
            --spacing-md: 12px;
            --spacing-lg: 16px;
            
            --radius-sm: 4px;
            --radius: 8px;
        }

        /* ── Base Reset & Setup ───────────────────────────────── */
        * { margin: 0; padding: 0; box-sizing: border-box; }
        
        body { 
            font-family: var(--font-receipt); 
            font-size: 11px; 
            line-height: 1.5; 
            color: var(--color-text); 
            background: var(--color-bg);
            width: var(--receipt-width);
            margin: 0 auto;
            padding: var(--spacing-md);
            -webkit-font-smoothing: antialiased;
        }

        /* ── Header Section ─────────────────────────────────── */
        .header { 
            text-align: center; 
            margin-bottom: var(--spacing-md); 
            padding-bottom: var(--spacing-md);
            border-bottom: 2px dashed var(--color-border); 
        }
        .header-logo {
            font-size: 18px; 
            font-weight: 700; 
            margin-bottom: var(--spacing-xs);
            letter-spacing: -0.5px;
            color: var(--color-accent); /* 🔴 RED logo */
        }
        .header-store {
            font-size: 10px; 
            color: var(--color-text-dim);
            margin: 2px 0;
            font-weight: 500;
        }

        /* ── Transaction Info ───────────────────────────────── */
        .info { 
            margin: var(--spacing-sm) 0; 
            font-size: 10px;
            background: var(--color-bg);
            padding: var(--spacing-sm);
            border-radius: var(--radius-sm);
        }
        .info-row { 
            display: flex; 
            justify-content: space-between; 
            padding: var(--spacing-xs) 0;
            border-bottom: 1px dotted var(--color-border);
        }
        .info-row:last-child { border-bottom: none; }
        .info-label { color: var(--color-text-dim); font-weight: 500; }
        .info-value { font-weight: 600; text-align: right; }

        /* ── Items Section ──────────────────────────────────── */
        .items { 
            margin: var(--spacing-md) 0; 
            border-top: 2px dashed var(--color-border); 
            border-bottom: 2px dashed var(--color-border); 
            padding: var(--spacing-sm) 0; 
        }
        .items-header {
            display: flex;
            justify-content: space-between;
            font-size: 9px;
            font-weight: 600;
            color: var(--color-text-dim);
            padding: var(--spacing-xs) 0;
            margin-bottom: var(--spacing-xs);
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        .item { 
            display: flex; 
            justify-content: space-between; 
            padding: var(--spacing-xs) 0;
            align-items: flex-start;
        }
        .item-main { flex: 1; padding-right: var(--spacing-sm); }
        .item-name { 
            font-weight: 500; 
            margin-bottom: 2px;
            line-height: 1.3;
        }
        .item-meta {
            font-size: 9px;
            color: var(--color-text-dim);
            display: flex;
            gap: var(--spacing-xs);
        }
        .item-qty { 
            width: 36px; 
            text-align: center; 
            font-weight: 600;
            background: var(--color-accent-bg); /* 🔴 RED bg */
            color: var(--color-accent);
            padding: 2px 4px;
            border-radius: var(--radius-sm);
        }
        .item-price { 
            width: 75px; 
            text-align: right; 
            font-weight: 600;
            color: var(--color-accent); /* 🔴 RED price */
        }
        .item-subtotal {
            font-size: 10px;
            color: var(--color-text-dim);
            text-align: right;
            width: 75px;
        }

        /* ── Totals Section ─────────────────────────────────── */
        .totals { margin: var(--spacing-md) 0; }
        .total-row { 
            display: flex; 
            justify-content: space-between; 
            padding: var(--spacing-xs) 0;
            font-size: 10px;
        }
        .total-row.payment { color: var(--color-text-dim); }
        .total-row.grand { 
            font-weight: 700; 
            font-size: 13px; 
            border-top: 2px dashed var(--color-border); 
            padding-top: var(--spacing-sm); 
            margin-top: var(--spacing-sm); 
        }
        .total-label { color: var(--color-text-dim); }
        .total-value { font-weight: 600; }
        .total-value.grand { 
            color: var(--color-accent); /* 🔴 RED grand total */
            font-size: 14px;
        }

        /* ── Footer Section ─────────────────────────────────── */
        .footer { 
            text-align: center; 
            margin-top: var(--spacing-lg); 
            font-size: 10px; 
            border-top: 2px dashed var(--color-border); 
            padding-top: var(--spacing-md); 
        }
        .footer-thanks {
            font-weight: 700;
            font-size: 11px;
            margin-bottom: var(--spacing-xs);
            color: var(--color-accent); /* 🔴 RED thanks */
        }
        .footer-note {
            color: var(--color-text-dim);
            margin: 4px 0;
            line-height: 1.4;
        }
        .footer-printed {
            margin-top: var(--spacing-md);
            font-size: 9px;
            color: var(--color-text-dim);
            opacity: 0.8;
        }

        /* ── Print Button (Screen Only) - 🔴 RED ────────────── */
        .btn-print {
            display: block; 
            width: 100%; 
            padding: var(--spacing-md); 
            margin-top: var(--spacing-lg);
            background: var(--color-accent); /* 🔴 RED button */
            color: #fff; 
            border: none; 
            font-family: var(--font-receipt);
            font-size: 12px; 
            font-weight: 600; 
            cursor: pointer; 
            text-align: center;
            border-radius: var(--radius);
            transition: all 0.2s ease;
            box-shadow: 0 4px 12px rgba(255, 51, 102, 0.3); /* 🔴 RED shadow */
        }
        .btn-print:hover { 
            background: var(--color-accent-light); 
            transform: translateY(-1px);
            box-shadow: 0 6px 20px rgba(255, 51, 102, 0.4);
        }
        .btn-print:active { transform: translateY(0); }

        /* ── Print Optimization ─────────────────────────────── */
        @media print {
            body { 
                width: 100%; 
                margin: 0; 
                padding: 0; 
                font-size: 10px;
            }
            .btn-print { display: none !important; }
            @page { 
                margin: 0; 
                size: auto;
            }
            /* Force black & white for thermal printers */
            * { 
                -webkit-print-color-adjust: exact !important; 
                print-color-adjust: exact !important; 
            }
        }

        /* ── Screen Preview Enhancements ───────────────────── */
        @media screen {
            body {
                box-shadow: 0 0 0 1px var(--color-border), 0 8px 32px rgba(0,0,0,0.08);
                border-radius: var(--radius);
            }
        }

        /* ── Reduced Motion ───────────────────────────────── */
        @media (prefers-reduced-motion: reduce) {
            * { transition: none !important; animation: none !important; }
        }
    </style>
</head>
<body>
    <div id="receipt-content">
        <!-- Header -->
        <div class="header">
            <div class="header-logo">MIGU STORE</div>
            <p class="header-store">Jl. Fashion Modern No. 88, Jakarta</p>
            <p class="header-store">Telp: 0812-3456-7890</p>
        </div>

        <!-- Transaction Info -->
        <div class="info">
            <div class="info-row">
                <span class="info-label">No. Transaksi</span>
                <span class="info-value">#{{ str_pad($transaction->id ?? 0, 5, '0', STR_PAD_LEFT) }}</span>
            </div>
            <div class="info-row">
                <span class="info-label">Tanggal</span>
                <span class="info-value">{{ $transaction->created_at?->format('d/m/Y H:i') ?? now()->format('d/m/Y H:i') }}</span>
            </div>
            <div class="info-row">
                <span class="info-label">Kasir</span>
                <span class="info-value">{{ $transaction->user->name ?? 'Admin' }}</span>
            </div>
        </div>

        <!-- Items -->
        <div class="items">
            <div class="items-header">
                <span>Produk</span>
                <span style="width:36px;text-align:center">Qty</span>
                <span style="width:75px;text-align:right">Total</span>
            </div>
            
            @forelse($transaction->transactionItems ?? [] as $item)
            <div class="item">
                <div class="item-main">
                    <div class="item-name">{{ $item->product->name ?? 'Produk' }}</div>
                    <div class="item-meta">
                        <span>@{{ number_format($item->product->price ?? 0, 0, ',', '.') }}/pcs</span>
                    </div>
                </div>
                <span class="item-qty">{{ $item->qty ?? 1 }}x</span>
                <span class="item-price">{{ number_format($item->subtotal ?? 0, 0, ',', '.') }}</span>
            </div>
            @empty
            <div style="text-align:center;padding:1rem;color:var(--color-text-dim);">
                Tidak ada item
            </div>
            @endforelse
        </div>

        <!-- Totals -->
        <div class="totals">
            <div class="total-row">
                <span class="total-label">Subtotal</span>
                <span class="total-value">Rp {{ number_format($transaction->total_amount ?? 0, 0, ',', '.') }}</span>
            </div>
            <div class="total-row payment">
                <span class="total-label">Bayar ({{ strtoupper($transaction->payment_method ?? 'CASH') }})</span>
                <span class="total-value">Rp {{ number_format($transaction->payment_amount ?? $transaction->total_amount ?? 0, 0, ',', '.') }}</span>
            </div>
            <div class="total-row grand">
                <span class="total-label">KEMBALIAN</span>
                <span class="total-value grand">Rp {{ number_format($transaction->change_amount ?? 0, 0, ',', '.') }}</span>
            </div>
        </div>

        <!-- Footer -->
        <div class="footer">
            <p class="footer-thanks">*** TERIMA KASIH ***</p>
            <p class="footer-note">Barang yang sudah dibeli tidak dapat ditukar/dikembalikan</p>
            <p class="footer-printed">Dicetak: {{ now()->format('d/m/Y H:i:s') }}</p>
        </div>
    </div>

    <!-- Print Button (Hidden When Printing) -->
    <button type="button" class="btn-print" onclick="window.print()">
        🖨️ CETAK STRUK
    </button>

    <script>
        // Auto print dengan delay untuk memastikan halaman render sempurna
        window.addEventListener('load', function() {
            // Cek jika bukan mode print, tunda sebentar lalu print
            try {
                if (window.matchMedia && window.matchMedia('print').matches === false) {
                    setTimeout(() => {
                        // Optional: auto-print bisa di-comment jika ingin manual
                        // window.print();
                    }, 500);
                }
            } catch (e) {
                console.log('Print detection unavailable:', e);
            }
        });

        // Keyboard shortcut: Ctrl+P atau Cmd+P
        document.addEventListener('keydown', function(e) {
            if ((e.ctrlKey || e.metaKey) && e.key.toLowerCase() === 'p') {
                e.preventDefault();
                window.print();
            }
        });

        // Prevent double-print on some browsers
        let printed = false;
        window.onbeforeprint = function() {
            if (printed) return;
            printed = true;
        };
    </script>
</body>
</html>