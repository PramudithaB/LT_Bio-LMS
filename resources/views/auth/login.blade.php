<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modern Login UI</title>
    <!-- Load Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Custom Tailwind Configuration for the specific purple color -->
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        // Using a richer, vibrant purple that is the core of the UI
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
            background-color: #f9fafb; /* Very light background for contrast */
        }

        /* Input field styling to match the image: full height, slight shadow, rounded */
        .form-input-styled {
            height: 52px; 
            transition: all 0.2s;
            border-color: #ff0000;
            box-shadow: 0 1px 2px 0 rgba(255, 0, 0, 0.05); 
            /* Ensure it is rounded like the image */
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
            /* Using a purple placeholder image to match the visual theme */
            background-image: url();
            background-size: cover;
            background-position: center;
        }
    </style>
</head>
<body class="antialiased">

<div class="min-h-screen flex">

    <!-- LEFT PANEL: Illustration/Branding (Matches the screenshot's left side) -->
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
             <p class="text-3xl font-light mt-1">
                
            </p>
            <div class="mt-8">
                <!-- Placeholder for the monitor screen graphic shown in the image -->
                <div class="w-96 h-64 bg-white/20 rounded-xl border border-white/50 backdrop-blur-sm flex items-center justify-center p-20">
                    <img src="{{ asset('images/logo1.jpeg') }}" class="rounded-lg shadow-lg" alt="Monitor Placeholder">
                </div>
            </div>
        </div>
    </div>

    <!-- RIGHT PANEL: Login Form -->
    <div class="w-full lg:w-1/2 flex items-center justify-center p-6 sm:p-12">
        <div class="w-full max-w-md bg-white py-12 px-8 sm:px-10 rounded-xl shadow-lg border border-gray-100">
            
            <div class="text-left mb-10">
                <h2 class="text-5xl font-extrabold text-gray-900 tracking-tight">Sign in</h2>
                <p class="text-gray-600 text-lg mt-1">Please login to continue to your account</p>
            </div>
            
            <!-- Replicating the original structure with custom Tailwind styles -->
            <form method="POST" action="{{ route('login') }}">
                <!-- @csrf remains untouched -->
                @csrf

                <!-- Email Address (Original Field) -->
                <div class="mb-6">
                    <!-- Label text restored to match original Blade input -->
                    <label for="email" class="block text-base font-medium text-gray-700 mb-2">Email Address</label>
                    <input id="email" 
                           class="form-input-styled block w-full" 
                           type="email" 
                           name="email"  
                           value="{{ old('email') }}" 
                           required 
                           autofocus 
                           autocomplete="username" 
                           placeholder="Enter your email address"
                    />
                    <!-- Input Error component not included in raw HTML, but placeholder kept -->
                    <!-- <x-input-error :messages="$errors->get('email')" class="mt-2" /> -->
                </div>

                <!-- Password (Original Field) -->
                <div class="mt-4 mb-4">
                    <div class="flex justify-between items-center mb-2">
                        <!-- Label text restored to match original Blade input -->
                        <label for="password" class="block text-base font-medium text-gray-700">Password</label>

                        <!-- Forgot Password Link (Original Placement) -->
                        @if (Route::has('password.request'))
                            <a class="text-sm font-medium text-primary-purple hover:text-dark-purple transition duration-150" href="{{ route('password.request') }}">
                                {{ __('Forgot your password?') }}
                            </a>
                        @endif
                    </div>

                    <input id="password" 
                           class="form-input-styled block w-full"
                           type="password"
                           name="password"
                           required 
                           autocomplete="current-password"
                           placeholder="Enter your password"
                    />
                    <!-- <x-input-error :messages="$errors->get('password')" class="mt-2" /> -->
                </div>

                <!-- Remember Me (Original Placement - styled to look clean) -->
                <div class="block mt-4 mb-10">
                    <label for="remember_me" class="inline-flex items-center">
                        <input id="remember_me" type="checkbox" class="rounded-sm border-gray-300 text-primary-purple shadow-sm focus:ring-primary-purple" name="remember">
                        <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                    </label>
                </div>
                
                <!-- Log in Button (Restored text to original 'Log in') -->
                <div class="flex items-center justify-center">
                    <!-- Button class changed to look like the screenshot's 'Sign in' button -->
                    <button type="submit" class="w-full h-14 py-3 bg-primary-purple text-white font-semibold rounded-lg shadow-xl shadow-primary-purple/30 hover:bg-dark-purple transition duration-200 focus:outline-none focus:ring-2 focus:ring-dark-purple focus:ring-offset-2 text-lg uppercase tracking-wider">
                        {{ __('Log in') }}
                    </button>
                </div>

                <!-- Separator and Create Account Link (from image design) -->
                <div class="mt-10 text-center">
                    <div class="relative">
                        <div class="absolute inset-0 flex items-center">
                            <div class="w-full border-t border-gray-200"></div>
                        </div>
                        <div class="relative flex justify-center text-sm">
                            <span class="px-2 bg-white text-gray-500 font-medium">
                                or
                            </span>
                        </div>
                    </div>
                    <p class="mt-6 text-sm text-gray-600">
                        Need an account? 
                        <a href="{{route('register')}}" class="font-bold text-primary-purple hover:text-dark-purple transition duration-150">
                            Create one
                        </a>
                    </p>
                    <div class="mt-4 text-xs text-gray-400">
                        <a href="#" class="hover:text-gray-600 mr-4">Privacy Policy</a> |
                        <a href="#" class="hover:text-gray-600 ml-4">Terms & Conditions</a>
                    </div>
                </div>
            </form>
            <!-- END OF FORM CONTENT -->

        </div>
    </div>

</div>

</body>
</html>