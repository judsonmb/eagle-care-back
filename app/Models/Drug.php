<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Drug extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'dosage', 'price', 'schedule_id', 'person_id', 'period',
    ];

    /**
     * Get the person that owns the drug.
     */
    public function Person()
    {
        return $this->belongsTo(Person::class);
    }

    /**
     * Get the schedule that owns the drug.
     */
    public function schedule()
    {
        return $this->belongsTo(Schedule::class);
    }
}
