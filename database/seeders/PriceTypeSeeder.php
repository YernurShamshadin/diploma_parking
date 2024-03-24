<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PriceTypeSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        DB::table('price_types')->insert([
            ['title' => 'regular_by_hour'],
            ['title' => 'electric_by_hour'],
            ['title' => 'regular_by_day'],
            ['title' => 'washing_mirror'],
            ['title' => 'washing_wheels'],
        ]);
    }
}
