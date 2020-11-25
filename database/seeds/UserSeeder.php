<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'username' => 'admin',
                'role' => 'admin',
                'email' => 'admin@phizzahut.com',
                'password' => bcrypt('123456'),
                'address' => 'Phizza Hut',
                'phoneNumber' => '0218465780',
                'gender' => 'male',
                'remember_token' => Str::random(50)
            ],
            [
                'username' => 'stefanadisurya',
                'role' => 'member',
                'email' => 'stefan@gmail.com',
                'password' => bcrypt('123456'),
                'address' => 'Jalan Jalan-Jalan',
                'phoneNumber' => '081725192242',
                'gender' => 'male',
                'remember_token' => Str::random(50)
            ]
        ]);
    }
}
