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
        Schema::create('parking_bookings', function (Blueprint $table) {
            $table->id();
            $table->integer('parking_slot_id');
            $table->integer('user_id');
            $table->integer('customer_auto_number');
            $table->timestamp('in_date');
            $table->timestamp('out_date');
            $table->timestamps();

            $table->foreign('parking_slot_id')->references('id')->on('parking_slots');
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('parking_bookings');
    }
};
