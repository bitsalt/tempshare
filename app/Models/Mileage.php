<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mileage extends Model
{
    use HasFactory;

    /** This table name deviates from the Laravel/Eloquent naming pattern.
     * @var string
     */
    protected $table = 'mileage';


    protected $fillable = [
        'school_year',
        'school',
        'mileage'
    ];


    /**
     * This table has no timestamps.
     * @var bool
     */
    public $timestamps = false;
}
