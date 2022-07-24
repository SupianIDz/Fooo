<?php

namespace App\Models;

use App\Models\Concerns\HasUUID;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @mixin IdeHelperCableFromOdc
 */
class CableFromOdc extends Model
{
    use HasUUID;

    /**
     * @var string[]
     */
    protected $fillable = [
        'cable_line_id', 'uuid', 'name', 'description', 'color', 'weight', 'opacity', 'port_id',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function parent() : \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(CableLine::class, 'cable_line_id');
    }

    /**
     * @return HasMany
     */
    public function lines() : HasMany
    {
        return $this->hasMany(CableFromOdcLine::class);
    }
}
