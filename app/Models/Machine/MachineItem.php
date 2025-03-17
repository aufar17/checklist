<?php

namespace App\Models\Machine;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class MachineItem extends Model
{
    protected $connection = 'mysql';
    protected $table = 'machine_items';
    protected $fillable = [
        'group_id',
        'slug',
        'instruction',
        'standard',
        'frequency',
    ];

    public function inspectionMachine(): HasMany
    {
        return $this->hasMany(InspectionMachine::class, 'id', 'machine_item_id');
    }
}
