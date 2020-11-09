<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentPlanning extends Model
{
    use HasFactory;

    /** This table name deviates from the Laravel/Eloquent naming pattern.
     * @var string
     */
    protected $table = 'student_planning';


    // TODO: Adding the school_year field rather than continue creating new tables each year.
    protected $fillable = [
        'school_year',
        'school_id',
        'school_name',
        'grade_ki',
        'grade_1',
        'grade_2',
        'grade_3',
        'grade_4',
        'grade_5',
        'grade_6',
        'grade_7',
        'grade_8',
        'grade_9',
        'grade_10',
        'grade_11',
        'grade_12',
    ];


    /**
     * This table has no timestamps.
     * @var bool
     */
    public $timestamps = false;
}
