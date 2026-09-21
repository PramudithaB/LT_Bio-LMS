<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full bg-slate-50">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Create Account - LTbio | Lakshitha Thennakoon Biology</title>
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
        <div class="hidden lg:flex lg:w-5/12 relative bg-slate-950 overflow-hidden flex-col justify-between p-12 xl:p-16 text-white">
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
            <div class="relative z-10 max-w-md my-auto py-8">
                <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-brand-500/10 border border-brand-500/20 text-brand-400 text-xs font-bold tracking-wide uppercase mb-6">
                    <span class="w-2 h-2 rounded-full bg-brand-500 animate-pulse"></span>
                    Student Registration
                </div>

                <h1 class="text-3xl xl:text-4xl font-extrabold text-white tracking-tight leading-tight mb-4">
                    Begin Your A/L Biology Success Journey
                </h1>

                <p class="text-slate-300 text-sm leading-relaxed mb-8">
                    Join thousands of high-achieving Advanced Level students across Sri Lanka. Learn with structured lesson modules, tutes, and direct teacher guidance.
                </p>

                <!-- Value Checklist -->
                <div class="space-y-4">
                    <div class="flex items-start gap-3">
                        <div class="w-7 h-7 rounded-lg bg-brand-500/20 text-brand-400 flex items-center justify-center shrink-0 mt-0.5">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
                        </div>
                        <div>
                            <h4 class="text-xs font-bold text-white uppercase tracking-wider">Targeted Exam Batches</h4>
                            <p class="text-xs text-slate-400">Classrooms curated for 2026 A/L, 2027 A/L, Theory and Revision.</p>
                        </div>
                    </div>

                    <div class="flex items-start gap-3">
                        <div class="w-7 h-7 rounded-lg bg-emerald-500/20 text-emerald-400 flex items-center justify-center shrink-0 mt-0.5">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
                        </div>
                        <div>
                            <h4 class="text-xs font-bold text-white uppercase tracking-wider">Fast WhatsApp Verification</h4>
                            <p class="text-xs text-slate-400">Instant direct assistance for payments and study material dispatch.</p>
                        </div>
                    </div>

                    <div class="flex items-start gap-3">
                        <div class="w-7 h-7 rounded-lg bg-bio-500/20 text-bio-400 flex items-center justify-center shrink-0 mt-0.5">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
                        </div>
                        <div>
                            <h4 class="text-xs font-bold text-white uppercase tracking-wider">No Long-Term Contracts</h4>
                            <p class="text-xs text-slate-400">Simple monthly class packages with flexible bank deposit slip uploads.</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Bottom Note -->
            <div class="relative z-10 flex items-center justify-between text-xs text-slate-500 border-t border-slate-800/80 pt-6">
                <span>&copy; {{ date('Y') }} LTbio.lk</span>
                <span class="text-slate-400">Lakshitha Thennakoon Biology</span>
            </div>
        </div>

        <!-- RIGHT PANEL: Registration Form -->
        <div class="flex-1 flex flex-col justify-between p-6 sm:p-10 xl:p-14 bg-white overflow-y-auto">
            <!-- Mobile Brand Bar -->
            <div class="flex lg:hidden items-center justify-between mb-8">
                <a href="{{ url('/') }}" class="inline-flex items-center gap-2.5">
                    <img src="{{ asset('images/logo1.jpeg') }}" alt="LT Bio" class="w-10 h-10 rounded-xl object-cover shadow-sm border border-slate-200" />
                    <div>
                        <div class="text-xl font-black tracking-tight text-slate-900 leading-none">
                            LT<span class="text-brand-500">bio</span><span class="text-xs font-bold text-bio-500 ml-1">.lk</span>
                        </div>
                        <span class="text-[10px] font-bold text-slate-500 tracking-wider uppercase">Student Registration</span>
                    </div>
                </a>
                <a href="{{ route('login') }}" class="text-xs font-bold text-brand-600 hover:text-brand-700 flex items-center gap-1">
                    <span>Sign In</span>
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                </a>
            </div>

            <!-- Form Container -->
            <div class="w-full max-w-2xl mx-auto my-auto">
                <div class="mb-8">
                    <div class="hidden lg:flex items-center justify-between mb-4">
                        <span class="text-xs font-bold text-slate-400 uppercase tracking-widest">New Student Account</span>
                        <a href="{{ route('login') }}" class="text-xs font-bold text-brand-600 hover:text-brand-700 flex items-center gap-1 transition-colors">
                            <span>Already registered? Sign In</span>
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                        </a>
                    </div>
                    <h2 class="text-3xl sm:text-4xl font-extrabold text-slate-900 tracking-tight">Create Your Account 🚀</h2>
                    <p class="text-slate-500 text-sm mt-2">Fill in your information accurately to register for Lakshitha Thennakoon's Biology LMS.</p>
                </div>

                <!-- Top Validation Alert if errors exist -->
                @if (isset($errors) && $errors->any())
                    <div class="mb-6 p-4 rounded-xl bg-rose-50 border border-rose-200 text-rose-800 text-sm shadow-xs">
                        <div class="flex items-center gap-2 font-bold mb-1">
                            <svg class="w-4 h-4 text-rose-600 shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                            </svg>
                            <span>Please resolve the following issues:</span>
                        </div>
                        <ul class="list-disc list-inside text-xs text-rose-700 pl-1 space-y-0.5">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <!-- REGISTRATION FORM -->
                <form method="POST" action="{{ route('register') }}" class="space-y-4 sm:space-y-5">
                    @csrf

                    <!-- 2-Column Responsive Grid -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 sm:gap-5">

                        <!-- Full Name -->
                        <div>
                            <label for="name" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">
                                Full Name <span class="text-rose-500">*</span>
                            </label>
                            <input id="name"
                                   type="text"
                                   name="name"
                                   value="{{ old('name') }}"
                                   required
                                   autofocus
                                   autocomplete="name"
                                   placeholder="e.g. Kasun Perera"
                                   class="w-full px-4 py-3 bg-slate-50 border @error('name') border-rose-300 bg-rose-50/20 text-rose-900 @else border-slate-200 @enderror rounded-xl text-sm font-medium text-slate-900 placeholder:text-slate-400 focus:bg-white focus:outline-none focus:ring-2 focus:ring-brand-500/20 focus:border-brand-500 transition-all" />
                            @error('name')
                                <p class="text-xs font-bold text-rose-600 mt-1.5">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Email Address -->
                        <div>
                            <label for="email" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">
                                Email Address <span class="text-rose-500">*</span>
                            </label>
                            <input id="email"
                                   type="email"
                                   name="email"
                                   value="{{ old('email') }}"
                                   required
                                   autocomplete="username"
                                   placeholder="student@example.com"
                                   class="w-full px-4 py-3 bg-slate-50 border @error('email') border-rose-300 bg-rose-50/20 text-rose-900 @else border-slate-200 @enderror rounded-xl text-sm font-medium text-slate-900 placeholder:text-slate-400 focus:bg-white focus:outline-none focus:ring-2 focus:ring-brand-500/20 focus:border-brand-500 transition-all" />
                            @error('email')
                                <p class="text-xs font-bold text-rose-600 mt-1.5">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- WhatsApp Number -->
                        <div>
                            <label for="whatsapp_number" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">
                                WhatsApp Number <span class="text-rose-500">*</span>
                            </label>
                            <input id="whatsapp_number"
                                   type="text"
                                   name="whatsapp_number"
                                   value="{{ old('whatsapp_number') }}"
                                   required
                                   placeholder="e.g. 0712345678"
                                   class="w-full px-4 py-3 bg-slate-50 border @error('whatsapp_number') border-rose-300 bg-rose-50/20 text-rose-900 @else border-slate-200 @enderror rounded-xl text-sm font-medium text-slate-900 placeholder:text-slate-400 focus:bg-white focus:outline-none focus:ring-2 focus:ring-brand-500/20 focus:border-brand-500 transition-all" />
                            @error('whatsapp_number')
                                <p class="text-xs font-bold text-rose-600 mt-1.5">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- ID Number (NIC / Student ID) -->
                        <div>
                            <label for="id_number" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">
                                NIC / Student ID <span class="text-rose-500">*</span>
                            </label>
                            <input id="id_number"
                                   type="text"
                                   name="id_number"
                                   value="{{ old('id_number') }}"
                                   required
                                   placeholder="National ID or School Index"
                                   class="w-full px-4 py-3 bg-slate-50 border @error('id_number') border-rose-300 bg-rose-50/20 text-rose-900 @else border-slate-200 @enderror rounded-xl text-sm font-medium text-slate-900 placeholder:text-slate-400 focus:bg-white focus:outline-none focus:ring-2 focus:ring-brand-500/20 focus:border-brand-500 transition-all" />
                            @error('id_number')
                                <p class="text-xs font-bold text-rose-600 mt-1.5">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Exam Year -->
                        <div class="sm:col-span-2 sm:w-1/2 sm:pr-2.5">
                            <label for="exam_year" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">
                                A/L Exam Year <span class="text-rose-500">*</span>
                            </label>
                            <input id="exam_year"
                                   type="number"
                                   name="exam_year"
                                   value="{{ old('exam_year') }}"
                                   required
                                   min="1990"
                                   max="2099"
                                   placeholder="e.g. 2026"
                                   class="w-full px-4 py-3 bg-slate-50 border @error('exam_year') border-rose-300 bg-rose-50/20 text-rose-900 @else border-slate-200 @enderror rounded-xl text-sm font-medium text-slate-900 placeholder:text-slate-400 focus:bg-white focus:outline-none focus:ring-2 focus:ring-brand-500/20 focus:border-brand-500 transition-all" />
                            @error('exam_year')
                                <p class="text-xs font-bold text-rose-600 mt-1.5">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Residential Address (Full Width) -->
                        <div class="sm:col-span-2">
                            <label for="address" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">
                                Delivery / Residential Address <span class="text-rose-500">*</span>
                            </label>
                            <textarea id="address"
                                      name="address"
                                      rows="2"
                                      required
                                      placeholder="House number, Street, City / Postal code (for tute deliveries)"
                                      class="w-full px-4 py-2.5 bg-slate-50 border @error('address') border-rose-300 bg-rose-50/20 text-rose-900 @else border-slate-200 @enderror rounded-xl text-sm font-medium text-slate-900 placeholder:text-slate-400 focus:bg-white focus:outline-none focus:ring-2 focus:ring-brand-500/20 focus:border-brand-500 transition-all resize-none">{{ old('address') }}</textarea>
                            @error('address')
                                <p class="text-xs font-bold text-rose-600 mt-1.5">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Password -->
                        <div>
                            <label for="password" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">
                                Password <span class="text-rose-500">*</span>
                            </label>
                            <input id="password"
                                   type="password"
                                   name="password"
                                   required
                                   autocomplete="new-password"
                                   placeholder="Create a strong password"
                                   class="w-full px-4 py-3 bg-slate-50 border @error('password') border-rose-300 bg-rose-50/20 text-rose-900 @else border-slate-200 @enderror rounded-xl text-sm font-medium text-slate-900 placeholder:text-slate-400 focus:bg-white focus:outline-none focus:ring-2 focus:ring-brand-500/20 focus:border-brand-500 transition-all" />
                            <p class="text-[11px] text-slate-400 mt-1 leading-tight">
                                Min 8 characters, with uppercase, number & symbol.
                            </p>
                            @error('password')
                                <p class="text-xs font-bold text-rose-600 mt-1.5">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Confirm Password -->
                        <div>
                            <label for="password_confirmation" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">
                                Confirm Password <span class="text-rose-500">*</span>
                            </label>
                            <input id="password_confirmation"
                                   type="password"
                                   name="password_confirmation"
                                   required
                                   autocomplete="new-password"
                                   placeholder="Re-enter your password"
                                   class="w-full px-4 py-3 bg-slate-50 border @error('password_confirmation') border-rose-300 bg-rose-50/20 text-rose-900 @else border-slate-200 @enderror rounded-xl text-sm font-medium text-slate-900 placeholder:text-slate-400 focus:bg-white focus:outline-none focus:ring-2 focus:ring-brand-500/20 focus:border-brand-500 transition-all" />
                            @error('password_confirmation')
                                <p class="text-xs font-bold text-rose-600 mt-1.5">{{ $message }}</p>
                            @enderror
                        </div>

                    </div>

                    <!-- Submit Button -->
                    <div class="pt-4">
                        <button type="submit"
                                class="w-full py-4 px-6 rounded-xl bg-gradient-to-r from-brand-600 to-brand-500 hover:from-brand-500 hover:to-brand-600 text-white font-bold text-sm shadow-lg shadow-brand-500/25 hover:shadow-xl hover:shadow-brand-500/35 hover:-translate-y-0.5 active:translate-y-0 transition-all flex items-center justify-center gap-2">
                            <span>Complete Registration & Enter Portal</span>
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                            </svg>
                        </button>
                    </div>
                </form>

                <!-- Already have an account divider -->
                <div class="mt-8 text-center">
                    <p class="text-xs text-slate-500">
                        Already registered with LTbio? 
                        <a href="{{ route('login') }}" class="font-bold text-brand-600 hover:text-brand-700 transition-colors ml-1">
                            Sign in to your account
                        </a>
                    </p>
                </div>
            </div>

            <!-- Footer Links -->
            <div class="w-full max-w-2xl mx-auto pt-8 mt-auto text-center">
                <div class="flex items-center justify-center gap-4 text-xs font-medium text-slate-400">
                    <a href="{{ url('/') }}" class="hover:text-slate-600 transition-colors">Home</a>
                    <span>•</span>
                    <a href="{{ route('login') }}" class="hover:text-slate-600 transition-colors">Login</a>
                    <span>•</span>
                    <a href="https://wa.me/94742877640" target="_blank" rel="noopener noreferrer" class="hover:text-slate-600 transition-colors">WhatsApp Support</a>
                </div>
            </div>
        </div>

    </div>

</body>
</html>