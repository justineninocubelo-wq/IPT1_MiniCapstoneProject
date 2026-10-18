
@php
    $editorTitle = 'Edit Game';
    $editorCategory = 'GAME LIBRARY';
    $editorMode = 'EDIT ENTRY';
    $editorDescription = 'Manage game titles, platforms and promotional artwork.';
    $editorResource = 'games';
    $editorPlural = 'Games';
    $editorAction = route('games.update', $game);
    $editorUpload = true;
    $editorIsEdit = true;
@endphp

@extends('layouts.gtms-editor')
