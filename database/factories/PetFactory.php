<?php

namespace Database\Factories;

use App\Models\Owner;
use App\Models\Pet;
use Illuminate\Database\Eloquent\Factories\Factory;

class PetFactory extends Factory
{
    protected $model = Pet::class;

    public function definition(): array
    {
        $species = ['Dog', 'Cat', 'Bird', 'Rabbit', 'Hamster', 'Guinea Pig', 'Ferret', 'Reptile'];
        $dogBreeds = ['Labrador Retriever', 'German Shepherd', 'Golden Retriever', 'Bulldog', 'Beagle', 'Poodle', 'Rottweiler', 'Yorkshire Terrier'];
        $catBreeds = ['Siamese', 'Persian', 'Maine Coon', 'Ragdoll', 'Bengal', 'Sphynx', 'British Shorthair', 'Abyssinian'];
        $birdBreeds = ['Parrot', 'Canary', 'Finch', 'Cockatiel', 'Budgerigar', 'Lovebird'];

        $selectedSpecies = fake()->randomElement($species);
        $breed = match ($selectedSpecies) {
            'Dog' => fake()->randomElement($dogBreeds),
            'Cat' => fake()->randomElement($catBreeds),
            'Bird' => fake()->randomElement($birdBreeds),
            default => null,
        };

        return [
            'name' => fake()->firstName(),
            'species' => $selectedSpecies,
            'breed' => $breed,
            'owner_id' => Owner::inRandomOrder()->first()?->id ?? Owner::factory(),
            'birth_date' => fake()->dateTimeBetween('-15 years', '-6 months'),
            'gender' => fake()->randomElement(['Male', 'Female']),
            'color' => fake()->colorName(),
            'notes' => fake()->optional()->paragraph(),
        ];
    }
}
