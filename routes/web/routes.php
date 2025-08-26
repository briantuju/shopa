<?php

use App\Http\Controllers\Account\ProfileController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome/WelcomePage');
})->name('home');

Route::get('/account', [ProfileController::class, 'getProfile'])
    ->middleware(['auth', 'verified'])
    ->name('me');

require __DIR__.'/../auth/routes.php';
