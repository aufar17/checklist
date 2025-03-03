<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class InspectionHydrant extends Model
{
    protected $connection = 'mysql';
    protected $table = 'inspection__hydrants';
    protected $fillable = [
        'hydrant_id',
        'inspection_id',
        'inspection_date',
        'documentation',
        'values',
        'notes',
        'known_by',
        'checked_by',
        'created_by',
        'known_date',
        'checked_date',
        'created_date',

    ];

    public function hydrant(): BelongsTo
    {
        return $this->belongsTo(Hydrant::class, 'hydrant_id', 'id');
    }
}
