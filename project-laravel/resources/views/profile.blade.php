@extends('layouts.app')

@section('content')
<!-- Header Section -->
<div class="mb-5">
    <div class="d-flex align-items-center mb-4">
        <div class="profile-avatar me-4">
            <div class="avatar-circle" style="width: 80px; height: 80px; background: linear-gradient(135deg, #F26522 0%, #ea6500 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white; font-size: 2rem; font-weight: bold; box-shadow: 0 8px 25px rgba(242, 101, 34, 0.3);">
                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
            </div>
        </div>
        <div>
            <h1 class="fw-bold mb-1" style="color: #333; font-size: 2.2rem;">Welcome back, {{ Auth::user()->name }}!</h1>
            <p class="text-muted mb-0" style="font-size: 1rem;">Manage your account settings and preferences</p>
        </div>
    </div>

    @if(session('status') === 'profile-updated')
        <div class="alert alert-success border-0 shadow-sm" style="background: linear-gradient(135deg, #28a745 0%, #20c997 100%); color: white; border-radius: 12px;">
            <div class="d-flex align-items-center">
                <i class="fas fa-check-circle me-3" style="font-size: 1.2rem;"></i>
                <span>Profile information updated successfully!</span>
            </div>
        </div>
    @endif

    @if(session('status') === 'password-updated')
        <div class="alert alert-success border-0 shadow-sm" style="background: linear-gradient(135deg, #28a745 0%, #20c997 100%); color: white; border-radius: 12px;">
            <div class="d-flex align-items-center">
                <i class="fas fa-shield-alt me-3" style="font-size: 1.2rem;"></i>
                <span>Password updated successfully!</span>
            </div>
        </div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger border-0 shadow-sm" style="background: linear-gradient(135deg, #ff6b6b 0%, #ee5a52 100%); color: white; border-radius: 12px;">
            <div class="d-flex align-items-center">
                <i class="fas fa-exclamation-triangle me-3" style="font-size: 1.2rem;"></i>
                <div>
                    <strong>Please fix the following errors:</strong>
                    <ul class="mb-0 mt-2">
                        @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    @endif
</div>

<div class="row g-4">
    <!-- Profile Information -->
    <div class="col-lg-8">
        <div class="card shadow-sm border-0" style="border-radius: 16px; background: linear-gradient(135deg, #fff 0%, #fafafa 100%);">
            <div class="card-header border-0 bg-transparent" style="padding: 1.5rem 1.5rem 0;">
                <h5 class="mb-0 fw-bold" style="color: #333; font-size: 1.3rem;">
                    <i class="fas fa-user me-2" style="color: #F26522;"></i>Profile Information
                </h5>
                <p class="text-muted mb-0 mt-2" style="font-size: 0.95rem;">Update your account's profile information and email address.</p>
            </div>
            <div class="card-body" style="padding: 1.5rem;">
                @include('profile.partials.update-profile-information-form')
            </div>
        </div>
    </div>

    <!-- Quick Stats -->
    <div class="col-lg-4">
        <div class="card shadow-sm border-0" style="border-radius: 16px; background: linear-gradient(135deg, #fff 0%, #fafafa 100%);">
            <div class="card-header border-0 bg-transparent" style="padding: 1.5rem 1.5rem 0;">
                <h5 class="mb-0 fw-bold" style="color: #333; font-size: 1.3rem;">
                    <i class="fas fa-chart-bar me-2" style="color: #F26522;"></i>Account Stats
                </h5>
            </div>
            <div class="card-body" style="padding: 1.5rem;">
                <div class="stats-grid">
                    <div class="stat-item">
                        <div class="stat-icon" style="background: linear-gradient(135deg, #F26522 0%, #ea6500 100%); color: white; width: 50px; height: 50px; border-radius: 12px; display: flex; align-items: center; justify-content: center; margin-bottom: 12px;">
                            <i class="fas fa-car"></i>
                        </div>
                        <h6 class="fw-bold mb-1" style="color: #333;">My Cars</h6>
                        <p class="text-muted mb-0" style="font-size: 0.9rem;">{{ Auth::user()->cars->count() }} vehicles</p>
                    </div>
                    <div class="stat-item">
                        <div class="stat-icon" style="background: linear-gradient(135deg, #28a745 0%, #20c997 100%); color: white; width: 50px; height: 50px; border-radius: 12px; display: flex; align-items: center; justify-content: center; margin-bottom: 12px;">
                            <i class="fas fa-heart"></i>
                        </div>
                        <h6 class="fw-bold mb-1" style="color: #333;">Favorites</h6>
                        <p class="text-muted mb-0" style="font-size: 0.9rem;">{{ Auth::user()->carsFavorited->count() }} saved</p>
                    </div>
                    <div class="stat-item">
                        <div class="stat-icon" style="background: linear-gradient(135deg, #007bff 0%, #0056b3 100%); color: white; width: 50px; height: 50px; border-radius: 12px; display: flex; align-items: center; justify-content: center; margin-bottom: 12px;">
                            <i class="fas fa-calendar"></i>
                        </div>
                        <h6 class="fw-bold mb-1" style="color: #333;">Member Since</h6>
                        <p class="text-muted mb-0" style="font-size: 0.9rem;">{{ Auth::user()->created_at->format('M Y') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Password Update Section -->
<div class="row mt-4">
    <div class="col-lg-8">
        <div class="card shadow-sm border-0" style="border-radius: 16px; background: linear-gradient(135deg, #fff 0%, #fafafa 100%);">
            <div class="card-header border-0 bg-transparent" style="padding: 1.5rem 1.5rem 0;">
                <h5 class="mb-0 fw-bold" style="color: #333; font-size: 1.3rem;">
                    <i class="fas fa-shield-alt me-2" style="color: #F26522;"></i>Update Password
                </h5>
                <p class="text-muted mb-0 mt-2" style="font-size: 0.95rem;">Ensure your account is using a long, random password to stay secure.</p>
            </div>
            <div class="card-body" style="padding: 1.5rem;">
                @include('profile.partials.update-password-form')
            </div>
        </div>
    </div>

    <!-- Security Tips -->
    <div class="col-lg-4">
        <div class="card shadow-sm border-0" style="border-radius: 16px; background: linear-gradient(135deg, #fff 0%, #fafafa 100%);">
            <div class="card-header border-0 bg-transparent" style="padding: 1.5rem 1.5rem 0;">
                <h5 class="mb-0 fw-bold" style="color: #333; font-size: 1.3rem;">
                    <i class="fas fa-lock me-2" style="color: #F26522;"></i>Security Tips
                </h5>
            </div>
            <div class="card-body" style="padding: 1.5rem;">
                <div class="security-tips">
                    <div class="tip-item">
                        <i class="fas fa-check-circle me-2" style="color: #28a745;"></i>
                        <span style="font-size: 0.9rem;">Use a strong, unique password</span>
                    </div>
                    <div class="tip-item">
                        <i class="fas fa-check-circle me-2" style="color: #28a745;"></i>
                        <span style="font-size: 0.9rem;">Enable two-factor authentication</span>
                    </div>
                    <div class="tip-item">
                        <i class="fas fa-check-circle me-2" style="color: #28a745;"></i>
                        <span style="font-size: 0.9rem;">Keep your email verified</span>
                    </div>
                    <div class="tip-item">
                        <i class="fas fa-check-circle me-2" style="color: #28a745;"></i>
                        <span style="font-size: 0.9rem;">Regular security updates</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Delete Account Section -->
<div class="row mt-4">
    <div class="col-12">
        <div class="card shadow-sm border-0" style="border-radius: 16px; background: linear-gradient(135deg, #fff 0%, #fafafa 100%); border-left: 4px solid #dc3545;">
            <div class="card-header border-0 bg-transparent" style="padding: 1.5rem 1.5rem 0;">
                <h5 class="mb-0 fw-bold" style="color: #333; font-size: 1.3rem;">
                    <i class="fas fa-exclamation-triangle me-2" style="color: #dc3545;"></i>Danger Zone
                </h5>
                <p class="text-muted mb-0 mt-2" style="font-size: 0.95rem;">Once you delete your account, there is no going back. Please be certain.</p>
            </div>
            <div class="card-body" style="padding: 1.5rem;">
                @include('profile.partials.delete-user-form')
            </div>
        </div>
    </div>
</div>

@endsection

@push('styles')
<style>
/* Modern Form Styles */
.modern-input, .modern-select {
    border: 2px solid #e9ecef;
    border-radius: 10px;
    padding: 12px 16px;
    font-size: 0.95rem;
    transition: all 0.3s ease;
    background: white;
}

.modern-input:focus, .modern-select:focus {
    border-color: #F26522;
    box-shadow: 0 0 0 0.2rem rgba(242, 101, 34, 0.25);
    outline: none;
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

/* Stats Grid */
.stats-grid {
    display: grid;
    gap: 20px;
}

.stat-item {
    text-align: center;
    padding: 20px;
    background: white;
    border-radius: 12px;
    border: 2px solid #f8f9fa;
    transition: all 0.3s ease;
}

.stat-item:hover {
    border-color: #F26522;
    transform: translateY(-2px);
    box-shadow: 0 4px 15px rgba(242, 101, 34, 0.1);
}

/* Security Tips */
.security-tips {
    display: flex;
    flex-direction: column;
    gap: 12px;
}

.tip-item {
    display: flex;
    align-items: center;
    padding: 8px 0;
}

/* Profile Avatar Animation */
.avatar-circle {
    transition: all 0.3s ease;
}

.avatar-circle:hover {
    transform: scale(1.05);
    box-shadow: 0 12px 35px rgba(242, 101, 34, 0.4);
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

.btn-danger-modern {
    background: linear-gradient(135deg, #dc3545 0%, #c82333 100%);
    color: white;
    border: none;
    border-radius: 10px;
    padding: 12px 24px;
    font-weight: 600;
    transition: all 0.3s ease;
    box-shadow: 0 4px 15px rgba(220, 53, 69, 0.3);
}

.btn-danger-modern:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(220, 53, 69, 0.4);
    color: white;
}

/* Animations */
@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.card {
    animation: fadeInUp 0.6s ease-out;
}

/* Responsive Design */
@media (max-width: 768px) {
    .profile-avatar {
        margin-bottom: 1rem;
    }
    
    .stats-grid {
        grid-template-columns: repeat(2, 1fr);
    }
}

@media (max-width: 576px) {
    .stats-grid {
        grid-template-columns: 1fr;
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
// Form Validation Enhancement
document.querySelectorAll('.modern-input, .modern-select').forEach(input => {
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

// Password Strength Indicator
document.querySelectorAll('input[type="password"]').forEach(input => {
    input.addEventListener('input', function() {
        const password = this.value;
        const strength = calculatePasswordStrength(password);
        updatePasswordStrengthIndicator(this, strength);
    });
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
    let indicator = input.parentNode.querySelector('.password-strength');
    if (!indicator) {
        indicator = document.createElement('div');
        indicator.className = 'password-strength mt-2';
        input.parentNode.appendChild(indicator);
    }
    
    const colors = ['#dc3545', '#ffc107', '#28a745'];
    const messages = ['Weak', 'Medium', 'Strong'];
    const color = colors[Math.min(Math.floor(strength / 2), 2)];
    const message = messages[Math.min(Math.floor(strength / 2), 2)];
    
    indicator.innerHTML = `
        <div class="d-flex align-items-center">
            <div class="strength-bar me-2" style="flex: 1; height: 3px; background: #e9ecef; border-radius: 2px; overflow: hidden;">
                <div style="width: ${(strength / 5) * 100}%; height: 100%; background: ${color}; transition: width 0.3s ease;"></div>
            </div>
            <small style="color: ${color}; font-weight: 600; font-size: 0.8rem;">${message}</small>
        </div>
    `;
}

// Smooth scrolling
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
        e.preventDefault();
        document.querySelector(this.getAttribute('href')).scrollIntoView({
            behavior: 'smooth'
        });
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