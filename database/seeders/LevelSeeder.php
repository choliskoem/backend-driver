<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        DB::table('t_level')->insert([
            ['level' => 'Admin'],
            ['level' => 'User'],
            // ['level' => 'Guest'],
        ]);
    }
}
