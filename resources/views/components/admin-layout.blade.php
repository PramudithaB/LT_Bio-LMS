@props([
    'title' => 'Admin Dashboard',
    'subtitle' => null,
])

<!DOCTYPE html>
<html lang="en" class="h-full bg-slate-50">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title }} - LTbio Admin</title>
    <link rel="icon" type="image/jpeg" href="{{ asset('images/logo1.jpeg') }}">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- Assets -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <!-- Tailwind & Alpine CDN for guaranteed styling -->
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

<body class="min-h-full flex flex-col font-sans text-slate-800 bg-slate-50 antialiased selection:bg-brand-500 selection:text-white"
      x-data="{ sidebarOpen: false }">

    <div class="flex min-h-screen">
        
        <!-- Mobile Sidebar Backdrop -->
        <div x-show="sidebarOpen"
             x-transition:enter="transition-opacity ease-linear duration-300"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="transition-opacity ease-linear duration-300"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"
             @click="sidebarOpen = false"
             class="fixed inset-0 bg-slate-900/60 backdrop-blur-xs z-40 lg:hidden"
             style="display: none;"></div>

        <!-- Admin Sidebar (Fixed Desktop, Slide-over Mobile) -->
        <aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full lg:translate-x-0'"
               class="fixed inset-y-0 left-0 z-50 w-72 bg-slate-950 text-white flex flex-col transition-transform duration-300 ease-in-out border-r border-slate-850 shadow-2xl lg:shadow-none">
            
            <!-- Sidebar Header / Brand -->
            <div class="h-20 px-6 flex items-center justify-between border-b border-slate-850">
                <a href="{{ route('admindashboard') }}" class="flex items-center gap-3 group">
                    <img src="{{ asset('images/logo1.jpeg') }}" 
                         alt="LTbio" 
                         class="w-10 h-10 rounded-xl object-cover ring-2 ring-brand-500/30 group-hover:ring-brand-500 transition shadow-xs">
                    <div>
                        <div class="text-xl font-black tracking-tight leading-tight">
                            LT<span class="text-brand-500">bio</span>
                        </div>
                        <span class="text-[10px] uppercase tracking-wider font-extrabold text-brand-400 bg-brand-500/15 px-2 py-0.5 rounded-md border border-brand-500/20">
                            Admin Control
                        </span>
                    </div>
                </a>

                <!-- Mobile Close Button -->
                <button @click="sidebarOpen = false" 
                        class="p-1.5 rounded-lg text-slate-400 hover:text-white hover:bg-slate-800 lg:hidden">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
            </div>

            <!-- Navigation Links -->
            <nav class="flex-1 px-4 py-6 space-y-1.5 overflow-y-auto">
                <p class="px-3 text-[10px] font-extrabold uppercase tracking-widest text-slate-500 mb-2">Management</p>

                <!-- 1. Dashboard -->
                <a href="{{ route('admindashboard') }}"
                   class="flex items-center gap-3 px-3.5 py-3 rounded-2xl text-sm font-semibold transition duration-150 {{ request()->routeIs('admindashboard') ? 'bg-brand-500 text-white shadow-lg shadow-brand-500/25 font-bold' : 'text-slate-400 hover:text-white hover:bg-slate-900' }}">
                    <svg class="w-5 h-5 {{ request()->routeIs('admindashboard') ? 'text-white' : 'text-slate-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                    </svg>
                    <span>Dashboard</span>
                </a>

                <!-- 2. User Management -->
                <a href="{{ route('usermanagement') }}"
                   class="flex items-center gap-3 px-3.5 py-3 rounded-2xl text-sm font-semibold transition duration-150 {{ request()->routeIs('usermanagement') ? 'bg-brand-500 text-white shadow-lg shadow-brand-500/25 font-bold' : 'text-slate-400 hover:text-white hover:bg-slate-900' }}">
                    <svg class="w-5 h-5 {{ request()->routeIs('usermanagement') ? 'text-white' : 'text-slate-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                    </svg>
                    <span>User Management</span>
                </a>

                <!-- 3. Courses & Lectures -->
                <a href="{{ route('classmanage') }}"
                   class="flex items-center gap-3 px-3.5 py-3 rounded-2xl text-sm font-semibold transition duration-150 {{ request()->routeIs('classmanage') || request()->routeIs('class.edit') ? 'bg-brand-500 text-white shadow-lg shadow-brand-500/25 font-bold' : 'text-slate-400 hover:text-white hover:bg-slate-900' }}">
                    <svg class="w-5 h-5 {{ request()->routeIs('classmanage') || request()->routeIs('class.edit') ? 'text-white' : 'text-slate-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                    </svg>
                    <span>Courses & Lectures</span>
                </a>

                <!-- 4. Lessons -->
                <a href="{{ route('lesson.lessoncreate') }}"
                   class="flex items-center gap-3 px-3.5 py-3 rounded-2xl text-sm font-semibold transition duration-150 {{ request()->routeIs('lesson.*') ? 'bg-brand-500 text-white shadow-lg shadow-brand-500/25 font-bold' : 'text-slate-400 hover:text-white hover:bg-slate-900' }}">
                    <svg class="w-5 h-5 {{ request()->routeIs('lesson.*') ? 'text-white' : 'text-slate-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z" />
                    </svg>
                    <span>Lessons / Videos</span>
                </a>

                <!-- 5. Packages -->
                <a href="{{ route('package.create') }}"
                   class="flex items-center gap-3 px-3.5 py-3 rounded-2xl text-sm font-semibold transition duration-150 {{ request()->routeIs('package.*') ? 'bg-brand-500 text-white shadow-lg shadow-brand-500/25 font-bold' : 'text-slate-400 hover:text-white hover:bg-slate-900' }}">
                    <svg class="w-5 h-5 {{ request()->routeIs('package.*') ? 'text-white' : 'text-slate-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                    </svg>
                    <span>Class Packages</span>
                </a>

                <!-- 6. Payment Management -->
                <a href="{{ route('paymentmanage') }}"
                   class="flex items-center gap-3 px-3.5 py-3 rounded-2xl text-sm font-semibold transition duration-150 {{ request()->routeIs('paymentmanage') ? 'bg-brand-500 text-white shadow-lg shadow-brand-500/25 font-bold' : 'text-slate-400 hover:text-white hover:bg-slate-900' }}">
                    <svg class="w-5 h-5 {{ request()->routeIs('paymentmanage') ? 'text-white' : 'text-slate-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <span>Payment Approval</span>
                </a>

                <!-- 7. Feedback -->
                <a href="{{ route('feedbackmanage') }}"
                   class="flex items-center gap-3 px-3.5 py-3 rounded-2xl text-sm font-semibold transition duration-150 {{ request()->routeIs('feedbackmanage') ? 'bg-brand-500 text-white shadow-lg shadow-brand-500/25 font-bold' : 'text-slate-400 hover:text-white hover:bg-slate-900' }}">
                    <svg class="w-5 h-5 {{ request()->routeIs('feedbackmanage') ? 'text-white' : 'text-slate-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" />
                    </svg>
                    <span>Student Feedback</span>
                </a>

                <div class="pt-6 pb-2">
                    <p class="px-3 text-[10px] font-extrabold uppercase tracking-widest text-slate-500 mb-2">Shortcuts</p>
                    <a href="{{ route('dashboard') }}"
                       class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-xs font-semibold text-bio-400 hover:text-bio-300 hover:bg-bio-950/40 border border-bio-500/20 transition">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                        <span>View Student LMS</span>
                    </a>
                </div>
            </nav>

            <!-- Sidebar Footer / Admin Info -->
            <div class="p-4 border-t border-slate-850 bg-slate-950">
                <div class="flex items-center justify-between gap-3 p-2 rounded-2xl bg-slate-900 border border-slate-800">
                    <div class="flex items-center gap-2.5 truncate">
                        <div class="w-8 h-8 rounded-xl bg-gradient-to-tr from-brand-600 to-brand-400 text-white font-black text-xs flex items-center justify-center shadow-xs flex-shrink-0">
                            AD
                        </div>
                        <div class="truncate text-left">
                            <p class="text-xs font-bold text-white truncate">{{ Auth::user()->name ?? 'Admin' }}</p>
                            <p class="text-[10px] text-slate-400 truncate">Super Admin</p>
                        </div>
                    </div>

                    <form method="POST" action="{{ route('logout') }}" class="flex-shrink-0">
                        @csrf
                        <button type="submit" 
                                title="Sign out"
                                class="p-1.5 rounded-lg text-slate-400 hover:text-red-400 hover:bg-slate-800 transition">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                        </button>
                    </form>
                </div>
            </div>
        </aside>

        <!-- Main Wrapper (Offset by sidebar width on desktop) -->
        <div class="flex-1 lg:pl-72 flex flex-col min-w-0">
            
            <!-- Top Bar -->
            <header class="h-20 bg-white/95 backdrop-blur-md border-b border-slate-200 sticky top-0 z-30 px-4 sm:px-8 flex items-center justify-between shadow-xs">
                
                <div class="flex items-center gap-4">
                    <!-- Mobile Hamburger -->
                    <button @click="sidebarOpen = true" 
                            class="p-2 rounded-xl text-slate-600 hover:text-slate-900 hover:bg-slate-100 lg:hidden"
                            aria-label="Open sidebar">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
                    </button>

                    <div>
                        <h1 class="text-xl sm:text-2xl font-black text-slate-900 tracking-tight leading-tight">
                            {{ $title }}
                        </h1>
                        @if($subtitle)
                            <p class="text-xs text-slate-500 mt-0.5 hidden sm:block">{{ $subtitle }}</p>
                        @endif
                    </div>
                </div>

                <div class="flex items-center gap-3">
                    <div class="hidden sm:flex items-center gap-2 px-3 py-1.5 rounded-xl bg-slate-100 border border-slate-200 text-xs text-slate-600">
                        <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                        <span class="font-semibold">System Online</span>
                    </div>

                    <a href="{{ route('dashboard') }}" 
                       class="inline-flex items-center gap-1.5 px-3.5 py-2 rounded-xl text-xs font-bold text-slate-700 hover:text-brand-500 hover:bg-slate-100 border border-slate-200 transition">
                        <span>LMS View</span>
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                    </a>
                </div>

            </header>

            <!-- Main Page Content -->
            <main class="flex-1 p-4 sm:p-6 lg:p-8 space-y-6">

                <!-- Dismissible Success Alert -->
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

                <!-- Dismissible Error Alert -->
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

                <!-- Validation Errors Alert -->
                @if(isset($errors) && $errors->any())
                    <div class="p-4 rounded-2xl bg-red-50 border border-red-200 text-red-800 shadow-xs space-y-1">
                        <div class="flex items-center gap-2 text-sm font-bold text-red-900">
                            <svg class="w-5 h-5 text-red-600 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                            </svg>
                            <span>Please resolve the following errors:</span>
                        </div>
                        <ul class="list-disc list-inside text-xs text-red-700 pl-6 space-y-0.5">
                            @foreach($errors->all() as $err)
                                <li>{{ $err }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                {{ $slot }}

            </main>

            <!-- Admin Footer -->
            <footer class="border-t border-slate-200 bg-white py-4 px-6 sm:px-8 text-xs text-slate-500 flex flex-col sm:flex-row items-center justify-between gap-2 mt-auto">
                <div>
                    <span class="font-extrabold text-slate-800">LT<span class="text-brand-500">bio</span></span> Admin Panel &copy; {{ date('Y') }}
                </div>
                <div class="text-slate-400">
                    Lakshitha Thennakoon Advanced LMS
                </div>
            </footer>

        </div>

    </div>

</body>
</html>
