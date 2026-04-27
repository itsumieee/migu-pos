<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\PngWriter;
use Illuminate\Support\Facades\Storage;

class GenerateQrisQr extends Command
{
    protected $signature = 'qris:generate {data : QRIS data/URL}';
    protected $description = 'Generate QRIS QR Code';

    public function handle()
    {
        $data = $this->argument('data');
        
        try {
            // Generate QR Code
            $qrCode = QrCode::create($data)
                ->setSize(300)
                ->setMargin(10);

            $writer = new PngWriter();
            $result = $writer->write($qrCode);
            
            // Save to storage
            $filename = 'qris/qris-' . time() . '.png';
            Storage::disk('public')->put($filename, $result->getString());
            
            // Update settings
            \App\Models\Setting::updateOrCreate(
                ['key' => 'qris_image'],
                ['value' => $filename]
            );
            
            $this->info("✅ QRIS QR Code generated: {$filename}");
            $this->info("Direct URL: " . asset('storage/' . $filename));
            
        } catch (\Exception $e) {
            $this->error("❌ Error: " . $e->getMessage());
        }
    }
}
