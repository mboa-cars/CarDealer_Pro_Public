<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class BookmarkMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Vérifier d'abord si c'est une route de bookmarks ou d'API
        if ($request->is('bookmarks/*') || $request->is('api/*')) {
            return $next($request);
        }

        $response = $next($request);

        // Seulement pour les réponses HTML, les utilisateurs authentifiés et les méthodes GET
        if ($request->user() &&
            $request->isMethod('GET') &&
            $response->headers->get('content-type') &&
            str_contains($response->headers->get('content-type'), 'text/html')) {

            $content = $response->getContent();

            // Injecter les boutons bookmark avant la fermeture du body
            if (strpos($content, '</body>') !== false) {
                $bookmarkButton = view('components.bookmark-button')->render();
                $bookmarkQuickAdd = view('components.bookmark-quick-add')->render();
                $content = str_replace('</body>', $bookmarkQuickAdd.$bookmarkButton.'</body>', $content);
                $response->setContent($content);
            }
        }

        return $response;
    }
}
