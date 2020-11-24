<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

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
                'role_id' => 1,
                'role' => 'admin',
                'email' => 'admin@phizzahut.com',
                'password' => '123456',
                'address' => 'Phizza Hut',
                'phoneNumber' => '000000000000',
                'gender' => 'male',
            ],
            [
                'username' => 'stefanadisurya',
                'role_id' => 2,
                'role' => 'member',
                'email' => 'stefan@gmail.com',
                'password' => '123456',
                'address' => 'Jalan Jalan-Jalan',
                'phoneNumber' => '081513081131',
                'gender' => 'male',
            ]
        ]);
    }
}
