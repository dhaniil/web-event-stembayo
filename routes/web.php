<?php


use App\Http\Controllers\EventController;
use App\Http\Controllers\TicketController;
use Illuminate\Support\Facades\Route;

Route::get('/vue', function () {
    return view('events.vue');
});

Route::get('/', [EventController::class, 'index'])->name('events.dashboard');

Route::get('/events/{id}', [EventController::class, 'show'])->name('events.show');
Route::post('/events/{id}/ticket', [TicketController::class, 'beli'])->name('tickets.purchase');

// Rute baru untuk menambah event
Route::get('/tambah', [EventController::class, 'create'])->name('events.create');
Route::post('/events', [EventController::class, 'store'])->name('events.store');

Route::get('/event/only', [EventController::class, 'EventPage'])->name('events.eventonly');

Route::get('/coba', function () {
    return view('cobaygy.home');
});

//Validasi role user
Route::group(['middleware' => ['admin']], function () {
    Route::get('/admin/dashboard', [AdminController::class, 'index']);
    Route::resource('/admin/events', EventController::class);
});

Route::group(['middleware' => ['sekbid']], function () {
    Route::get('/sekbid/events', [SekbidController::class, 'index']);
    Route::resource('/sekbid/events', EventController::class)->except(['create', 'delete']);
});

