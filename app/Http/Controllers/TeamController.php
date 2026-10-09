<?php

namespace App\Http\Controllers;

use App\Models\Player;
use App\Models\Team;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Validation\Rule;

class TeamController extends Controller
{
    public function index(): View
    {
        return view('teams.index', ['teams' => Team::withCount('players')->latest()->paginate(10)]);
    }

    public function create(): View
    {
        return view('teams.create', ['team' => new Team()]);
    }

    public function store(Request $request): RedirectResponse
    {
        Team::create($this->validated($request));
        return redirect()->route('teams.index')->with('success', 'Team created successfully.');
    }

    public function show(Team $team): View
    {
        return view('teams.show', ['team' => $team->load('players')]);
    }

    public function edit(Team $team): View
    {
        return view('teams.edit', ['team' => $team]);
    }

    public function update(Request $request, Team $team): RedirectResponse
    {
        $team->update($this->validated($request, $team));
        return redirect()->route('teams.index')->with('success', 'Team updated successfully.');
    }

    public function destroy(Team $team): RedirectResponse
    {
        $team->players()->detach();
        $team->delete();
        return redirect()->route('teams.index')->with('success', 'Team deleted successfully.');
    }

    private function validated(Request $request, ?Team $team = null): array
    {
        $id = $team?->id;
        return $request->validate([
            'name' => ['required', 'string', 'max:100', Rule::unique('teams', 'name')->ignore($id)],
            'tag' => ['required', 'string', 'max:10', Rule::unique('teams', 'tag')->ignore($id)],
            'captain_name' => ['required', 'string', 'max:120'],
            'coach_name' => ['nullable', 'string', 'max:120'],
            'country' => ['required', 'string', 'max:80'],
            'founded_year' => ['nullable', 'integer', 'min:1990', 'max:' . date('Y')],
            'status' => ['required', 'in:active,inactive,disbanded'],
            'description' => ['nullable', 'string', 'max:1000'],
        ]);
    }
}
