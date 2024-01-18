<?php

namespace Database\Factories;

use App\Models\Adherents;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class AdherentsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'raison_sociale' => fake()->company(),
            'civilite' => fake()->randomElement(['mme', 'mr']),
            'email' => fake()->unique()->safeEmail(),
            'prenom' => fake()->firstName(),
            'ville' => fake()->city(),
            'adresse' => fake()->address(),
            'code_postal' => fake()->postcode(),
            'numero_telephone' => fake()->phoneNumber(),
            'numero_telephone2' => fake()->phoneNumber(),
            'numero_telephone3' => fake()->phoneNumber(),
            'profession' => fake()->jobTitle(),
            'date_naissance' => fake()->date(),
            'structures_id' => fake()->numberBetween(1, 10),
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
