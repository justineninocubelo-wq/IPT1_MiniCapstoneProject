
@php
    $editorTitle = 'Edit Tournament';
    $editorCategory = 'COMPETITION CENTER';
    $editorMode = 'EDIT ENTRY';
    $editorDescription = 'Set up competition formats, venues and prize pools.';
    $editorResource = 'tournaments';
    $editorPlural = 'Tournaments';
    $editorAction = route('tournaments.update', $tournament);
    $editorUpload = false;
    $editorIsEdit = true;
@endphp

@extends('layouts.gtms-editor')
