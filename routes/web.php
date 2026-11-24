<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;

Route::get('/', function () {
    return view('login');
})
    ->name('login');

// Login
Route::post('/auth/login', [LoginController::class, 'store'])
    ->name('auth.login');

// Dashboard
Route::view('/dashboard', 'dashboard')
    ->name('dashboard')
    ->middleware('auth');

// Management Routes Testing
Route::view('/manage-members', 'components.navigation_dashboard.manage-members')
    ->name('manage-members')
    ->middleware('auth');

Route::view('/promoting-members', 'components.navigation_dashboard.promoting-members')
    ->name('promoting-members')
    ->middleware('auth');

Route::view('/ban-lists', 'components.navigation_dashboard.ban-lists')
    ->name('ban-lists')
    ->middleware('auth');

Route::view('/manage-squads', 'components.navigation_dashboard.manage-squads')
    ->name('manage-squads')
    ->middleware('auth');

Route::view('/manage-teams', 'components.navigation_dashboard.manage-teams')
    ->name('manage-teams')
    ->middleware('auth');
