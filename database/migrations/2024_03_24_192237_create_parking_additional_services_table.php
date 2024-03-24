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
        Schema::create('parking_additional_services', function (Blueprint $table) {
            $table->id();
            $table->integer('parking_id');
            $table->string('title');
            $table->string('description');
            $table->integer('price_id');
            $table->timestamps();

            $table->foreign('parking_id')->references('id')->on('parkings');
            $table->foreign('price_id')->references('id')->on('parking_prices');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('parking_additional_services');
    }
};
