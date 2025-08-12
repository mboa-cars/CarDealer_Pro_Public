<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <nav class="navbar navbar-expand-lg px-4 py-3" style="background: white; border-bottom: 1px solid #f0f0f0;">
        <div class="container">
            <a class="navbar-brand logo d-flex align-items-center" href="/" style="text-decoration: none; color: #333;">
                <span class="logo-icon" style="font-size:2rem;margin-right:8px; color: #F26522; transition: all 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94);">&#9728;</span> 
                <span class="logo-text" style="font-weight: 600; font-size: 1.5rem; transition: all 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94);">Logoipsum</span>
            </a>
            
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse" id="navbarNav">
                <div class="ms-auto nav-btns d-flex align-items-center">
                    @guest
                        <a href="{{ route('cars.create') }}" class="btn btn-orange-outline me-2 animated-btn" style="background: white; color: #F26522; border: 2px solid #F26522; border-radius: 8px; padding: 10px 20px; font-weight: 600; text-decoration: none; transition: all 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94); position: relative; overflow: hidden;">
                            <i class="fas fa-plus me-2 btn-icon"></i>Add new Car
                            <div class="btn-ripple"></div>
                        </a>
                        <a href="{{ route('favorites') }}" class="btn btn-orange-outline me-2 animated-btn" style="background: white; color: #F26522; border: 2px solid #F26522; border-radius: 8px; padding: 10px 20px; font-weight: 600; text-decoration: none; transition: all 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94); position: relative; overflow: hidden;">
                            <i class="fas fa-heart me-2 btn-icon"></i>Favorites
                            <div class="btn-ripple"></div>
                        </a>
                        <a href="{{ route('register') }}" class="btn btn-orange me-2 animated-btn" style="background: #F26522; color: white; border: none; border-radius: 8px; padding: 10px 20px; font-weight: 600; text-decoration: none; transition: all 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94); position: relative; overflow: hidden;">
                            <i class="fas fa-user-plus me-2 btn-icon"></i>Signup
                            <div class="btn-ripple"></div>
                        </a>
                        <a href="{{ route('login') }}" class="btn btn-link ms-2 animated-btn" style="color: #F26522; text-decoration: none; font-weight: 600; padding: 10px 20px; transition: all 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94); position: relative; overflow: hidden;">
                            <i class="fas fa-sign-in-alt me-2 btn-icon"></i>Login
                            <div class="btn-ripple"></div>
                        </a>
                    @else
                        <a href="{{ route('cars.create') }}" class="btn btn-orange-outline me-2 animated-btn" style="background: white; color: #F26522; border: 2px solid #F26522; border-radius: 8px; padding: 10px 20px; font-weight: 600; text-decoration: none; transition: all 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94); position: relative; overflow: hidden;">
                            <i class="fas fa-plus me-2 btn-icon"></i>Add new Car
                            <div class="btn-ripple"></div>
                        </a>
                        
                        <div class="dropdown ms-2">
                            <button class="btn btn-orange dropdown-toggle animated-btn" type="button" data-bs-toggle="dropdown" style="background: #F26522; color: white; border: none; border-radius: 8px; padding: 10px 20px; font-weight: 600; transition: all 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94); position: relative; overflow: hidden;">
                                <i class="fas fa-user me-2 btn-icon"></i>Welcome, {{ Auth::user()->name }}
                                <div class="btn-ripple"></div>
                            </button>
                            <ul class="dropdown-menu animated-dropdown dropdown-menu-center" style="left: 50% !important; transform: translateX(-50%) !important; min-width: 200px; border-radius: 12px; border: 1px solid rgba(242, 101, 34, 0.2); box-shadow: 0 8px 32px rgba(0, 0, 0, 0.15);">
                                <li><a class="dropdown-item animated-item" href="{{ route('cars.my-cars') }}">
                                    <i class="fas fa-car me-2"></i>My Cars
                                </a></li>
                                <li><a class="dropdown-item animated-item" href="{{ route('favorites') }}">
                                    <i class="fas fa-heart me-2"></i>Favorites
                                </a></li>
                                <li><a class="dropdown-item animated-item" href="{{ route('profile.edit') }}">
                                    <i class="fas fa-user-cog me-2"></i>Profile
                                </a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <form method="POST" action="{{ route('logout') }}" class="d-inline">
                                        @csrf
                                        <button type="submit" class="dropdown-item text-danger animated-item">
                                            <i class="fas fa-sign-out-alt me-2"></i>Logout
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    @endguest
                </div>
            </div>
        </div>
    </nav>
    
    <div class="container my-4">
        @yield('content')
    </div>

    <!-- Bouton de bookmark flottant -->
    <x-bookmark-button />

    <!-- Footer moderne -->
    <footer class="footer-modern" style="background: linear-gradient(135deg, #1a1a1a 0%, #2d2d2d 100%); color: white; margin-top: 80px; position: relative; overflow: hidden;">
        <!-- Effet de fond animé -->
        <div class="footer-bg-pattern" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; opacity: 0.05; background-image: radial-gradient(circle at 25% 25%, #F26522 0%, transparent 50%), radial-gradient(circle at 75% 75%, #F26522 0%, transparent 50%); animation: footerFloat 20s ease-in-out infinite;"></div>
        
        <div class="container py-5">
            <div class="row">
                <!-- Section Logo et Description -->
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="footer-brand-section">
                        <div class="footer-logo d-flex align-items-center mb-3">
                            <span class="footer-logo-icon" style="font-size: 2.5rem; margin-right: 12px; color: #F26522; animation: footerLogoFloat 6s ease-in-out infinite;">&#9728;</span>
                            <span class="footer-logo-text" style="font-weight: 700; font-size: 1.8rem; color: white;">Logoipsum</span>
                        </div>
                        <p class="footer-description" style="color: #b0b0b0; line-height: 1.6; margin-bottom: 20px;">
                            Votre plateforme de confiance pour acheter, vendre et découvrir des véhicules d'exception. 
                            Rejoignez notre communauté passionnée d'automobiles.
                        </p>
                        <div class="footer-social-links">
                            <a href="#" class="social-link" style="display: inline-block; width: 40px; height: 40px; background: rgba(242, 101, 34, 0.1); border: 2px solid rgba(242, 101, 34, 0.3); border-radius: 50%; text-align: center; line-height: 36px; color: #F26522; margin-right: 12px; transition: all 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94); text-decoration: none;">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                            <a href="#" class="social-link" style="display: inline-block; width: 40px; height: 40px; background: rgba(242, 101, 34, 0.1); border: 2px solid rgba(242, 101, 34, 0.3); border-radius: 50%; text-align: center; line-height: 36px; color: #F26522; margin-right: 12px; transition: all 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94); text-decoration: none;">
                                <i class="fab fa-twitter"></i>
                            </a>
                            <a href="#" class="social-link" style="display: inline-block; width: 40px; height: 40px; background: rgba(242, 101, 34, 0.1); border: 2px solid rgba(242, 101, 34, 0.3); border-radius: 50%; text-align: center; line-height: 36px; color: #F26522; margin-right: 12px; transition: all 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94); text-decoration: none;">
                                <i class="fab fa-instagram"></i>
                            </a>
                            <a href="#" class="social-link" style="display: inline-block; width: 40px; height: 40px; background: rgba(242, 101, 34, 0.1); border: 2px solid rgba(242, 101, 34, 0.3); border-radius: 50%; text-align: center; line-height: 36px; color: #F26522; transition: all 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94); text-decoration: none;">
                                <i class="fab fa-linkedin-in"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Section Liens Rapides -->
                <div class="col-lg-2 col-md-6 mb-4">
                    <h5 class="footer-section-title" style="color: white; font-weight: 600; margin-bottom: 20px; position: relative;">
                        Liens Rapides
                        <div class="title-underline" style="position: absolute; bottom: -8px; left: 0; width: 40px; height: 3px; background: linear-gradient(90deg, #F26522, #ea6500); border-radius: 2px;"></div>
                    </h5>
                    <ul class="footer-links-list" style="list-style: none; padding: 0; margin: 0;">
                        <li class="footer-link-item" style="margin-bottom: 12px;">
                            <a href="{{ route('cars.index') }}" class="footer-link" style="color: #b0b0b0; text-decoration: none; transition: all 0.3s ease; display: flex; align-items: center;">
                                <i class="fas fa-car me-2" style="color: #F26522; width: 16px;"></i>
                                Voir les voitures
                            </a>
                        </li>
                        <li class="footer-link-item" style="margin-bottom: 12px;">
                            <a href="{{ route('cars.create') }}" class="footer-link" style="color: #b0b0b0; text-decoration: none; transition: all 0.3s ease; display: flex; align-items: center;">
                                <i class="fas fa-plus me-2" style="color: #F26522; width: 16px;"></i>
                                Ajouter une voiture
                            </a>
                        </li>
                        <li class="footer-link-item" style="margin-bottom: 12px;">
                            <a href="{{ route('favorites') }}" class="footer-link" style="color: #b0b0b0; text-decoration: none; transition: all 0.3s ease; display: flex; align-items: center;">
                                <i class="fas fa-heart me-2" style="color: #F26522; width: 16px;"></i>
                                Mes favoris
                            </a>
                        </li>
                        <li class="footer-link-item" style="margin-bottom: 12px;">
                            <a href="{{ route('profile.edit') }}" class="footer-link" style="color: #b0b0b0; text-decoration: none; transition: all 0.3s ease; display: flex; align-items: center;">
                                <i class="fas fa-user me-2" style="color: #F26522; width: 16px;"></i>
                                Mon profil
                            </a>
                        </li>
                    </ul>
                </div>

                <!-- Section Support -->
                <div class="col-lg-3 col-md-6 mb-4">
                    <h5 class="footer-section-title" style="color: white; font-weight: 600; margin-bottom: 20px; position: relative;">
                        Support
                        <div class="title-underline" style="position: absolute; bottom: -8px; left: 0; width: 40px; height: 3px; background: linear-gradient(90deg, #F26522, #ea6500); border-radius: 2px;"></div>
                    </h5>
                    <ul class="footer-links-list" style="list-style: none; padding: 0; margin: 0;">
                        <li class="footer-link-item" style="margin-bottom: 12px;">
                            <a href="#" class="footer-link" style="color: #b0b0b0; text-decoration: none; transition: all 0.3s ease; display: flex; align-items: center;">
                                <i class="fas fa-question-circle me-2" style="color: #F26522; width: 16px;"></i>
                                Centre d'aide
                            </a>
                        </li>
                        <li class="footer-link-item" style="margin-bottom: 12px;">
                            <a href="#" class="footer-link" style="color: #b0b0b0; text-decoration: none; transition: all 0.3s ease; display: flex; align-items: center;">
                                <i class="fas fa-envelope me-2" style="color: #F26522; width: 16px;"></i>
                                Contactez-nous
                            </a>
                        </li>
                        <li class="footer-link-item" style="margin-bottom: 12px;">
                            <a href="#" class="footer-link" style="color: #b0b0b0; text-decoration: none; transition: all 0.3s ease; display: flex; align-items: center;">
                                <i class="fas fa-shield-alt me-2" style="color: #F26522; width: 16px;"></i>
                                Politique de confidentialité
                            </a>
                        </li>
                        <li class="footer-link-item" style="margin-bottom: 12px;">
                            <a href="#" class="footer-link" style="color: #b0b0b0; text-decoration: none; transition: all 0.3s ease; display: flex; align-items: center;">
                                <i class="fas fa-file-contract me-2" style="color: #F26522; width: 16px;"></i>
                                Conditions d'utilisation
                            </a>
                        </li>
                    </ul>
                </div>

                <!-- Section Newsletter -->
                <div class="col-lg-3 col-md-6 mb-4">
                    <h5 class="footer-section-title" style="color: white; font-weight: 600; margin-bottom: 20px; position: relative;">
                        Newsletter
                        <div class="title-underline" style="position: absolute; bottom: -8px; left: 0; width: 40px; height: 3px; background: linear-gradient(90deg, #F26522, #ea6500); border-radius: 2px;"></div>
                    </h5>
                    <p class="footer-newsletter-text" style="color: #b0b0b0; margin-bottom: 20px; line-height: 1.6;">
                        Restez informé des dernières offres et nouveautés de notre plateforme.
                    </p>
                    <div class="footer-newsletter-form">
                        <div class="input-group">
                            <input type="email" class="form-control" placeholder="Votre email" style="background: rgba(255, 255, 255, 0.1); border: 1px solid rgba(242, 101, 34, 0.3); color: white; border-radius: 8px 0 0 8px; padding: 12px 16px;">
                            <button class="btn" type="button" style="background: #F26522; color: white; border: none; border-radius: 0 8px 8px 0; padding: 12px 20px; font-weight: 600; transition: all 0.3s ease;">
                                <i class="fas fa-paper-plane"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Barre de copyright -->
        <div class="footer-bottom" style="background: rgba(0, 0, 0, 0.3); padding: 20px 0; margin-top: 40px;">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <p class="footer-copyright" style="color: #b0b0b0; margin: 0; font-size: 0.9rem;">
                            © 2024 Logoipsum. Tous droits réservés. Conçu avec 
                            <i class="fas fa-heart" style="color: #F26522; margin: 0 4px;"></i> 
                            pour les passionnés d'automobiles.
                        </p>
                    </div>
                    <div class="col-md-6 text-md-end">
                        <div class="footer-bottom-links">
                            <a href="#" class="footer-bottom-link" style="color: #b0b0b0; text-decoration: none; margin-left: 20px; font-size: 0.9rem; transition: all 0.3s ease;">Mentions légales</a>
                            <a href="#" class="footer-bottom-link" style="color: #b0b0b0; text-decoration: none; margin-left: 20px; font-size: 0.9rem; transition: all 0.3s ease;">Cookies</a>
                            <a href="#" class="footer-bottom-link" style="color: #b0b0b0; text-decoration: none; margin-left: 20px; font-size: 0.9rem; transition: all 0.3s ease;">Sitemap</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <style>
    /* Logo Animations */
    .logo {
        transition: all 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94);
    }

    .logo-icon {
        animation: logoFloat 4s ease-in-out infinite, logoRotate 12s linear infinite;
        display: inline-block;
    }

    .logo-text {
        transition: all 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94);
        position: relative;
    }

    .logo-text::after {
        content: '';
        position: absolute;
        bottom: -2px;
        left: 0;
        width: 0;
        height: 2px;
        background: linear-gradient(90deg, #F26522, #ea6500);
        transition: width 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94);
    }

    .logo:hover .logo-icon {
        transform: scale(1.2) rotate(8deg);
        color: #ea6500 !important;
    }

    .logo:hover .logo-text {
        color: #F26522 !important;
        transform: translateX(5px);
    }

    .logo:hover .logo-text::after {
        width: 100%;
    }

    @keyframes logoFloat {
        0%, 100% { 
            transform: translateY(0px) rotate(0deg); 
        }
        50% { 
            transform: translateY(-3px) rotate(2deg); 
        }
    }

    @keyframes logoRotate {
        from { transform: rotate(0deg); }
        to { transform: rotate(360deg); }
    }

    /* Button Animations */
    .animated-btn {
        transition: all 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94);
        position: relative;
        overflow: hidden;
        animation: buttonAppear 0.8s cubic-bezier(0.25, 0.46, 0.45, 0.94);
        transform-origin: center;
    }

    .animated-btn::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255,255,255,0.3), transparent);
        transition: left 0.8s cubic-bezier(0.25, 0.46, 0.45, 0.94);
    }

    .animated-btn:hover::before {
        left: 100%;
    }

    .animated-btn:hover {
        transform: translateY(-3px) scale(1.05);
        box-shadow: 0 8px 25px rgba(242, 101, 34, 0.4);
    }

    .animated-btn:active {
        transform: translateY(-1px) scale(1.02);
        transition: all 0.1s ease;
    }

    .btn-icon {
        transition: all 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94);
        position: relative;
        z-index: 2;
    }

    .animated-btn:hover .btn-icon {
        transform: scale(1.2) rotate(5deg);
    }

    /* Button Ripple Effect */
    .btn-ripple {
        position: absolute;
        top: 50%;
        left: 50%;
        width: 0;
        height: 0;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.3);
        transform: translate(-50%, -50%);
        transition: all 0.6s cubic-bezier(0.25, 0.46, 0.45, 0.94);
        pointer-events: none;
    }

    .animated-btn:hover .btn-ripple {
        width: 300px;
        height: 300px;
        opacity: 0;
    }

    @keyframes buttonAppear {
        from {
            opacity: 0;
            transform: translateY(20px) scale(0.8);
        }
        to {
            opacity: 1;
            transform: translateY(0) scale(1);
        }
    }

    /* Dropdown Animations */
    .animated-dropdown {
        animation: dropdownAppear 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94);
    }

    .dropdown-menu-center {
        left: 50% !important;
        transform: translateX(-50%) !important;
        min-width: 200px;
        border-radius: 12px;
        border: 1px solid rgba(242, 101, 34, 0.2);
        box-shadow: 0 8px 32px rgba(0, 0, 0, 0.15);
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(10px);
        -webkit-backdrop-filter: blur(10px);
    }

    @keyframes dropdownAppear {
        from {
            opacity: 0;
            transform: translateY(-10px) scale(0.95) translateX(-50%);
        }
        to {
            opacity: 1;
            transform: translateY(0) scale(1) translateX(-50%);
        }
    }

    .animated-item {
        transition: all 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94);
        position: relative;
        overflow: hidden;
        transform-origin: left center;
        padding: 12px 16px;
        border-radius: 8px;
        margin: 2px 8px;
    }

    .animated-item::before {
        content: '';
        position: absolute;
        left: -100%;
        top: 0;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(242, 101, 34, 0.1), transparent);
        transition: left 0.6s cubic-bezier(0.25, 0.46, 0.45, 0.94);
    }

    .animated-item:hover::before {
        left: 100%;
    }

    .animated-item:hover {
        background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
        color: #F26522;
        transform: translateX(8px) scale(1.02);
        box-shadow: 0 4px 15px rgba(242, 101, 34, 0.1);
    }

    .animated-item i {
        transition: all 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94);
        width: 16px;
        text-align: center;
    }

    .animated-item:hover i {
        transform: scale(1.2) rotate(5deg);
    }

    /* Dropdown divider styling */
    .dropdown-divider {
        margin: 8px 16px;
        border-color: rgba(242, 101, 34, 0.2);
    }

    /* Stagger animation for buttons */
    .animated-btn:nth-child(1) {
        animation-delay: 0.1s;
    }

    .animated-btn:nth-child(2) {
        animation-delay: 0.2s;
    }

    .animated-btn:nth-child(3) {
        animation-delay: 0.3s;
    }

    /* Loading animation for logo on page load */
    @keyframes logoLoad {
        0% {
            opacity: 0;
            transform: scale(0.5) rotate(-180deg);
        }
        50% {
            opacity: 0.7;
            transform: scale(1.1) rotate(-90deg);
        }
        100% {
            opacity: 1;
            transform: scale(1) rotate(0deg);
        }
    }

    .logo-icon {
        animation: logoLoad 1s cubic-bezier(0.25, 0.46, 0.45, 0.94), logoFloat 4s ease-in-out infinite 1s, logoRotate 12s linear infinite 1s;
    }

    /* Enhanced hover effects for better accessibility */
    @media (hover: hover) {
        .animated-btn:hover {
            transform: translateY(-3px) scale(1.05);
        }
        
        .logo:hover .logo-icon {
            transform: scale(1.2) rotate(8deg);
        }
    }

    /* Reduced motion for users who prefer it */
    @media (prefers-reduced-motion: reduce) {
        .logo-icon,
        .animated-btn,
        .animated-item {
            animation: none;
            transition: none;
        }
    }

    /* Responsive adjustments */
    @media (max-width: 768px) {
        .animated-btn {
            padding: 8px 16px !important;
            font-size: 0.9rem;
        }
        
        .logo-icon {
            font-size: 1.5rem !important;
        }
        
        .logo-text {
            font-size: 1.2rem !important;
        }
    }

    /* Footer Styles */
    .footer-modern {
        position: relative;
        overflow: hidden;
    }

    /* Footer Background Animation */
    @keyframes footerFloat {
        0%, 100% { 
            transform: translateY(0px) scale(1); 
            opacity: 0.05;
        }
        50% { 
            transform: translateY(-10px) scale(1.1); 
            opacity: 0.08;
        }
    }

    /* Footer Logo Animation */
    @keyframes footerLogoFloat {
        0%, 100% { 
            transform: translateY(0px) rotate(0deg); 
        }
        50% { 
            transform: translateY(-5px) rotate(5deg); 
        }
    }

    /* Footer Social Links Hover Effects */
    .social-link:hover {
        transform: translateY(-3px) scale(1.1);
        background: rgba(242, 101, 34, 0.2) !important;
        border-color: #F26522 !important;
        box-shadow: 0 8px 25px rgba(242, 101, 34, 0.3);
    }

    .social-link:hover i {
        transform: scale(1.2) rotate(5deg);
    }

    /* Footer Links Hover Effects */
    .footer-link:hover {
        color: #F26522 !important;
        transform: translateX(8px);
    }

    .footer-link:hover i {
        transform: scale(1.2) rotate(5deg);
    }

    /* Footer Section Titles Animation */
    .footer-section-title {
        transition: all 0.3s ease;
    }

    .footer-section-title:hover .title-underline {
        width: 60px !important;
        background: linear-gradient(90deg, #F26522, #ea6500, #F26522) !important;
    }

    /* Footer Newsletter Form */
    .footer-newsletter-form .form-control:focus {
        background: rgba(255, 255, 255, 0.15) !important;
        border-color: #F26522 !important;
        box-shadow: 0 0 0 0.2rem rgba(242, 101, 34, 0.25);
        outline: none;
    }

    .footer-newsletter-form .btn:hover {
        background: #ea6500 !important;
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(242, 101, 34, 0.4);
    }

    /* Footer Bottom Links */
    .footer-bottom-link:hover {
        color: #F26522 !important;
        text-decoration: underline;
    }

    /* Footer Responsive */
    @media (max-width: 768px) {
        .footer-logo-icon {
            font-size: 2rem !important;
        }
        
        .footer-logo-text {
            font-size: 1.5rem !important;
        }
        
        .footer-bottom-links {
            text-align: center !important;
            margin-top: 15px;
        }
        
        .footer-bottom-link {
            margin: 0 10px !important;
        }
    }

    /* Footer Loading Animation */
    .footer-modern {
        animation: footerAppear 1s cubic-bezier(0.25, 0.46, 0.45, 0.94);
    }

    @keyframes footerAppear {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* Enhanced accessibility for footer */
    @media (prefers-reduced-motion: reduce) {
        .footer-bg-pattern,
        .footer-logo-icon,
        .social-link,
        .footer-link {
            animation: none;
            transition: none;
        }
    }
    </style>
</body>
</html>
