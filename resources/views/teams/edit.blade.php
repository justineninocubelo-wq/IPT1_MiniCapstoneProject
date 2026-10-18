
@php
    $editorTitle = 'Edit Team';
    $editorCategory = 'ESPORTS ORGANIZATIONS';
    $editorMode = 'EDIT ENTRY';
    $editorDescription = 'Build and manage your competitive esports organization.';
    $editorResource = 'teams';
    $editorPlural = 'Teams';
    $editorAction = route('teams.update', $team);
    $editorUpload = true;
    $editorIsEdit = true;
@endphp

@extends('layouts.gtms-editor')
