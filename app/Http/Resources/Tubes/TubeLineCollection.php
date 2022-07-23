<?php

namespace App\Http\Resources\Tubes;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

/** @see \App\Models\TubeLine */
class TubeLineCollection extends ResourceCollection
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
