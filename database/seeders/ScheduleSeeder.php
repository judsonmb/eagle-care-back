<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ScheduleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('schedules')->insert([
            'interval' => 3,
        ]);

        DB::table('schedules')->insert([
            'interval' => 6,
        ]);

        DB::table('schedules')->insert([
            'interval' => 8,
        ]);

        DB::table('schedules')->insert([
            'interval' => 12,
        ]);
    }
}
