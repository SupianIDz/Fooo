<?php

namespace App\Models;

use App\Models\Concerns\HasUUID;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @mixin IdeHelperCableFromOdcLine
 */
class CableFromOdcLine extends Model
{
    use HasUUID;

    /**
     * @var string[]
     */
    protected $fillable = [
        'uuid', 'cable_from_odc_id', 'name', 'address', 'lat', 'lng', 'attached_on',
    ];

    /**
     * @return BelongsTo
     */
    public function attached() : BelongsTo
    {
        return $this->belongsTo(Marker::class, 'attached_on');
    }

    /**
     * @return HasMany
     */
    public function children() : HasMany
    {
        return $this->hasMany(JoinClosureCable::class, 'cable_from_odc_line_id');
    }
}
