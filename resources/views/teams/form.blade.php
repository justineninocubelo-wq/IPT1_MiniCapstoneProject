
<div class="card">
    <div class="card-body p-4">
        <div class="editor-section">
            <span class="editor-section-icon">🛡</span>
            <div>
                <h3>Team information</h3>
                <p>Update your roster identity, leadership and team banner.</p>
            </div>
        </div>

        <div class="row g-3">
            <div class="col-md-6">
                <label class="form-label">Team Name</label>
                <input name="name" class="form-control"
                    value="{{ old('name', $team->name) }}" required>
            </div>

            <div class="col-md-2">
                <label class="form-label">Tag</label>
                <input name="tag" class="form-control" maxlength="10"
                    value="{{ old('tag', $team->tag) }}" required>
            </div>

            <div class="col-md-4">
                <label class="form-label">Captain</label>
                <input name="captain_name" class="form-control"
                    value="{{ old('captain_name', $team->captain_name) }}" required>
            </div>

            <div class="col-md-4">
                <label class="form-label">Coach</label>
                <input name="coach_name" class="form-control"
                    value="{{ old('coach_name', $team->coach_name) }}">
            </div>

            <div class="col-md-4">
                <label class="form-label">Country</label>
                <input name="country" class="form-control"
                    value="{{ old('country', $team->country) }}" required>
            </div>

            <div class="col-md-2">
                <label class="form-label">Founded Year</label>
                <input type="number" name="founded_year" class="form-control"
                    value="{{ old('founded_year', $team->founded_year) }}">
            </div>

            <div class="col-md-2">
                <label class="form-label">Status</label>
                <select name="status" class="form-select">
                    @foreach (['active', 'inactive', 'disbanded'] as $status)
                        <option value="{{ $status }}"
                            @selected(old('status', $team->status ?? 'active') === $status)>
                            {{ ucfirst($status) }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="col-12">
                <label class="form-label">Description</label>
                <textarea name="description" class="form-control"
                    rows="4">{{ old('description', $team->description) }}</textarea>
            </div>

            <div class="col-12">
                <label for="banner_image" class="form-label">
                    Team Banner
                </label>

                @if ($team->banner_image)
                    <div class="mb-3">
                        <img
                            src="{{ asset('storage/' . $team->banner_image) }}"
                            alt="{{ $team->name }} banner"
                            style="width:100%;max-width:450px;height:180px;object-fit:cover;border-radius:12px;">
                    </div>
                @endif

                <input type="file" name="banner_image"
                    id="banner_image"
                    class="form-control @error('banner_image') is-invalid @enderror"
                    accept="image/jpeg,image/png,image/gif,image/webp">

                @error('banner_image')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror

                <small class="text-muted">
                    Upload a team banner (maximum 4 MB).
                </small>
            </div>

            <div class="col-12">
                <button type="submit" class="btn btn-primary">
                    Save Team
                </button>
                <a class="editor-cancel" href="{{ route('teams.index') }}">
                    Cancel
                </a>
            </div>
        </div>
    </div>
</div>
