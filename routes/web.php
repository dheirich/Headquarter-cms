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

    Route::view('/manage-members', 'management.manage-members')
        ->name('manage-members');

    Route::view('/promoting-members', 'management.promoting-members')
        ->name('promoting-members');

    Route::view('/ban-lists', 'management.ban-lists')
        ->name('ban-lists');

    Route::view('/manage-squads', 'management.manage-squads')
        ->name('manage-squads');

    Route::view('/manage-teams', 'management.manage-teams')
        ->name('manage-teams');
});
