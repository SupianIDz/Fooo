<?php

namespace App\Http\Resources\Cables;

use App\Models\Cable;
use App\Models\CableLine;
use Grimzy\LaravelMysqlSpatial\Types\LineString;
use Grimzy\LaravelMysqlSpatial\Types\Point;
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
            'uuid'          => $this->uuid,
            'name'          => $this->name,
            'description'   => $this->description,
            'color'         => $this->color,
            'weight'        => $this->weight,
            'opacity'       => $this->opacity,
            'lines'         => $this->lines->map(function ($row) {
                return new CableLineResource($row);
            }),
            'lines_for_map' => new LineString(
                $this->lines->map(function (CableLine $line) {
                    return new Point($line->lng, $line->lat);
                })
                    ->toArray()
            ),
        ];
    }
}
