
@extends('layouts.app')

@section('title', 'Players')

@section('content')

<div class="gtms-page">

    <div class="gtms-page-header">
        <div>
            <div class="gtms-eyebrow">Player Roster</div>
            <h1 class="gtms-page-title">Players</h1>
            <p class="gtms-page-description">
                Manage esports players, profiles, and team memberships.
            </p>
        </div>

        <a href="{{ route('players.create') }}" class="gtms-add-btn">
            + Add Player
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            {{ session('success') }}
            <button type="button"
                    class="btn-close"
                    data-bs-dismiss="alert"
                    aria-label="Close"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show">
            {{ session('error') }}
            <button type="button"
                    class="btn-close"
                    data-bs-dismiss="alert"
                    aria-label="Close"></button>
        </div>
    @endif

    @if($players->count() > 0)

        <div class="gtms-card-grid">

            @foreach($players as $player)

                <article class="gtms-card">

                    <div class="gtms-player-top"></div>

                    @if($player->profile_image)

                        <img
                            src="{{ asset('storage/' . $player->profile_image) }}"
                            alt="{{ $player->gamer_tag }} profile"
                            class="gtms-player-avatar"
                            loading="lazy"
                        >

                    @else

                        <div class="gtms-player-avatar gtms-avatar-placeholder">
                            👤
                        </div>

                    @endif

                    <div class="gtms-card-body">

                        <div class="d-flex justify-content-between align-items-start gap-2">

                            <div>
                                <h2 class="gtms-card-heading">
                                    {{ $player->gamer_tag }}
                                </h2>

                                <p class="gtms-card-subtitle">
                                    {{ $player->full_name }}
                                </p>
                            </div>

                            <span class="gtms-status {{ $player->status }}">
                                {{ ucfirst($player->status) }}
                            </span>

                        </div>

                        <div class="gtms-info-grid">

                            <div>
                                <span class="gtms-info-label">Country</span>
                                <span class="gtms-info-value">
                                    {{ $player->country }}
                                </span>
                            </div>

                            <div>
                                <span class="gtms-info-label">Skill Rating</span>
                                <span class="gtms-info-value">
                                    {{ number_format($player->skill_rating) }}
                                </span>
                            </div>

                            <div>
                                <span class="gtms-info-label">Teams</span>
                                <span class="gtms-info-value">
                                    {{ $player->teams->pluck('tag')->join(', ') ?: 'Unassigned' }}
                                </span>
                            </div>

                            <div>
                                <span class="gtms-info-label">Date of Birth</span>
                                <span class="gtms-info-value">
                                    {{ $player->birth_date?->format('M d, Y') ?? '—' }}
                                </span>
                            </div>

                        </div>

                        <div class="mt-3">
                            <span class="gtms-info-label">Email Address</span>
                            <span class="gtms-info-value">
                                {{ $player->email }}
                            </span>
                        </div>

                        <div class="gtms-card-actions">

                            <a href="{{ route('players.show', $player) }}"
                               class="btn btn-sm btn-outline-secondary">
                                View
                            </a>

                            <a href="{{ route('players.edit', $player) }}"
                               class="btn btn-sm btn-outline-primary">
                                Edit
                            </a>

                            <x-delete-action
                                :action="route('players.destroy', $player)"
                                :name="$player->gamer_tag"
                                type="player"
                                :id="'player'.$player->id"
                            />

                        </div>

                    </div>

                </article>

            @endforeach

        </div>

        <div class="gtms-pagination">
            {{ $players->links('pagination::bootstrap-5') }}
        </div>

    @else

        <div class="gtms-empty">
            <div style="font-size: 48px; margin-bottom: 12px;">👤</div>
            <h3 class="text-white">No Players Available</h3>
            <p>Register your first esports player to get started.</p>
            <a href="{{ route('players.create') }}" class="gtms-add-btn">
                + Add Player
            </a>
        </div>

    @endif

</div>

@endsection
