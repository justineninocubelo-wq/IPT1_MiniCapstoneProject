<div class="card"><div class="card-body p-4"><div class="row g-3">
<div class="col-md-5"><label class="form-label">Game Name</label><input name="name" class="form-control" value="{{ old('name',$game->name) }}" required></div>
<div class="col-md-3"><label class="form-label">Genre</label><input name="genre" class="form-control" value="{{ old('genre',$game->genre) }}" required></div>
<div class="col-md-4"><label class="form-label">Developer</label><input name="developer" class="form-control" value="{{ old('developer',$game->developer) }}" required></div>
<div class="col-md-4"><label class="form-label">Publisher</label><input name="publisher" class="form-control" value="{{ old('publisher',$game->publisher) }}"></div>
<div class="col-md-4"><label class="form-label">Platform</label><input name="platform" class="form-control" value="{{ old('platform',$game->platform) }}" required></div>
<div class="col-md-2"><label class="form-label">Max Players</label><input type="number" name="max_players" class="form-control" value="{{ old('max_players',$game->max_players ?? 10) }}" min="2" required></div>
<div class="col-md-2"><label class="form-label">Status</label><select name="status" class="form-select">@foreach(['active','inactive'] as $status)<option value="{{ $status }}" @selected(old('status',$game->status ?? 'active')===$status)>{{ ucfirst($status) }}</option>@endforeach</select></div>
<div class="col-12"><label class="form-label">Description</label><textarea name="description" class="form-control" rows="4">{{ old('description',$game->description) }}</textarea></div>
<div class="col-12"><button class="btn btn-primary">Save Game</button></div></div></div></div>
