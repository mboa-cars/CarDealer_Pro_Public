<nav x-data="{ open: false, dropdownOpen: false }" class="bg-white border-b border-gray-100 shadow-sm" style="position: sticky; top: 0; z-index: 1000; backdrop-filter: blur(10px); background: rgba(255, 255, 255, 0.95);">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex items-center">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="/" class="d-flex align-items-center text-decoration-none logo-container">
                        <div class="logo-icon me-2" style="width: 35px; height: 35px; background: linear-gradient(135deg, #F26522 0%, #ea6500 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white; font-size: 1rem; font-weight: bold; transition: all 0.3s ease; position: relative; overflow: hidden;">
                            <i class="fas fa-sun logo-sun"></i>
                            <div class="logo-rays"></div>
                        </div>
                        <h5 class="mb-0 fw-bold logo-text" style="color: #333; font-size: 1.3rem;">Logoipsum</h5>
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link :href="route('cars.index')" :active="request()->routeIs('cars.*')" class="nav-link-modern">
                        {{ __('Voitures') }}
                    </x-nav-link>
                    @auth
                        <x-nav-link :href="route('favorites')" :active="request()->routeIs('favorites')" class="nav-link-modern">
                            {{ __('Favoris') }}
                        </x-nav-link>
                    @endauth
                </div>
            </div>

            <!-- Right Side Buttons -->
            <div class="flex items-center space-x-4">
                @auth
                    <!-- Add New Car Button -->
                    <a href="{{ route('cars.create') }}" class="btn btn-modern-nav add-car-btn" style="background: linear-gradient(135deg, #F26522 0%, #ea6500 100%); color: white; border: none; border-radius: 12px; padding: 10px 20px; font-weight: 600; text-decoration: none; transition: all 0.3s ease; box-shadow: 0 4px 15px rgba(242, 101, 34, 0.3); display: flex; align-items: center; gap: 8px; position: relative; overflow: hidden;">
                        <i class="fas fa-plus btn-icon"></i>
                        <span>Add new Car</span>
                        <div class="btn-particles"></div>
                    </a>

                    <!-- Welcome Dropdown -->
                    <div class="relative" x-data="{ open: false }">
                        <button @click="open = !open" @click.away="open = false" class="btn btn-modern-nav welcome-btn" style="background: linear-gradient(135deg, #F26522 0%, #ea6500 100%); color: white; border: none; border-radius: 12px; padding: 10px 20px; font-weight: 600; transition: all 0.3s ease; box-shadow: 0 4px 15px rgba(242, 101, 34, 0.3); display: flex; align-items: center; gap: 8px; position: relative; overflow: hidden;">
                            <i class="fas fa-user btn-icon"></i>
                            <span>Welcome, {{ Auth::user()->name }}</span>
                            <i class="fas fa-chevron-down dropdown-arrow" style="font-size: 0.8rem; transition: transform 0.3s ease;" :class="{ 'rotate-180': open }"></i>
                            <div class="btn-particles"></div>
                        </button>

                        <!-- Dropdown Menu -->
                        <div x-show="open" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="transform opacity-0 scale-95 translate-y-2" x-transition:enter-end="transform opacity-100 scale-100 translate-y-0" x-transition:leave="transition ease-in duration-200" x-transition:leave-start="transform opacity-100 scale-100 translate-y-0" x-transition:leave-end="transform opacity-0 scale-95 translate-y-2" class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-xl border border-gray-200 py-2 z-50 dropdown-menu" style="min-width: 200px; backdrop-filter: blur(10px); background: rgba(255, 255, 255, 0.95);">
                            <div class="px-4 py-3 border-b border-gray-100 user-info">
                                <p class="text-sm font-semibold text-gray-900">{{ Auth::user()->name }}</p>
                                <p class="text-xs text-gray-500">{{ Auth::user()->email }}</p>
                            </div>
                            
                            <a href="{{ route('profile.edit') }}" class="dropdown-item">
                                <i class="fas fa-user-cog me-3" style="color: #F26522;"></i>
                                <span>Profile Settings</span>
                            </a>
                            
                            <a href="{{ route('cars.my-cars') }}" class="dropdown-item">
                                <i class="fas fa-car me-3" style="color: #F26522;"></i>
                                <span>My Cars</span>
                            </a>
                            
                            <a href="{{ route('favorites') }}" class="dropdown-item">
                                <i class="fas fa-heart me-3" style="color: #F26522;"></i>
                                <span>My Favorites</span>
                            </a>
                            
                            <div class="border-t border-gray-100 my-2"></div>
                            
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="dropdown-item text-red-600 hover:bg-red-50 logout-btn">
                                    <i class="fas fa-sign-out-alt me-3" style="color: #dc3545;"></i>
                                    <span>Logout</span>
                                </button>
                            </form>
                        </div>
                    </div>
                @else
                    <!-- Guest Buttons -->
                    <a href="{{ route('login') }}" class="btn btn-modern-nav guest-btn" style="background: linear-gradient(135deg, #F26522 0%, #ea6500 100%); color: white; border: none; border-radius: 12px; padding: 10px 20px; font-weight: 600; text-decoration: none; transition: all 0.3s ease; box-shadow: 0 4px 15px rgba(242, 101, 34, 0.3); display: flex; align-items: center; gap: 8px;">
                        <i class="fas fa-sign-in-alt btn-icon"></i>
                        <span>Login</span>
                    </a>
                    
                    <a href="{{ route('register') }}" class="btn btn-modern-nav guest-btn" style="background: white; color: #F26522; border: 2px solid #F26522; border-radius: 12px; padding: 10px 20px; font-weight: 600; text-decoration: none; transition: all 0.3s ease; display: flex; align-items: center; gap: 8px;">
                        <i class="fas fa-user-plus btn-icon"></i>
                        <span>Register</span>
                    </a>
                @endauth
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="hamburger-btn inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden responsive-menu">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('cars.index')" :active="request()->routeIs('cars.*')">
                {{ __('Voitures') }}
            </x-responsive-nav-link>
            @auth
                <x-responsive-nav-link :href="route('favorites')" :active="request()->routeIs('favorites')">
                    {{ __('Favoris') }}
                </x-responsive-nav-link>
            @endauth
        </div>

        <!-- Responsive Settings Dropdown -->
        @auth
            <div class="pt-4 pb-1 border-t border-gray-200">
                <div class="px-4">
                    <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                    <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
                </div>

                <div class="mt-3 space-y-1">
                    <x-responsive-nav-link :href="route('profile.edit')">
                        {{ __('Profile') }}
                    </x-responsive-nav-link>

                    <!-- Authentication -->
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <x-responsive-nav-link :href="route('logout')"
                                onclick="event.preventDefault();
                                            this.closest('form').submit();">
                            {{ __('Log Out') }}
                        </x-responsive-nav-link>
                    </form>
                </div>
            </div>
        @endauth
    </div>
</nav>

<style>
/* Navigation Container */
nav {
    animation: slideDown 0.5s ease-out;
}

@keyframes slideDown {
    from {
        transform: translateY(-100%);
        opacity: 0;
    }
    to {
        transform: translateY(0);
        opacity: 1;
    }
}

/* Logo Animations */
.logo-container {
    transition: all 0.3s ease;
}

.logo-icon {
    position: relative;
    animation: logoFloat 3s ease-in-out infinite;
}

.logo-sun {
    animation: sunRotate 10s linear infinite;
}

.logo-rays {
    position: absolute;
    top: 50%;
    left: 50%;
    width: 100%;
    height: 100%;
    transform: translate(-50%, -50%);
    background: radial-gradient(circle, rgba(255,255,255,0.3) 0%, transparent 70%);
    animation: raysPulse 2s ease-in-out infinite;
}

.logo-text {
    transition: all 0.3s ease;
}

a:hover .logo-icon {
    transform: scale(1.15) rotate(5deg);
    box-shadow: 0 12px 35px rgba(242, 101, 34, 0.5);
}

a:hover .logo-text {
    color: #F26522 !important;
    transform: translateX(5px);
}

@keyframes logoFloat {
    0%, 100% { transform: translateY(0px); }
    50% { transform: translateY(-3px); }
}

@keyframes sunRotate {
    from { transform: rotate(0deg); }
    to { transform: rotate(360deg); }
}

@keyframes raysPulse {
    0%, 100% { opacity: 0.3; transform: translate(-50%, -50%) scale(1); }
    50% { opacity: 0.6; transform: translate(-50%, -50%) scale(1.1); }
}

/* Navigation Button Styles */
.btn-modern-nav {
    transition: all 0.3s ease;
    position: relative;
    overflow: hidden;
    animation: buttonAppear 0.6s ease-out;
}

.btn-modern-nav::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255,255,255,0.3), transparent);
    transition: left 0.6s ease;
}

.btn-modern-nav:hover::before {
    left: 100%;
}

.btn-modern-nav:hover {
    transform: translateY(-3px) scale(1.02);
    box-shadow: 0 8px 25px rgba(242, 101, 34, 0.4);
}

.btn-icon {
    transition: all 0.3s ease;
}

.btn-modern-nav:hover .btn-icon {
    transform: scale(1.2);
}

/* Button Particles Effect */
.btn-particles {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    pointer-events: none;
}

.btn-modern-nav:hover .btn-particles::before,
.btn-modern-nav:hover .btn-particles::after {
    content: '';
    position: absolute;
    width: 4px;
    height: 4px;
    background: rgba(255, 255, 255, 0.8);
    border-radius: 50%;
    animation: particleFloat 1s ease-out;
}

.btn-modern-nav:hover .btn-particles::before {
    top: 20%;
    left: 20%;
    animation-delay: 0s;
}

.btn-modern-nav:hover .btn-particles::after {
    top: 60%;
    right: 20%;
    animation-delay: 0.2s;
}

@keyframes particleFloat {
    0% {
        opacity: 1;
        transform: translateY(0) scale(1);
    }
    100% {
        opacity: 0;
        transform: translateY(-20px) scale(0);
    }
}

@keyframes buttonAppear {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* Dropdown Styles */
.dropdown-menu {
    animation: dropdownAppear 0.3s ease-out;
}

.dropdown-arrow {
    transition: transform 0.3s ease;
}

@keyframes dropdownAppear {
    from {
        opacity: 0;
        transform: translateY(-10px) scale(0.95);
    }
    to {
        opacity: 1;
        transform: translateY(0) scale(1);
    }
}

.dropdown-item {
    display: flex;
    align-items: center;
    padding: 12px 16px;
    color: #333;
    text-decoration: none;
    font-size: 0.9rem;
    font-weight: 500;
    transition: all 0.3s ease;
    border-radius: 8px;
    margin: 2px 8px;
    position: relative;
    overflow: hidden;
}

.dropdown-item::before {
    content: '';
    position: absolute;
    left: -100%;
    top: 0;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(242, 101, 34, 0.1), transparent);
    transition: left 0.5s ease;
}

.dropdown-item:hover::before {
    left: 100%;
}

.dropdown-item:hover {
    background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
    color: #F26522;
    transform: translateX(8px);
    box-shadow: 0 4px 15px rgba(242, 101, 34, 0.1);
}

.dropdown-item i {
    width: 16px;
    text-align: center;
    transition: all 0.3s ease;
}

.dropdown-item:hover i {
    transform: scale(1.2);
}

.logout-btn:hover {
    background: linear-gradient(135deg, #ffebee 0%, #ffcdd2 100%) !important;
    color: #d32f2f !important;
}

/* Navigation Links */
.nav-link-modern {
    position: relative;
    transition: all 0.3s ease;
}

.nav-link-modern::after {
    content: '';
    position: absolute;
    bottom: -2px;
    left: 0;
    width: 0;
    height: 2px;
    background: linear-gradient(90deg, #F26522, #ea6500);
    transition: width 0.3s ease;
}

.nav-link-modern:hover::after {
    width: 100%;
}

/* Hamburger Button */
.hamburger-btn {
    transition: all 0.3s ease;
}

.hamburger-btn:hover {
    transform: scale(1.1);
    background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
}

/* Responsive Menu */
.responsive-menu {
    animation: slideIn 0.3s ease-out;
}

@keyframes slideIn {
    from {
        opacity: 0;
        transform: translateY(-10px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* Responsive adjustments */
@media (max-width: 768px) {
    .btn-modern-nav {
        padding: 8px 16px !important;
        font-size: 0.9rem;
    }
    
    .logo-icon {
        width: 30px !important;
        height: 30px !important;
        font-size: 0.9rem !important;
    }
    
    .logo-text {
        font-size: 1.1rem !important;
    }
}

/* Stagger animation for buttons */
.add-car-btn {
    animation-delay: 0.1s;
}

.welcome-btn {
    animation-delay: 0.2s;
}

.guest-btn:nth-child(1) {
    animation-delay: 0.1s;
}

.guest-btn:nth-child(2) {
    animation-delay: 0.2s;
}
</style>
