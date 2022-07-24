<?php

namespace App\Services;

use App\Http\Requests\Tubes\CreateTubeRequest;
use App\Models\Cable;
use App\Models\Tube;
use Illuminate\Http\Request;

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

        for ($i = 0; $i < 3; $i++) {
            /**
             * @var Cable $cable
             */
            $cable = $tube->cables()->create([
                'name'        => 'Kabel ' . ($i + 1),
                'color'       => '#' . dechex(rand(0, 0xFFFFFF)),
                'weight'      => 5,
                'opacity'     => 0.7,
                'description' => 'Cable ' . ($i + 1),
            ]);

            foreach ($lines as $index => $line) {
                $cable->lines()->create(array_merge($line, [
                    'name'        => 'Jalur Kabel ' . ($i + 1) . ' #' . ($index + 1),
                    'lat'         => $line['coordinates'][0],
                    'lng'         => $line['coordinates'][1],
                    'attached_on' => $line['manual'] ? null : $line['marker'],
                ]));
            }
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

    /**
     * @param  Tube    $tube
     * @param  Request $request
     * @return void
     */
    public function updateFromRequest(Tube $tube, Request $request)
    {
        $tube->update($request->get('detail'));

        $tube->lines->each(function ($line) use ($request) {
            $line->delete();
        });

        foreach ($request->get('lines') as $line) {
            $tube->lines()->create(array_merge($line, [
                'lat'         => $line['coordinates'][0],
                'lng'         => $line['coordinates'][1],
                'attached_on' => $line['manual'] ? null : $line['marker'],
            ]));
        }

        $cablesUUID = collect($request->get('cables'))->map(function ($cable) use ($tube) {
            if (isset($tube['uuid'])) {
                $tube->cables()->where('uuid', $cable['uuid'])->update([
                    'name'        => $cable['name'],
                    'color'       => $cable['color'],
                    'weight'      => $cable['weight'],
                    'opacity'     => $cable['opacity'],
                    'description' => $cable['description'],
                ]);

                return $cable['uuid'];
            } else {
                $tube = $tube->cables()->create([
                    'name'        => $cable['name'],
                    'color'       => $cable['color'],
                    'weight'      => $cable['weight'],
                    'opacity'     => $cable['opacity'],
                    'description' => $cable['description'],
                ]);

                return $tube->uuid;
            }
        });

        // delete cables that are not in the uuid list
        $tube->cables()->whereNotIn('uuid', $cablesUUID)->delete();
    }
}
