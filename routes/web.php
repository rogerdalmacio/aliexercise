<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/dashboard', [\App\Http\Controllers\UserController::class, 'index'])->name('dashboard');

    Route::as('users.')
        ->prefix('users')
        ->group(function () {
            Route::get('/create', [\App\Http\Controllers\UserController::class, 'create'])->name('create');
            Route::get('/edit/{user}', [\App\Http\Controllers\UserController::class, 'edit'])->name('edit');
            Route::post('/store', [\App\Http\Controllers\UserController::class, 'store'])->name('store');
            Route::delete('/delete/{user}', [\App\Http\Controllers\UserController::class, 'delete'])->name('delete');
        });
});

require __DIR__.'/auth.php';
