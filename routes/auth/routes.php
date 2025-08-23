<?php

use App\Http\Controllers\Auth\EmailVerificationController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\SignupController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')
    ->prefix('auth')
    ->as('auth.')
    ->group(function () {
        Route::inertia('/signup', 'auth/Signup/SignupPage')
            ->name('signup-page');

        Route::post('/signup', [SignupController::class, 'signup'])
            ->name('signup');

        Route::inertia('/login', 'auth/Login/LoginPage')
            ->name('login-page');

        Route::post('/login', [LoginController::class, 'authenticate'])
            ->name('login');
    });

// Handle email verification here
Route::middleware('auth')
    ->as('verification.')
    ->group(function () {
        Route::get('/email/verify', [EmailVerificationController::class, 'show'])
            ->name('notice');

        Route::get('/email/verify/{id}/{hash}', [EmailVerificationController::class, 'verify'])
            ->middleware('signed')
            ->name('verify');

        Route::post('/email/verification-notification', [EmailVerificationController::class, 'resend'])
            ->middleware('throttle:3,60') // 3 emails per hour
            ->name('send');
    });

// Handle password reset
Route::inertia('/forgot-password', 'auth/Password/ForgotPasswordPage')
    ->middleware('guest')
    ->name('password.request');

Route::post('/forgot-password', [ForgotPasswordController::class, 'sendResetEmail'])
    ->middleware(['guest', 'throttle:5,60']) // 5 emails per hour
    ->name('password.email');

Route::get('/reset-password/{token}', [ResetPasswordController::class, 'showResetPage'])
    ->middleware('guest')
    ->name('password.reset');

Route::post('/reset-password', [ResetPasswordController::class, 'resetPassword'])
    ->middleware('guest')
    ->name('password.update');

Route::middleware('auth')
    ->prefix('auth')
    ->as('auth.')
    ->group(function () {
        Route::post('/logout', [LoginController::class, 'logout'])
            ->name('logout');
    });
