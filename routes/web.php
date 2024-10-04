<?php


use App\Http\Controllers\EventController;
use App\Http\Controllers\TicketController;
use Illuminate\Support\Facades\Route;

Route::get('/vue', function () {
    return view('events.vue');
});

Route::get('/', [EventController::class, 'index'])->name('events.dashboard');

Route::get('/events/{id}', [EventController::class, 'show'])->name('events.show');
Route::post('/events/{id}/purchase', [TicketController::class, 'purchase'])->name('tickets.purchase');

// Rute baru untuk menambah event
Route::get('/events/create', [EventController::class, 'create'])->name('events.create');
Route::post('/events', [EventController::class, 'store'])->name('events.store');

Route::get('/coba', function () {
    return view('cobaygy.home');
});