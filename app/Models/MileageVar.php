<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MileageVar extends Model
{
    use HasFactory;

    protected $fillable = [
        'school_year',
        'mileage_rate',
        'trips',
        'bonus_trips',
        'bonus_miles'
    ];


    /**
     * This table has no timestamps.
     * @var bool
     */
    public $timestamps = false;
}
