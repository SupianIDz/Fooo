<?php

namespace Database\Factories;

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
        $markers = Marker::get();
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
        });
    }
}
