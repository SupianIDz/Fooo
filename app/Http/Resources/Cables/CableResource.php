<?php

namespace App\Http\Resources\Cables;

use App\Models\Cable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin Cable */
class CableResource extends JsonResource
{
    /**
     * @param  Request $request
     * @return array
     */
    public function toArray($request) : array
    {
        return [
            'uuid'        => $this->uuid,
            'name'        => $this->name,
            'description' => $this->description,
            'color'       => $this->color,
            'weight'      => $this->weight,
            'opacity'     => $this->opacity,
            'lines'       => $this->lines,
        ];
    }
}
