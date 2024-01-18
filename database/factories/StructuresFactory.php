<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Structures>
 */
class StructuresFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nom' => fake()->company(),
            'zone' => fake()->randomElement([ 'alsace-moselle', 'guadeloupe', 'guyane', 'la-reunion', 'martinique', 'mayotte', 'metropole', 'nouvelle-caledonie', 'polynesie-francaise', 'saint-barthelemy', 'saint-martin', 'saint-pierre-et-miquelon', 'wallis-et-futuna' ]),
            'ville' => fake()->city(),
            'raison_sociale' => fake()->company(),
            'siege_social' => fake()->address(),
            'adresse_gestion' => fake()->address(),
            'telephone' => fake()->phoneNumber(),
            'mail' => fake()->unique()->safeEmail(),
            'nom_referent' => fake()->name(),
            'site_web' => fake()->url(),
        ];
    }
}
