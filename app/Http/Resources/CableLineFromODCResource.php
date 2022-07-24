<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin \App\Models\CableFromOdcLine */
class CableLineFromODCResource extends JsonResource
{
    /**
     * @param  Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'uuid'        => $this->uuid,
            'name'        => $this->name,
            'attached_on' => $this->attached_on,
            'attached'    => $this->attached,
            'address'     => $this->address,
            'children'    => $this->children->map(function ($row) {
                return $row;
            }),
        ];
    }
}
