<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\User;
use App\Models\Favorite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    /**
     * Dashboard d'administration
     */
    public function dashboard()
    {
        $stats = [
            'total_users' => User::count(),
            'total_cars' => Car::count(),
            'published_cars' => Car::where('is_published', true)->count(),
            'unpublished_cars' => Car::where('is_published', false)->count(),
            'total_favorites' => Favorite::count(),
        ];

        $recent_cars = Car::with(['user', 'images'])
            ->latest()
            ->take(5)
            ->get();

        $recent_users = User::latest()
            ->take(5)
            ->get();

        return view('admin.dashboard', compact('stats', 'recent_cars', 'recent_users'));
    }

    /**
     * Liste des utilisateurs
     */
    public function users()
    {
        $users = User::withCount(['cars', 'favorites'])
            ->latest()
            ->paginate(20);

        return view('admin.users.index', compact('users'));
    }

    /**
     * Modifier le statut admin d'un utilisateur
     */
    public function toggleAdmin(User $user)
    {
        if ($user->isAdmin()) {
            $user->removeAdmin();
            $message = 'Droits d\'administrateur retirés pour ' . $user->name;
        } else {
            $user->makeAdmin();
            $message = 'Droits d\'administrateur accordés à ' . $user->name;
        }

        return redirect()->back()->with('success', $message);
    }

    /**
     * Supprimer un utilisateur
     */
    public function deleteUser(User $user)
    {
        if ($user->isAdmin() && User::where('is_admin', true)->count() <= 1) {
            return redirect()->back()->with('error', 'Impossible de supprimer le dernier administrateur.');
        }

        $userName = $user->name;
        $user->delete();

        return redirect()->back()->with('success', 'Utilisateur ' . $userName . ' supprimé avec succès.');
    }

    /**
     * Liste des voitures avec gestion
     */
    public function cars()
    {
        $cars = Car::with(['user', 'images'])
            ->latest()
            ->paginate(20);

        return view('admin.cars.index', compact('cars'));
    }

    /**
     * Modifier le statut de publication d'une voiture
     */
    public function togglePublish(Car $car)
    {
        $car->update(['is_published' => !$car->is_published]);
        
        $status = $car->is_published ? 'publiée' : 'dépubliée';
        return redirect()->back()->with('success', 'Voiture ' . $car->brand . ' ' . $car->model . ' ' . $status);
    }

    /**
     * Supprimer une voiture
     */
    public function deleteCar(Car $car)
    {
        $carInfo = $car->brand . ' ' . $car->model;
        $car->delete();

        return redirect()->back()->with('success', 'Voiture ' . $carInfo . ' supprimée avec succès.');
    }

    /**
     * Statistiques détaillées
     */
    public function statistics()
    {
        $stats = [
            'users_by_month' => User::selectRaw('MONTH(created_at) as month, COUNT(*) as count')
                ->whereYear('created_at', date('Y'))
                ->groupBy('month')
                ->pluck('count', 'month'),
            
            'cars_by_brand' => Car::selectRaw('brand, COUNT(*) as count')
                ->groupBy('brand')
                ->orderBy('count', 'desc')
                ->take(10)
                ->get(),
            
            'cars_by_state' => Car::selectRaw('state, COUNT(*) as count')
                ->whereNotNull('state')
                ->groupBy('state')
                ->orderBy('count', 'desc')
                ->take(10)
                ->get(),
        ];

        return view('admin.statistics', compact('stats'));
    }
} 