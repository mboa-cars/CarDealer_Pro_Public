<section>
    <form method="post" action="{{ route('password.update') }}" class="mt-4">
        @csrf
        @method('put')

        <div class="mb-4">
            <label for="update_password_current_password" class="form-label fw-semibold" style="color: #555; font-size: 0.95rem;">
                <i class="fas fa-key me-2" style="color: #F26522;"></i>Current Password
            </label>
            <input type="password" id="update_password_current_password" name="current_password" class="form-control modern-input" autocomplete="current-password" placeholder="Enter your current password">
            @error('current_password', 'updatePassword')
                <div class="text-danger mt-2" style="font-size: 0.9rem;">
                    <i class="fas fa-exclamation-circle me-1"></i>{{ $message }}
                </div>
            @enderror
        </div>

        <div class="mb-4">
            <label for="update_password_password" class="form-label fw-semibold" style="color: #555; font-size: 0.95rem;">
                <i class="fas fa-lock me-2" style="color: #F26522;"></i>New Password
            </label>
            <input type="password" id="update_password_password" name="password" class="form-control modern-input" autocomplete="new-password" placeholder="Enter your new password">
            @error('password', 'updatePassword')
                <div class="text-danger mt-2" style="font-size: 0.9rem;">
                    <i class="fas fa-exclamation-circle me-1"></i>{{ $message }}
                </div>
            @enderror
        </div>

        <div class="mb-4">
            <label for="update_password_password_confirmation" class="form-label fw-semibold" style="color: #555; font-size: 0.95rem;">
                <i class="fas fa-lock me-2" style="color: #F26522;"></i>Confirm New Password
            </label>
            <input type="password" id="update_password_password_confirmation" name="password_confirmation" class="form-control modern-input" autocomplete="new-password" placeholder="Confirm your new password">
            @error('password_confirmation', 'updatePassword')
                <div class="text-danger mt-2" style="font-size: 0.9rem;">
                    <i class="fas fa-exclamation-circle me-1"></i>{{ $message }}
                </div>
            @enderror
        </div>

        <div class="d-flex align-items-center gap-3">
            <button type="submit" class="btn btn-modern">
                <i class="fas fa-shield-alt me-2"></i>Update Password
            </button>

            @if (session('status') === 'password-updated')
                <div class="d-flex align-items-center" style="color: #28a745;">
                    <i class="fas fa-check-circle me-2"></i>
                    <span style="font-size: 0.9rem; font-weight: 600;">Password updated successfully!</span>
                </div>
            @endif
        </div>
    </form>
</section>
