<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CompetenceFactory extends Factory
{
    public function definition(): array
    {
        return [
            'label_comp'       => $this->faker->unique()->words(2, true),
            'description_comp' => $this->faker->sentence(12),
        ];
    }
}
