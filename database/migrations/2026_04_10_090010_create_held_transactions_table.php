<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('held_transactions', function (Blueprint $table) {
    $table->id();
    $table->foreignId('user_id')->constrained()->onDelete('cascade');
    $table->json('cart_data'); // Array of cart items with full product info
    $table->decimal('total_amount', 15, 2);
    $table->text('notes')->nullable();
    $table->timestamp('expires_at')->index(); // Auto-cleanup old holds
    $table->timestamps();
});
    }
    public function down(): void { Schema::dropIfExists('held_transactions'); }
};