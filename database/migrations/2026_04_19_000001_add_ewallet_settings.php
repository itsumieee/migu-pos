<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Add e-wallet settings if they don't exist
        $settings = [
            ['key' => 'ewallet_dana_number', 'value' => '081234567890'],
            ['key' => 'ewallet_dana_description', 'value' => 'Transfer ke nomor di atas'],
            ['key' => 'ewallet_gopay_number', 'value' => '081234567890'],
            ['key' => 'ewallet_gopay_description', 'value' => 'Scan barcode atau input nomor di atas'],
            ['key' => 'ewallet_ovo_number', 'value' => '081234567890'],
            ['key' => 'ewallet_ovo_description', 'value' => 'Gunakan fitur Send Money'],
            ['key' => 'ewallet_shopeepay_number', 'value' => '081234567890'],
            ['key' => 'ewallet_shopeepay_description', 'value' => 'Tap untuk pembayaran'],
        ];

        foreach ($settings as $setting) {
            \App\Models\Setting::updateOrCreate(['key' => $setting['key']], $setting);
        }
    }

    public function down(): void
    {
        $keys = [
            'ewallet_dana_number',
            'ewallet_dana_description',
            'ewallet_gopay_number',
            'ewallet_gopay_description',
            'ewallet_ovo_number',
            'ewallet_ovo_description',
            'ewallet_shopeepay_number',
            'ewallet_shopeepay_description',
        ];

        \App\Models\Setting::whereIn('key', $keys)->delete();
    }
};
