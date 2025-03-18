<?php

namespace App\Models\Machine;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class MachineGroup extends Model
{
    protected $connection = 'mysql';
    protected $table = 'machine_groups';
    protected $fillable = [
        'desc',

    ];

    public function machineItems(): HasMany
    {
        return $this->hasMany(MachineItem::class, 'group_id', 'id');
    }
}
