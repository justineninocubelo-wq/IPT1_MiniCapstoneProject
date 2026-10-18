<?php

namespace App\Http\Controllers;

use App\Models\Team;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class TeamController extends Controller
{
    public function index(): View
    {
        return view('teams.index', [
            'teams' => Team::withCount('players')
                ->latest()
                ->paginate(10)
        ]);
    }

    public function create(): View
    {
        return view('teams.create', [
            'team' => new Team()
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $this->validated($request);

        unset($data['banner_image']);

        if ($request->hasFile('banner_image')) {
            $data['banner_image'] = $request
                ->file('banner_image')
                ->store('team-banners', 'public');
        }

        Team::create($data);

        return redirect()
            ->route('teams.index')
            ->with('success', 'Team created successfully.');
    }

    public function show(Team $team): View
    {
        return view('teams.show', [
            'team' => $team->load('players')
        ]);
    }

    public function edit(Team $team): View
    {
        return view('teams.edit', compact('team'));
    }

    public function update(
        Request $request,
        Team $team
    ): RedirectResponse {
        $data = $this->validated($request, $team);

        unset($data['banner_image']);

        $oldBanner = $team->banner_image;

        if ($request->hasFile('banner_image')) {
            $data['banner_image'] = $request
                ->file('banner_image')
                ->store('team-banners', 'public');
        }

        $team->update($data);

        if (
            isset($data['banner_image']) &&
            $oldBanner
        ) {
            Storage::disk('public')->delete($oldBanner);
        }

        return redirect()
            ->route('teams.index')
            ->with('success', 'Team updated successfully.');
    }

    public function destroy(Team $team): RedirectResponse
    {
        if (
            $team->matchesAsTeamA()->exists() ||
            $team->matchesAsTeamB()->exists() ||
            $team->wonMatches()->exists()
        ) {
            return back()->with(
                'error',
                'Cannot delete a team linked to existing matches.'
            );
        }

        $banner = $team->banner_image;

        $team->players()->detach();
        $team->delete();

        if ($banner) {
            Storage::disk('public')->delete($banner);
        }

        return redirect()
            ->route('teams.index')
            ->with('success', 'Team deleted successfully.');
    }

    private function validated(
        Request $request,
        ?Team $team = null
    ): array {
        $id = $team?->id;

        return $request->validate([
            'name' => [
                'required',
                'string',
                'max:100',
                Rule::unique('teams', 'name')->ignore($id)
            ],
            'tag' => [
                'required',
                'string',
                'max:10',
                Rule::unique('teams', 'tag')->ignore($id)
            ],
            'captain_name' => [
                'required',
                'string',
                'max:120'
            ],
            'coach_name' => [
                'nullable',
                'string',
                'max:120'
            ],
            'country' => [
                'required',
                'string',
                'max:80'
            ],
            'founded_year' => [
                'nullable',
                'integer',
                'min:1990',
                'max:' . date('Y')
            ],
            'status' => [
                'required',
                'in:active,inactive,disbanded'
            ],
            'description' => [
                'nullable',
                'string',
                'max:1000'
            ],
            'banner_image' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,gif,webp',
                'max:4096'
            ],
        ]);
    }
}