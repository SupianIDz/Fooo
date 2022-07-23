<?php

namespace App\Http\Controllers;

use App\Models\Marker;
use App\Models\Tube;
use Illuminate\Contracts\View\View;

class TubeController extends Controller
{
    /**
     * @param  Tube $tube
     * @return View
     */
    public function index(Tube $tube) : View
    {
        return view('network.index', [
            'tubes' => $tube->withCount('lines')->orderBy('created_at', 'DESC')->paginate(10)->withQueryString(),
        ]);
    }

    /**
     * @param  Marker $marker
     * @return View
     */
    public function create(Marker $marker) : View
    {
        return view('network.create', [
            'markers' => $marker->get(),
        ]);
    }
}
