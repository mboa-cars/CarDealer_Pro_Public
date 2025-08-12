@extends('layouts.admin')

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
                                    <div class="rounded-circle d-flex align-items-center justify-center shadow-lg position-relative header-icon glow-effect" style="width: 80px; height: 80px; background: rgba(255, 255, 255, 0.2); backdrop-filter: blur(10px); border: 2px solid rgba(255, 255, 255, 0.3);">
                                        <i class="fas fa-tachometer-alt text-white" style="font-size: 2rem;"></i>
                                    </div>
                                    <!-- Effet de brillance -->
                                    <div class="position-absolute" style="top: 10px; left: 10px; width: 20px; height: 20px; background: rgba(255, 255, 255, 0.4); border-radius: 50%; filter: blur(5px);"></div>
                                </div>
                                <div>
                                    <h1 class="fw-bold mb-2 text-white" style="font-size: 3rem; text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);">
                                        Tableau de bord
                                    </h1>
                                    <p class="text-white mb-0" style="font-size: 1.2rem; opacity: 0.9; text-shadow: 0 1px 2px rgba(0, 0, 0, 0.2);">
                                        <i class="fas fa-user me-2"></i>Bienvenue <span class="fw-semibold">{{ Auth::user()->name }}</span>, 
                                        voici un aperçu complet de votre application.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="text-center header-stats">
                                <div class="d-flex justify-content-center mb-3">
                                    <div class="rounded-circle d-flex align-items-center justify-content-center me-3 header-icon" style="width: 50px; height: 50px; background: rgba(255, 255, 255, 0.2); backdrop-filter: blur(5px); border: 1px solid rgba(255, 255, 255, 0.3);">
                                        <i class="fas fa-users text-white"></i>
                                    </div>
                                    <div class="rounded-circle d-flex align-items-center justify-content-center me-3 header-icon" style="width: 50px; height: 50px; background: rgba(255, 255, 255, 0.2); backdrop-filter: blur(5px); border: 1px solid rgba(255, 255, 255, 0.3);">
                                        <i class="fas fa-car text-white"></i>
                                    </div>
                                    <div class="rounded-circle d-flex align-items-center justify-content-center header-icon" style="width: 50px; height: 50px; background: rgba(255, 255, 255, 0.2); backdrop-filter: blur(5px); border: 1px solid rgba(255, 255, 255, 0.3);">
                                        <i class="fas fa-chart-line text-white"></i>
                                    </div>
                                </div>
                                <div class="text-white">
                                    <div class="fw-bold mb-1" style="font-size: 1.5rem; text-shadow: 0 1px 2px rgba(0, 0, 0, 0.3);">
                                        {{ $stats['total_users'] + $stats['total_cars'] + $stats['published_cars'] }}
                                    </div>
                                    <div style="font-size: 0.9rem; opacity: 0.8;">Total d'activités</div>
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
                                <i class="fas fa-chart-line me-1"></i>Données en temps réel
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Statistiques principales -->
    <div class="row g-4 mb-4">
        <!-- Utilisateurs -->
        <div class="col-lg-3 col-md-6">
            <div class="card shadow-sm border-0 h-100" style="border-radius: 16px; background: linear-gradient(135deg, #fff 0%, #fafafa 100%); border-left: 4px solid #007bff; transition: all 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94);">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center">
                        <div class="me-3">
                            <div class="rounded-circle d-flex align-items-center justify-content-center shadow-lg" style="width: 50px; height: 50px; background: linear-gradient(135deg, #007bff 0%, #0056b3 100%);">
                                <i class="fas fa-users text-white"></i>
                            </div>
                        </div>
                        <div>
                            <p class="text-muted mb-1" style="font-size: 0.9rem; font-weight: 500;">Utilisateurs totaux</p>
                            <h3 class="fw-bold mb-1" style="color: #333; font-size: 2rem;">{{ $stats['total_users'] }}</h3>
                            <p class="text-muted mb-0" style="font-size: 0.8rem;">Inscrits sur la plateforme</p>
                        </div>
                    </div>
                    <div class="mt-3">
                        <div class="progress" style="height: 6px; border-radius: 3px; background-color: #e9ecef;">
                            <div class="progress-bar" style="background: linear-gradient(135deg, #007bff 0%, #0056b3 100%); width: {{ min(100, ($stats['total_users'] / 10) * 100) }}%; border-radius: 3px;"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Voitures -->
        <div class="col-lg-3 col-md-6">
            <div class="card shadow-sm border-0 h-100" style="border-radius: 16px; background: linear-gradient(135deg, #fff 0%, #fafafa 100%); border-left: 4px solid #28a745; transition: all 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94);">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center">
                        <div class="me-3">
                            <div class="rounded-circle d-flex align-items-center justify-content-center shadow-lg" style="width: 50px; height: 50px; background: linear-gradient(135deg, #28a745 0%, #1e7e34 100%);">
                                <i class="fas fa-car text-white"></i>
                            </div>
                        </div>
                        <div>
                            <p class="text-muted mb-1" style="font-size: 0.9rem; font-weight: 500;">Voitures totales</p>
                            <h3 class="fw-bold mb-1" style="color: #333; font-size: 2rem;">{{ $stats['total_cars'] }}</h3>
                            <p class="text-muted mb-0" style="font-size: 0.8rem;">Annonces créées</p>
                        </div>
                    </div>
                    <div class="mt-3">
                        <div class="progress" style="height: 6px; border-radius: 3px; background-color: #e9ecef;">
                            <div class="progress-bar" style="background: linear-gradient(135deg, #28a745 0%, #1e7e34 100%); width: {{ min(100, ($stats['total_cars'] / 10) * 100) }}%; border-radius: 3px;"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Voitures publiées -->
        <div class="col-lg-3 col-md-6">
            <div class="card shadow-sm border-0 h-100" style="border-radius: 16px; background: linear-gradient(135deg, #fff 0%, #fafafa 100%); border-left: 4px solid #F26522; transition: all 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94);">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center">
                        <div class="me-3">
                            <div class="rounded-circle d-flex align-items-center justify-content-center shadow-lg" style="width: 50px; height: 50px; background: linear-gradient(135deg, #F26522 0%, #ea6500 100%);">
                                <i class="fas fa-check-circle text-white"></i>
                            </div>
                        </div>
                        <div>
                            <p class="text-muted mb-1" style="font-size: 0.9rem; font-weight: 500;">Voitures publiées</p>
                            <h3 class="fw-bold mb-1" style="color: #333; font-size: 2rem;">{{ $stats['published_cars'] }}</h3>
                            <p class="text-muted mb-0" style="font-size: 0.8rem;">Visibles publiquement</p>
                        </div>
                    </div>
                    <div class="mt-3">
                        <div class="progress" style="height: 6px; border-radius: 3px; background-color: #e9ecef;">
                            <div class="progress-bar" style="background: linear-gradient(135deg, #F26522 0%, #ea6500 100%); width: {{ $stats['total_cars'] > 0 ? ($stats['published_cars'] / $stats['total_cars']) * 100 : 0 }}%; border-radius: 3px;"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Favoris -->
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
                            <p class="text-muted mb-1" style="font-size: 0.9rem; font-weight: 500;">Favoris totaux</p>
                            <h3 class="fw-bold mb-1" style="color: #333; font-size: 2rem;">{{ $stats['total_favorites'] }}</h3>
                            <p class="text-muted mb-0" style="font-size: 0.8rem;">Sauvegardés par les utilisateurs</p>
                        </div>
                    </div>
                    <div class="mt-3">
                        <div class="progress" style="height: 6px; border-radius: 3px; background-color: #e9ecef;">
                            <div class="progress-bar" style="background: linear-gradient(135deg, #dc3545 0%, #c82333 100%); width: {{ min(100, ($stats['total_favorites'] / 10) * 100) }}%; border-radius: 3px;"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Bookmarks -->
        <div class="col-lg-3 col-md-6">
            <div class="card shadow-sm border-0 h-100" style="border-radius: 16px; background: linear-gradient(135deg, #fff 0%, #fafafa 100%); border-left: 4px solid #6f42c1; transition: all 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94);">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center">
                        <div class="me-3">
                            <div class="rounded-circle d-flex align-items-center justify-content-center shadow-lg" style="width: 50px; height: 50px; background: linear-gradient(135deg, #6f42c1 0%, #5a2d91 100%);">
                                <i class="fas fa-bookmark text-white"></i>
                            </div>
                        </div>
                        <div>
                            <p class="text-muted mb-1" style="font-size: 0.9rem; font-weight: 500;">Bookmarks totaux</p>
                            <h3 class="fw-bold mb-1" style="color: #333; font-size: 2rem;">{{ $stats['total_bookmarks'] }}</h3>
                            <p class="text-muted mb-0" style="font-size: 0.8rem;">Pages sauvegardées</p>
                        </div>
                    </div>
                    <div class="mt-3">
                        <div class="progress" style="height: 6px; border-radius: 3px; background-color: #e9ecef;">
                            <div class="progress-bar" style="background: linear-gradient(135deg, #6f42c1 0%, #5a2d91 100%); width: {{ min(100, ($stats['total_bookmarks'] / 10) * 100) }}%; border-radius: 3px;"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Actions rapides -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card shadow-sm border-0" style="border-radius: 16px; background: linear-gradient(135deg, #fff 0%, #fafafa 100%);">
                <div class="card-body p-4">
                    <h4 class="fw-bold mb-4" style="color: #333; font-size: 1.5rem;">
                        <i class="fas fa-bolt me-2" style="color: #F26522;"></i>Actions rapides
                    </h4>
                    <div class="row g-4">
                        <div class="col-lg-3 col-md-6">
                            <a href="{{ route('admin.users') }}" class="card shadow-sm border-0 text-decoration-none h-100" style="border-radius: 12px; background: linear-gradient(135deg, #e3f2fd 0%, #bbdefb 100%); border-left: 4px solid #007bff; transition: all 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94);">
                                <div class="card-body p-4">
                                    <div class="d-flex align-items-center">
                                        <div class="me-3">
                                            <div class="rounded-circle d-flex align-items-center justify-content-center shadow-lg" style="width: 45px; height: 45px; background: linear-gradient(135deg, #007bff 0%, #0056b3 100%);">
                                                <i class="fas fa-users text-white"></i>
                                            </div>
                                        </div>
                                        <div>
                                            <h6 class="fw-bold mb-1" style="color: #333;">Gérer les utilisateurs</h6>
                                            <p class="text-muted mb-0" style="font-size: 0.85rem;">Voir, modifier et supprimer les comptes</p>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>

                        <div class="col-lg-3 col-md-6">
                            <a href="{{ route('admin.cars') }}" class="card shadow-sm border-0 text-decoration-none h-100" style="border-radius: 12px; background: linear-gradient(135deg, #e8f5e8 0%, #c8e6c9 100%); border-left: 4px solid #28a745; transition: all 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94);">
                                <div class="card-body p-4">
                                    <div class="d-flex align-items-center">
                                        <div class="me-3">
                                            <div class="rounded-circle d-flex align-items-center justify-content-center shadow-lg" style="width: 45px; height: 45px; background: linear-gradient(135deg, #28a745 0%, #1e7e34 100%);">
                                                <i class="fas fa-car text-white"></i>
                                            </div>
                                        </div>
                                        <div>
                                            <h6 class="fw-bold mb-1" style="color: #333;">Gérer les voitures</h6>
                                            <p class="text-muted mb-0" style="font-size: 0.85rem;">Publier, dépublier et supprimer les annonces</p>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>

                        <div class="col-lg-3 col-md-6">
                            <a href="{{ route('admin.statistics') }}" class="card shadow-sm border-0 text-decoration-none h-100" style="border-radius: 12px; background: linear-gradient(135deg, #f3e5f5 0%, #e1bee7 100%); border-left: 4px solid #6f42c1; transition: all 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94);">
                                <div class="card-body p-4">
                                    <div class="d-flex align-items-center">
                                        <div class="me-3">
                                            <div class="rounded-circle d-flex align-items-center justify-content-center shadow-lg" style="width: 45px; height: 45px; background: linear-gradient(135deg, #6f42c1 0%, #5a2d91 100%);">
                                                <i class="fas fa-chart-bar text-white"></i>
                                            </div>
                                        </div>
                                        <div>
                                            <h6 class="fw-bold mb-1" style="color: #333;">Statistiques détaillées</h6>
                                            <p class="text-muted mb-0" style="font-size: 0.85rem;">Analyses et graphiques avancés</p>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>

                        <div class="col-lg-3 col-md-6">
                            <a href="{{ route('cars.index') }}" class="card shadow-sm border-0 text-decoration-none h-100" style="border-radius: 12px; background: linear-gradient(135deg, #fff3e0 0%, #ffe0b2 100%); border-left: 4px solid #F26522; transition: all 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94);">
                                <div class="card-body p-4">
                                    <div class="d-flex align-items-center">
                                        <div class="me-3">
                                            <div class="rounded-circle d-flex align-items-center justify-content-center shadow-lg" style="width: 45px; height: 45px; background: linear-gradient(135deg, #F26522 0%, #ea6500 100%);">
                                                <i class="fas fa-eye text-white"></i>
                                            </div>
                                        </div>
                                        <div>
                                            <h6 class="fw-bold mb-1" style="color: #333;">Voir le site</h6>
                                            <p class="text-muted mb-0" style="font-size: 0.85rem;">Accéder à l'interface publique</p>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Activité récente -->
    <div class="row g-4 mb-4">
        <!-- Utilisateurs récents -->
        <div class="col-lg-6">
            <div class="card shadow-sm border-0 h-100" style="border-radius: 16px; background: linear-gradient(135deg, #fff 0%, #fafafa 100%);">
                <div class="card-body p-4">
                    <h5 class="fw-bold mb-4" style="color: #333; font-size: 1.3rem;">
                        <i class="fas fa-user-clock me-2" style="color: #007bff;"></i>Utilisateurs récents
                    </h5>
                    <div class="space-y-3">
                        @forelse($recent_users as $user)
                            <div class="d-flex align-items-center justify-content-between p-3 rounded" style="background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%); border-radius: 12px; transition: all 0.3s ease;">
                                <div class="d-flex align-items-center">
                                    <div class="me-3">
                                        <div class="rounded-circle d-flex align-items-center justify-content-center shadow-sm" style="width: 45px; height: 45px; background: linear-gradient(135deg, #007bff 0%, #0056b3 100%);">
                                            <span class="text-white fw-bold">{{ substr($user->name, 0, 1) }}</span>
                                        </div>
                                    </div>
                                    <div>
                                        <p class="fw-semibold mb-1" style="color: #333;">{{ $user->name }}</p>
                                        <p class="text-muted mb-1" style="font-size: 0.85rem;">{{ $user->email }}</p>
                                        <p class="text-muted mb-0" style="font-size: 0.75rem;">Inscrit le {{ $user->created_at->format('d/m/Y H:i') }}</p>
                                    </div>
                                </div>
                                <div>
                                    @if($user->isAdmin())
                                        <span class="badge" style="background: linear-gradient(135deg, #007bff 0%, #0056b3 100%); color: white; padding: 6px 12px; border-radius: 20px; font-size: 0.75rem;">
                                            Admin
                                        </span>
                                    @else
                                        <span class="badge" style="background: linear-gradient(135deg, #6c757d 0%, #495057 100%); color: white; padding: 6px 12px; border-radius: 20px; font-size: 0.75rem;">
                                            Utilisateur
                                        </span>
                                    @endif
                                </div>
                            </div>
                        @empty
                            <div class="text-center py-4">
                                <i class="fas fa-users text-muted" style="font-size: 3rem; margin-bottom: 1rem;"></i>
                                <p class="text-muted">Aucun utilisateur récent</p>
                            </div>
                        @endforelse
                    </div>
                    <div class="mt-4">
                        <a href="{{ route('admin.users') }}" class="btn btn-outline-primary" style="border-radius: 8px; font-weight: 600;">
                            Voir tous les utilisateurs <i class="fas fa-arrow-right ms-2"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Voitures récentes -->
        <div class="col-lg-6">
            <div class="card shadow-sm border-0 h-100" style="border-radius: 16px; background: linear-gradient(135deg, #fff 0%, #fafafa 100%);">
                <div class="card-body p-4">
                    <h5 class="fw-bold mb-4" style="color: #333; font-size: 1.3rem;">
                        <i class="fas fa-car me-2" style="color: #28a745;"></i>Voitures récentes
                    </h5>
                    <div class="space-y-3">
                        @forelse($recent_cars as $car)
                            <div class="d-flex align-items-center justify-content-between p-3 rounded" style="background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%); border-radius: 12px; transition: all 0.3s ease;">
                                <div class="d-flex align-items-center">
                                    <div class="me-3">
                                        <div class="rounded shadow-sm overflow-hidden" style="width: 45px; height: 45px; background: linear-gradient(135deg, #28a745 0%, #1e7e34 100%);">
                                            @if($car->main_image)
                                                <img src="{{ $car->main_image }}" alt="{{ $car->brand }} {{ $car->model }}" class="w-100 h-100" style="object-fit: cover;">
                                            @else
                                                <div class="d-flex align-items-center justify-content-center h-100">
                                                    <i class="fas fa-car text-white"></i>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    <div>
                                        <p class="fw-semibold mb-1" style="color: #333;">{{ $car->brand }} {{ $car->model }}</p>
                                        <p class="text-muted mb-1" style="font-size: 0.85rem;">{{ $car->year }} • {{ $car->formatted_price }}</p>
                                        <p class="text-muted mb-0" style="font-size: 0.75rem;">par {{ $car->user->name ?? 'Utilisateur supprimé' }}</p>
                                    </div>
                                </div>
                                <div>
                                    <span class="badge" style="background: {{ $car->is_published ? 'linear-gradient(135deg, #28a745 0%, #1e7e34 100%)' : 'linear-gradient(135deg, #dc3545 0%, #c82333 100%)' }}; color: white; padding: 6px 12px; border-radius: 20px; font-size: 0.75rem;">
                                        {{ $car->is_published ? 'Publiée' : 'Non publiée' }}
                                    </span>
                                </div>
                            </div>
                        @empty
                            <div class="text-center py-4">
                                <i class="fas fa-car text-muted" style="font-size: 3rem; margin-bottom: 1rem;"></i>
                                <p class="text-muted">Aucune voiture récente</p>
                            </div>
                        @endforelse
                    </div>
                    <div class="mt-4">
                        <a href="{{ route('admin.cars') }}" class="btn btn-outline-success" style="border-radius: 8px; font-weight: 600;">
                            Voir toutes les voitures <i class="fas fa-arrow-right ms-2"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Bookmarks récents -->
        <div class="col-lg-6">
            <div class="card shadow-sm border-0 h-100" style="border-radius: 16px; background: linear-gradient(135deg, #fff 0%, #fafafa 100%);">
                <div class="card-body p-4">
                    <h5 class="fw-bold mb-4" style="color: #333; font-size: 1.3rem;">
                        <i class="fas fa-bookmark me-2" style="color: #6f42c1;"></i>Bookmarks récents
                    </h5>
                    <div class="space-y-3">
                        @forelse($recent_bookmarks as $bookmark)
                            <div class="d-flex align-items-center justify-content-between p-3 rounded" style="background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%); border-radius: 12px; transition: all 0.3s ease;">
                                <div class="d-flex align-items-center">
                                    <div class="me-3">
                                        <div class="rounded shadow-sm overflow-hidden d-flex align-items-center justify-content-center" style="width: 45px; height: 45px; background: linear-gradient(135deg, #6f42c1 0%, #5a2d91 100%);">
                                            <i class="fas fa-bookmark text-white"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <p class="fw-semibold mb-1" style="color: #333;">{{ $bookmark->title }}</p>
                                        <p class="text-muted mb-1" style="font-size: 0.85rem;">{{ $bookmark->category }} • {{ $bookmark->created_at->diffForHumans() }}</p>
                                        <p class="text-muted mb-0" style="font-size: 0.75rem;">par {{ $bookmark->user->name ?? 'Utilisateur supprimé' }}</p>
                                    </div>
                                </div>
                                <div>
                                    @if($bookmark->is_favorite)
                                        <span class="badge" style="background: linear-gradient(135deg, #ffc107 0%, #e0a800 100%); color: white; padding: 6px 12px; border-radius: 20px; font-size: 0.75rem;">
                                            <i class="fas fa-star me-1"></i>Favori
                                        </span>
                                    @else
                                        <span class="badge" style="background: linear-gradient(135deg, #6c757d 0%, #5a6268 100%); color: white; padding: 6px 12px; border-radius: 20px; font-size: 0.75rem;">
                                            Normal
                                        </span>
                                    @endif
                                </div>
                            </div>
                        @empty
                            <div class="text-center py-4">
                                <i class="fas fa-bookmark text-muted" style="font-size: 3rem; margin-bottom: 1rem;"></i>
                                <p class="text-muted">Aucun bookmark récent</p>
                            </div>
                        @endforelse
                    </div>
                    <div class="mt-4">
                        <a href="{{ route('admin.bookmarks') }}" class="btn btn-outline-primary" style="border-radius: 8px; font-weight: 600;">
                            Voir tous les bookmarks <i class="fas fa-arrow-right ms-2"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Statistiques rapides -->
    <div class="row">
        <div class="col-12">
            <div class="card shadow-sm border-0" style="border-radius: 16px; background: linear-gradient(135deg, #fff 0%, #fafafa 100%);">
                <div class="card-body p-4">
                    <h5 class="fw-bold mb-4" style="color: #333; font-size: 1.3rem;">
                        <i class="fas fa-chart-pie me-2" style="color: #F26522;"></i>Statistiques rapides
                    </h5>
                    <div class="row g-4">
                        <div class="col-md-4 text-center">
                            <div class="rounded-circle d-flex align-items-center justify-content-center mx-auto mb-3 shadow-lg" style="width: 80px; height: 80px; background: linear-gradient(135deg, #007bff 0%, #0056b3 100%);">
                                <span class="text-white fw-bold" style="font-size: 1.5rem;">{{ $stats['total_cars'] > 0 ? round(($stats['published_cars'] / $stats['total_cars']) * 100) : 0 }}%</span>
                            </div>
                            <h6 class="fw-semibold mb-1" style="color: #333;">Taux de publication</h6>
                            <p class="text-muted mb-0" style="font-size: 0.85rem;">% de voitures publiées</p>
                        </div>
                        <div class="col-md-4 text-center">
                            <div class="rounded-circle d-flex align-items-center justify-content-center mx-auto mb-3 shadow-lg" style="width: 80px; height: 80px; background: linear-gradient(135deg, #28a745 0%, #1e7e34 100%);">
                                <span class="text-white fw-bold" style="font-size: 1.5rem;">{{ $stats['total_cars'] > 0 ? round($stats['total_favorites'] / $stats['total_cars'], 1) : 0 }}</span>
                            </div>
                            <h6 class="fw-semibold mb-1" style="color: #333;">Favoris par voiture</h6>
                            <p class="text-muted mb-0" style="font-size: 0.85rem;">Moyenne des favoris</p>
                        </div>
                        <div class="col-md-4 text-center">
                            <div class="rounded-circle d-flex align-items-center justify-content-center mx-auto mb-3 shadow-lg" style="width: 80px; height: 80px; background: linear-gradient(135deg, #F26522 0%, #ea6500 100%);">
                                <span class="text-white fw-bold" style="font-size: 1.5rem;">{{ $stats['total_users'] > 0 ? round($stats['total_cars'] / $stats['total_users'], 1) : 0 }}</span>
                            </div>
                            <h6 class="fw-semibold mb-1" style="color: #333;">Voitures par utilisateur</h6>
                            <p class="text-muted mb-0" style="font-size: 0.85rem;">Moyenne par compte</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

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

/* Animations d'apparition */
@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(30px);
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

/* Progress bars animées */
.progress-bar {
    transition: width 1s ease-in-out;
}

/* Badges avec gradients */
.badge {
    font-weight: 600;
    letter-spacing: 0.5px;
}

/* Espacement cohérent */
.space-y-3 > * + * {
    margin-top: 1rem;
}

/* Responsive design */
@media (max-width: 768px) {
    .card-body {
        padding: 1.5rem !important;
    }
    
    h1 {
        font-size: 2rem !important;
    }
    
    h3 {
        font-size: 1.5rem !important;
    }
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
    // Animation des progress bars
    const progressBars = document.querySelectorAll('.progress-bar');
    progressBars.forEach(bar => {
        const width = bar.style.width;
        bar.style.width = '0%';
        setTimeout(() => {
            bar.style.width = width;
        }, 500);
    });
    
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
});
</script>
@endsection 