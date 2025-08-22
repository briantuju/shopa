<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome/WelcomePage');
})->name('home');

require __DIR__.'/../auth/routes.php';
