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
        Schema::create('grn_pays', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('grn_id')->nullable();
            $table->date('grn_date')->nullable();
            $table->unsignedBigInteger('supplier_id')->nullable();
            $table->decimal('sub_total', 15, 2)->nullable();
            $table->decimal('discount_amount', 15, 2)->nullable();
            $table->decimal('previous_balance_forward', 15, 2)->nullable();
            $table->decimal('to_pay', 15, 2)->nullable();
            $table->decimal('paid_amount', 15, 2)->nullable();
            $table->decimal('new_balance', 15, 2)->nullable();
            $table->text('memo')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('grn_pays');
    }
};
