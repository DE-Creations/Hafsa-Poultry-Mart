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
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->string('invoice_number')->nullable();
            $table->date('date')->nullable();
            $table->unsignedBigInteger('customer_id')->nullable();
            $table->text('delivery_address')->nullable();
            $table->double('subtotal')->nullable();
            $table->double('discount')->nullable();
            $table->double('total')->nullable();
            $table->boolean('is_paid')->default(0);
            $table->timestamps();

        // 'invoice_number',
        // 'date',
        // 'customer_id',
        // 'delivery_address',
        // 'subtotal',
        // 'discount',
        // 'total',
        // 'is_paid',
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
};
