<?php

namespace Database\Factories;

use App\Models\Veterinarian;
use Illuminate\Database\Eloquent\Factories\Factory;

class VeterinarianFactory extends Factory
{
    protected $model = Veterinarian::class;

    public function definition(): array
    {
        $specialties = [
            'General Practice',
            'Surgery',
            'Cardiology',
            'Dermatology',
            'Ophthalmology',
            'Dentistry',
            'Orthopedics',
            'Neurology',
            'Oncology',
            'Emergency & Critical Care',
        ];

        return [
            'name' => 'Dr. '.fake()->name(),
            'specialty' => fake()->randomElement($specialties),
            'phone' => fake()->phoneNumber(),
            'email' => fake()->unique()->safeEmail(),
            'is_active' => true,
        ];
    }
}
