<?php

namespace App\Models;

use App\Models\Concerns\HasUUID;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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
}
