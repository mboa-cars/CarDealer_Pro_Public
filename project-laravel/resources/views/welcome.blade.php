@extends('layouts.app')

@section('content')
<!-- Hero Section -->
<div class="row align-items-center bg-white rounded-4 shadow-sm p-5 mb-5 position-relative" style="min-height:400px; background: linear-gradient(135deg, #fff 0%, #fff8f0 100%); border: 1px solid #f0f0f0;">
    
    <div class="col-md-6">
        <h1 class="fw-bold mb-4" style="font-size:3rem; line-height: 1.2;">
            Buy <span style="color:#F26522">The Best Vehicles</span><br>
            <span style="color:#333;">in your region</span>
        </h1>
        <p class="text-secondary mb-4" style="font-size: 1.1rem; line-height: 1.6;">
            Use powerful search tool to find your desired cars<br>
            based on multiple search criteria: Make, Model, Year,<br>
            Price Range, Car Type, etc...
        </p>
        <a href="/cars" class="btn btn-lg px-5 py-3" style="background: #F26522; color: white; border: none; border-radius: 30px; font-weight: 600; text-decoration: none; box-shadow: 0 4px 15px rgba(242, 101, 34, 0.3);">
            Find the car
        </a>
    </div>
    <div class="col-md-6 text-center">
        <img src="images/car-png-39071.png" alt="Car" class="img-fluid" style="max-height:350px; filter: drop-shadow(0 10px 20px rgba(0,0,0,0.1));">
    </div>
</div>

<!-- Search Section -->
<div id="search" class="bg-white rounded-4 p-5 mb-5 shadow-sm" style="border: 1px solid #f0f0f0; background: #f8f9fa;">
    <form class="row g-3 align-items-end" method="GET" action="{{ route('cars.index') }}">
        <div class="col-md-2">
            <label class="form-label fw-semibold" style="color: #555;">Maker</label>
            <select class="form-select" name="brand" style="border-color: #ddd; border-radius: 8px;">
                <option value="">Maker</option>
                @isset($brands)
                    @foreach($brands as $brand)
                        <option value="{{ $brand }}">{{ $brand }}</option>
                    @endforeach
                @endisset
            </select>
        </div>
        <div class="col-md-2">
            <label class="form-label fw-semibold" style="color: #555;">Model</label>
            <select class="form-select" name="model" style="border-color: #ddd; border-radius: 8px;">
                <option value="">Model</option>
                @isset($models)
                    @foreach($models as $model)
                        <option value="{{ $model }}">{{ $model }}</option>
                    @endforeach
                @endisset
            </select>
        </div>
        <div class="col-md-2">
            <label class="form-label fw-semibold" style="color: #555;">State/Region</label>
            <select class="form-select" name="state" style="border-color: #ddd; border-radius: 8px;">
                <option value="">State/Region</option>
                @isset($states)
                    @foreach($states as $state)
                        <option value="{{ $state }}">{{ $state }}</option>
                    @endforeach
                @endisset
            </select>
        </div>
        <div class="col-md-2">
            <label class="form-label fw-semibold" style="color: #555;">City</label>
            <select class="form-select" name="city" style="border-color: #ddd; border-radius: 8px;">
                <option value="">City</option>
                @isset($cities)
                    @foreach($cities as $city)
                        <option value="{{ $city }}">{{ $city }}</option>
                    @endforeach
                @endisset
            </select>
        </div>
        <div class="col-md-2">
            <label class="form-label fw-semibold" style="color: #555;">Type</label>
            <select class="form-select" name="type" style="border-color: #ddd; border-radius: 8px;">
                <option value="">Type</option>
                @isset($types)
                    @foreach($types as $type)
                        <option value="{{ $type }}">{{ $type }}</option>
                    @endforeach
                @endisset
            </select>
        </div>
        <div class="col-md-2 d-flex gap-2">
            <a href="/" class="btn" style="background: #f8f9fa; color: #666; border: 1px solid #ddd; border-radius: 8px; font-weight: 500; flex: 1;">Reset</a>
            <button type="submit" class="btn" style="background: #F26522; color: white; border: none; border-radius: 8px; font-weight: 500; flex: 1;">Search</button>
        </div>
        <div class="col-md-2">
            <label class="form-label fw-semibold" style="color: #555;">Year From</label>
            <input type="number" class="form-control" placeholder="Year From" name="year_from" style="border-color: #ddd; border-radius: 8px;">
        </div>
        <div class="col-md-2">
            <label class="form-label fw-semibold" style="color: #555;">Year To</label>
            <input type="number" class="form-control" placeholder="Year To" name="year_to" style="border-color: #ddd; border-radius: 8px;">
        </div>
        <div class="col-md-2">
            <label class="form-label fw-semibold" style="color: #555;">Price From</label>
            <input type="number" class="form-control" placeholder="Price From" name="price_from" style="border-color: #ddd; border-radius: 8px;">
        </div>
        <div class="col-md-2">
            <label class="form-label fw-semibold" style="color: #555;">Price To</label>
            <input type="number" class="form-control" placeholder="Price To" name="price_to" style="border-color: #ddd; border-radius: 8px;">
        </div>
        <div class="col-md-2">
            <label class="form-label fw-semibold" style="color: #555;">Fuel Type</label>
            <select class="form-select" name="fuel_type" style="border-color: #ddd; border-radius: 8px;">
                <option value="">Fuel Type</option>
                @isset($fuel_types)
                    @foreach($fuel_types as $fuel_type)
                        <option value="{{ $fuel_type }}">{{ $fuel_type }}</option>
                    @endforeach
                @endisset
            </select>
        </div>
    </form>
</div>

<!-- Latest Cars Section -->
<div class="mb-4">
    <h4 class="fw-bold mb-3" style="color: #333; font-size: 1.8rem;">
        <i class="fas fa-star me-2" style="color: #F26522;"></i>
        Latest Added Cars
    </h4>
    <div class="mb-3 text-end" style="font-size:1rem; color:#666;">
        Showing <span style="color:#F26522; font-weight: 600;">{{ $latestCars->firstItem() }}</span> to <span style="color:#F26522; font-weight: 600;">{{ $latestCars->lastItem() }}</span> of <span style="color:#F26522; font-weight: 600;">{{ $latestCars->total() }}</span> cars
    </div>
</div>

<div class="row g-3">
    @foreach($latestCars as $car)
        @include('components.car-card', ['car' => $car])
    @endforeach
</div>

<div class="mt-4 d-flex justify-content-center">
    <div style="font-size:0.95rem;">
        {{ $latestCars->onEachSide(1)->links('pagination::bootstrap-4') }}
    </div>
</div>

<!-- Call to Action pour les utilisateurs non connectés -->
@guest
<div class="community-cta-section mt-5 mb-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="cta-card">
                    <div class="cta-background">
                        <div class="cta-pattern"></div>
                    </div>
                    <div class="row align-items-center">
                        <div class="col-lg-7">
                            <div class="cta-content">
                                <div class="cta-badge mb-3">
                                    <i class="fas fa-crown me-2"></i>Exclusif
                                </div>
                                <h2 class="cta-title mb-3">
                                    Rejoignez notre communauté 
                                    <span class="highlight">d'acheteurs et vendeurs</span>
                                </h2>
                                <p class="cta-description mb-4">
                                    Découvrez un écosystème complet où vous pouvez noter les vendeurs, 
                                    suivre vos annonces préférées et profiter de fonctionnalités exclusives 
                                    réservées aux membres.
                                </p>
                                <div class="cta-features mb-4">
                                    <div class="feature-item">
                                        <i class="fas fa-star text-warning"></i>
                                        <span>Noter les vendeurs</span>
                                    </div>
                                    <div class="feature-item">
                                        <i class="fas fa-heart text-danger"></i>
                                        <span>Suivre vos favoris</span>
                                    </div>
                                    <div class="feature-item">
                                        <i class="fas fa-bell text-primary"></i>
                                        <span>Alertes personnalisées</span>
                                    </div>
                                </div>
                                <div class="cta-buttons">
                                    <a href="{{ route('register') }}" class="btn btn-primary btn-lg cta-btn-primary">
                                        <i class="fas fa-rocket me-2"></i>Commencer maintenant
                                    </a>
                                    <a href="{{ route('login') }}" class="btn btn-outline-light btn-lg cta-btn-secondary">
                                        <i class="fas fa-sign-in-alt me-2"></i>Se connecter
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-5">
                            <div class="cta-visual">
                                <div class="floating-card card-1">
                                    <i class="fas fa-star"></i>
                                    <span>4.8/5</span>
                                </div>
                                <div class="floating-card card-2">
                                    <i class="fas fa-users"></i>
                                    <span>+1000 membres</span>
                                </div>
                                <div class="floating-card card-3">
                                    <i class="fas fa-car"></i>
                                    <span>+500 voitures</span>
                                </div>
                                <div class="main-illustration">
                                    <i class="fas fa-users"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.community-cta-section {
    position: relative;
    overflow: hidden;
}

.cta-card {
    position: relative;
    background: linear-gradient(135deg, #F26522 0%, #ea6500 100%);
    border-radius: 24px;
    padding: 3rem;
    color: white;
    box-shadow: 0 20px 40px rgba(242, 101, 34, 0.3);
    overflow: hidden;
}

.cta-background {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    opacity: 0.1;
}

.cta-pattern {
    position: absolute;
    top: -50%;
    right: -50%;
    width: 200%;
    height: 200%;
    background: radial-gradient(circle, rgba(255,255,255,0.1) 1px, transparent 1px);
    background-size: 30px 30px;
    animation: float 6s ease-in-out infinite;
}

@keyframes float {
    0%, 100% { transform: translateY(0px) rotate(0deg); }
    50% { transform: translateY(-20px) rotate(180deg); }
}

.cta-badge {
    display: inline-block;
    background: rgba(255, 255, 255, 0.2);
    color: white;
    padding: 0.5rem 1rem;
    border-radius: 50px;
    font-size: 0.9rem;
    font-weight: 600;
    backdrop-filter: blur(10px);
}

.cta-title {
    font-size: 2.5rem;
    font-weight: 700;
    line-height: 1.2;
    margin-bottom: 1rem;
}

.cta-title .highlight {
    background: linear-gradient(45deg, #FFD700, #F26522);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}

.cta-description {
    font-size: 1.1rem;
    line-height: 1.6;
    opacity: 0.9;
}

.cta-features {
    display: flex;
    flex-wrap: wrap;
    gap: 1rem;
}

.feature-item {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    background: rgba(255, 255, 255, 0.15);
    padding: 0.5rem 1rem;
    border-radius: 25px;
    font-size: 0.9rem;
    backdrop-filter: blur(10px);
    border: 1px solid rgba(255, 255, 255, 0.1);
}

.cta-buttons {
    display: flex;
    gap: 1rem;
    flex-wrap: wrap;
}

.cta-btn-primary {
    background: linear-gradient(45deg, #FFD700, #F26522);
    border: none;
    color: #333;
    font-weight: 600;
    padding: 0.75rem 2rem;
    border-radius: 50px;
    transition: all 0.3s ease;
    box-shadow: 0 4px 15px rgba(242, 101, 34, 0.3);
}

.cta-btn-primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(242, 101, 34, 0.4);
    color: #333;
}

.cta-btn-secondary {
    border: 2px solid rgba(255, 255, 255, 0.3);
    color: white;
    font-weight: 600;
    padding: 0.75rem 2rem;
    border-radius: 50px;
    transition: all 0.3s ease;
    backdrop-filter: blur(10px);
}

.cta-btn-secondary:hover {
    background: rgba(242, 101, 34, 0.2);
    border-color: rgba(242, 101, 34, 0.5);
    color: white;
    transform: translateY(-2px);
}

.cta-visual {
    position: relative;
    height: 300px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.main-illustration {
    font-size: 8rem;
    color: rgba(255, 255, 255, 0.3);
    animation: pulse 2s ease-in-out infinite;
}

@keyframes pulse {
    0%, 100% { transform: scale(1); }
    50% { transform: scale(1.05); }
}

.floating-card {
    position: absolute;
    background: rgba(255, 255, 255, 0.15);
    backdrop-filter: blur(10px);
    padding: 0.75rem 1rem;
    border-radius: 15px;
    display: flex;
    align-items: center;
    gap: 0.5rem;
    font-size: 0.9rem;
    font-weight: 600;
    animation: float-card 3s ease-in-out infinite;
    border: 1px solid rgba(255, 255, 255, 0.1);
}

.floating-card.card-1 {
    top: 10%;
    left: 10%;
    animation-delay: 0s;
}

.floating-card.card-2 {
    top: 60%;
    right: 10%;
    animation-delay: 1s;
}

.floating-card.card-3 {
    bottom: 20%;
    left: 20%;
    animation-delay: 2s;
}

@keyframes float-card {
    0%, 100% { transform: translateY(0px) rotate(0deg); }
    50% { transform: translateY(-10px) rotate(5deg); }
}

@media (max-width: 768px) {
    .cta-card {
        padding: 2rem;
    }
    
    .cta-title {
        font-size: 2rem;
    }
    
    .cta-buttons {
        flex-direction: column;
    }
    
    .cta-visual {
        height: 200px;
        margin-top: 2rem;
    }
    
    .main-illustration {
        font-size: 5rem;
    }
}
</style>
@endguest

<style>
/* Styles personnalisés pour la pagination */
.pagination .page-item.active .page-link {
    background-color: #F26522 !important;
    border-color: #F26522 !important;
    color: white !important;
}

.pagination .page-link {
    color: #F26522 !important;
    border-radius: 8px !important;
}

.pagination .page-link:hover {
    background-color: #ffe5d0 !important;
    color: #F26522 !important;
}


</style>
@endsection 
