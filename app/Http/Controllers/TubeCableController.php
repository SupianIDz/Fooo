<?php

namespace App\Http\Controllers;

use App\Models\Marker;
use Illuminate\Contracts\View\View;

class TubeCableController extends Controller
{
    /**
     * @return View
     */
    public function index() : View
    {
        return view('network.index');
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
