<?php
require 'vendor/autoload.php';
$app = require 'bootstrap/app.php';

use App\Models\Product;

// Boot the application
$app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();

echo "=== PRODUK YANG DITAMPILKAN DI POS (ORDER BY ID) ===\n";
$pos_products = Product::with('category')
    ->where('stock', '>', 0)
    ->orderBy('id')
    ->limit(20)
    ->get();
echo "Total: " . $pos_products->count() . "\n";
foreach ($pos_products as $p) {
    echo "  - ID:{$p->id} {$p->name} ({$p->category->name}): stok={$p->stock}\n";
}
