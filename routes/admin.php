<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ArtikelController;

Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('artikel', ArtikelController::class);
    // ... routes lainnya
});