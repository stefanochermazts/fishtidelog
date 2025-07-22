<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FishingSpotController;
use App\Http\Controllers\FishingTripController;
use App\Http\Controllers\FishCatchController;
use App\Http\Controllers\FishSpeciesController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\LocaleController;
use App\Http\Controllers\TideController;
use App\Http\Controllers\EnvironmentalDataController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

// Public routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/features', [HomeController::class, 'features'])->name('features');
Route::get('/pricing', [HomeController::class, 'pricing'])->name('pricing');
Route::get('/contact', [HomeController::class, 'contact'])->name('contact');

// Locale routes
Route::get('/locale/{locale}', [LocaleController::class, 'changeLocale'])->name('locale.change');

Route::middleware(['auth'])->group(function () {
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Fishing Trips
    Route::resource('fishing-trips', FishingTripController::class);
    Route::post('/fishing-trips/{fishing_trip}/end', [FishingTripController::class, 'endTrip'])->name('fishing-trips.end');
    
    // Fish Catches
    Route::resource('catches', FishCatchController::class);
    Route::get('/fishing-trips/{fishing_trip}/catches', [FishCatchController::class, 'index'])->name('fishing-trips.catches.index');
    Route::get('/fishing-trips/{fishing_trip}/catches/create', [FishCatchController::class, 'create'])->name('fishing-trips.catches.create');
    Route::post('/fishing-trips/{fishing_trip}/catches', [FishCatchController::class, 'store'])->name('fishing-trips.catches.store');
    
    // Fish Species
    Route::get('/species/search', [FishSpeciesController::class, 'search'])->name('species.search');
    Route::get('/species/{species}', [FishSpeciesController::class, 'show'])->name('species.show');
    Route::get('/species/{species}/statistics', [FishSpeciesController::class, 'statistics'])->name('species.statistics');
    
    // Fishing Spots
    Route::resource('fishing-spots', FishingSpotController::class);
    Route::post('/fishing-spots/{fishing_spot}/toggle-favorite', [FishingSpotController::class, 'toggleFavorite'])->name('fishing-spots.toggle-favorite');
    
    // Statistics
    Route::get('/statistics', [DashboardController::class, 'statistics'])->name('statistics');
    
    // Map
    Route::get('/map', [DashboardController::class, 'map'])->name('map');
    
    // Tides
Route::get('/tides', [TideController::class, 'index'])->name('tides.index');
Route::post('/tides/get-by-coordinates', [TideController::class, 'getTidesByCoordinates'])->name('tides.get-by-coordinates');

// Environmental Data Routes
Route::post('/environmental-data', [EnvironmentalDataController::class, 'getEnvironmentalData'])->name('environmental-data.get');
Route::post('/moon-phase', [EnvironmentalDataController::class, 'getMoonPhase'])->name('moon-phase.get');
Route::post('/sunrise-sunset', [EnvironmentalDataController::class, 'getSunriseSunset'])->name('sunrise-sunset.get');
Route::post('/weather', [EnvironmentalDataController::class, 'getWeather'])->name('weather.get');
    
    // Profile routes (from Breeze)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Admin routes
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::get('/users', [AdminController::class, 'users'])->name('users.index');
    Route::get('/users/{user}', [AdminController::class, 'userDetails'])->name('users.show');
    Route::patch('/users/{user}/role', [AdminController::class, 'updateUserRole'])->name('users.update-role');
    Route::patch('/users/{user}/premium', [AdminController::class, 'updateUserPremium'])->name('users.update-premium');
    Route::delete('/users/{user}', [AdminController::class, 'destroyUser'])->name('users.destroy');
});

require __DIR__.'/auth.php';
