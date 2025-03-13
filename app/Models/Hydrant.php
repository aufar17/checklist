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
        'status_hydrant',
        'status',
        'notes',
        'panjang_selang',
        'jenis_nozle',
        'longitude',
        'latitude',
    ];

    public function inspectionHydrants(): HasMany
    {
        return $this->hasMany(InspectionHydrant::class, 'hydrant_id', 'id');
    }

    public function actionLogs(): HasMany
    {
        return $this->hasMany(ActionLog::class, 'id', 'hydrant_id');
    }

    public function getStatusAttribute($value)
    {
        return json_decode($value, true);
    }

    public function setStatusAttribute($value)
    {
        $this->attributes['status'] = json_encode($value);
    }
    public function setStatusHydrantAttribute($value)
    {
        $this->attributes['status_hydrant'] = json_encode($value);
    }
    public function getStatusHydrantAttribute($value)
    {
        return json_decode($value, true);
    }
}
