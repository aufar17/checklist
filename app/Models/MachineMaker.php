<?php

namespace App\Models;

use App\Models\Machine\Machine;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class MachineMaker extends Model
{
    protected $connection = 'mysql';
    protected $table = 'machine_makers';

    protected $fillable = [
        'name',
    ];

    public function machine(): HasMany
    {
        return $this->hasMany(Machine::class, 'id', 'maker');
    }
}
