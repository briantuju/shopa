<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\SignupController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::middleware('guest')
    ->prefix('auth')
    ->as('auth.')
    ->group(function () {
        Route::get('/signup', fn () => Inertia::render('auth/Signup/SignupPage'))
            ->name('signup-page');

        Route::post('/signup', [SignupController::class, 'signup'])
            ->name('signup');

        Route::get('/login', fn () => Inertia::render('auth/Login/LoginPage'))
            ->name('login-page');

        Route::post('/login', [LoginController::class, 'authenticate'])
            ->name('login');
    });

Route::middleware('auth')
    ->prefix('auth')
    ->as('auth.')
    ->group(function () {
        //        Route::get('/me', function () {
        //            return response()->json(auth()->user());
        //        })->name('me');

        Route::post('/logout', [LoginController::class, 'logout'])
            ->name('logout');
    });
