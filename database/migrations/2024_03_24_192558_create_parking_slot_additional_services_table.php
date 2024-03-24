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
        Schema::create('parking_slot_additional_services', function (Blueprint $table) {
            $table->id();
            $table->integer('parking_slot_id');
            $table->integer('additional_service_id');
            $table->timestamps();

            $table->foreign('parking_slot_id')->references('id')->on('parking_slots');
            $table->foreign('additional_service_id')->references('id')->on('parking_additional_services');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('parking_slot_additional_services');
    }
};
