<?php

namespace App\Http\Controllers;

use App\Mail\PlanUpgraded;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\URL;
use Stripe\StripeClient;

class PlanController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        if ($user->isAdmin()) {
            return redirect()->route('home')->with('error', "La gestion d'abonnement est réservée aux utilisateurs.");
        }
        $plans = config('plans');

        return view('subscriptions.plans', compact('plans', 'user'));
    }

    public function choose(string $plan)
    {
        $user = Auth::user();
        if ($user->isAdmin()) {
            return redirect()->route('home')->with('error', "La gestion d'abonnement est réservée aux utilisateurs.");
        }
        $plans = array_keys(config('plans'));
        abort_unless(in_array($plan, $plans, true), 404);

        $config = config("plans.$plan");
        $price = $config['price'] ?? 0;

        // Si prix > 0, créer une session Stripe Checkout
        if ($price && $plan === 'premium') {
            $secret = config('services.stripe.secret');
            if (empty($secret)) {
                // Fallback dev seulement en environnement local
                if (app()->environment('local')) {
                    $user->switchPlan($plan);
                    try {
                        Mail::to($user->email)->send(new PlanUpgraded($plan));
                    } catch (\Throwable $e) {
                        Log::warning('Mail failed: '.$e->getMessage());
                    }

                    return redirect()->route('cars.my-cars')->with('warning', 'Stripe non configuré. Plan Premium activé en mode développement.');
                }

                return redirect()->route('plans.index')->with('error', 'Paiement indisponible: Stripe non configuré.');
            }
            $stripe = new StripeClient($secret);
            $successUrl = URL::route('plans.checkout.success', ['plan' => $plan]).'?session_id={CHECKOUT_SESSION_ID}';
            $cancelUrl = URL::route('plans.index');

            try {
                $payload = [
                    'mode' => 'payment',
                    'success_url' => $successUrl,
                    'cancel_url' => $cancelUrl,
                    'line_items' => [[
                        'price_data' => [
                            'currency' => 'eur',
                            'product_data' => [
                                'name' => 'Plan Premium',
                            ],
                            'unit_amount' => (int) round($price * 100),
                        ],
                        'quantity' => 1,
                    ]],
                    'metadata' => [
                        'user_id' => (string) $user->id,
                        'plan' => $plan,
                    ],
                ];
                // Idempotency clé basée sur l'utilisateur et le plan
                $idempotencyKey = 'checkout_session:'.$user->id.':'.$plan.':'.date('Ymd');
                $session = $stripe->checkout->sessions->create($payload, [
                    'idempotency_key' => $idempotencyKey,
                ]);

                return redirect($session->url);
            } catch (\Throwable $e) {
                Log::error('Stripe Checkout error: '.$e->getMessage());
                if (app()->environment('local')) {
                    // Fallback dev uniquement
                    $user->switchPlan($plan);
                    try {
                        Mail::to($user->email)->send(new PlanUpgraded($plan));
                    } catch (\Throwable $e2) {
                        Log::warning('Mail failed: '.$e2->getMessage());
                    }

                    return redirect()->route('cars.my-cars')->with('warning', 'Impossible de démarrer le paiement Stripe ('.$e->getMessage().'). Plan Premium activé en mode développement.');
                }

                return redirect()->route('plans.index')->with('error', 'Impossible de démarrer le paiement Stripe. Veuillez réessayer.');
            }
        }

        // Sinon, basculer immédiatement
        $user->switchPlan($plan);
        try {
            Mail::to($user->email)->send(new PlanUpgraded($plan));
        } catch (\Throwable $e) {
            Log::warning('Mail failed: '.$e->getMessage());
        }

        return redirect()->route('cars.my-cars')->with('success', 'Votre plan a été mis à jour en '.ucfirst($plan).' !');
    }

    public function checkoutSuccess(string $plan)
    {
        $user = Auth::user();
        if ($user->isAdmin()) {
            return redirect()->route('home')->with('error', "La gestion d'abonnement est réservée aux utilisateurs.");
        }

        // Ne pas activer ici. L'activation est traitée par le webhook Stripe.
        // Optionnel: vérifier la session côté serveur pour afficher un message plus précis
        return redirect()->route('cars.my-cars')->with('success', 'Paiement en cours de confirmation. Votre plan sera activé sous peu.');
    }
}
