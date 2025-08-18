@extends('layouts.guest')

@section('content')
<div class="min-vh-100 d-flex align-items-center" style="background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);">
    <div class="container">
        <div class="row align-items-center justify-content-center">
            <!-- Forgot Password Form Section -->
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
                            <h3 class="fw-bold mb-0" style="color: #333; font-size: 1.8rem;">Forgot Password</h3>
                            <p class="text-muted mt-2 mb-0" style="font-size: 0.9rem;">Enter your email address and we'll send you a link to reset your password.</p>
                        </div>

                        <!-- Session Status -->
                        @if(session('status'))
                            <div class="alert alert-success border-0 mb-3" style="background: linear-gradient(135deg, #28a745 0%, #20c997 100%); color: white; border-radius: 10px; font-size: 0.9rem;">
                                <div class="d-flex align-items-center">
                                    <i class="fas fa-check-circle me-2" style="font-size: 1rem;"></i>
                                    <span>{{ session('status') }}</span>
                                </div>
                            </div>
                        @endif

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

                        <!-- Forgot Password Form -->
                        <form method="POST" action="{{ route('password.email') }}" id="forgotPasswordForm">
                            @csrf

                            <!-- Email Address -->
                            <div class="mb-4">
                                <label for="email" class="form-label fw-semibold" style="color: #555; font-size: 0.9rem;">
                                    <i class="fas fa-envelope me-1" style="color: #F26522;"></i>Your Email Address
                                </label>
                                <input type="email" id="email" name="email" class="form-control modern-input" value="{{ old('email') }}" required autofocus autocomplete="username" placeholder="Enter your email address">
                                <small class="text-muted mt-1 d-block" style="font-size: 0.8rem;">
                                    <i class="fas fa-info-circle me-1"></i>We'll send you a secure link to reset your password.
                                </small>
                            </div>

                            <!-- Submit Button -->
                            <div class="mb-4">
                                <button type="submit" class="btn w-100 btn-modern" style="padding: 12px; font-size: 1rem; font-weight: 600;">
                                    <i class="fas fa-paper-plane me-2"></i>Send Reset Link
                                </button>
                            </div>

                            <!-- Divider -->
                            <div class="d-flex align-items-center my-3">
                                <hr class="flex-grow-1"/>
                                <span class="mx-2 text-muted" style="font-size: .9rem;">or reset via SMS</span>
                                <hr class="flex-grow-1"/>
                            </div>

                            <!-- OTP via SMS -->
                            <div class="mb-3">
                                <label class="form-label fw-semibold" for="reset-phone" style="color:#555; font-size:.9rem;">
                                    <i class="fas fa-phone me-1" style="color:#F26522;"></i>Phone Number
                                </label>
                                <input type="text" id="reset-phone" class="form-control modern-input" placeholder="e.g. +2376xxxxxxx" />
                            </div>
                            <div class="mb-3 d-flex gap-2">
                                <button type="button" id="send-reset-otp-btn" class="btn btn-outline-secondary" style="border-radius:10px;">
                                    <i class="fas fa-sms me-1"></i>Send Code
                                </button>
                                <input type="text" id="reset-otp-code" class="form-control modern-input" placeholder="6-digit code" inputmode="numeric" pattern="[0-9]*" style="max-width: 180px;"/>
                                <button type="button" id="reset-with-otp-btn" class="btn btn-modern" style="border-radius:10px;">
                                    <i class="fas fa-unlock-alt me-1"></i>Reset via OTP
                                </button>
                            </div>
                            <div id="reset-otp-feedback" class="mb-2" style="min-height:22px; font-size:.9rem; color:#666;"></div>

                            <!-- Back to Login -->
                            <div class="text-center">
                                <span class="text-muted" style="font-size: 0.85rem;">Remember your password? - </span>
                                <a href="{{ route('login') }}" class="text-decoration-none" style="color: #F26522; font-weight: 600;">Back to Login</a>
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
                                <i class="fas fa-shield-alt me-2" style="color: #28a745;"></i>
                                <span style="font-weight: 600; color: #333; font-size: 0.9rem;">Secure Reset</span>
                            </div>
                        </div>
                        <div class="floating-card" style="position: absolute; bottom: 15px; left: -15px; background: white; padding: 12px; border-radius: 10px; box-shadow: 0 8px 25px rgba(0,0,0,0.1); transform: rotate(-5deg);">
                            <div class="d-flex align-items-center">
                                <i class="fas fa-envelope me-2" style="color: #F26522;"></i>
                                <span style="font-weight: 600; color: #333; font-size: 0.9rem;">Email Link</span>
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

/* Success Animation */
.success-animation {
    animation: successPulse 0.6s ease-in-out;
}

@keyframes successPulse {
    0% { transform: scale(1); }
    50% { transform: scale(1.05); }
    100% { transform: scale(1); }
}
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('forgotPasswordForm');
    const sendNewBtn = document.getElementById('sendNewPasswordBtn');
    if (sendNewBtn) {
        sendNewBtn.addEventListener('click', function () {
            if (!form) return;
            const originalAction = form.getAttribute('action');
            form.setAttribute('action', "{{ route('password.send-new') }}");
            form.submit();
            // restore action to keep default behavior for next time
            form.setAttribute('action', originalAction);
        });
    }
});
</script>
@endpush

@push('scripts')
<script>
(function(){
    const form = document.getElementById('forgotPasswordForm');
    const phoneInput = document.getElementById('reset-phone');
    const sendBtn = document.getElementById('send-reset-otp-btn');
    const codeInput = document.getElementById('reset-otp-code');
    const resetBtn = document.getElementById('reset-with-otp-btn');
    const feedback = document.getElementById('reset-otp-feedback');

    if (!form) return;
    const csrf = form.querySelector('input[name="_token"]')?.value || '';

    function isE164(v){
        return /^\+[1-9]\d{7,14}$/.test(v); // E.164 strict
    }
    async function postJson(url, data){
        const res = await fetch(url, {
            method: 'POST',
            headers: { 'Content-Type':'application/json', 'X-CSRF-TOKEN': csrf, 'Accept':'application/json' },
            body: JSON.stringify(data)
        });
        const json = await res.json().catch(()=>({}));
        if (!res.ok) throw new Error(json.message || 'Request failed');
        return json;
    }
    if (sendBtn){
        sendBtn.addEventListener('click', async ()=>{
            feedback.textContent='';
            const phone = phoneInput.value.trim();
            if (!isE164(phone)) { feedback.style.color = '#c00'; feedback.textContent = 'Veuillez saisir un numéro au format E.164 (ex: +237657XXXXXX).'; return; }
            sendBtn.disabled = true; sendBtn.classList.add('btn-loading');
            try { await postJson('/auth/otp/reset/send', { phone }); feedback.style.color = '#090'; feedback.textContent = 'Code envoyé par SMS. Il expire dans 5 minutes.'; }
            catch(e){ feedback.style.color = '#c00'; feedback.textContent = e.message; }
            finally { sendBtn.disabled = false; sendBtn.classList.remove('btn-loading'); }
        });
    }
    if (resetBtn){
        resetBtn.addEventListener('click', async ()=>{
            feedback.textContent='';
            const phone = phoneInput.value.trim();
            const code = codeInput.value.trim();
            if (!isE164(phone)) { feedback.style.color = '#c00'; feedback.textContent = 'Veuillez saisir un numéro au format E.164 (ex: +237657XXXXXX).'; return; }
            if (!/^\d{6}$/.test(code)) { feedback.style.color = '#c00'; feedback.textContent = 'Entrez un code à 6 chiffres.'; return; }
            resetBtn.disabled = true; resetBtn.classList.add('btn-loading');
            try { await postJson('/auth/otp/reset/confirm', { phone, code }); feedback.style.color = '#090'; feedback.textContent = 'Mot de passe temporaire envoyé par SMS. Connectez-vous puis changez-le.'; }
            catch(e){ feedback.style.color = '#c00'; feedback.textContent = e.message; }
            finally { resetBtn.disabled = false; resetBtn.classList.remove('btn-loading'); }
        });
    }
})();
</script>
@endpush

@push('scripts')
<script>
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

// Form Submission with Loading State
document.getElementById('forgotPasswordForm').addEventListener('submit', function(e) {
    const submitBtn = this.querySelector('button[type="submit"]');
    submitBtn.classList.add('btn-loading');
    submitBtn.disabled = true;
    
    // Re-enable button after 3 seconds in case of error
    setTimeout(() => {
        submitBtn.classList.remove('btn-loading');
        submitBtn.disabled = false;
    }, 3000);
});

// Auto-hide alerts
document.querySelectorAll('.alert').forEach(alert => {
    setTimeout(() => {
        alert.style.opacity = '0';
        setTimeout(() => alert.remove(), 300);
    }, 5000);
});

// Email validation enhancement
document.getElementById('email').addEventListener('input', function() {
    const email = this.value;
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    
    if (email && emailRegex.test(email)) {
        this.classList.add('is-valid');
        this.classList.remove('is-invalid');
    } else if (email) {
        this.classList.add('is-invalid');
        this.classList.remove('is-valid');
    } else {
        this.classList.remove('is-valid', 'is-invalid');
    }
});

// Success message animation
document.addEventListener('DOMContentLoaded', function() {
    const successAlert = document.querySelector('.alert-success');
    if (successAlert) {
        successAlert.classList.add('success-animation');
    }
});
</script>
@endpush
