<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class School extends Model
{
    use HasFactory;

    protected $fillable = [
        'school',
        'school_year',
        'school_name',
        'magnet_ind',
        'restart_ind',
        'school_grade_level_id',
        'school_type_id',
        'has_schedule_assistance',
        'schedule_assistance_hours'
    ];


    /*
     * Renaming the Eloquient timestamp fields
     */
    const CREATED_AT = 'date_created';
    const UPDATED_AT = 'date_modified';
}
