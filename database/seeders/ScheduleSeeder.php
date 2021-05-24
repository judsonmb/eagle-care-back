<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Drug;
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
        $count = Drug::all()->count();
        for($i = 1; $i <= $count; $i++)
        {
            $drug = Drug::find($i);
            $times = ($drug->period*24)/$drug->interval;
            $schedule = $drug->created_at;
            for($j = 1; $j<=$times; $j++)
            {
                DB::table('schedules')->insert([
                    'drug_id' => $i,
                    'schedule' => $schedule
                ]);
                $schedule = date('Y-m-d H:i:s', strtotime($schedule . " + $drug->interval hours"));
            }
        }
    }
}
