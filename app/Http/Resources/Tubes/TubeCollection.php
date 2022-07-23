<?php

namespace App\Http\Resources\Tubes;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

/** @see \App\Models\Tube */
class TubeCollection extends ResourceCollection
{
    /**
     * @param  Request $request
     * @return array
     */
    public function toArray($request) : array
    {
        return [
            'data' => $this->collection->filter(function ($tube) {
                return $tube->lines_count > 0;
            })];
    }
}
