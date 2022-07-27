<?php

namespace App\Http\Resources\Cables;

use App\Models\CableLine;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin CableLine
 */
class CableLineResource extends JsonResource
{
    /**
     * @param  Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id'          => $this->id,
            'uuid'        => $this->uuid,
            'name'        => $this->name,
            'address'     => $this->address,
            'lat'         => $this->lat,
            'lng'         => $this->lng,
            'attached_on' => $this->attached_on,
            'attached'    => $this->attached,
            'children'    => $this->child->map(function ($row) {
                return new CableFromODCResource($row);
            }),
        ];
    }
}
