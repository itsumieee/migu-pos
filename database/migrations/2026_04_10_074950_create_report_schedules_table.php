<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('report_schedules', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // e.g., "Presentasi Siang"
            $table->enum('type', ['interval', 'fixed'])->default('interval');
            $table->string('value')->nullable(); // menit (interval) atau HH:MM (fixed)
            $table->string('phone_override')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamp('last_sent_at')->nullable();
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('report_schedules'); }
};