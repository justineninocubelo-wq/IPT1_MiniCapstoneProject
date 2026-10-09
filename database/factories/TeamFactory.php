<?php

namespace Database\Factories;

use App\Models\Team;
use Illuminate\Database\Eloquent\Factories\Factory;

class TeamFactory extends Factory
{
    protected $model = Team::class;

    public function definition(): array
    {
        return [
            'name' => fake()->unique()->company() . ' Esports',
            'tag' => strtoupper(fake()->unique()->lexify('???')),
            'captain_name' => fake()->name(),
            'coach_name' => fake()->name(),
            'country' => fake()->country(),
            'founded_year' => fake()->numberBetween(2015, 2026),
            'status' => 'active',
            'description' => fake()->sentence(12),
        ];
    }
}
