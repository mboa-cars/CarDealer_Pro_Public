@extends('layouts.admin')

@section('content')
<div class="container-fluid py-4" style="background: linear-gradient(135deg, #f8f9fa 0%, #ffffff 100%); min-height: 100vh;">
    
    <!-- Header avec titre amélioré -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="position-relative overflow-hidden" style="border-radius: 20px; background: linear-gradient(135deg, #28a745 0%, #1e7e34 50%, #155724 100%); box-shadow: 0 15px 35px rgba(40, 167, 69, 0.3);">
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
                                        <i class="fas fa-car text-white" style="font-size: 2rem;"></i>
                                    </div>
                                    <!-- Effet de brillance -->
                                    <div class="position-absolute" style="top: 10px; left: 10px; width: 20px; height: 20px; background: rgba(255, 255, 255, 0.4); border-radius: 50%; filter: blur(5px);"></div>
                                </div>
                                <div>
                                    <h1 class="fw-bold mb-2 text-white" style="font-size: 3rem; text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);">
                                        Gestion des Voitures
                                    </h1>
                                    <p class="text-white mb-0" style="font-size: 1.2rem; opacity: 0.9; text-shadow: 0 1px 2px rgba(0, 0, 0, 0.2);">
                                        <i class="fas fa-cogs me-2"></i>Gérez toutes les voitures du site
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="text-center header-stats">
                                <div class="d-flex justify-content-center mb-3">
                                    <div class="rounded-circle d-flex align-items-center justify-content-center me-3 header-icon" style="width: 50px; height: 50px; background: rgba(255, 255, 255, 0.2); backdrop-filter: blur(5px); border: 1px solid rgba(255, 255, 255, 0.3);">
                                        <i class="fas fa-check-circle text-white"></i>
                                    </div>
                                    <div class="rounded-circle d-flex align-items-center justify-content-center me-3 header-icon" style="width: 50px; height: 50px; background: rgba(255, 255, 255, 0.2); backdrop-filter: blur(5px); border: 1px solid rgba(255, 255, 255, 0.3);">
                                        <i class="fas fa-clock text-white"></i>
                                    </div>
                                    <div class="rounded-circle d-flex align-items-center justify-content-center header-icon" style="width: 50px; height: 50px; background: rgba(255, 255, 255, 0.2); backdrop-filter: blur(5px); border: 1px solid rgba(255, 255, 255, 0.3);">
                                        <i class="fas fa-heart text-white"></i>
                                    </div>
                                </div>
                                <div class="text-white">
                                    <div class="fw-bold mb-1" style="font-size: 1.5rem; text-shadow: 0 1px 2px rgba(0, 0, 0, 0.3);">
                                        {{ $cars->total() }}
                                    </div>
                                    <div style="font-size: 0.9rem; opacity: 0.8;">Voitures au total</div>
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
                                <i class="fas fa-chart-line me-1"></i>Gestion en temps réel
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
            <div class="card shadow-sm border-0 h-100" style="border-radius: 16px; background: linear-gradient(135deg, #fff 0%, #fafafa 100%); border-left: 4px solid #007bff; transition: all 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94);">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center">
                        <div class="me-3">
                            <div class="rounded-circle d-flex align-items-center justify-content-center shadow-lg" style="width: 50px; height: 50px; background: linear-gradient(135deg, #007bff 0%, #0056b3 100%);">
                                <i class="fas fa-car text-white"></i>
                            </div>
                        </div>
                        <div>
                            <p class="text-muted mb-1" style="font-size: 0.9rem; font-weight: 500;">Total Voitures</p>
                            <h3 class="fw-bold mb-1" style="color: #333; font-size: 2rem;">{{ $cars->total() }}</h3>
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
                                <i class="fas fa-check-circle text-white"></i>
                            </div>
                        </div>
                        <div>
                            <p class="text-muted mb-1" style="font-size: 0.9rem; font-weight: 500;">Publiées</p>
                            <h3 class="fw-bold mb-1" style="color: #333; font-size: 2rem;">{{ $cars->where('is_published', true)->count() }}</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6">
            <div class="card shadow-sm border-0 h-100" style="border-radius: 16px; background: linear-gradient(135deg, #fff 0%, #fafafa 100%); border-left: 4px solid #ffc107; transition: all 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94);">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center">
                        <div class="me-3">
                            <div class="rounded-circle d-flex align-items-center justify-content-center shadow-lg" style="width: 50px; height: 50px; background: linear-gradient(135deg, #ffc107 0%, #e0a800 100%);">
                                <i class="fas fa-clock text-white"></i>
                            </div>
                        </div>
                        <div>
                            <p class="text-muted mb-1" style="font-size: 0.9rem; font-weight: 500;">En attente</p>
                            <h3 class="fw-bold mb-1" style="color: #333; font-size: 2rem;">{{ $cars->where('is_published', false)->count() }}</h3>
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
                            <h3 class="fw-bold mb-1" style="color: #333; font-size: 2rem;">{{ \App\Models\Favorite::count() }}</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Liste des voitures -->
    <div class="row">
        <div class="col-12">
            <div class="card shadow-sm border-0" style="border-radius: 16px; background: linear-gradient(135deg, #fff 0%, #fafafa 100%);">
                <div class="card-header border-0 bg-transparent" style="padding: 1.5rem 1.5rem 0;">
                    <h5 class="mb-0 fw-bold" style="color: #333; font-size: 1.3rem;">
                        <i class="fas fa-list me-2" style="color: #F26522;"></i>Liste des Voitures
                    </h5>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead style="background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);">
                                <tr>
                                    <th class="border-0 px-4 py-3" style="color: #555; font-weight: 600; font-size: 0.9rem;">
                                        <i class="fas fa-car me-2" style="color: #F26522;"></i>Voiture
                                    </th>
                                    <th class="border-0 px-4 py-3" style="color: #555; font-weight: 600; font-size: 0.9rem;">
                                        <i class="fas fa-user me-2" style="color: #F26522;"></i>Propriétaire
                                    </th>
                                    <th class="border-0 px-4 py-3" style="color: #555; font-weight: 600; font-size: 0.9rem;">
                                        <i class="fas fa-tag me-2" style="color: #F26522;"></i>Prix
                                    </th>
                                    <th class="border-0 px-4 py-3" style="color: #555; font-weight: 600; font-size: 0.9rem;">
                                        <i class="fas fa-shield-alt me-2" style="color: #F26522;"></i>Statut
                                    </th>
                                    <th class="border-0 px-4 py-3" style="color: #555; font-weight: 600; font-size: 0.9rem;">
                                        <i class="fas fa-heart me-2" style="color: #F26522;"></i>Favoris
                                    </th>
                                    <th class="border-0 px-4 py-3" style="color: #555; font-weight: 600; font-size: 0.9rem;">
                                        <i class="fas fa-cogs me-2" style="color: #F26522;"></i>Actions
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($cars as $car)
                                <tr style="transition: all 0.3s ease; border-bottom: 1px solid #f0f0f0;">
                                    <td class="px-4 py-3">
                                        <div class="d-flex align-items-center">
                                            <div class="me-3">
                                                @if($car->main_image)
                                                    <img src="{{ $car->main_image }}" alt="{{ $car->title }}" class="rounded shadow-sm" style="width: 50px; height: 50px; object-fit: cover;">
                                                @else
                                                    <div class="rounded d-flex align-items-center justify-content-center shadow-sm" style="width: 50px; height: 50px; background: linear-gradient(135deg, #e9ecef 0%, #dee2e6 100%);">
                                                        <i class="fas fa-car text-muted"></i>
                                                    </div>
                                                @endif
                                            </div>
                                            <div>
                                                <p class="fw-semibold mb-1" style="color: #333;">{{ $car->title }}</p>
                                                <p class="text-muted mb-0" style="font-size: 0.85rem;">{{ $car->brand }} {{ $car->model }} ({{ $car->year }})</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-4 py-3">
                                        <p class="fw-semibold mb-1" style="color: #333;">{{ $car->user->name }}</p>
                                        <p class="text-muted mb-0" style="font-size: 0.85rem;">{{ $car->user->email }}</p>
                                    </td>
                                    <td class="px-4 py-3">
                                        <p class="fw-bold mb-0" style="color: #28a745; font-size: 1.1rem;">{{ $car->formatted_price }}</p>
                                    </td>
                                    <td class="px-4 py-3">
                                        @if($car->is_published)
                                            <span class="badge" style="background: linear-gradient(135deg, #28a745 0%, #1e7e34 100%); color: white; padding: 8px 12px; border-radius: 20px; font-size: 0.8rem; font-weight: 600;">
                                                <i class="fas fa-check-circle me-1"></i>Publiée
                                            </span>
                                        @else
                                            <span class="badge" style="background: linear-gradient(135deg, #ffc107 0%, #e0a800 100%); color: white; padding: 8px 12px; border-radius: 20px; font-size: 0.8rem; font-weight: 600;">
                                                <i class="fas fa-clock me-1"></i>En attente
                                            </span>
                                        @endif
                                    </td>
                                    <td class="px-4 py-3">
                                        <div class="d-flex align-items-center">
                                            <i class="fas fa-heart me-2" style="color: #dc3545;"></i>
                                            <span class="fw-bold" style="color: #333;">{{ $car->favorites_count ?? 0 }}</span>
                                        </div>
                                    </td>
                                    <td class="px-4 py-3">
                                        <div class="d-flex align-items-center">
                                            <a href="{{ route('cars.show', $car) }}" class="btn btn-sm btn-outline-primary me-2" style="border-radius: 8px; font-weight: 600; padding: 6px 12px; font-size: 0.8rem; transition: all 0.3s ease;" title="Voir">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            
                                            <form method="POST" action="{{ route('admin.cars.toggle-publish', $car) }}" class="me-2">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit" class="btn btn-sm btn-outline-warning" style="border-radius: 8px; font-weight: 600; padding: 6px 12px; font-size: 0.8rem; transition: all 0.3s ease;" title="{{ $car->is_published ? 'Dépublier' : 'Publier' }}">
                                                    <i class="fas fa-{{ $car->is_published ? 'eye-slash' : 'eye' }}"></i>
                                                </button>
                                            </form>
                                            
                                            <form method="POST" action="{{ route('admin.cars.delete', $car) }}" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette voiture ?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-outline-danger" style="border-radius: 8px; font-weight: 600; padding: 6px 12px; font-size: 0.8rem; transition: all 0.3s ease;" title="Supprimer">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="6" class="text-center py-5">
                                        <div class="d-flex flex-column align-items-center">
                                            <i class="fas fa-car text-muted mb-3" style="font-size: 3rem;"></i>
                                            <p class="text-muted mb-0">Aucune voiture trouvée</p>
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
    @if($cars->hasPages())
        <div class="row mt-4">
            <div class="col-12">
                <div class="d-flex justify-content-center">
                    <nav aria-label="Pagination des voitures">
                        {{ $cars->links() }}
                    </nav>
                </div>
            </div>
        </div>
    @endif
</div>

<style>
/* Styles harmonisés avec le site principal */
.card {
    transition: all 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94);
}

.card:hover {
    transform: translateY(-2px);
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15) !important;
}

.table tbody tr {
    transition: all 0.3s ease;
}

.table tbody tr:hover {
    background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%) !important;
    transform: scale(1.01);
}

.btn {
    transition: all 0.3s ease;
}

.btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
}

.badge {
    transition: all 0.3s ease;
}

.badge:hover {
    transform: scale(1.05);
}

/* Animations d'apparition */
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

.card {
    animation: fadeInUp 0.6s ease-out forwards;
}

.card:nth-child(1) { animation-delay: 0.1s; }
.card:nth-child(2) { animation-delay: 0.2s; }
.card:nth-child(3) { animation-delay: 0.3s; }
.card:nth-child(4) { animation-delay: 0.4s; }

/* Responsive design */
@media (max-width: 768px) {
    .table-responsive {
        font-size: 0.9rem;
    }
    
    .btn-sm {
        padding: 4px 8px !important;
        font-size: 0.75rem !important;
    }
    
    .badge {
        padding: 6px 10px !important;
        font-size: 0.75rem !important;
    }
    
    .card-body {
        padding: 1rem !important;
    }
}

/* Pagination personnalisée */
.pagination .page-link {
    border-radius: 8px;
    margin: 0 2px;
    border: none;
    color: #666;
    font-weight: 600;
    transition: all 0.3s ease;
}

.pagination .page-link:hover {
    background: linear-gradient(135deg, #F26522 0%, #ea6500 100%);
    color: white;
    transform: translateY(-2px);
}

.pagination .page-item.active .page-link {
    background: linear-gradient(135deg, #F26522 0%, #ea6500 100%);
    border-color: #F26522;
    color: white;
}

.pagination .page-item.disabled .page-link {
    color: #ccc;
    background: #f8f9fa;
}

/* Images des voitures */
.table img {
    transition: all 0.3s ease;
}

.table img:hover {
    transform: scale(1.1);
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
}

/* Animations pour l'en-tête amélioré */
@keyframes float {
    0%, 100% { transform: translateY(0px); }
    50% { transform: translateY(-10px); }
}

@keyframes pulse {
    0%, 100% { opacity: 0.5; }
    50% { opacity: 1; }
}

@keyframes slideInFromLeft {
    from {
        opacity: 0;
        transform: translateX(-50px);
    }
    to {
        opacity: 1;
        transform: translateX(0);
    }
}

@keyframes slideInFromRight {
    from {
        opacity: 0;
        transform: translateX(50px);
    }
    to {
        opacity: 1;
        transform: translateX(0);
    }
}

/* Effets pour l'en-tête */
.header-main {
    animation: slideInFromLeft 1s ease-out;
}

.header-stats {
    animation: slideInFromRight 1s ease-out 0.3s both;
}

.header-icon {
    animation: float 3s ease-in-out infinite;
}

.header-progress {
    animation: slideInFromLeft 1s ease-out 0.6s both;
}

/* Effets de brillance */
.glow-effect {
    position: relative;
    overflow: hidden;
}

.glow-effect::before {
    content: '';
    position: absolute;
    top: -50%;
    left: -50%;
    width: 200%;
    height: 200%;
    background: linear-gradient(45deg, transparent, rgba(255, 255, 255, 0.1), transparent);
    transform: rotate(45deg);
    animation: pulse 2s ease-in-out infinite;
}

/* Responsive pour l'en-tête */
@media (max-width: 768px) {
    .header-main h1 {
        font-size: 2rem !important;
    }
    
    .header-main p {
        font-size: 1rem !important;
    }
    
    .header-icon {
        width: 60px !important;
        height: 60px !important;
    }
}
</style>

<script>
// Animation des statistiques au chargement
document.addEventListener('DOMContentLoaded', function() {
    // Animation des cartes au survol
    const cards = document.querySelectorAll('.card');
    cards.forEach(card => {
        card.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-5px)';
        });
        
        card.addEventListener('mouseleave', function() {
            this.style.transform = 'translateY(0)';
        });
    });
    
    // Animation des boutons
    const buttons = document.querySelectorAll('.btn');
    buttons.forEach(button => {
        button.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-2px)';
        });
        
        button.addEventListener('mouseleave', function() {
            this.style.transform = 'translateY(0)';
        });
    });
    
    // Animation des badges
    const badges = document.querySelectorAll('.badge');
    badges.forEach(badge => {
        badge.addEventListener('mouseenter', function() {
            this.style.transform = 'scale(1.05)';
        });
        
        badge.addEventListener('mouseleave', function() {
            this.style.transform = 'scale(1)';
        });
    });
    
    // Animation des images
    const images = document.querySelectorAll('.table img');
    images.forEach(img => {
        img.addEventListener('mouseenter', function() {
            this.style.transform = 'scale(1.1)';
        });
        
        img.addEventListener('mouseleave', function() {
            this.style.transform = 'scale(1)';
        });
    });
});
</script>
@endsection 