<?php
require 'vendor/autoload.php';
$app = require 'bootstrap/app.php';

use App\Models\Setting;

// Boot the application
$app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();

$qrisPath = Setting::where('key', 'qris_image')->first()?->value;
echo "=== QRIS PATH TEST ===\n";
echo "Raw path: {$qrisPath}\n";
if ($qrisPath) {
    echo "With asset: " . asset('storage/' . $qrisPath) . "\n";
    echo "With imageUrl: " . app('App\Http\Controllers\Controller')->call(function() use ($qrisPath) {
        return imageUrl($qrisPath);
    }) . "\n";
}
?>
