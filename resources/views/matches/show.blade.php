
@extends('layouts.app')

@section('title', 'Match Overview')

@section('content')

@php
    $isAdmin = auth()->user()->isAdmin();

    $backRoute = $isAdmin
        ? route('matches.index')
        : route('upcoming-matches');
@endphp

<style>
.gtms-match-arena {
    background: #111a30;
    border: 1px solid #2b3858;
    border-radius: 20px;
    overflow: hidden;
    margin-bottom: 25px;
}

.gtms-match-teams {
    display: grid;
    grid-template-columns: minmax(0, 1fr) 84px minmax(0, 1fr);
    align-items: stretch;
    min-height: 240px;
    background: #0b1021;
}

.gtms-match-team {
    min-width: 0;
    position: relative;
    display: flex;
    flex-direction: column;
    justify-content: flex-end;
    padding: 28px;
    background-size: cover;
    background-position: center;
    isolation: isolate;
}

.gtms-match-team::before {
    content: "";
    position: absolute;
    inset: 0;
    background: linear-gradient(
        0deg,
        rgba(8, 12, 31, .96),
        rgba(9, 14, 32, .56) 80%
    );
    z-index: -1;
}

.gtms-match-team .tag {
    font: 800 clamp(24px, 4vw, 44px) Orbitron, sans-serif;
    color: white;
    overflow-wrap: anywhere;
}

.gtms-match-team .name {
    font-size: 17px;
    color: #d6e0ff;
}

.gtms-match-versus {
    display: grid;
    place-items: center;
    font: 800 23px Orbitron, sans-serif;
    color: #9b8bff;
    background: #151b38;
}

.gtms-match-score {
    display: grid;
    grid-template-columns: 1fr 1.1fr 1fr;
    align-items: center;
    text-align: center;
    padding: 30px 18px;
    gap: 12px;
}

.gtms-match-score strong {
    display: block;
    font: 800 clamp(32px, 5vw, 55px) Orbitron, sans-serif;
    color: white;
    margin-top: 8px;
}

@media (max-width: 650px) {
    .gtms-match-teams {
        grid-template-columns: 1fr;
        min-height: 0;
    }

    .gtms-match-team {
        min-height: 145px;
    }

    .gtms-match-versus {
        padding: 10px;
    }

    .gtms-match-score {
        grid-template-columns: 1fr 1.2fr 1fr;
        padding: 22px 10px;
    }
}
</style>

<div class="gtms-page">

    <div class="gtms-page-header">
        <div>
            <div class="gtms-eyebrow">
                Battle Briefing / {{ strtoupper($match->status) }}
            </div>

            <h1 class="gtms-page-title">Match Overview</h1>

            <p class="gtms-page-description">
                {{ $match->tournament?->name ?? 'Tournament TBA' }}
                · {{ $match->round ?? 'Round TBA' }}
            </p>
        </div>

        <div class="d-flex flex-wrap gap-2">
            @if($isAdmin)
                <a href="{{ route('matches.edit', $match) }}"
                   class="gtms-add-btn">
                    ✎ Edit Match
                </a>
            @endif

            <a href="{{ $backRoute }}"
               class="btn btn-outline-light">
                ← Back to Matches
            </a>
        </div>
    </div>

    <section class="gtms-match-arena">

        <div class="gtms-match-teams">

            <div class="gtms-match-team"
                @if($match->teamA?->banner_image)
                    style="background-image: url('{{ asset('storage/' . $match->teamA->banner_image) }}')"
                @endif
            >
                <div class="gtms-eyebrow">Team Alpha</div>

                <div class="tag">
                    {{ $match->teamA?->tag ?? 'TBA' }}
                </div>

                <div class="name">
                    {{ $match->teamA?->name ?? 'Team A' }}
                </div>
            </div>

            <div class="gtms-match-versus">VS</div>

            <div class="gtms-match-team"
                @if($match->teamB?->banner_image)
                    style="background-image: url('{{ asset('storage/' . $match->teamB->banner_image) }}')"
                @endif
            >
                <div class="gtms-eyebrow">Team Bravo</div>

                <div class="tag">
                    {{ $match->teamB?->tag ?? 'TBA' }}
                </div>

                <div class="name">
                    {{ $match->teamB?->name ?? 'Team B' }}
                </div>
            </div>

        </div>

        <div class="gtms-match-score">

            <div>
                <div class="gtms-detail-label">
                    {{ $match->teamA?->tag ?? 'Team A' }}
                </div>

                <strong>{{ $match->team_a_score ?? 0 }}</strong>
            </div>

            <div>
                <span class="gtms-status-pill {{ $match->status }}">
                    {{ ucfirst($match->status) }}
                </span>

                <div class="gtms-detail-label mt-3">
                    Match Score
                </div>

                <div class="text-white mt-2">
                    {{ $match->scheduled_at?->format('M d, Y · h:i A') ?? 'Schedule TBA' }}
                </div>
            </div>

            <div>
                <div class="gtms-detail-label">
                    {{ $match->teamB?->tag ?? 'Team B' }}
                </div>

                <strong>{{ $match->team_b_score ?? 0 }}</strong>
            </div>

        </div>
    </section>

    <div class="row g-4">

        <div class="col-lg-7">
            <section class="gtms-detail-card h-100">
                <div class="gtms-eyebrow">Event Information</div>

                <h2 class="h4 text-white mb-4">Match Details</h2>

                <div class="row g-4">

                    <div class="col-sm-6">
                        <div class="gtms-detail-label">Game</div>
                        <div class="text-white mt-2">
                            {{ $match->game?->name ?? 'TBA' }}
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="gtms-detail-label">Tournament</div>
                        <div class="text-white mt-2">
                            {{ $match->tournament?->name ?? 'TBA' }}
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="gtms-detail-label">Round</div>
                        <div class="text-white mt-2">
                            {{ $match->round ?? 'TBA' }}
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="gtms-detail-label">Winner</div>
                        <div class="text-white mt-2">
                            {{ $match->winner?->name ?? 'Not decided' }}
                        </div>
                    </div>

                </div>
            </section>
        </div>

        <div class="col-lg-5">
            <section class="gtms-detail-card h-100">
                <div class="gtms-eyebrow">Team Briefing</div>

                <h2 class="h4 text-white mb-4">Match Notes</h2>

                <p class="mb-0" style="color: #c5d2ef;">
                    {{ $match->notes ?: 'No tactical notes have been posted for this match yet.' }}
                </p>
            </section>
        </div>

    </div>

</div>
@endsection
