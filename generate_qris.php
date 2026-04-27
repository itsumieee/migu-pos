<?php
require 'vendor/autoload.php';
$app = require 'bootstrap/app.php';

use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\PngWriter;
use Illuminate\Support\Facades\Storage;
use App\Models\Setting;

// Boot the application
$app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();

// Sample QRIS data (format standard QRIS - Indonesian e-payment)
// Replace this with actual QRIS data from your merchant
$qrisData = "00020101021226670014ID.CO.UPI.WWW00151234567890123456789520400005303360406010505070005241502500004D0410A540D00000000000000000000000063043A60";

try {
    // Generate QR Code dengan API yang benar
    $qrCode = new QrCode($qrisData);

    $writer = new PngWriter();
    $result = $writer->write($qrCode);
    
    // Ensure directory exists
    @mkdir(storage_path('app/public/qris'), 0755, true);
    
    // Save to storage
    $filename = 'qris/qris-' . time() . '.png';
    Storage::disk('public')->put($filename, $result->getString());
    
    // Update settings
    Setting::updateOrCreate(
        ['key' => 'qris_image'],
        ['value' => $filename]
    );
    
    echo "✅ QRIS QR Code generated successfully!\n";
    echo "File: {$filename}\n";
    echo "URL: " . asset('storage/' . $filename) . "\n";
    echo "Full path: " . storage_path('app/public/' . $filename) . "\n";
    
} catch (\Exception $e) {
    echo "❌ Error: " . $e->getMessage() . "\n";
    echo $e->getTraceAsString();
}
