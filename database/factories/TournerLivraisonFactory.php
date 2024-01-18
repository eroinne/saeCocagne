<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class TournerLivraisonFactory extends Factory
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
            'jour_preparation' => fake()->randomElement([ 'lundi', 'mardi', 'mercredi', 'jeudi', 'vendredi' ]),
            'jour_livraison' => fake()->randomElement([ 'lundi', 'mardi', 'mercredi', 'jeudi', 'vendredi' ]),
            'couleur' => fake()->randomElement(['red', 'blue', 'green', 'yellow', 'orange', 'purple', 'pink', 'brown', 'grey', 'black']),
            'point_depots' => fake()->randomElement([ '1;2;3', '4;5;6', '7;8;9', '10;11;12', '13;14;15', '16;17;18', '19;20;21', '22;23;24', '25;26;27', '28;29;30' ]),

        ];
    }
}
