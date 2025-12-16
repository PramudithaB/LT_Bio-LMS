<x-guest-layout>
    <div class="mb-4 text-sm text-gray-600 dark:text-gray-400">
        {{ __('Please enter your new password. Make sure it is at least 8 characters long.') }}
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
                    <p class="text-sm font-semibold text-red-600 dark:text-red-400 mb-2">Please fix the following errors:</p>
                    <ul class="list-disc list-inside text-sm text-red-600 dark:text-red-400 space-y-1">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    @if($errors->has('password'))
                        <div class="mt-3 p-3 bg-yellow-50 dark:bg-yellow-900/20 rounded border border-yellow-200 dark:border-yellow-800">
                            <p class="text-xs font-semibold text-yellow-800 dark:text-yellow-300 mb-1">💡 Password Requirements:</p>
                            <ul class="list-disc list-inside text-xs text-yellow-700 dark:text-yellow-400 ml-2">
                                <li>Minimum 8 characters long</li>
                                <li>Both passwords must match exactly</li>
                                <li>Type carefully and double-check</li>
                            </ul>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    @endif

    <form method="POST" action="{{ route('password.reset.post') }}">
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

        <!-- Password -->
        <div>
            <x-input-label for="password" :value="__('New Password')" />
            <x-text-input 
                id="password" 
                class="block mt-1 w-full {{ $errors->has('password') ? 'border-red-500 dark:border-red-500 ring-2 ring-red-200 dark:ring-red-800' : '' }}" 
                type="password" 
                name="password" 
                required 
                autofocus 
                autocomplete="new-password"
            />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
            @if(!$errors->has('password'))
                <p class="mt-2 text-xs text-gray-500 dark:text-gray-400">
                    ✓ Must be at least 8 characters long
                </p>
            @endif
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
            <x-text-input 
                id="password_confirmation" 
                class="block mt-1 w-full {{ $errors->has('password') || $errors->has('password_confirmation') ? 'border-red-500 dark:border-red-500 ring-2 ring-red-200 dark:ring-red-800' : '' }}" 
                type="password" 
                name="password_confirmation" 
                required 
                autocomplete="new-password"
            />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            @if(!$errors->has('password'))
                <p class="mt-2 text-xs text-gray-500 dark:text-gray-400">
                    ✓ Re-enter the same password
                </p>
            @endif
        </div>

        <!-- Password Match Indicator -->
        <div id="passwordMatchIndicator" class="mt-3 hidden">
            <div id="matchSuccess" class="hidden p-3 bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800 rounded-lg">
                <p class="text-sm text-green-600 dark:text-green-400">
                    ✓ Passwords match! You can proceed.
                </p>
            </div>
            <div id="matchError" class="hidden p-3 bg-amber-50 dark:bg-amber-900/20 border border-amber-200 dark:border-amber-800 rounded-lg">
                <p class="text-sm text-amber-600 dark:text-amber-400">
                    ⚠ Passwords do not match. Please check and try again.
                </p>
            </div>
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button id="submitButton">
                {{ __('Reset Password') }}
            </x-primary-button>
        </div>
    </form>

    <script>
        // Real-time password match validation
        const password = document.getElementById('password');
        const passwordConfirmation = document.getElementById('password_confirmation');
        const matchIndicator = document.getElementById('passwordMatchIndicator');
        const matchSuccess = document.getElementById('matchSuccess');
        const matchError = document.getElementById('matchError');
        const submitButton = document.getElementById('submitButton');

        function checkPasswordMatch() {
            const pwd = password.value;
            const confirmPwd = passwordConfirmation.value;

            if (confirmPwd.length > 0) {
                matchIndicator.classList.remove('hidden');
                
                if (pwd === confirmPwd && pwd.length >= 8) {
                    matchSuccess.classList.remove('hidden');
                    matchError.classList.add('hidden');
                    passwordConfirmation.classList.remove('border-red-500', 'ring-2', 'ring-red-200');
                    passwordConfirmation.classList.add('border-green-500', 'ring-2', 'ring-green-200');
                } else {
                    matchSuccess.classList.add('hidden');
                    matchError.classList.remove('hidden');
                    passwordConfirmation.classList.remove('border-green-500', 'ring-2', 'ring-green-200');
                    if (pwd !== confirmPwd) {
                        passwordConfirmation.classList.add('border-amber-500', 'ring-2', 'ring-amber-200');
                    }
                }
            } else {
                matchIndicator.classList.add('hidden');
                passwordConfirmation.classList.remove('border-red-500', 'border-green-500', 'border-amber-500', 'ring-2');
            }
        }

        password.addEventListener('input', checkPasswordMatch);
        passwordConfirmation.addEventListener('input', checkPasswordMatch);

        // Show password strength
        password.addEventListener('input', function() {
            const length = this.value.length;
            if (length > 0 && length < 8) {
                this.classList.add('border-amber-500', 'ring-2', 'ring-amber-200');
                this.classList.remove('border-green-500', 'ring-green-200');
            } else if (length >= 8) {
                this.classList.remove('border-amber-500', 'ring-amber-200');
                this.classList.add('border-green-500', 'ring-2', 'ring-green-200');
            } else {
                this.classList.remove('border-amber-500', 'border-green-500', 'ring-2');
            }
        });
    </script>
</x-guest-layout>
