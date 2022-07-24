<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\Tubes\CreateTubeRequest;
use App\Http\Resources\Tubes\TubeCollection;
use App\Http\Resources\Tubes\TubeResource;
use App\Models\Tube;
use App\Services\TubeService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TubeController extends Controller
{
    /**
     * @return TubeCollection
     */
    public function index()
    {
        return new TubeCollection(Tube::withCount('lines')->get([
            '*',
        ]));
    }

    /**
     * @param  Tube $tube
     * @return TubeResource
     */
    public function show(Tube $tube)
    {
        return new TubeResource($tube);
    }

    /**
     * @param  CreateTubeRequest $request
     * @param  TubeService       $service
     * @return JsonResponse
     */
    public function store(CreateTubeRequest $request, TubeService $service)
    {
        if ($tube = $service->createFromRequest($request)) {
            return response()->json([
                'data'    => $tube->toArray(),
                'message' => 'Tube created successfully',
            ]);
        }

        return response()->json([
            'message' => 'Tube creation failed',
        ], 422);
    }

    public function update(Tube $tube, TubeService $service, Request $request)
    {
        if ($service->updateFromRequest($tube, $request)) {
            return response()->json([
                'data'    => $tube->toArray(),
                'message' => 'Tube updated successfully',
            ]);
        }
    }
}
