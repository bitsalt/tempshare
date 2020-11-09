<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AllotmentFormulaMeta extends Model
{
    use HasFactory;

    /** This table name deviates from the Laravel/Eloquent naming pattern.
     * @var string
     */
    protected $table = 'allot_formulas_meta';

    protected $fillable = [
        'description',
        'salary_nonsalary_ind'
    ];
}
