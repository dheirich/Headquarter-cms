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

