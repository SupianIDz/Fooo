<?php

namespace App\Http\Controllers;

use App\Models\CableLine;
use App\Models\Marker;
use App\Models\Tube;

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

    public function findCableHasJC(Tube $tube)
    {
        return $tube->cables->map(function ($tube) {
            return $tube->lines
                ->filter(function ($line) {
                    return $line->attached->type === Marker::TYPE_ODC;
                })
                ->map(function ($line) {
                    return $line->attached->name;
                });
        });
    }
}
