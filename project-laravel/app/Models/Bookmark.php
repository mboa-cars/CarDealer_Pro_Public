<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bookmark extends Model
{
    use HasFactory;

    protected $fillable = [
        "user_id",
        "title",
        "url",
        "route_name",
        "description",
        "icon",
        "category",
        "position",
        "is_favorite",
        "metadata"
    ];

    protected $casts = [
        "is_favorite" => "boolean",
        "metadata" => "array",
        "position" => "integer"
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function scopeFavorites($query)
    {
        return $query->where("is_favorite", true);
    }

    public function scopeByCategory($query, $category)
    {
        return $query->where("category", $category);
    }

    public function scopeForUser($query, $userId)
    {
        return $query->where("user_id", $userId);
    }

    public static function existsForUser($url, $userId)
    {
        return static::where("url", $url)
                    ->where("user_id", $userId)
                    ->exists();
    }

    public static function createFromCurrentPage($user, $title = null, $description = null, $category = "general")
    {
        $request = request();
        $url = $request->fullUrl();
        $routeName = $request->route() ? $request->route()->getName() : null;

        $icon = static::getIconForRoute($routeName);
        $category = static::getCategoryForRoute($routeName);

        if (!$title) {
            $title = static::getTitleForRoute($routeName) ?? "Page sauvegardée";
        }

        return static::create([
            "user_id" => $user->id,
            "title" => $title,
            "url" => $url,
            "route_name" => $routeName,
            "description" => $description,
            "icon" => $icon,
            "category" => $category,
            "position" => static::where("user_id", $user->id)->max("position") + 1
        ]);
    }

    private static function getIconForRoute($routeName)
    {
        $iconMap = [
            "cars.index" => "fas fa-car",
            "cars.show" => "fas fa-car",
            "cars.create" => "fas fa-plus-circle",
            "cars.my-cars" => "fas fa-garage",
            "favorites" => "fas fa-heart",
            "admin.dashboard" => "fas fa-tachometer-alt",
            "admin.users" => "fas fa-users",
            "admin.cars" => "fas fa-car",
            "admin.statistics" => "fas fa-chart-bar",
            "profile.edit" => "fas fa-user-cog",
            "home" => "fas fa-home"
        ];

        return $iconMap[$routeName] ?? "fas fa-bookmark";
    }

    private static function getCategoryForRoute($routeName)
    {
        if (str_starts_with($routeName, "admin.")) {
            return "admin";
        } elseif (str_starts_with($routeName, "cars.")) {
            return "cars";
        } elseif ($routeName === "favorites") {
            return "favorites";
        } elseif ($routeName === "profile.edit") {
            return "profile";
        }

        return "general";
    }

    private static function getTitleForRoute($routeName)
    {
        $titleMap = [
            "cars.index" => "Liste des voitures",
            "cars.show" => "Détails de la voiture",
            "cars.create" => "Ajouter une voiture",
            "cars.my-cars" => "Mes voitures",
            "favorites" => "Mes favoris",
            "admin.dashboard" => "Dashboard Admin",
            "admin.users" => "Gestion utilisateurs",
            "admin.cars" => "Gestion voitures",
            "admin.statistics" => "Statistiques",
            "profile.edit" => "Mon profil",
            "home" => "Accueil"
        ];

        return $titleMap[$routeName] ?? null;
    }

    public function markAsFavorite()
    {
        $this->update(["is_favorite" => true]);
    }

    public function removeFromFavorites()
    {
        $this->update(["is_favorite" => false]);
    }

    public function toggleFavorite()
    {
        $this->update(["is_favorite" => !$this->is_favorite]);
    }

    public function moveToPosition($newPosition)
    {
        $bookmarks = static::where("user_id", $this->user_id)
                           ->where("id", "!=", $this->id)
                           ->orderBy("position")
                           ->get();

        $position = 1;
        foreach ($bookmarks as $bookmark) {
            if ($position == $newPosition) {
                $position++;
            }
            $bookmark->update(["position" => $position]);
            $position++;
        }

        $this->update(["position" => $newPosition]);
    }
}
