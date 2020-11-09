<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GradeLevel extends Model
{
    use HasFactory;

    protected $fillable = [
        'school_year',
        'grade_level',
        'grade_level_name',
        'display_order'
    ];


    /**
     * This table has no timestamps.
     * @var bool
     */
    public $timestamps = false;
}
