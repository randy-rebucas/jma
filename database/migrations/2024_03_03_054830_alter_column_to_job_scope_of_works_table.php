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
        Schema::table('job_scope_of_works', function (Blueprint $table) {
            $table->dropColumn(['total_amount', 'scopes']);

            $table->text('name');
            $table->integer('quantity');
            $table->double('unit_price', 10, 2)->default(0);
            $table->double('sub_total', 10, 2)->default(0);

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('job_scope_of_works', function (Blueprint $table) {
            $table->double('total_amount', 12, 2)->default(0);
            $table->json('scopes');

            $table->dropColumn(['name', 'quantity', 'unit_price', 'sub_total']);
        });
    }
};
