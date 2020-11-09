<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Allotment extends Model
{
    use HasFactory;

    protected $fillable = [
        'school_id',
        'school_year',
        'allotment_type_id',
        'moe',
        'conversions',
        'carryover',
        'comments'
    ];
}
