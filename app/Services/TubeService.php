<?php

namespace App\Services;

use App\Http\Requests\Tubes\CreateTubeRequest;
use App\Models\Tube;

class TubeService
{

    /**
     * @param  array $tube
     * @param  array $lines
     * @return Tube
     */
    public function create(array $tube, array $lines = []) : Tube
    {
        $tube = Tube::create($tube);

        foreach ($lines as $line) {
            $tube->lines()->create(array_merge($line, [
                'lat'         => $line['coordinates'][0],
                'lng'         => $line['coordinates'][1],
                'attached_on' => $line['manual'] ? null : $line['marker'],
            ]));
        }

        return $tube;
    }

    /**
     * @param  CreateTubeRequest $request
     * @return Tube
     */
    public function createFromRequest(CreateTubeRequest $request) : Tube
    {
        return $this->create($request->get('detail'), $request->get('lines'));
    }
}
