<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;

class OtpController extends Controller
{
    

    protected static function normalizePhone(string $input): string
    {
        // Basic normalization: keep digits and leading +
        $input = trim($input);
        if (str_starts_with($input, '+')) {
            return '+'.preg_replace('/[^0-9]/', '', substr($input, 1));
        }
        return preg_replace('/[^0-9]/', '', $input);
    }

    protected function sendSms(string $to, string $message): void
    {
        // Sinch SMS API (XMS)
        // Docs: https://developers.sinch.com/docs/sms/api-reference/sms/tag/XMS#tag/Batches/operation/CreateBatch
        $servicePlanId = config('services.sinch.service_plan_id');
        $apiToken      = config('services.sinch.api_token');
        $from          = config('services.sinch.from');

        if (! $servicePlanId || ! $apiToken || ! $from) {
            throw new \RuntimeException('Sinch not configured');
        }

        $endpoint = 'https://sms.api.sinch.com/xms/v1/'.$servicePlanId.'/batches';
        $payload = [
            'from' => $from,
            'to'   => [$to],
            'body' => $message,
        ];

        $response = Http::withHeaders([
                'Authorization' => 'Bearer '.$apiToken,
                'Content-Type'  => 'application/json',
                'Accept'        => 'application/json',
            ])->post($endpoint, $payload);

        if ($response->failed()) {
            throw new \RuntimeException('Sinch SMS HTTP error: '.($response->body() ?? 'unknown'));
        }
        $data = $response->json();
        // If Sinch returns an error, it will include an error field or non-UUID id
        if (! isset($data['id'])) {
            $err = $data['error'] ?? 'unknown error';
            throw new \RuntimeException('Sinch SMS failed: '.$err);
        }
    }

    /**
     * Send OTP for password reset flow
     */
    public function sendResetOtp(Request $request)
    {
        $request->validate([
            'phone' => ['required','string'],
        ]);

        $phone = self::normalizePhone($request->string('phone'));
        $user = User::where('phone', $phone)->first();
        if (! $user) {
            return response()->json(['message' => 'Phone number not found'], 404);
        }

        $key = 'otp_reset:send:'.Str::lower($phone);
        if (RateLimiter::tooManyAttempts($key, 5)) {
            return response()->json(['message' => 'Too many requests. Please try again later.'], 429);
        }
        RateLimiter::hit($key, 60);

        $code = random_int(100000, 999999);
        Cache::put('otp_reset:'.$phone, $code, now()->addMinutes(5));

        try {
            $this->sendSms($phone, "Votre code de réinitialisation est: {$code}. Il expire dans 5 minutes.");
        } catch (\Throwable $e) {
            Log::error('SMS send error (reset): '.$e->getMessage());
            return response()->json(['message' => 'Failed to send SMS'], 500);
        }

        return response()->json(['message' => 'OTP sent']);
    }

    /**
     * Reset password using OTP: generates a new temp password and sends it via SMS
     */
    public function resetPasswordWithOtp(Request $request)
    {
        $request->validate([
            'phone' => ['required','string'],
            'code' => ['required','digits:6'],
        ]);

        $phone = self::normalizePhone($request->string('phone'));
        $cached = Cache::get('otp_reset:'.$phone);
        if (! $cached || (string)$cached !== (string)$request->string('code')) {
            return response()->json(['message' => 'Invalid or expired code'], 422);
        }

        $user = User::where('phone', $phone)->first();
        if (! $user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        $temp = Str::password(12, symbols: true);
        $user->forceFill([
            'password' => bcrypt($temp),
        ])->save();

        Cache::forget('otp_reset:'.$phone);

        try {
            $this->sendSms($phone, "Votre nouveau mot de passe temporaire est: {$temp}. Veuillez le changer après connexion.");
        } catch (\Throwable $e) {
            Log::error('SMS send error (new password): '.$e->getMessage());
            return response()->json(['message' => 'Password reset but failed to send SMS'], 500);
        }

        return response()->json(['message' => 'Temporary password sent via SMS']);
    }
}
