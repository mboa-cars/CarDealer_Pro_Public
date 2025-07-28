<x-guest-layout>
    <div style="display: flex; justify-content: center; align-items: center; min-height: 90vh; background: #f2f2f2;">
        <div style="display: flex; flex-direction: row; align-items: center; background: none; box-shadow: none; border-radius: 0; padding: 0;">
            <!-- Form Section -->
            <div style="padding: 0 32px; min-width: 350px; display: flex; flex-direction: column; align-items: center;">
                <div style="text-align: center; margin-bottom: 20px;">
                    <a href="/">
                        <img src="/images/logoipsum-265.svg" alt="Logo" style="height: 48px; margin-bottom: 8px;">
                    </a>
                    <h2 style="font-size: 2rem; font-weight: bold; color: #666; margin-bottom: 8px;">Signup</h2>
                </div>
                <form method="POST" action="{{ route('register') }}" style="width: 350px;">
                    @csrf
                    <!-- Name -->
                    <input type="text" name="name" placeholder="Name" value="{{ old('name') }}" required autofocus style="width: 100%; margin-bottom: 12px; padding: 10px; border-radius: 6px; border: 1px solid #ddd; background: #fffbe6;">
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    <!-- Email -->
                    <input type="email" name="email" placeholder="Email" value="{{ old('email') }}" required style="width: 100%; margin-bottom: 12px; padding: 10px; border-radius: 6px; border: 1px solid #ddd; background: #fffbe6;">
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    <!-- Phone -->
                    <input type="text" name="phone" placeholder="Phone" value="{{ old('phone') }}" required style="width: 100%; margin-bottom: 12px; padding: 10px; border-radius: 6px; border: 1px solid #ddd; background: #fffbe6;">
                    <x-input-error :messages="$errors->get('phone')" class="mt-2" />
                    <!-- Password -->
                    <input type="password" name="password" placeholder="Password" required style="width: 100%; margin-bottom: 12px; padding: 10px; border-radius: 6px; border: 1px solid #ddd; background: #fffbe6;">
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    <!-- Repeat Password -->
                    <input type="password" name="password_confirmation" placeholder="Repeat Password" required style="width: 100%; margin-bottom: 18px; padding: 10px; border-radius: 6px; border: 1px solid #ddd; background: #fffbe6;">
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                    <button type="submit" style="width: 100%; background: #ea6500; color: #fff; font-size: 1.2rem; border: none; border-radius: 30px; padding: 12px 0; margin-bottom: 16px; margin-top: 8px; cursor: pointer; font-weight: 500;">Register</button>
                    <div style="display: flex; gap: 12px; margin-bottom: 10px;">
                        <button type="button" style="flex: 1; background: #fff; border: 1px solid #eee; border-radius: 8px; padding: 8px 0; display: flex; align-items: center; justify-content: center; gap: 8px; font-size: 1rem; cursor: pointer;">
                            <img src="/images/google.png" alt="Google" style="height: 20px;"> Google
                        </button>
                        <button type="button" style="flex: 1; background: #fff; border: 1px solid #eee; border-radius: 8px; padding: 8px 0; display: flex; align-items: center; justify-content: center; gap: 8px; font-size: 1rem; cursor: pointer;">
                            <img src="/images/facebook.png" alt="Facebook" style="height: 20px;"> Facebook
                        </button>
                    </div>
                    <div style="text-align: center; font-size: 0.98rem; color: #666;">
                        Already have an account? - <a href="{{ route('login') }}" style="color: #ea6500; text-decoration: none;">Click here to login</a>
                    </div>
                </form>
            </div>
            <!-- Car Image Section -->
            <div style="padding: 0 40px;">
                <img src="images/car-png-39071.png" alt="Car" style="max-width: 350px; width: 100%; height: auto;">
            </div>
        </div>
    </div>
</x-guest-layout>
