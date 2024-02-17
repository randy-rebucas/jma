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
        Schema::table('inventories', function (Blueprint $table) {
            // drop fields
            $table->dropColumn(['comment', 'type', 'amount']);
            $table->dropForeign('inventories_item_id_foreign');
            $table->dropColumn('item_id');
            $table->dropForeign('inventories_customer_id_foreign');
            $table->dropColumn('customer_id');
 
            // new fields
            $table->enum('transaction_type', ['sales', 'return', 'receive'])->default('sales');
            $table->double('transaction_total_amount', 8, 2)->default(0);
            
            $table->foreignId('user_id')->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->uuid('transaction_code');
            $table->double('transaction_paid_amount', 8, 2)->default(0);
            $table->enum('transaction_payment_method', ['cash', 'credit'])->default('cash');
            $table->json('items');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('inventories', function (Blueprint $table) {

            // drop fields
            $table->dropColumn(['items', 'transaction_paid_amount', 'transaction_payment_method', 'transaction_code', 'transaction_type', 'transaction_total_amount']);
            $table->dropForeign('inventories_user_id_foreign');
            $table->dropColumn('user_id');

            // revert columns
            $table->string('comment')->nullable();
            $table->enum('type', ['sale', 'return']);
            $table->double('amount', 8, 2)->default(0);
            $table->foreignId('customer_id')->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('item_id')->constrained()->cascadeOnUpdate()->cascadeOnDelete();
        });
    }
};
