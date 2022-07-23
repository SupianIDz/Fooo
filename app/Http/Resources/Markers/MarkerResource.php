<?php

namespace App\Http\Resources\Markers;

use App\Models\Marker;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Str;

/** @mixin Marker */
class MarkerResource extends JsonResource
{
    /**
     * @param  Request $request
     * @return array
     */
    public function toArray($request) : array
    {
        return [
            'uuid'     => $this->uuid,
            'name'     => $this->name,
            'type'     => $this->type,
            'icon'     => Str::of($this->type)->lower()->append('.svg'),
            'address'  => $this->address,
            'location' => $this->location,
        ];
    }
}
