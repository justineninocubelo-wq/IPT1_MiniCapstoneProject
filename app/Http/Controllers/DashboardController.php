<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\MatchModel;
use App\Models\Player;
use App\Models\Team;
use App\Models\Tournament;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        return view('dashboard.index', [
            'players' => Player::count(),
            'teams' => Team::count(),
            'games' => Game::count(),
            'tournaments' => Tournament::count(),
            'matches' => MatchModel::count(),
            'upcomingMatches' => MatchModel::with(['tournament', 'teamA', 'teamB'])
                ->where('status', 'scheduled')
                ->orderBy('scheduled_at')
                ->take(5)
                ->get(),
        ]);
    }
}
