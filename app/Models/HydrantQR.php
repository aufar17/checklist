<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HydrantQR extends Model
{
    protected $connection = 'mysql';
    protected $table = 'hydrantqr';
    protected $fillable = [
        'content',
        'scanned_by',
        'scanned_at'
    ];
}
