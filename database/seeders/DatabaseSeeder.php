<?php

namespace Database\Seeders;

use App\Models\Appointment;
use App\Models\Owner;
use App\Models\Pet;
use App\Models\Veterinarian;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create owners
        Owner::factory(15)->create();

        // Create veterinarians
        Veterinarian::factory(5)->create();

        // Create pets
        Pet::factory(30)->create();

        // Create appointments
        Appointment::factory(50)->create();
    }
}
