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
        Schema::create('stocks', function (Blueprint $table) {
            $table->id();
            $table->string('stock_name')->nullable();
            $table->unsignedBigInteger('grn_item_id')->nullable();
            $table->double('input_qty')->nullable();
            $table->double('output_qty')->nullable();
            $table->double('wastage_qty')->nullable();
            $table->dateTime('update_time')->nullable();
            $table->boolean('is_stock_closed')->default(0);
            $table->timestamps();

        // 'stock_name',
        // 'grn_item_id',
        // 'input_qty',
        // 'output_qty',
        // 'wastage_qty',
        // 'update_time',
        // 'is_stock_closed',
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stocks');
    }
};
