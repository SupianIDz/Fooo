<?php

namespace App\Http\Controllers;

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
}
