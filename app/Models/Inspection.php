<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Inspection extends Model
{
    protected $connection = 'mysql';
    protected $table = 'inspections';
    protected $fillable = [
        'group_id',
        'item',
    ];
}
