<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class SpaceshipFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {

        return [
            'name' => $this->faker->company(),
            'class' => $this->faker->name(),
            'crew' => $this->faker->numberBetween(10, 500),
            'image' => $this->faker->imageUrl(640, 480),
            'value' => $this->faker->randomFloat(2, 0, 10000),
            'status' => $this->faker->randomElement(['Operational','Damaged']),
        ];

    }
}
