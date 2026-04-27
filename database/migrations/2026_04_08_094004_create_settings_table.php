<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('key')->unique();
            $table->text('value')->nullable();
            $table->timestamps();
        });

        // Insert default settings
        DB::table('settings')->insert([
            ['key' => 'store_name', 'value' => 'Migu POS'],
            ['key' => 'store_address', 'value' => 'Jl. Contoh No. 123, Kota'],
            ['key' => 'store_phone', 'value' => '08123456789'],
            ['key' => 'store_email', 'value' => 'info@migupos.com'],
            ['key' => 'tax_rate', 'value' => '0'],
        ]);
    }

    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};