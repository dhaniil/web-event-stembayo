<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\SidebarController;
use App\Http\Middleware\AdminMiddleware;
use Illuminate\Support\Facades\Route;
use App\Files;


// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/ygy', function () {
    return view('cobaygy.iseng');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

//Auth login
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

// Route::get('/vue', function () {
//     return view('events.vue');
// });



Route::get('/', [EventController::class, 'index'])->name('events.dashboard');


Route::get('/events/{id}', [EventController::class, 'show'])->name('events.show');
Route::post('/events/{id}/ticket', [TicketController::class, 'beli'])->name('tickets.purchase');

// Rute baru untuk menambah event

Route::post('/events', [EventController::class, 'store'])->name('events.store');
Route::get('/tambah', [EventController::class, 'create'])->name('events.create');

Route::get('/event/only', [EventController::class, 'EventPage'])->name('events.eventonly');

Route::get('/coba', function () {
    return view('tickets.cart');
});

Route::get('/events/{id}/edit', [EventController::class, 'edit'])->name('events.edit');
Route::put('/events/{id}', [EventController::class, 'update'])->name('events.update');

//Validasi role user
// Route::group(['middleware' => ['admin']], function () {
//     Route::get('/admin/dashboard', [AdminController::class, 'index']);
//     Route::resource('/admin/events', EventController::class);
// });

// Route::group(['middleware' => ['sekbid']], function () {

//     Route::get('/sekbid/events', [SekbidController::class, 'index']);
//     Route::resource('/sekbid/events', EventController::class)->except(['create', 'delete']);
// });

// Route::middleware([AdminMiddleware::class])->group(function () {
//     Route::get('/tambah', [EventController::class, 'create'])->name('events.create');
    
// });

// Route::get('/event/only', [SidebarController::class, 'getUserInfo'])->middleware('auth')->name('events.eventonly');