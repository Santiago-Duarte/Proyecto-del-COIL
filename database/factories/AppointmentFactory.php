<?php

namespace Database\Factories;

use App\Models\Appointment;
use App\Models\Pet;
use App\Models\Veterinarian;
use Illuminate\Database\Eloquent\Factories\Factory;

class AppointmentFactory extends Factory
{
    protected $model = Appointment::class;

    public function definition(): array
    {
        $reasons = [
            'Annual check-up and vaccinations',
            'Dental cleaning',
            'Skin allergy consultation',
            'Ear infection treatment',
            'Limping/orthopedic evaluation',
            'Vomiting and diarrhea',
            'Spay/neuter surgery',
            'Dental extraction',
            'Eye examination',
            'Heart murmur evaluation',
            'Weight management consultation',
            'Senior wellness exam',
            'Puppy/kitten first visit',
            'Behavioral consultation',
            'Follow-up appointment',
        ];

        $statuses = ['Pending', 'In Consultation', 'Attended'];

        return [
            'pet_id' => Pet::inRandomOrder()->first()?->id ?? Pet::factory(),
            'veterinarian_id' => Veterinarian::inRandomOrder()->first()?->id ?? Veterinarian::factory(),
            'appointment_date' => fake()->dateTimeBetween('-30 days', '+30 days'),
            'reason' => fake()->randomElement($reasons),
            'status' => fake()->randomElement($statuses),
            'notes' => fake()->optional()->paragraph(),
        ];
    }
}
