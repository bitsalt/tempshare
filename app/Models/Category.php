<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_name',
        'school_year',
        'fund',
        'salary_nonsalary_ind',
        'display_order'
    ];


    /**
     * This table has no timestamps.
     * @var bool
     */
    public $timestamps = false;
}
