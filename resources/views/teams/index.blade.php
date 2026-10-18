
@extends('layouts.app')

@section('title', 'Teams')

@section('content')

<div class="gtms-page">

    <div class="gtms-page-header">
        <div>
            <div class="gtms-eyebrow">Esports Organizations</div>
            <h1 class="gtms-page-title">Teams</h1>
            <p class="gtms-page-description">
                Explore and manage participating esports teams.
            </p>
        </div>

        <a href="{{ route('teams.create') }}" class="gtms-add-btn">
            + Add Team
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

    @if($teams->count() > 0)

        <div class="gtms-card-grid">

            @foreach($teams as $team)

                <article class="gtms-card">

                    <div class="gtms-card-image">

                        @if($team->banner_image)
                            <img
                                src="{{ asset('storage/' . $team->banner_image) }}"
                                alt="{{ $team->name }} banner"
                                loading="lazy"
                            >
                        @else
                            <div class="gtms-image-placeholder">
                                🛡️
                            </div>
                        @endif

                        <div class="gtms-image-label">
                            {{ $team->tag }}
                        </div>

                    </div>

                    <div class="gtms-card-body">

                        <div class="d-flex justify-content-between align-items-start gap-2">

                            <div>
                                <h2 class="gtms-card-heading">
                                    {{ $team->name }}
                                </h2>

                                <p class="gtms-card-subtitle">
                                    Team {{ $team->tag }}
                                </p>
                            </div>

                            <span class="gtms-status {{ $team->status }}">
                                {{ ucfirst($team->status) }}
                            </span>

                        </div>

                        <div class="gtms-info-grid">

                            <div>
                                <span class="gtms-info-label">Captain</span>
                                <span class="gtms-info-value">
                                    {{ $team->captain_name }}
                                </span>
                            </div>

                            <div>
                                <span class="gtms-info-label">Coach</span>
                                <span class="gtms-info-value">
                                    {{ $team->coach_name ?: '—' }}
                                </span>
                            </div>

                            <div>
                                <span class="gtms-info-label">Country</span>
                                <span class="gtms-info-value">
                                    {{ $team->country }}
                                </span>
                            </div>

                            <div>
                                <span class="gtms-info-label">Players</span>
                                <span class="gtms-info-value">
                                    {{ $team->players_count }}
                                </span>
                            </div>

                            <div>
                                <span class="gtms-info-label">Founded</span>
                                <span class="gtms-info-value">
                                    {{ $team->founded_year ?: '—' }}
                                </span>
                            </div>

                            <div>
                                <span class="gtms-info-label">Team Tag</span>
                                <span class="gtms-info-value">
                                    {{ $team->tag }}
                                </span>
                            </div>

                        </div>

                        <div class="gtms-card-actions">

                            <a href="{{ route('teams.show', $team) }}"
                               class="btn btn-sm btn-outline-secondary">
                                View
                            </a>

                            <a href="{{ route('teams.edit', $team) }}"
                               class="btn btn-sm btn-outline-primary">
                                Edit
                            </a>

                            <x-delete-action
                                :action="route('teams.destroy', $team)"
                                :name="$team->name"
                                type="team"
                                :id="'team'.$team->id"
                            />

                        </div>

                    </div>

                </article>

            @endforeach

        </div>

        <div class="gtms-pagination">
            {{ $teams->links('pagination::bootstrap-5') }}
        </div>

    @else

        <div class="gtms-empty">
            <div style="font-size: 48px; margin-bottom: 12px;">🛡️</div>
            <h3 class="text-white">No Teams Available</h3>
            <p>Create a team to begin organizing players and matches.</p>
            <a href="{{ route('teams.create') }}" class="gtms-add-btn">
                + Add Team
            </a>
        </div>

    @endif

</div>

@endsection
