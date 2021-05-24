<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;

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
}
