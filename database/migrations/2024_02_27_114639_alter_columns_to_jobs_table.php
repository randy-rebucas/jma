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
        Schema::table('jobs', function (Blueprint $table) {
            $table->dropColumn(['type', 'scope_of_works', 'total_amount']);

            $table->dropForeign('jobs_sale_id_foreign');
            $table->dropColumn('sale_id');

            $table->enum('job_type', ['order', 'estimate'])->default('order');
            $table->uuid('serial');
            $table->foreignId('customer_id')->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('user_id')->constrained()->cascadeOnUpdate()->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('jobs', function (Blueprint $table) {
            $table->enum('type', ['order', 'estimate'])->default('order');
            $table->foreignId('sale_id')->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->json('scope_of_works');
            $table->double('total_amount', 8, 2)->default(0);

            $table->dropColumn(['job_type', 'serial']);
            $table->dropForeign('jobs_customer_id_foreign');
            $table->dropColumn('customer_id');
            $table->dropForeign('jobs_user_id_foreign');
            $table->dropColumn('user_id');
        });
    }
};
