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
        Schema::create('invoice_payments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('invoice_id')->nullable();
            $table->unsignedBigInteger('customer_id')->nullable();
            $table->decimal('balance', 15, 2)->nullable();
            $table->decimal('paid_amount', 15, 2)->nullable();
            $table->decimal('invoice_total', 15, 2)->nullable();
            $table->text('memo')->nullable();
            $table->date('paid_date')->nullable();
            $table->dateTime('date_added')->nullable();
            $table->unsignedBigInteger('payment_method')->nullable();
            $table->unsignedBigInteger('bank_acc_id')->nullable();
            $table->timestamps();

            // 'invoice_id',
            // 'balance_forward',
            // 'paid',
            // 'memo',
            // 'paid_date',
            // 'date_added',
            // 'payment_method',
            // 'bank_acc_id'
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoice_payments');
    }
};
