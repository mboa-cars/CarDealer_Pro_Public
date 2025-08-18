<?php

namespace App\Http\Controllers;

use App\Models\Bookmark;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookmarkController extends Controller
{
    /**
     * Afficher la liste des bookmarks de l'utilisateur
     */
    public function index(Request $request): View
    {
        $user = Auth::user();
        $category = $request->get('category', 'all');

        $query = Bookmark::where('user_id', $user->id);

        // Filtrer par catégorie
        if ($category !== 'all') {
            $query->byCategory($category);
        }

        // Trier par position puis par date de création
        $bookmarks = $query->orderBy('position')
            ->orderBy('created_at', 'desc')
            ->get()
            ->groupBy('category');

        // Statistiques
        $stats = [
            'total' => $user->bookmarks()->count(),
            'favorites' => $user->bookmarks()->where('is_favorite', true)->count(),
            'categories' => $user->bookmarks()->select('category')->distinct()->count(),
        ];

        return view('bookmarks.index', compact('bookmarks', 'stats', 'category'));
    }

    /**
     * Créer un nouveau bookmark
     */
    public function store(Request $request): JsonResponse
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string|max:500',
            'category' => 'nullable|string|max:50',
        ]);

        $user = Auth::user();
        $currentUrl = $request->fullUrl();

        // Vérifier si le bookmark existe déjà
        if (Bookmark::existsForUser($currentUrl, $user->id)) {
            return response()->json([
                'success' => false,
                'message' => 'Cette page est déjà dans vos bookmarks',
            ]);
        }

        // Créer le bookmark
        $bookmark = Bookmark::createFromCurrentPage(
            $user,
            $request->title,
            $request->description,
            $request->category
        );

        return response()->json([
            'success' => true,
            'message' => 'Bookmark ajouté avec succès',
            'bookmark' => $bookmark,
        ]);
    }

    /**
     * Créer un bookmark rapide (sans modal)
     */
    public function quickStore(Request $request)
    {
        $user = Auth::user();
        // Support JSON (fetch) or form-encoded
        $requestedUrl = $request->input('url');
        $currentUrl = $requestedUrl ?: $request->fullUrl();

        // Validation simple si l'URL est fournie
        if ($requestedUrl) {
            $request->validate([
                'url' => 'required|string|max:2048',
            ]);
        }

        // Vérifier si le bookmark existe déjà
        if (Bookmark::existsForUser($currentUrl, $user->id)) {
            if ($request->expectsJson() || $request->wantsJson() || $request->isJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Cette page est déjà dans vos bookmarks',
                ]);
            }

            return back()->with('error', 'Cette page est déjà dans vos bookmarks');
        }

        // Créer le bookmark automatiquement
        if ($requestedUrl) {
            $bookmark = Bookmark::createFromUrl($user, $requestedUrl);
        } else {
            $bookmark = Bookmark::createFromCurrentPage($user);
        }

        if ($request->expectsJson() || $request->wantsJson() || $request->isJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Page ajoutée à vos bookmarks',
                'bookmark' => $bookmark,
            ]);
        }

        return back()->with('success', 'Page ajoutée à vos bookmarks');
    }

    /**
     * Mettre à jour un bookmark
     */
    public function update(Request $request, Bookmark $bookmark): JsonResponse
    {
        // Vérifier que l'utilisateur possède ce bookmark
        if ($bookmark->user_id !== Auth::id()) {
            abort(403);
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string|max:500',
            'category' => 'nullable|string|max:50',
            'icon' => 'nullable|string|max:50',
        ]);

        $bookmark->update($request->only(['title', 'description', 'category', 'icon']));

        return response()->json([
            'success' => true,
            'message' => 'Bookmark mis à jour avec succès',
            'bookmark' => $bookmark,
        ]);
    }

    /**
     * Supprimer un bookmark
     */
    public function destroy(Bookmark $bookmark): JsonResponse
    {
        // Vérifier que l'utilisateur possède ce bookmark
        if ($bookmark->user_id !== Auth::id()) {
            abort(403);
        }

        $bookmark->delete();

        return response()->json([
            'success' => true,
            'message' => 'Bookmark supprimé avec succès',
        ]);
    }

    /**
     * Basculer le statut favori
     */
    public function toggleFavorite(Bookmark $bookmark): JsonResponse
    {
        // Vérifier que l'utilisateur possède ce bookmark
        if ($bookmark->user_id !== Auth::id()) {
            abort(403);
        }

        $bookmark->toggleFavorite();

        return response()->json([
            'success' => true,
            'message' => $bookmark->is_favorite ? 'Ajouté aux favoris' : 'Retiré des favoris',
            'is_favorite' => $bookmark->is_favorite,
        ]);
    }

    /**
     * Réorganiser les bookmarks
     */
    public function reorder(Request $request): JsonResponse
    {
        $request->validate([
            'bookmarks' => 'required|array',
            'bookmarks.*.id' => 'required|exists:bookmarks,id',
            'bookmarks.*.position' => 'required|integer|min:0',
        ]);

        $user = Auth::user();

        foreach ($request->bookmarks as $item) {
            $bookmark = Bookmark::find($item['id']);

            // Vérifier que l'utilisateur possède ce bookmark
            if ($bookmark && $bookmark->user_id === $user->id) {
                $bookmark->update(['position' => $item['position']]);
            }
        }

        return response()->json([
            'success' => true,
            'message' => 'Ordre mis à jour avec succès',
        ]);
    }

    /**
     * Obtenir les bookmarks pour l'API (dropdown)
     */
    public function apiIndex(): JsonResponse
    {
        $user = Auth::user();

        $bookmarks = $user->bookmarks()
            ->orderBy('position')
            ->orderBy('created_at', 'desc')
            ->take(10)
            ->get();

        return response()->json([
            'success' => true,
            'bookmarks' => $bookmarks,
        ]);
    }

    /**
     * Rechercher dans les bookmarks
     */
    public function search(Request $request): JsonResponse
    {
        $request->validate([
            'query' => 'required|string|min:2',
        ]);

        $user = Auth::user();
        $query = $request->get('query');

        $bookmarks = $user->bookmarks()
            ->where(function ($q) use ($query) {
                $q->where('title', 'like', "%{$query}%")
                    ->orWhere('description', 'like', "%{$query}%")
                    ->orWhere('url', 'like', "%{$query}%");
            })
            ->orderBy('is_favorite', 'desc')
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json([
            'success' => true,
            'bookmarks' => $bookmarks,
        ]);
    }

    /**
     * Supprimer un bookmark par URL
     */
    public function removeByUrl(Request $request): JsonResponse
    {
        $request->validate([
            'url' => 'required|string',
        ]);

        $user = Auth::user();
        $url = $request->get('url');

        $bookmark = Bookmark::where('user_id', $user->id)
            ->where('url', $url)
            ->first();

        if (! $bookmark) {
            return response()->json([
                'success' => false,
                'message' => 'Bookmark non trouvé',
            ]);
        }

        $bookmark->delete();

        return response()->json([
            'success' => true,
            'message' => 'Bookmark supprimé avec succès',
        ]);
    }
}
