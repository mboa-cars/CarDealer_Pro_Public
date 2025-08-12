@php
    $user = auth()->user();
    $recentBookmarks = $user ? $user->bookmarks()->orderBy('created_at', 'desc')->take(5)->get() : collect();
@endphp

@auth
    <div class="relative" x-data="{ bookmarksDropdownOpen: false }">
        <button @click="bookmarksDropdownOpen = !bookmarksDropdownOpen" 
                @click.away="bookmarksDropdownOpen = false" 
                class="btn btn-modern-nav bookmarks-btn" 
                style="background: linear-gradient(135deg, #28a745 0%, #1e7e34 100%); color: white; border: none; border-radius: 12px; padding: 10px 20px; font-weight: 600; transition: all 0.3s ease; box-shadow: 0 4px 15px rgba(40, 167, 69, 0.3); display: flex; align-items: center; gap: 8px; position: relative; overflow: hidden;">
            <i class="fas fa-bookmark btn-icon"></i>
            <span>Bookmarks</span>
            <span class="badge bg-white text-success" style="font-size: 0.7rem; padding: 2px 6px; border-radius: 10px; margin-left: 5px;">
                {{ $recentBookmarks->count() }}
            </span>
            <i class="fas fa-chevron-down dropdown-arrow" style="font-size: 0.8rem; transition: transform 0.3s ease;" :class="{ 'rotate-180': bookmarksDropdownOpen }"></i>
            <div class="btn-particles"></div>
        </button>

        <!-- Dropdown Menu -->
        <div x-show="bookmarksDropdownOpen" 
             x-transition:enter="transition ease-out duration-300" 
             x-transition:enter-start="transform opacity-0 scale-95 translate-y-2" 
             x-transition:enter-end="transform opacity-100 scale-100 translate-y-0" 
             x-transition:leave="transition ease-in duration-200" 
             x-transition:leave-start="transform opacity-100 scale-100 translate-y-0" 
             x-transition:leave-end="transform opacity-0 scale-95 translate-y-2" 
             class="absolute right-0 mt-2 w-80 bg-white rounded-lg shadow-xl border border-gray-200 py-2 z-50 dropdown-menu" 
             style="min-width: 320px; backdrop-filter: blur(10px); background: rgba(255, 255, 255, 0.95);">
            
            <!-- Header -->
            <div class="px-4 py-3 border-b border-gray-100">
                <div class="d-flex align-items-center justify-content-between">
                    <h6 class="mb-0 fw-bold" style="color: #333;">
                        <i class="fas fa-bookmark me-2" style="color: #28a745;"></i>
                        Mes Bookmarks
                    </h6>
                    <a href="{{ route('bookmarks.index') }}" class="text-decoration-none" style="color: #28a745; font-size: 0.9rem;">
                        Voir tout
                    </a>
                </div>
            </div>
            
            <!-- Bookmarks List -->
            <div class="bookmarks-list" style="max-height: 300px; overflow-y: auto;">
                @if($recentBookmarks->count() > 0)
                    @foreach($recentBookmarks as $bookmark)
                        <a href="{{ $bookmark->url }}" class="dropdown-item bookmark-item" style="padding: 12px 16px; border-bottom: 1px solid #f8f9fa; transition: all 0.3s ease;">
                            <div class="d-flex align-items-start">
                                <div class="me-3 mt-1">
                                    <i class="{{ $bookmark->icon }}" style="color: #28a745; font-size: 1rem;"></i>
                                </div>
                                <div class="flex-grow-1">
                                    <div class="fw-bold mb-1" style="color: #333; font-size: 0.9rem; line-height: 1.2;">
                                        {{ $bookmark->title }}
                                    </div>
                                    @if($bookmark->description)
                                        <div class="text-muted mb-1" style="font-size: 0.8rem; line-height: 1.2;">
                                            {{ Str::limit($bookmark->description, 50) }}
                                        </div>
                                    @endif
                                    <div class="d-flex align-items-center justify-content-between">
                                        <small class="text-muted" style="font-size: 0.75rem;">
                                            {{ $bookmark->created_at->diffForHumans() }}
                                        </small>
                                        @if($bookmark->is_favorite)
                                            <i class="fas fa-heart text-danger" style="font-size: 0.8rem;"></i>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </a>
                    @endforeach
                @else
                    <div class="px-4 py-3 text-center">
                        <i class="fas fa-bookmark text-muted mb-2" style="font-size: 2rem;"></i>
                        <p class="text-muted mb-0" style="font-size: 0.9rem;">
                            Aucun bookmark pour le moment
                        </p>
                        <small class="text-muted">
                            Utilisez le bouton bookmark sur les pages pour en ajouter
                        </small>
                    </div>
                @endif
            </div>
            
            <!-- Footer -->
            @if($recentBookmarks->count() > 0)
                <div class="px-4 py-2 border-t border-gray-100">
                    <div class="d-flex justify-content-between align-items-center">
                        <small class="text-muted">
                            {{ $user->bookmarks()->count() }} bookmark(s) au total
                        </small>
                        <a href="{{ route('bookmarks.index') }}" class="btn btn-sm" style="background: linear-gradient(135deg, #28a745 0%, #1e7e34 100%); color: white; border: none; border-radius: 8px; padding: 6px 12px; font-size: 0.8rem; text-decoration: none;">
                            Gérer
                        </a>
                    </div>
                </div>
            @endif
        </div>
    </div>

    <style>
    .bookmarks-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(40, 167, 69, 0.4) !important;
    }
    
    .bookmark-item:hover {
        background-color: #f8f9fa;
        transform: translateX(5px);
    }
    
    .bookmarks-list::-webkit-scrollbar {
        width: 4px;
    }
    
    .bookmarks-list::-webkit-scrollbar-track {
        background: #f1f1f1;
        border-radius: 2px;
    }
    
    .bookmarks-list::-webkit-scrollbar-thumb {
        background: #28a745;
        border-radius: 2px;
    }
    
    .bookmarks-list::-webkit-scrollbar-thumb:hover {
        background: #1e7e34;
    }
    </style>
@endauth 