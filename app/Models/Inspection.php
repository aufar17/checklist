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
        'slug',
        'item',
    ];

    public function inspection__hydrants(): HasMany
    {
        return $this->hasMany(InspectionHydrant::class, 'id', 'inspection_id');
    }

    public static function getIdBySlug($slug)
    {
        return self::where('slug', $slug)->value('id');
    }
}
