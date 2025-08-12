<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\SellerReview;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SellerReviewController extends Controller
{
    // Pas de constructeur nécessaire - le middleware sera appliqué dans les routes

    /**
     * Show the form to create a new review
     */
    public function create($carId)
    {
        // Vérifier que l'utilisateur est connecté
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Vous devez être connecté pour noter un vendeur.');
        }

        $car = Car::findOrFail($carId);
        
        // Vérifier que l'utilisateur connecté n'est pas le vendeur
        if (Auth::id() === $car->user_id) {
            return redirect()->back()->with('error', 'Vous ne pouvez pas noter votre propre annonce.');
        }
        
        // Vérifier que l'utilisateur n'a pas déjà noté cette voiture
        $existingReview = SellerReview::where('reviewer_id', Auth::id())
            ->where('car_id', $carId)
            ->first();
            
        if ($existingReview) {
            return redirect()->back()->with('error', 'Vous avez déjà noté ce vendeur pour cette voiture.');
        }
        
        return view('reviews.create', compact('car'));
    }

    /**
     * Store a new review
     */
    public function store(Request $request, $carId)
    {
        // Vérifier que l'utilisateur est connecté
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Vous devez être connecté pour noter un vendeur.');
        }

        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string|max:1000',
        ]);

        $car = Car::findOrFail($carId);
        
        // Vérifier que l'utilisateur connecté n'est pas le vendeur
        if (Auth::id() === $car->user_id) {
            return redirect()->back()->with('error', 'Vous ne pouvez pas noter votre propre annonce.');
        }
        
        // Vérifier que l'utilisateur n'a pas déjà noté cette voiture
        $existingReview = SellerReview::where('reviewer_id', Auth::id())
            ->where('car_id', $carId)
            ->first();
            
        if ($existingReview) {
            return redirect()->back()->with('error', 'Vous avez déjà noté ce vendeur pour cette voiture.');
        }

        SellerReview::create([
            'reviewer_id' => Auth::id(),
            'seller_id' => $car->user_id,
            'car_id' => $carId,
            'rating' => $request->rating,
            'comment' => $request->comment,
            'is_verified' => true, // Pour simplifier, on considère toutes les reviews comme vérifiées
        ]);

        return redirect()->route('cars.show', $carId)
            ->with('success', 'Votre avis a été publié avec succès !');
    }

    /**
     * Show reviews for a specific seller
     */
    public function sellerReviews($sellerId)
    {
        $seller = User::findOrFail($sellerId);
        $reviews = $seller->reviewsReceived()
            ->with(['reviewer', 'car'])
            ->verified()
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('reviews.seller', compact('seller', 'reviews'));
    }

    /**
     * Show all reviews for a specific car
     */
    public function carReviews($carId)
    {
        $car = Car::with('user')->findOrFail($carId);
        $reviews = SellerReview::where('car_id', $carId)
            ->with(['reviewer'])
            ->verified()
            ->orderBy('created_at', 'desc')
            ->get();

        return view('reviews.car', compact('car', 'reviews'));
    }
}
