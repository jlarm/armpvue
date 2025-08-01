<?php

use App\Domains\Dealership\Http\Controllers\DealershipController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome');
})->name('home');

Route::get('dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth', 'verified'])->group(function () {

    Route::prefix('dealerships')->group(function () {
        Route::get('/', [DealershipController::class, 'index'])->name('dealerships.index');
        Route::get('/{dealership:uuid}', [DealershipController::class, 'show'])->name('dealerships.show');
    });

});

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
