@extends('layouts.app')
@section('title','Edit Tournament')
@section('content')<div class="d-flex justify-content-between mb-4"><h2 class="fw-bold">Edit Tournament</h2><a href="{{ route('tournaments.index') }}" class="btn btn-outline-secondary">Back</a></div><form method="POST" action="{{ route('tournaments.update',$tournament) }}">@csrf @method('PUT') @include('tournaments.form')</form>@endsection
