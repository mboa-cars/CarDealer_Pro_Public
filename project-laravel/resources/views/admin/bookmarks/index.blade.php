@extends('layouts.admin')

@section('content')
<div class="container-fluid py-4" style="background: linear-gradient(135deg, #f8f9fa 0%, #ffffff 100%); min-height: 100vh;">
    
    <!-- Header avec titre amélioré -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="position-relative overflow-hidden" style="border-radius: 20px; background: linear-gradient(135deg, #6f42c1 0%, #5a2d91 50%, #4a1d7a 100%); box-shadow: 0 15px 35px rgba(111, 66, 193, 0.3);">
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
                                        Gestion des Bookmarks
                                    </h1>
                                    <p class="text-white mb-0" style="font-size: 1.2rem; opacity: 0.9; text-shadow: 0 1px 2px rgba(0, 0, 0, 0.2);">
                                        <i class="fas fa-eye me-2"></i>Surveillez et gérez tous les bookmarks créés par les utilisateurs
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
                                        <i class="fas fa-star text-white"></i>
                                    </div>
                                    <div class="rounded-circle d-flex align-items-center justify-content-center header-icon" style="width: 50px; height: 50px; background: rgba(255, 255, 255, 0.2); backdrop-filter: blur(5px); border: 1px solid rgba(255, 255, 255, 0.3);">
                                        <i class="fas fa-users text-white"></i>
                                    </div>
                                </div>
                                <div class="text-white">
                                    <div class="fw-bold mb-1" style="font-size: 1.5rem; text-shadow: 0 1px 2px rgba(0, 0, 0, 0.3);">
                                        {{ $bookmarks->total() }}
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
                                <i class="fas fa-chart-line me-1"></i>Surveillance en temps réel
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Filtres -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card shadow-sm border-0" style="border-radius: 16px; background: linear-gradient(135deg, #fff 0%, #fafafa 100%);">
                <div class="card-body p-4">
                    <h5 class="fw-bold mb-4" style="color: #333; font-size: 1.3rem;">
                        <i class="fas fa-filter me-2" style="color: #6f42c1;"></i>Filtres et recherche
                    </h5>
                    <form method="GET" class="row g-3">
                        <!-- Recherche -->
                        <div class="col-md-3">
                            <label for="search" class="form-label fw-semibold" style="color: #555; font-size: 0.9rem;">
                                <i class="fas fa-search me-1" style="color: #6f42c1;"></i>Recherche
                            </label>
                            <input type="text" name="search" id="search" value="{{ request('search') }}" 
                                   class="form-control" style="border-radius: 10px; border: 2px solid #e9ecef; transition: all 0.3s ease;"
                                   placeholder="Titre, URL, description...">
                        </div>

                        <!-- Filtre par utilisateur -->
                        <div class="col-md-2">
                            <label for="user" class="form-label fw-semibold" style="color: #555; font-size: 0.9rem;">
                                <i class="fas fa-user me-1" style="color: #6f42c1;"></i>Utilisateur
                            </label>
                            <select name="user" id="user" class="form-select" style="border-radius: 10px; border: 2px solid #e9ecef; transition: all 0.3s ease;">
                                <option value="">Tous les utilisateurs</option>
                                @foreach($users as $user)
                                    <option value="{{ $user->id }}" {{ request('user') == $user->id ? 'selected' : '' }}>
                                        {{ $user->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Filtre par catégorie -->
                        <div class="col-md-2">
                            <label for="category" class="form-label fw-semibold" style="color: #555; font-size: 0.9rem;">
                                <i class="fas fa-tags me-1" style="color: #6f42c1;"></i>Catégorie
                            </label>
                            <select name="category" id="category" class="form-select" style="border-radius: 10px; border: 2px solid #e9ecef; transition: all 0.3s ease;">
                                <option value="">Toutes les catégories</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category }}" {{ request('category') == $category ? 'selected' : '' }}>
                                        {{ ucfirst($category) }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Filtre par favoris -->
                        <div class="col-md-2">
                            <label for="favorite" class="form-label fw-semibold" style="color: #555; font-size: 0.9rem;">
                                <i class="fas fa-star me-1" style="color: #6f42c1;"></i>Favoris
                            </label>
                            <select name="favorite" id="favorite" class="form-select" style="border-radius: 10px; border: 2px solid #e9ecef; transition: all 0.3s ease;">
                                <option value="">Tous</option>
                                <option value="true" {{ request('favorite') === 'true' ? 'selected' : '' }}>Favoris uniquement</option>
                                <option value="false" {{ request('favorite') === 'false' ? 'selected' : '' }}>Non favoris</option>
                            </select>
                        </div>

                        <!-- Tri -->
                        <div class="col-md-2">
                            <label for="sort" class="form-label fw-semibold" style="color: #555; font-size: 0.9rem;">
                                <i class="fas fa-sort me-1" style="color: #6f42c1;"></i>Tri
                            </label>
                            <select name="sort" id="sort" class="form-select" style="border-radius: 10px; border: 2px solid #e9ecef; transition: all 0.3s ease;">
                                <option value="latest" {{ request('sort') === 'latest' ? 'selected' : '' }}>Plus récents</option>
                                <option value="oldest" {{ request('sort') === 'oldest' ? 'selected' : '' }}>Plus anciens</option>
                                <option value="title" {{ request('sort') === 'title' ? 'selected' : '' }}>Par titre</option>
                                <option value="user" {{ request('sort') === 'user' ? 'selected' : '' }}>Par utilisateur</option>
                                <option value="category" {{ request('sort') === 'category' ? 'selected' : '' }}>Par catégorie</option>
                            </select>
                        </div>

                        <!-- Boutons -->
                        <div class="col-md-1 d-flex align-items-end">
                            <div class="d-flex gap-2 w-100">
                                <button type="submit" class="btn btn-primary flex-fill" style="border-radius: 10px; font-weight: 600; background: linear-gradient(135deg, #6f42c1 0%, #5a2d91 100%); border: none; transition: all 0.3s ease;">
                                    <i class="fas fa-filter me-1"></i>Filtrer
                                </button>
                                <a href="{{ route('admin.bookmarks') }}" class="btn btn-secondary flex-fill" style="border-radius: 10px; font-weight: 600; background: linear-gradient(135deg, #6c757d 0%, #5a6268 100%); border: none; transition: all 0.3s ease;">
                                    <i class="fas fa-undo me-1"></i>Reset
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Liste des bookmarks -->
    <div class="row">
        <div class="col-12">
            <div class="card shadow-sm border-0" style="border-radius: 16px; background: linear-gradient(135deg, #fff 0%, #fafafa 100%);">
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead style="background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);">
                                <tr>
                                    <th class="border-0 px-4 py-3" style="color: #555; font-weight: 600; font-size: 0.9rem;">
                                        <i class="fas fa-user me-2" style="color: #6f42c1;"></i>Utilisateur
                                    </th>
                                    <th class="border-0 px-4 py-3" style="color: #555; font-weight: 600; font-size: 0.9rem;">
                                        <i class="fas fa-bookmark me-2" style="color: #6f42c1;"></i>Titre
                                    </th>
                                    <th class="border-0 px-4 py-3" style="color: #555; font-weight: 600; font-size: 0.9rem;">
                                        <i class="fas fa-link me-2" style="color: #6f42c1;"></i>URL
                                    </th>
                                    <th class="border-0 px-4 py-3" style="color: #555; font-weight: 600; font-size: 0.9rem;">
                                        <i class="fas fa-tags me-2" style="color: #6f42c1;"></i>Catégorie
                                    </th>
                                    <th class="border-0 px-4 py-3" style="color: #555; font-weight: 600; font-size: 0.9rem;">
                                        <i class="fas fa-star me-2" style="color: #6f42c1;"></i>Favori
                                    </th>
                                    <th class="border-0 px-4 py-3" style="color: #555; font-weight: 600; font-size: 0.9rem;">
                                        <i class="fas fa-calendar me-2" style="color: #6f42c1;"></i>Date
                                    </th>
                                    <th class="border-0 px-4 py-3" style="color: #555; font-weight: 600; font-size: 0.9rem;">
                                        <i class="fas fa-cogs me-2" style="color: #6f42c1;"></i>Actions
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($bookmarks as $bookmark)
                                    <tr style="transition: all 0.3s ease;">
                                        <td class="px-4 py-3">
                                            <div class="d-flex align-items-center">
                                                <div class="me-3">
                                                    <div class="rounded-circle d-flex align-items-center justify-content-center shadow-sm" style="width: 40px; height: 40px; background: linear-gradient(135deg, #6f42c1 0%, #5a2d91 100%);">
                                                        <span class="text-white fw-bold" style="font-size: 0.9rem;">{{ substr($bookmark->user->name, 0, 1) }}</span>
                                                    </div>
                                                </div>
                                                <div>
                                                    <div class="fw-semibold mb-1" style="color: #333;">{{ $bookmark->user->name }}</div>
                                                    <div class="text-muted mb-0" style="font-size: 0.8rem;">{{ $bookmark->user->email }}</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-4 py-3">
                                            <div class="fw-semibold mb-1" style="color: #333;">{{ $bookmark->title }}</div>
                                            @if($bookmark->description)
                                                <div class="text-muted mb-0" style="font-size: 0.8rem;">{{ Str::limit($bookmark->description, 50) }}</div>
                                            @endif
                                        </td>
                                        <td class="px-4 py-3">
                                            <a href="{{ $bookmark->url }}" target="_blank" class="text-decoration-none" style="color: #6f42c1; font-size: 0.85rem;">
                                                {{ Str::limit($bookmark->url, 40) }}
                                                <i class="fas fa-external-link-alt ms-1" style="font-size: 0.7rem;"></i>
                                            </a>
                                        </td>
                                        <td class="px-4 py-3">
                                            <span class="badge" style="background: linear-gradient(135deg, #007bff 0%, #0056b3 100%); color: white; padding: 6px 12px; border-radius: 20px; font-size: 0.75rem;">
                                                {{ ucfirst($bookmark->category) }}
                                            </span>
                                        </td>
                                        <td class="px-4 py-3">
                                            @if($bookmark->is_favorite)
                                                <span class="badge" style="background: linear-gradient(135deg, #ffc107 0%, #e0a800 100%); color: white; padding: 6px 12px; border-radius: 20px; font-size: 0.75rem;">
                                                    <i class="fas fa-star me-1"></i>Favori
                                                </span>
                                            @else
                                                <span class="text-muted" style="font-size: 0.8rem;">-</span>
                                            @endif
                                        </td>
                                        <td class="px-4 py-3">
                                            <div class="text-muted" style="font-size: 0.8rem;">{{ $bookmark->created_at->format('d/m/Y H:i') }}</div>
                                        </td>
                                        <td class="px-4 py-3">
                                            <div class="d-flex gap-2">
                                                <a href="{{ $bookmark->url }}" target="_blank" class="btn btn-sm btn-outline-primary" style="border-radius: 8px; padding: 4px 8px; font-size: 0.8rem;">
                                                    <i class="fas fa-external-link-alt"></i>
                                                </a>
                                                <button onclick="deleteBookmark({{ $bookmark->id }})" class="btn btn-sm btn-outline-danger" style="border-radius: 8px; padding: 4px 8px; font-size: 0.8rem;">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center py-5">
                                            <div class="text-muted">
                                                <i class="fas fa-bookmark" style="font-size: 3rem; margin-bottom: 1rem; opacity: 0.5;"></i>
                                                <p>Aucun bookmark trouvé</p>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Pagination -->
    <div class="row mt-4">
        <div class="col-12">
            <div class="d-flex justify-content-center">
                {{ $bookmarks->links() }}
            </div>
        </div>
    </div>
</div>

<script>
function deleteBookmark(bookmarkId) {
    if (confirm('Êtes-vous sûr de vouloir supprimer ce bookmark ?')) {
        fetch(`/bookmarks/${bookmarkId}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Content-Type': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                location.reload();
            } else {
                alert('Erreur lors de la suppression');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Erreur lors de la suppression');
        });
    }
}
</script>

<style>
/* Styles harmonisés avec le site principal */
.card {
    transition: all 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94);
}

.card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15) !important;
}

.btn {
    transition: all 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94);
}

.btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
}

.table tbody tr:hover {
    background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%) !important;
    transform: scale(1.01);
    transition: all 0.3s ease;
}

.form-control:focus, .form-select:focus {
    border-color: #6f42c1 !important;
    box-shadow: 0 0 0 0.2rem rgba(111, 66, 193, 0.25) !important;
}

.badge {
    transition: all 0.3s ease;
}

.badge:hover {
    transform: scale(1.05);
}
</style>
@endsection 