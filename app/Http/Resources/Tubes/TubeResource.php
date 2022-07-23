<?php

namespace App\Http\Resources\Tubes;

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
            'lines'       => $this->when($request->has('lines'), function () {
                $liens = $this->lines->map(function (TubeLine $line) {
                    return new Point($line->lng, $line->lat);
                });

                return new LineString($liens->toArray());
            }),
        ];
    }
}
