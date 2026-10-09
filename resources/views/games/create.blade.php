@extends('layouts.app')
@section('title','Add Game')
@section('content')<div class="d-flex justify-content-between mb-4"><h2 class="fw-bold">Add Game</h2><a href="{{ route('games.index') }}" class="btn btn-outline-secondary">Back</a></div><form method="POST" action="{{ route('games.store') }}">@csrf @include('games.form')</form>@endsection
