<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->foreignId('api_provider_id')->nullable()->after('game_id')->constrained()->onDelete('set null');
            $table->string('provider_product_code')->nullable()->after('sku'); // Kode produk di provider
        });
    }

    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropForeign(['api_provider_id']);
            $table->dropColumn(['api_provider_id', 'provider_product_code']);
        });
    }
};