@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
            <!-- Header Section -->
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h2 class="fw-bold mb-1" style="color: #333; font-size: 2.2rem;">Avis sur {{ $car->brand }} {{ $car->model }}</h2>
                    <p class="text-muted mb-0" style="font-size: 1rem;">Avis des acheteurs sur cette voiture</p>
                </div>
                <a href="{{ route('cars.show', $car->id) }}" class="btn btn-outline-secondary">
                    <i class="fas fa-arrow-left me-2"></i>Retour à l'annonce
                </a>
            </div>

            <!-- Informations sur la voiture -->
            <div class="card shadow-sm border-0 mb-4" style="border-radius: 16px; background: linear-gradient(135deg, #fff 0%, #fafafa 100%);">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-md-3">
                            @if($car->main_image)
                                <img src="{{ $car->main_image }}" alt="{{ $car->brand }} {{ $car->model }}" 
                                     style="width: 100%; height: 150px; object-fit: cover; border-radius: 12px;">
                            @endif
                        </div>
                        <div class="col-md-9">
                            <h4 class="fw-bold mb-2">{{ $car->brand }} {{ $car->model }}</h4>
                            <p class="text-muted mb-2">Vendeur : {{ $car->user->name }}</p>
                            <div class="d-flex align-items-center mb-2">
                                @if($car->user->average_rating)
                                    <div class="stars-display me-3">
                                        @for($i = 1; $i <= 5; $i++)
                                            <i class="fas fa-star {{ $i <= $car->user->average_rating ? 'text-warning' : 'text-muted' }}"></i>
                                        @endfor
                                    </div>
                                    <span class="text-muted">{{ $car->user->average_rating }}/5 ({{ $car->user->reviews_count }} avis)</span>
                                @else
                                    <span class="text-muted">Aucun avis pour ce vendeur</span>
                                @endif
                            </div>
                            <div class="d-flex gap-2">
                                <a href="{{ route('reviews.seller', $car->user->id) }}" class="btn btn-sm btn-outline-primary">
                                    <i class="fas fa-user me-1"></i>Voir tous les avis du vendeur
                                </a>
                                @auth
                                    @if(auth()->id() !== $car->user_id)
                                        <a href="{{ route('reviews.create', $car->id) }}" class="btn btn-sm btn-modern">
                                            <i class="fas fa-star me-1"></i>Noter ce vendeur
                                        </a>
                                    @endif
                                @else
                                    <a href="{{ route('login') }}" class="btn btn-sm btn-outline-warning">
                                        <i class="fas fa-sign-in-alt me-1"></i>Connectez-vous pour noter
                                    </a>
                                @endauth
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Liste des avis -->
            <div class="card shadow-sm border-0" style="border-radius: 16px; background: linear-gradient(135deg, #fff 0%, #fafafa 100%);">
                <div class="card-header border-0 bg-transparent" style="padding: 1.5rem 1.5rem 0;">
                    <h5 class="mb-0 fw-bold" style="color: #333; font-size: 1.3rem;">
                        <i class="fas fa-comments me-2" style="color: #F26522;"></i>Avis pour cette voiture
                    </h5>
                </div>
                <div class="card-body" style="padding: 1.5rem;">
                    @if($reviews->count() > 0)
                        @foreach($reviews as $review)
                            <div class="review-item mb-4 p-3" style="border: 1px solid #e9ecef; border-radius: 12px; background: #fff;">
                                <div class="d-flex justify-content-between align-items-start mb-2">
                                    <div>
                                        <h6 class="fw-bold mb-1">{{ $review->reviewer->name }}</h6>
                                        <div class="stars-display">
                                            @for($i = 1; $i <= 5; $i++)
                                                <i class="fas fa-star {{ $i <= $review->rating ? 'text-warning' : 'text-muted' }}" style="font-size: 0.9rem;"></i>
                                            @endfor
                                            <span class="ms-2 text-muted">{{ $review->rating }}/5</span>
                                        </div>
                                    </div>
                                    <small class="text-muted">{{ $review->created_at->format('d/m/Y') }}</small>
                                </div>
                                
                                @if($review->comment)
                                    <p class="mb-0" style="color: #555;">{{ $review->comment }}</p>
                                @else
                                    <p class="mb-0 text-muted"><em>Aucun commentaire</em></p>
                                @endif
                            </div>
                        @endforeach
                    @else
                        <div class="text-center py-5">
                            <i class="fas fa-comments" style="font-size: 3rem; color: #ddd; margin-bottom: 1rem;"></i>
                            <h5 class="text-muted">Aucun avis pour cette voiture</h5>
                            <p class="text-muted">Soyez le premier à laisser un avis !</p>
                            @auth
                                @if(auth()->id() !== $car->user_id)
                                    <a href="{{ route('reviews.create', $car->id) }}" class="btn btn-modern">
                                        <i class="fas fa-star me-2"></i>Noter ce vendeur
                                    </a>
                                @endif
                            @else
                                <a href="{{ route('login') }}" class="btn btn-outline-warning">
                                    <i class="fas fa-sign-in-alt me-2"></i>Connectez-vous pour noter
                                </a>
                            @endauth
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.stars-display {
    display: inline-flex;
    gap: 2px;
}

.review-item:hover {
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    transition: box-shadow 0.2s ease;
}
</style>
@endsection
