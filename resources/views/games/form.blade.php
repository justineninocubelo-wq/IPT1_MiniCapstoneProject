
<div class="card">
    <div class="card-body p-4">
        <div class="editor-section">
            <span class="editor-section-icon">🎮</span>
            <div>
                <h3>Game information</h3>
                <p>Configure game details and visual assets.</p>
            </div>
        </div>

        <div class="row g-3">
            <div class="col-md-5">
                <label class="form-label">Game Name</label>
                <input name="name" class="form-control"
                    value="{{ old('name', $game->name) }}" required>
            </div>

            <div class="col-md-3">
                <label class="form-label">Genre</label>
                <input name="genre" class="form-control"
                    value="{{ old('genre', $game->genre) }}" required>
            </div>

            <div class="col-md-4">
                <label class="form-label">Developer</label>
                <input name="developer" class="form-control"
                    value="{{ old('developer', $game->developer) }}" required>
            </div>

            <div class="col-md-4">
                <label class="form-label">Publisher</label>
                <input name="publisher" class="form-control"
                    value="{{ old('publisher', $game->publisher) }}">
            </div>

            <div class="col-md-4">
                <label class="form-label">Platform</label>
                <input name="platform" class="form-control"
                    value="{{ old('platform', $game->platform) }}" required>
            </div>

            <div class="col-md-2">
                <label class="form-label">Max Players</label>
                <input type="number" name="max_players" class="form-control"
                    value="{{ old('max_players', $game->max_players ?? 10) }}"
                    min="2" required>
            </div>

            <div class="col-md-2">
                <label class="form-label">Status</label>
                <select name="status" class="form-select">
                    @foreach (['active', 'inactive'] as $status)
                        <option value="{{ $status }}"
                            @selected(old('status', $game->status ?? 'active') === $status)>
                            {{ ucfirst($status) }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="col-12">
                <label class="form-label">Description</label>
                <textarea name="description" class="form-control"
                    rows="4">{{ old('description', $game->description) }}</textarea>
            </div>

            <div class="col-12">
                <label for="image" class="form-label">
                    Game Wallpaper
                </label>

                @if ($game->image)
                    <div class="mb-3">
                        <img
                            src="{{ asset('storage/' . $game->image) }}"
                            alt="{{ $game->name }} wallpaper"
                            style="width:100%;max-width:450px;height:180px;object-fit:cover;border-radius:12px;">
                    </div>
                @endif

                <input type="file" name="image" id="image"
                    class="form-control @error('image') is-invalid @enderror"
                    accept="image/jpeg,image/png,image/gif,image/webp">

                @error('image')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror

                <small class="text-muted">
                    Upload a game wallpaper (maximum 4 MB).
                </small>
            </div>

            <div class="col-12">
                <button type="submit" class="btn btn-primary">
                    Save Game
                </button>
                <a class="editor-cancel" href="{{ route('games.index') }}">
                    Cancel
                </a>
            </div>
        </div>
    </div>
</div>
