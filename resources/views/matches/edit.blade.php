
@php
    $editorTitle = 'Edit Match';
    $editorCategory = 'MATCH CONTROL';
    $editorMode = 'EDIT ENTRY';
    $editorDescription = 'Manage matchups, schedules, results and winners.';
    $editorResource = 'matches';
    $editorPlural = 'Matches';
    $editorAction = route('matches.update', $match);
    $editorUpload = false;
    $editorIsEdit = true;
@endphp

@extends('layouts.gtms-editor')
