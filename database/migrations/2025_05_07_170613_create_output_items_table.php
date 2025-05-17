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
        Schema::create('output_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('input_item_id')->nullable();
            $table->string('name')->nullable();
            $table->text('description')->nullable();
            $table->double('avg_presentage')->nullable();
            $table->timestamps();

        // 'input_item_id',
        // 'name',
        // 'description',
        // 'avg_presentage',
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('output_items');
    }
};
