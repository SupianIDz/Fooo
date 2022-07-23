<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\Tubes\CreateTubeRequest;
use App\Http\Resources\Tubes\TubeCollection;
use App\Models\Tube;
use App\Services\TubeService;
use Illuminate\Http\JsonResponse;

class TubeController extends Controller
{
    /**
     * @return TubeCollection
     */
    public function index()
    {
        return new TubeCollection(Tube::get([
            '*',
        ]));
    }

    /**
     * @param  CreateTubeRequest $request
     * @param  TubeService       $service
     * @return JsonResponse
     */
    public function store(CreateTubeRequest $request, TubeService $service)
    {
        if ($service->createFromRequest($request)) {
            return response()->json([
                'message' => 'Tube created successfully',
            ]);
        }

        return response()->json([
            'message' => 'Tube creation failed',
        ], 422);
    }
}
