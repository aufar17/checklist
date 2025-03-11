<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ActionLog extends Model
{
    protected $connection = 'mysql';
    protected $table = 'action_logs';
    protected $fillable = [
        'hydrant_id',
        'action',
        'notes',
        'user',
    ];

    public function hydrant(): BelongsTo
    {
        return $this->belongsTo(Hydrant::class, 'hydrant_id', 'id');
    }
}
