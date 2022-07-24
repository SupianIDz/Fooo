<?php

namespace App\Http\Resources\Tubes;

use App\Http\Resources\Cables\CableResource;
use App\Models\Cable;
use App\Models\Tube;
use App\Models\TubeLine;
use Grimzy\LaravelMysqlSpatial\Types\LineString;
use Grimzy\LaravelMysqlSpatial\Types\Point;
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
            'description' => $this->description,
            'color'       => $this->color,
            'weight'      => $this->weight,
            'opacity'     => $this->opacity,
            'cables'      => $this->cables->map(function (Cable $cable) {
                return new CableResource($cable);
            }),

            //
            'lines'       => $this->getLines(),
            'raw_lines'   => $this->when($request->has('raw_lines'), function () {
                return $this->lines->load('attached:id,uuid,name,type')->toArray();
            }),
        ];
    }

    /**
     * @return LineString|array
     */
    private function getLines() : LineString|array
    {
        $lines = $this->lines->map(function (TubeLine $line) {
            return new Point($line->lng, $line->lat);
        });

        if ($lines->count() === 0) {
            return [];
        }

        return new LineString($lines->toArray());
    }
}
