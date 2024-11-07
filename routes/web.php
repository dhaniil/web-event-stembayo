<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\SidebarController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// Landing Page
Route::get('/', [EventController::class, 'index'])->name('events.dashboard');

// Authentication bawaan breeze
Route::middleware('auth')->group(function () {
    Route::get('/profile', [UserController::class, 'editProfile'])->name('profile.edit');
    Route::post('/profile/update', [UserController::class, 'updateProfile'])->name('profile.update');
    Route::delete('/profile', [UserController::class, 'destroy'])->name('profile.destroy');
    Route::post('/profile/update-password', [UserController::class, 'updatePassword'])->name('profile.update.password');
});

// Event 
Route::get('/events/{id}', [EventController::class, 'show'])->name('events.show');
Route::post('/events/{id}/review', [EventController::class, 'storeReview'])->name('events.storeReview');
Route::post('/events', [EventController::class, 'store'])->name('events.store');
Route::get('/event/only', [EventController::class, 'EventPage'])->name('events.eventonly');
Route::get('/events/{id}/edit', [EventController::class, 'edit'])->name('events.edit');
Route::put('/events/{id}', [EventController::class, 'update'])->name('events.update');

// Admin Only 
Route::get('/tambah', function () {
    if (auth()->check() && auth()->user()->role === 'admin') {
        return app(EventController::class)->create();
    }
    return redirect('/')->with('error', 'Anda tidak memiliki akses ke halaman ini.');
})->name('events.create');

// User Management 
Route::prefix('users')->group(function () {
    Route::get('/', [UserController::class, 'index'])->name('users.index');
    Route::get('/create', [UserController::class, 'create'])->name('users.create');
    Route::post('/', [UserController::class, 'store'])->name('users.store');
    Route::get('/{id}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::put('/{id}', [UserController::class, 'update'])->name('users.update');
    Route::delete('/{id}', [UserController::class, 'destroy'])->name('users.destroy');
});

// Test 
Route::get('/ygy', function () {
    return view('cobaygy.iseng');
});

Route::get('/coba', function () {
    return view('tickets.cart');
});

Route::get('/gabut', function () {
    return view('cobaygy.anime');
});

require __DIR__.'/auth.php';

// Sidebar
