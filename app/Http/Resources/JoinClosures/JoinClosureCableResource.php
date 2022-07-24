<?php

namespace App\Http\Resources\JoinClosures;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin \App\Models\JoinClosureCable */
class JoinClosureCableResource extends JsonResource
{
    /**
     * @param  Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'opacity'                => $this->opacity,
            'description'            => $this->description,
            'port_id'                => $this->port_id,
            'color'                  => $this->color,
            'id'                     => $this->id,
            'cable_from_odc_line_id' => $this->cable_from_odc_line_id,
            'uuid'                   => $this->uuid,
            'lines_count'            => $this->lines_count,
            'name'                   => $this->name,
            'weight'                 => $this->weight,
            'lines_detail'           => $this->lines,
        ];
    }
}
