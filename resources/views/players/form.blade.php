
<div class="card">
    <div class="card-body p-4">
        <div class="editor-section">
            <span class="editor-section-icon">♟</span>
            <div>
                <h3>Player profile</h3>
                <p>Update identity, performance and membership details.</p>
            </div>
        </div>

        <div class="row g-3">
            <div class="col-md-4">
                <label class="form-label">Gamer Tag</label>
                <input name="gamer_tag" class="form-control"
                    value="{{ old('gamer_tag', $player->gamer_tag) }}" required>
            </div>

            <div class="col-md-8">
                <label class="form-label">Full Name</label>
                <input name="full_name" class="form-control"
                    value="{{ old('full_name', $player->full_name) }}" required>
            </div>

            <div class="col-md-6">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-control"
                    value="{{ old('email', $player->email) }}" required>
            </div>

            <div class="col-md-3">
                <label class="form-label">Birth Date</label>
                <input type="date" name="birth_date" class="form-control"
                    value="{{ old('birth_date', $player->birth_date?->format('Y-m-d')) }}">
            </div>

            <div class="col-md-3">
                <label class="form-label">Country</label>
                <input name="country" class="form-control"
                    value="{{ old('country', $player->country) }}" required>
            </div>

            <div class="col-md-4">
                <label class="form-label">Skill Rating</label>
                <input type="number" name="skill_rating"
                    class="form-control" min="0" max="5000"
                    value="{{ old('skill_rating', $player->skill_rating ?? 1000) }}"
                    required>
            </div>

            <div class="col-md-4">
                <label class="form-label">Status</label>
                <select name="status" class="form-select" required>
                    @foreach (['active', 'inactive', 'banned'] as $status)
                        <option value="{{ $status }}"
                            @selected(old('status', $player->status ?? 'active') === $status)>
                            {{ ucfirst($status) }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-4">
                <label class="form-label">Teams</label>
                <select name="team_ids[]" class="form-select" multiple>
                    @foreach ($teams as $team)
                        <option value="{{ $team->id }}"
                            @selected(collect(old('team_ids', $player->teams->pluck('id')->all()))->contains($team->id))>
                            {{ $team->name }} ({{ $team->tag }})
                        </option>
                    @endforeach
                </select>
                <small class="text-muted">Hold Ctrl/Cmd to select multiple.</small>
            </div>

            <div class="col-12">
                <label class="form-label">Bio</label>
                <textarea name="bio" class="form-control"
                    rows="4">{{ old('bio', $player->bio) }}</textarea>
            </div>

            <div class="col-12">
                <label for="profile_image" class="form-label">
                    Player Profile Image
                </label>

                @if ($player->profile_image)
                    <div class="mb-3">
                        <img
                            src="{{ asset('storage/' . $player->profile_image) }}"
                            alt="{{ $player->gamer_tag }} profile"
                            style="width:110px;height:110px;object-fit:cover;border-radius:50%;">
                    </div>
                @endif

                <input type="file" name="profile_image"
                    id="profile_image"
                    class="form-control @error('profile_image') is-invalid @enderror"
                    accept="image/jpeg,image/png,image/gif,image/webp">

                @error('profile_image')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror

                <small class="text-muted">
                    Upload a player photo (maximum 4 MB).
                </small>
            </div>

            <div class="col-12">
                <button type="submit" class="btn btn-primary">
                    Save Player
                </button>
                <a class="editor-cancel" href="{{ route('players.index') }}">
                    Cancel
                </a>
            </div>
        </div>
    </div>
</div>
