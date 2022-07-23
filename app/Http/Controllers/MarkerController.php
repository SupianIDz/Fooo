<?php

namespace App\Http\Controllers;

use App\Models\Marker;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class MarkerController extends Controller
{
    /**
     * @param  Marker $marker
     * @return Application|Factory|View
     */
    public function index(Marker $marker)
    {
        return view('marker.index', [
            'markers' => $marker->withCount('ports')->orderBy('created_at', 'DESC')->paginate(10),
        ]);
    }
}
