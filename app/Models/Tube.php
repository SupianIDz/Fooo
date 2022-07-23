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
        'name', 'height', 'color', 'description', 'uuid',
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
     * @return HasMany
     */
    public function lines() : HasMany
    {
        return $this->hasMany(TubeLine::class);
    }
}