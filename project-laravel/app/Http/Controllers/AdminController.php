<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\User;
use App\Models\Favorite;
use App\Models\Bookmark;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    /**
     * Liste de tous les abonnements (admin)
     */
    public function subscriptions()
    {
        $subscriptions = \App\Models\Subscription::with(['subscriber', 'seller'])->latest('subscribed_at')->paginate(30);
        return view('admin.subscriptions', compact('subscriptions'));
    }

    /**
     * Vue plans/abonnements utilisateurs (répartition standard/premium, export CSV)
     */
    public function userPlans(Request $request)
    {
        $standardUsers = User::where('plan', 'standard')->withCount('cars')->get();
        $premiumUsers = User::where('plan', 'premium')->withCount('cars')->get();

        $stats = [
            'standard' => $standardUsers->count(),
            'premium' => $premiumUsers->count(),
        ];

        if ($request->get('export') === 'csv') {
            $rows = collect([['ID', 'Nom', 'Email', 'Plan', 'Voitures']])
                ->merge($standardUsers->map(fn($u) => [$u->id, $u->name, $u->email, 'standard', $u->cars_count]))
                ->merge($premiumUsers->map(fn($u) => [$u->id, $u->name, $u->email, 'premium', $u->cars_count]));

            $csv = $rows->map(fn($r) => implode(',', array_map(fn($v) => '"'.str_replace('"', '""', $v).'"', $r)))->implode("\n");
            return response($csv, 200, [
                'Content-Type' => 'text/csv',
                'Content-Disposition' => 'attachment; filename="user_plans.csv"',
            ]);
        }

        return view('admin.plans.index', compact('standardUsers', 'premiumUsers', 'stats'));
    }
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
            'total_bookmarks' => Bookmark::count(),
            'bookmarks_today' => Bookmark::whereDate('created_at', today())->count(),
            'bookmarks_this_week' => Bookmark::whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()])->count(),
        ];

        $recent_cars = Car::with(['user', 'images'])
            ->latest()
            ->take(5)
            ->get();

        $recent_users = User::latest()
            ->take(5)
            ->get();

        $recent_bookmarks = Bookmark::with('user')
            ->latest()
            ->take(5)
            ->get();

        return view('admin.dashboard', compact('stats', 'recent_cars', 'recent_users', 'recent_bookmarks'));
    }

    /**
     * Liste des utilisateurs
     */
    public function users(Request $request)
    {
        $query = User::withCount(['cars', 'favorites']);

        // Filtre par recherche
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('phone', 'like', "%{$search}%");
            });
        }

        // Filtre par statut
        if ($request->filled('status')) {
            if ($request->status === 'admin') {
                $query->where('is_admin', true);
            } elseif ($request->status === 'user') {
                $query->where('is_admin', false);
            }
        }

        // Filtre par plan (standard | premium)
        if ($request->filled('plan') && in_array($request->plan, ['standard', 'premium'], true)) {
            $query->where('plan', $request->plan);
        }

        // Tri
        switch ($request->get('sort', 'latest')) {
            case 'oldest':
                $query->oldest();
                break;
            case 'name':
                $query->orderBy('name');
                break;
            case 'cars':
                $query->orderBy('cars_count', 'desc');
                break;
            default:
                $query->latest();
        }

        $users = $query->paginate(20)->withQueryString();

        $planStats = [
            'standard' => User::where('plan', 'standard')->count(),
            'premium' => User::where('plan', 'premium')->count(),
        ];

        return view('admin.users.index', compact('users', 'planStats'));
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
        // Statistiques générales
        $generalStats = [
            'total_users' => User::count(),
            'admin_users' => User::where('is_admin', true)->count(),
            'regular_users' => User::where('is_admin', false)->count(),
            'total_cars' => Car::count(),
            'published_cars' => Car::where('is_published', true)->count(),
            'unpublished_cars' => Car::where('is_published', false)->count(),
            'total_favorites' => Favorite::count(),
            'avg_price' => Car::where('is_published', true)->avg('price') ?? 0,
            'min_price' => Car::where('is_published', true)->min('price') ?? 0,
            'max_price' => Car::where('is_published', true)->max('price') ?? 0,
        ];

        // Données pour les graphiques
        $chartData = [
            // Top des marques
            'brands' => Car::selectRaw('brand, COUNT(*) as count')
                ->where('is_published', true)
                ->whereNotNull('brand')
                ->groupBy('brand')
                ->orderBy('count', 'desc')
                ->take(8)
                ->get(),
            
            // Voitures par état
            'states' => Car::selectRaw('state, COUNT(*) as count')
                ->where('is_published', true)
                ->whereNotNull('state')
                ->groupBy('state')
                ->orderBy('count', 'desc')
                ->take(10)
                ->get(),
            
            // Prix moyen par marque
            'price_by_brand' => Car::selectRaw('brand, AVG(price) as avg_price, COUNT(*) as count')
                ->where('is_published', true)
                ->whereNotNull('brand')
                ->whereNotNull('price')
                ->groupBy('brand')
                ->having('count', '>=', 2) // Au moins 2 voitures par marque
                ->orderBy('avg_price', 'desc')
                ->take(6)
                ->get(),
            
            // Évolution mensuelle des inscriptions
            'users_by_month' => User::selectRaw('MONTH(created_at) as month, COUNT(*) as count')
                ->whereYear('created_at', date('Y'))
                ->groupBy('month')
                ->orderBy('month')
                ->get(),
            
            // Évolution mensuelle des voitures
            'cars_by_month' => Car::selectRaw('MONTH(created_at) as month, COUNT(*) as count')
                ->whereYear('created_at', date('Y'))
                ->groupBy('month')
                ->orderBy('month')
                ->get(),
            
            // Favoris par mois
            'favorites_by_month' => Favorite::selectRaw('MONTH(created_at) as month, COUNT(*) as count')
                ->whereYear('created_at', date('Y'))
                ->groupBy('month')
                ->orderBy('month')
                ->get(),
        ];

        // Statistiques avancées et uniques
        $advancedStats = [
            // Tendances hebdomadaires (7 derniers jours)
            'weekly_trends' => [
                'users' => User::selectRaw('DATE(created_at) as date, COUNT(*) as count')
                    ->where('created_at', '>=', now()->subDays(7))
                    ->groupBy('date')
                    ->orderBy('date')
                    ->get(),
                'cars' => Car::selectRaw('DATE(created_at) as date, COUNT(*) as count')
                    ->where('created_at', '>=', now()->subDays(7))
                    ->groupBy('date')
                    ->orderBy('date')
                    ->get(),
                'favorites' => Favorite::selectRaw('DATE(created_at) as date, COUNT(*) as count')
                    ->where('created_at', '>=', now()->subDays(7))
                    ->groupBy('date')
                    ->orderBy('date')
                    ->get(),
            ],
            
            // Analyse de la performance par heure (activité des utilisateurs)
            'hourly_activity' => User::selectRaw('HOUR(created_at) as hour, COUNT(*) as count')
                ->groupBy('hour')
                ->orderBy('hour')
                ->get(),
            
            // Statistiques de croissance
            'growth_stats' => [
                'users_growth' => [
                    'current_month' => User::whereMonth('created_at', now()->month)
                        ->whereYear('created_at', now()->year)->count(),
                    'last_month' => User::whereMonth('created_at', now()->subMonth()->month)
                        ->whereYear('created_at', now()->subMonth()->year)->count(),
                ],
                'cars_growth' => [
                    'current_month' => Car::whereMonth('created_at', now()->month)
                        ->whereYear('created_at', now()->year)->count(),
                    'last_month' => Car::whereMonth('created_at', now()->subMonth()->month)
                        ->whereYear('created_at', now()->subMonth()->year)->count(),
                ],
            ],
            
            // Analyse des prix par tranche
            'price_ranges' => [
                'budget' => Car::where('is_published', true)
                    ->where('price', '<', 15000)->count(),
                'mid_range' => Car::where('is_published', true)
                    ->whereBetween('price', [15000, 50000])->count(),
                'luxury' => Car::where('is_published', true)
                    ->where('price', '>', 50000)->count(),
            ],
            
            // Top des villes (si vous avez une colonne city)
            'top_cities' => Car::selectRaw('city, COUNT(*) as count')
                ->where('is_published', true)
                ->whereNotNull('city')
                ->groupBy('city')
                ->orderBy('count', 'desc')
                ->take(8)
                ->get(),
            
            // Analyse des années de voitures
            'car_years' => Car::selectRaw('year, COUNT(*) as count, AVG(price) as avg_price')
                ->where('is_published', true)
                ->whereNotNull('year')
                ->groupBy('year')
                ->orderBy('year', 'desc')
                ->take(10)
                ->get(),
        ];

        return view('admin.statistics', compact('generalStats', 'chartData', 'advancedStats'));
    }

    /**
     * Liste des bookmarks des utilisateurs
     */
    public function bookmarks(Request $request)
    {
        $query = Bookmark::with('user');

        // Filtre par utilisateur
        if ($request->filled('user')) {
            $query->where('user_id', $request->user);
        }

        // Filtre par recherche
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('url', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }

        // Filtre par catégorie
        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        // Filtre par favoris
        if ($request->filled('favorite')) {
            $query->where('is_favorite', $request->favorite === 'true');
        }

        // Tri
        switch ($request->get('sort', 'latest')) {
            case 'oldest':
                $query->oldest();
                break;
            case 'title':
                $query->orderBy('title');
                break;
            case 'user':
                $query->orderBy('user_id');
                break;
            case 'category':
                $query->orderBy('category');
                break;
            default:
                $query->latest();
        }

        $bookmarks = $query->paginate(20)->withQueryString();

        // Données pour les filtres
        $users = User::orderBy('name')->get();
        $categories = Bookmark::select('category')
            ->distinct()
            ->orderBy('category')
            ->pluck('category');

        return view('admin.bookmarks.index', compact('bookmarks', 'users', 'categories'));
    }
} 