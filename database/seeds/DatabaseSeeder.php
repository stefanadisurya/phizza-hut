<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        /**
         * Daftar seeder yang dapat dijalankan menggunakan perintah
         * php artisan db:seed
         * 
         * Made by @stefanadisurya & @ChristopherIrvine
         */
        $this->call(UserSeeder::class);
        $this->call(PizzaSeeder::class);
    }
}
