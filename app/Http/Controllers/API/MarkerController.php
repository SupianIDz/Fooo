<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\Markers\CreateMarkerRequest;
use App\Http\Resources\Markers\MarkerCollection;
use App\Http\Resources\Markers\MarkerResource;
use App\Models\Marker;
use App\Services\MarkerService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

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
        return Cache::remember('marker_' . $marker->uuid, 600, function () use ($marker) {
            return new MarkerResource($marker);
        });
    }

    /**
     * @param  CreateMarkerRequest $request
     * @param  MarkerService       $service
     * @return JsonResponse
     */
    public function store(CreateMarkerRequest $request, MarkerService $service)
    {
        if ($service->createFromRequest($request)) {
            return response()->json([
                'success' => true,
                'message' => 'Marker created successfully',
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Something went wrong',
        ]);
    }
}
