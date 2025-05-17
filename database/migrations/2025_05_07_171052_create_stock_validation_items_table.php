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
        Schema::create('stock_validation_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('stock_validation_id')->nullable();
            $table->unsignedBigInteger('output_item_id')->nullable();
            $table->integer('qty')->nullable();
            $table->timestamps();

        // 'stock_validation_id',
        // 'output_item_id',
        // 'qty',
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stock_validation_items');
    }
};
