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
        Schema::create('parking_slots', function (Blueprint $table) {
            $table->id();
            $table->integer('slot_number');
            $table->string('group_code')->nullable();
            $table->integer('floor_id');
            $table->integer('parking_id');
            $table->timestamps();

            $table->foreign('floor_id')->references('id')->on('parking_floors');
            $table->foreign('parking_id')->references('id')->on('parkings');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('parking_slots');
    }
};
