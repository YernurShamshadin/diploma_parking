<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VehicleTypeSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        DB::table('vehicle_types')->insert([
            ['title' => 'Car'],
            ['title' => 'Motorcycle'],
            ['title' => 'Electrocar'],
        ]);
    }
}
