<?php

namespace App\Models;

use App\Models\Concerns\HasUUID;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @mixin IdeHelperCable
 */
class Cable extends Model
{
    use HasUUID;

    /**
     * @var string[]
     */
    protected $fillable = [
        'name', 'weight', 'color', 'opacity', 'description', 'uuid', 'tube_id',
    ];

    /**
     * @return HasMany
     */
    public function lines() : HasMany
    {
        return $this->hasMany(CableLine::class);
    }
}
