<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DrugSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('drugs')->insert([
            'name' => 'Paracetamol',
            'dosage' => 10,
            'price' => 20,
            'schedule_id' => 1,
            'person_id' => 1,
            'period' => 2
        ]);

        DB::table('drugs')->insert([
            'name' => 'Paracetamol',
            'dosage' => 10,
            'price' => 20,
            'schedule_id' => 1,
            'person_id' => 2,
            'period' => 2
        ]);

        DB::table('drugs')->insert([
            'name' => 'Paracetamol',
            'dosage' => 10,
            'price' => 20,
            'schedule_id' => 1,
            'person_id' => 3,
            'period' => 4
        ]);

        DB::table('drugs')->insert([
            'name' => 'Paracetamol',
            'dosage' => 10,
            'price' => 20,
            'schedule_id' => 1,
            'person_id' => 4,
            'period' => 2
        ]);

        DB::table('drugs')->insert([
            'name' => 'Paracetamol',
            'dosage' => 10,
            'price' => 20,
            'schedule_id' => 1,
            'person_id' => 5,
            'period' => 3
        ]);
     
    }
}
