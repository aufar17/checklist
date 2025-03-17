<?php

namespace App\Models\Machine;

use Illuminate\Database\Eloquent\Model;

class MachineQr extends Model
{
    protected $connection = 'mysql';
    protected $table = 'machine_qrs';
    protected $fillable = [
        'content',
        'scanned_by',
        'scanned_at',
    ];
}
