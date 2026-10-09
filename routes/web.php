<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GameController;
use App\Http\Controllers\MatchController;
use App\Http\Controllers\PlayerController;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\TournamentController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {

    Route::get('/login', [AuthController::class, 'showLogin'])
        ->name('login');

    Route::post('/login', [AuthController::class, 'login']);
});

Route::post('/logout', [AuthController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');

Route::middleware('auth')->group(function () {

    Route::get('/upcoming-matches', [MatchController::class, 'upcoming'])
        ->name('upcoming-matches');

    Route::get('/matches/{match}', [MatchController::class, 'show'])
        ->name('matches.show');

    Route::middleware('admin')->group(function () {

        Route::get('/', [DashboardController::class, 'index'])
            ->name('dashboard');

        Route::resources([
            'players' => PlayerController::class,
            'teams' => TeamController::class,
            'games' => GameController::class,
            'tournaments' => TournamentController::class,
        ]);

        Route::resource('matches', MatchController::class)
            ->except(['show']);
    });
});