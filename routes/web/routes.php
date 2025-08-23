<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome/WelcomePage');
})->name('home');

Route::inertia('/me', 'Welcome/WelcomePage')
    ->middleware(['auth', 'verified'])
    ->name('me');

require __DIR__.'/../auth/routes.php';
