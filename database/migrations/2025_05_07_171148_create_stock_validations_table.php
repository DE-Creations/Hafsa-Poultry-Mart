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
        Schema::create('stock_validations', function (Blueprint $table) {
            $table->id();
            $table->date('date')->nullable();
            $table->dateTime('date_added')->nullable();
            $table->unsignedBigInteger('input_item_id')->nullable();
            $table->integer('qty')->nullable();
            $table->timestamps();
            
        // 'date',
        // 'date_added',
        // 'input_item_id',
        // 'qty',
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stock_validations');
    }
};
