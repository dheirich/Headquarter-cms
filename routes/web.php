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


Route::middleware('auth')->group(function () {

    // Dashboard
    Route::view('/dashboard', 'dashboard')
        ->name('dashboard');


    // Management Routes Testing

    Route::view('/manage-members', 'components.navigation_dashboard.manage-members')
        ->name('manage-members');

    Route::view('/promoting-members', 'components.navigation_dashboard.promoting-members')
        ->name('promoting-members');

    Route::view('/ban-lists', 'components.navigation_dashboard.ban-lists')
        ->name('ban-lists');

    Route::view('/manage-squads', 'components.navigation_dashboard.manage-squads')
        ->name('manage-squads');

    Route::view('/manage-teams', 'components.navigation_dashboard.manage-teams')
        ->name('manage-teams');
});
