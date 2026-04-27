<?php
require 'vendor/autoload.php';
$app = require 'bootstrap/app.php';

use App\Models\Product;
use App\Models\Category;

// Boot the application
$app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();

echo "=== PRODUK PER KATEGORI ===\n";
$categories = Category::withCount('products')->get();
foreach ($categories as $cat) {
    echo "\n{$cat->name} (ID: {$cat->id}, Total: {$cat->products_count})\n";
    $products = Product::where('category_id', $cat->id)->take(3)->get();
    foreach ($products as $p) {
        echo "  - {$p->name}: stock={$p->stock}\n";
    }
}

echo "\n\n=== PRODUK YANG DITAMPILKAN DI POS (Stok > 0) ===\n";
$pos_products = Product::with('category')
    ->where('stock', '>', 0)
    ->orderBy('name')
    ->limit(20)
    ->get();
echo "Total: " . $pos_products->count() . "\n";
foreach ($pos_products as $p) {
    echo "  - {$p->name} ({$p->category->name}): stok={$p->stock}\n";
}
