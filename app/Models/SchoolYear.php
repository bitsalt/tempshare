<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SchoolYear extends Model
{
    use HasFactory;

    protected $fillable = [
        'school_year',
        'display',
        'current_ind',
        'admin_current_ind',
        'visible_to_schools'
    ];


    /**
     * This table has no timestamps.
     * @var bool
     */
    public $timestamps = false;
}
