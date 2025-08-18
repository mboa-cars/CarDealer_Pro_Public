<?php

use App\Models\User;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

use function Pest\Laravel\postJson;
use function Pest\Laravel\actingAs;

it('envoie un OTP de réinitialisation via Sinch', function () {
    // Config Sinch factice
    config()->set('services.sinch.service_plan_id', 'plan_123');
    config()->set('services.sinch.api_token', 'token_abc');
    config()->set('services.sinch.from', '+33123456789');

    // Faux HTTP pour Sinch: renvoyer un id
    Http::fake([
        'https://sms.api.sinch.com/*' => Http::response(['id' => Str::uuid()->toString()], 201),
    ]);

    $user = User::factory()->create([
        'phone' => '+33600000000',
    ]);

    $resp = postJson(route('auth.otp.reset.send'), [
        'phone' => '+33 6 00 00 00 00',
    ]);

    $resp->assertOk()->assertJson(['message' => 'OTP sent']);
});

it('réinitialise le mot de passe avec un OTP valide', function () {
    // Config Sinch factice
    config()->set('services.sinch.service_plan_id', 'plan_123');
    config()->set('services.sinch.api_token', 'token_abc');
    config()->set('services.sinch.from', '+33123456789');

    Http::fake([
        'https://sms.api.sinch.com/*' => Http::response(['id' => Str::uuid()->toString()], 201),
    ]);

    $user = User::factory()->create([
        'phone' => '+33611111111',
        'password' => Hash::make('old-password'),
    ]);

    // Placer un code OTP en cache comme le fait sendResetOtp
    $code = 123456;
    Cache::put('otp_reset:+33611111111', $code, now()->addMinutes(5));

    $resp = postJson(route('auth.otp.reset.confirm'), [
        'phone' => '+33 6 11 11 11 11',
        'code' => (string) $code,
    ]);

    $resp->assertOk()->assertJson(['message' => 'Temporary password sent via SMS']);
});
