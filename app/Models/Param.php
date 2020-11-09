<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Param extends Model
{
    use HasFactory;

    /** This table name deviates from the Laravel/Eloquent naming pattern.
     * @var string
     */
    protected $table = 'new_params';


    protected $fillable = [
        'school_year',
        'param_name',
        'param_num'
    ];


    /**
     * This table has no timestamps.
     * @var bool
     */
    public $timestamps = false;
}
