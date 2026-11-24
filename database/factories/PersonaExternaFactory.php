<?php

namespace Database\Factories;

use App\Models\PersonaExterna;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<PersonaExterna>
 */
class PersonaExternaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nombre' => fake()->firstName(),
            'apellidos' => fake()->lastName(),
            'email' => fake()->unique()->safeEmail(),
            'celular' => fake()->numerify('3#########'),
        ];
    }
}
