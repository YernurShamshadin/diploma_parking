<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DoorTypeSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        DB::table('door_types')->insert([
            ['title' => 'Indoor'],
            ['title' => 'Outdoor'],
        ]);
    }
}
