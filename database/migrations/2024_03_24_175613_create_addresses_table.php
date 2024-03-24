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
        Schema::create('addresses', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->float('x_coordinate');
            $table->float('y_coordinate');
            $table->integer('floor_number')->nullable();
            $table->integer('door_type_id')->nullable();
            $table->timestamps();

            $table->foreign('door_type_id')->references('id')->on('door_types');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('addresses');
    }
};
