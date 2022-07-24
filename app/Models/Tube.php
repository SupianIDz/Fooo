<?php

namespace App\Models;

use App\Models\Concerns\HasUUID;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @mixin IdeHelperTube
 */
class Tube extends Model
{
    use HasFactory, HasUUID;

    /**
     * @var string[]
     */
    protected $fillable = [
        'name', 'weight', 'color', 'opacity', 'description', 'uuid', 'state',
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
     * @return string
     */
    public function getRouteKeyName() : string
    {
        return 'uuid';
    }

    /**
     * @return HasMany
     */
    public function lines() : HasMany
    {
        return $this->hasMany(TubeLine::class);
    }

    /**
     * @return HasMany
     */
    public function cables() : HasMany
    {
        return $this->hasMany(Cable::class);
    }
}
