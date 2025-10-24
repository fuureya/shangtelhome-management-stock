<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::get('/', function () {
    return redirect('/login');
});

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/redirect', function () {
    return redirect()->route('login');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\StockController::class, 'showDashboard'])->name('dashboard');

    Route::middleware(['can:manage-stock'])->group(function () {
        Route::get('/kelola-stock', [App\Http\Controllers\StockController::class, 'index'])->name('kelola-stock.index');
        Route::post('/kelola-stock', [App\Http\Controllers\StockController::class, 'store'])->name('kelola-stock.store');
        Route::get('/kelola-stock/{stock}/edit', [App\Http\Controllers\StockController::class, 'edit'])->name('kelola-stock.edit');
        Route::put('/kelola-stock/{stock}', [App\Http\Controllers\StockController::class, 'update'])->name('kelola-stock.update');
        Route::delete('/kelola-stock/{stock}', [App\Http\Controllers\StockController::class, 'destroy'])->name('kelola-stock.destroy');

        Route::get('/pakai-stock', [App\Http\Controllers\StockController::class, 'pakaiStockForm'])->name('pakai-stock.form');
        Route::post('/pakai-stock', [App\Http\Controllers\StockController::class, 'pakaiStock'])->name('pakai-stock.process');

        Route::get('/tambah-stock', [App\Http\Controllers\StockController::class, 'tambahStockForm'])->name('tambah-stock.form');
        Route::post('/tambah-stock', [App\Http\Controllers\StockController::class, 'tambahStock'])->name('tambah-stock.process');
    });

    // User Management Routes
    Route::middleware(['can:manage-users'])->group(function () {
        Route::get('/kelola-user', [App\Http\Controllers\UserController::class, 'index'])->name('kelola-user.index');
        Route::get('/kelola-user/create', [App\Http\Controllers\UserController::class, 'create'])->name('kelola-user.create');
        Route::post('/kelola-user', [App\Http\Controllers\UserController::class, 'store'])->name('kelola-user.store');
        Route::get('/kelola-user/{user}/edit', [App\Http\Controllers\UserController::class, 'edit'])->name('kelola-user.edit');
        Route::put('/kelola-user/{user}', [App\Http\Controllers\UserController::class, 'update'])->name('kelola-user.update');
        Route::delete('/kelola-user/{user}', [App\Http\Controllers\UserController::class, 'destroy'])->name('kelola-user.destroy');
    });
});
