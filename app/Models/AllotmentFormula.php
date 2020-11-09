<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AllotmentFormula extends Model
{
    use HasFactory;

    /** This table name deviates from the Laravel/Eloquent naming pattern.
     * @var string
     */
    protected $table = 'allot_formulas';

    protected $fillable = [
        'school_year',
        'allot_type_id',
        'school_grade_level_id',
        'school_type_id',
        'description',
        'display_order',
        'allot_formulas_meta_id',
        'base_amt',
        'mbr_range_ind',
        'mbr_range_low',
        'mbr_range_high',
        'mbr_range_amt',
        'mbr_adj_ind',
        'round_ind',
        'mbr_adj_amt',
        'mbr_adj_multiplier',
        'mbr_adj_divisor',
        'travel_ind'
    ];

    /**
     * This table has no timestamps.
     * @var bool
     */
    public $timestamps = false;
}
