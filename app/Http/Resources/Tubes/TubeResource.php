<?php

namespace App\Http\Resources\Tubes;

use App\Models\Tube;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin Tube */
class TubeResource extends JsonResource
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
            'height'      => $this->height,
            'description' => $this->description,
            'color'       => $this->color,
            'lines'       => $this->when($request->has('lines'), function () {
                return new TubeLineCollection($this->lines);
            }),
        ];
    }
}
