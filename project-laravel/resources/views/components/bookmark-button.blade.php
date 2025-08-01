@php
    $currentUrl = request()->fullUrl();
    $user = auth()->user();
    $isBookmarked = $user ? \App\Models\Bookmark::existsForUser($currentUrl, $user->id) : false;
@endphp

@auth
    <div class="bookmark-button-container position-fixed" style="bottom: 20px; right: 20px; z-index: 1000;">
        <a href="{{ route('bookmarks.index') }}" class="btn bookmark-toggle {{ $isBookmarked ? 'bookmarked' : '' }}" 
           style="width: 60px; height: 60px; border-radius: 50%; background: linear-gradient(135deg, #28a745 0%, #1e7e34 100%); color: white; border: none; box-shadow: 0 4px 15px rgba(40, 167, 69, 0.3); transition: all 0.3s ease; position: relative; overflow: hidden; text-decoration: none; display: flex; align-items: center; justify-content: center;">
            
            <!-- Icône principale -->
            <i class="fas fa-bookmark" style="font-size: 1.2rem;"></i>
            
            <!-- Effet de particules -->
            <div class="bookmark-particles"></div>
            
            <!-- Tooltip -->
            <div class="bookmark-tooltip" style="position: absolute; bottom: 70px; right: 0; background: rgba(0, 0, 0, 0.8); color: white; padding: 8px 12px; border-radius: 6px; font-size: 0.8rem; white-space: nowrap; opacity: 0; transition: opacity 0.3s ease; pointer-events: none;">
                Accéder à mes bookmarks
            </div>
        </a>
    </div>

    <style>
    .bookmark-toggle {
        transition: all 0.3s ease;
    }
    
    .bookmark-toggle:hover {
        transform: scale(1.1);
        box-shadow: 0 6px 20px rgba(40, 167, 69, 0.4) !important;
    }
    
    .bookmark-toggle:hover .bookmark-tooltip {
        opacity: 1;
    }
    
    .bookmark-particles {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: radial-gradient(circle, rgba(255, 255, 255, 0.3) 0%, transparent 70%);
        opacity: 0;
        transition: opacity 0.3s ease;
    }
    
    .bookmark-toggle:hover .bookmark-particles {
        opacity: 1;
    }
    
    @keyframes bookmarkPulse {
        0% { transform: scale(1); }
        50% { transform: scale(1.05); }
        100% { transform: scale(1); }
    }
    
    .bookmark-toggle {
        animation: bookmarkPulse 2s ease-in-out infinite;
    }
    </style>
@endauth 