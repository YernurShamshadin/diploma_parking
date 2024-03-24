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
        Schema::create('parking_prices', function (Blueprint $table) {
            $table->id();
            $table->integer('cost');
            $table->integer('type_id');
            $table->integer('parking_id');
            $table->timestamps();

            $table->foreign('parking_id')->references('id')->on('parkings');
            $table->foreign('type_id')->references('id')->on('price_types');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('parking_prices');
    }
};
