<!DOCTYPE html>
<html lang="en" class="h-full bg-slate-50">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Student Dashboard - LTbio LMS</title>
    <link rel="icon" type="image/jpeg" href="{{ asset('images/logo1.jpeg') }}">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Vite Assets (or CDN fallback) -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <!-- Alpine.js & Tailwind CDN for guaranteed styling -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                    },
                    colors: {
                        brand: {
                            50: '#fff1ee',
                            100: '#ffe4dd',
                            200: '#ffccbe',
                            300: '#ffa792',
                            400: '#ff7355',
                            500: '#F53003',
                            600: '#dc2602',
                            700: '#b81d00',
                            800: '#941a04',
                            900: '#7a1908',
                            DEFAULT: '#F53003',
                        },
                        bio: {
                            50: '#eefbfc',
                            100: '#d5f5f7',
                            500: '#17a2b8',
                            600: '#117a8b',
                            700: '#0c5c6a',
                            DEFAULT: '#17a2b8',
                        },
                        'primary-purple': '#F53003',
                        'dark-purple': '#dc2602',
                    }
                }
            }
        }
    </script>
</head>

<body class="min-h-full flex flex-col font-sans text-slate-800 bg-slate-50 antialiased selection:bg-brand-500 selection:text-white">

    <!-- Top Navigation Component -->
    <x-lms-navbar />

    <!-- Main Content Container -->
    <main class="flex-grow max-w-7xl mx-auto w-full px-4 sm:px-6 lg:px-8 py-8 space-y-8">

        <!-- Flash Messages / Alerts -->
        @if(session('success'))
            <div x-data="{ show: true }" x-show="show" x-transition class="p-4 rounded-2xl bg-emerald-50 border border-emerald-200 text-emerald-800 flex items-center justify-between shadow-xs">
                <div class="flex items-center gap-3">
                    <svg class="w-5 h-5 text-emerald-600 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                    </svg>
                    <span class="text-sm font-semibold">{{ session('success') }}</span>
                </div>
                <button @click="show = false" class="text-emerald-500 hover:text-emerald-700">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
            </div>
        @endif

        @if(session('error'))
            <div x-data="{ show: true }" x-show="show" x-transition class="p-4 rounded-2xl bg-red-50 border border-red-200 text-red-800 flex items-center justify-between shadow-xs">
                <div class="flex items-center gap-3">
                    <svg class="w-5 h-5 text-red-600 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                    </svg>
                    <span class="text-sm font-semibold">{{ session('error') }}</span>
                </div>
                <button @click="show = false" class="text-red-500 hover:text-red-700">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
            </div>
        @endif

        @php
            $userId = auth()->id();
            $userName = auth()->user()->name ?? null;
            $isAdmin = auth()->user()->usertype === 'admin';

            // Fetch approved checkouts for the logged-in student to calculate enrolled classes accurately
            $approvedClassIds = [];
            if (auth()->check()) {
                $approvedCheckouts = \App\Models\Checkout::where('status', 'approved')
                    ->where(function($q) use ($userId, $userName) {
                        $q->where('user_id', $userId);
                        if ($userName) {
                            $q->orWhere('student_name', $userName);
                        }
                    })
                    ->pluck('class_id')
                    ->toArray();

                foreach ($approvedCheckouts as $cList) {
                    $parts = array_filter(array_map('trim', explode(',', $cList)));
                    foreach ($parts as $p) {
                        $approvedClassIds[] = (int) $p;
                    }
                }
                $approvedClassIds = array_unique($approvedClassIds);
            }

            $enrolledCount = $isAdmin ? $classes->count() : $classes->filter(function($c) use ($approvedClassIds) {
                return in_array($c->id, $approvedClassIds);
            })->count();

            $totalLessonsCount = $classes->reduce(function($carry, $c) {
                return $carry + $c->lessons->count();
            }, 0);
        @endphp

        <!-- Welcome Hero Section -->
        <div class="relative overflow-hidden rounded-3xl bg-gradient-to-r from-slate-900 via-slate-800 to-slate-900 text-white p-6 sm:p-8 md:p-10 shadow-xl border border-slate-700/50">
            <!-- Decorative Subtle Accent Glow -->
            <div class="absolute -right-20 -top-20 w-80 h-80 bg-brand-500/20 rounded-full blur-3xl pointer-events-none"></div>
            <div class="absolute right-40 -bottom-20 w-60 h-60 bg-bio-500/15 rounded-full blur-2xl pointer-events-none"></div>

            <div class="relative z-10 flex flex-col md:flex-row md:items-center justify-between gap-6">
                <div class="space-y-2 max-w-2xl">
                    <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-brand-500/15 text-brand-400 border border-brand-500/30 text-xs font-semibold uppercase tracking-wider">
                        <span class="w-1.5 h-1.5 rounded-full bg-brand-400 animate-pulse"></span>
                        Student Portal
                    </div>
                    <h1 class="text-2xl sm:text-3xl lg:text-4xl font-extrabold tracking-tight text-white">
                        Welcome Back, <span class="text-transparent bg-clip-text bg-gradient-to-r from-brand-400 to-orange-300">{{ Auth::user()->name }}</span> 👋
                    </h1>
                    <p class="text-slate-300 text-sm sm:text-base leading-relaxed">
                        Access your biology lecture modules, watch assigned videos, and track your study materials.
                    </p>
                </div>

                <!-- Instructor Card Callout -->
                <div class="flex items-center gap-4 bg-slate-800/80 backdrop-blur-md p-4 rounded-2xl border border-slate-700/80 shadow-inner flex-shrink-0">
                    <img src="{{ asset('images/profile1.jpeg') }}" 
                         alt="Lakshitha Thennakoon" 
                         class="w-12 h-12 rounded-xl object-cover ring-2 ring-brand-500/40">
                    <div class="text-left">
                        <p class="text-xs font-medium text-slate-400">Chief Instructor</p>
                        <p class="text-sm font-bold text-white">Lakshitha Thennakoon</p>
                        <span class="inline-flex items-center gap-1 text-[11px] text-bio-400 font-medium">
                            <span class="w-1.5 h-1.5 rounded-full bg-bio-400"></span>
                            A/L Biology Specialist
                        </span>
                    </div>
                </div>
            </div>

            <!-- Stats Ribbon -->
            <div class="mt-8 pt-6 border-t border-slate-700/70 grid grid-cols-2 sm:grid-cols-3 gap-4">
                <div class="bg-slate-800/40 rounded-xl p-3.5 border border-slate-700/50">
                    <p class="text-xs text-slate-400 font-medium">Available Courses</p>
                    <p class="text-xl sm:text-2xl font-black text-white mt-1">{{ $classes->count() }}</p>
                </div>
                <div class="bg-slate-800/40 rounded-xl p-3.5 border border-slate-700/50">
                    <p class="text-xs text-slate-400 font-medium">My Active Classes</p>
                    <p class="text-xl sm:text-2xl font-black text-emerald-400 mt-1">{{ $enrolledCount }}</p>
                </div>
                <div class="col-span-2 sm:col-span-1 bg-slate-800/40 rounded-xl p-3.5 border border-slate-700/50">
                    <p class="text-xs text-slate-400 font-medium">Total Lesson Modules</p>
                    <p class="text-xl sm:text-2xl font-black text-brand-400 mt-1">{{ $totalLessonsCount }}</p>
                </div>
            </div>
        </div>

        <!-- Announcement Banner -->
        <div class="flex items-center gap-3.5 p-4 rounded-2xl bg-amber-50/90 border border-amber-200/80 text-amber-900 shadow-xs">
            <div class="w-9 h-9 rounded-xl bg-amber-100 flex items-center justify-center flex-shrink-0 text-amber-700">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z" />
                </svg>
            </div>
            <div class="flex-grow text-xs sm:text-sm">
                <span class="font-bold">Notice:</span> 
                <span>New monthly video lectures and past paper materials are updated regularly. Submit your payment slips via <a href="{{ route('buyclass') }}" class="font-bold underline text-amber-800 hover:text-amber-950">Buy Class</a> for fast approval.</span>
            </div>
        </div>

        <!-- Courses Section Header -->
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 pt-2">
            <div>
                <h2 class="text-xl sm:text-2xl font-extrabold text-slate-900 tracking-tight flex items-center gap-2.5">
                    <span class="w-2.5 h-6 rounded-full bg-brand-500 inline-block"></span>
                    My Courses & Classes
                </h2>
                <p class="text-sm text-slate-500 mt-0.5">Explore your enrolled classes and available study modules</p>
            </div>

            <div class="flex items-center gap-2">
                <a href="{{ route('buyclass') }}"
                   class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-brand-500 hover:bg-brand-600 text-white font-semibold text-xs sm:text-sm shadow-xs transition duration-150">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    Enroll in New Class
                </a>
            </div>
        </div>

        <!-- Class Cards Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($classes as $class)
                @php
                    $isClassEnrolled = $isAdmin || in_array($class->id, $approvedClassIds);
                    $lessonCount = $class->lessons->count();
                @endphp

                <div class="group flex flex-col bg-white rounded-3xl border border-slate-200/80 shadow-xs hover:shadow-xl hover:border-brand-500/30 transition-all duration-200 overflow-hidden">
                    
                    <!-- Card Top Banner -->
                    <div class="relative p-6 bg-gradient-to-br from-slate-900 via-slate-800 to-slate-900 text-white">
                        <div class="flex items-start justify-between gap-2 mb-3">
                            <span class="px-3 py-1 rounded-full text-[11px] font-bold tracking-wider uppercase bg-white/10 text-white border border-white/10">
                                {{ $class->month ?? 'All Year' }}
                            </span>

                            @if($isClassEnrolled)
                                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-emerald-500/20 text-emerald-300 border border-emerald-500/30">
                                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-400"></span>
                                    Enrolled
                                </span>
                            @else
                                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold bg-amber-500/20 text-amber-300 border border-amber-500/30">
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                    </svg>
                                    Enrollment Required
                                </span>
                            @endif
                        </div>

                        <h3 class="text-xl font-bold text-white group-hover:text-brand-400 transition duration-150">
                            {{ $class->className }}
                        </h3>

                        @if($class->description)
                            <p class="text-xs text-slate-300 line-clamp-2 mt-1.5">
                                {{ $class->description }}
                            </p>
                        @endif
                    </div>

                    <!-- Card Body -->
                    <div class="p-6 flex-grow flex flex-col justify-between space-y-5">
                        
                        <!-- Metadata Badges -->
                        <div class="grid grid-cols-2 gap-3 text-xs">
                            <div class="flex items-center gap-2 p-2.5 rounded-xl bg-slate-50 border border-slate-100">
                                <div class="w-7 h-7 rounded-lg bg-bio-50 flex items-center justify-center text-bio-600 flex-shrink-0">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                </div>
                                <div class="truncate">
                                    <p class="text-[10px] text-slate-400 uppercase font-bold">Teacher</p>
                                    <p class="font-semibold text-slate-800 truncate">{{ $class->teacherName ?? 'L. Thennakoon' }}</p>
                                </div>
                            </div>

                            <div class="flex items-center gap-2 p-2.5 rounded-xl bg-slate-50 border border-slate-100">
                                <div class="w-7 h-7 rounded-lg bg-brand-50 flex items-center justify-center text-brand-600 flex-shrink-0">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z" />
                                    </svg>
                                </div>
                                <div class="truncate">
                                    <p class="text-[10px] text-slate-400 uppercase font-bold">Lessons</p>
                                    <p class="font-semibold text-slate-800">{{ $lessonCount }} Modules</p>
                                </div>
                            </div>

                            @if($class->classTime)
                                <div class="flex items-center gap-2 p-2.5 rounded-xl bg-slate-50 border border-slate-100">
                                    <div class="w-7 h-7 rounded-lg bg-purple-50 flex items-center justify-center text-purple-600 flex-shrink-0">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    </div>
                                    <div class="truncate">
                                        <p class="text-[10px] text-slate-400 uppercase font-bold">Schedule</p>
                                        <p class="font-semibold text-slate-800 truncate">{{ $class->classTime }}</p>
                                    </div>
                                </div>
                            @endif

                            @if($class->sessionCount)
                                <div class="flex items-center gap-2 p-2.5 rounded-xl bg-slate-50 border border-slate-100">
                                    <div class="w-7 h-7 rounded-lg bg-amber-50 flex items-center justify-center text-amber-600 flex-shrink-0">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                    </div>
                                    <div class="truncate">
                                        <p class="text-[10px] text-slate-400 uppercase font-bold">Sessions</p>
                                        <p class="font-semibold text-slate-800">{{ $class->sessionCount }} Sessions</p>
                                    </div>
                                </div>
                            @endif
                        </div>

                        <!-- Action Button -->
                        <div class="pt-2">
                            <a href="{{ route('classview', $class->id) }}"
                               class="w-full flex items-center justify-center gap-2 py-3 px-4 rounded-xl font-bold text-sm text-white bg-brand-500 hover:bg-brand-600 active:scale-[0.99] shadow-xs transition duration-150">
                                <span>Enter Class & Modules</span>
                                <svg class="w-4 h-4 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                                </svg>
                            </a>
                        </div>

                    </div>
                </div>

            @empty
                <!-- Empty State -->
                <div class="col-span-full bg-white rounded-3xl border border-slate-200/80 p-12 text-center max-w-xl mx-auto shadow-xs">
                    <div class="w-16 h-16 rounded-2xl bg-brand-50 text-brand-500 flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-slate-900 mb-1">No Classes Available Yet</h3>
                    <p class="text-slate-500 text-sm mb-6">You haven't enrolled in any active courses yet or courses are currently being scheduled.</p>
                    <a href="{{ route('buyclass') }}"
                       class="inline-flex items-center gap-2 px-6 py-3 rounded-xl bg-brand-500 hover:bg-brand-600 text-white font-bold text-sm shadow-xs transition">
                        Browse Course Catalog
                    </a>
                </div>
            @endforelse
        </div>

    </main>

    <!-- Simple Footer -->
    <footer class="mt-auto border-t border-slate-200 bg-white py-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col sm:flex-row items-center justify-between gap-4 text-xs text-slate-500">
            <div class="flex items-center gap-2">
                <span class="font-extrabold text-slate-800">LT<span class="text-brand-500">bio</span></span>
                <span>&copy; {{ date('Y') }} Lakshitha Thennakoon. All rights reserved.</span>
            </div>
            <div class="flex items-center gap-4">
                <a href="{{ route('dashboard') }}" class="hover:text-brand-500 transition">Dashboard</a>
                <a href="{{ route('buyclass') }}" class="hover:text-brand-500 transition">Courses</a>
                <a href="{{ route('cart.view') }}" class="hover:text-brand-500 transition">Cart</a>
            </div>
        </div>
    </footer>

</body>
</html>