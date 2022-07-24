<?php

namespace App\Models;

use App\Models\Concerns\HasUUID;
use Illuminate\Database\Eloquent\Model;

/**
 * @mixin IdeHelperJoinClosureCable
 */
class JoinClosureCable extends Model
{
    use HasUUID;

    /**
     * @var string[]
     */
    protected $fillable = [
        'cable_from_odc_line_id', 'uuid', 'name', 'description', 'color', 'weight', 'opacity', 'port_id',
    ];
}
