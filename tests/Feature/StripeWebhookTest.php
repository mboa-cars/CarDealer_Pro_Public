<?php
namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;

class StripeWebhookTest extends TestCase
{
    use RefreshDatabase;

    public function test_webhook_rejects_invalid_signature()
    {
        $payload = json_encode([
            'type' => 'checkout.session.completed',
            'data' => ['object' => ['customer_email' => 'test@example.com']]
        ]);

        $response = $this->post('/stripe/webhook', [], [
            'Stripe-Signature' => 'invalid_signature'
        ], [], [], $payload);

        $response->assertStatus(400);
        $response->assertSee('Invalid signature');
    }

    public function test_webhook_activates_premium_on_valid_event()
    {
        $user = User::factory()->create(['email' => 'premium@example.com', 'plan' => 'standard']);
        $payload = json_encode([
            'type' => 'checkout.session.completed',
            'data' => [
                'object' => [
                    'customer_email' => $user->email
                ]
            ]
        ]);

        // Simuler la vérification Stripe (désactiver la vérification pour le test)
        $this->mock(
            \Stripe\Webhook::class,
            function ($mock) use ($payload) {
                $mock->shouldReceive('constructEvent')
                    ->andReturn((object) [
                        'type' => 'checkout.session.completed',
                        'data' => (object) [
                            'object' => (object) ['customer_email' => 'premium@example.com']
                        ]
                    ]);
            }
        );

        $response = $this->post('/stripe/webhook', [], [
            'Stripe-Signature' => 'valid_signature'
        ], [], [], $payload);

        $response->assertStatus(200);
        $this->assertEquals('premium', $user->fresh()->plan);
    }
}
