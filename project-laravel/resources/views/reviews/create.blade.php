@extends('layouts.app')

@section('content')
@auth
<div class="review-page">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <!-- Header avec navigation -->
                <div class="review-header mb-4">
                    <a href="{{ route('cars.show', $car->id) }}" class="back-link">
                        <i class="fas fa-arrow-left me-2"></i>Retour à l'annonce
                    </a>
                </div>

                <!-- Carte principale -->
                <div class="review-card">
                    <div class="review-card-header">
                        <div class="header-icon">
                            <i class="fas fa-star"></i>
                        </div>
                        <h2 class="review-title">Noter le vendeur</h2>
                        <p class="review-subtitle">Partagez votre expérience pour aider d'autres acheteurs</p>
                    </div>

                    <div class="review-card-body">
                        <!-- Informations sur la voiture -->
                        <div class="car-info-section">
                            <div class="car-info-header">
                                <i class="fas fa-car me-2"></i>
                                <span>Voiture concernée</span>
                            </div>
                            <div class="car-info-content">
                                <div class="car-image">
                                    @if($car->main_image)
                                        <img src="{{ $car->main_image }}" alt="{{ $car->brand }} {{ $car->model }}">
                                    @else
                                        <div class="car-placeholder">
                                            <i class="fas fa-car"></i>
                                        </div>
                                    @endif
                                </div>
                                <div class="car-details">
                                    <h4 class="car-title">{{ $car->brand }} {{ $car->model }}</h4>
                                    <div class="seller-info">
                                        <i class="fas fa-user me-1"></i>
                                        <span>Vendeur : <strong>{{ $car->user->name }}</strong></span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <form action="{{ route('reviews.store', $car->id) }}" method="POST" class="review-form">
                            @csrf
                            
                            <!-- Note avec étoiles -->
                            <div class="rating-section">
                                <label class="rating-label">Note globale</label>
                                <div class="rating-container">
                                    <div class="stars">
                                        @for($i = 5; $i >= 1; $i--)
                                            <input type="radio" id="star{{ $i }}" name="rating" value="{{ $i }}" class="star-input" required>
                                            <label for="star{{ $i }}" class="star-label">
                                                <i class="fas fa-star"></i>
                                            </label>
                                        @endfor
                                    </div>
                                    <div class="rating-text">
                                        <span id="rating-text">Sélectionnez une note</span>
                                    </div>
                                </div>
                                @error('rating')
                                    <div class="error-message">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Commentaire -->
                            <div class="comment-section">
                                <label for="comment" class="comment-label">Commentaire (optionnel)</label>
                                <div class="comment-container">
                                    <textarea id="comment" name="comment" rows="4" 
                                              placeholder="Partagez votre expérience avec ce vendeur... Décrivez la qualité du service, la communication, la ponctualité, etc.">{{ old('comment') }}</textarea>
                                    <div class="comment-counter">
                                        <span id="char-count">0</span>/1000
                                    </div>
                                </div>
                                @error('comment')
                                    <div class="error-message">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Boutons d'action -->
                            <div class="action-buttons">
                                <button type="submit" class="btn-submit">
                                    <i class="fas fa-paper-plane me-2"></i>Publier l'avis
                                </button>
                                <a href="{{ route('cars.show', $car->id) }}" class="btn-cancel">
                                    <i class="fas fa-times me-2"></i>Annuler
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@else
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm border-0 text-center" style="border-radius: 16px; background: linear-gradient(135deg, #fff 0%, #fafafa 100%);">
                <div class="card-body py-5">
                    <i class="fas fa-lock" style="font-size: 4rem; color: #ddd; margin-bottom: 2rem;"></i>
                    <h4 class="fw-bold mb-3" style="color: #333;">Accès restreint</h4>
                    <p class="text-muted mb-4">Vous devez être connecté pour noter un vendeur.</p>
                    <div class="d-flex gap-3 justify-content-center">
                        <a href="{{ route('login') }}" class="btn btn-modern">
                            <i class="fas fa-sign-in-alt me-2"></i>Se connecter
                        </a>
                        <a href="{{ route('register') }}" class="btn btn-outline-primary">
                            <i class="fas fa-user-plus me-2"></i>Créer un compte
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endauth

<style>
/* Page principale */
.review-page {
    background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
    min-height: 100vh;
    padding: 2rem 0;
}

/* Header avec navigation */
.review-header {
    display: flex;
    justify-content: flex-start;
}

.back-link {
    display: inline-flex;
    align-items: center;
    color: #F26522;
    text-decoration: none;
    font-weight: 600;
    padding: 0.5rem 1rem;
    border-radius: 25px;
    background: rgba(242, 101, 34, 0.1);
    transition: all 0.3s ease;
}

.back-link:hover {
    background: rgba(242, 101, 34, 0.2);
    color: #F26522;
    transform: translateX(-5px);
}

/* Carte principale */
.review-card {
    background: white;
    border-radius: 24px;
    box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
    overflow: hidden;
    border: 1px solid rgba(242, 101, 34, 0.1);
}

.review-card-header {
    background: linear-gradient(135deg, #F26522 0%, #ea6500 100%);
    color: white;
    padding: 2.5rem;
    text-align: center;
    position: relative;
}

.review-card-header::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="stars" patternUnits="userSpaceOnUse" width="20" height="20"><circle cx="10" cy="10" r="1" fill="rgba(255,255,255,0.1)"/></pattern></defs><rect width="100" height="100" fill="url(%23stars)"/></svg>');
    opacity: 0.3;
}

.header-icon {
    font-size: 3rem;
    margin-bottom: 1rem;
    opacity: 0.9;
}

.review-title {
    font-size: 2.5rem;
    font-weight: 700;
    margin-bottom: 0.5rem;
    position: relative;
    z-index: 1;
}

.review-subtitle {
    font-size: 1.1rem;
    opacity: 0.9;
    margin: 0;
    position: relative;
    z-index: 1;
}

.review-card-body {
    padding: 2.5rem;
}

/* Section informations voiture */
.car-info-section {
    background: linear-gradient(135deg, #f8f9fa 0%, #ffffff 100%);
    border: 1px solid #e9ecef;
    border-radius: 16px;
    padding: 1.5rem;
    margin-bottom: 2rem;
}

.car-info-header {
    display: flex;
    align-items: center;
    color: #F26522;
    font-weight: 600;
    margin-bottom: 1rem;
    font-size: 1.1rem;
}

.car-info-content {
    display: flex;
    align-items: center;
    gap: 1.5rem;
}

.car-image {
    width: 80px;
    height: 80px;
    border-radius: 12px;
    overflow: hidden;
    flex-shrink: 0;
}

.car-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.car-placeholder {
    width: 100%;
    height: 100%;
    background: linear-gradient(135deg, #e9ecef 0%, #dee2e6 100%);
    display: flex;
    align-items: center;
    justify-content: center;
    color: #6c757d;
    font-size: 2rem;
}

.car-title {
    font-size: 1.3rem;
    font-weight: 700;
    color: #333;
    margin-bottom: 0.5rem;
}

.seller-info {
    color: #6c757d;
    font-size: 0.95rem;
}

/* Section notation */
.rating-section {
    margin-bottom: 2rem;
}

.rating-label {
    display: block;
    font-weight: 600;
    color: #333;
    margin-bottom: 1rem;
    font-size: 1.1rem;
}

.rating-container {
    text-align: center;
    background: #f8f9fa;
    padding: 2rem;
    border-radius: 16px;
    border: 2px dashed #e9ecef;
}

.stars {
    display: inline-flex;
    flex-direction: row-reverse;
    gap: 8px;
    margin-bottom: 1rem;
}

.star-input {
    display: none;
}

.star-label {
    cursor: pointer;
    font-size: 2.5rem;
    color: #ddd;
    transition: all 0.3s ease;
    filter: drop-shadow(0 2px 4px rgba(0,0,0,0.1));
}

.star-label:hover,
.star-label:hover ~ .star-label,
.star-input:checked ~ .star-label {
    color: #FFD700;
    transform: scale(1.1);
    filter: drop-shadow(0 4px 8px rgba(255, 215, 0, 0.3));
}

.rating-text {
    font-size: 1.1rem;
    color: #666;
    min-height: 30px;
    font-weight: 600;
}

/* Section commentaire */
.comment-section {
    margin-bottom: 2rem;
}

.comment-label {
    display: block;
    font-weight: 600;
    color: #333;
    margin-bottom: 1rem;
    font-size: 1.1rem;
}

.comment-container {
    position: relative;
}

.comment-container textarea {
    width: 100%;
    border: 2px solid #e9ecef;
    border-radius: 12px;
    padding: 1rem;
    font-size: 1rem;
    line-height: 1.6;
    resize: vertical;
    transition: all 0.3s ease;
    background: #f8f9fa;
}

.comment-container textarea:focus {
    outline: none;
    border-color: #F26522;
    background: white;
    box-shadow: 0 0 0 3px rgba(242, 101, 34, 0.1);
}

.comment-counter {
    position: absolute;
    bottom: 0.5rem;
    right: 1rem;
    font-size: 0.8rem;
    color: #6c757d;
    background: rgba(255, 255, 255, 0.9);
    padding: 0.2rem 0.5rem;
    border-radius: 10px;
}

/* Messages d'erreur */
.error-message {
    color: #dc3545;
    font-size: 0.9rem;
    margin-top: 0.5rem;
    padding: 0.5rem;
    background: rgba(220, 53, 69, 0.1);
    border-radius: 8px;
    border-left: 3px solid #dc3545;
}

/* Boutons d'action */
.action-buttons {
    display: flex;
    gap: 1rem;
    justify-content: center;
    flex-wrap: wrap;
}

.btn-submit {
    background: linear-gradient(45deg, #F26522 0%, #ea6500 100%);
    color: white;
    border: none;
    padding: 1rem 2rem;
    border-radius: 50px;
    font-weight: 600;
    font-size: 1rem;
    cursor: pointer;
    transition: all 0.3s ease;
    box-shadow: 0 4px 15px rgba(242, 101, 34, 0.3);
    min-width: 180px;
}

.btn-submit:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(242, 101, 34, 0.4);
    color: white;
}

.btn-cancel {
    background: transparent;
    color: #6c757d;
    border: 2px solid #e9ecef;
    padding: 1rem 2rem;
    border-radius: 50px;
    font-weight: 600;
    font-size: 1rem;
    text-decoration: none;
    transition: all 0.3s ease;
    min-width: 180px;
    text-align: center;
}

.btn-cancel:hover {
    background: #f8f9fa;
    border-color: #F26522;
    color: #F26522;
    transform: translateY(-2px);
}

/* Responsive */
@media (max-width: 768px) {
    .review-page {
        padding: 1rem 0;
    }
    
    .review-card-header {
        padding: 2rem 1.5rem;
    }
    
    .review-title {
        font-size: 2rem;
    }
    
    .review-card-body {
        padding: 1.5rem;
    }
    
    .car-info-content {
        flex-direction: column;
        text-align: center;
    }
    
    .action-buttons {
        flex-direction: column;
    }
    
    .btn-submit,
    .btn-cancel {
        width: 100%;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const starInputs = document.querySelectorAll('.star-input');
    const ratingText = document.getElementById('rating-text');
    const commentTextarea = document.getElementById('comment');
    const charCount = document.getElementById('char-count');
    
    const ratingDescriptions = {
        1: 'Très mauvais',
        2: 'Mauvais', 
        3: 'Moyen',
        4: 'Bon',
        5: 'Excellent'
    };
    
    // Gestion des étoiles
    starInputs.forEach(input => {
        input.addEventListener('change', function() {
            const rating = this.value;
            ratingText.textContent = ratingDescriptions[rating];
            
            // Animation de confirmation
            ratingText.style.transform = 'scale(1.1)';
            setTimeout(() => {
                ratingText.style.transform = 'scale(1)';
            }, 200);
        });
    });
    
    // Compteur de caractères pour le commentaire
    if (commentTextarea && charCount) {
        commentTextarea.addEventListener('input', function() {
            const length = this.value.length;
            charCount.textContent = length;
            
            // Changement de couleur selon la longueur
            if (length > 800) {
                charCount.style.color = '#dc3545';
            } else if (length > 600) {
                charCount.style.color = '#ffc107';
            } else {
                charCount.style.color = '#6c757d';
            }
        });
    }
    
    // Animation d'entrée pour la carte
    const reviewCard = document.querySelector('.review-card');
    if (reviewCard) {
        reviewCard.style.opacity = '0';
        reviewCard.style.transform = 'translateY(30px)';
        
        setTimeout(() => {
            reviewCard.style.transition = 'all 0.6s ease';
            reviewCard.style.opacity = '1';
            reviewCard.style.transform = 'translateY(0)';
        }, 100);
    }
    
    // Validation du formulaire
    const form = document.querySelector('.review-form');
    if (form) {
        form.addEventListener('submit', function(e) {
            const rating = document.querySelector('input[name="rating"]:checked');
            if (!rating) {
                e.preventDefault();
                ratingText.style.color = '#dc3545';
                ratingText.textContent = 'Veuillez sélectionner une note';
                setTimeout(() => {
                    ratingText.style.color = '#666';
                    ratingText.textContent = 'Sélectionnez une note';
                }, 2000);
            }
        });
    }
});
</script>
@endsection
