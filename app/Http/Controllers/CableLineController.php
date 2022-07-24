<?php

namespace App\Http\Controllers;

use App\Models\CableLine;

class CableLineController extends Controller
{
    /**
     * @param  CableLine $cableline
     * @return CableLine
     */
    public function show(CableLine $cableline)
    {
        return $cableline;
    }
}
