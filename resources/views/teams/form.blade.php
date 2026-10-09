<div class="card"><div class="card-body p-4"><div class="row g-3">
<div class="col-md-6"><label class="form-label">Team Name</label><input name="name" class="form-control" value="{{ old('name',$team->name) }}" required></div>
<div class="col-md-2"><label class="form-label">Tag</label><input name="tag" class="form-control" maxlength="10" value="{{ old('tag',$team->tag) }}" required></div>
<div class="col-md-4"><label class="form-label">Captain</label><input name="captain_name" class="form-control" value="{{ old('captain_name',$team->captain_name) }}" required></div>
<div class="col-md-4"><label class="form-label">Coach</label><input name="coach_name" class="form-control" value="{{ old('coach_name',$team->coach_name) }}"></div>
<div class="col-md-4"><label class="form-label">Country</label><input name="country" class="form-control" value="{{ old('country',$team->country) }}" required></div>
<div class="col-md-2"><label class="form-label">Founded Year</label><input type="number" name="founded_year" class="form-control" value="{{ old('founded_year',$team->founded_year) }}"></div>
<div class="col-md-2"><label class="form-label">Status</label><select name="status" class="form-select">@foreach(['active','inactive','disbanded'] as $status)<option value="{{ $status }}" @selected(old('status',$team->status ?? 'active')===$status)>{{ ucfirst($status) }}</option>@endforeach</select></div>
<div class="col-12"><label class="form-label">Description</label><textarea name="description" class="form-control" rows="4">{{ old('description',$team->description) }}</textarea></div>
<div class="col-12"><button class="btn btn-primary">Save Team</button></div></div></div></div>
