<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Car Sales</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        body { background: #f5f5f5; }
        .btn-orange { background: #F26522; color: #fff; border-radius: 24px; }
        .btn-orange-outline { border: 2px solid #F26522; color: #F26522; border-radius: 24px; background: #fff; }
        .btn-orange-outline:hover { background: #F26522; color: #fff; }
        .btn-orange-outline-user { border: 2px solid #F26522; color: #F26522; border-radius: 24px; background: #fff; }
        .btn-orange-outline-user:hover { background: #F26522; color: #fff; }
        .card { border-radius: 18px; box-shadow: 0 2px 8px rgba(0,0,0,0.05); }
        .navbar { background: #fff; border-bottom: 1px solid #eee; }
        .logo { font-weight: bold; color: #333; letter-spacing: -1px; }
        .logo span { color: #F26522; }
        .nav-btns .btn { margin-left: 10px; }
        .dropdown-menu { border-radius: 12px; box-shadow: 0 4px 12px rgba(0,0,0,0.1); }
        .dropdown-item:hover { background-color: #f8f9fa; }
    </style>
    @yield('head')
    @stack('styles')
</head>
<body>
    <nav class="navbar navbar-expand-lg px-4 py-3">
        <a class="navbar-brand logo d-flex align-items-center" href="/">
            <span style="font-size:2rem;margin-right:8px;">&#9728;</span> Logoipsum
        </a>
        
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        
        <div class="collapse navbar-collapse" id="navbarNav">
            <div class="ms-auto nav-btns d-flex align-items-center">
                @guest
                    <a href="{{ route('register') }}" class="btn btn-orange ms-2">
                        <i class="fas fa-user-plus me-2"></i>Signup
                    </a>
                    <a href="{{ route('login') }}" class="btn btn-link ms-2" style="color:#ea6500;">
                        <i class="fas fa-sign-in-alt me-2"></i>Login
                    </a>
                @else
                    <a href="{{ route('cars.create') }}" class="btn btn-orange-outline">
                        <i class="fas fa-plus me-2"></i>Add new Car
                    </a>
                    
                    <div class="dropdown ms-2">
                        <button class="btn btn-orange-outline-user dropdown-toggle" type="button" data-bs-toggle="dropdown">
                            <i class="fas fa-user me-2"></i>Welcome, {{ Auth::user()->name }}
                        </button>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{ route('cars.my-cars') }}">
                                <i class="fas fa-car me-2"></i>My Cars
                            </a></li>
                            <li><a class="dropdown-item" href="{{ route('favorites') }}">
                                <i class="fas fa-heart me-2"></i>Favorites
                            </a></li>
                            <li><a class="dropdown-item" href="{{ route('profile.edit') }}">
                                <i class="fas fa-user-cog me-2"></i>Profile
                            </a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}" class="d-inline">
                                    @csrf
                                    <button type="submit" class="dropdown-item text-danger">
                                        <i class="fas fa-sign-out-alt me-2"></i>Logout
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </div>
                @endguest
            </div>
        </div>
    </nav>
    
    <div class="container my-4">
        @yield('content')
    </div>
    
    @yield('footer')
    
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    @yield('scripts')
</body>
</html>
