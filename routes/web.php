<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Public\HomeController;
use App\Http\Controllers\Public\BlogController;
use App\Http\Controllers\Public\PortfolioController;
use App\Http\Controllers\Public\ServicesController;
use App\Http\Controllers\Public\AboutController;
use App\Http\Controllers\Public\ContactController;

// Public routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/blog', [BlogController::class, 'index'])->name('blog.index');
Route::get('/portfolio', [PortfolioController::class, 'index'])->name('portfolio.index');
Route::get('/services', [ServicesController::class, 'index'])->name('services.index');
Route::get('/about', [AboutController::class, 'index'])->name('about.index');
Route::get('/contact', [ContactController::class, 'index'])->name('contact.index');