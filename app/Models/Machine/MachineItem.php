<?php

namespace App\Models\Machine;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
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

    public function machineGroups(): BelongsTo
    {
        return $this->belongsTo(MachineGroup::class, 'group_id', 'id');
    }

    public function getRadioOptionsAttribute()
    {
        $options = [
            'kondisi-panel' => [
                ['label' => 'Bagus', 'value' => 1],
                ['label' => 'Rusak', 'value' => 0],
                ['label' => 'Rusak', 'value' => 0],
            ],
            'safety-switch' => [
                ['label' => 'ON', 'value' => 1],
                ['label' => 'OFF', 'value' => 0],
            ],
            'oli-level' => [
                ['label' => 'Full', 'value' => 'full'],
                ['label' => 'Setengah', 'value' => 'half'],
                ['label' => 'Habis', 'value' => 'empty'],
            ],
        ];

        return $options[$this->slug] ?? [
            ['label' => 'Bagus', 'value' => 1],
            ['label' => 'Rusak', 'value' => 0],
        ];
    }
}
