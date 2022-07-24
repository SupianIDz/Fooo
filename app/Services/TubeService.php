<?php

namespace App\Services;

use App\Http\Requests\Tubes\CreateTubeRequest;
use App\Models\Cable;
use App\Models\CableFromOdc;
use App\Models\CableFromOdcLine;
use App\Models\CableLineFromOdc;
use App\Models\JoinClosureCable;
use App\Models\Port;
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
            $tube->update([
                'state' => 2,
            ]);
        }

        // ODCS
        if ($request->has('cableAttachedToODC')) {
            collect($request->get('cableAttachedToODC'))->each(function ($cableLine) use ($tube) {
                $odcUUIDs = collect($cableLine['odcs'])->map(function (array $odc) use ($cableLine) {
                    if (! isset($odc['uuid'])) {
                        $odcModel = CableFromOdc::create([
                            'name'          => $odc['name'],
                            'description'   => $odc['description'],
                            'color'         => $odc['color'],
                            'weight'        => $odc['weight'],
                            'opacity'       => $odc['opacity'],
                            'cable_line_id' => $cableLine['id'],
                            'port_id'       => $odc['port'],
                        ]);
                    } else {
                        $odcModel = CableFromOdc::where('uuid', $odc['uuid'])->first();

                        $odcModel->update([
                            'name'          => $odc['name'],
                            'description'   => $odc['description'],
                            'color'         => $odc['color'],
                            'weight'        => $odc['weight'],
                            'opacity'       => $odc['opacity'],
                            'cable_line_id' => $cableLine['id'],
                            'port_id'       => $odc['port'],
                        ]);
                    }

                    Port::whereId($odc['port'])->update([
                        'status' => false,
                    ]);

                    $odcLinesUUID = collect($odc['lines'])->map(function ($line) use ($odcModel) {
                        if (! isset($line['uuid'])) {
                            $x = $odcModel->lines()->create(array_merge($line, [
                                'name'        => $line['name'],
                                'lat'         => $line['coordinates'][0],
                                'lng'         => $line['coordinates'][1],
                                'attached_on' => $line['manual'] ? null : $line['marker'],
                            ]));

                            return $x->uuid;
                        } else {
                            $odcModel->lines()->where('uuid', $line['uuid'])->update([
                                'name'        => $line['name'],
                                'lat'         => $line['coordinates'][0],
                                'lng'         => $line['coordinates'][1],
                                'attached_on' => $line['manual'] ? null : $line['marker'],
                            ]);

                            return $line['uuid'];
                        }
                    });

                    // delete lines that are not in the uuid list
                    $odcModel->lines()->whereNotIn('uuid', $odcLinesUUID)->delete();

                    return $odcModel->uuid;
                });

                // delete cables that are not in the uuid list
                CableFromOdc::whereNotIn('uuid', $odcUUIDs)->get()->each(function (CableFromOdc $row) {
                    Port::whereId($row->port_id)->update([
                        'status' => true,
                    ]);

                    $row->lines->each(function (CableFromOdcLine $line) {
                        $line->delete();
                    });
                });
            });

            $tube->update([
                'state' => 3,
            ]);
        }

        if ($request->has('odcCableAttachToJC')) {
            $this->updateODCCableAttachToJC($request->get('odcCableAttachToJC'));
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

    protected function updateODCCableAttachToJC(array $data)
    {
        collect($data)->map(function ($row) {
            $lineODC = CableFromOdcLine::where('uuid', $row['uuid'])->first();

            $jcUUIDS = collect($row['jcs'])->map(function ($jc) use ($lineODC) {
                if (! isset($jc['uuid'])) {
                    $jcModel = JoinClosureCable::create(array_merge($jc, [
                        'cable_from_odc_line_id' => $lineODC->id,
                        'port_id'                => $jc['port'],
                    ]));
                } else {
                    $jcModel = JoinClosureCable::where('uuid', $jc['uuid'])->first();

                    $jcModel->update([
                        'name'          => $jc['name'],
                        'description'   => $jc['description'],
                        'color'         => $jc['color'],
                        'weight'        => $jc['weight'],
                        'opacity'       => $jc['opacity'],
                        'cable_line_id' => $lineODC->id,
                        'port_id'       => $jc['port'],
                    ]);
                }

                $jcLinesUUID = collect($jc['lines'])->map(function ($line) use ($jcModel) {
                    if (! isset($line['uuid'])) {
                        $q = $jcModel->lines()->create(array_merge($line, [
                            'name'        => $line['name'],
                            'lat'         => $line['coordinates'][0],
                            'lng'         => $line['coordinates'][1],
                            'attached_on' => $line['manual'] ? null : $line['marker'],
                        ]));
                    } else {
                        $q = $jcModel->lines()->where('uuid', $line['uuid'])->first();

                        $q->update([
                            'name'        => $line['name'],
                            'lat'         => $line['coordinates'][0],
                            'lng'         => $line['coordinates'][1],
                            'attached_on' => $line['manual'] ? null : $line['marker'],
                        ]);
                    }

                    return $q->uuid;
                });

                // delete lines that are not in the uuid list
                $jcModel->lines()->whereNotIn('uuid', $jcLinesUUID)->delete();

                return $jcModel->uuid;
            });

            // delete jcs that are not in the uuid list
            JoinClosureCable::whereNotIn('uuid', $jcUUIDS)->delete();
        });
    }
}
