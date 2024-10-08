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
        Schema::table('sales', function (Blueprint $table) {
            $table->dropColumn(['comment', 'invoice_number']);
            $table->enum('sale_status', ['paid', 'unpaid'])->default('unpaid')->change();
            $table->enum('sale_type', ['sales', 'return'])->default('sales')->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('sales', function (Blueprint $table) {
            $table->text('comment');
            $table->string('invoice_number');
            $table->tinyInteger('sale_status'); // paid/unpaid
            $table->tinyInteger('sale_type'); // sales/return
        });
    }
};
