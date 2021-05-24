<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class Drug extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'dosage', 'price', 'interval', 'person_id', 'period',
    ];

    /**
     * Get the person that owns the drug.
     */
    public function Person()
    {
        return $this->belongsTo(Person::class);
    }

    /**
     * Get the schedules that owns the drug.
     */
    public function Schedules()
    {
        return $this->hasMany(Schedule::class);
    }

    /**
     * Get the format data to index view
     */
    public static function getIndexData()
    {
        return Drug::select('drugs.id', 'drugs.name', 'drugs.dosage', 
        'drugs.price', 'drugs.interval', 'people.name as person_name', 'drugs.period',
        DB::raw("drugs.created_at as first_time_at"))
        ->join('people', 'people.id', 'drugs.id')
        ->get();
    }


}
