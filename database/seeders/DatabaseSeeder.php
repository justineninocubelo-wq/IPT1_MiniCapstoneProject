<?php

namespace Database\Seeders;

use App\Models\Game;
use App\Models\MatchModel;
use App\Models\Player;
use App\Models\Team;
use App\Models\Tournament;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $games = collect([
            ['name' => 'Valorant', 'genre' => 'FPS', 'developer' => 'Riot Games', 'publisher' => 'Riot Games', 'platform' => 'PC', 'max_players' => 10],
            ['name' => 'League of Legends', 'genre' => 'MOBA', 'developer' => 'Riot Games', 'publisher' => 'Riot Games', 'platform' => 'PC', 'max_players' => 10],
            ['name' => 'Dota 2', 'genre' => 'MOBA', 'developer' => 'Valve', 'publisher' => 'Valve', 'platform' => 'PC', 'max_players' => 10],
            ['name' => 'Mobile Legends', 'genre' => 'MOBA', 'developer' => 'MOONTON', 'publisher' => 'MOONTON', 'platform' => 'Mobile', 'max_players' => 10],
            ['name' => 'Counter-Strike 2', 'genre' => 'FPS', 'developer' => 'Valve', 'publisher' => 'Valve', 'platform' => 'PC', 'max_players' => 10],
        ])->map(fn ($game) => Game::create($game + ['status' => 'active', 'description' => 'Competitive gaming title available for tournament events.']))->keyBy('name');

        $teams = collect([
            ['name' => 'MDC Titans', 'tag' => 'MDCT', 'captain_name' => 'Alex Santos', 'coach_name' => 'Mark Reyes', 'country' => 'Philippines'],
            ['name' => 'Bohol Legends', 'tag' => 'BHOL', 'captain_name' => 'Joshua Cruz', 'coach_name' => 'Daniel Garcia', 'country' => 'Philippines'],
            ['name' => 'Island Warriors', 'tag' => 'ISW', 'captain_name' => 'Kevin Tan', 'coach_name' => 'Miguel Dela Cruz', 'country' => 'Philippines'],
            ['name' => 'Visayas Elite', 'tag' => 'VSEL', 'captain_name' => 'Ryan Lim', 'coach_name' => 'Carlo Flores', 'country' => 'Philippines'],
        ])->map(fn ($team) => Team::create($team + ['founded_year' => 2024, 'status' => 'active', 'description' => 'Competitive esports team.']))->values();

        $players = Player::factory(16)->create();
        foreach ($players->chunk(4) as $index => $chunk) {
            $teams[$index]->players()->attach($chunk->pluck('id')->mapWithKeys(fn ($id, $i) => [$id => [
                'role' => $i === 0 ? 'captain' : 'player',
                'jersey_number' => $i + 1,
                'joined_at' => now()->subDays(30 + $i),
            ]])->all());
        }

        $tournaments = collect([
            ['game' => 'Valorant', 'name' => 'MDC Valorant Championship', 'season' => 'Season 1', 'venue' => 'MDC Activity Center', 'format' => 'single_elimination', 'status' => 'upcoming'],
            ['game' => 'League of Legends', 'name' => 'Bohol LoL Invitational', 'season' => '2026', 'venue' => 'Bohol Esports Arena', 'format' => 'round_robin', 'status' => 'ongoing'],
            ['game' => 'Mobile Legends', 'name' => 'Visayas ML Cup', 'season' => 'Season 3', 'venue' => 'Tagbilaran City Hall', 'format' => 'double_elimination', 'status' => 'completed'],
        ])->map(function ($data, $index) use ($games) {
            return Tournament::create([
                'game_id' => $games[$data['game']]->id,
                'name' => $data['name'],
                'season' => $data['season'],
                'venue' => $data['venue'],
                'start_date' => now()->addDays($index * 7)->toDateString(),
                'end_date' => now()->addDays($index * 7 + 2)->toDateString(),
                'format' => $data['format'],
                'prize_pool' => [25000, 50000, 75000][$index],
                'status' => $data['status'],
                'description' => 'Sample tournament seeded for demonstration and testing.',
            ]);
        });

        foreach ($tournaments as $tournament) {
            for ($i = 0; $i < 3; $i++) {
                $teamA = $teams[$i % $teams->count()];
                $teamB = $teams[($i + 1) % $teams->count()];
                MatchModel::create([
                    'tournament_id' => $tournament->id,
                    'game_id' => $tournament->game_id,
                    'team_a_id' => $teamA->id,
                    'team_b_id' => $teamB->id,
                    'winner_team_id' => $tournament->status === 'completed' ? $teamA->id : null,
                    'round' => ['Quarterfinal', 'Semifinal', 'Final'][$i],
                    'scheduled_at' => now()->addDays($i + 1)->setTime(18 + $i, 0),
                    'team_a_score' => $tournament->status === 'completed' ? 2 : 0,
                    'team_b_score' => $tournament->status === 'completed' ? 1 : 0,
                    'status' => $tournament->status === 'completed' ? 'completed' : 'scheduled',
                    'notes' => null,
                ]);
            }
        }
    }
}
