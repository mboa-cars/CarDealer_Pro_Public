<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CarController;
use App\Http\Controllers\HomeController;

Route::get('/', [HomeController::class, 'index']);

// Route de test pour vérifier l'authentification
Route::get('/test-auth', function () {
    if (auth()->check()) {
        return response()->json([
            'authenticated' => true,
            'user_id' => auth()->id(),
            'user_name' => auth()->user()->name
        ]);
    } else {
        return response()->json([
            'authenticated' => false
        ]);
    }
});

Route::get('/dashboard', function () {
    return redirect('/');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    // Routes pour la gestion des voitures de l'utilisateur
    Route::get('/my-cars', [CarController::class, 'myCars'])->name('cars.my-cars');
    Route::get('/cars/{car}/manage-images', [CarController::class, 'manageImages'])->name('cars.manage-images');
    Route::post('/cars/{car}/add-images', [CarController::class, 'addImages'])->name('cars.add-images');
    Route::post('/cars/{car}/update-image-positions', [CarController::class, 'updateImagePositions'])->name('cars.update-image-positions');
    Route::delete('/cars/{car}/images/{image}', [CarController::class, 'deleteImage'])->name('cars.delete-image');
});

// Routes pour les favoris (accessibles à tous)
Route::post('/cars/{car}/favorite', [CarController::class, 'addToFavorites'])->name('cars.favorite');
Route::delete('/cars/{car}/favorite', [CarController::class, 'removeFromFavorites'])->name('cars.unfavorite');
Route::get('/favorites', [CarController::class, 'favorites'])->name('favorites');

// Routes protégées pour la création de voitures
Route::middleware('auth')->group(function () {
    Route::get('/cars/create', [CarController::class, 'create'])->name('cars.create');
    Route::post('/cars', [CarController::class, 'store'])->name('cars.store');
    
    // Route de test pour déboguer
    Route::post('/test-car-store', function () {
        return response()->json([
            'message' => 'Route accessible',
            'user_id' => auth()->id(),
            'request_data' => request()->all()
        ]);
    })->name('test.car.store');
});

// Routes publiques pour les voitures
Route::resource('cars', CarController::class)->except(['destroy', 'create', 'store']);
Route::delete('/cars/{car}', [CarController::class, 'destroy'])->middleware('auth')->name('cars.destroy');
Route::get('/car-card/{car}', [App\Http\Controllers\CarController::class, 'carCard'])->name('car.card');

// Route::view('/profile', 'profile')->name('profile'); // Supprimé - conflit avec ProfileController



require __DIR__.'/auth.php';
