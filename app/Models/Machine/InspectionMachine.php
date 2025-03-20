<?php

namespace App\Models\Machine;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class InspectionMachine extends Model
{
    protected $connection = 'mysql';
    protected $table = 'inspection_machines';
    protected $fillable = [
        'machine_id',
        'machine_item_id',
        'value',
        'documentation',
        'pic_maintenance',
        'pic_maintenance_date',
        'line_guide',
        'line_guide_date',
        'foreman_produksi',
        'foreman_produksi_date',
    ];

    public function inspectionMachines(): HasMany
    {
        return $this->hasMany(InspectionMachine::class, 'machine_id', 'id');
    }
}
