<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create()
    {
        return response()->view('auth.login')->header('Cache-Control', 'no-cache, no-store, must-revalidate')
            ->header('Pragma', 'no-cache')
            ->header('Expires', '0');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        // Synchroniser les favoris de session avec la base de données
        $this->syncSessionFavorites($request);

        $request->session()->flash('status', 'You are now logged in!');

        return redirect()->intended('/');
    }

    /**
     * Synchroniser les favoris de session avec la base de données.
     */
    private function syncSessionFavorites(Request $request): void
    {
        $sessionFavorites = $request->session()->get('favorites', []);

        if (! empty($sessionFavorites)) {
            $user = Auth::user();

            foreach ($sessionFavorites as $carId) {
                // Vérifier si la voiture existe et n'est pas déjà dans les favoris
                if (! $user->favorites()->where('car_id', $carId)->exists()) {
                    $user->favorites()->create(['car_id' => $carId]);
                }
            }

            // Vider les favoris de session après synchronisation
            $request->session()->forget('favorites');
        }
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
