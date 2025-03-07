<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Hydrant extends Model
{
    protected $connection = 'mysql';
    protected $table = 'hydrants';
    protected $fillable = [
        'no_hydrant',
        'location',
        'type',
        'status',
        'notes',
        'longitude',
        'latitude',
    ];

    public function inspectionHydrants(): HasMany
    {
        return $this->hasMany(InspectionHydrant::class, 'hydrant_id', 'id');
    }

        // public function InspectionThisMonth(): HasMany
        // {
        //     return $this->hasMany(InspectionHydrant::class, 'hydrant_id', 'id')
        //         ->whereMonth('inspection_date', Carbon::now()->month)
        //         ->whereYear('inspection_date', Carbon::now()->year);
        // }
}
