<?php

use App\Http\Controllers\Api\ArtikelApiController;
use App\Http\Controllers\Api\ProjectApiController;

Route::prefix('public')->group(function () {
    Route::get('/artikel', [ArtikelApiController::class, 'index']);
    Route::get('/artikel/{id}', [ArtikelApiController::class, 'show']);
    Route::get('/artikel/featured', [ArtikelApiController::class, 'featured']);
    Route::get('/projects', [ProjectApiController::class, 'index']);
    // ... routes lainnya
});