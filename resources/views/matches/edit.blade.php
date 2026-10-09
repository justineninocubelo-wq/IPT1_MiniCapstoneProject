@extends('layouts.app')
@section('title','Edit Match')
@section('content')<div class="d-flex justify-content-between mb-4"><h2 class="fw-bold">Edit Match</h2><a href="{{ route('matches.index') }}" class="btn btn-outline-secondary">Back</a></div><form method="POST" action="{{ route('matches.update',$match) }}">@csrf @method('PUT') @include('matches.form')</form>@endsection
