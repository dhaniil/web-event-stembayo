<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\VerifyEmailController;

use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    // Display login/register form
    Route::get('/auth', [AuthenticatedSessionController::class, 'create'])
        ->name('login');
        
    // Form submission endpoints
    Route::post('/auth/login', [AuthenticatedSessionController::class, 'store'])
        ->name('login.store');
        
    Route::post('/auth/register', [RegisteredUserController::class, 'store'])
        ->name('register.store');

    // Redirect old /register to /auth with register mode
    Route::get('/register', function () {
        return redirect()->route('login', ['mode' => 'register']);
    })->name('register');

    Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])
        ->name('password.request');

    Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])
        ->name('password.email');

    Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])
        ->name('password.reset');

    Route::post('reset-password', [NewPasswordController::class, 'store'])
        ->name('password.store');
});

Route::middleware('auth')->group(function () {
    Route::get('verify-email', EmailVerificationPromptController::class)
        ->name('verification.notice');

    Route::get('verify-email/{id}/{hash}', VerifyEmailController::class)
        ->middleware(['signed', 'throttle:6,1'])
        ->name('verification.verify');

    Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
        ->middleware('throttle:6,1')
        ->name('verification.send');

    Route::get('confirm-password', [ConfirmablePasswordController::class, 'show'])
        ->name('password.confirm');

    Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']);

    Route::put('password', [PasswordController::class, 'update'])->name('password.update');

<<<<<<< HEAD
    Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
=======
    Route::delete('/auth/logout', [AuthenticatedSessionController::class, 'destroy'])
>>>>>>> 85bb9ea (Save changes before pulling updates)
        ->name('logout');
    Route::delete('/auth/logout', [AuthenticatedSessionController::class, 'destroy']);

});
