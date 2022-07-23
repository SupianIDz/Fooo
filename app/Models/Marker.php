<?php

namespace App\Models;

use Grimzy\LaravelMysqlSpatial\Eloquent\SpatialTrait;
use Grimzy\LaravelMysqlSpatial\Types\Point;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

/**
 * @property-read Point $location
 * @mixin IdeHelperMarker
 */
class Marker extends Model
{
    use SpatialTrait, HasFactory;

    public const TYPE_JC = 'JC';

    public const TYPE_ODC = 'ODC';

    public const TYPE_ODP = 'ODP';

    public const TYPE_POLE = 'POLE';

    /**
     * @var string[]
     */
    protected $fillable = [
        'uuid', 'name', 'location', 'parent_id', 'address', 'type',
    ];

    /**
     * @var array|string[]
     */
    protected array $spatialFields = [
        'location',
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
    public function getIconUrlAttribute() : string
    {
        return asset('assets/img/' . Str::of($this->type)->lower() . '.svg');
    }

    /**
     * @return string
     */
    public function getTypeAliasAttribute() : string
    {
        return match ($this->type) {
            self::TYPE_JC => 'JC',
            self::TYPE_ODC => 'ODC',
            self::TYPE_ODP => 'ODP',
            self::TYPE_POLE => 'TIANG',
            default => 'UNKNOWN',
        };
    }

    /**
     * @return HasMany
     */
    public function ports() : HasMany
    {
        return $this->hasMany(Port::class);
    }
}
