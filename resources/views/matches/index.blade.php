
@extends('layouts.app')

@section('title', 'Matches')

@section('content')
<div class="gtms-page">

    <div class="gtms-page-header">
        <div>
            <div class="gtms-eyebrow">Competition Control / Matches</div>
            <h1 class="gtms-page-title">Matches</h1>
            <p class="gtms-page-description">
                Schedule, monitor, and record tournament match results.
            </p>
        </div>

        <a href="{{ route('matches.create') }}" class="gtms-add-btn">
            + Add Match
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            {{ session('success') }}
            <button type="button" class="btn-close"
                    data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show">
            {{ session('error') }}
            <button type="button" class="btn-close"
                    data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="gtms-data-panel">
        <div class="table-responsive">
            <table class="table gtms-data-table align-middle mb-0">
                <thead>
                    <tr>
                        <th>Teams</th>
                        <th>Tournament</th>
                        <th>Game</th>
                        <th>Round</th>
                        <th>Schedule</th>
                        <th>Score</th>
                        <th>Winner</th>
                        <th>Status</th>
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($matches as $match)
                        <tr>
                            <td>
                                <span class="gtms-table-title">
                                    {{ $match->teamA?->tag ?? 'TBA' }}
                                    <span class="text-info mx-1">VS</span>
                                    {{ $match->teamB?->tag ?? 'TBA' }}
                                </span>
                            </td>

                            <td>{{ $match->tournament?->name ?? '—' }}</td>
                            <td>{{ $match->game?->name ?? '—' }}</td>
                            <td>{{ $match->round }}</td>

                            <td>
                                {{ $match->scheduled_at?->format('M d, Y h:i A') ?? 'TBA' }}
                            </td>

                            <td>
                                {{ $match->team_a_score ?? 0 }}
                                –
                                {{ $match->team_b_score ?? 0 }}
                            </td>

                            <td>{{ $match->winner?->tag ?? '—' }}</td>

                            <td>
                                <span class="gtms-status-pill {{ $match->status }}">
                                    {{ ucfirst($match->status) }}
                                </span>
                            </td>

                            <td>
                                <div class="d-flex justify-content-end gap-2">
                                    <a href="{{ route('matches.show', $match) }}"
                                       class="btn btn-sm btn-outline-light">
                                        View
                                    </a>

                                    <a href="{{ route('matches.edit', $match) }}"
                                       class="btn btn-sm btn-outline-primary">
                                        Edit
                                    </a>

                                    <x-delete-action
                                        :action="route('matches.destroy', $match)"
                                        :name="($match->teamA?->tag ?? 'Team A') . ' vs ' . ($match->teamB?->tag ?? 'Team B')"
                                        type="match"
                                        :id="'match'.$match->id"
                                    />
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="text-center py-5">
                                No matches found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if(method_exists($matches, 'links'))
            <div class="gtms-pagination p-3">
                {{ $matches->links('pagination::bootstrap-5') }}
            </div>
        @endif
    </div>

</div>
@endsection
