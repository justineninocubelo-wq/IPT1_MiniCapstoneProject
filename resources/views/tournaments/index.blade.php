
@extends('layouts.app')

@section('title', 'Tournaments')

@section('content')
<div class="gtms-page">

    <div class="gtms-page-header">
        <div>
            <div class="gtms-eyebrow">Competition Control / Tournaments</div>
            <h1 class="gtms-page-title">Tournaments</h1>
            <p class="gtms-page-description">
                Organize competitive events and track their matches.
            </p>
        </div>

        <a href="{{ route('tournaments.create') }}" class="gtms-add-btn">
            + Add Tournament
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
                        <th>Tournament</th>
                        <th>Game</th>
                        <th>Season</th>
                        <th>Dates</th>
                        <th>Format</th>
                        <th>Prize Pool</th>
                        <th>Matches</th>
                        <th>Status</th>
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($tournaments as $t)
                        <tr>
                            <td>
                                <span class="gtms-table-title">
                                    {{ $t->name }}
                                </span>
                                <div class="gtms-table-sub">
                                    {{ $t->venue }}
                                </div>
                            </td>

                            <td>{{ $t->game?->name ?? '—' }}</td>

                            <td>{{ $t->season }}</td>

                            <td>
                                {{ $t->start_date?->format('M d') ?? 'TBA' }}
                                –
                                {{ $t->end_date?->format('M d, Y') ?? 'TBA' }}
                            </td>

                            <td>
                                {{ ucwords(str_replace('_', ' ', $t->format)) }}
                            </td>

                            <td>
                                ₱{{ number_format($t->prize_pool ?? 0, 2) }}
                            </td>

                            <td>{{ $t->matches_count }}</td>

                            <td>
                                <span class="gtms-status-pill {{ $t->status }}">
                                    {{ ucfirst($t->status) }}
                                </span>
                            </td>

                            <td>
                                <div class="d-flex justify-content-end gap-2">
                                    <a href="{{ route('tournaments.show', $t) }}"
                                       class="btn btn-sm btn-outline-light">
                                        View
                                    </a>

                                    <a href="{{ route('tournaments.edit', $t) }}"
                                       class="btn btn-sm btn-outline-primary">
                                        Edit
                                    </a>

                                    <x-delete-action
                                        :action="route('tournaments.destroy', $t)"
                                        :name="$t->name"
                                        type="tournament"
                                        :id="'tournament'.$t->id"
                                    />
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="text-center py-5">
                                No tournaments found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if(method_exists($tournaments, 'links'))
            <div class="gtms-pagination p-3">
                {{ $tournaments->links('pagination::bootstrap-5') }}
            </div>
        @endif
    </div>

</div>
@endsection
