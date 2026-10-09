<?php

namespace Database\Factories;

use App\Models\Game;
use App\Models\Tournament;
use Illuminate\Database\Eloquent\Factories\Factory;

class TournamentFactory extends Factory
{
    protected $model = Tournament::class;

    public function definition(): array
    {
        $start = fake()->dateTimeBetween('now', '+60 days');
        $end = (clone $start)->modify('+' . fake()->numberBetween(1, 5) . ' days');

        return [
            'game_id' => Game::factory(),
            'name' => fake()->unique()->catchPhrase() . ' Championship',
            'season' => 'Season ' . fake()->numberBetween(1, 10),
            'venue' => fake()->city() . ' Arena',
            'start_date' => $start->format('Y-m-d'),
            'end_date' => $end->format('Y-m-d'),
            'format' => fake()->randomElement(['single_elimination', 'double_elimination', 'round_robin', 'swiss']),
            'prize_pool' => fake()->randomFloat(2, 5000, 500000),
            'status' => 'upcoming',
            'description' => fake()->sentence(15),
        ];
    }
}
