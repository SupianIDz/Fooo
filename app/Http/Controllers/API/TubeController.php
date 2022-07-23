<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\Tubes\TubeCollection;
use App\Models\Tube;

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
}
