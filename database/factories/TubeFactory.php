<?php

namespace Database\Factories;

use App\Models\Cable;
use App\Models\Marker;
use App\Models\Tube;
use Illuminate\Database\Eloquent\Factories\Factory;

class TubeFactory extends Factory
{
    protected $model = Tube::class;

    /**
     * @return array
     */
    public function definition() : array
    {
        return [
            'name'        => 'TUBE #',
            'description' => $this->faker->text(),
            'color'       => strtoupper($this->faker->hexColor()),
            'weight'      => 40,
        ];
    }

    /**
     * @return $this
     */
    public function configure() : self
    {
        $markers = Marker::whereType(Marker::TYPE_POLE)->get();
        return $this->afterCreating(function (Tube $tube) use ($markers) {
            $tube->update([
                'name' => $tube->name . $tube->id,
            ]);

            foreach ($markers as $marker) {
                $tube->lines()->create([
                    'address'     => $this->faker->address(),
                    'lat'         => $marker->location->getLat(),
                    'lng'         => $marker->location->getLng(),
                    'attached_on' => $marker->id,
                ]);
            }

            for ($i = 0; $i < 3; $i++) {
                /**
                 * @var Cable $cable
                 */
                $cable = $tube->cables()->create([
                    'name'        => 'Kabel ' . ($i + 1),
                    'color'       => sprintf('#%06X', mt_rand(0, 0xFFFFFF)),
                    'weight'      => 5,
                    'opacity'     => 0.7,
                    'description' => 'Cable ' . ($i + 1),
                ]);

                foreach ($markers as $index => $marker) {
                    $cable->lines()->create([
                        'name'        => 'Jalur Kabel ' . ($i + 1) . ' #' . ($index + 1),
                        'lat'         => $marker->location->getLat(),
                        'lng'         => $marker->location->getLng(),
                        'attached_on' => $marker->id,
                    ]);
                }
            }
        });
    }
}
