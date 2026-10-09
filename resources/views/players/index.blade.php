@extends('layouts.app')

@section('title', 'Players')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold mb-1">Players</h2>
            <p class="text-muted mb-0">Manage registered esports players and team memberships.</p>
        </div>
        <a href="{{ route('players.create') }}" class="btn btn-primary">+ Add Player</a>
    </div>

    <div class="card">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead>
                    <tr>
                        <th>Gamer Tag</th>
                        <th>Player</th>
                        <th>Email</th>
                        <th>Country</th>
                        <th>Rating</th>
                        <th>Teams</th>
                        <th>Status</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($players as $player)
                        <tr>
                            <td><strong>{{ $player->gamer_tag }}</strong></td>
                            <td>{{ $player->full_name }}</td>
                            <td>{{ $player->email }}</td>
                            <td>{{ $player->country }}</td>
                            <td>{{ number_format($player->skill_rating) }}</td>
                            <td>{{ $player->teams->pluck('tag')->join(', ') ?: '—' }}</td>
                            <td>
                                <span class="badge text-bg-{{ $player->status === 'active' ? 'success' : ($player->status === 'banned' ? 'danger' : 'secondary') }}">
                                    {{ ucfirst($player->status) }}
                                </span>
                            </td>
                            <td class="text-end">
                                <a href="{{ route('players.show', $player) }}" class="btn btn-sm btn-outline-secondary">View</a>
                                <a href="{{ route('players.edit', $player) }}" class="btn btn-sm btn-outline-primary">Edit</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center py-5 text-muted">No players found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="p-3">
            {{ $players->links() }}
        </div>
    </div>
@endsection
