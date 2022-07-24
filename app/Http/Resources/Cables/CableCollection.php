<?php

namespace App\Http\Resources\Cables;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

/** @see \App\Models\Cable */
class CableCollection extends ResourceCollection
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
