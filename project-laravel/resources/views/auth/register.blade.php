@extends('layouts.guest')

@section('content')
<div class="min-vh-100 d-flex align-items-center" style="background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);">
    <div class="container">
        <div class="row align-items-center justify-content-center">
            <!-- Signup Form Section -->
            <div class="col-lg-4 col-md-6">
                <div class="card border-0 shadow-lg" style="border-radius: 16px; background: white;">
                    <div class="card-body p-4">
                        <!-- Logo and Title -->
                        <div class="text-center mb-3">
                            <div class="d-flex align-items-center justify-content-center mb-2">
                                <a href="{{ url('/') }}" class="text-decoration-none d-flex align-items-center">
                                    <div class="logo-icon me-2" style="width: 35px; height: 35px; background: linear-gradient(135deg, #F26522 0%, #ea6500 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white; font-size: 1rem; font-weight: bold; transition: all 0.3s ease;">
                                        <i class="fas fa-sun"></i>
                                    </div>
                                    <h5 class="mb-0 fw-bold" style="color: #333; font-size: 1.3rem;">Mboa-cars</h5>
                                </a>
                            </div>
                            <h3 class="fw-bold mb-0" style="color: #333; font-size: 1.8rem;">Signup</h3>
                        </div>

                        <!-- Error Messages -->
                        @if($errors->any())
                            <div class="alert alert-danger border-0 mb-3" style="background: linear-gradient(135deg, #ff6b6b 0%, #ee5a52 100%); color: white; border-radius: 10px; font-size: 0.9rem;">
                                <div class="d-flex align-items-center">
                                    <i class="fas fa-exclamation-triangle me-2" style="font-size: 1rem;"></i>
                                    <div>
                                        <strong>Please fix the following errors:</strong>
                                        <ul class="mb-0 mt-1" style="font-size: 0.85rem;">
                                            @foreach($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        @endif

                        <!-- Signup Form -->
                        <form method="POST" action="{{ route('register') }}" id="signupForm">
                            @csrf

                            <!-- Name -->
                            <div class="mb-3">
                                <label for="name" class="form-label fw-semibold" style="color: #555; font-size: 0.9rem;">
                                    <i class="fas fa-user me-1" style="color: #F26522;"></i>Name
                                </label>
                                <input type="text" id="name" name="name" class="form-control modern-input" value="{{ old('name') }}" required autofocus autocomplete="name" placeholder="Enter your full name">
                            </div>

                            <!-- Email Address -->
                            <div class="mb-3">
                                <label for="email" class="form-label fw-semibold" style="color: #555; font-size: 0.9rem;">
                                    <i class="fas fa-envelope me-1" style="color: #F26522;"></i>Your Email
                                </label>
                                <input type="email" id="email" name="email" class="form-control modern-input" value="{{ old('email') }}" required autocomplete="username" placeholder="Enter your email address">
                            </div>

                            <!-- Phone -->
                            <div class="mb-3">
                                <label for="phone" class="form-label fw-semibold" style="color: #555; font-size: 0.9rem;">
                                    <i class="fas fa-phone me-1" style="color: #F26522;"></i>Phone
                                </label>
                                <input type="tel" id="phone" name="phone" class="form-control modern-input" value="{{ old('phone') }}" placeholder="Enter your phone number">
                            </div>

                            <!-- Password -->
                            <div class="mb-3">
                                <label for="password" class="form-label fw-semibold" style="color: #555; font-size: 0.9rem;">
                                    <i class="fas fa-lock me-1" style="color: #F26522;"></i>Your Password
                                </label>
                                <div class="position-relative">
                                    <input type="password" id="password" name="password" class="form-control modern-input" required autocomplete="new-password" placeholder="Enter your password">
                                    <button type="button" class="btn position-absolute end-0 top-0 h-100 border-0 bg-transparent" style="color: #666;" onclick="togglePassword('password')">
                                        <i class="fas fa-eye" id="password-eye"></i>
                                    </button>
                                </div>
                                <div id="password-strength" class="mt-1"></div>
                            </div>

                            <!-- Confirm Password -->
                            <div class="mb-3">
                                <label for="password_confirmation" class="form-label fw-semibold" style="color: #555; font-size: 0.9rem;">
                                    <i class="fas fa-lock me-1" style="color: #F26522;"></i>Repeat Password
                                </label>
                                <div class="position-relative">
                                    <input type="password" id="password_confirmation" name="password_confirmation" class="form-control modern-input" required autocomplete="new-password" placeholder="Confirm your password">
                                    <button type="button" class="btn position-absolute end-0 top-0 h-100 border-0 bg-transparent" style="color: #666;" onclick="togglePassword('password_confirmation')">
                                        <i class="fas fa-eye" id="password_confirmation-eye"></i>
                                    </button>
                                </div>
                            </div>

                            <!-- Register Button -->
                            <div class="mb-3">
                                <button type="submit" class="btn w-100 btn-modern" style="padding: 12px; font-size: 1rem; font-weight: 600;">
                                    <i class="fas fa-user-plus me-2"></i>Register
                                </button>
                            </div>

                            <!-- Social Login -->
                            <div class="mb-3">
                                <div class="text-center mb-2">
                                    <span class="text-muted" style="font-size: 0.85rem;">Or continue with</span>
                                </div>
                                <div class="row g-2">
                                    <div class="col-6">
                                        <button type="button" class="btn w-100 social-btn" style="background: white; color: #333; border: 2px solid #e9ecef; border-radius: 10px; padding: 10px; font-weight: 600; font-size: 0.9rem; transition: all 0.3s ease;">
                                            <i class="fab fa-google me-1" style="color: #DB4437;"></i>Google
                                        </button>
                                    </div>
                                    <div class="col-6">
                                        <button type="button" class="btn w-100 social-btn" style="background: white; color: #333; border: 2px solid #e9ecef; border-radius: 10px; padding: 10px; font-weight: 600; font-size: 0.9rem; transition: all 0.3s ease;">
                                            <i class="fab fa-facebook me-1" style="color: #4267B2;"></i>Facebook
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <!-- Login Link -->
                            <div class="text-center">
                                <span class="text-muted" style="font-size: 0.85rem;">Already have an account? - </span>
                                <a href="{{ route('login') }}" class="text-decoration-none" style="color: #F26522; font-weight: 600;">Click here to login</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Car Image Section -->
            <div class="col-lg-8 col-md-6 d-none d-md-block">
                <div class="text-center">
                    <div class="car-image-container" style="position: relative; display: inline-block;">
                        <img src="{{ asset('images/car-png-39071.png') }}" alt="Orange SUV" class="img-fluid" style="max-height: 450px; filter: drop-shadow(0 20px 40px rgba(0,0,0,0.15)); transform: rotate(-5deg);">
                        <div class="floating-card" style="position: absolute; top: 15px; right: -15px; background: white; padding: 12px; border-radius: 10px; box-shadow: 0 8px 25px rgba(0,0,0,0.1); transform: rotate(5deg);">
                            <div class="d-flex align-items-center">
                                <i class="fas fa-star me-2" style="color: #FFD700;"></i>
                                <span style="font-weight: 600; color: #333; font-size: 0.9rem;">Premium Cars</span>
                            </div>
                        </div>
                        <div class="floating-card" style="position: absolute; bottom: 15px; left: -15px; background: white; padding: 12px; border-radius: 10px; box-shadow: 0 8px 25px rgba(0,0,0,0.1); transform: rotate(-5deg);">
                            <div class="d-flex align-items-center">
                                <i class="fas fa-shield-alt me-2" style="color: #28a745;"></i>
                                <span style="font-weight: 600; color: #333; font-size: 0.9rem;">Secure Platform</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
/* Modern Input Styles */
.modern-input {
    border: 2px solid #e9ecef;
    border-radius: 10px;
    padding: 12px 16px;
    font-size: 0.95rem;
    transition: all 0.3s ease;
    background: white;
}

.modern-input:focus {
    border-color: #F26522;
    box-shadow: 0 0 0 0.2rem rgba(242, 101, 34, 0.25);
    outline: none;
}

/* Button Styles */
.btn-modern {
    background: linear-gradient(135deg, #F26522 0%, #ea6500 100%);
    color: white;
    border: none;
    border-radius: 10px;
    padding: 12px 24px;
    font-weight: 600;
    transition: all 0.3s ease;
    box-shadow: 0 4px 15px rgba(242, 101, 34, 0.3);
}

.btn-modern:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(242, 101, 34, 0.4);
    color: white;
}

/* Social Button Styles */
.social-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    border-color: #F26522;
}

/* Card Styles */
.card {
    border: none;
    box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
    transition: all 0.3s ease;
}

.card:hover {
    transform: translateY(-5px);
    box-shadow: 0 15px 50px rgba(0, 0, 0, 0.15);
}

/* Logo Hover Effect */
.logo-icon {
    transition: all 0.3s ease;
}

a:hover .logo-icon {
    transform: scale(1.1);
    box-shadow: 0 8px 25px rgba(242, 101, 34, 0.4);
}

a:hover h5 {
    color: #F26522 !important;
}

/* Floating Cards Animation */
.floating-card {
    animation: float 3s ease-in-out infinite;
}

.floating-card:nth-child(2) {
    animation-delay: 1.5s;
}

@keyframes float {
    0%, 100% { transform: translateY(0px) rotate(5deg); }
    50% { transform: translateY(-10px) rotate(5deg); }
}

/* Password Strength Indicator */
.password-strength-bar {
    height: 3px;
    border-radius: 2px;
    transition: all 0.3s ease;
}

/* Responsive Design */
@media (max-width: 768px) {
    .card-body {
        padding: 1.5rem !important;
    }
    
    .car-image-container {
        margin-top: 2rem;
    }
}

/* Form Validation Styles */
.is-valid {
    border-color: #28a745 !important;
    box-shadow: 0 0 0 0.2rem rgba(40, 167, 69, 0.25) !important;
}

.is-invalid {
    border-color: #dc3545 !important;
    box-shadow: 0 0 0 0.2rem rgba(220, 53, 69, 0.25) !important;
}

/* Loading State */
.btn-loading {
    position: relative;
    color: transparent !important;
}

.btn-loading::after {
    content: '';
    position: absolute;
    top: 50%;
    left: 50%;
    width: 18px;
    height: 18px;
    margin: -9px 0 0 -9px;
    border: 2px solid transparent;
    border-top: 2px solid white;
    border-radius: 50%;
    animation: spin 1s linear infinite;
}

@keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}
</style>
@endpush

@push('scripts')
<script>
// Password Toggle Function
function togglePassword(inputId) {
    const input = document.getElementById(inputId);
    const eye = document.getElementById(inputId + '-eye');
    
    if (input.type === 'password') {
        input.type = 'text';
        eye.classList.remove('fa-eye');
        eye.classList.add('fa-eye-slash');
    } else {
        input.type = 'password';
        eye.classList.remove('fa-eye-slash');
        eye.classList.add('fa-eye');
    }
}

// Password Strength Indicator
document.getElementById('password').addEventListener('input', function() {
    const password = this.value;
    const strength = calculatePasswordStrength(password);
    updatePasswordStrengthIndicator(this, strength);
});

function calculatePasswordStrength(password) {
    let strength = 0;
    if (password.length >= 8) strength++;
    if (/[a-z]/.test(password)) strength++;
    if (/[A-Z]/.test(password)) strength++;
    if (/[0-9]/.test(password)) strength++;
    if (/[^A-Za-z0-9]/.test(password)) strength++;
    return strength;
}

function updatePasswordStrengthIndicator(input, strength) {
    let indicator = document.getElementById('password-strength');
    if (!indicator) {
        indicator = document.createElement('div');
        indicator.id = 'password-strength';
        input.parentNode.appendChild(indicator);
    }
    
    const colors = ['#dc3545', '#ffc107', '#28a745'];
    const messages = ['Weak', 'Medium', 'Strong'];
    const color = colors[Math.min(Math.floor(strength / 2), 2)];
    const message = messages[Math.min(Math.floor(strength / 2), 2)];
    
    indicator.innerHTML = `
        <div class="d-flex align-items-center">
            <div class="password-strength-bar me-2" style="flex: 1; background: #e9ecef;">
                <div style="width: ${(strength / 5) * 100}%; height: 100%; background: ${color}; transition: width 0.3s ease;"></div>
            </div>
            <small style="color: ${color}; font-weight: 600; font-size: 0.8rem;">${message}</small>
        </div>
    `;
}

// Form Validation Enhancement
document.querySelectorAll('.modern-input').forEach(input => {
    input.addEventListener('blur', function() {
        if (this.checkValidity()) {
            this.classList.add('is-valid');
            this.classList.remove('is-invalid');
        } else {
            this.classList.add('is-invalid');
            this.classList.remove('is-valid');
        }
    });
});

// Password Confirmation Validation
document.getElementById('password_confirmation').addEventListener('input', function() {
    const password = document.getElementById('password').value;
    const confirmation = this.value;
    
    if (confirmation && password !== confirmation) {
        this.classList.add('is-invalid');
        this.classList.remove('is-valid');
    } else if (confirmation && password === confirmation) {
        this.classList.add('is-valid');
        this.classList.remove('is-invalid');
    } else {
        this.classList.remove('is-valid', 'is-invalid');
    }
});

// Form Submission with Loading State
document.getElementById('signupForm').addEventListener('submit', function(e) {
    const submitBtn = this.querySelector('button[type="submit"]');
    submitBtn.classList.add('btn-loading');
    submitBtn.disabled = true;
});

// Social Login Buttons (Placeholder)
document.querySelectorAll('.social-btn').forEach(btn => {
    btn.addEventListener('click', function() {
        // Add social login functionality here
        alert('Social login functionality will be implemented here');
    });
});

// Auto-hide alerts
document.querySelectorAll('.alert').forEach(alert => {
    setTimeout(() => {
        alert.style.opacity = '0';
        setTimeout(() => alert.remove(), 300);
    }, 5000);
});
</script>
@endpush
