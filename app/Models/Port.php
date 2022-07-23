<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @mixin IdeHelperPort
 */
class Port extends Model
{
    /**
     * @var string[]
     */
    protected $fillable = [
        'name', 'marker_id', 'status',
    ];

    /**
     * @var string[]
     */
    protected $casts = [
        'status'     => 'boolean',
        'created_at' => 'datetime:Y-m-d H:i:s',
        'updated_at' => 'datetime:Y-m-d H:i:s',
        'deleted_at' => 'datetime:Y-m-d H:i:s',
    ];
}
