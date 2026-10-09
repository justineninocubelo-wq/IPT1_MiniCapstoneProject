<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\Tournament;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class TournamentController extends Controller
{
    public function index(): View
    {
        return view('tournaments.index', ['tournaments' => Tournament::with(['game'])->withCount('matches')->latest()->paginate(10)]);
    }

    public function create(): View
    {
        return view('tournaments.create', ['tournament' => new Tournament(), 'games' => Game::where('status', 'active')->orderBy('name')->get()]);
    }

    public function store(Request $request): RedirectResponse
    {
        Tournament::create($this->validated($request));
        return redirect()->route('tournaments.index')->with('success', 'Tournament created successfully.');
    }

    public function show(Tournament $tournament): View
    {
        return view('tournaments.show', ['tournament' => $tournament->load(['game', 'matches.teamA', 'matches.teamB', 'matches.winner'])]);
    }

    public function edit(Tournament $tournament): View
    {
        return view('tournaments.edit', ['tournament' => $tournament, 'games' => Game::orderBy('name')->get()]);
    }

    public function update(Request $request, Tournament $tournament): RedirectResponse
    {
        $tournament->update($this->validated($request));
        return redirect()->route('tournaments.index')->with('success', 'Tournament updated successfully.');
    }

    public function destroy(Tournament $tournament): RedirectResponse
    {
        if ($tournament->matches()->exists()) {
            return back()->with('error', 'Cannot delete a tournament that has matches.');
        }
        $tournament->delete();
        return redirect()->route('tournaments.index')->with('success', 'Tournament deleted successfully.');
    }

    private function validated(Request $request): array
    {
        return $request->validate([
            'game_id' => ['required', 'exists:games,id'],
            'name' => ['required', 'string', 'max:150'],
            'season' => ['required', 'string', 'max:50'],
            'venue' => ['required', 'string', 'max:150'],
            'start_date' => ['required', 'date'],
            'end_date' => ['required', 'date', 'after_or_equal:start_date'],
            'format' => ['required', 'in:single_elimination,double_elimination,round_robin,swiss'],
            'prize_pool' => ['required', 'numeric', 'min:0'],
            'status' => ['required', 'in:upcoming,ongoing,completed,cancelled'],
            'description' => ['nullable', 'string', 'max:1200'],
        ]);
    }
}
