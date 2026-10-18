
@php
    $editorTitle = 'Add Player';
    $editorCategory = 'PLAYER ROSTER';
    $editorMode = 'NEW ENTRY';
    $editorDescription = 'Manage gamer identities, team assignments and player profiles.';
    $editorResource = 'players';
    $editorPlural = 'Players';
    $editorAction = route('players.store');
    $editorUpload = true;
    $editorIsEdit = false;
@endphp

@extends('layouts.gtms-editor')
