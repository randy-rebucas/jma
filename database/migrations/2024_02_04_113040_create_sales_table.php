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
        Schema::create('sales', function (Blueprint $table) {
            $table->id();
            $table->text('comment');
            $table->string('invoice_number');
            $table->tinyInteger('sale_status');
            $table->tinyInteger('sale_type');
            // this is for the current logged user [employee]
            $table->foreignId('user_id')->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            // this for the customer
            $table->foreignId('customer_id')->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sales');
    }
};
