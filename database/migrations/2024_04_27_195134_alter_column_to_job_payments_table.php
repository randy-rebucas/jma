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
        Schema::table('job_payments', function (Blueprint $table) {
            $table->dropColumn(['payment_amount']);

            $table->double('tendered_amount', 8, 2)->default(0);
            $table->double('change', 8, 2)->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('job_payments', function (Blueprint $table) {
            $table->dropColumn(['tendered_amount', 'change']);

            $table->double('payment_amount', 8, 2)->default(0);
        });
    }
};
