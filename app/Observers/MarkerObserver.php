<?php

namespace App\Observers;

use App\Models\Marker;
use Illuminate\Support\Str;

class MarkerObserver
{
    /**
     * @param  Marker $marker
     * @return void
     */
    public function creating(Marker $marker) : void
    {
        $marker->uuid = Str::uuid();
    }
}
