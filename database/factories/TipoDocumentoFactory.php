<?php

namespace Database\Factories;

use App\Models\TipoDocumento;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<TipoDocumento>
 */
class TipoDocumentoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'tipo_documento' => fake()->unique()->words(3, true),
            'abreviatura' => strtoupper(fake()->unique()->lexify('???')),
            'estado' => true,
        ];
    }
}
