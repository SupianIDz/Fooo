<?php

namespace Database\Seeders;

use App\Models\Marker;
use Grimzy\LaravelMysqlSpatial\Types\Point;
use Illuminate\Database\Seeder;

class MarkerSeeder extends Seeder
{
    public function run()
    {
        $this->createPoles();
    }

    /**
     * @return void
     */
    private function createPoles() : void
    {
        $markers = [
            [
                'name'     => 'TIANG #1',
                'location' => new Point(103.60467910766603, -1.5965874638865647),
            ],
            [

                'name'     => 'TIANG #2',
                'location' => new Point(103.58493804931642, -1.6068831220838915),
            ],
            [
                'name'     => 'TIANG #3',
                'location' => new Point(103.61909866333009, -1.6019068937481749),
            ],
            [
                'name'     => 'TIANG #4',
                'location' => new Point(103.63283157348634, -1.6068831220838915),
            ],
            [
                'name'     => 'TIANG #5',
                'location' => new Point(103.6391830444336, -1.6231844746235475),
            ],
            [
                'name'     => 'TIANG #6',
                'location' => new Point(103.63849639892578, -1.6358822792941516),
            ],
            [
                'name'     => 'TIANG #7',
                'location' => new Point(103.60751152038576, -1.6151196112904103),
            ],
            [
                'name'     => 'TIANG #8',
                'location' => new Point(103.60691070556642, -1.6288470190274353),
            ],
            [
                'name'     => 'TIANG #9',
                'location' => new Point(103.58407974243164, -1.644890808234245),
            ],
        ];

        foreach ($markers as $marker) {
            Marker::factory()->create($marker);
        }

        foreach ($markers as $marker) {
            /**
             * @var Marker $odc
             */
            $odc = Marker::factory()->create(array_merge($marker, [
                'type' => Marker::TYPE_ODC,
                'name' => str_replace('TIANG', 'ODC', $marker['name']),
            ]));

            for ($i = 0; $i < 24; $i++) {
                $odc->ports()->create([
                    'name'   => 'Port ' . ($i + 1),
                    'status' => true,
                ]);
            }
        }

        foreach ($markers as $marker) {
            /**
             * @var Marker $odc
             */
            $odc = Marker::factory()->create(array_merge($marker, [
                'type' => Marker::TYPE_JC,
                'name' => str_replace('TIANG', 'JC', $marker['name']),
            ]));

            for ($i = 0; $i < 24; $i++) {
                $odc->ports()->create([
                    'name'   => 'Port ' . ($i + 1),
                    'status' => true,
                ]);
            }
        }

        foreach ($markers as $marker) {
            /**
             * @var Marker $odc
             */
            $odc = Marker::factory()->create(array_merge($marker, [
                'type' => Marker::TYPE_ODP,
                'name' => str_replace('TIANG', 'ODP', $marker['name']),
            ]));

            for ($i = 0; $i < 10; $i++) {
                $odc->ports()->create([
                    'name'   => 'Port ' . ($i + 1),
                    'status' => true,
                ]);
            }
        }
    }
}
