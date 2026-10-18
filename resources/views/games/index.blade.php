
@extends('layouts.app')

@section('title', 'Games')

@section('content')

<div class="gtms-page">

    <div class="gtms-page-header">
        <div>
            <div class="gtms-eyebrow">Game Library</div>
            <h1 class="gtms-page-title">Games</h1>
            <p class="gtms-page-description">
                Manage competitive gaming titles and tournaments.
            </p>
        </div>

        <a href="{{ route('games.create') }}" class="gtms-add-btn">
            + Add Game
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

    @if($games->count() > 0)

        <div class="gtms-card-grid">

            @foreach($games as $game)

                <article class="gtms-card">

                    <div class="gtms-card-image">

                        @if($game->image)
                            <img
                                src="{{ asset('storage/' . $game->image) }}"
                                alt="{{ $game->name }} wallpaper"
                                loading="lazy"
                            >
                        @else
                            <div class="gtms-image-placeholder">
                                🎮
                            </div>
                        @endif

                        <div class="gtms-image-label">
                            {{ $game->name }}
                        </div>

                    </div>

                    <div class="gtms-card-body">

                        <div class="d-flex justify-content-between align-items-start gap-2">

                            <div>
                                <h2 class="gtms-card-heading">
                                    {{ $game->name }}
                                </h2>

                                <p class="gtms-card-subtitle">
                                    {{ $game->genre }}
                                </p>
                            </div>

                            <span class="gtms-status {{ $game->status }}">
                                {{ ucfirst($game->status) }}
                            </span>

                        </div>

                        <div class="gtms-info-grid">

                            <div>
                                <span class="gtms-info-label">Developer</span>
                                <span class="gtms-info-value">
                                    {{ $game->developer }}
                                </span>
                            </div>

                            <div>
                                <span class="gtms-info-label">Platform</span>
                                <span class="gtms-info-value">
                                    {{ $game->platform }}
                                </span>
                            </div>

                            <div>
                                <span class="gtms-info-label">Max Players</span>
                                <span class="gtms-info-value">
                                    {{ $game->max_players }}
                                </span>
                            </div>

                            <div>
                                <span class="gtms-info-label">Publisher</span>
                                <span class="gtms-info-value">
                                    {{ $game->publisher ?: '—' }}
                                </span>
                            </div>

                            <div>
                                <span class="gtms-info-label">Tournaments</span>
                                <span class="gtms-info-value">
                                    {{ $game->tournaments_count }}
                                </span>
                            </div>

                            <div>
                                <span class="gtms-info-label">Matches</span>
                                <span class="gtms-info-value">
                                    {{ $game->matches_count }}
                                </span>
                            </div>

                        </div>

                        <div class="gtms-card-actions">

                            <a href="{{ route('games.show', $game) }}"
                               class="btn btn-sm btn-outline-secondary">
                                View
                            </a>

                            <a href="{{ route('games.edit', $game) }}"
                               class="btn btn-sm btn-outline-primary">
                                Edit
                            </a>

                            <x-delete-action
                                :action="route('games.destroy', $game)"
                                :name="$game->name"
                                type="game"
                                :id="'game'.$game->id"
                            />

                        </div>

                    </div>

                </article>

            @endforeach

        </div>

        <div class="gtms-pagination">
            {{ $games->links('pagination::bootstrap-5') }}
        </div>

    @else

        <div class="gtms-empty">
            <div style="font-size: 48px; margin-bottom: 12px;">🎮</div>
            <h3 class="text-white">No Games Available</h3>
            <p>Add your first game to start managing tournaments.</p>
            <a href="{{ route('games.create') }}" class="gtms-add-btn">
                + Add Game
            </a>
        </div>

    @endif

</div>

@endsection
