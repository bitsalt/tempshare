<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AllotmentType extends Model
{
    use HasFactory;

    protected $fillable = [
        'school_year',
        'allotment_prog_code',
        'allotment_prog_desc',
        'category_id',
        'data_link',
        'is_carryover'
    ];

    /*
     * Renaming the Eloquient timestamp fields
     */
    const CREATED_AT = 'date_created';
    const UPDATED_AT = 'date_modified';
}
