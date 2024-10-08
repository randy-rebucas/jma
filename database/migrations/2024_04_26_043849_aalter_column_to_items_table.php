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
            $table->dropColumn(['price']);

            $table->double('cost_price', 8, 2)->default(0);
            $table->double('unit_price', 8, 2)->default(0);
            $table->string('part_number')->unique()->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('items', function (Blueprint $table) {
            $table->dropColumn(['cost_price', 'unit_price', 'part_number']);

            $table->double('price', 8, 2)->default(0);
        });
    }
};
