<?php

namespace App\Http\Resources\Markers;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

/** @see \App\Models\Marker */
class MarkerCollection extends ResourceCollection
{
    /**
     * @param  Request $request
     * @return array
     */
    public function toArray($request) : array
    {
        return [
            'data' => $this->collection,
        ];
    }
}
