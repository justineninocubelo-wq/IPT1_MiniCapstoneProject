<?php

namespace Database\Factories;

use App\Models\Game;
use Illuminate\Database\Eloquent\Factories\Factory;

class GameFactory extends Factory
{
    protected $model = Game::class;

    public function definition(): array
    {
        return [
            'name' => fake()->unique()->randomElement(['Valorant', 'League of Legends', 'Dota 2', 'Mobile Legends', 'Counter-Strike 2', 'Overwatch 2']),
            'genre' => fake()->randomElement(['FPS', 'MOBA', 'Strategy', 'Battle Royale']),
            'developer' => fake()->company(),
            'publisher' => fake()->company(),
            'platform' => fake()->randomElement(['PC', 'PC / Mobile', 'PC / Console']),
            'max_players' => fake()->numberBetween(5, 100),
            'status' => 'active',
            'description' => fake()->sentence(12),
        ];
    }
}
