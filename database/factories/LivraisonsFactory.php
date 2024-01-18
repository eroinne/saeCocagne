<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Livraisons>
 */
class LivraisonsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'jour' => fake()->randomElement([ 'lundi', 'mardi', 'mercredi', 'jeudi', 'vendredi' ]),
            'mois' => fake()->randomElement([1,2,3,4,5,6,7,8,9,10,11,12]),
            'date' => fake()->date(),
            'numero_semaine' => fake()->randomElement([1,2,3,4,5,6,7,8,9,10,11,12]),
            'calendriers_id' => fake()->numberBetween(2, 31),
        ];
    }
}
