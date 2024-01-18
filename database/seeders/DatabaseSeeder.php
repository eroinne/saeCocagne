<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\Structures::factory(10)->create();
        \App\Models\Staffs::factory(10)->create();
        \App\Models\TournerLivraison::factory(50)->create();
        \App\Models\Calendriers::factory(50)->create();
        \App\Models\Depots::factory(60)->create();
        \App\Models\Adherents::factory(10)->create();
        \App\Models\Livraisons::factory(1000)->create();
    }
}
