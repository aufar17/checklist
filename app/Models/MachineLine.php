<?php

namespace App\Models;

use App\Models\Machine\Machine;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class MachineLine extends Model
{
    protected $connection = 'mysql';
    protected $table = 'machine_lines';

    protected $fillable = [
        'name',
    ];

    public function machine(): HasMany
    {
        return $this->hasMany(Machine::class, 'id', 'line');
    }
}
