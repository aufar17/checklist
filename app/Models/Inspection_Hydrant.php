<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Inspection_Hydrant extends Model
{
    protected $connection = 'mysql';
    protected $table = 'inspection__hydrants';
    protected $fillable = [
        'hydrant_id',
        'inspection_id',
        'inspection_date',
        'values',
        'notes',
        'known_by',
        'checked_by',
        'created_by',
        'known_date',
        'checked_date',
        'created_date',

    ];
}
