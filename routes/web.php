<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\SidebarController;
use App\Http\Middleware\AdminMiddleware;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
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

Route::get('/', [EventController::class, 'index'])->name('events.dashboard');


Route::get('/events/{id}', [EventController::class, 'show'])->name('events.show');
Route::post('/events/{id}/ticket', [TicketController::class, 'beli'])->name('tickets.purchase');



Route::post('/events', [EventController::class, 'store'])->name('events.store');
// Route::get('/tambah', [EventController::class, 'create'])->name('events.create');
// Rute untuk menambahkan event dengan middleware auth dan pemeriksaan role admin
Route::get('/tambah', function () {
    // Hanya pengguna yang terautentikasi dan memiliki role admin yang dapat menggunakan rute ini
    if (auth()->check() && auth()->user()->role === 'admin') {
        return app(EventController::class)->create();
    }
    // Jika bukan admin, redirect ke halaman lain dengan pesan error
    return redirect('/')->with('error', 'Anda tidak memiliki akses ke halaman ini.');
})->name('events.create');

Route::get('/event/only', [EventController::class, 'EventPage'])->name('events.eventonly');

Route::get('/coba', function () {
    return view('tickets.cart');
});

Route::get('/events/{id}/edit', [EventController::class, 'edit'])->name('events.edit');
Route::put('/events/{id}', [EventController::class, 'update'])->name('events.update');


//CRUD User


Route::get('/users', [UserController::class, 'index'])->name('users.index');
Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
Route::post('/users', [UserController::class, 'store'])->name('users.store');
Route::get('/users/{id}/edit', [UserController::class, 'edit'])->name('users.edit');
Route::put('/users/{id}', [UserController::class, 'update'])->name('users.update');
Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('users.destroy');

