<section>
    <div class="d-flex align-items-center gap-3">
        <button type="button" class="btn btn-danger-modern" data-bs-toggle="modal" data-bs-target="#confirm-user-deletion">
            <i class="fas fa-trash-alt me-2"></i>Delete Account
        </button>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="confirm-user-deletion" tabindex="-1" aria-labelledby="confirm-user-deletion-label" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" style="border-radius: 16px; border: none; box-shadow: 0 10px 40px rgba(0, 0, 0, 0.2);">
                <div class="modal-header border-0" style="padding: 1.5rem 1.5rem 0;">
                    <h5 class="modal-title fw-bold" id="confirm-user-deletion-label" style="color: #333; font-size: 1.3rem;">
                        <i class="fas fa-exclamation-triangle me-2" style="color: #dc3545;"></i>Delete Account
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" style="padding: 1.5rem;">
                    <div class="alert alert-warning border-0" style="background: #fff3cd; border: 1px solid #ffeaa7; border-radius: 8px; color: #856404;">
                        <div class="d-flex align-items-center">
                            <i class="fas fa-exclamation-triangle me-3" style="font-size: 1.2rem;"></i>
                            <div>
                                <strong>Warning:</strong> This action cannot be undone. All your data will be permanently deleted.
                            </div>
                        </div>
                    </div>
                    
                    <p class="text-muted mb-4" style="font-size: 0.95rem;">
                        Once your account is deleted, all of its resources and data will be permanently deleted. 
                        Before deleting your account, please download any data or information that you wish to retain.
                    </p>

                    <form method="post" action="{{ route('profile.destroy') }}">
                        @csrf
                        @method('delete')

                        <div class="mb-4">
                            <label for="password" class="form-label fw-semibold" style="color: #555; font-size: 0.95rem;">
                                <i class="fas fa-key me-2" style="color: #dc3545;"></i>Confirm Password
                            </label>
                            <input type="password" id="password" name="password" class="form-control modern-input" placeholder="Enter your password to confirm" required>
                            @error('password', 'userDeletion')
                                <div class="text-danger mt-2" style="font-size: 0.9rem;">
                                    <i class="fas fa-exclamation-circle me-1"></i>{{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="d-flex gap-3">
                            <button type="button" class="btn flex-fill" style="background: #f8f9fa; color: #666; border: 2px solid #e9ecef; border-radius: 12px; padding: 12px; font-weight: 600; transition: all 0.3s ease;" data-bs-dismiss="modal">
                                <i class="fas fa-times me-2"></i>Cancel
                            </button>
                            <button type="submit" class="btn btn-danger-modern flex-fill">
                                <i class="fas fa-trash-alt me-2"></i>Delete Account
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
