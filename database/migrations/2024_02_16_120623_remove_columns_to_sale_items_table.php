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
        Schema::table('sale_items', function (Blueprint $table) {
            $table->json('items');

            $table->dropColumn([
                'description',
                'serial_number',
                'quantity_purchased',
                'cost_price',
                'unit_price',
                'discount',
                'print_option'
            ]);

            $table->dropForeign('sale_items_item_id_foreign');
            $table->dropColumn('item_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('sale_items', function (Blueprint $table) {
            $table->dropColumn(['items']);

            $table->text('description');
            $table->string('serial_number');
            $table->integer('quantity_purchased')->default(0);
            $table->double('cost_price', 8, 2)->default(0);
            $table->double('unit_price', 8, 2)->default(0);
            $table->double('discount', 8, 2)->default(0);
            $table->integer('print_option')->nullable();

            $table->foreignId('item_id')->constrained()->cascadeOnUpdate()->cascadeOnDelete();
        });
    }
};
