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
        Schema::table('receiving_items', function (Blueprint $table) {
            $table->dropColumn(['quantity_purchased', 'cost_price', 'unit_price', 'discount', 'receiving_quantity']);

            $table->dropForeign('receiving_items_item_id_foreign');
            $table->dropColumn('item_id');

            $table->double('total_amount', 12, 2)->default(0);
            $table->json('items');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('receiving_items', function (Blueprint $table) {
            $table->dropColumn(['total_amount', 'items']);

            $table->integer('quantity_purchased')->default(0);
            $table->double('cost_price', 8, 2)->default(0);
            $table->double('unit_price', 8, 2)->default(0);
            $table->double('discount', 8, 2)->default(0);
            $table->integer('receiving_quantity')->nullable();
            $table->foreignId('item_id')->constrained()->cascadeOnUpdate()->cascadeOnDelete();
        });
    }
};
