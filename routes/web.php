<?php

use App\Http\Controllers\AssetCategoryController;
use App\Http\Controllers\AssetController;
use App\Http\Controllers\AssetTransactionController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PublicAssetController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::patch('/profile/photo', [ProfileController::class, 'updatePhoto'])->name('profile.photo.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// USER MANAGEMENT
Route::middleware(['admin'])->group(function () {
    Route::resource('user-management', UserController::class);
    Route::get('/get-users', [UserController::class, 'getUsers']);
});

// KARYAWAN FEATURES
Route::middleware('auth')->group(function () {
    // LOCATIONS
    Route::resource('locations', LocationController::class);
    // ASSET CATEGORIES
    Route::resource('asset-categories', AssetCategoryController::class);
    // ASSET
    Route::resource('assets', AssetController::class)->except(['show']);
    Route::get('/get-location-details/{kode_lokasi}', [AssetController::class, 'getLocationDetails']);
    Route::get('/get-asset-details/{ident_code}', [AssetController::class, 'getAssetDetails']);
    Route::get('/check-ident-code/{ident_code}', [AssetController::class, 'checkIdentCode']);
    Route::get('/get-available-locations/{ident_code}', [AssetController::class, 'getAvailableLocations']);
    Route::get('/assets/{locationAsset}/print-qr', [AssetController::class, 'printQR'])->name('assets.print-qr');
    // ASSET TRANSACTION
    Route::resource('asset-transactions', AssetTransactionController::class);
    Route::get('/asset-transactions/locations/{ident_code}', [AssetTransactionController::class, 'getLocations']);
});

// PUBLIC FEATURES
Route::get('/public-assets', [PublicAssetController::class, 'index'])->name('public-assets');
Route::get('assets/{id}', [AssetController::class, 'show'])->name('assets.show');

require __DIR__.'/auth.php';
