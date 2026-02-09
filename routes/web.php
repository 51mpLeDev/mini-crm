<?php

use App\Http\Controllers\Admin\TicketController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\WidgetController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::get('/widget', WidgetController::class);

Route::middleware(['auth', 'role:manager'])
    ->prefix('admin')
    ->group(function () {
        Route::get('/tickets', [TicketController::class, 'index'])->name('admin.tickets.index');
        Route::get('/tickets/{ticket}', [TicketController::class, 'show'])->name('admin.tickets.show');
        Route::patch('/tickets/{ticket}', [TicketController::class, 'update'])->name('admin.tickets.update');
    });

require __DIR__.'/auth.php';
