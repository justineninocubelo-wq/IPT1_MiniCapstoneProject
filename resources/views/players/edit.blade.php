
@php
    $editorTitle = 'Edit Player';
    $editorCategory = 'PLAYER ROSTER';
    $editorMode = 'EDIT ENTRY';
    $editorDescription = 'Manage gamer identities, team assignments and player profiles.';
    $editorResource = 'players';
    $editorPlural = 'Players';
    $editorAction = route('players.update', $player);
    $editorUpload = true;
    $editorIsEdit = true;
@endphp

@extends('layouts.gtms-editor')
