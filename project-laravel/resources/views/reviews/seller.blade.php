@extends('layouts.app')

@section('content')
<div class="seller-reviews-page">
    <div class="container mx-auto px-4 py-8">
        <!-- Header Section avec design amélioré -->
        <div class="header-section mb-8">
            <div class="flex flex-col lg:flex-row lg:justify-between lg:items-center gap-6">
                <div class="header-content">
                    <div class="badge-container mb-3">
                        <span class="seller-badge">
                            <i class="fas fa-user-tie mr-2"></i>Vendeur
                        </span>
                    </div>
                    <h1 class="page-title">Avis sur {{ $seller->name }}</h1>
                    <p class="page-subtitle">Découvrez ce que disent les autres utilisateurs</p>
                </div>
                <a href="{{ route('home') }}" class="back-button">
                    <div class="btn-icon">
                        <i class="fas fa-arrow-left"></i>
                    </div>
                    <div class="btn-content">
                        <span class="btn-title">Retour</span>
                        <span class="btn-subtitle">Page d'accueil</span>
                    </div>
                    <div class="btn-arrow">
                        <i class="fas fa-home"></i>
                    </div>
                </a>
            </div>
        </div>

        <!-- Statistiques du vendeur avec design amélioré -->
        <div class="stats-section mb-8">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- Carte de notation -->
                <div class="rating-card">
                    <div class="card-icon">
                        <i class="fas fa-star"></i>
                    </div>
                    <div class="rating-stars">
                        @if($seller->average_rating)
                            @for($i = 1; $i <= 5; $i++)
                                <i class="star {{ $i <= $seller->average_rating ? 'filled' : 'empty' }}"></i>
                            @endfor
                        @else
                            @for($i = 1; $i <= 5; $i++)
                                <i class="star empty"></i>
                            @endfor
                        @endif
                    </div>
                    <div class="rating-score">
                        @if($seller->average_rating)
                            <span class="score">{{ $seller->average_rating }}/5</span>
                        @else
                            <span class="score no-rating">Aucune note</span>
                        @endif
                    </div>
                    <div class="rating-count">
                        <span class="count">{{ $seller->reviews_count }}</span>
                        <span class="label">avis</span>
                    </div>
                </div>

                <!-- Carte d'informations du vendeur -->
                <div class="info-card lg:col-span-2">
                    <div class="card-header">
                        <i class="fas fa-info-circle mr-3"></i>
                        <h3>Informations du vendeur</h3>
                    </div>
                    <div class="info-grid">
                        <div class="info-item">
                            <div class="info-label">Nom</div>
                            <div class="info-value">{{ $seller->name }}</div>
                        </div>
                        <div class="info-item">
                            <div class="info-label">Membre depuis</div>
                            <div class="info-value">{{ $seller->created_at->format('d/m/Y') }}</div>
                        </div>
                        <div class="info-item">
                            <div class="info-label">Voitures publiées</div>
                            <div class="info-value">{{ $seller->cars->count() }}</div>
                        </div>
                        <div class="info-item">
                            <div class="info-label">Abonnés</div>
                            <div class="info-value">{{ $seller->followers_count }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Section des avis avec design amélioré -->
        <div class="reviews-section">
            <div class="reviews-header">
                <div class="header-icon">
                    <i class="fas fa-comments"></i>
                </div>
                <h2>Tous les avis</h2>
                <span class="review-count">{{ $reviews->count() }} avis</span>
            </div>

            <div class="reviews-container">
                @if($reviews->count() > 0)
                    @foreach($reviews as $review)
                        <div class="review-card">
                            <div class="review-header">
                                <div class="reviewer-info">
                                    <div class="avatar">
                                        <i class="fas fa-user"></i>
                                    </div>
                                    <div class="reviewer-details">
                                        <h4 class="reviewer-name">{{ $review->reviewer->name }}</h4>
                                        <div class="review-rating">
                                            @for($i = 1; $i <= 5; $i++)
                                                <i class="star {{ $i <= $review->rating ? 'filled' : 'empty' }}"></i>
                                            @endfor
                                            <span class="rating-text">{{ $review->rating }}/5</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="review-date">
                                    <i class="fas fa-calendar-alt mr-2"></i>
                                    {{ $review->created_at->format('d/m/Y') }}
                                </div>
                            </div>
                            
                            @if($review->car)
                                <div class="car-info">
                                    <i class="fas fa-car mr-2"></i>
                                    <span>Avis pour : <strong>{{ $review->car->brand }} {{ $review->car->model }}</strong></span>
                                </div>
                            @endif
                            
                            @if($review->comment)
                                <div class="review-comment">
                                    <p>{{ $review->comment }}</p>
                                </div>
                            @else
                                <div class="no-comment">
                                    <em>Aucun commentaire</em>
                                </div>
                            @endif
                        </div>
                    @endforeach
                    
                    <!-- Pagination améliorée -->
                    @if($reviews->hasPages())
                        <div class="pagination-container">
                            {{ $reviews->links() }}
                        </div>
                    @endif
                @else
                    <div class="empty-state">
                        <div class="empty-icon">
                            <i class="fas fa-comments"></i>
                        </div>
                        <h3>Aucun avis pour le moment</h3>
                        <p>Soyez le premier à laisser un avis sur ce vendeur !</p>
                        @auth
                            <a href="{{ route('home') }}" class="cta-button">
                                <i class="fas fa-car mr-2"></i>Voir les voitures de ce vendeur
                            </a>
                        @else
                            <div class="auth-actions">
                                <p class="auth-text">Connectez-vous pour noter ce vendeur</p>
                                <div class="auth-buttons">
                                    <a href="{{ route('login') }}" class="btn-login">
                                        <i class="fas fa-sign-in-alt mr-2"></i>Se connecter
                                    </a>
                                    <a href="{{ route('register') }}" class="btn-register">
                                        <i class="fas fa-user-plus mr-2"></i>Créer un compte
                                    </a>
                                </div>
                            </div>
                        @endauth
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

<style>
.seller-reviews-page {
    background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
    min-height: 100vh;
}

/* Header Section */
.header-section {
    background: linear-gradient(135deg, #ffffff 0%, #f1f5f9 100%);
    border-radius: 20px;
    padding: 2rem;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
}

.badge-container {
    display: inline-block;
}

.seller-badge {
    background: linear-gradient(135deg, #f97316 0%, #ea580c 100%);
    color: white;
    padding: 0.5rem 1rem;
    border-radius: 25px;
    font-size: 0.875rem;
    font-weight: 600;
    display: inline-flex;
    align-items: center;
    box-shadow: 0 2px 10px rgba(249, 115, 22, 0.3);
}

.page-title {
    font-size: 2.5rem;
    font-weight: 800;
    color: #1e293b;
    margin-bottom: 0.5rem;
    line-height: 1.2;
}

.page-subtitle {
    font-size: 1.125rem;
    color: #64748b;
    margin: 0;
}

.back-button {
    background: linear-gradient(135deg, #64748b 0%, #475569 100%);
    color: white;
    padding: 0.5rem 1rem;
    border-radius: 14px;
    text-decoration: none;
    font-weight: 600;
    transition: all 0.3s cubic-bezier(0.25, 0.46, 0.45, 0.94);
    box-shadow: 0 4px 15px rgba(100, 116, 139, 0.3);
    display: flex;
    align-items: center;
    border: none;
    position: relative;
    overflow: hidden;
    min-height: 46px;
}

.back-button::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
    transition: left 0.5s;
}

.back-button:hover::before {
    left: 100%;
}

.back-button:hover {
    transform: translateY(-3px);
    box-shadow: 0 8px 25px rgba(100, 116, 139, 0.4);
    color: white;
    text-decoration: none;
}

.back-button .btn-icon {
    width: 28px;
    height: 28px;
    border-radius: 8px;
    background: rgba(255, 255, 255, 0.2);
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 0.9rem;
    flex-shrink: 0;
}

.back-button .btn-content {
    flex: 1;
    text-align: left;
}

.back-button .btn-title {
    display: block;
    font-weight: 700;
    font-size: 0.9rem;
    color: white;
    margin-bottom: 0.1rem;
    line-height: 1.2;
}

.back-button .btn-subtitle {
    display: block;
    font-size: 0.7rem;
    color: rgba(255, 255, 255, 0.9);
    font-weight: 500;
    line-height: 1.2;
}

.back-button .btn-arrow {
    width: 22px;
    height: 22px;
    border-radius: 50%;
    background: rgba(255, 255, 255, 0.2);
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 0.7rem;
    transition: all 0.3s ease;
    flex-shrink: 0;
}

.back-button:hover .btn-arrow {
    background: rgba(255, 255, 255, 0.3);
    transform: scale(1.1);
}

/* Stats Section */
.stats-section {
    margin-bottom: 2rem;
}

.rating-card {
    background: linear-gradient(135deg, #ffffff 0%, #f8fafc 100%);
    border-radius: 20px;
    padding: 2rem;
    text-align: center;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
    transition: all 0.3s ease;
    border: 1px solid rgba(255, 255, 255, 0.8);
}

.rating-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 30px rgba(0, 0, 0, 0.12);
}

.card-icon {
    width: 60px;
    height: 60px;
    background: linear-gradient(135deg, #fbbf24 0%, #f59e0b 100%);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 1rem;
    color: white;
    font-size: 1.5rem;
    box-shadow: 0 4px 15px rgba(251, 191, 36, 0.4);
}

.rating-stars {
    margin-bottom: 1rem;
}

.star {
    font-size: 1.25rem;
    margin: 0 0.125rem;
    transition: all 0.3s ease;
}

.star.filled {
    color: #fbbf24;
    text-shadow: 0 0 10px rgba(251, 191, 36, 0.5);
}

.star.empty {
    color: #cbd5e1;
}

.rating-score {
    margin-bottom: 0.5rem;
}

.score {
    font-size: 2rem;
    font-weight: 800;
    color: #1e293b;
}

.score.no-rating {
    color: #94a3b8;
    font-size: 1.5rem;
}

.rating-count {
    display: flex;
    flex-direction: column;
    align-items: center;
}

.count {
    font-size: 1.5rem;
    font-weight: 700;
    color: #f97316;
}

.label {
    font-size: 0.875rem;
    color: #64748b;
    text-transform: uppercase;
    letter-spacing: 0.05em;
}

.info-card {
    background: linear-gradient(135deg, #ffffff 0%, #f8fafc 100%);
    border-radius: 20px;
    padding: 2rem;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
    border: 1px solid rgba(255, 255, 255, 0.8);
}

.card-header {
    display: flex;
    align-items: center;
    margin-bottom: 1.5rem;
    color: #f97316;
    font-size: 1.25rem;
}

.card-header h3 {
    margin: 0;
    font-weight: 700;
    color: #1e293b;
}

.info-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 1.5rem;
}

.info-item {
    padding: 1rem;
    background: rgba(248, 250, 252, 0.8);
    border-radius: 12px;
    border: 1px solid rgba(226, 232, 240, 0.8);
}

.info-label {
    font-size: 0.875rem;
    color: #64748b;
    text-transform: uppercase;
    letter-spacing: 0.05em;
    margin-bottom: 0.5rem;
    font-weight: 600;
}

.info-value {
    font-size: 1.125rem;
    font-weight: 700;
    color: #1e293b;
}

/* Reviews Section */
.reviews-section {
    background: linear-gradient(135deg, #ffffff 0%, #f8fafc 100%);
    border-radius: 20px;
    padding: 2rem;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
    border: 1px solid rgba(255, 255, 255, 0.8);
}

.reviews-header {
    display: flex;
    align-items: center;
    margin-bottom: 2rem;
    padding-bottom: 1rem;
    border-bottom: 2px solid #e2e8f0;
}

.header-icon {
    width: 50px;
    height: 50px;
    background: linear-gradient(135deg, #f97316 0%, #ea580c 100%);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 1.25rem;
    margin-right: 1rem;
    box-shadow: 0 4px 15px rgba(249, 115, 22, 0.4);
}

.reviews-header h2 {
    margin: 0;
    font-size: 1.5rem;
    font-weight: 700;
    color: #1e293b;
    flex: 1;
}

.review-count {
    background: linear-gradient(135deg, #e2e8f0 0%, #cbd5e1 100%);
    color: #475569;
    padding: 0.5rem 1rem;
    border-radius: 20px;
    font-size: 0.875rem;
    font-weight: 600;
}

.reviews-container {
    space-y: 1.5rem;
}

.review-card {
    background: white;
    border-radius: 16px;
    padding: 1.5rem;
    margin-bottom: 1.5rem;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
    border: 1px solid #e2e8f0;
    transition: all 0.3s ease;
}

.review-card:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
    border-color: #f97316;
}

.review-header {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    margin-bottom: 1rem;
}

.reviewer-info {
    display: flex;
    align-items: center;
}

.avatar {
    width: 40px;
    height: 40px;
    background: linear-gradient(135deg, #e2e8f0 0%, #cbd5e1 100%);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #64748b;
    margin-right: 1rem;
}

.reviewer-name {
    margin: 0 0 0.25rem 0;
    font-weight: 700;
    color: #1e293b;
}

.review-rating {
    display: flex;
    align-items: center;
}

.rating-text {
    margin-left: 0.5rem;
    color: #64748b;
    font-size: 0.875rem;
}

.review-date {
    color: #94a3b8;
    font-size: 0.875rem;
    display: flex;
    align-items: center;
}

.car-info {
    background: rgba(248, 250, 252, 0.8);
    padding: 0.75rem 1rem;
    border-radius: 8px;
    margin-bottom: 1rem;
    color: #475569;
    font-size: 0.875rem;
    border-left: 3px solid #f97316;
}

.review-comment {
    color: #374151;
    line-height: 1.6;
    margin: 0;
}

.no-comment {
    color: #94a3b8;
    font-style: italic;
    margin: 0;
}

/* Empty State */
.empty-state {
    text-align: center;
    padding: 3rem 2rem;
}

.empty-icon {
    width: 80px;
    height: 80px;
    background: linear-gradient(135deg, #e2e8f0 0%, #cbd5e1 100%);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 1.5rem;
    color: #94a3b8;
    font-size: 2rem;
}

.empty-state h3 {
    color: #475569;
    margin-bottom: 0.5rem;
    font-weight: 600;
}

.empty-state p {
    color: #64748b;
    margin-bottom: 2rem;
}

.cta-button {
    background: linear-gradient(135deg, #f97316 0%, #ea580c 100%);
    color: white;
    padding: 1rem 2rem;
    border-radius: 12px;
    text-decoration: none;
    font-weight: 600;
    display: inline-block;
    transition: all 0.3s ease;
    box-shadow: 0 4px 15px rgba(249, 115, 22, 0.4);
}

.cta-button:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(249, 115, 22, 0.5);
    color: white;
    text-decoration: none;
}

.auth-actions {
    margin-top: 1.5rem;
}

.auth-text {
    color: #64748b;
    margin-bottom: 1rem;
    font-size: 0.875rem;
}

.auth-buttons {
    display: flex;
    gap: 1rem;
    justify-content: center;
    flex-wrap: wrap;
}

.btn-login, .btn-register {
    padding: 0.75rem 1.5rem;
    border-radius: 8px;
    text-decoration: none;
    font-weight: 600;
    transition: all 0.3s ease;
}

.btn-login {
    background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
    color: white;
    box-shadow: 0 2px 10px rgba(59, 130, 246, 0.3);
}

.btn-register {
    background: linear-gradient(135deg, #10b981 0%, #059669 100%);
    color: white;
    box-shadow: 0 2px 10px rgba(16, 185, 129, 0.3);
}

.btn-login:hover, .btn-register:hover {
    transform: translateY(-2px);
    color: white;
    text-decoration: none;
}

.btn-login:hover {
    box-shadow: 0 4px 15px rgba(59, 130, 246, 0.4);
}

.btn-register:hover {
    box-shadow: 0 4px 15px rgba(16, 185, 129, 0.4);
}

/* Pagination */
.pagination-container {
    margin-top: 2rem;
    display: flex;
    justify-content: center;
}

/* Responsive Design */
@media (max-width: 768px) {
    .header-section {
        padding: 1.5rem;
    }
    
    .page-title {
        font-size: 2rem;
    }
    
    .stats-section {
        grid-template-columns: 1fr;
    }
    
    .info-grid {
        grid-template-columns: 1fr;
    }
    
    .review-header {
        flex-direction: column;
        align-items: flex-start;
        gap: 1rem;
    }
    
    .auth-buttons {
        flex-direction: column;
        align-items: center;
    }
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

.rating-card, .info-card, .review-card {
    animation: fadeInUp 0.6s ease-out;
}

.rating-card:nth-child(2) {
    animation-delay: 0.1s;
}

.rating-card:nth-child(3) {
    animation-delay: 0.2s;
}

.review-card:nth-child(1) {
    animation-delay: 0.1s;
}

.review-card:nth-child(2) {
    animation-delay: 0.2s;
}

.review-card:nth-child(3) {
    animation-delay: 0.3s;
}
</style>
@endsection
