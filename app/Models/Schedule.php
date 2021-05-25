<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class Schedule extends Model
{
    use HasFactory;

    public $timestamps = false; 

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'drug_id', 'schedule'
    ];

    /**
     * Get the person that owns the drug.
     */
    public function Drug()
    {
        return $this->belongsTo(Drug::class);
    }

    /**
     * Store a newly created Drug in storage.
     * 
     * Store the correspondent schedules. 
     *
     */
    public static function storeDrugSchedules(int $id, int $period, int $interval, string $created_at)
    {
        $times = ($period*24)/$interval;
        $schedule = $created_at;
        for($j = 1; $j<=$times; $j++)
        {
            $data = Schedule::create([
                    'drug_id' => $id,
                    'schedule' => $schedule
            ]);
            if(!$data)
            {
                return false;
            }
            $schedule = date('Y-m-d H:i:s', strtotime($schedule . " + $interval hours"));
        }
        return true; 
    }

    /**
     * Calls the Schedule's model and returns a list of schedules with its relations.
     */
    public static function getOrderedSchedulesAndRelations()
    {        
        return Schedule::select('schedules.id', 
        DB::raw('DATE_FORMAT(schedules.schedule, "%d/%m/%Y às %H:%i:%s") as schedule'), 
        'drugs.name as drug_name', 'people.name as person_name')
            ->join('drugs', 'schedules.drug_id', 'drugs.id')
            ->join('people', 'drugs.person_id', 'people.id')
            ->where('schedule', '>=', date('Y-m-d H:i:s'))
            ->orderby('schedules.schedule')
            ->get();
    }
}
