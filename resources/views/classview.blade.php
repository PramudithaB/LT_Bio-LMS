<!DOCTYPE html>
<html lang="en" class="h-full bg-slate-50">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $class->className }} - Course Modules | LTbio LMS</title>
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

<body class="min-h-full flex flex-col font-sans text-slate-800 bg-slate-50 antialiased selection:bg-brand-500 selection:text-white">

    <!-- Top Navigation Component -->
    <x-lms-navbar />

    <!-- Main Container -->
    <main class="flex-grow max-w-7xl mx-auto w-full px-4 sm:px-6 lg:px-8 py-8 space-y-8">

        <!-- Breadcrumbs -->
        <nav class="flex items-center text-xs sm:text-sm font-medium text-slate-500 space-x-2">
            <a href="{{ route('dashboard') }}" class="hover:text-brand-500 transition flex items-center gap-1.5">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                </svg>
                Dashboard
            </a>
            <svg class="w-3.5 h-3.5 text-slate-300" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
            </svg>
            <span class="text-slate-800 font-semibold truncate">{{ $class->className }}</span>
        </nav>

        @php
            $userId = auth()->id();
            $userName = auth()->user()->name ?? null;
            $isAdmin = auth()->check() && auth()->user()->usertype === 'admin';

            // Check if user has an approved checkout for this class
            $isClassApproved = false;
            if (auth()->check()) {
                $isClassApproved = $isAdmin || \App\Models\Checkout::where('status', 'approved')
                    ->whereRaw("CONCAT(',', REPLACE(class_id, ' ', ''), ',') LIKE ?", ['%,' . $class->id . ',%'])
                    ->where(function($q) use ($userId, $userName) {
                        $q->where('user_id', $userId);
                        if ($userName) {
                            $q->orWhere('student_name', $userName);
                        }
                    })
                    ->exists();
            }

            // Find first accessible lesson for quick launch
            $firstAccessibleLesson = null;
            foreach ($class->lessons as $l) {
                if (!$l->is_paid || $isClassApproved) {
                    $firstAccessibleLesson = $l;
                    break;
                }
            }
        @endphp

        <!-- Course Header Banner -->
        <div class="relative overflow-hidden rounded-3xl bg-gradient-to-r from-slate-900 via-slate-800 to-slate-900 text-white p-6 sm:p-8 md:p-10 shadow-xl border border-slate-700/50">
            <div class="absolute -right-20 -top-20 w-80 h-80 bg-brand-500/15 rounded-full blur-3xl pointer-events-none"></div>

            <div class="relative z-10 flex flex-col lg:flex-row lg:items-center justify-between gap-8">
                
                <div class="space-y-4 max-w-3xl">
                    <div class="flex flex-wrap items-center gap-2.5">
                        <span class="px-3 py-1 rounded-full text-xs font-extrabold uppercase tracking-wider bg-brand-500 text-white shadow-xs">
                            {{ $class->month ?? 'Theory / Revision' }}
                        </span>

                        @if($isClassApproved)
                            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-emerald-500/20 text-emerald-300 border border-emerald-500/30">
                                <span class="w-1.5 h-1.5 rounded-full bg-emerald-400"></span>
                                Full Access Enrolled
                            </span>
                        @else
                            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-amber-500/20 text-amber-300 border border-amber-500/30">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                </svg>
                                Enrollment Required for Paid Lessons
                            </span>
                        @endif
                    </div>

                    <h1 class="text-3xl sm:text-4xl font-black tracking-tight text-white">
                        {{ $class->className }}
                    </h1>

                    <p class="text-slate-300 text-sm sm:text-base leading-relaxed">
                        {{ $class->description ?? 'Comprehensive A/L Biology lecture series covering syllabus theories, past paper discussions, and revision materials.' }}
                    </p>

                    <!-- Course Meta Details Pill Grid -->
                    <div class="grid grid-cols-2 sm:grid-cols-4 gap-3 pt-2">
                        <div class="p-3 rounded-2xl bg-slate-800/60 border border-slate-700/60">
                            <p class="text-[10px] uppercase font-bold text-slate-400">Schedule Time</p>
                            <p class="text-sm font-bold text-white mt-0.5 truncate">{{ $class->classTime ?: 'Regular Weekly' }}</p>
                        </div>
                        <div class="p-3 rounded-2xl bg-slate-800/60 border border-slate-700/60">
                            <p class="text-[10px] uppercase font-bold text-slate-400">Sessions</p>
                            <p class="text-sm font-bold text-white mt-0.5">{{ $class->sessionCount ? $class->sessionCount . ' Sessions' : '4 Sessions / Mo' }}</p>
                        </div>
                        <div class="p-3 rounded-2xl bg-slate-800/60 border border-slate-700/60">
                            <p class="text-[10px] uppercase font-bold text-slate-400">Modules</p>
                            <p class="text-sm font-bold text-white mt-0.5">{{ $class->lessons->count() }} Lessons</p>
                        </div>
                        <div class="p-3 rounded-2xl bg-slate-800/60 border border-slate-700/60">
                            <p class="text-[10px] uppercase font-bold text-slate-400">Academic Month</p>
                            <p class="text-sm font-bold text-white mt-0.5 truncate">{{ $class->month ?: 'Active Term' }}</p>
                        </div>
                    </div>
                </div>

                <!-- Instructor Card & Quick Action -->
                <div class="flex flex-col sm:flex-row lg:flex-col items-center gap-4 bg-slate-800/80 backdrop-blur-md p-5 rounded-3xl border border-slate-700/80 shadow-lg min-w-[260px]">
                    <div class="flex items-center gap-3.5 w-full">
                        <img src="{{ asset('images/profile1.jpeg') }}" 
                             alt="Lakshitha Thennakoon" 
                             class="w-14 h-14 rounded-2xl object-cover ring-2 ring-brand-500/50 shadow-md">
                        <div>
                            <p class="text-xs font-semibold text-slate-400 uppercase tracking-wider">Lecturer</p>
                            <h4 class="text-base font-bold text-white leading-tight">Lakshitha Thennakoon</h4>
                            <p class="text-xs text-bio-400 font-medium mt-0.5">B.Sc. Biology Specialist</p>
                        </div>
                    </div>

                    @if($firstAccessibleLesson)
                        <a href="{{ route('classvideo', $firstAccessibleLesson->id) }}"
                           class="w-full flex items-center justify-center gap-2 py-3 px-4 rounded-xl font-bold text-sm text-white bg-brand-500 hover:bg-brand-600 active:scale-[0.99] shadow-xs transition duration-150">
                            <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24">
                                <path d="M8 5v14l11-7z" />
                            </svg>
                            <span>Continue Learning</span>
                        </a>
                    @else
                        <a href="{{ route('buyclass') }}"
                           class="w-full flex items-center justify-center gap-2 py-3 px-4 rounded-xl font-bold text-sm text-white bg-amber-500 hover:bg-amber-600 active:scale-[0.99] shadow-xs transition duration-150">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                            <span>Enroll in Class</span>
                        </a>
                    @endif
                </div>

            </div>
        </div>

        <!-- Lessons Syllabus Section -->
        <div class="space-y-6">
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 border-b border-slate-200 pb-4">
                <div>
                    <h2 class="text-2xl font-extrabold text-slate-900 tracking-tight flex items-center gap-2.5">
                        <span class="w-2.5 h-6 rounded-full bg-brand-500 inline-block"></span>
                        Course Syllabus & Video Lessons
                    </h2>
                    <p class="text-sm text-slate-500 mt-0.5">Select a lesson to watch the video lecture and download related materials</p>
                </div>

                <span class="text-xs font-bold text-slate-500 bg-slate-100 px-3 py-1.5 rounded-xl self-start sm:self-auto">
                    {{ $class->lessons->count() }} Lessons Available
                </span>
            </div>

            <!-- Lessons Grid / Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse($class->lessons as $index => $lesson)
                    @php
                        $canView = ! $lesson->is_paid || $isClassApproved;
                        $videoRoute = route('classvideo', $lesson->id);
                        $formattedIndex = str_pad($index + 1, 2, '0', STR_PAD_LEFT);
                    @endphp

                    <div class="group flex flex-col bg-white rounded-3xl border {{ $canView ? 'border-slate-200/80 hover:border-brand-500/40 hover:shadow-xl' : 'border-slate-200/60 bg-slate-50/50' }} p-6 shadow-xs transition-all duration-200 justify-between space-y-5">
                        
                        <div class="space-y-3">
                            
                            <!-- Card Header: Number + Status Badge -->
                            <div class="flex items-center justify-between">
                                <span class="text-xs font-black tracking-wider text-slate-400 group-hover:text-brand-500 transition">
                                    LESSON #{{ $formattedIndex }}
                                </span>

                                @if($lesson->is_paid)
                                    @if($canView)
                                        <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-[11px] font-bold bg-emerald-100 text-emerald-800">
                                            <svg class="w-3 h-3 text-emerald-600" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                            </svg>
                                            Unlocked
                                        </span>
                                    @else
                                        <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-[11px] font-bold bg-amber-100 text-amber-800">
                                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                            </svg>
                                            Paid Module
                                        </span>
                                    @endif
                                @else
                                    <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-[11px] font-bold bg-blue-100 text-blue-800">
                                        Free Preview
                                    </span>
                                @endif
                            </div>

                            <!-- Lesson Title -->
                            <h3 class="text-lg font-bold text-slate-900 group-hover:text-brand-500 transition line-clamp-2">
                                {{ $lesson->name }}
                            </h3>

                            <!-- Lesson Description -->
                            @if($lesson->description)
                                <p class="text-xs text-slate-500 line-clamp-3 leading-relaxed">
                                    {{ $lesson->description }}
                                </p>
                            @endif

                            <!-- Teacher Notice Box (if any) -->
                            @if($lesson->notice)
                                <div class="p-3 rounded-xl bg-amber-50 border border-amber-200/80 text-[11px] text-amber-900 leading-snug">
                                    <span class="font-bold">Notice:</span> {{ $lesson->notice }}
                                </div>
                            @endif

                            <!-- Lesson File / Material Attachment -->
                            @if($lesson->file_path)
                                <div class="pt-1">
                                    <a href="{{ route('storage.file', ['encoded' => base64_encode($lesson->file_path)]) }}"
                                       target="_blank"
                                       class="inline-flex items-center gap-2 text-xs font-semibold text-bio-600 hover:text-bio-700 bg-bio-50 hover:bg-bio-100 px-3 py-1.5 rounded-lg border border-bio-100 transition">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                        </svg>
                                        <span>Download Attached Tute/PDF</span>
                                    </a>
                                </div>
                            @endif

                        </div>

                        <!-- Action Button -->
                        <div class="pt-4 border-t border-slate-100">
                            @if($canView)
                                <a href="{{ $videoRoute }}"
                                   class="w-full flex items-center justify-center gap-2 py-2.5 px-4 rounded-xl font-bold text-sm text-white bg-brand-500 hover:bg-brand-600 active:scale-[0.99] shadow-xs transition duration-150">
                                    <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24">
                                        <path d="M8 5v14l11-7z" />
                                    </svg>
                                    <span>Watch Video Lecture</span>
                                </a>
                            @else
                                <a href="{{ route('buyclass') }}"
                                   class="w-full flex items-center justify-center gap-2 py-2.5 px-4 rounded-xl font-bold text-sm text-white bg-amber-500 hover:bg-amber-600 active:scale-[0.99] shadow-xs transition duration-150">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                                    </svg>
                                    <span>Enroll to Unlock</span>
                                </a>
                            @endif
                        </div>

                    </div>

                @empty
                    <div class="col-span-full bg-white rounded-3xl border border-slate-200/80 p-12 text-center max-w-md mx-auto shadow-xs">
                        <div class="w-14 h-14 rounded-2xl bg-slate-100 text-slate-400 flex items-center justify-center mx-auto mb-3">
                            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <h4 class="text-lg font-bold text-slate-900 mb-1">No Lessons Uploaded</h4>
                        <p class="text-xs text-slate-500">Lectures for this class will be uploaded shortly by the instructor.</p>
                    </div>
                @endforelse
            </div>
        </div>

        <!-- Essential Study Materials Guidance Card -->
        <div class="bg-white rounded-3xl border border-slate-200/80 p-6 sm:p-8 shadow-xs">
            <div class="flex items-center gap-3 mb-6">
                <div class="w-10 h-10 rounded-xl bg-bio-50 text-bio-600 flex items-center justify-center">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                    </svg>
                </div>
                <div>
                    <h3 class="text-xl font-bold text-slate-900">Essential Class Notes & Guides</h3>
                    <p class="text-xs text-slate-500">Resource files attached directly to individual lessons above or accessible for registered students</p>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div class="p-4 rounded-2xl bg-slate-50 border border-slate-200/70 flex items-start gap-3">
                    <div class="w-8 h-8 rounded-lg bg-emerald-100 text-emerald-700 flex items-center justify-center flex-shrink-0">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                    </div>
                    <div>
                        <h4 class="text-sm font-bold text-slate-800">Theory Tutes & Notes</h4>
                        <p class="text-xs text-slate-500 mt-0.5">Download syllabus-matched theory documents directly inside each lecture lesson page.</p>
                    </div>
                </div>

                <div class="p-4 rounded-2xl bg-slate-50 border border-slate-200/70 flex items-start gap-3">
                    <div class="w-8 h-8 rounded-lg bg-bio-100 text-bio-700 flex items-center justify-center flex-shrink-0">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" /></svg>
                    </div>
                    <div>
                        <h4 class="text-sm font-bold text-slate-800">Past Paper Analyses</h4>
                        <p class="text-xs text-slate-500 mt-0.5">Structured essay marking schemes and MCQ breakdowns reviewed in video sessions.</p>
                    </div>
                </div>

                <div class="p-4 rounded-2xl bg-slate-50 border border-slate-200/70 flex items-start gap-3">
                    <div class="w-8 h-8 rounded-lg bg-purple-100 text-purple-700 flex items-center justify-center flex-shrink-0">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z" /></svg>
                    </div>
                    <div>
                        <h4 class="text-sm font-bold text-slate-800">Student Support</h4>
                        <p class="text-xs text-slate-500 mt-0.5">For payment approvals or access questions, contact the LTbio admin WhatsApp hotline.</p>
                    </div>
                </div>
            </div>
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