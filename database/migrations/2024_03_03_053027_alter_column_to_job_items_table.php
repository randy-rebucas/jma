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
        Schema::table('job_items', function (Blueprint $table) {
            $table->dropColumn(['total_amount', 'items']);

            $table->integer('quantity');
            $table->double('unit_price', 10, 2)->default(0);
            $table->double('sub_total', 10, 2)->default(0);

            $table->foreignId('item_id')->constrained()->cascadeOnUpdate()->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('job_items', function (Blueprint $table) {
            $table->double('total_amount', 12, 2)->default(0);
            $table->json('items');

            $table->dropColumn(['quantity', 'unit_price', 'sub_total']);

            $table->dropForeign('job_items_item_id_foreign');
            $table->dropColumn('item_id');
        });
    }
};
