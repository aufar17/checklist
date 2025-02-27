<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Inspection extends Model
{
    protected $connection = 'mysql';
    protected $table = 'inspections';
    protected $fillable = [
        'group_id',
        'item',
    ];

    public function inspection__hydrants(): HasMany
    {
        return $this->hasMany(Inspection_Hydrant::class, 'id', 'inspection_id');
    }
}
