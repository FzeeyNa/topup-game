<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->string('invoice_number')->unique();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('product_id')->constrained()->onDelete('restrict');
            // Game Account Info
            $table->string('game_id_field'); // ID/Username game player
            $table->string('game_server')->nullable(); // Server game (jika ada)
            $table->string('game_username')->nullable(); // Username/nickname
            // Pricing
            $table->decimal('product_price', 15, 2);
            $table->decimal('admin_fee', 15, 2)->default(0);
            $table->decimal('total_amount', 15, 2);      
            // Payment
            $table->string('payment_method')->nullable();
            $table->string('payment_channel')->nullable(); // e.g., "bca_va", "gopay"
            $table->enum('payment_status', ['pending', 'paid', 'failed', 'expired'])->default('pending');
            $table->string('payment_url')->nullable();
            $table->string('external_id')->nullable(); // Midtrans/Xendit transaction ID
            $table->timestamp('paid_at')->nullable();            
            // Order Status
            $table->enum('status', ['pending', 'processing', 'completed', 'failed', 'refunded'])->default('pending');
            $table->text('notes')->nullable();         
            // API Integration
            $table->string('api_provider')->nullable(); // Provider API (DigiFlazz, VIP Reseller, etc)
            $table->string('api_trx_id')->nullable(); // Transaction ID dari provider
            $table->text('api_response')->nullable();
            $table->timestamp('processed_at')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
