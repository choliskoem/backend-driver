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

        // \App\Models\User::factory()->create([
        //     //id_user is uuid
        //     'id_akun' => Str::uuid(),
        //     'name' => 'Admin Holis',

        //     'id_level' => '1',
        //     'id_type_fb' => '0',
        //     'id_type_ig' => '0',
        //     'foto_fb' => 'https://picsum.photos/200/300',
        //     'foto_ig' => 'https://picsum.photos/200/300',
        //     'username' => '0821',
        //     'status' => 'Aktif',
        //     'password' => Hash::make('123456789'),

        // ]);

        // \App\Models\User::factory()->create([
        //     //id_user is uuid
        //     'id' => $c,
        //     'name' => 'Driver Ojol',
        //     'roles' => 'Driver',
        //     'image' => 'https://picsum.photos/200/300',
        //     'foto' => 'https://picsum.photos/200/300',
        //     'no_hp' => '03123131311',
        //     'plat_no' => 'B 1235 C',
        //     'password' => Hash::make('123456789'),

        // ]);

        \App\Models\Level::factory()->create([

            'id_level' => '1',
            'level' => 'Admin',


        ]);
        \App\Models\Level::factory()->create([

            'id_level' => '2',
            'level' => 'User',


        ]);

        \App\Models\Type::factory()->create([

            'id_type' => '0',
            'type' => '0',


        ]);


        \App\Models\Type::factory()->create([

            'id_type' => '1',
            'type' => 'Facebook',


        ]);

        \App\Models\Type::factory()->create([

            'id_type' => '2',
            'type' => 'Instagram',


        ]);


        \App\Models\User::factory()->create([
            //id_user is uuid
            'id_akun' => Str::uuid(),
            'name' => 'Admin Holis',

            'id_level' => '1',
            'id_type_fb' => '0',
            'id_type_ig' => '0',
            'foto_fb' => 'https://picsum.photos/200/300',
            'foto_ig' => 'https://picsum.photos/200/300',
            'username' => '0821',
            'status' => 'Aktif',
            'password' => Hash::make('123456789'),

        ]);

        // $this->call([
        //     LevelSeeder::class,
        //     TypeSeeder::class,
        // ]);
    }
}
