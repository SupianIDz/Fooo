<?php

namespace App\Models;

use App\Models\Concerns\HasUUID;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @mixin IdeHelperTubeLine
 */
class TubeLine extends Model
{
    use HasFactory, HasUUID;

    /**
     * @var string[]
     */
    protected $fillable = [
        'uuid', 'tube_id', 'address', 'lat', 'lng', 'attached_on',
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
    public function tube() : BelongsTo
    {
        return $this->belongsTo(Tube::class);
    }
}
