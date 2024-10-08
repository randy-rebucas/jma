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
        Schema::table('items', function (Blueprint $table) {
            $table->dropColumn(['slug', 'code', 'item_number', 'cost_price', 'unit_price', 'product_image']);

            $table->double('price', 8, 2)->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('items', function (Blueprint $table) {
            $table->string('slug');
            $table->string('code')->unique()->nullable();
            $table->string('item_number');
            $table->double('cost_price', 8, 2)->default(0);
            $table->double('unit_price', 8, 2)->default(0);
            $table->string('product_image')->nullable();

            $table->dropColumn(['price']);
        });
    }
};
