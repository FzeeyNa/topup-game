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
        Schema::create('api_providers', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // DigiFlazz, VIP Reseller, etc
            $table->string('slug')->unique();
            $table->string('api_url');
            $table->string('api_key')->nullable();
            $table->string('api_secret')->nullable();
            $table->text('config')->nullable(); // JSON config
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('api_providers');
    }
};
