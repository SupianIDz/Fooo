<?php

namespace App\Models;

use App\Models\Concerns\HasUUID;
use Illuminate\Database\Eloquent\Model;

/**
 * @mixin IdeHelperCableFromOdcLine
 */
class CableFromOdcLine extends Model
{
    use HasUUID;

    /**
     * @var string[]
     */
    protected $fillable = [
        'uuid', 'cable_from_odc_id', 'name', 'address', 'lat', 'lng', 'attached_on',
    ];
}
