<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modern Registration UI</title>
    <!-- Load Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Custom Tailwind Configuration for the specific purple color -->
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        // Using the same rich purple palette
                        'primary-purple': '#ff0000', 
                        'dark-purple': '#ff0000', // Darker shade for hover/background
                        'form-border': '#ff0000', 
                    },
                }
            }
        }
    </script>
    <style>
        /* Custom font import */
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;800&display=swap');
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f9fafb;
        }

        /* Input field styling */
        .form-input-styled {
            height: 52px; 
            transition: all 0.2s;
            border-color: #e5e7eb;
            box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05); 
            border-radius: 0.5rem; 
            padding-left: 1rem;
            padding-right: 1rem;
        }
        .form-input-styled:focus {
            border-color: #8b5cf6; 
            box-shadow: 0 0 0 1px #8b5cf6;
        }

        /* Left panel graphic simulation */
        .left-panel-bg {
            background-image: url('');
            background-size: cover;
            background-position: center;
        }
    </style>
</head>
<body class="antialiased">

<div class="min-h-screen flex">

    <!-- LEFT PANEL: Illustration/Branding (Identical to login page for consistency) -->
    <div class="hidden lg:flex lg:w-1/2 relative items-center justify-center rounded-r-3xl overflow-hidden shadow-2xl left-panel-bg">
        <!-- Semi-transparent purple overlay to enhance the graphic look -->
        <div class="absolute inset-0 bg-primary-purple opacity-90 mix-blend-multiply"></div>
        
        <!-- Everest Branding Text (Simulated) -->
        <div class="relative z-10 p-10 text-left text-white">
            <h1 class="text-6xl font-extrabold tracking-tighter">
                LTBio.lk
            </h1>
            <p class="text-3xl font-light mt-1">
                ONLINE EDUCATION
            </p>
            <div class="mt-8">
                <!-- Placeholder for the monitor screen graphic shown in the image -->
                <div class="w-96 h-64 bg-white/20 rounded-xl border border-white/50 backdrop-blur-sm flex items-center justify-center p-20">
                    <img src="{{ asset('images/logo1.jpeg') }}" class="rounded-lg shadow-lg" alt="Monitor Placeholder">
                </div>
            </div>
        </div>
    </div>

    <!-- RIGHT PANEL: Registration Form -->
    <div class="w-full lg:w-1/2 flex items-center justify-center p-6 sm:p-12">
        <div class="w-full max-w-md bg-white py-12 px-8 sm:px-10 rounded-xl shadow-lg border border-gray-100">
            
            <div class="text-left mb-10">
                <h2 class="text-5xl font-extrabold text-gray-900 tracking-tight">Register</h2>
                <p class="text-gray-600 text-lg mt-1">Create an account to get started</p>
            </div>
            
            <!-- START OF USER'S FORM STRUCTURE, STYLED -->
            <form method="POST" action="{{ route('register') }}">
                @csrf

                <!-- Name -->
                <div class="mb-5">
                    <label for="name" class="block text-base font-medium text-gray-700 mb-2">{{ __('Name') }}</label>
                    <input id="name" 
                           class="form-input-styled block w-full" 
                           type="text" 
                           name="name" 
                           value="{{ old('name') }}" 
                           required 
                           autofocus 
                           autocomplete="name" 
                           placeholder="Enter your full name"
                    />
                    <!-- <x-input-error :messages="$errors->get('name')" class="mt-2" /> -->
                </div>

                <!-- Email Address -->
                <div class="mb-5">
                    <label for="email" class="block text-base font-medium text-gray-700 mb-2">{{ __('Email') }}</label>
                    <input id="email" 
                           class="form-input-styled block w-full" 
                           type="email" 
                           name="email" 
                           value="{{ old('email') }}" 
                           required 
                           autocomplete="username" 
                           placeholder="Enter your email address"
                    />
                    <!-- <x-input-error :messages="$errors->get('email')" class="mt-2" /> -->
                </div>

                <!-- Password -->
                <div class="mb-5">
                    <label for="password" class="block text-base font-medium text-gray-700 mb-2">{{ __('Password') }}</label>
                    <input id="password" 
                           class="form-input-styled block w-full"
                           type="password"
                           name="password"
                           required 
                           autocomplete="new-password" 
                           placeholder="Create a password"
                    />
                    <!-- <x-input-error :messages="$errors->get('password')" class="mt-2" /> -->
                </div>

                <!-- Confirm Password -->
                <div class="mb-8">
                    <label for="password_confirmation" class="block text-base font-medium text-gray-700 mb-2">{{ __('Confirm Password') }}</label>
                    <input id="password_confirmation" 
                           class="form-input-styled block w-full"
                           type="password"
                           name="password_confirmation" 
                           required 
                           autocomplete="new-password" 
                           placeholder="Confirm your password"
                    />
                    <!-- <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" /> -->
                </div>

                <div class="flex items-center justify-end mt-4">
                    <!-- Already Registered Link -->
                    <a class="text-sm font-medium text-gray-600 hover:text-gray-900 transition duration-150" href="{{ route('login') }}">
                        {{ __('Already registered?') }}
                    </a>

                    <!-- Register Button (Styled like the Sign In button) -->
                    <button type="submit" class="ms-4 h-14 px-8 bg-primary-purple text-white font-semibold rounded-lg shadow-xl shadow-primary-purple/30 hover:bg-dark-purple transition duration-200 focus:outline-none focus:ring-2 focus:ring-dark-purple focus:ring-offset-2 text-lg uppercase tracking-wider">
                        {{ __('Register') }}
                    </button>
                </div>

                <!-- Privacy/Terms Footer -->
                <div class="mt-10 text-center text-xs text-gray-400">
                    <a href="#" class="hover:text-gray-600 mr-4">Privacy Policy</a> |
                    <a href="#" class="hover:text-gray-600 ml-4">Terms & Conditions</a>
                </div>
            </form>
            <!-- END OF USER'S FORM STRUCTURE, STYLED -->

        </div>
    </div>

</div>

</body>
</html>