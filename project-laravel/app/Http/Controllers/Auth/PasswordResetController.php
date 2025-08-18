<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\NewTemporaryPasswordMail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class PasswordResetController extends Controller
{
    /**
     * Generate a new temporary password and email it to the user.
     */
    public function sendNewPassword(Request $request)
    {
        $validated = $request->validate([
            'email' => ['required', 'email'],
        ]);

        $user = User::where('email', $validated['email'])->first();

        // Always return a generic status to avoid leaking which emails exist
        if (! $user) {
            return back()->with('status', 'If this email exists, a new password has been sent.');
        }

        // Generate a secure temporary password
        $tempPassword = Str::random(14);

        // Update user's password and force change on next login
        $user->password = Hash::make($tempPassword);
        $user->must_change_password = true;
        $user->save();

        // Email the new temporary password
        Mail::to($user->email)->send(new NewTemporaryPasswordMail($user, $tempPassword));

        return back()->with('status', 'If this email exists, a new password has been sent.');
    }
}
