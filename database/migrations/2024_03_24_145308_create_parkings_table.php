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
        Schema::create('parkings', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('calling_phone');
            $table->integer('capacity');
            $table->integer('floor_number');
            $table->boolean('available_disabled_people');
            $table->boolean('available_electric_charger');
            $table->integer('status_id');
            $table->integer('address_id');
            $table->boolean('has_additional_services');
            $table->timestamps();

            $table->foreign('address_id')->references('id')->on('addresses');
            $table->foreign('status_id')->references('id')->on('parking_statuses');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('parkings');
    }
};
