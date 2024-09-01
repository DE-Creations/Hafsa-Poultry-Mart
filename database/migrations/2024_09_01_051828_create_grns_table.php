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
        Schema::create('grns', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('supplier_id')->nullable();
            $table->string('serial')->nullable();
            $table->date('date')->nullable();
            $table->string('memo')->nullable();
            $table->decimal('discount_rate', 15, 2);
            $table->decimal('discount_amount', 15, 2);
            $table->decimal('total', 15, 2);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('grns');
    }
};
