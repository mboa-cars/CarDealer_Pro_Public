@php
    $currentUrl = request()->fullUrl();
    $user = auth()->user();
    $isBookmarked = $user ? \App\Models\Bookmark::existsForUser($currentUrl, $user->id) : false;
@endphp

@auth
    <div class="bookmark-quick-add-container position-fixed" style="bottom: 20px; right: 90px; z-index: 1000;">
        <button class="btn bookmark-quick-add {{ $isBookmarked ? 'bookmarked' : '' }}" 
                data-url="{{ $currentUrl }}"
                style="width: 50px; height: 50px; border-radius: 50%; background: linear-gradient(135deg, #F26522 0%, #ea6500 100%); color: white; border: none; box-shadow: 0 4px 15px rgba(242, 101, 34, 0.3); transition: all 0.3s ease; position: relative; overflow: hidden;">
            
            <!-- Icône principale -->
            <i class="fas {{ $isBookmarked ? 'fa-bookmark' : 'fa-plus' }}" style="font-size: 1rem;"></i>
            
            <!-- Tooltip -->
            <div class="bookmark-quick-tooltip" style="position: absolute; bottom: 60px; right: 0; background: rgba(0, 0, 0, 0.8); color: white; padding: 8px 12px; border-radius: 6px; font-size: 0.8rem; white-space: nowrap; opacity: 0; transition: opacity 0.3s ease; pointer-events: none;">
                {{ $isBookmarked ? 'Retirer des bookmarks' : 'Ajouter cette page' }}
            </div>
        </button>
    </div>

    <style>
    .bookmark-quick-add {
        transition: all 0.3s ease;
    }
    
    .bookmark-quick-add:hover {
        transform: scale(1.1);
        box-shadow: 0 6px 20px rgba(242, 101, 34, 0.4) !important;
    }
    
    .bookmark-quick-add.bookmarked {
        background: linear-gradient(135deg, #28a745 0%, #1e7e34 100%) !important;
        box-shadow: 0 4px 15px rgba(40, 167, 69, 0.3) !important;
    }
    
    .bookmark-quick-add:hover .bookmark-quick-tooltip {
        opacity: 1;
    }
    
    @keyframes quickBookmarkPulse {
        0% { transform: scale(1); }
        50% { transform: scale(1.05); }
        100% { transform: scale(1); }
    }
    
    .bookmark-quick-add.bookmarked {
        animation: quickBookmarkPulse 2s ease-in-out infinite;
    }
    </style>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const bookmarkQuickButton = document.querySelector('.bookmark-quick-add');
        
        if (bookmarkQuickButton) {
            bookmarkQuickButton.addEventListener('click', function() {
                const url = this.dataset.url;
                const isBookmarked = this.classList.contains('bookmarked');
                
                if (isBookmarked) {
                    // Retirer le bookmark
                    fetch('/bookmarks/remove', {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify({ url: url })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            this.classList.remove('bookmarked');
                            this.querySelector('i').className = 'fas fa-plus';
                            this.querySelector('.bookmark-quick-tooltip').textContent = 'Ajouter cette page';
                        }
                    });
                } else {
                    // Ajouter le bookmark
                    fetch('/bookmarks/quick', {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify({ url: url })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            this.classList.add('bookmarked');
                            this.querySelector('i').className = 'fas fa-bookmark';
                            this.querySelector('.bookmark-quick-tooltip').textContent = 'Retirer des bookmarks';
                        }
                    });
                }
            });
        }
    });
    </script>
@endauth 