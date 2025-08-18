<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Bookmark extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'url',
        'route_name',
        'description',
        'icon',
        'category',
        'position',
        'is_favorite',
    ];

    protected $casts = [
        'is_favorite' => 'boolean',
        'position' => 'integer',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function scopeFavorites(Builder $query): Builder
    {
        return $query->where('is_favorite', true);
    }

    public function scopeByCategory(Builder $query, string $category): Builder
    {
        return $query->where('category', $category);
    }

    public function scopeForUser(Builder $query, int $userId): Builder
    {
        return $query->where('user_id', $userId);
    }

    public static function existsForUser(string $url, int $userId): bool
    {
        return static::where('url', $url)
            ->where('user_id', $userId)
            ->exists();
    }

    public static function createFromCurrentPage(User $user, ?string $title = null, ?string $description = null, ?string $category = null): static
    {
        $request = request();
        $url = $request->fullUrl();
        $routeName = $request->route()?->getName();

        $icon = static::getIconForRoute($routeName);
        // Respecter la catégorie fournie si elle est présente, sinon déduire
        $category = $category ?? static::getCategoryForRoute($routeName);

        if (! $title) {
            $title = static::getTitleForRoute($routeName) ?? 'Page sauvegardée';
        }

        return static::create([
            'user_id' => $user->id,
            'title' => $title,
            'url' => $url,
            'route_name' => $routeName,
            'description' => $description,
            'icon' => $icon,
            'category' => $category,
            'position' => (int) static::where('user_id', $user->id)->max('position') + 1,
        ]);
    }

    /**
     * Créer un bookmark à partir d'une URL explicite (utile pour les requêtes AJAX depuis une autre page)
     */
    public static function createFromUrl(User $user, string $url, ?string $title = null, ?string $description = null, ?string $category = null): static
    {
        // Pas de route_name fiable ici, on laisse à null
        $routeName = null;
        $icon = static::getIconForRoute($routeName);
        $category = $category ?? static::getCategoryForRoute($routeName);

        if (! $title) {
            $title = 'Page sauvegardée';
        }

        return static::create([
            'user_id' => $user->id,
            'title' => $title,
            'url' => $url,
            'route_name' => $routeName,
            'description' => $description,
            'icon' => $icon,
            'category' => $category,
            'position' => (int) static::where('user_id', $user->id)->max('position') + 1,
        ]);
    }

    private static function getIconForRoute(?string $routeName): string
    {
        $iconMap = [
            'cars.index' => 'fas fa-car',
            'cars.show' => 'fas fa-car',
            'cars.create' => 'fas fa-plus-circle',
            'cars.my-cars' => 'fas fa-garage',
            'favorites' => 'fas fa-heart',
            'admin.dashboard' => 'fas fa-tachometer-alt',
            'admin.users' => 'fas fa-users',
            'admin.cars' => 'fas fa-car',
            'admin.statistics' => 'fas fa-chart-bar',
            'profile.edit' => 'fas fa-user-cog',
            'home' => 'fas fa-home',
        ];

        return $iconMap[$routeName] ?? 'fas fa-bookmark';
    }

    private static function getCategoryForRoute(?string $routeName): string
    {
        if (! $routeName) {
            return 'general';
        }
        if (str_starts_with($routeName, 'admin.')) {
            return 'admin';
        } elseif (str_starts_with($routeName, 'cars.')) {
            return 'cars';
        } elseif ($routeName === 'favorites') {
            return 'favorites';
        } elseif ($routeName === 'profile.edit') {
            return 'profile';
        }

        return 'general';
    }

    private static function getTitleForRoute(?string $routeName): ?string
    {
        $titleMap = [
            'cars.index' => 'Liste des voitures',
            'cars.show' => 'Détails de la voiture',
            'cars.create' => 'Ajouter une voiture',
            'cars.my-cars' => 'Mes voitures',
            'favorites' => 'Mes favoris',
            'admin.dashboard' => 'Dashboard Admin',
            'admin.users' => 'Gestion utilisateurs',
            'admin.cars' => 'Gestion voitures',
            'admin.statistics' => 'Statistiques',
            'profile.edit' => 'Mon profil',
            'home' => 'Accueil',
        ];

        return $titleMap[$routeName] ?? null;
    }

    public function markAsFavorite(): void
    {
        $this->update(['is_favorite' => true]);
    }

    public function removeFromFavorites(): void
    {
        $this->update(['is_favorite' => false]);
    }

    public function toggleFavorite(): void
    {
        $this->update(['is_favorite' => ! $this->is_favorite]);
    }

    public function moveToPosition(int $newPosition): void
    {
        $bookmarks = static::where('user_id', $this->user_id)
            ->where('id', '!=', $this->id)
            ->orderBy('position')
            ->get();

        $position = 1;
        foreach ($bookmarks as $bookmark) {
            if ($position == $newPosition) {
                $position++;
            }
            $bookmark->update(['position' => $position]);
            $position++;
        }

        $this->update(['position' => $newPosition]);
    }
}
