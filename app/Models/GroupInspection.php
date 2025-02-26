<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class GroupInspection extends Model
{
    protected $connections = 'mysq;';
    protected $table = 'group_inspections';
    protected $fillable = [
        'group_id',
        'name',
    ];

    public function inspection(): HasMany
    {
        return $this->hasMany(Inspection::class);
    }
}
