<?php

namespace App\Http\Controllers;

use App\Mail\PlanUpgraded;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Stripe\Webhook as StripeWebhook;

class StripeWebhookController extends Controller
{
    public function handle(Request $request)
    {
        $payload = $request->getContent();
        $sigHeader = $request->header('Stripe-Signature');
        $secret = config('services.stripe.webhook_secret');

        if (empty($secret)) {
            Log::warning('Stripe webhook called without configured secret');

            return response('Webhook secret not configured', 500);
        }

        try {
            $event = StripeWebhook::constructEvent(
                $payload,
                $sigHeader,
                $secret
            );
        } catch (\UnexpectedValueException $e) {
            // Invalid payload
            Log::warning('Stripe webhook invalid payload: '.$e->getMessage());

            return response('Invalid payload', 400);
        } catch (\Stripe\Exception\SignatureVerificationException $e) {
            // Invalid signature
            Log::warning('Stripe webhook signature verification failed: '.$e->getMessage());

            return response('Invalid signature', 400);
        }

        try {
            switch ($event->type) {
                case 'checkout.session.completed':
                    $session = $event->data->object; // \Stripe\Checkout\Session
                    $metadata = $session->metadata ?? [];
                    $userId = isset($metadata['user_id']) ? (int) $metadata['user_id'] : null;
                    $plan = $metadata['plan'] ?? null;

                    if ($userId && $plan) {
                        $user = User::find($userId);
                        if ($user) {
                            $user->switchPlan($plan);
                            try {
                                Mail::to($user->email)->send(new PlanUpgraded($plan));
                            } catch (\Throwable $e) {
                                Log::warning('Mail failed (webhook): '.$e->getMessage());
                            }
                            Log::info("Plan '{$plan}' activé pour l'utilisateur {$userId} via Stripe webhook.");
                        } else {
                            Log::warning('Stripe webhook: user not found for id '.$userId);
                        }
                    } else {
                        Log::warning('Stripe webhook: missing user_id/plan in metadata');
                    }
                    break;

                    // Ajoutez d'autres événements si nécessaire
                default:
                    // Ignorer les autres événements
                    break;
            }
        } catch (\Throwable $e) {
            Log::error('Stripe webhook processing error: '.$e->getMessage());

            return response('Webhook handling error', 500);
        }

        return response('success', 200);
    }
}
