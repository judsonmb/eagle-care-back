<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PersonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('people')->insert([
            'id' => 1,
            'name' => 'Maria'
        ]);

        DB::table('people')->insert([
            'id' => 2,
            'name' => 'Vincenta'
        ]);

        DB::table('people')->insert([
            'id' => 3,
            'name' => 'Zefina'
        ]);

        DB::table('people')->insert([
            'id' => 4,
            'name' => 'Josefa'
        ]);

        DB::table('people')->insert([
            'id' => 5,
            'name' => 'Paulita'
        ]);

        DB::table('people')->insert([
            'name' => 'Angelica'
        ]);
    }
}
