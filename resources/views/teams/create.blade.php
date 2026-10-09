@extends('layouts.app')
@section('title','Add Team')
@section('content')<div class="d-flex justify-content-between mb-4"><h2 class="fw-bold">Add Team</h2><a href="{{ route('teams.index') }}" class="btn btn-outline-secondary">Back</a></div><form method="POST" action="{{ route('teams.store') }}">@csrf @include('teams.form')</form>@endsection
