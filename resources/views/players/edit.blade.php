@extends('layouts.app')
@section('title','Edit Player')
@section('content')
<div class="d-flex justify-content-between mb-4"><h2 class="fw-bold">Edit Player</h2><a href="{{ route('players.index') }}" class="btn btn-outline-secondary">Back</a></div>
<form method="POST" action="{{ route('players.update',$player) }}">@csrf @method('PUT') @include('players.form')</form>
@endsection
