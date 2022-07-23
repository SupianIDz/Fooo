<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\Markers\MarkerCollection;
use App\Http\Resources\Markers\MarkerResource;
use App\Models\Marker;
use Illuminate\Http\Request;

class MarkerController extends Controller
{
    /**
     * @return MarkerCollection
     */
    public function index(Request $request)
    {
        if ($request->has('type')) {
            return new MarkerCollection(Marker::where('type', strtoupper($request->get('type')))->get([
                'uuid', 'name', 'type', 'address', 'location',
            ]));
        }

        return new MarkerCollection(Marker::get([
            'uuid', 'name', 'type', 'address', 'location',
        ]));
    }

    /**
     * @param  Marker $marker
     * @return MarkerResource
     */
    public function show(Marker $marker)
    {
        return new MarkerResource($marker);
    }
}
