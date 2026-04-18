<?php

use App\Http\Controllers\Api\ProjectController;
use App\Http\Controllers\Api\TestimoniController;
use App\Http\Controllers\Api\PaketController;
use App\Http\Controllers\Api\FaqController;
use App\Http\Controllers\Api\AreaController;
use App\Http\Controllers\Api\SettingController;
use App\Http\Controllers\Api\ArtikelController;
use App\Http\Controllers\Api\KonsultasiController;
use App\Http\Controllers\Api\KontakController;
use App\Http\Controllers\Api\SubscriberController;
use App\Http\Controllers\Api\TeamController;
use App\Http\Controllers\Api\HalamanController;
use App\Http\Controllers\Api\StatsController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes for Bogorior KitchenSet Public Website
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your public frontend.
| All routes are prefixed with /api/public
|
*/

Route::prefix('public')->group(function () {

    // ============================================================
    // 1. PROJECTS (PORTFOLIO) ROUTES
    // ============================================================
    Route::prefix('projects')->group(function () {
        Route::get('/', [ProjectController::class, 'getAll']);
        Route::get('/featured', [ProjectController::class, 'getFeatured']);
        Route::get('/detail', [ProjectController::class, 'getById']);
        Route::get('/by-code', [ProjectController::class, 'getByCode']);
        Route::get('/stats', [ProjectController::class, 'getStats']);
        Route::get('/filters', [ProjectController::class, 'getFilters']);
    });

    // Alternative simple routes for backward compatibility
    Route::get('/projects', [ProjectController::class, 'getAll']);
    Route::get('/project', [ProjectController::class, 'getById']);
    Route::get('/project-stats', [ProjectController::class, 'getStats']);
    Route::get('/projects/featured', [ProjectController::class, 'getFeatured']);

    // ============================================================
    // 2. TESTIMONIALS ROUTES
    // ============================================================
    Route::prefix('testimonials')->group(function () {
        Route::get('/', [TestimoniController::class, 'getAll']);
        Route::get('/featured', [TestimoniController::class, 'getFeatured']);
        Route::get('/detail', [TestimoniController::class, 'getById']);
        Route::get('/by-rating', [TestimoniController::class, 'getByRating']);
    });

    Route::get('/testimonials', [TestimoniController::class, 'getAll']);
    Route::get('/testimonials/featured', [TestimoniController::class, 'getFeatured']);

    // ============================================================
    // 3. SERVICE PACKAGES (PAKET LAYANAN) ROUTES
    // ============================================================
    Route::prefix('pakets')->group(function () {
        Route::get('/', [PaketController::class, 'getAll']);
        Route::get('/popular', [PaketController::class, 'getPopular']);
        Route::get('/detail', [PaketController::class, 'getById']);
        Route::get('/by-slug', [PaketController::class, 'getBySlug']);
        Route::get('/by-jenis', [PaketController::class, 'getByJenis']);
    });

    Route::get('/pakets', [PaketController::class, 'getAll']);
    Route::get('/paket', [PaketController::class, 'getById']);
    Route::get('/paket/slug', [PaketController::class, 'getBySlug']);

    // ============================================================
    // 4. FAQ ROUTES
    // ============================================================
    Route::prefix('faqs')->group(function () {
        Route::get('/', [FaqController::class, 'getAll']);
        Route::get('/detail', [FaqController::class, 'getById']);
        Route::get('/by-kategori', [FaqController::class, 'getByKategori']);
    });

    Route::get('/faqs', [FaqController::class, 'getAll']);

    // ============================================================
    // 5. SERVICE AREAS (AREA LAYANAN) ROUTES
    // ============================================================
    Route::prefix('areas')->group(function () {
        Route::get('/', [AreaController::class, 'getAll']);
        Route::get('/detail', [AreaController::class, 'getById']);
        Route::get('/by-jenis', [AreaController::class, 'getByJenis']);
    });

    Route::get('/areas', [AreaController::class, 'getAll']);

    // ============================================================
    // 6. SETTINGS ROUTES
    // ============================================================
    Route::prefix('settings')->group(function () {
        Route::get('/', [SettingController::class, 'getAll']);
        Route::get('/by-key', [SettingController::class, 'getByKey']);
        Route::get('/by-kategori', [SettingController::class, 'getByKategori']);
    });

    Route::get('/settings', [SettingController::class, 'getAll']);

    // ============================================================
    // 7. ARTICLES (BLOG) ROUTES
    // ============================================================
    Route::prefix('articles')->group(function () {
        Route::get('/', [ArtikelController::class, 'getAll']);
        Route::get('/featured', [ArtikelController::class, 'getFeatured']);
        Route::get('/popular', [ArtikelController::class, 'getPopular']);
        Route::get('/detail', [ArtikelController::class, 'getById']);
        Route::get('/by-slug', [ArtikelController::class, 'getBySlug']);
        Route::get('/related', [ArtikelController::class, 'getRelated']);
        Route::get('/prev', [ArtikelController::class, 'getPrev']);
        Route::get('/next', [ArtikelController::class, 'getNext']);
        Route::get('/categories', [ArtikelController::class, 'getCategories']);
        Route::get('/tags', [ArtikelController::class, 'getTags']);
        Route::get('/by-category', [ArtikelController::class, 'getByCategory']);
        Route::get('/by-tag', [ArtikelController::class, 'getByTag']);
        Route::get('/search', [ArtikelController::class, 'search']);
    });

    // Backward compatibility (using 'artikel' instead of 'articles')
    Route::get('/artikel', [ArtikelController::class, 'getAll']);
    Route::get('/artikel/featured', [ArtikelController::class, 'getFeatured']);
    Route::get('/artikel/popular', [ArtikelController::class, 'getPopular']);
    Route::get('/artikel/{id}', [ArtikelController::class, 'getById']);

    // ============================================================
    // 8. TEAM MEMBERS ROUTES
    // ============================================================
    Route::prefix('team')->group(function () {
        Route::get('/', [TeamController::class, 'getAll']);
        Route::get('/detail', [TeamController::class, 'getById']);
        Route::get('/by-position', [TeamController::class, 'getByPosition']);
    });

    // ============================================================
    // 9. STATIC PAGES (HALAMAN) ROUTES
    // ============================================================
    Route::prefix('pages')->group(function () {
        Route::get('/', [HalamanController::class, 'getAll']);
        Route::get('/detail', [HalamanController::class, 'getById']);
        Route::get('/by-slug', [HalamanController::class, 'getBySlug']);
        Route::get('/by-jenis', [HalamanController::class, 'getByJenis']);
    });

    // ============================================================
    // 10. STATISTICS ROUTES
    // ============================================================
    Route::prefix('stats')->group(function () {
        Route::get('/', [StatsController::class, 'getStats']);
        Route::get('/quick', [StatsController::class, 'getQuickStats']);
    });

    Route::get('/frontend-stats', [StatsController::class, 'getStats']);

    // ============================================================
    // 11. FORM SUBMISSION ROUTES (POST METHODS)
    // ============================================================
    
    // Consultation form submission
    Route::post('/konsultasi/submit', [KonsultasiController::class, 'submit']);
    Route::post('/konsultasi', [KonsultasiController::class, 'submit']);
    
    // Check consultation status
    Route::get('/konsultasi/status', [KonsultasiController::class, 'getStatus']);
    
    // Contact form submission
    Route::post('/kontak/submit', [KontakController::class, 'submit']);
    Route::post('/kontak', [KontakController::class, 'submit']);
    
    // Newsletter subscription
    Route::post('/subscriber/subscribe', [SubscriberController::class, 'subscribe']);
    Route::post('/subscribe', [SubscriberController::class, 'subscribe']);
    
    // Unsubscribe from newsletter
    Route::post('/subscriber/unsubscribe', [SubscriberController::class, 'unsubscribe']);
    Route::get('/subscriber/unsubscribe', [SubscriberController::class, 'unsubscribe']);
    
    // Check subscription status
    Route::get('/subscriber/status', [SubscriberController::class, 'checkStatus']);

    // ============================================================
    // 12. UTILITY ROUTES
    // ============================================================
    
    // Ping endpoint for health check
    Route::get('/ping', function () {
        return response()->json([
            'success' => true,
            'message' => 'API is working',
            'timestamp' => now()->toISOString(),
        ]);
    });
    
    // Server time endpoint
    Route::get('/time', function () {
        return response()->json([
            'success' => true,
            'data' => [
                'timestamp' => now()->toISOString(),
                'timezone' => config('app.timezone'),
                'date' => now()->format('Y-m-d'),
                'time' => now()->format('H:i:s'),
            ]
        ]);
    });
});

// ============================================================
// 13. FALLBACK ROUTE FOR 404
// ============================================================
Route::fallback(function () {
    return response()->json([
        'success' => false,
        'message' => 'API endpoint not found',
    ], 404);
});