<?php

namespace Database\Seeders;

use App\Models\Bookmark;
use App\Models\User;
use Illuminate\Database\Seeder;

class BookmarkSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::all();

        foreach ($users as $user) {
            // Bookmarks de test pour chaque utilisateur
            $bookmarks = [
                [
                    'title' => 'Liste des voitures',
                    'url' => route('cars.index'),
                    'route_name' => 'cars.index',
                    'description' => 'Parcourir toutes les voitures disponibles',
                    'icon' => 'fas fa-car',
                    'category' => 'cars',
                    'position' => 1,
                    'is_favorite' => true,
                ],
                [
                    'title' => 'Mes favoris',
                    'url' => route('favorites'),
                    'route_name' => 'favorites',
                    'description' => 'Voir mes voitures favorites',
                    'icon' => 'fas fa-heart',
                    'category' => 'favorites',
                    'position' => 2,
                    'is_favorite' => false,
                ],
                [
                    'title' => 'Ajouter une voiture',
                    'url' => route('cars.create'),
                    'route_name' => 'cars.create',
                    'description' => 'Créer une nouvelle annonce de voiture',
                    'icon' => 'fas fa-plus-circle',
                    'category' => 'cars',
                    'position' => 3,
                    'is_favorite' => false,
                ],
                [
                    'title' => 'Mon profil',
                    'url' => route('profile.edit'),
                    'route_name' => 'profile.edit',
                    'description' => 'Modifier mes informations personnelles',
                    'icon' => 'fas fa-user-cog',
                    'category' => 'profile',
                    'position' => 4,
                    'is_favorite' => false,
                ],
            ];

            // Ajouter des bookmarks pour les administrateurs
            if ($user->isAdmin()) {
                $adminBookmarks = [
                    [
                        'title' => 'Dashboard Admin',
                        'url' => route('admin.dashboard'),
                        'route_name' => 'admin.dashboard',
                        'description' => 'Tableau de bord administrateur',
                        'icon' => 'fas fa-tachometer-alt',
                        'category' => 'admin',
                        'position' => 5,
                        'is_favorite' => true,
                    ],
                    [
                        'title' => 'Gestion utilisateurs',
                        'url' => route('admin.users'),
                        'route_name' => 'admin.users',
                        'description' => 'Gérer les utilisateurs du site',
                        'icon' => 'fas fa-users',
                        'category' => 'admin',
                        'position' => 6,
                        'is_favorite' => false,
                    ],
                    [
                        'title' => 'Gestion voitures',
                        'url' => route('admin.cars'),
                        'route_name' => 'admin.cars',
                        'description' => 'Modérer les annonces de voitures',
                        'icon' => 'fas fa-car',
                        'category' => 'admin',
                        'position' => 7,
                        'is_favorite' => false,
                    ],
                ];
                $bookmarks = array_merge($bookmarks, $adminBookmarks);
            }

            // Créer les bookmarks
            foreach ($bookmarks as $bookmarkData) {
                Bookmark::create(array_merge($bookmarkData, [
                    'user_id' => $user->id,
                ]));
            }
        }
    }
}
