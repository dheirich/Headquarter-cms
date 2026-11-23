<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;

Route::get('/', function () {
    return view('login');
})->name('login');

Route::post('/auth/login', [LoginController::class, 'store'])->name('auth.login');
