<x-guest-layout>
    <div class="mb-4 text-sm text-gray-600 dark:text-gray-400">
        {{ __('Please enter the 6-digit OTP code that was sent to your email address.') }}
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <!-- Error Message -->
    @if(session('error'))
        <div class="mb-4 p-4 bg-red-50 dark:bg-red-900/20 border-l-4 border-red-500 rounded-lg">
            <div class="flex items-start">
                <div class="flex-shrink-0">
                    <svg class="h-5 w-5 text-red-500" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                    </svg>
                </div>
                <div class="ml-3">
                    <p class="text-sm font-medium text-red-600 dark:text-red-400">{{ session('error') }}</p>
                    @if(session('show_request_new'))
                        <div class="mt-2">
                            <a href="{{ route('password.request') }}" class="text-sm font-semibold text-red-700 dark:text-red-300 hover:text-red-900 dark:hover:text-red-100 underline">
                                → Click here to request a new OTP
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    @endif

    <!-- All Validation Errors -->
    @if($errors->any())
        <div class="mb-4 p-4 bg-red-50 dark:bg-red-900/20 border-l-4 border-red-500 rounded-lg">
            <div class="flex items-start">
                <div class="flex-shrink-0">
                    <svg class="h-5 w-5 text-red-500" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                    </svg>
                </div>
                <div class="ml-3 flex-1">
                    <p class="text-sm font-semibold text-red-600 dark:text-red-400 mb-2">Verification Failed:</p>
                    <ul class="list-disc list-inside text-sm text-red-600 dark:text-red-400 space-y-1">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <div class="mt-3 text-xs text-red-500 dark:text-red-400">
                        <strong>💡 Tips:</strong>
                        <ul class="list-disc list-inside mt-1 ml-2">
                            <li>Check your email for the correct 6-digit code</li>
                            <li>Make sure you're entering the most recent OTP</li>
                            <li>OTP codes expire after 10 minutes</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <form method="POST" action="{{ route('password.verify.otp.post') }}">
        @csrf

        <!-- Email Address (Hidden) -->
        <input type="hidden" name="email" value="{{ session('email') }}" />

        <!-- Display Email -->
        <div class="mb-4">
            <x-input-label for="display_email" :value="__('Email Address')" />
            <x-text-input 
                id="display_email" 
                class="block mt-1 w-full bg-gray-100 dark:bg-gray-700" 
                type="email" 
                :value="session('email')" 
                disabled 
            />
        </div>

        <!-- OTP Code -->
        <div>
            <x-input-label for="otp" :value="__('OTP Code')" />
            <x-text-input 
                id="otp" 
                class="block mt-1 w-full text-center text-2xl tracking-widest {{ $errors->has('otp') ? 'border-red-500 dark:border-red-500' : '' }}" 
                type="text" 
                name="otp" 
                maxlength="6" 
                pattern="\d{6}"
                placeholder="000000"
                :value="old('otp')"
                required 
                autofocus 
            />
            <x-input-error :messages="$errors->get('otp')" class="mt-2" />
            <p class="mt-2 text-xs text-gray-500 dark:text-gray-400">
                The OTP is valid for 10 minutes.
            </p>
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button>
                {{ __('Verify OTP') }}
            </x-primary-button>
        </div>
    </form>

    <!-- Additional Options -->
    <div class="mt-6 pt-4 border-t border-gray-200 dark:border-gray-700">
        <p class="text-sm text-gray-600 dark:text-gray-400 mb-3 text-center">
            Having trouble?
        </p>
        <div class="flex flex-col sm:flex-row gap-3 justify-center">
            <form method="POST" action="{{ route('password.email') }}" class="inline">
                @csrf
                <input type="hidden" name="email" value="{{ session('email') }}">
                <button type="submit" class="inline-flex items-center justify-center px-4 py-2 bg-gray-200 dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-md font-semibold text-xs text-gray-700 dark:text-gray-300 uppercase tracking-widest hover:bg-gray-300 dark:hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                    🔄 {{ __('Resend OTP') }}
                </button>
            </form>
            <a href="{{ route('password.request') }}" class="inline-flex items-center justify-center px-4 py-2 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-600 rounded-md font-semibold text-xs text-gray-700 dark:text-gray-300 uppercase tracking-widest hover:bg-gray-50 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                ✉️ {{ __('Change Email') }}
            </a>
        </div>
        <p class="text-xs text-center text-gray-500 dark:text-gray-400 mt-3">
            Didn't receive the code? Click "Resend OTP" or use a different email address.
        </p>
    </div>

    <script>
        // Auto-format OTP input to accept only numbers
        document.getElementById('otp').addEventListener('input', function(e) {
            this.value = this.value.replace(/\D/g, '');
        });

        // Auto-focus OTP input
        document.getElementById('otp').focus();
    </script>
</x-guest-layout>
