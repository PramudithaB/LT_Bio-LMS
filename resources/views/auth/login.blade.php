<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full bg-slate-50">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Sign In - LTbio | Lakshitha Thennakoon Biology</title>
    <link rel="icon" type="image/jpeg" href="{{ asset('images/logo1.jpeg') }}" />

    <!-- Google Fonts: Inter -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- Scripts & Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="h-full font-sans antialiased text-slate-900 bg-slate-50 selection:bg-brand-500 selection:text-white">

    <div class="min-h-screen flex flex-col lg:flex-row">

        <!-- LEFT PANEL: Brand Showcase & Biology Visual (Desktop Only) -->
        <div class="hidden lg:flex lg:w-1/2 relative bg-slate-950 overflow-hidden flex-col justify-between p-12 xl:p-16 text-white">
            <!-- Ambient Gradient Glows -->
            <div class="absolute -top-32 -left-32 w-96 h-96 bg-brand-600/25 rounded-full blur-3xl pointer-events-none"></div>
            <div class="absolute -bottom-32 -right-32 w-96 h-96 bg-bio-600/20 rounded-full blur-3xl pointer-events-none"></div>

            <!-- Subtle Grid Pattern -->
            <div class="absolute inset-0 bg-[radial-gradient(#334155_1px,transparent_1px)] [background-size:24px_24px] opacity-25 pointer-events-none"></div>

            <!-- Top Brand Header -->
            <div class="relative z-10">
                <a href="{{ url('/') }}" class="inline-flex items-center gap-3 group">
                    <img src="{{ asset('images/logo1.jpeg') }}" alt="LT Bio" class="w-12 h-12 rounded-xl object-cover shadow-lg border-2 border-white/20 group-hover:scale-105 transition-transform" />
                    <div>
                        <div class="text-2xl font-black tracking-tight text-white leading-none">
                            LT<span class="text-brand-500">bio</span><span class="text-xs font-bold text-bio-500 ml-1">.lk</span>
                        </div>
                        <span class="text-xs font-semibold text-slate-400 tracking-wider uppercase">Advanced Biology LMS</span>
                    </div>
                </a>
            </div>

            <!-- Center Showcase Content -->
            <div class="relative z-10 max-w-lg my-auto py-12">
                <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-brand-500/10 border border-brand-500/20 text-brand-400 text-xs font-bold tracking-wide uppercase mb-6">
                    <span class="w-2 h-2 rounded-full bg-brand-500 animate-pulse"></span>
                    Sri Lanka's Premier A/L Biology Portal
                </div>

                <h1 class="text-4xl xl:text-5xl font-extrabold text-white tracking-tight leading-tight mb-4">
                    Master Biology with <span class="text-transparent bg-clip-text bg-gradient-to-r from-brand-400 via-brand-500 to-rose-400">Lakshitha Thennakoon</span>
                </h1>

                <p class="text-slate-300 text-base leading-relaxed mb-8">
                    Access comprehensive video lectures, high-yield revision modules, theory tutes, and exam-focused question discussions designed for maximum A/L results.
                </p>

                <!-- Value Props -->
                <div class="space-y-4">
                    <div class="flex items-start gap-3.5">
                        <div class="w-8 h-8 rounded-lg bg-emerald-500/10 border border-emerald-500/25 flex items-center justify-center text-emerald-400 shrink-0 mt-0.5">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                        </div>
                        <div>
                            <h4 class="text-sm font-bold text-white">Full HD Video Lectures</h4>
                            <p class="text-xs text-slate-400">Stream lessons anytime with smooth playback and zero buffering.</p>
                        </div>
                    </div>

                    <div class="flex items-start gap-3.5">
                        <div class="w-8 h-8 rounded-lg bg-brand-500/10 border border-brand-500/25 flex items-center justify-center text-brand-400 shrink-0 mt-0.5">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                        </div>
                        <div>
                            <h4 class="text-sm font-bold text-white">Downloadable Tutes & Summaries</h4>
                            <p class="text-xs text-slate-400">Printable lecture notes, model papers, and resource materials.</p>
                        </div>
                    </div>

                    <div class="flex items-start gap-3.5">
                        <div class="w-8 h-8 rounded-lg bg-bio-500/10 border border-bio-500/25 flex items-center justify-center text-bio-400 shrink-0 mt-0.5">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                        </div>
                        <div>
                            <h4 class="text-sm font-bold text-white">Island Rank Proven Track Record</h4>
                            <p class="text-xs text-slate-400">Over 837 Island Ranks and 4,500+ A passes guided by Lakshitha Thennakoon.</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Bottom Note -->
            <div class="relative z-10 flex items-center justify-between text-xs text-slate-500 border-t border-slate-800/80 pt-6">
                <span>&copy; {{ date('Y') }} LTbio.lk. All rights reserved.</span>
                <span class="text-slate-400">University of Colombo Alumni</span>
            </div>
        </div>

        <!-- RIGHT PANEL: Authentication Form -->
        <div class="flex-1 flex flex-col justify-between p-6 sm:p-12 xl:p-16 bg-white overflow-y-auto">
            <!-- Mobile Brand Bar -->
            <div class="flex lg:hidden items-center justify-between mb-8">
                <a href="{{ url('/') }}" class="inline-flex items-center gap-2.5">
                    <img src="{{ asset('images/logo1.jpeg') }}" alt="LT Bio" class="w-10 h-10 rounded-xl object-cover shadow-sm border border-slate-200" />
                    <div>
                        <div class="text-xl font-black tracking-tight text-slate-900 leading-none">
                            LT<span class="text-brand-500">bio</span><span class="text-xs font-bold text-bio-500 ml-1">.lk</span>
                        </div>
                        <span class="text-[10px] font-bold text-slate-500 tracking-wider uppercase">LMS Portal</span>
                    </div>
                </a>
                <a href="{{ url('/') }}" class="text-xs font-semibold text-slate-500 hover:text-slate-800 flex items-center gap-1">
                    <span>Home</span>
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                </a>
            </div>

            <!-- Main Form Card Container -->
            <div class="w-full max-w-md mx-auto my-auto">
                <div class="mb-8">
                    <div class="hidden lg:flex items-center justify-between mb-6">
                        <span class="text-xs font-bold text-slate-400 uppercase tracking-widest">Student & Teacher Portal</span>
                        <a href="{{ url('/') }}" class="text-xs font-bold text-brand-600 hover:text-brand-700 flex items-center gap-1 transition-colors">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                            <span>Back to website</span>
                        </a>
                    </div>
                    <h2 class="text-3xl sm:text-4xl font-extrabold text-slate-900 tracking-tight">Welcome Back 👋</h2>
                    <p class="text-slate-500 text-sm mt-2">Please enter your login details to access your enrolled biology classes.</p>
                </div>

                <!-- Session Status (e.g., password reset success) -->
                @if (session('status'))
                    <div class="mb-6 p-4 rounded-xl bg-emerald-50 border border-emerald-200 text-emerald-800 text-sm font-medium flex items-center gap-3 shadow-xs">
                        <svg class="w-5 h-5 text-emerald-600 shrink-0" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                        </svg>
                        <span>{{ session('status') }}</span>
                    </div>
                @endif

                <!-- General Error / Custom Flash -->
                @if (session('error'))
                    <div class="mb-6 p-4 rounded-xl bg-rose-50 border border-rose-200 text-rose-800 text-sm font-medium flex items-center gap-3 shadow-xs">
                        <svg class="w-5 h-5 text-rose-600 shrink-0" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                        </svg>
                        <span>{{ session('error') }}</span>
                    </div>
                @endif

                <!-- Top Validation Alert if any errors exist -->
                @if (isset($errors) && $errors->any())
                    <div class="mb-6 p-4 rounded-xl bg-rose-50 border border-rose-200 text-rose-800 text-sm shadow-xs">
                        <div class="flex items-center gap-2 font-bold mb-1">
                            <svg class="w-4 h-4 text-rose-600 shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                            </svg>
                            <span>Authentication Error</span>
                        </div>
                        <ul class="list-disc list-inside text-xs text-rose-700 pl-1 space-y-0.5">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <!-- LOGIN FORM -->
                <form method="POST" action="{{ route('login') }}" class="space-y-5">
                    @csrf

                    <!-- Email Address -->
                    <div>
                        <label for="email" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-2">
                            Email Address <span class="text-rose-500">*</span>
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207" />
                                </svg>
                            </div>
                            <input id="email"
                                   type="email"
                                   name="email"
                                   value="{{ old('email') }}"
                                   required
                                   autofocus
                                   autocomplete="username"
                                   placeholder="student@example.com"
                                   class="w-full pl-11 pr-4 py-3 bg-slate-50 border @error('email') border-rose-300 bg-rose-50/20 text-rose-900 @else border-slate-200 @enderror rounded-xl text-sm font-medium text-slate-900 placeholder:text-slate-400 focus:bg-white focus:outline-none focus:ring-2 focus:ring-brand-500/20 focus:border-brand-500 transition-all" />
                        </div>
                        @error('email')
                            <p class="text-xs font-bold text-rose-600 mt-1.5 flex items-center gap-1">
                                <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>
                                <span>{{ $message }}</span>
                            </p>
                        @enderror
                    </div>

                    <!-- Password with visibility toggle -->
                    <div x-data="{ show: false }">
                        <div class="flex items-center justify-between mb-2">
                            <label for="password" class="block text-xs font-bold uppercase tracking-wider text-slate-700">
                                Password <span class="text-rose-500">*</span>
                            </label>
                            @if (Route::has('password.request'))
                                <a href="{{ route('password.request') }}" class="text-xs font-bold text-brand-600 hover:text-brand-700 transition-colors">
                                    Forgot password?
                                </a>
                            @endif
                        </div>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                </svg>
                            </div>
                            <input id="password"
                                   :type="show ? 'text' : 'password'"
                                   name="password"
                                   required
                                   autocomplete="current-password"
                                   placeholder="••••••••••••"
                                   class="w-full pl-11 pr-11 py-3 bg-slate-50 border @error('password') border-rose-300 bg-rose-50/20 text-rose-900 @else border-slate-200 @enderror rounded-xl text-sm font-medium text-slate-900 placeholder:text-slate-400 focus:bg-white focus:outline-none focus:ring-2 focus:ring-brand-500/20 focus:border-brand-500 transition-all" />
                            <button type="button"
                                    @click="show = !show"
                                    class="absolute inset-y-0 right-0 pr-3.5 flex items-center text-slate-400 hover:text-slate-600 focus:outline-none">
                                <svg x-show="!show" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                                <svg x-show="show" x-cloak class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l18 18" />
                                </svg>
                            </button>
                        </div>
                        @error('password')
                            <p class="text-xs font-bold text-rose-600 mt-1.5 flex items-center gap-1">
                                <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>
                                <span>{{ $message }}</span>
                            </p>
                        @enderror
                    </div>

                    <!-- Remember Me -->
                    <div class="flex items-center justify-between pt-1">
                        <label for="remember_me" class="inline-flex items-center cursor-pointer group">
                            <input id="remember_me"
                                   type="checkbox"
                                   name="remember"
                                   class="w-4 h-4 rounded-md border-slate-300 text-brand-600 focus:ring-brand-500 focus:ring-offset-0 cursor-pointer transition-colors" />
                            <span class="ml-2.5 text-xs font-semibold text-slate-600 group-hover:text-slate-900 transition-colors">
                                Keep me signed in on this device
                            </span>
                        </label>
                    </div>

                    <!-- Submit Button -->
                    <div class="pt-2">
                        <button type="submit"
                                class="w-full py-3.5 px-6 rounded-xl bg-gradient-to-r from-brand-600 to-brand-500 hover:from-brand-500 hover:to-brand-600 text-white font-bold text-sm shadow-lg shadow-brand-500/25 hover:shadow-xl hover:shadow-brand-500/35 hover:-translate-y-0.5 active:translate-y-0 transition-all flex items-center justify-center gap-2">
                            <span>Sign In to Account</span>
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                            </svg>
                        </button>
                    </div>
                </form>

                <!-- Divider -->
                <div class="relative my-8">
                    <div class="absolute inset-0 flex items-center">
                        <div class="w-full border-t border-slate-200"></div>
                    </div>
                    <div class="relative flex justify-center text-xs uppercase">
                        <span class="bg-white px-3 text-slate-400 font-bold tracking-wider">New to LTbio?</span>
                    </div>
                </div>

                <!-- Create Account Link -->
                <div class="text-center">
                    <a href="{{ route('register') }}"
                       class="w-full inline-flex items-center justify-center gap-2 py-3 px-6 rounded-xl border-2 border-slate-200 hover:border-brand-500 hover:bg-brand-50/30 text-slate-700 hover:text-brand-600 font-bold text-sm transition-all">
                        <span>Create New Student Account</span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                        </svg>
                    </a>
                </div>
            </div>

            <!-- Footer Info -->
            <div class="w-full max-w-md mx-auto pt-8 mt-auto text-center">
                <div class="flex items-center justify-center gap-4 text-xs font-medium text-slate-400">
                    <a href="{{ url('/') }}" class="hover:text-slate-600 transition-colors">Home</a>
                    <span>•</span>
                    <a href="{{ route('buyclass') }}" class="hover:text-slate-600 transition-colors">Course Packages</a>
                    <span>•</span>
                    <a href="https://wa.me/94742877640" target="_blank" rel="noopener noreferrer" class="hover:text-slate-600 transition-colors">WhatsApp Support</a>
                </div>
            </div>
        </div>

    </div>

</body>
</html>