<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

// Public Controllers
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\StatisticsController;
use App\Http\Controllers\CurrencyController; // Ensure this is imported

// Auth Controllers
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;

// User-specific Controllers
use App\Http\Controllers\CollectionController;
use App\Http\Controllers\DownloadLogController;

// === Public Routes (Accessible to everyone) ===
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/contact', [PageController::class, 'contact'])->name('contact');
Route::get('/privacy-policy', [PageController::class, 'privacyPolicy'])->name('privacy.policy');
// Note: /currency/{countrySlug} is moved below to protected routes
Route::get('/statistics', [StatisticsController::class, 'index'])->name('dashboard');
Route::get('/about-us', [PageController::class, 'aboutUs'])->name('about.us');


// Laravel Built-in Auth Routes - Customize to exclude password reset
Auth::routes([
    'reset' => false,    // Disable password reset routes
    'verify' => false,   // Disable email verification routes (if not needed)
    'confirm' => false,  // Disable password confirmation routes (if not needed)
]);

// === Custom Auth Routes (Keep these as you have them) ===
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);

Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// === Protected Routes (Accessible ONLY to logged-in users) ===
Route::middleware(['auth'])->group(function () {
    // Moved currency detail route here
    Route::get('/currency/{countrySlug}', [CurrencyController::class, 'show'])->name('currency.detail');
    Route::get('/collections', [CollectionController::class, 'index'])->name('collections');

    // === Download Log (often protected as well) ===
    Route::post('/log-download', [DownloadLogController::class, 'log'])->name('log.download');
});


// === Admin Routes (optional expansion with middleware like 'admin') ===
// This route is already protected by 'auth' middleware due to being in the 'protected routes' group,
// but you might add a custom 'admin' middleware later for finer control.
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('dashboard');
});
