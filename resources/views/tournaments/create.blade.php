@extends('layouts.app')
@section('title','Add Tournament')
@section('content')<div class="d-flex justify-content-between mb-4"><h2 class="fw-bold">Add Tournament</h2><a href="{{ route('tournaments.index') }}" class="btn btn-outline-secondary">Back</a></div><form method="POST" action="{{ route('tournaments.store') }}">@csrf @include('tournaments.form')</form>@endsection
