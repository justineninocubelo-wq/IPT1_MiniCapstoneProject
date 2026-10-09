@extends('layouts.app')

@section('title', 'Match Details')

@section('content')
    <div class="d-flex justify-content-between mb-4">
        <div>
            <h2 class="fw-bold mb-1">{{ $match->teamA->name }} vs {{ $match->teamB->name }}</h2>
            <p class="text-muted mb-0">{{ $match->tournament->name }} · {{ $match->round }}</p>
        </div>
        <div>
            @if(auth()->user()->isAdmin())
                <a href="{{ route('matches.edit', $match) }}" class="btn btn-primary">
                    Edit
                </a>
            @endif

            <a href="{{ route('upcoming-matches') }}" class="btn btn-outline-secondary">
                Back
            </a>
        </div>
    </div>

    <div class="card text-center mb-4">
        <div class="card-body py-5">
            <div class="row align-items-center">
                <div class="col">
                    <div class="display-6 fw-bold">{{ $match->teamA->tag }}</div>
                    <div class="text-muted">{{ $match->teamA->name }}</div>
                </div>

                <div class="col-auto">
                    <div class="display-4 fw-bold">{{ $match->team_a_score }} : {{ $match->team_b_score }}</div>
                    <span class="badge text-bg-primary">{{ ucfirst($match->status) }}</span>
                </div>

                <div class="col">
                    <div class="display-6 fw-bold">{{ $match->teamB->tag }}</div>
                    <div class="text-muted">{{ $match->teamB->name }}</div>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <dl class="row mb-0">
                        <dt class="col-sm-5">Game</dt>
                        <dd class="col-sm-7">{{ $match->game->name }}</dd>

                        <dt class="col-sm-5">Tournament</dt>
                        <dd class="col-sm-7">{{ $match->tournament->name }}</dd>

                        <dt class="col-sm-5">Round</dt>
                        <dd class="col-sm-7">{{ $match->round }}</dd>

                        <dt class="col-sm-5">Scheduled</dt>
                        <dd class="col-sm-7">{{ $match->scheduled_at->format('M d, Y h:i A') }}</dd>

                        <dt class="col-sm-5">Winner</dt>
                        <dd class="col-sm-7">{{ $match->winner?->name ?? 'Not decided' }}</dd>
                    </dl>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h6>Notes</h6>
                    <p class="mb-0">{{ $match->notes ?: 'No notes.' }}</p>
                </div>
            </div>
        </div>
    </div>
@endsection
