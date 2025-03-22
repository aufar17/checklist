<?php

namespace App\Models\Machine;

use App\Models\MachineApproval;
use Illuminate\Database\Eloquent\Casts\Attribute;
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

    public function inspectionMachines(): HasMany
    {
        return $this->hasMany(InspectionMachine::class, 'machine_id', 'id');
    }

    public function machineApproval(): HasMany
    {
        return $this->hasMany(MachineApproval::class, 'machine_id', 'id');
    }
}
