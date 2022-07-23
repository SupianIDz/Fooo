<?php

namespace App\Http\Resources\Tubes;

use App\Models\TubeLine;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin TubeLine */
class TubeLineResource extends JsonResource
{
    /**
     * @param  Request $request
     * @return array
     */
    public function toArray($request) : array
    {
        return [
            'uuid'        => $this->uuid,
            'address'     => $this->address,
            'coordinates' => [
                $this->lat, $this->lng,
            ],
        ];
    }
}
