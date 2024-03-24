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
        Schema::create('parking_floors', function (Blueprint $table) {
            $table->id();
            $table->integer('floor_number');
            $table->integer('capacity');
            $table->integer('parking_id');
            $table->timestamps();

            $table->foreign('parking_id')->references('id')->on('parkings');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('parking_floors');
    }
};
