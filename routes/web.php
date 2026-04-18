<?php

use App\Http\Controllers\Web\HomeController;
use App\Http\Controllers\Web\PortfolioController;
use App\Http\Controllers\Web\ServicesController;
use App\Http\Controllers\Web\ArtikelController;
use App\Http\Controllers\Web\AboutController;
use App\Http\Controllers\Web\ContactController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes for Bogorior KitchenSet
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your frontend website.
| All routes are for public access (no authentication required).
|
*/

// ============================================================
// MAIN ROUTES
// ============================================================

// Home Page
Route::get('/', [HomeController::class, 'index'])->name('home');

// Portfolio Routes
Route::prefix('portfolio')->name('portfolio.')->group(function () {
    Route::get('/', [PortfolioController::class, 'index'])->name('index');
    Route::get('/{id}', [PortfolioController::class, 'detail'])->name('detail');
    Route::get('/category/{category}', [PortfolioController::class, 'byCategory'])->name('category');
});

// Services Routes
Route::prefix('services')->name('services.')->group(function () {
    Route::get('/', [ServicesController::class, 'index'])->name('index');
    Route::get('/{slug}', [ServicesController::class, 'detail'])->name('detail');
});

// Blog/Articles Routes
Route::prefix('blog')->name('blog.')->group(function () {
    Route::get('/', [ArtikelController::class, 'index'])->name('index');
    Route::get('/{slug}', [ArtikelController::class, 'show'])->name('show');
    Route::get('/category/{category}', [ArtikelController::class, 'byCategory'])->name('category');
    Route::get('/tag/{tag}', [ArtikelController::class, 'byTag'])->name('tag');
});

// ============================================================
// STATIC PAGES ROUTES
// ============================================================

// About Page
Route::get('/about', [AboutController::class, 'index'])->name('about');

// Contact Page - GET (display form)
Route::get('/contact', [ContactController::class, 'index'])->name('contact');

// Contact Page - POST (submit form)
Route::post('/contact', [ContactController::class, 'submit'])->name('contact.submit');

// ============================================================
// UTILITY ROUTES
// ============================================================

// Search Route
Route::get('/search', function () {
    return view('public.search');
})->name('search');

// Privacy Policy
Route::get('/privacy-policy', function () {
    return view('public.privacy-policy');
})->name('privacy-policy');

// Terms & Conditions
Route::get('/terms', function () {
    return view('public.terms');
})->name('terms');

// Sitemap
Route::get('/sitemap.xml', function () {
    // Will be implemented later
    return response()->view('sitemap')->header('Content-Type', 'text/xml');
})->name('sitemap');

// ============================================================
// FALLBACK ROUTE FOR 404
// ============================================================
Route::fallback(function () {
    return view('errors.404');
});