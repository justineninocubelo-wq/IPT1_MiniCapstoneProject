
@php
    $editorTitle = 'Add Tournament';
    $editorCategory = 'COMPETITION CENTER';
    $editorMode = 'NEW ENTRY';
    $editorDescription = 'Set up competition formats, venues and prize pools.';
    $editorResource = 'tournaments';
    $editorPlural = 'Tournaments';
    $editorAction = route('tournaments.store');
    $editorUpload = false;
    $editorIsEdit = false;
@endphp

@extends('layouts.gtms-editor')
