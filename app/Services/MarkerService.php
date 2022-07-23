<?php

namespace App\Services;

use App\Http\Requests\Markers\CreateMarkerRequest;
use App\Models\Marker;
use Grimzy\LaravelMysqlSpatial\Types\Point;

class MarkerService
{

    /**
     * @param  array $data
     * @return Marker
     */
    public function create(array $data) : Marker
    {
        $marker = Marker::create($data);

        if (isset($data['port']) && $data['type'] !== 'POLE') {
            $ports = [];
            for ($i = 0; $i < $data['port']; $i++) {
                $ports[] = [
                    'name'   => 'PORT ' . ($i + 1),
                    'status' => true,
                ];
            }

            $marker->ports()->createMany($ports);
        }

        return $marker;
    }

    /**
     * @param  CreateMarkerRequest $request
     * @return Marker
     */
    public function createFromRequest(CreateMarkerRequest $request) : Marker
    {
        return $this->create([
            'name'     => $request->get('name'),
            'port'     => $request->get('port'),
            'type'     => $request->get('type'),
            'address'  => $request->get('address'),
            'location' => new Point($request->get('lng'), $request->get('lat')),
        ]);
    }
}
