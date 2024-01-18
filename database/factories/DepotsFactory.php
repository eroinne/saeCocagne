<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class DepotsFactory extends Factory
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
            'nom' => fake()->name(),
            'ville' => fake()->city(),
            'adresse' => fake()->address(),
            'code_postal' => fake()->postcode(),
            'telephone' => fake()->phoneNumber(),
            'mail' => fake()->unique()->safeEmail(),
            'siteWeb' => fake()->url(),
            'mail_referent' => fake()->unique()->safeEmail(),
            'telephone_referent' => fake()->phoneNumber(),
            'jour_livraison' => fake()->randomElement([ 'lundi', 'mardi', 'mercredi', 'jeudi', 'vendredi' ]),
            'heure_livraison' => fake()->time(),
            'heure_paniers' => fake()->time(),
            'text_presentation' => fake()->text(),
            'commentaire' => fake()->text(),
        ];
    }
}
