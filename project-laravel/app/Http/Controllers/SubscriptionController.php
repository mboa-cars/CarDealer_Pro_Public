<?php

namespace App\Http\Controllers;

use App\Models\Subscription;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SubscriptionController extends Controller
{
    /**
     * S'abonner à un vendeur
     */
    public function subscribe(Request $request, User $seller)
    {
        $user = Auth::user();

        // Vérifier que l'utilisateur ne s'abonne pas à lui-même
        if ($user->id === $seller->id) {
            return response()->json([
                'success' => false,
                'message' => 'Vous ne pouvez pas vous abonner à vous-même.',
            ], 400);
        }

        // Vérifier si l'utilisateur est déjà abonné
        if ($user->isFollowing($seller->id)) {
            return response()->json([
                'success' => false,
                'message' => 'Vous êtes déjà abonné à ce vendeur.',
            ], 400);
        }

        // Créer l'abonnement
        Subscription::subscribe($user->id, $seller->id);

        return response()->json([
            'success' => true,
            'message' => 'Vous êtes maintenant abonné à '.$seller->name,
            'is_subscribed' => true,
            'followers_count' => $seller->fresh()->followers_count,
        ]);
    }

    /**
     * Se désabonner d'un vendeur
     */
    public function unsubscribe(Request $request, User $seller)
    {
        $user = Auth::user();

        // Vérifier si l'utilisateur est abonné
        if (! $user->isFollowing($seller->id)) {
            return response()->json([
                'success' => false,
                'message' => 'Vous n\'êtes pas abonné à ce vendeur.',
            ], 400);
        }

        // Supprimer l'abonnement
        Subscription::unsubscribe($user->id, $seller->id);

        return response()->json([
            'success' => true,
            'message' => 'Vous vous êtes désabonné de '.$seller->name,
            'is_subscribed' => false,
            'followers_count' => $seller->fresh()->followers_count,
        ]);
    }

    /**
     * Basculer l'état d'abonnement (s'abonner/se désabonner)
     */
    public function toggle(Request $request, User $seller)
    {
        $user = Auth::user();

        if ($user->isFollowing($seller->id)) {
            return $this->unsubscribe($request, $seller);
        } else {
            return $this->subscribe($request, $seller);
        }
    }

    /**
     * Obtenir la liste des abonnements de l'utilisateur connecté
     */
    public function mySubscriptions()
    {
        $user = Auth::user();

        $subscriptions = $user->following()
            ->withCount('cars')
            ->paginate(20);

        return view('subscriptions.index', compact('subscriptions'));
    }

    /**
     * Obtenir la liste des abonnés de l'utilisateur connecté
     */
    public function myFollowers()
    {
        $user = Auth::user();

        $followers = $user->followers()
            ->withCount('cars')
            ->paginate(20);

        return view('subscriptions.followers', compact('followers'));
    }
}
