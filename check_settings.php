<?php
require 'vendor/autoload.php';
$app = require 'bootstrap/app.php';

use App\Models\Setting;

// Boot the application
$app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();

echo "=== SETTINGS YANG ADA ===\n";
$settings = Setting::all();
foreach ($settings as $s) {
    echo "- {$s->key}: " . substr($s->value, 0, 50) . "\n";
}

echo "\n=== CEK QRIS IMAGE ===\n";
$qris = Setting::where('key', 'qris_image')->first();
if ($qris) {
    echo "QRIS Image: {$qris->value}\n";
} else {
    echo "QRIS Image: TIDAK ADA\n";
}
