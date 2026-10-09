@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')

<style>
    body {
        background:
            radial-gradient(circle at top right, rgba(79, 70, 229, 0.14), transparent 32%),
            radial-gradient(circle at bottom left, rgba(14, 165, 233, 0.10), transparent 30%),
            #f1f5f9;
    }

    .dashboard-header {
        background: linear-gradient(135deg, #111827, #1e293b);
        color: white;
        border-radius: 20px;
        padding: 32px;
        margin-bottom: 28px;
        box-shadow: 0 12px 30px rgba(15, 23, 42, 0.18);
    }

    .dashboard-header h1 {
        font-weight: 800;
        margin-bottom: 8px;
    }

    .dashboard-header p {
        color: #cbd5e1;
        margin-bottom: 0;
    }

    .schedule-btn {
        background: linear-gradient(135deg, #6366f1, #2563eb);
        color: white;
        border: none;
        border-radius: 12px;
        padding: 13px 20px;
        font-weight: 700;
        box-shadow: 0 8px 20px rgba(37, 99, 235, 0.30);
        transition: 0.2s ease;
    }

    .schedule-btn:hover {
        color: white;
        transform: translateY(-2px);
        box-shadow: 0 12px 25px rgba(37, 99, 235, 0.40);
    }

    .stat-card {
        border: none;
        border-radius: 18px;
        overflow: hidden;
        background: white;
        box-shadow: 0 8px 24px rgba(15, 23, 42, 0.08);
        transition: 0.2s ease;
        height: 100%;
    }

    .stat-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 14px 30px rgba(15, 23, 42, 0.13);
    }

    .stat-card a {
        text-decoration: none;
        color: inherit;
    }

    .stat-icon {
        width: 52px;
        height: 52px;
        border-radius: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 25px;
        background: #eef2ff;
    }

    .stat-label {
        color: #64748b;
        font-size: 14px;
        font-weight: 600;
    }

    .stat-number {
        font-size: 32px;
        font-weight: 800;
        color: #0f172a;
    }

    .section-card {
        background: white;
        border: none;
        border-radius: 18px;
        box-shadow: 0 8px 24px rgba(15, 23, 42, 0.08);
        overflow: hidden;
    }

    .section-header {
        padding: 20px 22px;
        border-bottom: 1px solid #e2e8f0;
    }

    .section-header h4 {
        font-weight: 800;
        margin: 0;
        color: #0f172a;
    }

    .match-item {
        padding: 18px 22px;
        border-bottom: 1px solid #e2e8f0;
        transition: 0.2s ease;
    }

    .match-item:last-child {
        border-bottom: none;
    }

    .match-item:hover {
        background: #f8fafc;
    }

    .match-teams {
        font-weight: 800;
        color: #0f172a;
    }

    .match-meta {
        color: #64748b;
        font-size: 14px;
    }

    .status-badge {
        background: #dcfce7;
        color: #166534;
        padding: 6px 11px;
        border-radius: 50px;
        font-size: 12px;
        font-weight: 700;
    }

    .manage-card {
        border: none;
        border-radius: 18px;
        background: linear-gradient(135deg, #1e293b, #111827);
        color: white;
        padding: 24px;
        height: 100%;
        box-shadow: 0 8px 24px rgba(15, 23, 42, 0.15);
    }

    .manage-card h4 {
        font-weight: 800;
    }

    .manage-card p {
        color: #cbd5e1;
    }

    .manage-btn {
        display: block;
        text-decoration: none;
        background: rgba(255, 255, 255, 0.08);
        color: white;
        border: 1px solid rgba(255, 255, 255, 0.10);
        border-radius: 10px;
        padding: 11px 14px;
        margin-top: 10px;
        font-weight: 700;
        transition: 0.2s ease;
    }

    .manage-btn:hover {
        color: white;
        background: rgba(255, 255, 255, 0.15);
        transform: translateX(3px);
    }

    .empty-state {
        padding: 45px 20px;
        text-align: center;
        color: #64748b;
    }
</style>

<div class="dashboard-header">

    <div class="row align-items-center">

        <div class="col-lg-8">

            <div class="text-uppercase small fw-bold mb-2"
                 style="letter-spacing: 2px; color: #93c5fd;">
                Admin Control Center
            </div>

            <h1>
                Gaming Tournament Management System
            </h1>

            <p>
                Manage players, teams, games, tournaments, and matches
                from one centralized dashboard.
            </p>

        </div>

        <div class="col-lg-4 text-lg-end mt-4 mt-lg-0">

            <a href="{{ route('matches.create') }}"
               class="btn schedule-btn">
                + Schedule Match
            </a>

        </div>

    </div>

</div>

<div class="row g-4 mb-4">

    <div class="col-sm-6 col-xl-3">

        <a href="{{ route('players.index') }}"
           class="text-decoration-none">

            <div class="stat-card">

                <div class="card-body p-4">

                    <div class="d-flex justify-content-between align-items-center">

                        <div>
                            <div class="stat-label">
                                Players
                            </div>

                            <div class="stat-number">
                                {{ $players }}
                            </div>
                        </div>

                        <div class="stat-icon">
                            👤
                        </div>

                    </div>

                </div>

            </div>

        </a>

    </div>

    <div class="col-sm-6 col-xl-3">

        <a href="{{ route('teams.index') }}"
           class="text-decoration-none">

            <div class="stat-card">

                <div class="card-body p-4">

                    <div class="d-flex justify-content-between align-items-center">

                        <div>
                            <div class="stat-label">
                                Teams
                            </div>

                            <div class="stat-number">
                                {{ $teams }}
                            </div>
                        </div>

                        <div class="stat-icon">
                            🛡️
                        </div>

                    </div>

                </div>

            </div>

        </a>

    </div>

    <div class="col-sm-6 col-xl-3">

        <a href="{{ route('games.index') }}"
           class="text-decoration-none">

            <div class="stat-card">

                <div class="card-body p-4">

                    <div class="d-flex justify-content-between align-items-center">

                        <div>
                            <div class="stat-label">
                                Games
                            </div>

                            <div class="stat-number">
                                {{ $games }}
                            </div>
                        </div>

                        <div class="stat-icon">
                            🎮
                        </div>

                    </div>

                </div>

            </div>

        </a>

    </div>

    <div class="col-sm-6 col-xl-3">

        <a href="{{ route('tournaments.index') }}"
           class="text-decoration-none">

            <div class="stat-card">

                <div class="card-body p-4">

                    <div class="d-flex justify-content-between align-items-center">

                        <div>
                            <div class="stat-label">
                                Tournaments
                            </div>

                            <div class="stat-number">
                                {{ $tournaments }}
                            </div>
                        </div>

                        <div class="stat-icon">
                            🏆
                        </div>

                    </div>

                </div>

            </div>

        </a>

    </div>

</div>

<div class="row g-4">

    <div class="col-lg-8">

        <div class="section-card">

            <div class="section-header d-flex justify-content-between align-items-center">

                <div>
                    <h4>Upcoming Matches</h4>

                    <small class="text-muted">
                        Next scheduled tournament matches
                    </small>
                </div>

                <a href="{{ route('matches.index') }}"
                   class="btn btn-sm btn-outline-primary">
                    View All
                </a>

            </div>

            @forelse($upcomingMatches as $match)

                <div class="match-item">

                    <div class="row align-items-center">

                        <div class="col-md-7">

                            <div class="match-teams">
                                {{ $match->teamA->name ?? 'TBA' }}
                                <span class="text-muted mx-2">VS</span>
                                {{ $match->teamB->name ?? 'TBA' }}
                            </div>

                            <div class="match-meta mt-1">

                                {{ $match->game->name ?? 'Game' }}

                                ·

                                {{ $match->tournament->name ?? 'Tournament' }}

                                ·

                                {{ $match->round ?? 'Round' }}

                            </div>

                        </div>

                        <div class="col-md-3 mt-3 mt-md-0">

                            <div class="fw-semibold">
                                {{ $match->scheduled_at?->format('M d, Y') }}
                            </div>

                            <div class="match-meta">
                                {{ $match->scheduled_at?->format('h:i A') }}
                            </div>

                        </div>

                        <div class="col-md-2 text-md-end mt-3 mt-md-0">

                            <span class="status-badge">
                                {{ ucfirst($match->status) }}
                            </span>

                        </div>

                    </div>

                </div>

            @empty

                <div class="empty-state">

                    <div style="font-size: 45px;">
                        🎮
                    </div>

                    <h5 class="fw-bold mt-3">
                        No Upcoming Matches
                    </h5>

                    <p class="mb-0">
                        There are currently no scheduled matches.
                    </p>

                </div>

            @endforelse

        </div>

    </div>

    <div class="col-lg-4">

        <div class="manage-card">

            <div class="small text-uppercase fw-bold mb-2"
                 style="letter-spacing: 1.5px; color: #93c5fd;">
                Administration
            </div>

            <h4>
                Manage System
            </h4>

            <p>
                Quickly access the different sections of the tournament
                management system.
            </p>

            <a href="{{ route('players.index') }}"
               class="manage-btn">
                👤 Manage Players
            </a>

            <a href="{{ route('teams.index') }}"
               class="manage-btn">
                🛡️ Manage Teams
            </a>

            <a href="{{ route('games.index') }}"
               class="manage-btn">
                🎮 Manage Games
            </a>

            <a href="{{ route('tournaments.index') }}"
               class="manage-btn">
                🏆 Manage Tournaments
            </a>

            <a href="{{ route('matches.index') }}"
               class="manage-btn">
                ⚔️ Manage Matches
            </a>

        </div>

    </div>

</div>

<div class="row g-4 mt-1">

    <div class="col-md-6">

        <div class="section-card p-4">

            <div class="d-flex justify-content-between align-items-center">

                <div>
                    <div class="stat-label">
                        Total Matches
                    </div>

                    <div class="stat-number">
                        {{ $matches }}
                    </div>
                </div>

                <div class="stat-icon">
                    ⚔️
                </div>

            </div>

        </div>

    </div>

    <div class="col-md-6">

        <div class="section-card p-4">

            <div class="d-flex justify-content-between align-items-center">

                <div>
                    <div class="stat-label">
                        Active Tournaments
                    </div>

                    <div class="stat-number">
                        {{ $tournaments }}
                    </div>
                </div>

                <div class="stat-icon">
                    🏆
                </div>

            </div>

        </div>

    </div>

</div>

@endsection