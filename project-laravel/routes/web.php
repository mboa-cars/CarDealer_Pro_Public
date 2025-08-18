<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\ChangePasswordController;
use App\Http\Controllers\Auth\OtpController;
use App\Http\Controllers\Auth\PasswordResetController;
use App\Http\Controllers\BookmarkController;
use App\Http\Controllers\CarController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PlanController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SellerReviewController;
<<<<<<< Updated upstream
=======
use App\Http\Controllers\StripeWebhookController;
use App\Http\Controllers\SubscriptionController;
use Illuminate\Support\Facades\Route;
>>>>>>> Stashed changes

Route::get('/', [HomeController::class, 'index'])->name('home');

// Route de test pour vérifier l'authentification
Route::get('/test-auth', function () {
    if (auth()->check()) {
        return response()->json([
            'authenticated' => true,
            'user_id' => auth()->id(),
            'user_name' => auth()->user()->name,
        ]);
    } else {
        return response()->json([
            'authenticated' => false,
        ]);
    }
});

// (Login OTP routes removed)
// OTP for password reset
Route::post('/auth/otp/reset/send', [OtpController::class, 'sendResetOtp'])->name('auth.otp.reset.send');
Route::post('/auth/otp/reset/confirm', [OtpController::class, 'resetPasswordWithOtp'])->name('auth.otp.reset.confirm');

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

    // Routes pour les bookmarks
    Route::get('/bookmarks', [BookmarkController::class, 'index'])->name('bookmarks.index');
    Route::post('/bookmarks', [BookmarkController::class, 'store'])->name('bookmarks.store');
    Route::post('/bookmarks/quick', [BookmarkController::class, 'quickStore'])->name('bookmarks.quick-store');
    Route::put('/bookmarks/{bookmark}', [BookmarkController::class, 'update'])->name('bookmarks.update');
    Route::delete('/bookmarks/{bookmark}', [BookmarkController::class, 'destroy'])->name('bookmarks.destroy');
    Route::patch('/bookmarks/{bookmark}/favorite', [BookmarkController::class, 'toggleFavorite'])->name('bookmarks.toggle-favorite');
    Route::post('/bookmarks/reorder', [BookmarkController::class, 'reorder'])->name('bookmarks.reorder');
    Route::get('/bookmarks/api', [BookmarkController::class, 'apiIndex'])->name('bookmarks.api');
    Route::get('/bookmarks/search', [BookmarkController::class, 'search'])->name('bookmarks.search');
    Route::post('/bookmarks/remove', [BookmarkController::class, 'removeByUrl'])->name('bookmarks.remove-by-url');

    // Routes pour les abonnements
    Route::post('/subscribe/{seller}', [SubscriptionController::class, 'toggle'])->name('subscriptions.toggle');
    Route::get('/my-subscriptions', [SubscriptionController::class, 'mySubscriptions'])->name('subscriptions.index');
    Route::get('/my-followers', [SubscriptionController::class, 'myFollowers'])->name('subscriptions.followers');

    // Plans (les contrôleurs bloquent déjà l'accès admin)
    Route::get('/plans', [PlanController::class, 'index'])->name('plans.index');
    Route::post('/plans/{plan}', [PlanController::class, 'choose'])->name('plans.choose');
    Route::get('/plans/checkout/success/{plan}', [PlanController::class, 'checkoutSuccess'])->name('plans.checkout.success');

    // Routes pour les avis vendeurs (protégées par auth)
    Route::get('/cars/{car}/review', [SellerReviewController::class, 'create'])->name('reviews.create')->middleware('auth');
    Route::post('/cars/{car}/review', [SellerReviewController::class, 'store'])->name('reviews.store')->middleware('auth');
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
            'request_data' => request()->all(),
        ]);
    })->name('test.car.store');
});

// Routes publiques pour les voitures
Route::resource('cars', CarController::class)->except(['destroy', 'create', 'store']);
Route::delete('/cars/{car}', [CarController::class, 'destroy'])->middleware('auth')->name('cars.destroy');
Route::get('/car-card/{car}', [App\Http\Controllers\CarController::class, 'carCard'])->name('car.card');

// Routes publiques pour les avis
Route::get('/seller/{seller}/reviews', [SellerReviewController::class, 'sellerReviews'])->name('reviews.seller');
Route::get('/cars/{car}/reviews', [SellerReviewController::class, 'carReviews'])->name('reviews.car');

// Route::view('/profile', 'profile')->name('profile'); // Supprimé - conflit avec ProfileController

// Routes d'administration
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::get('/users', [AdminController::class, 'users'])->name('users');
    Route::patch('/users/{user}/toggle-admin', [AdminController::class, 'toggleAdmin'])->name('users.toggle-admin');
    Route::delete('/users/{user}', [AdminController::class, 'deleteUser'])->name('users.delete');
    Route::get('/cars', [AdminController::class, 'cars'])->name('cars');
    Route::patch('/cars/{car}/toggle-publish', [AdminController::class, 'togglePublish'])->name('cars.toggle-publish');
    Route::delete('/cars/{car}', [AdminController::class, 'deleteCar'])->name('cars.delete');
    Route::get('/statistics', [AdminController::class, 'statistics'])->name('statistics');
    Route::get('/subscriptions', [AdminController::class, 'subscriptions'])->name('subscriptions');
    Route::get('/bookmarks', [AdminController::class, 'bookmarks'])->name('bookmarks');
    Route::get('/plans', [AdminController::class, 'userPlans'])->name('plans');
});

require __DIR__.'/auth.php';
