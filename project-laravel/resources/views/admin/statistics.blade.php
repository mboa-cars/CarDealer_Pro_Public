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
                                        <i class="fas fa-chart-line text-white" style="font-size: 2rem;"></i>
                                    </div>
                                    <!-- Effet de brillance -->
                                    <div class="position-absolute" style="top: 10px; left: 10px; width: 20px; height: 20px; background: rgba(255, 255, 255, 0.4); border-radius: 50%; filter: blur(5px);"></div>
                                </div>
                                <div>
                                    <h1 class="fw-bold mb-2 text-white" style="font-size: 3rem; text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);">
                                        Statistiques détaillées
                                    </h1>
                                    <p class="text-white mb-0" style="font-size: 1.2rem; opacity: 0.9; text-shadow: 0 1px 2px rgba(0, 0, 0, 0.2);">
                                        <i class="fas fa-chart-pie me-2"></i>Analyses complètes avec diagrammes interactifs
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="text-center header-stats">
                                <div class="d-flex justify-content-center mb-3">
                                    <div class="rounded-circle d-flex align-items-center justify-center me-3 header-icon" style="width: 50px; height: 50px; background: rgba(255, 255, 255, 0.2); backdrop-filter: blur(5px); border: 1px solid rgba(255, 255, 255, 0.3);">
                                        <i class="fas fa-users text-white"></i>
                                    </div>
                                    <div class="rounded-circle d-flex align-items-center justify-center me-3 header-icon" style="width: 50px; height: 50px; background: rgba(255, 255, 255, 0.2); backdrop-filter: blur(5px); border: 1px solid rgba(255, 255, 255, 0.3);">
                                        <i class="fas fa-car text-white"></i>
                                    </div>
                                    <div class="rounded-circle d-flex align-items-center justify-center header-icon" style="width: 50px; height: 50px; background: rgba(255, 255, 255, 0.2); backdrop-filter: blur(5px); border: 1px solid rgba(255, 255, 255, 0.3);">
                                        <i class="fas fa-heart text-white"></i>
                                    </div>
                                </div>
                                <div class="text-white">
                                    <div class="fw-bold mb-1" style="font-size: 1.5rem; text-shadow: 0 1px 2px rgba(0, 0, 0, 0.3);">
                                        {{ $generalStats['total_users'] + $generalStats['total_cars'] + $generalStats['total_favorites'] }}
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

    <!-- Statistiques générales -->
    <div class="row g-4 mb-4">
        <div class="col-lg-3 col-md-6">
            <div class="card shadow-sm border-0 h-100" style="border-radius: 16px; background: linear-gradient(135deg, #fff 0%, #fafafa 100%); border-left: 4px solid #007bff; transition: all 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94);">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center">
                        <div class="me-3">
                            <div class="rounded-circle d-flex align-items-center justify-center shadow-lg" style="width: 50px; height: 50px; background: linear-gradient(135deg, #007bff 0%, #0056b3 100%);">
                                <i class="fas fa-users text-white"></i>
                            </div>
                        </div>
                        <div>
                            <p class="text-muted mb-1" style="font-size: 0.9rem; font-weight: 500;">Utilisateurs actifs</p>
                            <h3 class="fw-bold mb-1" style="color: #333; font-size: 2rem;">{{ $generalStats['total_users'] }}</h3>
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
                            <div class="rounded-circle d-flex align-items-center justify-center shadow-lg" style="width: 50px; height: 50px; background: linear-gradient(135deg, #28a745 0%, #1e7e34 100%);">
                                <i class="fas fa-car text-white"></i>
                            </div>
                        </div>
                        <div>
                            <p class="text-muted mb-1" style="font-size: 0.9rem; font-weight: 500;">Voitures publiées</p>
                            <h3 class="fw-bold mb-1" style="color: #333; font-size: 2rem;">{{ $generalStats['published_cars'] }}</h3>
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
                            <div class="rounded-circle d-flex align-items-center justify-center shadow-lg" style="width: 50px; height: 50px; background: linear-gradient(135deg, #ffc107 0%, #e0a800 100%);">
                                <i class="fas fa-dollar-sign text-white"></i>
                            </div>
                        </div>
                        <div>
                            <p class="text-muted mb-1" style="font-size: 0.9rem; font-weight: 500;">Prix moyen</p>
                            <h3 class="fw-bold mb-1" style="color: #333; font-size: 2rem;">
                                ${{ number_format($generalStats['avg_price'], 0, '', ',') }}
                            </h3>
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
                            <div class="rounded-circle d-flex align-items-center justify-center shadow-lg" style="width: 50px; height: 50px; background: linear-gradient(135deg, #dc3545 0%, #c82333 100%);">
                                <i class="fas fa-heart text-white"></i>
                            </div>
                        </div>
                        <div>
                            <p class="text-muted mb-1" style="font-size: 0.9rem; font-weight: 500;">Favoris totaux</p>
                            <h3 class="fw-bold mb-1" style="color: #333; font-size: 2rem;">{{ $generalStats['total_favorites'] }}</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Diagrammes interactifs -->
    <div class="row g-4 mb-4">
        <!-- Graphique en secteurs - Répartition des marques -->
        <div class="col-lg-6">
            <div class="card shadow-sm border-0 h-100" style="border-radius: 16px; background: linear-gradient(135deg, #fff 0%, #fafafa 100%);">
                <div class="card-header border-0 bg-transparent" style="padding: 1.5rem 1.5rem 0;">
                    <h5 class="mb-0 fw-bold" style="color: #333; font-size: 1.3rem;">
                        <i class="fas fa-chart-pie me-2" style="color: #007bff;"></i>Répartition des marques
                    </h5>
                </div>
                <div class="card-body p-4">
                    <canvas id="brandsChart" width="400" height="300"></canvas>
                </div>
            </div>
        </div>

        <!-- Graphique en barres - Voitures par état -->
        <div class="col-lg-6">
            <div class="card shadow-sm border-0 h-100" style="border-radius: 16px; background: linear-gradient(135deg, #fff 0%, #fafafa 100%);">
                <div class="card-header border-0 bg-transparent" style="padding: 1.5rem 1.5rem 0;">
                    <h5 class="mb-0 fw-bold" style="color: #333; font-size: 1.3rem;">
                        <i class="fas fa-chart-bar me-2" style="color: #28a745;"></i>Voitures par état
                    </h5>
                </div>
                <div class="card-body p-4">
                    <canvas id="statesChart" width="400" height="300"></canvas>
                </div>
            </div>
        </div>
    </div>

    <!-- Graphiques de tendances -->
    <div class="row g-4 mb-4">
        <!-- Graphique linéaire - Évolution des prix -->
        <div class="col-lg-8">
            <div class="card shadow-sm border-0 h-100" style="border-radius: 16px; background: linear-gradient(135deg, #fff 0%, #fafafa 100%);">
                <div class="card-header border-0 bg-transparent" style="padding: 1.5rem 1.5rem 0;">
                    <h5 class="mb-0 fw-bold" style="color: #333; font-size: 1.3rem;">
                        <i class="fas fa-chart-line me-2" style="color: #F26522;"></i>Évolution des prix par marque
                    </h5>
                </div>
                <div class="card-body p-4">
                    <canvas id="priceEvolutionChart" width="400" height="200"></canvas>
                </div>
            </div>
        </div>

        <!-- Graphique en anneau - Répartition des utilisateurs -->
        <div class="col-lg-4">
            <div class="card shadow-sm border-0 h-100" style="border-radius: 16px; background: linear-gradient(135deg, #fff 0%, #fafafa 100%);">
                <div class="card-header border-0 bg-transparent" style="padding: 1.5rem 1.5rem 0;">
                    <h5 class="mb-0 fw-bold" style="color: #333; font-size: 1.3rem;">
                        <i class="fas fa-users me-2" style="color: #dc3545;"></i>Répartition des utilisateurs
                    </h5>
                </div>
                <div class="card-body p-4">
                    <canvas id="usersChart" width="400" height="300"></canvas>
                </div>
            </div>
        </div>
    </div>

    <!-- Graphique radar - Analyse complète -->
    <div class="row g-4 mb-4">
        <div class="col-12">
            <div class="card shadow-sm border-0" style="border-radius: 16px; background: linear-gradient(135deg, #fff 0%, #fafafa 100%);">
                <div class="card-header border-0 bg-transparent" style="padding: 1.5rem 1.5rem 0;">
                    <h5 class="mb-0 fw-bold" style="color: #333; font-size: 1.3rem;">
                        <i class="fas fa-chart-area me-2" style="color: #6f42c1;"></i>Analyse complète de la plateforme
                    </h5>
                </div>
                <div class="card-body p-4">
                    <canvas id="radarChart" width="400" height="300"></canvas>
                </div>
            </div>
        </div>
    </div>

    <!-- Graphique d'évolution mensuelle -->
    <div class="row g-4 mb-4">
        <div class="col-12">
            <div class="card shadow-sm border-0" style="border-radius: 16px; background: linear-gradient(135deg, #fff 0%, #fafafa 100%);">
                <div class="card-header border-0 bg-transparent" style="padding: 1.5rem 1.5rem 0;">
                    <h5 class="mb-0 fw-bold" style="color: #333; font-size: 1.3rem;">
                        <i class="fas fa-chart-line me-2" style="color: #17a2b8;"></i>Évolution mensuelle {{ date('Y') }}
                    </h5>
                </div>
                <div class="card-body p-4">
                    <canvas id="monthlyEvolutionChart" width="400" height="200"></canvas>
                </div>
            </div>
        </div>
    </div>

    <!-- Statistiques avancées et uniques -->
    <div class="row g-4 mb-4">
        <!-- Tendances hebdomadaires -->
        <div class="col-lg-4">
            <div class="card shadow-sm border-0 h-100" style="border-radius: 16px; background: linear-gradient(135deg, #fff 0%, #fafafa 100%);">
                <div class="card-header border-0 bg-transparent" style="padding: 1.5rem 1.5rem 0;">
                    <h5 class="mb-0 fw-bold" style="color: #333; font-size: 1.3rem;">
                        <i class="fas fa-calendar-week me-2" style="color: #007bff;"></i>Tendances hebdomadaires
                    </h5>
                </div>
                <div class="card-body p-4">
                    <canvas id="weeklyTrendsChart" width="400" height="250"></canvas>
                </div>
            </div>
        </div>

        <!-- Répartition des prix -->
        <div class="col-lg-4">
            <div class="card shadow-sm border-0 h-100" style="border-radius: 16px; background: linear-gradient(135deg, #fff 0%, #fafafa 100%);">
                <div class="card-header border-0 bg-transparent" style="padding: 1.5rem 1.5rem 0;">
                    <h5 class="mb-0 fw-bold" style="color: #333; font-size: 1.3rem;">
                        <i class="fas fa-chart-pie me-2" style="color: #ffc107;"></i>Répartition des prix
                    </h5>
                </div>
                <div class="card-body p-4">
                    <canvas id="priceRangesChart" width="400" height="250"></canvas>
                </div>
            </div>
        </div>

        <!-- Statistiques de croissance -->
        <div class="col-lg-4">
            <div class="card shadow-sm border-0 h-100" style="border-radius: 16px; background: linear-gradient(135deg, #fff 0%, #fafafa 100%);">
                <div class="card-header border-0 bg-transparent" style="padding: 1.5rem 1.5rem 0;">
                    <h5 class="mb-0 fw-bold" style="color: #333; font-size: 1.3rem;">
                        <i class="fas fa-trending-up me-2" style="color: #28a745;"></i>Croissance mensuelle
                    </h5>
                </div>
                <div class="card-body p-4">
                    @php
                        $userGrowth = $advancedStats['growth_stats']['users_growth'];
                        $carGrowth = $advancedStats['growth_stats']['cars_growth'];
                        
                        $userGrowthPercent = $userGrowth['last_month'] > 0 
                            ? (($userGrowth['current_month'] - $userGrowth['last_month']) / $userGrowth['last_month']) * 100 
                            : 0;
                            
                        $carGrowthPercent = $carGrowth['last_month'] > 0 
                            ? (($carGrowth['current_month'] - $carGrowth['last_month']) / $carGrowth['last_month']) * 100 
                            : 0;
                    @endphp
                    
                    <div class="mb-4">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <span class="fw-semibold" style="color: #333;">Nouveaux utilisateurs</span>
                            <span class="badge {{ $userGrowthPercent >= 0 ? 'bg-success' : 'bg-danger' }}">
                                {{ $userGrowthPercent >= 0 ? '+' : '' }}{{ number_format($userGrowthPercent, 1) }}%
                            </span>
                        </div>
                        <div class="d-flex justify-content-between">
                            <small class="text-muted">Mois actuel: {{ $userGrowth['current_month'] }}</small>
                            <small class="text-muted">Mois dernier: {{ $userGrowth['last_month'] }}</small>
                        </div>
                    </div>
                    
                    <div class="mb-4">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <span class="fw-semibold" style="color: #333;">Nouvelles voitures</span>
                            <span class="badge {{ $carGrowthPercent >= 0 ? 'bg-success' : 'bg-danger' }}">
                                {{ $carGrowthPercent >= 0 ? '+' : '' }}{{ number_format($carGrowthPercent, 1) }}%
                            </span>
                        </div>
                        <div class="d-flex justify-content-between">
                            <small class="text-muted">Mois actuel: {{ $carGrowth['current_month'] }}</small>
                            <small class="text-muted">Mois dernier: {{ $carGrowth['last_month'] }}</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Analyse des années et villes -->
    <div class="row g-4 mb-4">
        <!-- Top des villes -->
        <div class="col-lg-6">
            <div class="card shadow-sm border-0 h-100" style="border-radius: 16px; background: linear-gradient(135deg, #fff 0%, #fafafa 100%);">
                <div class="card-header border-0 bg-transparent" style="padding: 1.5rem 1.5rem 0;">
                    <h5 class="mb-0 fw-bold" style="color: #333; font-size: 1.3rem;">
                        <i class="fas fa-city me-2" style="color: #17a2b8;"></i>Top des villes
                    </h5>
                </div>
                <div class="card-body p-4">
                    <canvas id="citiesChart" width="400" height="300"></canvas>
                </div>
            </div>
        </div>

        <!-- Analyse par année -->
        <div class="col-lg-6">
            <div class="card shadow-sm border-0 h-100" style="border-radius: 16px; background: linear-gradient(135deg, #fff 0%, #fafafa 100%);">
                <div class="card-header border-0 bg-transparent" style="padding: 1.5rem 1.5rem 0;">
                    <h5 class="mb-0 fw-bold" style="color: #333; font-size: 1.3rem;">
                        <i class="fas fa-calendar-alt me-2" style="color: #6f42c1;"></i>Analyse par année
                    </h5>
                </div>
                <div class="card-body p-4">
                    <canvas id="carYearsChart" width="400" height="300"></canvas>
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
    transform: translateY(-2px);
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15) !important;
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
    .card-body {
        padding: 1rem !important;
    }
    
    .card-header {
        padding: 1rem 1rem 0 !important;
    }
    
    h1 {
        font-size: 2rem !important;
    }
    
    h3 {
        font-size: 1.5rem !important;
    }
}

/* Progress bars animées */
.progress-bar {
    transition: width 1s ease-in-out;
}

/* Images avec hover effects */
.card img {
    transition: all 0.3s ease;
}

.card img:hover {
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

@php
    // Utilisation des données du contrôleur
    $brandsData = $chartData['brands'];
    $statesData = $chartData['states'];
    $priceEvolutionData = $chartData['price_by_brand'];
    
    $usersData = [
        'total' => $generalStats['total_users'],
        'admins' => $generalStats['admin_users'],
        'regular' => $generalStats['regular_users']
    ];
    
    // Données pour le graphique radar
    $radarData = [
        'users' => $generalStats['total_users'],
        'cars' => $generalStats['published_cars'],
        'favorites' => $generalStats['total_favorites'],
        'avgPrice' => $generalStats['avg_price'],
        'brandsCount' => $brandsData->count(),
        'statesCount' => $statesData->count()
    ];
    
    // Préparation des données d'évolution mensuelle
    $monthlyData = [
        'users' => $chartData['users_by_month'],
        'cars' => $chartData['cars_by_month'],
        'favorites' => $chartData['favorites_by_month']
    ];
    
    // Nouvelles données pour les graphiques avancés
    $weeklyTrendsData = $advancedStats['weekly_trends'];
    $priceRangesData = $advancedStats['price_ranges'];
    $topCitiesData = $advancedStats['top_cities'];
    $carYearsData = $advancedStats['car_years'];
@endphp

<script>
// Données pour les graphiques
const chartData = {
    brands: @json($brandsData),
    states: @json($statesData),
    priceEvolution: @json($priceEvolutionData),
    users: @json($usersData),
    radar: @json($radarData),
    monthly: @json($monthlyData),
    weeklyTrends: @json($weeklyTrendsData),
    priceRanges: @json($priceRangesData),
    topCities: @json($topCitiesData),
    carYears: @json($carYearsData)
};

// Couleurs pour les graphiques
const chartColors = [
    '#007bff', '#28a745', '#ffc107', '#dc3545', '#6f42c1', 
    '#fd7e14', '#20c997', '#e83e8c', '#6c757d', '#17a2b8'
];

// Configuration commune pour Chart.js
Chart.defaults.font.family = "'Figtree', sans-serif";
Chart.defaults.font.size = 12;
Chart.defaults.color = '#666';

// 1. Graphique en secteurs - Répartition des marques
const brandsCtx = document.getElementById('brandsChart').getContext('2d');
new Chart(brandsCtx, {
    type: 'doughnut',
    data: {
        labels: chartData.brands.map(item => item.brand),
        datasets: [{
            data: chartData.brands.map(item => item.count),
            backgroundColor: chartColors.slice(0, chartData.brands.length),
            borderWidth: 2,
            borderColor: '#fff',
            hoverBorderWidth: 3,
            hoverBorderColor: '#fff'
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            legend: {
                position: 'bottom',
                labels: {
                    padding: 20,
                    usePointStyle: true,
                    pointStyle: 'circle'
                }
            },
            tooltip: {
                callbacks: {
                    label: function(context) {
                        const total = context.dataset.data.reduce((a, b) => a + b, 0);
                        const percentage = ((context.parsed / total) * 100).toFixed(1);
                        return `${context.label}: ${context.parsed} (${percentage}%)`;
                    }
                }
            }
        },
        animation: {
            animateRotate: true,
            animateScale: true
        }
    }
});

// 2. Graphique en barres - Voitures par état
const statesCtx = document.getElementById('statesChart').getContext('2d');
new Chart(statesCtx, {
    type: 'bar',
    data: {
        labels: chartData.states.map(item => item.state),
        datasets: [{
            label: 'Nombre de voitures',
            data: chartData.states.map(item => item.count),
            backgroundColor: chartColors.slice(0, chartData.states.length).map(color => color + '80'),
            borderColor: chartColors.slice(0, chartData.states.length),
            borderWidth: 2,
            borderRadius: 8,
            borderSkipped: false
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            legend: {
                display: false
            },
            tooltip: {
                backgroundColor: 'rgba(0, 0, 0, 0.8)',
                titleColor: '#fff',
                bodyColor: '#fff',
                borderColor: '#fff',
                borderWidth: 1
            }
        },
        scales: {
            y: {
                beginAtZero: true,
                grid: {
                    color: 'rgba(0, 0, 0, 0.1)'
                },
                ticks: {
                    stepSize: 1
                }
            },
            x: {
                grid: {
                    display: false
                }
            }
        },
        animation: {
            duration: 2000,
            easing: 'easeInOutQuart'
        }
    }
});

// 3. Graphique linéaire - Évolution des prix
const priceCtx = document.getElementById('priceEvolutionChart').getContext('2d');
new Chart(priceCtx, {
    type: 'line',
    data: {
        labels: chartData.priceEvolution.map(item => item.brand),
        datasets: [{
            label: 'Prix moyen ($)',
            data: chartData.priceEvolution.map(item => Math.round(item.avg_price)),
            borderColor: '#F26522',
            backgroundColor: 'rgba(242, 101, 34, 0.1)',
            borderWidth: 3,
            fill: true,
            tension: 0.4,
            pointBackgroundColor: '#F26522',
            pointBorderColor: '#fff',
            pointBorderWidth: 2,
            pointRadius: 6,
            pointHoverRadius: 8
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            legend: {
                display: false
            },
            tooltip: {
                callbacks: {
                    label: function(context) {
                        return `Prix moyen: $${context.parsed.y.toLocaleString()}`;
                    }
                }
            }
        },
        scales: {
            y: {
                beginAtZero: true,
                grid: {
                    color: 'rgba(0, 0, 0, 0.1)'
                },
                ticks: {
                    callback: function(value) {
                        return '$' + value.toLocaleString();
                    }
                }
            },
            x: {
                grid: {
                    display: false
                }
            }
        },
        animation: {
            duration: 2000,
            easing: 'easeInOutQuart'
        }
    }
});

// 4. Graphique en anneau - Répartition des utilisateurs
const usersCtx = document.getElementById('usersChart').getContext('2d');
new Chart(usersCtx, {
    type: 'doughnut',
    data: {
        labels: ['Administrateurs', 'Utilisateurs'],
        datasets: [{
            data: [chartData.users.admins, chartData.users.regular],
            backgroundColor: ['#dc3545', '#007bff'],
            borderWidth: 3,
            borderColor: '#fff',
            cutout: '70%'
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            legend: {
                position: 'bottom',
                labels: {
                    padding: 15,
                    usePointStyle: true
                }
            },
            tooltip: {
                callbacks: {
                    label: function(context) {
                        const total = context.dataset.data.reduce((a, b) => a + b, 0);
                        const percentage = ((context.parsed / total) * 100).toFixed(1);
                        return `${context.label}: ${context.parsed} (${percentage}%)`;
                    }
                }
            }
        },
        animation: {
            animateRotate: true,
            animateScale: true
        }
    }
});

// 5. Graphique radar - Analyse complète
const radarCtx = document.getElementById('radarChart').getContext('2d');
new Chart(radarCtx, {
    type: 'radar',
    data: {
        labels: ['Utilisateurs', 'Voitures', 'Favoris', 'Prix moyen', 'Marques', 'États'],
        datasets: [{
            label: 'Performance',
            data: [
                chartData.radar.users,
                chartData.radar.cars,
                chartData.radar.favorites,
                Math.round(chartData.radar.avgPrice / 1000),
                chartData.radar.brandsCount,
                chartData.radar.statesCount
            ],
            backgroundColor: 'rgba(111, 66, 193, 0.2)',
            borderColor: '#6f42c1',
            borderWidth: 3,
            pointBackgroundColor: '#6f42c1',
            pointBorderColor: '#fff',
            pointBorderWidth: 2,
            pointRadius: 6,
            pointHoverRadius: 8
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            legend: {
                display: false
            },
            tooltip: {
                backgroundColor: 'rgba(0, 0, 0, 0.8)',
                titleColor: '#fff',
                bodyColor: '#fff'
            }
        },
        scales: {
            r: {
                beginAtZero: true,
                grid: {
                    color: 'rgba(0, 0, 0, 0.1)'
                },
                pointLabels: {
                    font: {
                        size: 12,
                        weight: 'bold'
                    }
                }
            }
        },
        animation: {
            duration: 2000,
            easing: 'easeInOutQuart'
        }
    }
});

// 6. Graphique d'évolution mensuelle
const monthlyCtx = document.getElementById('monthlyEvolutionChart').getContext('2d');

// Préparation des données mensuelles (12 mois)
const months = ['Jan', 'Fév', 'Mar', 'Avr', 'Mai', 'Jun', 'Jul', 'Aoû', 'Sep', 'Oct', 'Nov', 'Déc'];
const monthlyUsersData = new Array(12).fill(0);
const monthlyCarsData = new Array(12).fill(0);
const monthlyFavoritesData = new Array(12).fill(0);

// Remplir les données existantes
chartData.monthly.users.forEach(item => {
    if (item.month >= 1 && item.month <= 12) {
        monthlyUsersData[item.month - 1] = item.count;
    }
});

chartData.monthly.cars.forEach(item => {
    if (item.month >= 1 && item.month <= 12) {
        monthlyCarsData[item.month - 1] = item.count;
    }
});

chartData.monthly.favorites.forEach(item => {
    if (item.month >= 1 && item.month <= 12) {
        monthlyFavoritesData[item.month - 1] = item.count;
    }
});

new Chart(monthlyCtx, {
    type: 'line',
    data: {
        labels: months,
        datasets: [
            {
                label: 'Nouveaux utilisateurs',
                data: monthlyUsersData,
                borderColor: '#007bff',
                backgroundColor: 'rgba(0, 123, 255, 0.1)',
                borderWidth: 3,
                fill: true,
                tension: 0.4,
                pointBackgroundColor: '#007bff',
                pointBorderColor: '#fff',
                pointBorderWidth: 2,
                pointRadius: 5,
                pointHoverRadius: 7
            },
            {
                label: 'Nouvelles voitures',
                data: monthlyCarsData,
                borderColor: '#28a745',
                backgroundColor: 'rgba(40, 167, 69, 0.1)',
                borderWidth: 3,
                fill: true,
                tension: 0.4,
                pointBackgroundColor: '#28a745',
                pointBorderColor: '#fff',
                pointBorderWidth: 2,
                pointRadius: 5,
                pointHoverRadius: 7
            },
            {
                label: 'Nouveaux favoris',
                data: monthlyFavoritesData,
                borderColor: '#dc3545',
                backgroundColor: 'rgba(220, 53, 69, 0.1)',
                borderWidth: 3,
                fill: true,
                tension: 0.4,
                pointBackgroundColor: '#dc3545',
                pointBorderColor: '#fff',
                pointBorderWidth: 2,
                pointRadius: 5,
                pointHoverRadius: 7
            }
        ]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            legend: {
                position: 'top',
                labels: {
                    padding: 20,
                    usePointStyle: true,
                    pointStyle: 'circle'
                }
            },
            tooltip: {
                mode: 'index',
                intersect: false,
                backgroundColor: 'rgba(0, 0, 0, 0.8)',
                titleColor: '#fff',
                bodyColor: '#fff',
                borderColor: '#fff',
                borderWidth: 1
            }
        },
        scales: {
            y: {
                beginAtZero: true,
                grid: {
                    color: 'rgba(0, 0, 0, 0.1)'
                },
                ticks: {
                    stepSize: 1
                }
            },
            x: {
                grid: {
                    display: false
                }
            }
        },
        interaction: {
            mode: 'nearest',
            axis: 'x',
            intersect: false
        },
        animation: {
            duration: 2000,
            easing: 'easeInOutQuart'
        }
    }
});

// 7. Graphique des tendances hebdomadaires
const weeklyTrendsCtx = document.getElementById('weeklyTrendsChart').getContext('2d');

// Préparation des données des 7 derniers jours
const last7Days = [];
const weeklyUsersData = [];
const weeklyCarsData = [];
const weeklyFavoritesData = [];

for (let i = 6; i >= 0; i--) {
    const date = new Date();
    date.setDate(date.getDate() - i);
    const dateStr = date.toISOString().split('T')[0];
    const dayName = date.toLocaleDateString('fr-FR', { weekday: 'short' });
    
    last7Days.push(dayName);
    
    // Trouver les données correspondantes ou 0
    const userData = chartData.weeklyTrends.users.find(item => item.date === dateStr);
    const carData = chartData.weeklyTrends.cars.find(item => item.date === dateStr);
    const favoriteData = chartData.weeklyTrends.favorites.find(item => item.date === dateStr);
    
    weeklyUsersData.push(userData ? userData.count : 0);
    weeklyCarsData.push(carData ? carData.count : 0);
    weeklyFavoritesData.push(favoriteData ? favoriteData.count : 0);
}

new Chart(weeklyTrendsCtx, {
    type: 'line',
    data: {
        labels: last7Days,
        datasets: [
            {
                label: 'Utilisateurs',
                data: weeklyUsersData,
                borderColor: '#007bff',
                backgroundColor: 'rgba(0, 123, 255, 0.1)',
                borderWidth: 2,
                fill: true,
                tension: 0.4,
                pointRadius: 4
            },
            {
                label: 'Voitures',
                data: weeklyCarsData,
                borderColor: '#28a745',
                backgroundColor: 'rgba(40, 167, 69, 0.1)',
                borderWidth: 2,
                fill: true,
                tension: 0.4,
                pointRadius: 4
            },
            {
                label: 'Favoris',
                data: weeklyFavoritesData,
                borderColor: '#dc3545',
                backgroundColor: 'rgba(220, 53, 69, 0.1)',
                borderWidth: 2,
                fill: true,
                tension: 0.4,
                pointRadius: 4
            }
        ]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            legend: {
                position: 'top',
                labels: {
                    padding: 15,
                    usePointStyle: true,
                    pointStyle: 'circle'
                }
            }
        },
        scales: {
            y: {
                beginAtZero: true,
                grid: {
                    color: 'rgba(0, 0, 0, 0.1)'
                }
            },
            x: {
                grid: {
                    display: false
                }
            }
        }
    }
});

// 8. Graphique de répartition des prix
const priceRangesCtx = document.getElementById('priceRangesChart').getContext('2d');
new Chart(priceRangesCtx, {
    type: 'doughnut',
    data: {
        labels: ['Budget (<$15k)', 'Milieu de gamme ($15k-$50k)', 'Luxe (>$50k)'],
        datasets: [{
            data: [
                chartData.priceRanges.budget,
                chartData.priceRanges.mid_range,
                chartData.priceRanges.luxury
            ],
            backgroundColor: ['#28a745', '#ffc107', '#dc3545'],
            borderWidth: 2,
            borderColor: '#fff'
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            legend: {
                position: 'bottom',
                labels: {
                    padding: 15,
                    usePointStyle: true
                }
            },
            tooltip: {
                callbacks: {
                    label: function(context) {
                        const total = context.dataset.data.reduce((a, b) => a + b, 0);
                        const percentage = ((context.parsed / total) * 100).toFixed(1);
                        return `${context.label}: ${context.parsed} voitures (${percentage}%)`;
                    }
                }
            }
        }
    }
});

// 9. Graphique des villes
const citiesCtx = document.getElementById('citiesChart').getContext('2d');
new Chart(citiesCtx, {
    type: 'bar',
    indexAxis: 'y',
    data: {
        labels: chartData.topCities.map(item => item.city || 'Non spécifié'),
        datasets: [{
            label: 'Nombre de voitures',
            data: chartData.topCities.map(item => item.count),
            backgroundColor: '#17a2b8',
            borderColor: '#138496',
            borderWidth: 1
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            legend: {
                display: false
            }
        },
        scales: {
            x: {
                beginAtZero: true,
                grid: {
                    color: 'rgba(0, 0, 0, 0.1)'
                }
            },
            y: {
                grid: {
                    display: false
                }
            }
        }
    }
});

// 10. Graphique des années de voitures
const carYearsCtx = document.getElementById('carYearsChart').getContext('2d');
new Chart(carYearsCtx, {
    type: 'scatter',
    data: {
        datasets: [{
            label: 'Voitures par année',
            data: chartData.carYears.map(item => ({
                x: item.year,
                y: item.count,
                avgPrice: item.avg_price
            })),
            backgroundColor: '#6f42c1',
            borderColor: '#563d7c',
            borderWidth: 2,
            pointRadius: 6,
            pointHoverRadius: 8
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            legend: {
                display: false
            },
            tooltip: {
                callbacks: {
                    label: function(context) {
                        const point = context.raw;
                        return [
                            `Année: ${point.x}`,
                            `Nombre: ${point.y} voitures`,
                            `Prix moyen: $${Math.round(point.avgPrice).toLocaleString()}`
                        ];
                    }
                }
            }
        },
        scales: {
            x: {
                type: 'linear',
                position: 'bottom',
                title: {
                    display: true,
                    text: 'Année'
                },
                grid: {
                    color: 'rgba(0, 0, 0, 0.1)'
                }
            },
            y: {
                beginAtZero: true,
                title: {
                    display: true,
                    text: 'Nombre de voitures'
                },
                grid: {
                    color: 'rgba(0, 0, 0, 0.1)'
                }
            }
        }
    }
});

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
    
    // Animation des images
    const images = document.querySelectorAll('.card img');
    images.forEach(img => {
        img.addEventListener('mouseenter', function() {
            this.style.transform = 'scale(1.1)';
        });
        
        img.addEventListener('mouseleave', function() {
            this.style.transform = 'scale(1)';
        });
    });
    
    // Animation des progress bars
    const progressBars = document.querySelectorAll('.progress-bar');
    progressBars.forEach(bar => {
        const width = bar.style.width;
        bar.style.width = '0%';
        setTimeout(() => {
            bar.style.width = width;
        }, 500);
    });
});
</script>
@endsection 