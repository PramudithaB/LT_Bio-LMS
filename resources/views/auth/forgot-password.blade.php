<x-guest-layout>
    <div class="mb-4">
        <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-200 mb-2">
            {{ __('Forgot Your Password?') }}
        </h2>
        <p class="text-sm text-gray-600 dark:text-gray-400">
            {{ __('No problem! Enter your email address and we will send you a One-Time Password (OTP) to reset your password.') }}
        </p>
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <!-- Error Message -->
    @if(session('error'))
        <div class="mb-4 p-4 bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 rounded-lg">
            <p class="text-sm text-red-600 dark:text-red-400">{{ session('error') }}</p>
        </div>
    @endif

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email Address')" />
            <x-text-input 
                id="email" 
                class="block mt-1 w-full {{ $errors->has('email') ? 'border-red-500 dark:border-red-500' : '' }}" 
                type="email" 
                name="email" 
                :value="old('email')" 
                required 
                autofocus 
                placeholder="your@email.com"
            />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
            @if($errors->has('email'))
                <p class="mt-2 text-xs text-red-600 dark:text-red-400">
                    <strong>Tip:</strong> Make sure you're using a registered email address.
                </p>
            @endif
        </div>

        <div class="flex items-center justify-between mt-4">
            <a href="{{ route('login') }}" class="text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100">
                {{ __('Back to Login') }}
            </a>

            <x-primary-button>
                {{ __('Send OTP') }}
            </x-primary-button>
        </div>
    </form>

    <div class="mt-4 p-4 bg-blue-50 dark:bg-blue-900/20 rounded-lg">
        <p class="text-xs text-blue-600 dark:text-blue-400">
            <strong>📧 Note:</strong> You will receive a 6-digit OTP code via email. The code will be valid for 10 minutes.
        </p>
    </div>
</x-guest-layout>
