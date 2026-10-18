
@php
    $editorTitle = 'Add Team';
    $editorCategory = 'ESPORTS ORGANIZATIONS';
    $editorMode = 'NEW ENTRY';
    $editorDescription = 'Build and manage your competitive esports organization.';
    $editorResource = 'teams';
    $editorPlural = 'Teams';
    $editorAction = route('teams.store');
    $editorUpload = true;
    $editorIsEdit = false;
@endphp

@extends('layouts.gtms-editor')
