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
            'id' => 1,
            'name' => 'PARACETAMOL',
            'dosage' => 10,
            'price' => 20,
            'interval' => 6,
            'person_id' => 1,
            'period' => 2,
            'created_at' => date('Y-m-d H:i:s')
        ]);

        DB::table('drugs')->insert([
            'id' => 2,
            'name' => 'DIPIRONA',
            'dosage' => 10,
            'price' => 14,
            'interval' => 3,
            'person_id' => 2,
            'period' => 2,
            'created_at' => date('Y-m-d H:i:s')
        ]);  
    }
}
