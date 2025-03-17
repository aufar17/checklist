<?php

namespace App\Models\Machine;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Machine extends Model
{
    protected $connection = 'mysql';
    protected $table = 'machines';
    protected $fillable = [
        'no_machine',
        'name',
        'line',
        'maker',
        'no_fixed_asset',
        'status',
        'longitude',
        'latitude',
    ];

    public function inspectionMachine(): HasMany
    {
        return $this->hasMany(InspectionMachine::class, 'id', 'machine_id');
    }
}
