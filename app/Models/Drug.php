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
        ->orderby('drugs.name')
        ->get();
    }

    /**
     * Get the ranking of people who more expend with drugs.
     */
    public static function getWhoMoreExpend()
    {
        return Drug::select('people.name', DB::raw('sum(drugs.price) as value'))
            ->join('people', 'people.id', 'drugs.person_id')
            ->groupby('people.name')
            ->orderby(DB::raw('sum(drugs.price)'),'desc')
            ->get();
    }

    /**
     * Get the ranking of more used drugs.
     */
    public static function getMoreUsedDrugs()
    {
        return Drug::select('name', DB::raw('count(name) as amount'))
            ->groupby('name')
            ->get();
    }

    /**
     * Get the ranking of people who use same drugs.
     */
    public static function getPeopleUseSameDrugs()
    {
        $data = Drug::select('name')->distinct()->get();
        foreach($data as $d)
        {
            $people = Drug::select('drugs.person_id', 'people.name')
            ->join('people', 'people.id', 'drugs.person_id')
            ->where('drugs.name', $d->name)
            ->get();
            $d['people'] = $people;
        }
        return $data;
    }


}
