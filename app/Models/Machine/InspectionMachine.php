<?php

namespace App\Models\Machine;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class InspectionMachine extends Model
{
    protected $connection = 'mysql';
    protected $table = 'inspections_machine';
    protected $fillable = [
        'machine_id',
        'machine_item_id',
        'value',
        'inspector',
        'inspection_date',
        'documentation',
        'pic_dcm_am',
        'pic_dcm_date',
        'pic_maintenance',
        'pic_maintenance_date',
        'line_guide',
        'line_guide_date',
        'foreman_produksi',
        'foreman_produksi_date',
    ];
}
