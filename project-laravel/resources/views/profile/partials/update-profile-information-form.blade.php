<section>
    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-4">
        @csrf
        @method('patch')

        <div class="mb-4">
            <label for="name" class="form-label fw-semibold" style="color: #555; font-size: 0.95rem;">
                <i class="fas fa-user me-2" style="color: #F26522;"></i>Name
            </label>
            <input type="text" id="name" name="name" class="form-control modern-input" value="{{ old('name', $user->name) }}" required autofocus autocomplete="name" placeholder="Enter your full name">
            @error('name')
                <div class="text-danger mt-2" style="font-size: 0.9rem;">
                    <i class="fas fa-exclamation-circle me-1"></i>{{ $message }}
                </div>
            @enderror
        </div>

        <div class="mb-4">
            <label for="email" class="form-label fw-semibold" style="color: #555; font-size: 0.95rem;">
                <i class="fas fa-envelope me-2" style="color: #F26522;"></i>Email Address
            </label>
            <input type="email" id="email" name="email" class="form-control modern-input" value="{{ old('email', $user->email) }}" required autocomplete="username" placeholder="Enter your email address">
            @error('email')
                <div class="text-danger mt-2" style="font-size: 0.9rem;">
                    <i class="fas fa-exclamation-circle me-1"></i>{{ $message }}
                </div>
            @enderror

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div class="mt-3 p-3" style="background: #fff3cd; border: 1px solid #ffeaa7; border-radius: 8px;">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-exclamation-triangle me-2" style="color: #856404;"></i>
                        <span style="color: #856404; font-size: 0.9rem;">Your email address is unverified.</span>
                    </div>
                    <button form="send-verification" class="btn btn-link p-0 mt-2" style="color: #F26522; text-decoration: none; font-size: 0.9rem;">
                        <i class="fas fa-paper-plane me-1"></i>Click here to re-send the verification email
                    </button>
                </div>

                @if (session('status') === 'verification-link-sent')
                    <div class="mt-3 p-3" style="background: #d4edda; border: 1px solid #c3e6cb; border-radius: 8px;">
                        <div class="d-flex align-items-center">
                            <i class="fas fa-check-circle me-2" style="color: #155724;"></i>
                            <span style="color: #155724; font-size: 0.9rem;">A new verification link has been sent to your email address.</span>
                        </div>
                    </div>
                @endif
            @endif
        </div>

        <div class="d-flex align-items-center gap-3">
            <button type="submit" class="btn btn-modern">
                <i class="fas fa-save me-2"></i>Save Changes
            </button>

            @if (session('status') === 'profile-updated')
                <div class="d-flex align-items-center" style="color: #28a745;">
                    <i class="fas fa-check-circle me-2"></i>
                    <span style="font-size: 0.9rem; font-weight: 600;">Profile updated successfully!</span>
                </div>
            @endif
        </div>
    </form>
</section>
