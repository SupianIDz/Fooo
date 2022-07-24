<?php

namespace App\Http\Resources\JoinClosures;

use Grimzy\LaravelMysqlSpatial\Types\LineString;
use Grimzy\LaravelMysqlSpatial\Types\Point;
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
            'lines_for_map'          => $this->getLineString(),
        ];
    }

    /**
     * @return LineString
     */
    protected function getLineString() : LineString
    {
        $lines = [];
        $lines[] = new Point($this->parent->lng, $this->parent->lat);

        foreach ($this->lines as $line) {
            $lines[] = new Point($line->lng, $line->lat);
        }

        return new LineString($lines);
    }
}
