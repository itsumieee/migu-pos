<?php
require 'vendor/autoload.php';
$app = require 'bootstrap/app.php';

use App\Models\Product;
use App\Models\Category;

// Boot the application
$app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();

echo "=== DATABASE STATUS ===\n";
echo "Total Products: " . Product::count() . "\n";
echo "Total Categories: " . Category::count() . "\n";
echo "Products with stock > 0: " . Product::where('stock', '>', 0)->count() . "\n";
echo "\n=== PRODUCTS WITH COST_PRICE ===\n";
$products = Product::take(5)->get();
foreach ($products as $p) {
    echo "- {$p->name}: price={$p->price}, cost_price={$p->cost_price}, stock={$p->stock}\n";
}
