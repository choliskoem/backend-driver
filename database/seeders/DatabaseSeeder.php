<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Ramsey\Uuid\Uuid;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();
        $b = Str::uuid();
        $c = Str::uuid();
        \App\Models\qrcode::factory()->create([
            'id' => $b,
        ]);

        $a = Str::uuid();

        // \App\Models\biodata::factory()->create([
        //     'id' => $a,
        //     'no_hp' => '08123456789',
        //     'image' => 'https://picsum.photos/200/300',
        // ]);

        \App\Models\User::factory()->create([
            //id_user is uuid
            'id' => Str::uuid(),
            'name' => 'Admin Holis',

            'roles' => 'Admin',
            'image' => 'https://picsum.photos/200/300',
            'no_hp' => '08123456789',
            'password' => Hash::make('123456789'),

        ]);

        \App\Models\User::factory()->create([
            //id_user is uuid
            'id' => $c,
            'name' => 'Driver Ojol',
            'roles' => 'Driver',
            'image' => 'https://picsum.photos/200/300',
            'no_hp' => '03123131311',
            'password' => Hash::make('123456789'),

        ]);

        // \App\Models\qrcode::factory()->create([

        //     'id' => $b,


        // ]);
    }
}
