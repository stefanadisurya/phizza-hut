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
                'gender' => 'Male',
                'remember_token' => Str::random(50)
            ],
            [
                'username' => 'stefanadisurya',
                'role' => 'member',
                'email' => 'stefan@gmail.com',
                'password' => bcrypt('123456'),
                'address' => 'Jalan Anggrek Cakra, no. 1',
                'phoneNumber' => '081725192242',
                'gender' => 'Male',
                'remember_token' => Str::random(50)
            ],
            [
                'username' => 'irvinesendajaya',
                'role' => 'member',
                'email' => 'irvine@gmail.com',
                'password' => bcrypt('123456'),
                'address' => 'Jalan U, no. 10',
                'phoneNumber' => '0218459078',
                'gender' => 'Male',
                'remember_token' => Str::random(50)
            ]
        ]);
    }
}
