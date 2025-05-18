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
            $table->decimal('balance_foward' ,15,2)->nullable();
            $table->decimal('paid' ,15,2)->nullable();          
            $table->text('memo')->nullable();
            $table->date('paid_date')->nullable();
            $table->dateTime('date_added')->nullable();
            $table->unsignedBigInteger('payment_method_id')->nullable();
            $table->unsignedBigInteger('bank_acc_id')->nullable();
            
        // 'grn_id',
        // 'balance-foward',
        // 'paid',
        // 'memo',
        // 'paid_date',
        // 'date_added',
        // 'payment_method_id',
        // 'bank_acc_id',

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
