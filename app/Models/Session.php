<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Session extends Model
{
    use HasFactory;

    /** This table name deviates from the Laravel/Eloquent naming pattern.
     * @var string
     */
    protected $table = 'session';


    // TODO: Consider renaming the session id in this table.
    /** This does not have the "standard" id value. It is actually the generated
     * session id, and should probably be renamed.
     * @var string[]
     */
    protected $fillable = [
        'id',
        'modified',
        'lifetime',
        'data'
    ];


    /**
     * This table has no timestamps.
     * @var bool
     */
    public $timestamps = false;
}
