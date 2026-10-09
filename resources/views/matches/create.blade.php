@extends('layouts.app')
@section('title','Add Match')
@section('content')<div class="d-flex justify-content-between mb-4"><h2 class="fw-bold">Add Match</h2><a href="{{ route('matches.index') }}" class="btn btn-outline-secondary">Back</a></div><form method="POST" action="{{ route('matches.store') }}">@csrf @include('matches.form')</form>@endsection
