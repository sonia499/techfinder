<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

class UtilisateurFactory extends Factory
{
    public function definition(): array
    {
        return [
            'code_user'     => $this->faker->unique()->bothify('USR####'),
            'nom_user'      => $this->faker->lastName(),
            'prenom_user'   => $this->faker->firstName(),
            'login_user'    => $this->faker->unique()->userName(),
            'password_user' => Hash::make('password'),
            'tel_user'      => $this->faker->phoneNumber(),
            'sexe_user'     => $this->faker->randomElement(['M', 'F']),
            'role_user'     => $this->faker->randomElement(['admin', 'technicien', 'client']),
            'etat_user'     => $this->faker->randomElement(['actif', 'inactif', 'bloque']),
        ];
    }
}
