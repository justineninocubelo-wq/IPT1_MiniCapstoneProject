<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\MatchModel;
use App\Models\Team;
use App\Models\Tournament;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class MatchController extends Controller
{
    public function index(): View
    {
        return view('matches.index', [
            'matches' => MatchModel::with([
                'tournament',
                'game',
                'teamA',
                'teamB',
                'winner'
            ])
            ->latest('scheduled_at')
            ->paginate(10)
        ]);
    }

    public function create(): View
    {
        return view('matches.create', [
            'match' => new MatchModel(),
            'tournaments' => Tournament::with('game')
                ->orderBy('start_date')
                ->get(),
            'games' => Game::orderBy('name')->get(),
            'teams' => Team::where('status', 'active')
                ->orderBy('name')
                ->get(),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        MatchModel::create($this->validated($request));

        return redirect()
            ->route('matches.index')
            ->with('success', 'Match created successfully.');
    }

    public function show(MatchModel $match): View
    {
        return view('matches.show', [
            'match' => $match->load([
                'tournament',
                'game',
                'teamA',
                'teamB',
                'winner'
            ])
        ]);
    }

    public function edit(MatchModel $match): View
    {
        return view('matches.edit', [
            'match' => $match,
            'tournaments' => Tournament::with('game')
                ->orderBy('start_date')
                ->get(),
            'games' => Game::orderBy('name')->get(),
            'teams' => Team::where('status', 'active')
                ->orderBy('name')
                ->get(),
        ]);
    }

    public function update(
        Request $request,
        MatchModel $match
    ): RedirectResponse {
        $match->update($this->validated($request, $match));

        return redirect()
            ->route('matches.index')
            ->with('success', 'Match updated successfully.');
    }

    public function destroy(MatchModel $match): RedirectResponse
    {
        $match->delete();

        return redirect()
            ->route('matches.index')
            ->with('success', 'Match deleted successfully.');
    }

    private function validated(
        Request $request,
        ?MatchModel $match = null
    ): array {
        $data = $request->validate([
            'tournament_id' => [
                'required',
                'exists:tournaments,id'
            ],
            'game_id' => [
                'required',
                'exists:games,id'
            ],
            'team_a_id' => [
                'required',
                'exists:teams,id',
                'different:team_b_id'
            ],
            'team_b_id' => [
                'required',
                'exists:teams,id'
            ],
            'winner_team_id' => [
                'nullable',
                'exists:teams,id'
            ],
            'round' => [
                'required',
                'string',
                'max:50'
            ],
            'scheduled_at' => [
                'required',
                'date'
            ],
            'team_a_score' => [
                'required',
                'integer',
                'min:0'
            ],
            'team_b_score' => [
                'required',
                'integer',
                'min:0'
            ],
            'status' => [
                'required',
                'in:scheduled,live,completed,postponed,cancelled'
            ],
            'notes' => [
                'nullable',
                'string',
                'max:1000'
            ],
        ]);

        if (
            $data['winner_team_id'] &&
            !in_array(
                (int) $data['winner_team_id'],
                [
                    (int) $data['team_a_id'],
                    (int) $data['team_b_id']
                ],
                true
            )
        ) {
            abort(
                422,
                'Winner must be one of the two participating teams.'
            );
        }

        return $data;
    }

    // Display scheduled and live matches for normal users
    public function upcoming(): View
    {
        $matches = MatchModel::with([
            'tournament',
            'game',
            'teamA',
            'teamB',
            'winner'
        ])
        ->whereIn('status', ['scheduled', 'live'])
        ->orderBy('scheduled_at', 'asc')
        ->get();

        return view('matches.upcoming', compact('matches'));
    }
}
