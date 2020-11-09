<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AllotmentGradeLevel extends Model
{
    use HasFactory;

    /** This table name deviates from the Laravel/Eloquent naming pattern.
     * @var string
     */
    protected $table = 'allot_grade_levels';


    protected $fillable = [
        'allotment_type_id',
        'school_year',
        'grade_level_id'
    ];


    /**
     * This table has no timestamps.
     * @var bool
     */
    public $timestamps = false;

}
