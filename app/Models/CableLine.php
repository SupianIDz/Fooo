<?php

namespace App\Models;

use App\Models\Concerns\HasUUID;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @mixin IdeHelperCableLine
 */
class CableLine extends Model
{
    use HasUUID;

    /**
     * @var string[]
     */
    protected $fillable = [
        'uuid', 'cable_id', 'address', 'lat', 'lng', 'attached_on', 'name',
    ];

    /**
     * @var string[]
     */
    protected $with = [
        'attached', 'child',
    ];

    /**
     * @var string[]
     */
    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:i:s',
        'updated_at' => 'datetime:Y-m-d H:i:s',
        'deleted_at' => 'datetime:Y-m-d H:i:s',
    ];

    /**
     * @return BelongsTo
     */
    public function attached() : BelongsTo
    {
        return $this->belongsTo(Marker::class, 'attached_on')->with('ports:id,marker_id,name,status');
    }

    /**
     * @return HasMany
     */
    public function child() : HasMany
    {
        return $this->hasMany(CableFromOdc::class, 'cable_line_id')->with('lines');
    }
}
