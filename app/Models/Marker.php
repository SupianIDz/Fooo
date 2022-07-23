<?php

namespace App\Models;

use Grimzy\LaravelMysqlSpatial\Eloquent\SpatialTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
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
}
