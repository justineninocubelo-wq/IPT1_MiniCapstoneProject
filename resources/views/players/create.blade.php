@extends('layouts.app')
@section('title','Add Player')
@section('content')
<div class="d-flex justify-content-between mb-4"><h2 class="fw-bold">Add Player</h2><a href="{{ route('players.index') }}" class="btn btn-outline-secondary">Back</a></div>
<form method="POST" action="{{ route('players.store') }}">@csrf @include('players.form')</form>
@endsection
