<?php

namespace App\Models;

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
        'longitude',
        'latitude',
    ];

    public function inspection__hydrants(): HasMany
    {
        return $this->hasMany(InspectionHydrant::class, 'id', 'id_hydrant');
    }
}
