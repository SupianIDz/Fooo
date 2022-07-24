<?php

namespace App\Http\Resources\Cables;

use App\Http\Resources\CableLineFromODCResource;
use App\Models\CableFromOdc;
use Grimzy\LaravelMysqlSpatial\Types\LineString;
use Grimzy\LaravelMysqlSpatial\Types\Point;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin CableFromOdc
 */
class CableFromODCResource extends JsonResource
{
    /**
     * @param  Request $request
     * @return array
     */
    public function toArray($request) : array
    {
        return [
            'uuid'          => $this->uuid,
            'name'          => $this->name,
            'description'   => $this->description,
            'color'         => $this->color,
            'weight'        => $this->weight,
            'opacity'       => $this->opacity,
            'lines_detail'  => $this->lines->map(function ($row) {
                return new CableLineFromODCResource($row);
            }),
            'lines_for_map' => $this->getLineString(),
        ];
    }

    /**
     * @return array|LineString
     */
    private function getLineString() : array|LineString
    {
        $lines = [];
        $lines[] = new Point($this->parent->lng, $this->parent->lat);

        $x = $this->lines->map(function ($line) {
            return new Point($line->lng, $line->lat);
        });

        if ($x->count() === 0) {
            return [];
        }

        return new LineString(array_merge($lines, $x->toArray()));
    }
}
