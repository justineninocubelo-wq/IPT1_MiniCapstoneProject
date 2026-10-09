<?php

namespace Database\Factories;

use App\Models\Game;
use App\Models\MatchModel;
use App\Models\Team;
use App\Models\Tournament;
use Illuminate\Database\Eloquent\Factories\Factory;

class MatchModelFactory extends Factory
{
    protected $model = MatchModel::class;

    public function definition(): array
    {
        $teams = Team::query()->pluck('id')->all();
        $a = $teams[0] ?? Team::factory()->create()->id;
        $b = $teams[1] ?? Team::factory()->create()->id;
        $tournament = Tournament::query()->inRandomOrder()->first() ?? Tournament::factory()->create();

        return [
            'tournament_id' => $tournament->id,
            'game_id' => $tournament->game_id,
            'team_a_id' => $a,
            'team_b_id' => $b,
            'winner_team_id' => null,
            'round' => fake()->randomElement(['Quarterfinal', 'Semifinal', 'Final', 'Group Stage']),
            'scheduled_at' => fake()->dateTimeBetween('now', '+30 days'),
            'team_a_score' => 0,
            'team_b_score' => 0,
            'status' => 'scheduled',
            'notes' => null,
        ];
    }
}
