<?php

use App\Http\Controllers\ReviewController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\SidebarController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\FavouriteController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UlasanController;

// Landing Page
Route::get('/', [EventController::class, 'index'])->name('events.dashboard');

// Profile
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'editProfile'])->name('profile.edit');
    Route::post('/profile/update', [ProfileController::class, 'updateProfile'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::post('/profile/update-password', [ProfileController::class, 'updatePassword'])->name('profile.update.password');
    Route::post('/profile/update-picture', [ProfileController::class, 'updateProfilePicture'])->name('profile.update.picture');
    Route::post('/profile/delete-picture', [ProfileController::class, 'deleteProfilePicture'])->name('profile.delete.picture');
});

//Ulasan
Route::middleware(['auth'])->group(function () {
    Route::post('/ulasan', [UlasanController::class, 'store'])->name('ulasan.store');
    Route::delete('/ulasan/{id}', [UlasanController::class, 'destroy'])->name('ulasan.destroy');
});

// Event 
Route::get('/events/{event}', [EventController::class, 'show'])->name('events.show');
Route::post('/events/{id}/review', [ReviewController::class, 'store'])->name('events.storeReview');
Route::post('/events', [EventController::class, 'store'])->name('events.store');
Route::get('/event/only', [EventController::class, 'EventPage'])->name('events.eventonly');
Route::get('/events/{id}/edit', [EventController::class, 'edit'])->name('events.edit');
Route::put('/events/{id}', [EventController::class, 'update'])->name('events.update');


// Favourite
Route::post('/favourite/{eventId}', [FavouriteController::class, 'favourite'])->middleware('auth')->name('favourite.add');
Route::delete('/favourite/{eventId}', [FavouriteController::class, 'unfavourite'])->middleware('auth')->name('favourite.remove');
Route::get('/favourites', [FavouriteController::class, 'favouriteEvents'])->name('favourites');

// Test 
Route::get('/ygy', function () {
    return view('cobaygy.iseng');
});

Route::get('/coba', function () {
    return view('tickets.cart');
});

require __DIR__.'/auth.php';
