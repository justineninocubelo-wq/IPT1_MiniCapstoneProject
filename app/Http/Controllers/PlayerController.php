<?php

namespace App\Http\Controllers;

use App\Models\Player;
use App\Models\Team;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class PlayerController extends Controller
{
    public function index(): View
    {
        return view('players.index', [
            'players' => Player::with('teams')
                ->latest()
                ->paginate(10)
        ]);
    }

    public function create(): View
    {
        return view('players.create', [
            'player' => new Player(),
            'teams' => Team::orderBy('name')->get()
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $this->validated($request);

        $teamIds = $data['team_ids'] ?? [];

        unset(
            $data['team_ids'],
            $data['profile_image']
        );

        if ($request->hasFile('profile_image')) {
            $data['profile_image'] = $request
                ->file('profile_image')
                ->store('player-profiles', 'public');
        }

        $player = Player::create($data);

        $player->teams()->sync(
            $this->pivotData($teamIds)
        );

        return redirect()
            ->route('players.index')
            ->with('success', 'Player created successfully.');
    }

    public function show(Player $player): View
    {
        return view('players.show', [
            'player' => $player->load('teams')
        ]);
    }

    public function edit(Player $player): View
    {
        return view('players.edit', [
            'player' => $player->load('teams'),
            'teams' => Team::orderBy('name')->get()
        ]);
    }

    public function update(
        Request $request,
        Player $player
    ): RedirectResponse {
        $data = $this->validated($request);

        $teamIds = $data['team_ids'] ?? [];

        unset(
            $data['team_ids'],
            $data['profile_image']
        );

        $oldImage = $player->profile_image;

        if ($request->hasFile('profile_image')) {
            $data['profile_image'] = $request
                ->file('profile_image')
                ->store('player-profiles', 'public');
        }

        $player->update($data);

        $player->teams()->sync(
            $this->pivotData($teamIds)
        );

        if (
            isset($data['profile_image']) &&
            $oldImage
        ) {
            Storage::disk('public')->delete($oldImage);
        }

        return redirect()
            ->route('players.index')
            ->with('success', 'Player updated successfully.');
    }

    public function destroy(Player $player): RedirectResponse
    {
        $image = $player->profile_image;

        $player->teams()->detach();
        $player->delete();

        if ($image) {
            Storage::disk('public')->delete($image);
        }

        return redirect()
            ->route('players.index')
            ->with('success', 'Player deleted successfully.');
    }

    private function validated(Request $request): array
    {
        $id = $request->route('player')?->id;

        return $request->validate([
            'gamer_tag' => [
                'required',
                'string',
                'max:50',
                Rule::unique('players', 'gamer_tag')->ignore($id)
            ],
            'full_name' => [
                'required',
                'string',
                'max:120'
            ],
            'email' => [
                'required',
                'email',
                'max:120',
                Rule::unique('players', 'email')->ignore($id)
            ],
            'birth_date' => [
                'nullable',
                'date'
            ],
            'country' => [
                'required',
                'string',
                'max:80'
            ],
            'skill_rating' => [
                'required',
                'integer',
                'min:0',
                'max:5000'
            ],
            'status' => [
                'required',
                'in:active,inactive,banned'
            ],
            'bio' => [
                'nullable',
                'string',
                'max:1000'
            ],
            'team_ids' => [
                'nullable',
                'array'
            ],
            'team_ids.*' => [
                'integer',
                'exists:teams,id'
            ],
            'profile_image' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,gif,webp',
                'max:4096'
            ],
        ]);
    }

    private function pivotData(array $teamIds): array
    {
        $data = [];

        foreach ($teamIds as $teamId) {
            $data[$teamId] = [
                'role' => 'player',
                'joined_at' => now()
            ];
        }

        return $data;
    }
}
