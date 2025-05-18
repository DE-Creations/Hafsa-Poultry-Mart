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
        Schema::create('grn_items', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('grn_id')->nullable();
            $table->unsignedBigInteger('input_item_id')->nullable();
            $table->string('description')->nullable();
            $table->integer('qty')->nullable();
            $table->decimal('rate', 15, 2)->nullable();
            $table->decimal('amount', 15, 2)->nullable();
            $table->decimal('discount',15,2)->nullable();
            $table->decimal('total', 15, 2)->nullable();

        //             'grn_id',
        // 'input_item_id',
        // 'description',
        // 'qty',
        // 'rate',
        // 'amount',
        // 'discount',
        // 'total',

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('grn_items');
    }
};
