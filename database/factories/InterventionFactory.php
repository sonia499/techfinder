<?php

namespace Database\Factories;

use App\Models\Competence;
use App\Models\Utilisateur;
use Illuminate\Database\Eloquent\Factories\Factory;

class InterventionFactory extends Factory
{
    public function definition(): array
    {
        return [
            'date_int'          => $this->faker->dateTimeBetween('-2 months', 'now'),
            'note_int'          => $this->faker->numberBetween(0, 20),
            'commentaire_int'   => $this->faker->optional(0.7)->sentence(8),
            'code_user_client'  => Utilisateur::where('role_user', 'client')->inRandomOrder()->first()?->code_user,
            'code_user_techn'   => Utilisateur::where('role_user', 'technicien')->inRandomOrder()->first()?->code_user,
            'code_comp'         => Competence::inRandomOrder()->first()?->code_comp,
        ];
    }
}
