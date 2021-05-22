<?php

namespace Database\Seeders;

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
            'name' => 'Gertrudes',
            'email' => 'gertrudes@gmail.com',
            'password' => '$2y$10$0iiLPi.NjOc07WqyeQB0x.aPf8eA/2QoxGeI1PZ8QYT3cjzEn9S8G', //12345678
        ]);
    }
}
