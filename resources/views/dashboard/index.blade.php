
@extends('layouts.app')

@section('title', 'Admin Dashboard')

@section('content')

<style>
.gtms-dashboard {
    max-width: 1500px;
    margin: 0 auto 50px;
    color: #edf2ff;
}

.gtms-dashboard-hero {
    position: relative;
    overflow: hidden;
    border: 1px solid #364578;
    border-radius: 22px;
    padding: clamp(25px, 4vw, 42px);
    margin-bottom: 25px;
    background:
        radial-gradient(circle at 90% 10%, #5e36a955, transparent 40%),
        linear-gradient(115deg, #182a55, #11172e 75%);
}

.gtms-dashboard-hero::after {
    content: "";
    position: absolute;
    right: -70px;
    top: -120px;
    width: 340px;
    height: 340px;
    border: 2px solid #8273ff2a;
    border-radius: 50%;
    pointer-events: none;
}

.gtms-dashboard-hero h1 {
    color: #fff;
    font: 800 clamp(24px, 3vw, 36px) Orbitron, sans-serif;
    line-height: 1.35;
    margin: 0 0 12px;
}

.gtms-dashboard-hero p {
    color: #b0bee0;
    max-width: 680px;
    margin: 0;
    font-size: 15px;
}

.gtms-dashboard-eyebrow {
    color: #a9a0ff;
    font-size: 11px;
    font-weight: 800;
    letter-spacing: 2.5px;
    text-transform: uppercase;
    margin-bottom: 12px;
}

.gtms-dashboard-stat {
    display: block;
    height: 100%;
    background: #141d35;
    border: 1px solid #2b3859;
    border-radius: 17px;
    padding: 23px;
    text-decoration: none;
    transition: transform .2s, border-color .2s;
}

.gtms-dashboard-stat:hover {
    transform: translateY(-4px);
    border-color: #8575f8;
}

.gtms-dashboard-stat-label {
    color: #98a9d0;
    font-size: 12px;
    font-weight: 800;
    text-transform: uppercase;
    letter-spacing: 1.2px;
}

.gtms-dashboard-stat-value {
    color: #fff;
    font: 800 clamp(29px, 3vw, 42px) Orbitron, sans-serif;
    margin-top: 12px;
}

.gtms-dashboard-stat-icon {
    width: 48px;
    height: 48px;
    border-radius: 13px;
    display: grid;
    place-items: center;
    font-size: 24px;
    background: linear-gradient(145deg, #344a92, #5b319e);
}

.gtms-dashboard-panel {
    background: #121a31;
    border: 1px solid #2b3859;
    border-radius: 18px;
    overflow: hidden;
    height: 100%;
}

.gtms-dashboard-panel-header {
    padding: 23px;
    border-bottom: 1px solid #293653;
}

.gtms-dashboard-panel-header h2 {
    color: #fff;
    font: 700 18px Orbitron, sans-serif;
    margin: 0 0 7px;
}

.gtms-dashboard-panel-header p {
    color: #91a2c9;
    font-size: 13px;
    margin: 0;
}

.gtms-dashboard-match {
    padding: 21px 23px;
    border-bottom: 1px solid #283451;
}

.gtms-dashboard-match:last-child {
    border-bottom: 0;
}

.gtms-dashboard-match-title {
    color: #fff;
    font-size: 16px;
    font-weight: 800;
    overflow-wrap: anywhere;
}

.gtms-dashboard-match-meta {
    color: #9baed4;
    font-size: 13px;
    margin-top: 7px;
}

.gtms-dashboard-manage {
    display: flex;
    align-items: center;
    gap: 13px;
    padding: 14px 16px;
    background: #1a2542;
    border: 1px solid #344263;
    border-radius: 12px;
    text-decoration: none;
    color: #e7edff;
    font-weight: 700;
    transition: .2s;
}

.gtms-dashboard-manage:hover {
    color: #fff;
    background: #293260;
    border-color: #8174f5;
    transform: translateX(3px);
}

.gtms-dashboard-manage span:first-child {
    font-size: 22px;
}

.gtms-dashboard-empty {
    text-align: center;
    padding: 55px 20px;
    color: #9aadd2;
}

.gtms-dashboard-bottom {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 15px;
    flex-wrap: wrap;
}

@media(max-width: 767px) {
    .gtms-dashboard-match {
        padding: 18px;
    }

    .gtms-dashboard-panel-header {
        padding: 18px;
    }
}
</style>

<div class="gtms-dashboard">

    <section class="gtms-dashboard-hero">

        <div class="row align-items-center g-4">

            <div class="col-lg-8">
                <div class="gtms-dashboard-eyebrow">
                    Admin Control Center
                </div>

                <h1>Gaming Tournament Management System</h1>

                <p>
                    Manage your players, teams, games, tournaments,
                    and matches from one centralized esports dashboard.
                </p>
            </div>

            <div class="col-lg-4 text-lg-end">
                <a href="{{ route('matches.create') }}"
                   class="gtms-add-btn">
                    + Schedule Match
                </a>
            </div>

        </div>

    </section>

    <div class="row g-3 mb-4">

        @php
            $statistics = [
                [
                    'label' => 'Players',
                    'value' => $players,
                    'icon' => '👤',
                    'route' => 'players.index',
                ],
                [
                    'label' => 'Teams',
                    'value' => $teams,
                    'icon' => '🛡️',
                    'route' => 'teams.index',
                ],
                [
                    'label' => 'Games',
                    'value' => $games,
                    'icon' => '🎮',
                    'route' => 'games.index',
                ],
                [
                    'label' => 'Tournaments',
                    'value' => $tournaments,
                    'icon' => '🏆',
                    'route' => 'tournaments.index',
                ],
                [
                    'label' => 'Matches',
                    'value' => $matches,
                    'icon' => '⚔️',
                    'route' => 'matches.index',
                ],
            ];
        @endphp

        @foreach($statistics as $stat)
            <div class="col-sm-6 col-xl">
                <a href="{{ route($stat['route']) }}"
                   class="gtms-dashboard-stat">

                    <div class="d-flex justify-content-between align-items-start gap-2">

                        <div class="gtms-dashboard-stat-label">
                            {{ $stat['label'] }}
                        </div>

                        <div class="gtms-dashboard-stat-icon">
                            {{ $stat['icon'] }}
                        </div>

                    </div>

                    <div class="gtms-dashboard-stat-value">
                        {{ number_format($stat['value']) }}
                    </div>

                </a>
            </div>
        @endforeach

    </div>

    <div class="row g-4">

        <div class="col-lg-8">
            <section class="gtms-dashboard-panel">

                <div class="gtms-dashboard-panel-header">
                    <div class="gtms-dashboard-bottom">

                        <div>
                            <div class="gtms-dashboard-eyebrow">
                                Match Center
                            </div>

                            <h2>Upcoming Matches</h2>

                            <p>
                                Scheduled tournament matches and fixtures.
                            </p>
                        </div>

                        <a href="{{ route('matches.index') }}"
                           class="btn btn-sm btn-outline-primary">
                            View All
                        </a>

                    </div>
                </div>

                @forelse($upcomingMatches as $match)
                    <div class="gtms-dashboard-match">

                        <div class="row align-items-center g-3">

                            <div class="col-md-7">

                                <div class="gtms-dashboard-match-title">
                                    {{ $match->teamA?->name ?? 'TBA' }}

                                    <span class="text-info mx-2">
                                        VS
                                    </span>

                                    {{ $match->teamB?->name ?? 'TBA' }}
                                </div>

                                <div class="gtms-dashboard-match-meta">
                                    {{ $match->game?->name ?? 'Game TBA' }}
                                    ·
                                    {{ $match->tournament?->name ?? 'Tournament TBA' }}
                                    ·
                                    {{ $match->round ?? 'Round TBA' }}
                                </div>

                            </div>

                            <div class="col-md-3">

                                <div class="fw-bold text-white">
                                    {{ $match->scheduled_at?->format('M d, Y') ?? 'TBA' }}
                                </div>

                                <div class="gtms-dashboard-match-meta">
                                    {{ $match->scheduled_at?->format('h:i A') ?? '' }}
                                </div>

                            </div>

                            <div class="col-md-2 text-md-end">
                                <a href="{{ route('matches.show', $match) }}"
                                   class="btn btn-sm btn-outline-light">
                                    View
                                </a>
                            </div>

                        </div>

                    </div>
                @empty
                    <div class="gtms-dashboard-empty">
                        <div style="font-size: 45px;">🎮</div>

                        <h3 class="h5 text-white mt-3">
                            No Upcoming Matches
                        </h3>

                        <p class="mb-0">
                            There are currently no scheduled matches.
                        </p>
                    </div>
                @endforelse

            </section>
        </div>

        <div class="col-lg-4">
            <section class="gtms-dashboard-panel">

                <div class="gtms-dashboard-panel-header">
                    <div class="gtms-dashboard-eyebrow">
                        Administration
                    </div>

                    <h2>Manage System</h2>

                    <p>
                        Quick access to your management sections.
                    </p>
                </div>

                <div class="p-3 d-grid gap-2">

                    <a href="{{ route('players.index') }}"
                       class="gtms-dashboard-manage">
                        <span>👤</span>
                        <span>Manage Players</span>
                    </a>

                    <a href="{{ route('teams.index') }}"
                       class="gtms-dashboard-manage">
                        <span>🛡️</span>
                        <span>Manage Teams</span>
                    </a>

                    <a href="{{ route('games.index') }}"
                       class="gtms-dashboard-manage">
                        <span>🎮</span>
                        <span>Manage Games</span>
                    </a>

                    <a href="{{ route('tournaments.index') }}"
                       class="gtms-dashboard-manage">
                        <span>🏆</span>
                        <span>Manage Tournaments</span>
                    </a>

                    <a href="{{ route('matches.index') }}"
                       class="gtms-dashboard-manage">
                        <span>⚔️</span>
                        <span>Manage Matches</span>
                    </a>

                </div>

            </section>
        </div>

    </div>

</div>
@endsection
