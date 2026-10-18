
<div class="card">
    <div class="card-body p-4">
        <div class="editor-section">
            <span class="editor-section-icon">⚔</span>
            <div>
                <h3>Match configuration</h3>
                <p>Set teams, scores and competition status.</p>
            </div>
        </div>

        <div class="row g-3">
            <div class="col-md-6">
                <label class="form-label">Tournament</label>
                <select name="tournament_id" id="tournament_id"
                    class="form-select" required>
                    @foreach ($tournaments as $t)
                        <option value="{{ $t->id }}"
                            data-game="{{ $t->game_id }}"
                            @selected((string) old('tournament_id', $match->tournament_id) === (string) $t->id)>
                            {{ $t->name }} — {{ $t->game->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-6">
                <label class="form-label">Game</label>
                <select name="game_id" id="game_id"
                    class="form-select" required>
                    @foreach ($games as $game)
                        <option value="{{ $game->id }}"
                            @selected((string) old('game_id', $match->game_id) === (string) $game->id)>
                            {{ $game->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-6">
                <label class="form-label">Team A</label>
                <select name="team_a_id" class="form-select" required>
                    @foreach ($teams as $team)
                        <option value="{{ $team->id }}"
                            @selected((string) old('team_a_id', $match->team_a_id) === (string) $team->id)>
                            {{ $team->name }} ({{ $team->tag }})
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-6">
                <label class="form-label">Team B</label>
                <select name="team_b_id" class="form-select" required>
                    @foreach ($teams as $team)
                        <option value="{{ $team->id }}"
                            @selected((string) old('team_b_id', $match->team_b_id) === (string) $team->id)>
                            {{ $team->name }} ({{ $team->tag }})
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-3">
                <label class="form-label">Round</label>
                <input name="round" class="form-control"
                    value="{{ old('round', $match->round) }}"
                    placeholder="Quarterfinal" required>
            </div>

            <div class="col-md-3">
                <label class="form-label">Scheduled At</label>
                <input type="datetime-local" name="scheduled_at"
                    class="form-control"
                    value="{{ old('scheduled_at', $match->scheduled_at?->format('Y-m-d\TH:i')) }}"
                    required>
            </div>

            <div class="col-md-2">
                <label class="form-label">Team A Score</label>
                <input type="number" min="0" name="team_a_score"
                    class="form-control"
                    value="{{ old('team_a_score', $match->team_a_score ?? 0) }}"
                    required>
            </div>

            <div class="col-md-2">
                <label class="form-label">Team B Score</label>
                <input type="number" min="0" name="team_b_score"
                    class="form-control"
                    value="{{ old('team_b_score', $match->team_b_score ?? 0) }}"
                    required>
            </div>

            <div class="col-md-2">
                <label class="form-label">Winner</label>
                <select name="winner_team_id" class="form-select">
                    <option value="">—</option>
                    @foreach ($teams as $team)
                        <option value="{{ $team->id }}"
                            @selected((string) old('winner_team_id', $match->winner_team_id) === (string) $team->id)>
                            {{ $team->tag }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-4">
                <label class="form-label">Status</label>
                <select name="status" class="form-select">
                    @foreach (['scheduled', 'live', 'completed', 'postponed', 'cancelled'] as $status)
                        <option value="{{ $status }}"
                            @selected(old('status', $match->status ?? 'scheduled') === $status)>
                            {{ ucfirst($status) }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="col-12">
                <label class="form-label">Notes</label>
                <textarea name="notes" class="form-control"
                    rows="3">{{ old('notes', $match->notes) }}</textarea>
            </div>

            <div class="col-12">
                <button type="submit" class="btn btn-primary">
                    Save Match
                </button>
                <a class="editor-cancel" href="{{ route('matches.index') }}">
                    Cancel
                </a>
            </div>
        </div>
    </div>
</div>
