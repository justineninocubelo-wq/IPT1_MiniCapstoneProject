
@php
    $editorTitle = 'Add Game';
    $editorCategory = 'GAME LIBRARY';
    $editorMode = 'NEW ENTRY';
    $editorDescription = 'Manage game titles, platforms and promotional artwork.';
    $editorResource = 'games';
    $editorPlural = 'Games';
    $editorAction = route('games.store');
    $editorUpload = true;
    $editorIsEdit = false;
@endphp

@extends('layouts.gtms-editor')
