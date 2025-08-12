@extends('layouts.admin')

@section('content')
<div class="container-fluid py-4" style="background: linear-gradient(135deg, #f8f9fa 0%, #ffffff 100%); min-height: 100vh;">
    
    <!-- Header avec titre amélioré -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="position-relative overflow-hidden" style="border-radius: 20px; background: linear-gradient(135deg, #007bff 0%, #0056b3 50%, #004085 100%); box-shadow: 0 15px 35px rgba(0, 123, 255, 0.3);">
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
                                        <i class="fas fa-users text-white" style="font-size: 2rem;"></i>
                                    </div>
                                    <!-- Effet de brillance -->
                                    <div class="position-absolute" style="top: 10px; left: 10px; width: 20px; height: 20px; background: rgba(255, 255, 255, 0.4); border-radius: 50%; filter: blur(5px);"></div>
                                </div>
                                <div>
                                    <h1 class="fw-bold mb-2 text-white" style="font-size: 3rem; text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);">
                                        Gestion des utilisateurs
                                    </h1>
                                    <p class="text-white mb-0" style="font-size: 1.2rem; opacity: 0.9; text-shadow: 0 1px 2px rgba(0, 0, 0, 0.2);">
                                        <i class="fas fa-shield-alt me-2"></i>Gérez tous les utilisateurs de votre plateforme et leurs droits d'administration
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="text-center header-stats">
                                <div class="d-flex justify-content-center mb-3">
                                    <div class="rounded-circle d-flex align-items-center justify-content-center me-3 header-icon" style="width: 50px; height: 50px; background: rgba(255, 255, 255, 0.2); backdrop-filter: blur(5px); border: 1px solid rgba(255, 255, 255, 0.3);">
                                        <i class="fas fa-user-check text-white"></i>
                                    </div>
                                    <div class="rounded-circle d-flex align-items-center justify-content-center me-3 header-icon" style="width: 50px; height: 50px; background: rgba(255, 255, 255, 0.2); backdrop-filter: blur(5px); border: 1px solid rgba(255, 255, 255, 0.3);">
                                        <i class="fas fa-user-shield text-white"></i>
                                    </div>
                                    <div class="rounded-circle d-flex align-items-center justify-content-center header-icon" style="width: 50px; height: 50px; background: rgba(255, 255, 255, 0.2); backdrop-filter: blur(5px); border: 1px solid rgba(255, 255, 255, 0.3);">
                                        <i class="fas fa-user-cog text-white"></i>
                                    </div>
                                </div>
                                <div class="text-white">
                                    <div class="fw-bold mb-1" style="font-size: 1.5rem; text-shadow: 0 1px 2px rgba(0, 0, 0, 0.3);">
                                        {{ $users->total() }}
                                    </div>
                                    <div style="font-size: 0.9rem; opacity: 0.8;">Utilisateurs au total</div>
                                    <div class="mt-2 d-flex justify-content-center gap-3">
                                        <span class="badge bg-light text-dark">Standard: {{ $planStats['standard'] ?? 0 }}</span>
                                        <span class="badge bg-warning text-dark">Premium: {{ $planStats['premium'] ?? 0 }}</span>
                                    </div>
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

    <!-- Tableau des utilisateurs -->
    <div class="row">
        <div class="col-12">
            <div class="card shadow-sm border-0" style="border-radius: 16px; background: linear-gradient(135deg, #fff 0%, #fafafa 100%);">
                <div class="card-body p-0">
                    <div class="p-3">
                        <form method="GET" class="row g-3">
                            <div class="col-md-4">
                                <input type="text" name="search" value="{{ request('search') }}" class="form-control" placeholder="Rechercher (nom, email, téléphone)">
                            </div>
                            <div class="col-md-3">
                                <select name="status" class="form-select">
                                    <option value="">Tous les statuts</option>
                                    <option value="admin" {{ request('status')==='admin' ? 'selected' : '' }}>Administrateurs</option>
                                    <option value="user" {{ request('status')==='user' ? 'selected' : '' }}>Utilisateurs</option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <select name="plan" class="form-select">
                                    <option value="">Tous les plans</option>
                                    <option value="standard" {{ request('plan')==='standard' ? 'selected' : '' }}>Standard</option>
                                    <option value="premium" {{ request('plan')==='premium' ? 'selected' : '' }}>Premium</option>
                                </select>
                            </div>
                            <div class="col-md-2 d-flex gap-2">
                                <button class="btn btn-primary flex-fill">Filtrer</button>
                                <a href="{{ route('admin.users') }}" class="btn btn-secondary flex-fill">Réinitialiser</a>
                            </div>
                        </form>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead style="background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);">
                                <tr>
                                    <th class="border-0 px-4 py-3" style="color: #555; font-weight: 600; font-size: 0.9rem;">
                                        <i class="fas fa-user me-2" style="color: #F26522;"></i>Utilisateur
                                    </th>
                                    <th class="border-0 px-4 py-3" style="color: #555; font-weight: 600; font-size: 0.9rem;">
                                        <i class="fas fa-envelope me-2" style="color: #F26522;"></i>Contact
                                    </th>
                                    <th class="border-0 px-4 py-3" style="color: #555; font-weight: 600; font-size: 0.9rem;">
                                        <i class="fas fa-crown me-2" style="color: #F26522;"></i>Plan
                                    </th>
                                    <th class="border-0 px-4 py-3" style="color: #555; font-weight: 600; font-size: 0.9rem;">
                                        <i class="fas fa-chart-line me-2" style="color: #F26522;"></i>Activité
                                    </th>
                                    <th class="border-0 px-4 py-3" style="color: #555; font-weight: 600; font-size: 0.9rem;">
                                        <i class="fas fa-shield-alt me-2" style="color: #F26522;"></i>Statut
                                    </th>
                                    <th class="border-0 px-4 py-3" style="color: #555; font-weight: 600; font-size: 0.9rem;">
                                        <i class="fas fa-calendar me-2" style="color: #F26522;"></i>Inscrit le
                                    </th>
                                    <th class="border-0 px-4 py-3" style="color: #555; font-weight: 600; font-size: 0.9rem;">
                                        <i class="fas fa-cogs me-2" style="color: #F26522;"></i>Actions
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($users as $user)
                                    <tr style="transition: all 0.3s ease; border-bottom: 1px solid #f0f0f0;">
                                        <td class="px-4 py-3">
                                            <div class="d-flex align-items-center">
                                                <div class="me-3">
                                                    <div class="rounded-circle d-flex align-items-center justify-content-center shadow-sm" style="width: 45px; height: 45px; background: linear-gradient(135deg, #007bff 0%, #0056b3 100%);">
                                                        <span class="text-white fw-bold">{{ substr($user->name, 0, 1) }}</span>
                                                    </div>
                                                </div>
                                                <div>
                                                    <p class="fw-semibold mb-1" style="color: #333;">{{ $user->name }}</p>
                                                    <p class="text-muted mb-0" style="font-size: 0.85rem;">ID: {{ $user->id }}</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-4 py-3">
                                            <p class="fw-semibold mb-1" style="color: #333;">{{ $user->email }}</p>
                                            <p class="text-muted mb-0" style="font-size: 0.85rem;">{{ $user->phone ?? 'Téléphone non renseigné' }}</p>
                                        </td>
                                        <td class="px-4 py-3">
                                            @if(($user->plan ?? 'standard') === 'premium')
                                                <span class="badge" style="background: linear-gradient(135deg, #ffc107 0%, #fd7e14 100%); color: #212529; padding: 8px 12px; border-radius: 20px; font-size: 0.8rem; font-weight: 600;">
                                                    <i class="fas fa-crown me-1"></i>Premium
                                                </span>
                                            @else
                                                <span class="badge" style="background: linear-gradient(135deg, #e9ecef 0%, #ced4da 100%); color: #212529; padding: 8px 12px; border-radius: 20px; font-size: 0.8rem; font-weight: 600;">
                                                    Standard
                                                </span>
                                            @endif
                                        </td>
                                        <td class="px-4 py-3">
                                            <div class="d-flex align-items-center">
                                                <div class="text-center me-4">
                                                    <div class="fw-bold mb-1" style="color: #007bff; font-size: 1.2rem;">{{ $user->cars_count }}</div>
                                                    <div class="text-muted" style="font-size: 0.8rem;">Voitures</div>
                                                </div>
                                                <div class="text-center">
                                                    <div class="fw-bold mb-1" style="color: #dc3545; font-size: 1.2rem;">{{ $user->favorites_count }}</div>
                                                    <div class="text-muted" style="font-size: 0.8rem;">Favoris</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-4 py-3">
                                            @if($user->isAdmin())
                                                <span class="badge" style="background: linear-gradient(135deg, #007bff 0%, #0056b3 100%); color: white; padding: 8px 12px; border-radius: 20px; font-size: 0.8rem; font-weight: 600;">
                                                    <i class="fas fa-check-circle me-1"></i>Administrateur
                                                </span>
                                            @else
                                                <span class="badge" style="background: linear-gradient(135deg, #6c757d 0%, #495057 100%); color: white; padding: 8px 12px; border-radius: 20px; font-size: 0.8rem; font-weight: 600;">
                                                    <i class="fas fa-user me-1"></i>Utilisateur
                                                </span>
                                            @endif
                                        </td>
                                        <td class="px-4 py-3">
                                            <p class="fw-semibold mb-1" style="color: #333; font-size: 0.9rem;">{{ $user->created_at->format('d/m/Y') }}</p>
                                            <p class="text-muted mb-0" style="font-size: 0.8rem;">{{ $user->created_at->format('H:i') }}</p>
                                        </td>
                                        <td class="px-4 py-3">
                                            <div class="d-flex align-items-center">
                                                <!-- Toggle Admin -->
                                                <form method="POST" action="{{ route('admin.users.toggle-admin', $user) }}" class="me-2">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit" class="btn btn-sm {{ $user->isAdmin() ? 'btn-outline-danger' : 'btn-outline-primary' }}" style="border-radius: 8px; font-weight: 600; padding: 6px 12px; font-size: 0.8rem; transition: all 0.3s ease;">
                                                        @if($user->isAdmin())
                                                            <i class="fas fa-user-minus me-1"></i>Retirer Admin
                                                        @else
                                                            <i class="fas fa-user-plus me-1"></i>Rendre Admin
                                                        @endif
                                                    </button>
                                                </form>
                                                
                                                <!-- Supprimer -->
                                                @if($user->id !== auth()->id())
                                                    <form method="POST" action="{{ route('admin.users.delete', $user) }}" class="me-2" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cet utilisateur ?')">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-outline-danger" style="border-radius: 8px; font-weight: 600; padding: 6px 12px; font-size: 0.8rem; transition: all 0.3s ease;">
                                                            <i class="fas fa-trash me-1"></i>Supprimer
                                                        </button>
                                                    </form>
                                                @else
                                                    <span class="badge" style="background: linear-gradient(135deg, #F26522 0%, #ea6500 100%); color: white; padding: 8px 12px; border-radius: 20px; font-size: 0.8rem; font-weight: 600;">
                                                        <i class="fas fa-user-check me-1"></i>Vous
                                                    </span>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center py-5">
                                            <div class="d-flex flex-column align-items-center">
                                                <i class="fas fa-users text-muted mb-3" style="font-size: 3rem;"></i>
                                                <p class="text-muted mb-0">Aucun utilisateur trouvé</p>
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
    @if($users->hasPages())
        <div class="row mt-4">
            <div class="col-12">
                <div class="d-flex justify-content-center">
                    <nav aria-label="Pagination des utilisateurs">
                        {{ $users->links() }}
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
});
</script>
@endsection 