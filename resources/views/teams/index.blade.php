@extends('layouts.app')
@section('title','Teams')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-4"><div><h2 class="fw-bold mb-1">Teams</h2><p class="text-muted mb-0">Manage participating esports teams.</p></div><a href="{{ route('teams.create') }}" class="btn btn-primary">+ Add Team</a></div>
<div class="card"><div class="table-responsive"><table class="table table-hover align-middle mb-0"><thead><tr><th>Team</th><th>Tag</th><th>Captain</th><th>Coach</th><th>Country</th><th>Players</th><th>Status</th><th></th></tr></thead><tbody>
@forelse($teams as $team)<tr><td><strong>{{ $team->name }}</strong></td><td><span class="badge text-bg-dark">{{ $team->tag }}</span></td><td>{{ $team->captain_name }}</td><td>{{ $team->coach_name ?: '—' }}</td><td>{{ $team->country }}</td><td>{{ $team->players_count }}</td><td><span class="badge text-bg-{{ $team->status==='active'?'success':($team->status==='disbanded'?'danger':'secondary') }}">{{ ucfirst($team->status) }}</span></td><td class="text-end"><a href="{{ route('teams.show',$team) }}" class="btn btn-sm btn-outline-secondary">View</a> <a href="{{ route('teams.edit',$team) }}" class="btn btn-sm btn-outline-primary">Edit</a></td></tr>@empty<tr><td colspan="8" class="text-center py-5 text-muted">No teams found.</td></tr>@endforelse
</tbody></table></div><div class="p-3">{{ $teams->links() }}</div></div>
@endsection
