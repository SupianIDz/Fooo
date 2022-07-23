<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class MarkerFactory extends Factory
{

    /**
     * @return array
     */
    public function definition() : array
    {
        return [
            'address' => $this->faker->streetAddress(),
        ];
    }
}
