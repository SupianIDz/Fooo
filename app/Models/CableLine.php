<?php

namespace App\Models;

use App\Models\Concerns\HasUUID;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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
        'attached',
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
}
