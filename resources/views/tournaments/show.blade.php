
@extends('layouts.app')

@section('title', $tournament->name)

@section('content')
<div class="gtms-page">

    <div class="gtms-page-header">
        <div>
            <div class="gtms-eyebrow">
                Competition Center / Tournament Intel
            </div>

            <h1 class="gtms-page-title">
                {{ $tournament->name }}
            </h1>

            <p class="gtms-page-description">
                {{ $tournament->game?->name ?? 'Game TBA' }}
                · {{ $tournament->season }}
                · {{ $tournament->venue }}
            </p>
        </div>

        <div class="d-flex flex-wrap gap-2">
            <a href="{{ route('tournaments.edit', $tournament) }}"
               class="gtms-add-btn">
                ✎ Edit Tournament
            </a>

            <a href="{{ route('tournaments.index') }}"
               class="btn btn-outline-light">
                ← Back
            </a>
        </div>
    </div>

    <div class="row g-3 mb-4">

        <div class="col-md-6 col-xl-3">
            <div class="gtms-detail-card h-100">
                <div class="gtms-detail-label">
                    Tournament Format
                </div>
                <div class="gtms-detail-value">
                    {{ ucwords(str_replace('_', ' ', $tournament->format)) }}
                </div>
            </div>
        </div>

        <div class="col-md-6 col-xl-3">
            <div class="gtms-detail-card h-100">
                <div class="gtms-detail-label">
                    Prize Pool
                </div>
                <div class="gtms-detail-value">
                    ₱{{ number_format($tournament->prize_pool ?? 0, 2) }}
                </div>
            </div>
        </div>

        <div class="col-md-6 col-xl-3">
            <div class="gtms-detail-card h-100">
                <div class="gtms-detail-label">
                    Event Dates
                </div>
                <div class="gtms-detail-value">
                    {{ $tournament->start_date?->format('M d') ?? 'TBA' }}
                    –
                    {{ $tournament->end_date?->format('M d, Y') ?? 'TBA' }}
                </div>
            </div>
        </div>

        <div class="col-md-6 col-xl-3">
            <div class="gtms-detail-card h-100">
                <div class="gtms-detail-label">
                    Current Status
                </div>
                <div class="mt-3">
                    <span class="gtms-status-pill {{ $tournament->status }}">
                        {{ ucfirst($tournament->status) }}
                    </span>
                </div>
            </div>
        </div>

    </div>

    @if($tournament->description)
        <div class="gtms-detail-card mb-4">
            <div class="gtms-detail-label mb-2">
                About This Tournament
            </div>

            <p class="mb-0">
                {{ $tournament->description }}
            </p>
        </div>
    @endif

    <div class="gtms-page-header mb-3">
        <div>
            <div class="gtms-eyebrow">Match Schedule</div>
            <h2 class="h4 text-white mb-0">
                Tournament Matches
            </h2>
        </div>

        <span class="gtms-status-pill">
            {{ $tournament->matches->count() }} Matches
        </span>
    </div>

    <div class="gtms-data-panel">
        <div class="table-responsive">
            <table class="table gtms-data-table align-middle mb-0">
                <thead>
                    <tr>
                        <th>Round</th>
                        <th>Matchup</th>
                        <th>Score</th>
                        <th>Schedule</th>
                        <th>Status</th>
                        <th>Winner</th>
                        <th>Action</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($tournament->matches as $match)
                        <tr>
                            <td>{{ $match->round }}</td>

                            <td>
                                <span class="gtms-table-title">
                                    {{ $match->teamA?->tag ?? 'TBA' }}
                                    <span class="text-info">VS</span>
                                    {{ $match->teamB?->tag ?? 'TBA' }}
                                </span>
                            </td>

                            <td>
                                {{ $match->team_a_score ?? 0 }}
                                –
                                {{ $match->team_b_score ?? 0 }}
                            </td>

                            <td>
                                {{ $match->scheduled_at?->format('M d, Y · h:i A') ?? 'TBA' }}
                            </td>

                            <td>
                                <span class="gtms-status-pill {{ $match->status }}">
                                    {{ ucfirst($match->status) }}
                                </span>
                            </td>

                            <td>{{ $match->winner?->tag ?? '—' }}</td>

                            <td>
                                <a href="{{ route('matches.show', $match) }}"
                                   class="btn btn-sm btn-outline-light">
                                    View Match
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center py-5">
                                No matches scheduled for this tournament yet.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection
