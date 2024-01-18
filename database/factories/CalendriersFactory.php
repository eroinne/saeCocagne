<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Calendriers>
 */
class CalendriersFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'structures_id' => fake()->numberBetween(1, 10),
            'annee' => fake()->year(),
            'semaines_non_livrable' => fake()->randomElement([ '1', '2', '3', '4', '5', '6', '7', '8', '9', '10' ]),
            'tournee_id' => fake()->numberBetween(1, 50),
        ];
    }
}
