<?php

namespace App\Http\Controllers;

use App\Models\Game;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Validation\Rule;

class GameController extends Controller
{
    public function index(): View
    {
        return view('games.index', ['games' => Game::withCount(['tournaments', 'matches'])->latest()->paginate(10)]);
    }

    public function create(): View
    {
        return view('games.create', ['game' => new Game()]);
    }

    public function store(Request $request): RedirectResponse
    {
        Game::create($this->validated($request));
        return redirect()->route('games.index')->with('success', 'Game created successfully.');
    }

    public function show(Game $game): View
    {
        return view('games.show', ['game' => $game->load(['tournaments', 'matches'])]);
    }

    public function edit(Game $game): View
    {
        return view('games.edit', ['game' => $game]);
    }

    public function update(Request $request, Game $game): RedirectResponse
    {
        $game->update($this->validated($request));
        return redirect()->route('games.index')->with('success', 'Game updated successfully.');
    }

    public function destroy(Game $game): RedirectResponse
    {
        if ($game->tournaments()->exists() || $game->matches()->exists()) {
            return back()->with('error', 'Cannot delete a game that is linked to tournaments or matches.');
        }
        $game->delete();
        return redirect()->route('games.index')->with('success', 'Game deleted successfully.');
    }

    private function validated(Request $request): array
    {
        $id = $request->route('game')?->id;
        return $request->validate([
            'name' => ['required', 'string', 'max:100', Rule::unique('games', 'name')->ignore($id)],
            'genre' => ['required', 'string', 'max:60'],
            'developer' => ['required', 'string', 'max:100'],
            'publisher' => ['nullable', 'string', 'max:100'],
            'platform' => ['required', 'string', 'max:100'],
            'max_players' => ['required', 'integer', 'min:2', 'max:500'],
            'status' => ['required', 'in:active,inactive'],
            'description' => ['nullable', 'string', 'max:1000'],
        ]);
    }
}
