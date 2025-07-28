@extends('layouts.app')

@section('content')
<div style="display: flex; justify-content: center; align-items: center; min-height: 90vh; background: #f2f2f2;">
    <div style="display: flex; flex-direction: row; align-items: center; background: none; box-shadow: none; border-radius: 0; padding: 0;">
        <!-- Form Section -->
        <div style="padding: 0 32px; min-width: 350px; display: flex; flex-direction: column; align-items: center;">
            <a href="/">
                <img src="/images/logoipsum-265.svg" alt="Logo" style="height: 48px; margin-bottom: 8px;">
            </a>
            <h2 style="font-size: 2rem; font-weight: bold; color: #666; margin-bottom: 18px; margin-top: 8px;">My Profile</h2>
            
            @if(session('status'))
                <div style="background: #d4edda; color: #155724; padding: 12px; border-radius: 6px; margin-bottom: 18px; border: 1px solid #c3e6cb;">
                    {{ session('status') === 'profile-updated' ? 'Profile updated successfully!' : session('status') }}
                </div>
            @endif
            <form method="POST" action="{{ route('profile.update') }}" style="width: 100%; max-width: 350px;">
                @csrf
                @method('PATCH')
                <input type="text" name="name" value="{{ Auth::user()->name }}" placeholder="Name" style="width: 100%; margin-bottom: 12px; padding: 10px; border-radius: 6px; border: 1px solid #ddd; background: #fffbe6;">
                <input type="email" name="email" value="{{ Auth::user()->email }}" placeholder="Email" style="width: 100%; margin-bottom: 12px; padding: 10px; border-radius: 6px; border: 1px solid #ddd; background: #fffbe6;" readonly>
                <input type="text" name="phone" value="{{ Auth::user()->phone }}" placeholder="Phone" style="width: 100%; margin-bottom: 18px; padding: 10px; border-radius: 6px; border: 1px solid #ddd; background: #fffbe6;">
                <div style="display: flex; gap: 10px; margin-bottom: 18px;">
                    <button type="button" onclick="resetForm()" style="flex: 1; background: #f8f9fa; color: #666; font-size: 1rem; border: 1px solid #ddd; border-radius: 30px; padding: 12px 0; cursor: pointer;">Reset</button>
                    <button type="submit" style="flex: 1; background: #ea6500; color: #fff; font-size: 1rem; border: none; border-radius: 30px; padding: 12px 0; cursor: pointer; font-weight: 500;">Update</button>
                </div>
            </form>
            <hr style="width:100%; margin: 24px 0;">
            <h5 style="font-weight: bold; margin-bottom: 12px;">Change Password</h5>
            <form method="POST" action="{{ route('password.update') }}" style="width: 100%; max-width: 350px;">
                @csrf
                @method('PUT')
                <input type="password" name="current_password" placeholder="Current Password" style="width: 100%; margin-bottom: 12px; padding: 10px; border-radius: 6px; border: 1px solid #ddd; background: #fffbe6;">
                <input type="password" name="password" placeholder="New Password" style="width: 100%; margin-bottom: 12px; padding: 10px; border-radius: 6px; border: 1px solid #ddd; background: #fffbe6;">
                <input type="password" name="password_confirmation" placeholder="Repeat Password" style="width: 100%; margin-bottom: 18px; padding: 10px; border-radius: 6px; border: 1px solid #ddd; background: #fffbe6;">
                <button type="submit" style="width: 100%; background: #ea6500; color: #fff; font-size: 1.1rem; border: none; border-radius: 30px; padding: 12px 0; margin-top: 10px; cursor: pointer; font-weight: 500;">Update Password</button>
            </form>
        </div>
        <!-- Car Image Section -->
        <div style="padding: 0 40px;">
            <img src="/images/car-png-39071.png" alt="Car" style="max-width: 350px; width: 100%; height: auto;">
        </div>
    </div>
</div>

<script>
function resetForm() {
    // Reset the profile form to original values
    const form = document.querySelector('form[action*="profile.update"]');
    const nameInput = form.querySelector('input[name="name"]');
    const phoneInput = form.querySelector('input[name="phone"]');
    
    // Reset to original values (you might want to store these in data attributes)
    nameInput.value = '{{ Auth::user()->name }}';
    phoneInput.value = '{{ Auth::user()->phone }}';
    
    alert('Form reset to original values');
}

// Add some interactivity
document.addEventListener('DOMContentLoaded', function() {
    // Add focus effects to inputs
    const inputs = document.querySelectorAll('input[type="text"], input[type="email"], input[type="password"]');
    inputs.forEach(input => {
        input.addEventListener('focus', function() {
            this.style.borderColor = '#ea6500';
        });
        input.addEventListener('blur', function() {
            this.style.borderColor = '#ddd';
        });
    });
});
</script>
@endsection 