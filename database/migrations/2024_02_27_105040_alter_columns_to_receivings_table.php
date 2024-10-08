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
        Schema::table('receivings', function (Blueprint $table) {
            $table->enum('receiving_type', ['receive', 'return'])->default('receive');
            $table->uuid('serial');
            $table->foreignId('supplier_id')->constrained()->cascadeOnUpdate()->cascadeOnDelete();

            $table->dropColumn(['payment_type', 'reference', 'comment']);
            $table->dropForeign('receivings_customer_id_foreign');
            $table->dropColumn('customer_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('receivings', function (Blueprint $table) {
            $table->dropColumn(['receiving_type', 'serial']);
            $table->dropForeign('receivings_supplier_id_foreign');
            $table->dropColumn('supplier_id');

            $table->string('payment_type');
            $table->string('reference');
            $table->text('comment');
            $table->foreignId('customer_id')->constrained()->cascadeOnUpdate()->cascadeOnDelete();
        });
    }
};
