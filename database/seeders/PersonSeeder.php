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
            'name' => 'Maria',
        ]);

        DB::table('people')->insert([
            'name' => 'Vincenta',
        ]);

        DB::table('people')->insert([
            'name' => 'Zefina',
        ]);

        DB::table('people')->insert([
            'name' => 'Josefa',
        ]);

        DB::table('people')->insert([
            'name' => 'Paulita',
        ]);

        DB::table('people')->insert([
            'name' => 'Angelica',
        ]);
    }
}
