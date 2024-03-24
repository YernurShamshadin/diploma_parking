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
        Schema::table('parking_bookings', function(Blueprint $table) {
            $table->renameColumn('customer_auto_number', 'user_vehicle_id');

            $table->foreign('user_vehicle_id')->references('id')->on('user_vehicles');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('parking_bookings', function(Blueprint $table) {
            $table->dropForeign(['user_vehicle_id']);

            $table->renameColumn('user_vehicle_id', 'customer_auto_number');
        });
    }
};
