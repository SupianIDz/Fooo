<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\Markers\MarkerCollection;
use App\Models\Marker;

class MarkerController extends Controller
{
    /**
     * @return MarkerCollection
     */
    public function index()
    {
        return new MarkerCollection(Marker::get([
            'uuid', 'name', 'type', 'address', 'location',
        ]));
    }
}
