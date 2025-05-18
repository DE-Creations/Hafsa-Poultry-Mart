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
        Schema::create('suppliers', function (Blueprint $table) {
            $table->id();

            $table->string('name')->nullable();
            $table->string('nick_name')->nullable();
            $table->string('mobile')->nullable();
            $table->string('address')->nullable();
            $table->text('note')->nullable();
            $table->date('date_registered')->nullable();

            $table->timestamps();

        // 'name',
        // 'nick_name',
        // 'mobile',
        // 'address',
        // 'note',
        // 'date_registered',
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('suppliers');
    }
};
