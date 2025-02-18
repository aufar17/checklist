<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HrdSo extends Model
{
    protected $table = 'hrd_so';

    protected $fillable = [
        'npk',
        'dept',
    ];
}
