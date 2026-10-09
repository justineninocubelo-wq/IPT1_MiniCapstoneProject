@extends('layouts.app')
@section('title','Edit Team')
@section('content')<div class="d-flex justify-content-between mb-4"><h2 class="fw-bold">Edit Team</h2><a href="{{ route('teams.index') }}" class="btn btn-outline-secondary">Back</a></div><form method="POST" action="{{ route('teams.update',$team) }}">@csrf @method('PUT') @include('teams.form')</form>@endsection
