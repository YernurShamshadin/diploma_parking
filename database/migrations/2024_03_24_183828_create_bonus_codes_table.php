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
        Schema::create('bonus_codes', function (Blueprint $table) {
            $table->id();
            $table->integer('bonus_id');
            $table->string('code');
            $table->timestamps();

            $table->foreign('bonus_id')->references('id')->on('bonuses');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bonus_codes');
    }
};
