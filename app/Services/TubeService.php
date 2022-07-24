<?php

namespace App\Services;

use App\Http\Requests\Tubes\CreateTubeRequest;
use App\Models\Cable;
use App\Models\CableFromOdc;
use App\Models\CableLineFromOdc;
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
        $tube = Tube::create(array_merge($tube, [
            'state' => 1,
        ]));

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
     * @return Tube
     */
    public function updateFromRequest(Tube $tube, Request $request) : Tube
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
            if (isset($cable['uuid'])) {
                $tube->cables()->where('uuid', $cable['uuid'])->update([
                    'name'        => $cable['name'],
                    'color'       => $cable['color'],
                    'weight'      => $cable['weight'],
                    'opacity'     => $cable['opacity'],
                    'description' => $cable['description'],
                ]);

                $this->updateCableLines($cable['uuid'], $cable['lines']);

                return $cable['uuid'];
            } else {
                /**
                 * @var Cable $row
                 */
                $row = $tube->cables()->create([
                    'name'        => $cable['name'],
                    'color'       => $cable['color'],
                    'weight'      => $cable['weight'],
                    'opacity'     => $cable['opacity'],
                    'description' => $cable['description'],
                ]);

                $this->updateCableLines($row->uuid, $cable['lines']);

                return $row->uuid;
            }
        });

        // delete cables that are not in the uuid list
        $tube->cables()->whereNotIn('uuid', $cablesUUID)->delete();

        if ($cablesUUID->count() > 0) {
//            $tube->update([
//                'state' => 1,
//            ]);
        }

        // ODCS
        if ($request->has('cableAttachedToODC')) {
            collect($request->get('cableAttachedToODC'))->each(function ($cableLine) use ($tube) {
                collect($cableLine['odcs'])->each(function (array $odc) use ($cableLine) {
                    CableFromOdc::create([
                        'name'          => $odc['name'],
                        'description'   => $odc['description'],
                        'color'         => $odc['color'],
                        'weight'        => $odc['weight'],
                        'opacity'       => $odc['opacity'],
                        'cable_line_id' => $cableLine['id'],
                    ]);
                });
            });
        }

        return $tube;
    }

    /**
     * @param  string $uuid
     * @param  array  $lines
     * @return void
     */
    protected function updateCableLines(string $uuid, array $lines) : void
    {
        $cable = Cable::where('uuid', $uuid)->first();

        $cableLinesUUID = collect($lines)->map(function ($line) use ($cable) {
            if (isset($line['uuid'])) {
                $cable->lines()->where('uuid', $line['uuid'])->update([
                    'name'        => $line['name'],
                    'lat'         => $line['coordinates'][0],
                    'lng'         => $line['coordinates'][1],
                    'attached_on' => $line['manual'] ? null : $line['marker'],
                ]);

                return $line['uuid'];
            } else {
                $row = $cable->lines()->create(array_merge($line, [
                    'name'        => $line['name'],
                    'lat'         => $line['coordinates'][0],
                    'lng'         => $line['coordinates'][1],
                    'attached_on' => $line['manual'] ? null : $line['marker'],
                ]));

                return $row->uuid;
            }
        });

        // delete lines that are not in the uuid list
        $cable->lines()->whereNotIn('uuid', $cableLinesUUID)->delete();
    }
}
