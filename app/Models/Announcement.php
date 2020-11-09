<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Announcement extends Model
{
    use HasFactory;

    /** TODO: Consider all instances of the original field names in the existing
     * code. They are: announcement_id, announcement_text, announcement_active.
     */
    /** These field names have been altered.
     * @var string[]
     */
    protected $fillable = [
        'text',
        'is_active'
    ];


    /**
     * This table has no timestamps.
     * @var bool
     */
    public $timestamps = false;
}
