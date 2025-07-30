<x-guest-layout>
    <div style="display: flex; justify-content: center; align-items: center; min-height: 90vh; background: #f2f2f2;">
        <div style="display: flex; flex-direction: row; align-items: center; background: none; box-shadow: none; border-radius: 0; padding: 0;">
            <!-- Form Section -->
            <div style="padding: 0 32px; min-width: 400px; display: flex; flex-direction: column; align-items: center;">
                <a href="/">
                    <img src="/images/logoipsum-265.svg" alt="Logo" style="height: 48px; margin-bottom: 8px;">
                </a>
                <h2 style="font-size: 2.2rem; font-weight: bold; color: #444; margin-bottom: 18px; margin-top: 8px;">Request Password Reset</h2>
                <form method="POST" action="{{ route('password.email') }}" style="width: 100%; max-width: 400px;">
                    @csrf
                    <input id="email" class="block w-full mb-3 p-3 rounded border border-gray-300 bg-[#fffbe6] focus:outline-none focus:border-orange-400" type="email" name="email" :value="old('email')" required autofocus placeholder="Your Email" />
                    <button type="submit" style="width: 100%; background: #ea6500; color: #fff; font-size: 1.2rem; border: none; border-radius: 30px; padding: 12px 0; margin-bottom: 16px; margin-top: 8px; cursor: pointer; font-weight: 500;">Request password reset</button>
                </form>
                <div style="margin-top: 8px; color: #444; text-align: center; font-size: 1rem;">
                    Already have an account? - <a href="{{ route('login') }}" style="color: #ea6500; text-decoration: none;">Click here to login</a>
                </div>
            </div>
            <!-- Car Image Section -->
            <div style="padding: 0 40px;">
                <img src="/images/car-png-39071.png" alt="Car" style="max-width: 400px; width: 100%; height: auto;">
            </div>
        </div>
    </div>
</x-guest-layout>
