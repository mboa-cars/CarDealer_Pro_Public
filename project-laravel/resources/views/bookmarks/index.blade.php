@extends('layouts.app')

@section('content')
<div class="container-fluid py-4" style="background: linear-gradient(135deg, #f8f9fa 0%, #ffffff 100%); min-height: 100vh;">
    
    <!-- Header avec titre amélioré -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="position-relative overflow-hidden" style="border-radius: 20px; background: linear-gradient(135deg, #F26522 0%, #ea6500 50%, #ff8c42 100%); box-shadow: 0 15px 35px rgba(242, 101, 34, 0.3);">
                <!-- Éléments décoratifs en arrière-plan -->
                <div class="position-absolute" style="top: -20px; right: -20px; width: 150px; height: 150px; background: rgba(255, 255, 255, 0.1); border-radius: 50%;"></div>
                <div class="position-absolute" style="bottom: -30px; left: -30px; width: 100px; height: 100px; background: rgba(255, 255, 255, 0.08); border-radius: 50%;"></div>
                <div class="position-absolute" style="top: 50%; right: 10%; width: 60px; height: 60px; background: rgba(255, 255, 255, 0.05); border-radius: 50%;"></div>
                
                <div class="p-5 position-relative">
                    <div class="row align-items-center">
                        <div class="col-lg-8">
                            <div class="d-flex align-items-center mb-3 header-main">
                                <div class="me-4 position-relative">
                                    <div class="rounded-circle d-flex align-items-center justify-content-center shadow-lg position-relative header-icon glow-effect" style="width: 80px; height: 80px; background: rgba(255, 255, 255, 0.2); backdrop-filter: blur(10px); border: 2px solid rgba(255, 255, 255, 0.3);">
                                        <i class="fas fa-bookmark text-white" style="font-size: 2rem;"></i>
                                    </div>
                                    <!-- Effet de brillance -->
                                    <div class="position-absolute" style="top: 10px; left: 10px; width: 20px; height: 20px; background: rgba(255, 255, 255, 0.4); border-radius: 50%; filter: blur(5px);"></div>
                                </div>
                                <div>
                                    <h1 class="fw-bold mb-2 text-white" style="font-size: 3rem; text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);">
                                        Mes Bookmarks
                                    </h1>
                                    <p class="text-white mb-0" style="font-size: 1.2rem; opacity: 0.9; text-shadow: 0 1px 2px rgba(0, 0, 0, 0.2);">
                                        <i class="fas fa-save me-2"></i>Gérez vos pages sauvegardées et retrouvez facilement vos contenus favoris
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="text-center header-stats">
                                <div class="d-flex justify-content-center mb-3">
                                    <div class="rounded-circle d-flex align-items-center justify-content-center me-3 header-icon" style="width: 50px; height: 50px; background: rgba(255, 255, 255, 0.2); backdrop-filter: blur(5px); border: 1px solid rgba(255, 255, 255, 0.3);">
                                        <i class="fas fa-bookmark text-white"></i>
                                    </div>
                                    <div class="rounded-circle d-flex align-items-center justify-content-center me-3 header-icon" style="width: 50px; height: 50px; background: rgba(255, 255, 255, 0.2); backdrop-filter: blur(5px); border: 1px solid rgba(255, 255, 255, 0.3);">
                                        <i class="fas fa-heart text-white"></i>
                                    </div>
                                    <div class="rounded-circle d-flex align-items-center justify-content-center header-icon" style="width: 50px; height: 50px; background: rgba(255, 255, 255, 0.2); backdrop-filter: blur(5px); border: 1px solid rgba(255, 255, 255, 0.3);">
                                        <i class="fas fa-folder text-white"></i>
                                    </div>
                                </div>
                                <div class="text-white">
                                    <div class="fw-bold mb-1" style="font-size: 1.5rem; text-shadow: 0 1px 2px rgba(0, 0, 0, 0.3);">
                                        {{ $stats['total'] }}
                                    </div>
                                    <div style="font-size: 0.9rem; opacity: 0.8;">Bookmarks au total</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Barre de progression décorative -->
                    <div class="mt-4 header-progress">
                        <div class="d-flex align-items-center">
                            <div class="flex-grow-1 me-3">
                                <div class="progress" style="height: 8px; background: rgba(255, 255, 255, 0.2); border-radius: 10px; overflow: hidden;">
                                    <div class="progress-bar" style="background: linear-gradient(90deg, rgba(255, 255, 255, 0.8) 0%, rgba(255, 255, 255, 0.6) 100%); width: 75%; border-radius: 10px;"></div>
                                </div>
                            </div>
                            <div class="text-white" style="font-size: 0.9rem; opacity: 0.8;">
                                <i class="fas fa-chart-line me-1"></i>Organisation en temps réel
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Statistiques rapides -->
    <div class="row g-4 mb-4">
        <div class="col-lg-3 col-md-6">
            <div class="card shadow-sm border-0 h-100" style="border-radius: 16px; background: linear-gradient(135deg, #fff 0%, #fafafa 100%); border-left: 4px solid #F26522; transition: all 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94);">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center">
                        <div class="me-3">
                            <div class="rounded-circle d-flex align-items-center justify-content-center shadow-lg" style="width: 50px; height: 50px; background: linear-gradient(135deg, #F26522 0%, #ea6500 100%);">
                                <i class="fas fa-bookmark text-white"></i>
                            </div>
                        </div>
                        <div>
                            <p class="text-muted mb-1" style="font-size: 0.9rem; font-weight: 500;">Total Bookmarks</p>
                            <h3 class="fw-bold mb-1" style="color: #333; font-size: 2rem;">{{ $stats['total'] }}</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6">
            <div class="card shadow-sm border-0 h-100" style="border-radius: 16px; background: linear-gradient(135deg, #fff 0%, #fafafa 100%); border-left: 4px solid #dc3545; transition: all 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94);">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center">
                        <div class="me-3">
                            <div class="rounded-circle d-flex align-items-center justify-content-center shadow-lg" style="width: 50px; height: 50px; background: linear-gradient(135deg, #dc3545 0%, #c82333 100%);">
                                <i class="fas fa-heart text-white"></i>
                            </div>
                        </div>
                        <div>
                            <p class="text-muted mb-1" style="font-size: 0.9rem; font-weight: 500;">Favoris</p>
                            <h3 class="fw-bold mb-1" style="color: #333; font-size: 2rem;">{{ $stats['favorites'] }}</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6">
            <div class="card shadow-sm border-0 h-100" style="border-radius: 16px; background: linear-gradient(135deg, #fff 0%, #fafafa 100%); border-left: 4px solid #28a745; transition: all 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94);">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center">
                        <div class="me-3">
                            <div class="rounded-circle d-flex align-items-center justify-content-center shadow-lg" style="width: 50px; height: 50px; background: linear-gradient(135deg, #28a745 0%, #1e7e34 100%);">
                                <i class="fas fa-folder text-white"></i>
                            </div>
                        </div>
                        <div>
                            <p class="text-muted mb-1" style="font-size: 0.9rem; font-weight: 500;">Catégories</p>
                            <h3 class="fw-bold mb-1" style="color: #333; font-size: 2rem;">{{ $stats['categories'] }}</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6">
            <div class="card shadow-sm border-0 h-100" style="border-radius: 16px; background: linear-gradient(135deg, #fff 0%, #fafafa 100%); border-left: 4px solid #007bff; transition: all 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94);">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center">
                        <div class="me-3">
                            <div class="rounded-circle d-flex align-items-center justify-content-center shadow-lg" style="width: 50px; height: 50px; background: linear-gradient(135deg, #007bff 0%, #0056b3 100%);">
                                <i class="fas fa-plus text-white"></i>
                            </div>
                        </div>
                        <div>
                            <p class="text-muted mb-1" style="font-size: 0.9rem; font-weight: 500;">Ajouter</p>
                            <h3 class="fw-bold mb-1" style="color: #333; font-size: 2rem;">Nouveau</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Filtres et recherche -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card shadow-sm border-0" style="border-radius: 16px; background: linear-gradient(135deg, #fff 0%, #fafafa 100%);">
                <div class="card-body p-4">
                    <div class="row align-items-center">
                        <div class="col-md-6">
                            <div class="d-flex align-items-center">
                                <div class="input-group">
                                    <span class="input-group-text" style="background: linear-gradient(135deg, #F26522 0%, #ea6500 100%); border: none; color: white;">
                                        <i class="fas fa-search"></i>
                                    </span>
                                    <input type="text" id="searchBookmarks" class="form-control" placeholder="Rechercher dans vos bookmarks..." style="border: 2px solid #e9ecef; border-radius: 0 8px 8px 0;">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="d-flex justify-content-end">
                                <select id="categoryFilter" class="form-select me-2" style="border-radius: 8px; border: 2px solid #e9ecef; max-width: 200px;">
                                    <option value="all">Toutes les catégories</option>
                                    <option value="general">Général</option>
                                    <option value="cars">Voitures</option>
                                    <option value="admin">Administration</option>
                                    <option value="favorites">Favoris</option>
                                    <option value="profile">Profil</option>
                                </select>
                                <button class="btn" style="background: linear-gradient(135deg, #F26522 0%, #ea6500 100%); color: white; border: none; border-radius: 8px; padding: 0.5rem 1rem;">
                                    <i class="fas fa-plus me-2"></i>Ajouter
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Liste des bookmarks -->
    <div class="row" id="bookmarksContainer">
        @forelse($bookmarks as $category => $categoryBookmarks)
            <div class="col-12 mb-4">
                <div class="card shadow-sm border-0" style="border-radius: 16px; background: linear-gradient(135deg, #fff 0%, #fafafa 100%);">
                    <div class="card-header border-0 bg-transparent" style="padding: 1.5rem 1.5rem 0;">
                        <h5 class="mb-0 fw-bold" style="color: #333; font-size: 1.3rem;">
                            <i class="fas fa-folder me-2" style="color: #F26522;"></i>{{ ucfirst($category) }} ({{ count($categoryBookmarks) }})
                        </h5>
                    </div>
                    <div class="card-body p-4">
                        <div class="row g-3" data-category="{{ $category }}">
                            @foreach($categoryBookmarks as $bookmark)
                                <div class="col-lg-4 col-md-6 bookmark-item" data-id="{{ $bookmark->id }}" data-title="{{ strtolower($bookmark->title) }}">
                                    <div class="card h-100 shadow-sm border-0" style="border-radius: 12px; background: linear-gradient(135deg, #fff 0%, #f8f9fa 100%); transition: all 0.3s ease; border-left: 4px solid #F26522;">
                                        <div class="card-body p-3">
                                            <div class="d-flex align-items-start justify-content-between mb-2">
                                                <div class="d-flex align-items-center">
                                                    <div class="rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 35px; height: 35px; background: linear-gradient(135deg, #F26522 0%, #ea6500 100%);">
                                                        <i class="{{ $bookmark->icon }} text-white" style="font-size: 0.9rem;"></i>
                                                    </div>
                                                    <div>
                                                        <h6 class="fw-bold mb-1" style="color: #333; font-size: 0.95rem;">{{ $bookmark->title }}</h6>
                                                        @if($bookmark->description)
                                                            <p class="text-muted mb-0" style="font-size: 0.8rem;">{{ Str::limit($bookmark->description, 50) }}</p>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="dropdown">
                                                    <button class="btn btn-sm btn-link text-muted" type="button" data-bs-toggle="dropdown" style="padding: 0; border: none;">
                                                        <i class="fas fa-ellipsis-v"></i>
                                                    </button>
                                                    <ul class="dropdown-menu">
                                                        <li><a class="dropdown-item" href="{{ $bookmark->url }}"><i class="fas fa-external-link-alt me-2"></i>Ouvrir</a></li>
                                                        <li><a class="dropdown-item edit-bookmark" href="#" data-id="{{ $bookmark->id }}"><i class="fas fa-edit me-2"></i>Modifier</a></li>
                                                        <li><hr class="dropdown-divider"></li>
                                                        <li><a class="dropdown-item text-danger delete-bookmark" href="#" data-id="{{ $bookmark->id }}"><i class="fas fa-trash me-2"></i>Supprimer</a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                            
                                            <div class="d-flex align-items-center justify-content-between">
                                                <small class="text-muted" style="font-size: 0.75rem;">
                                                    {{ $bookmark->created_at->diffForHumans() }}
                                                </small>
                                                <div class="d-flex align-items-center">
                                                    <button class="btn btn-sm toggle-favorite me-2" data-id="{{ $bookmark->id }}" style="padding: 0.25rem 0.5rem; border: none; background: none;">
                                                        <i class="fas fa-heart {{ $bookmark->is_favorite ? 'text-danger' : 'text-muted' }}" style="font-size: 0.9rem;"></i>
                                                    </button>
                                                    <a href="{{ $bookmark->url }}" class="btn btn-sm" style="background: linear-gradient(135deg, #F26522 0%, #ea6500 100%); color: white; border: none; border-radius: 6px; padding: 0.25rem 0.75rem; font-size: 0.8rem;">
                                                        <i class="fas fa-external-link-alt me-1"></i>Ouvrir
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="text-center py-5">
                    <div class="mb-4">
                        <i class="fas fa-bookmark text-muted" style="font-size: 4rem;"></i>
                    </div>
                    <h4 class="text-muted mb-3">Aucun bookmark trouvé</h4>
                    <p class="text-muted mb-4">Commencez par ajouter des pages à vos bookmarks pour les retrouver facilement.</p>
                    <button class="btn btn-lg" style="background: linear-gradient(135deg, #F26522 0%, #ea6500 100%); color: white; border: none; border-radius: 12px; padding: 1rem 2rem;">
                        <i class="fas fa-plus me-2"></i>Ajouter votre premier bookmark
                    </button>
                </div>
            </div>
        @endforelse
    </div>
</div>

<!-- Modal pour ajouter/modifier un bookmark -->
<div class="modal fade" id="bookmarkModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content" style="border-radius: 16px; border: none;">
            <div class="modal-header border-0" style="background: linear-gradient(135deg, #F26522 0%, #ea6500 100%); color: white; border-radius: 16px 16px 0 0;">
                <h5 class="modal-title fw-bold">
                    <i class="fas fa-bookmark me-2"></i>
                    <span id="modalTitle">Ajouter un bookmark</span>
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body p-4">
                <form id="bookmarkForm">
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Titre</label>
                        <input type="text" class="form-control" id="bookmarkTitle" name="title" required style="border-radius: 8px; border: 2px solid #e9ecef;">
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Description (optionnel)</label>
                        <textarea class="form-control" id="bookmarkDescription" name="description" rows="3" style="border-radius: 8px; border: 2px solid #e9ecef;"></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Catégorie</label>
                        <select class="form-select" id="bookmarkCategory" name="category" style="border-radius: 8px; border: 2px solid #e9ecef;">
                            <option value="general">Général</option>
                            <option value="cars">Voitures</option>
                            <option value="admin">Administration</option>
                            <option value="favorites">Favoris</option>
                            <option value="profile">Profil</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Icône</label>
                        <select class="form-select" id="bookmarkIcon" name="icon" style="border-radius: 8px; border: 2px solid #e9ecef;">
                            <option value="fas fa-bookmark">Bookmark</option>
                            <option value="fas fa-car">Voiture</option>
                            <option value="fas fa-home">Accueil</option>
                            <option value="fas fa-heart">Cœur</option>
                            <option value="fas fa-user">Utilisateur</option>
                            <option value="fas fa-cog">Paramètres</option>
                            <option value="fas fa-chart-bar">Graphique</option>
                            <option value="fas fa-folder">Dossier</option>
                        </select>
                    </div>
                </form>
            </div>
            <div class="modal-footer border-0">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal" style="border-radius: 8px;">Annuler</button>
                <button type="button" class="btn" id="saveBookmark" style="background: linear-gradient(135deg, #F26522 0%, #ea6500 100%); color: white; border: none; border-radius: 8px;">Sauvegarder</button>
            </div>
        </div>
    </div>
</div>

<style>
/* Styles pour les bookmarks */
.bookmark-item {
    transition: all 0.3s ease;
}

.bookmark-item:hover {
    transform: translateY(-5px);
}

.bookmark-item .card:hover {
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15) !important;
}

.toggle-favorite:hover {
    transform: scale(1.2);
}

/* Animations */
@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.bookmark-item {
    animation: fadeInUp 0.6s ease-out forwards;
}

.bookmark-item:nth-child(1) { animation-delay: 0.1s; }
.bookmark-item:nth-child(2) { animation-delay: 0.2s; }
.bookmark-item:nth-child(3) { animation-delay: 0.3s; }

/* Responsive */
@media (max-width: 768px) {
    .bookmark-item {
        margin-bottom: 1rem;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Recherche en temps réel
    const searchInput = document.getElementById('searchBookmarks');
    const bookmarkItems = document.querySelectorAll('.bookmark-item');
    
    searchInput.addEventListener('input', function() {
        const query = this.value.toLowerCase();
        
        bookmarkItems.forEach(item => {
            const title = item.dataset.title;
            if (title.includes(query)) {
                item.style.display = 'block';
            } else {
                item.style.display = 'none';
            }
        });
    });
    
    // Filtre par catégorie
    const categoryFilter = document.getElementById('categoryFilter');
    categoryFilter.addEventListener('change', function() {
        const category = this.value;
        const categoryContainers = document.querySelectorAll('[data-category]');
        
        categoryContainers.forEach(container => {
            if (category === 'all' || container.dataset.category === category) {
                container.style.display = 'block';
            } else {
                container.style.display = 'none';
            }
        });
    });
    
    // Toggle favori
    document.querySelectorAll('.toggle-favorite').forEach(button => {
        button.addEventListener('click', function() {
            const bookmarkId = this.dataset.id;
            const icon = this.querySelector('i');
            
            fetch(`/bookmarks/${bookmarkId}/favorite`, {
                method: 'PATCH',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Content-Type': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    icon.classList.toggle('text-danger');
                    icon.classList.toggle('text-muted');
                }
            });
        });
    });
    
    // Supprimer bookmark
    document.querySelectorAll('.delete-bookmark').forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            const bookmarkId = this.dataset.id;
            
            if (confirm('Êtes-vous sûr de vouloir supprimer ce bookmark ?')) {
                fetch(`/bookmarks/${bookmarkId}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        this.closest('.bookmark-item').remove();
                    }
                });
            }
        });
    });
});
</script>
@endsection 