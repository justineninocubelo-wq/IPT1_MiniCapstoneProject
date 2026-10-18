
@extends('layouts.app')

@section('title', $editorTitle)

@section('styles')
    @parent
    <link rel="stylesheet" href="{{ asset('css/gtms-forms.css') }}">
@endsection

@section('content')
<div class="gtms-editor">
    <div class="editor-heading">
        <div>
            <div class="editor-kicker">
                {{ $editorCategory }} / {{ $editorMode }}
            </div>

            <h2 class="editor-title">{{ $editorTitle }}</h2>

            <p class="editor-subtitle">
                {{ $editorDescription }}
            </p>
        </div>

        <a class="editor-back" href="{{ route($editorResource . '.index') }}">
            ← Back to {{ $editorPlural }}
        </a>
    </div>

    @if ($errors->any())
        <div class="editor-errors">
            <strong>Please check the highlighted fields.</strong>

            <ul class="mb-0 mt-2">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form
        method="POST"
        action="{{ $editorAction }}"
        @if ($editorUpload) enctype="multipart/form-data" @endif
    >
        @csrf

        @if ($editorIsEdit)
            @method('PUT')
        @endif

        @include($editorResource . '.form')
    </form>
</div>
@endsection
