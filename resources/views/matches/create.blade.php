
@php
    $editorTitle = 'Add Match';
    $editorCategory = 'MATCH CONTROL';
    $editorMode = 'NEW ENTRY';
    $editorDescription = 'Manage matchups, schedules, results and winners.';
    $editorResource = 'matches';
    $editorPlural = 'Matches';
    $editorAction = route('matches.store');
    $editorUpload = false;
    $editorIsEdit = false;
@endphp

@extends('layouts.gtms-editor')
