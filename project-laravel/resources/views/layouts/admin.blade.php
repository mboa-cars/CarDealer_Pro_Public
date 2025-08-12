<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }} - Administration</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <!-- Navigation moderne avec glassmorphism -->
    <nav class="navbar navbar-expand-lg fixed-top" style="background: rgba(255, 255, 255, 0.95); backdrop-filter: blur(20px); border-bottom: 1px solid rgba(240, 240, 240, 0.8); box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1); z-index: 1000;">
        <div class="container-fluid px-4">
            <!-- Brand avec animation -->
            <a class="navbar-brand d-flex align-items-center" href="{{ route('admin.dashboard') }}" style="text-decoration: none; color: #333; transition: all 0.3s ease;">
                <div class="position-relative me-3">
                    <div class="rounded-circle d-flex align-items-center justify-center shadow-lg" style="width: 45px; height: 45px; background: linear-gradient(135deg, #F26522 0%, #ea6500 100%); transition: all 0.3s ease;">
                        <i class="fas fa-car text-white" style="font-size: 1.2rem;"></i>
                    </div>
                    <!-- Effet de brillance -->
                    <div class="position-absolute" style="top: 5px; left: 5px; width: 10px; height: 10px; background: rgba(255, 255, 255, 0.4); border-radius: 50%; filter: blur(3px);"></div>
                </div>
                <div>
                    <span style="font-weight: 700; font-size: 1.4rem; background: linear-gradient(135deg, #F26522 0%, #ea6500 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;">Administration</span>
                    <div style="font-size: 0.8rem; color: #666; font-weight: 500;">Dashboard</div>
                </div>
            </a>
            
            <!-- Bouton mobile -->
            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" style="box-shadow: none; transition: all 0.3s ease;">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <!-- Navigation principale -->
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item me-2">
                        <a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}" style="color: {{ request()->routeIs('admin.dashboard') ? '#F26522' : '#666' }}; font-weight: 600; padding: 0.75rem 1.25rem; border-radius: 12px; transition: all 0.3s ease; position: relative;">
                            <i class="fas fa-tachometer-alt me-2"></i>Dashboard
                            @if(request()->routeIs('admin.dashboard'))
                                <div class="position-absolute" style="bottom: 5px; left: 50%; transform: translateX(-50%); width: 20px; height: 3px; background: linear-gradient(135deg, #F26522 0%, #ea6500 100%); border-radius: 2px;"></div>
                            @endif
                        </a>
                    </li>
                    <li class="nav-item me-2">
                        <a class="nav-link {{ request()->routeIs('admin.users') ? 'active' : '' }}" href="{{ route('admin.users') }}" style="color: {{ request()->routeIs('admin.users') ? '#F26522' : '#666' }}; font-weight: 600; padding: 0.75rem 1.25rem; border-radius: 12px; transition: all 0.3s ease; position: relative;">
                            <i class="fas fa-users me-2"></i>Utilisateurs
                            @if(request()->routeIs('admin.users'))
                                <div class="position-absolute" style="bottom: 5px; left: 50%; transform: translateX(-50%); width: 20px; height: 3px; background: linear-gradient(135deg, #F26522 0%, #ea6500 100%); border-radius: 2px;"></div>
                            @endif
                        </a>
                    </li>
                    <li class="nav-item me-2">
                        <a class="nav-link {{ request()->routeIs('admin.cars') ? 'active' : '' }}" href="{{ route('admin.cars') }}" style="color: {{ request()->routeIs('admin.cars') ? '#F26522' : '#666' }}; font-weight: 600; padding: 0.75rem 1.25rem; border-radius: 12px; transition: all 0.3s ease; position: relative;">
                            <i class="fas fa-car me-2"></i>Voitures
                            @if(request()->routeIs('admin.cars'))
                                <div class="position-absolute" style="bottom: 5px; left: 50%; transform: translateX(-50%); width: 20px; height: 3px; background: linear-gradient(135deg, #F26522 0%, #ea6500 100%); border-radius: 2px;"></div>
                            @endif
                        </a>
                    </li>
                    <li class="nav-item me-2">
                        <a class="nav-link {{ request()->routeIs('admin.subscriptions') ? 'active' : '' }}" href="{{ route('admin.subscriptions') }}" style="color: {{ request()->routeIs('admin.subscriptions') ? '#F26522' : '#666' }}; font-weight: 600; padding: 0.75rem 1.25rem; border-radius: 12px; transition: all 0.3s ease; position: relative;">
                            <i class="fas fa-user-friends me-2"></i>Abonnements
                            @if(request()->routeIs('admin.subscriptions'))
                                <div class="position-absolute" style="bottom: 5px; left: 50%; transform: translateX(-50%); width: 20px; height: 3px; background: linear-gradient(135deg, #F26522 0%, #ea6500 100%); border-radius: 2px;"></div>
                            @endif
                        </a>
                    </li>
                    <li class="nav-item me-2">
                        <a class="nav-link {{ request()->routeIs('admin.statistics') ? 'active' : '' }}" href="{{ route('admin.statistics') }}" style="color: {{ request()->routeIs('admin.statistics') ? '#F26522' : '#666' }}; font-weight: 600; padding: 0.75rem 1.25rem; border-radius: 12px; transition: all 0.3s ease; position: relative;">
                            <i class="fas fa-chart-bar me-2"></i>Statistiques
                            @if(request()->routeIs('admin.statistics'))
                                <div class="position-absolute" style="bottom: 5px; left: 50%; transform: translateX(-50%); width: 20px; height: 3px; background: linear-gradient(135deg, #F26522 0%, #ea6500 100%); border-radius: 2px;"></div>
                            @endif
                        </a>
                    </li>
                    <li class="nav-item me-2">
                        <a class="nav-link {{ request()->routeIs('admin.bookmarks') ? 'active' : '' }}" href="{{ route('admin.bookmarks') }}" style="color: {{ request()->routeIs('admin.bookmarks') ? '#F26522' : '#666' }}; font-weight: 600; padding: 0.75rem 1.25rem; border-radius: 12px; transition: all 0.3s ease; position: relative;">
                            <i class="fas fa-bookmark me-2"></i>Bookmarks
                            @if(request()->routeIs('admin.bookmarks'))
                                <div class="position-absolute" style="bottom: 5px; left: 50%; transform: translateX(-50%); width: 20px; height: 3px; background: linear-gradient(135deg, #F26522 0%, #ea6500 100%); border-radius: 2px;"></div>
                            @endif
                        </a>
                    </li>
                    <li class="nav-item me-2">
                        <a class="nav-link {{ request()->routeIs('admin.plans') ? 'active' : '' }}" href="{{ route('admin.plans') }}" style="color: {{ request()->routeIs('admin.plans') ? '#F26522' : '#666' }}; font-weight: 600; padding: 0.75rem 1.25rem; border-radius: 12px; transition: all 0.3s ease; position: relative;">
                            <i class="fas fa-crown me-2"></i>Plans
                            @if(request()->routeIs('admin.plans'))
                                <div class="position-absolute" style="bottom: 5px; left: 50%; transform: translateX(-50%); width: 20px; height: 3px; background: linear-gradient(135deg, #F26522 0%, #ea6500 100%); border-radius: 2px;"></div>
                            @endif
                        </a>
                    </li>
                </ul>
                
                <!-- Section utilisateur -->
                <div class="d-flex align-items-center">
                    <!-- Avatar utilisateur -->
                    <div class="d-flex align-items-center me-3">
                        <div class="rounded-circle d-flex align-items-center justify-content-center me-2 shadow-sm" style="width: 35px; height: 35px; background: linear-gradient(135deg, #007bff 0%, #0056b3 100%);">
                            <span class="text-white fw-bold" style="font-size: 0.9rem;">{{ substr(Auth::user()->name, 0, 1) }}</span>
                        </div>
                        <div>
                            <div style="font-weight: 600; color: #333; font-size: 0.9rem;">{{ Auth::user()->name }}</div>
                            <div style="font-size: 0.75rem; color: #F26522; font-weight: 500;">Administrateur</div>
                        </div>
                    </div>
                    
                    <!-- Boutons d'action -->
                    <div class="d-flex align-items-center">
                        <a href="{{ route('home') }}" class="btn btn-outline-secondary me-2" style="border-radius: 10px; font-weight: 600; padding: 0.5rem 1rem; transition: all 0.3s ease; border: 2px solid #e9ecef; background: rgba(255, 255, 255, 0.8); backdrop-filter: blur(10px);">
                            <i class="fas fa-home me-1"></i>Site
                        </a>
                        <form method="POST" action="{{ route('logout') }}" class="d-inline">
                            @csrf
                            <button type="submit" class="btn" style="border-radius: 10px; font-weight: 600; padding: 0.5rem 1rem; transition: all 0.3s ease; background: linear-gradient(135deg, #dc3545 0%, #c82333 100%); color: white; border: none;">
                                <i class="fas fa-sign-out-alt me-1"></i>Déconnexion
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <!-- Espacement pour la navbar fixe -->
    <div style="height: 80px;"></div>

    <!-- Page Content -->
    <main>
        @if(session('success'))
            <div class="alert alert-success border-0 shadow-sm" style="background: linear-gradient(135deg, #28a745 0%, #20c997 100%); color: white; border-radius: 12px; margin: 1rem;">
                <div class="d-flex align-items-center">
                    <i class="fas fa-check-circle me-3" style="font-size: 1.2rem;"></i>
                    <span>{{ session('success') }}</span>
                </div>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger border-0 shadow-sm" style="background: linear-gradient(135deg, #ff6b6b 0%, #ee5a52 100%); color: white; border-radius: 12px; margin: 1rem;">
                <div class="d-flex align-items-center">
                    <i class="fas fa-exclamation-triangle me-3" style="font-size: 1.2rem;"></i>
                    <span>{{ session('error') }}</span>
                </div>
            </div>
        @endif

        @yield('content')
    </main>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <style>
    /* Styles modernisés pour la navigation */
    .navbar {
        transition: all 0.3s ease;
    }
    
    .navbar-brand:hover {
        transform: translateY(-2px);
    }
    
    .navbar-brand:hover .rounded-circle {
        transform: scale(1.1);
        box-shadow: 0 8px 25px rgba(242, 101, 34, 0.3);
    }
    
    .navbar-nav .nav-link {
        position: relative;
        transition: all 0.3s ease;
        border-radius: 12px;
    }
    
    .navbar-nav .nav-link:hover {
        color: #F26522 !important;
        transform: translateY(-2px);
        background: rgba(242, 101, 34, 0.1);
        box-shadow: 0 4px 15px rgba(242, 101, 34, 0.2);
    }
    
    .navbar-nav .nav-link.active {
        color: #F26522 !important;
        font-weight: 700;
        background: rgba(242, 101, 34, 0.1);
        box-shadow: 0 4px 15px rgba(242, 101, 34, 0.2);
    }
    
    .btn {
        transition: all 0.3s ease;
    }
    
    .btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
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
    
    @keyframes slideInFromTop {
        from {
            opacity: 0;
            transform: translateY(-20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    .alert {
        animation: fadeInUp 0.6s ease-out forwards;
    }
    
    .navbar {
        animation: slideInFromTop 0.8s ease-out forwards;
    }
    
    /* Effet de scroll pour la navbar */
    .navbar.scrolled {
        background: rgba(255, 255, 255, 0.98) !important;
        backdrop-filter: blur(25px) !important;
        box-shadow: 0 8px 30px rgba(0, 0, 0, 0.15) !important;
    }
    
    /* Responsive design amélioré */
    @media (max-width: 768px) {
        .navbar-nav {
            margin-top: 1rem;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border-radius: 12px;
            padding: 1rem;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        }
        
        .navbar-nav .nav-link {
            padding: 0.75rem 1rem;
            margin: 0.25rem 0;
            border-radius: 8px;
        }
        
        .navbar-nav .nav-link.active::after {
            display: none;
        }
        
        .d-flex.align-items-center {
            flex-direction: column;
            align-items: stretch !important;
        }
        
        .d-flex.align-items-center > div {
            margin: 0.5rem 0;
        }
    }
    
    /* Effets de brillance pour les icônes */
    .nav-link i {
        transition: all 0.3s ease;
    }
    
    .nav-link:hover i {
        transform: scale(1.1);
    }
    
    .nav-link.active i {
        transform: scale(1.1);
    }
    </style>

    <script>
    // Effet de scroll pour la navbar
    window.addEventListener('scroll', function() {
        const navbar = document.querySelector('.navbar');
        if (window.scrollY > 50) {
            navbar.classList.add('scrolled');
        } else {
            navbar.classList.remove('scrolled');
        }
    });
    
    // Animation des éléments au chargement
    document.addEventListener('DOMContentLoaded', function() {
        // Animation des liens de navigation
        const navLinks = document.querySelectorAll('.nav-link');
        navLinks.forEach((link, index) => {
            link.style.animationDelay = `${index * 0.1}s`;
        });
        
        // Animation du brand
        const navbarBrand = document.querySelector('.navbar-brand');
        navbarBrand.style.animationDelay = '0.2s';
    });
    </script>
</body>
</html> 