<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ChangePasswordController extends Controller
{
    public function showChangeForm()
    {
        return view('auth.change-password');
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'current_password' => ['nullable', 'string'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $user = $request->user();

        // If current_password is provided, verify it; otherwise allow (useful when forced change after temp pwd)
        if (! empty($validated['current_password']) && ! Hash::check($validated['current_password'], $user->password)) {
            return back()->withErrors(['current_password' => 'Current password is incorrect.'])->withInput();
        }

        $user->password = Hash::make($validated['password']);
        $user->must_change_password = false;
        $user->save();

        return redirect()->route('home')->with('status', 'Password updated successfully.');
    }
}
