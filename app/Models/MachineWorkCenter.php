<?php

namespace App\Models;

use App\Models\Machine\Machine;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class MachineWorkCenter extends Model
{
    protected $connection = 'mysql';
    protected $table = 'machine_work_centers';
    protected $fillable = [
        'name',
        'line_code',
    ];

    public function machines(): HasMany
    {
        return $this->hasMany(Machine::class, 'id', 'work_center');
    }
}
