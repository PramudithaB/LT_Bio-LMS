<!DOCTYPE html>
<html lang="en" class="h-full bg-slate-900">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $lesson->name }} - {{ $lesson->classModel->className ?? 'Lesson' }} | LTbio LMS</title>
    <link rel="icon" type="image/jpeg" href="{{ asset('images/logo1.jpeg') }}">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Tailwind & Alpine CDN -->
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

<body class="min-h-full flex flex-col font-sans text-slate-100 bg-slate-950 antialiased selection:bg-brand-500 selection:text-white">

    <!-- Top Navigation -->
    <x-lms-navbar />

    @php
        $class = $lesson->classModel;
        $allLessons = $class ? $class->lessons->sortBy('id')->values() : collect([$lesson]);
        
        $currentIndex = $allLessons->search(function($item) use ($lesson) {
            return $item->id === $lesson->id;
        });
        
        if ($currentIndex === false) {
            $currentIndex = 0;
        }

        $prevLesson = ($currentIndex > 0) ? $allLessons->get($currentIndex - 1) : null;
        $nextLesson = ($currentIndex < $allLessons->count() - 1) ? $allLessons->get($currentIndex + 1) : null;
        
        // Student enrollment check for paid status
        $userId = auth()->id();
        $userName = auth()->user()->name ?? null;
        $isAdmin = auth()->check() && auth()->user()->usertype === 'admin';
    @endphp

    <!-- Sub-header Breadcrumb Bar -->
    <div class="bg-slate-900/90 border-b border-slate-800/80 backdrop-blur-md px-4 sm:px-6 lg:px-8 py-3">
        <div class="max-w-7xl mx-auto flex flex-col sm:flex-row sm:items-center justify-between gap-3 text-xs sm:text-sm">
            
            <div class="flex items-center space-x-2 text-slate-400 truncate">
                <a href="{{ route('dashboard') }}" class="hover:text-white transition">Dashboard</a>
                <svg class="w-3.5 h-3.5 text-slate-600" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                </svg>
                @if($class)
                    <a href="{{ route('classview', $class->id) }}" class="hover:text-brand-400 transition truncate max-w-[200px]">
                        {{ $class->className }}
                    </a>
                    <svg class="w-3.5 h-3.5 text-slate-600" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                    </svg>
                @endif
                <span class="text-white font-semibold truncate">{{ $lesson->name }}</span>
            </div>

            @if($class)
                <a href="{{ route('classview', $class->id) }}"
                   class="inline-flex items-center gap-1.5 text-xs font-semibold text-slate-300 hover:text-white bg-slate-800 hover:bg-slate-700/80 px-3 py-1.5 rounded-lg border border-slate-700/60 transition self-start sm:self-auto">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    Back to Course Syllabus
                </a>
            @endif

        </div>
    </div>

    <!-- Main Player & Content Grid -->
    <main class="flex-grow max-w-7xl mx-auto w-full px-4 sm:px-6 lg:px-8 py-6 lg:py-8">
        <div class="flex flex-col lg:flex-row gap-8 items-start">

            <!-- LEFT: Video Player + Details + Navigation (Flex 1) -->
            <div class="flex-1 w-full space-y-6">

                <!-- Responsive YouTube Embed Component -->
                <div class="w-full">
                    <x-youtube-player :url="$lesson->link" :title="$lesson->name" :autoplay="true" />
                </div>

                <!-- Lesson Info & Metadata Card -->
                <div class="bg-slate-900 rounded-3xl border border-slate-800/80 p-6 sm:p-8 space-y-6 shadow-xl">
                    
                    <!-- Title & Badges Header -->
                    <div class="flex flex-col sm:flex-row sm:items-start justify-between gap-4 border-b border-slate-800/80 pb-6">
                        <div class="space-y-2">
                            <div class="flex flex-wrap items-center gap-2">
                                <span class="px-2.5 py-0.5 rounded-md text-[11px] font-extrabold uppercase tracking-wider bg-brand-500/20 text-brand-400 border border-brand-500/30">
                                    Module {{ $currentIndex + 1 }} of {{ $allLessons->count() }}
                                </span>

                                @if($lesson->is_paid)
                                    <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-md text-[11px] font-bold bg-emerald-500/20 text-emerald-300 border border-emerald-500/30">
                                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-400"></span>
                                        Paid Session
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-md text-[11px] font-bold bg-blue-500/20 text-blue-300 border border-blue-500/30">
                                        Free Preview
                                    </span>
                                @endif

                                @if($class && $class->className)
                                    <span class="text-xs text-slate-400 font-medium">
                                        in <strong class="text-slate-200">{{ $class->className }}</strong>
                                    </span>
                                @endif
                            </div>

                            <h1 class="text-2xl sm:text-3xl font-extrabold text-white tracking-tight">
                                {{ $lesson->name }}
                            </h1>
                        </div>

                        <!-- Instructor Mini Avatar -->
                        <div class="flex items-center gap-3 bg-slate-950/60 p-2.5 rounded-2xl border border-slate-800 flex-shrink-0">
                            <img src="{{ asset('images/profile1.jpeg') }}" 
                                 alt="Lakshitha Thennakoon" 
                                 class="w-10 h-10 rounded-xl object-cover ring-1 ring-brand-500/40">
                            <div class="text-left">
                                <p class="text-[11px] font-semibold text-white">Lakshitha Thennakoon</p>
                                <p class="text-[10px] text-slate-400">Biology Instructor</p>
                            </div>
                        </div>
                    </div>

                    <!-- Teacher Notice (if present) -->
                    @if($lesson->notice)
                        <div class="p-4 rounded-2xl bg-amber-950/40 border border-amber-800/60 text-amber-200 flex items-start gap-3 text-xs sm:text-sm">
                            <svg class="w-5 h-5 text-amber-400 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <div>
                                <span class="font-bold text-amber-300">Important Teacher Notice:</span>
                                <p class="mt-0.5 text-amber-200/90 leading-relaxed">{{ $lesson->notice }}</p>
                            </div>
                        </div>
                    @endif

                    <!-- Lesson Description -->
                    <div class="space-y-2">
                        <h3 class="text-xs uppercase font-extrabold tracking-wider text-slate-400">Lesson Description</h3>
                        <p class="text-slate-300 text-sm sm:text-base leading-relaxed whitespace-pre-line">
                            {{ $lesson->description ?: 'No detailed written description provided for this lesson module.' }}
                        </p>
                    </div>

                    <!-- Attached Study Material (if any) -->
                    @if($lesson->file_path)
                        <div class="p-4 rounded-2xl bg-slate-950/70 border border-slate-800 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                            <div class="flex items-center gap-3.5">
                                <div class="w-10 h-10 rounded-xl bg-bio-500/15 text-bio-400 flex items-center justify-center flex-shrink-0 border border-bio-500/20">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                    </svg>
                                </div>
                                <div>
                                    <h4 class="text-sm font-bold text-white">Lesson Study Notes / Worksheet</h4>
                                    <p class="text-xs text-slate-400">Download the PDF notes attached to this lecture module.</p>
                                </div>
                            </div>

                            <a href="{{ route('storage.file', ['encoded' => base64_encode($lesson->file_path)]) }}"
                               target="_blank"
                               class="inline-flex items-center justify-center gap-2 px-4 py-2.5 rounded-xl bg-bio-500 hover:bg-bio-600 text-white text-xs font-bold shadow-xs transition duration-150 flex-shrink-0">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                                </svg>
                                <span>Download PDF Notes</span>
                            </a>
                        </div>
                    @endif

                    <!-- Lesson Navigation Controls -->
                    <div class="pt-6 border-t border-slate-800/80 flex items-center justify-between gap-4">
                        
                        <!-- Previous Lesson Button -->
                        @if($prevLesson)
                            <a href="{{ route('classvideo', $prevLesson->id) }}"
                               class="inline-flex items-center gap-2 px-4 sm:px-5 py-3 rounded-2xl bg-slate-800 hover:bg-slate-700 text-white text-xs sm:text-sm font-bold border border-slate-700/80 transition duration-150 active:scale-[0.99] group">
                                <svg class="w-4 h-4 transition-transform group-hover:-translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                                </svg>
                                <span class="hidden sm:inline">Previous Lesson</span>
                                <span class="sm:hidden">Prev</span>
                            </a>
                        @else
                            <button disabled class="inline-flex items-center gap-2 px-4 sm:px-5 py-3 rounded-2xl bg-slate-800/40 text-slate-600 text-xs sm:text-sm font-semibold border border-slate-800/50 cursor-not-allowed">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                                </svg>
                                <span class="hidden sm:inline">Previous Lesson</span>
                                <span class="sm:hidden">Prev</span>
                            </button>
                        @endif

                        <!-- Course Syllabus Center Link -->
                        @if($class)
                            <a href="{{ route('classview', $class->id) }}"
                               class="text-xs font-semibold text-slate-400 hover:text-white transition hidden md:inline-flex items-center gap-1">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16" />
                                </svg>
                                View All Modules
                            </a>
                        @endif

                        <!-- Next Lesson Button -->
                        @if($nextLesson)
                            <a href="{{ route('classvideo', $nextLesson->id) }}"
                               class="inline-flex items-center gap-2 px-4 sm:px-5 py-3 rounded-2xl bg-brand-500 hover:bg-brand-600 text-white text-xs sm:text-sm font-bold shadow-lg shadow-brand-500/20 transition duration-150 active:scale-[0.99] group">
                                <span class="hidden sm:inline">Next Lesson</span>
                                <span class="sm:hidden">Next</span>
                                <svg class="w-4 h-4 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                </svg>
                            </a>
                        @else
                            <button disabled class="inline-flex items-center gap-2 px-4 sm:px-5 py-3 rounded-2xl bg-slate-800/40 text-slate-600 text-xs sm:text-sm font-semibold border border-slate-800/50 cursor-not-allowed">
                                <span class="hidden sm:inline">Course Completed</span>
                                <span class="sm:hidden">Completed</span>
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                </svg>
                            </button>
                        @endif

                    </div>

                </div>

            </div>

            <!-- RIGHT: Modern Course Content Sidebar (Sticky on desktop, w-80/w-96) -->
            <aside class="w-full lg:w-88 xl:w-96 space-y-6 flex-shrink-0">
                
                <div class="bg-slate-900 rounded-3xl border border-slate-800/80 p-6 shadow-xl space-y-4">
                    
                    <!-- Sidebar Header -->
                    <div class="flex items-center justify-between border-b border-slate-800 pb-4">
                        <div>
                            <h2 class="text-base font-bold text-white tracking-tight flex items-center gap-2">
                                <svg class="w-5 h-5 text-brand-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                                </svg>
                                Course Lessons
                            </h2>
                            <p class="text-xs text-slate-400 mt-0.5">
                                {{ $allLessons->count() }} modules in this class
                            </p>
                        </div>

                        <span class="text-xs font-bold text-slate-300 bg-slate-800 px-2.5 py-1 rounded-lg border border-slate-700/50">
                            {{ $currentIndex + 1 }}/{{ $allLessons->count() }}
                        </span>
                    </div>

                    <!-- Lessons List Scroll Area -->
                    <div class="space-y-2 max-h-[600px] overflow-y-auto pr-1">
                        @foreach($allLessons as $idx => $item)
                            @php
                                $isCurrent = ($item->id === $lesson->id);
                                $num = str_pad($idx + 1, 2, '0', STR_PAD_LEFT);
                            @endphp

                            @if($isCurrent)
                                <!-- Currently Playing Active Lesson -->
                                <div class="flex items-center gap-3 p-3.5 rounded-2xl bg-brand-500/15 border-l-4 border-brand-500 text-white shadow-inner">
                                    <div class="w-8 h-8 rounded-xl bg-brand-500 text-white flex items-center justify-center font-black text-xs flex-shrink-0 shadow-xs">
                                        <svg class="w-4 h-4 fill-current animate-pulse" viewBox="0 0 24 24">
                                            <path d="M8 5v14l11-7z" />
                                        </svg>
                                    </div>
                                    <div class="flex-grow min-w-0">
                                        <div class="flex items-center justify-between gap-1">
                                            <span class="text-[10px] font-extrabold uppercase text-brand-400 tracking-wider">Now Playing</span>
                                            @if(!$item->is_paid)
                                                <span class="text-[9px] text-blue-400 font-bold">FREE</span>
                                            @endif
                                        </div>
                                        <h4 class="text-xs font-bold text-white truncate">{{ $item->name }}</h4>
                                    </div>
                                </div>
                            @else
                                <!-- Clickable Navigation Item -->
                                <a href="{{ route('classvideo', $item->id) }}"
                                   class="group flex items-center gap-3 p-3.5 rounded-2xl bg-slate-950/40 hover:bg-slate-800/80 border border-slate-800/60 hover:border-slate-700 transition duration-150">
                                    <div class="w-8 h-8 rounded-xl bg-slate-800 text-slate-400 group-hover:text-white group-hover:bg-brand-500/30 flex items-center justify-center font-bold text-xs flex-shrink-0 transition">
                                        {{ $num }}
                                    </div>
                                    <div class="flex-grow min-w-0">
                                        <div class="flex items-center justify-between gap-1">
                                            <span class="text-[10px] font-medium text-slate-500 group-hover:text-slate-400">Lesson {{ $idx + 1 }}</span>
                                            @if(!$item->is_paid)
                                                <span class="text-[9px] text-blue-400 font-bold">FREE</span>
                                            @endif
                                        </div>
                                        <h4 class="text-xs font-semibold text-slate-300 group-hover:text-white truncate transition">
                                            {{ $item->name }}
                                        </h4>
                                    </div>
                                    <svg class="w-4 h-4 text-slate-600 group-hover:text-brand-400 group-hover:translate-x-0.5 transition flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                    </svg>
                                </a>
                            @endif
                        @endforeach
                    </div>

                    @if($class)
                        <div class="pt-2 border-t border-slate-800">
                            <a href="{{ route('classview', $class->id) }}"
                               class="w-full flex items-center justify-center gap-2 py-2.5 px-4 rounded-xl text-xs font-bold text-slate-300 hover:text-white bg-slate-800/70 hover:bg-slate-800 border border-slate-700/60 transition">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16" />
                                </svg>
                                <span>Full Course Syllabus</span>
                            </a>
                        </div>
                    @endif

                </div>

                <!-- Instructor Card -->
                <div class="bg-slate-900 rounded-3xl border border-slate-800/80 p-5 shadow-xl space-y-3">
                    <div class="flex items-center gap-3">
                        <img src="{{ asset('images/profile1.jpeg') }}" 
                             alt="Lakshitha Thennakoon" 
                             class="w-12 h-12 rounded-2xl object-cover ring-2 ring-brand-500/40">
                        <div>
                            <h4 class="text-sm font-bold text-white">Lakshitha Thennakoon</h4>
                            <p class="text-xs text-slate-400">B.Sc. Biology Specialist</p>
                        </div>
                    </div>
                    <p class="text-xs text-slate-400 leading-relaxed">
                        Need assistance with this lecture or past paper question? Reach out through the student support portal.
                    </p>
                </div>

            </aside>

        </div>
    </main>

    <!-- Simple Footer -->
    <footer class="mt-auto border-t border-slate-800 bg-slate-950 py-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col sm:flex-row items-center justify-between gap-4 text-xs text-slate-500">
            <div class="flex items-center gap-2">
                <span class="font-extrabold text-slate-200">LT<span class="text-brand-500">bio</span></span>
                <span>&copy; {{ date('Y') }} Lakshitha Thennakoon. All rights reserved.</span>
            </div>
            <div class="flex items-center gap-4">
                <a href="{{ route('dashboard') }}" class="hover:text-brand-400 transition">Dashboard</a>
                <a href="{{ route('buyclass') }}" class="hover:text-brand-400 transition">Courses</a>
                <a href="{{ route('cart.view') }}" class="hover:text-brand-400 transition">Cart</a>
            </div>
        </div>
    </footer>

</body>
</html>
