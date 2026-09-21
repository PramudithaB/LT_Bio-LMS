<!DOCTYPE html>
<html lang="si" class="scroll-smooth">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>LTbio - Lakshitha Thennakoon | Advanced Level Biology</title>
    <meta name="description"
        content="Official learning platform for Advanced Level Biology by Lakshitha Thennakoon. Theory, Revision, Video Lectures, and Model Papers.">
    <link rel="icon" type="image/jpeg" href="{{ asset('images/logo1.jpeg') }}" />

    <!-- Google Fonts: Inter -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">

    <!-- Scripts & Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        /* Custom visual enhancements */
        .glass-nav {
            background: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
        }

        .hero-stage {
            perspective: 1200px;
        }

        .preserve-3d {
            transform-style: preserve-3d;
        }

        .fadeInUp {
            opacity: 0;
            transform: translateY(24px);
            transition: opacity 600ms cubic-bezier(0.16, 1, 0.3, 1), transform 600ms cubic-bezier(0.16, 1, 0.3, 1);
        }

        .in-view {
            opacity: 1;
            transform: translateY(0);
        }

        /* Custom hide scrollbar */
        .no-scrollbar::-webkit-scrollbar {
            display: none;
        }

        .no-scrollbar {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }
    </style>
</head>

<body
    class="font-sans antialiased text-slate-800 bg-slate-50 selection:bg-brand-500 selection:text-white overflow-x-hidden">

    <!-- TOP NAVIGATION BAR -->
    <nav class="fixed top-0 inset-x-0 z-50 glass-nav border-b border-slate-200/80 transition-all duration-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-20">

                <!-- Brand Logo -->
                <a href="#home" class="flex items-center gap-3 group">
                    <img src="{{ asset('images/logo1.jpeg') }}" alt="LTbio.lk Logo"
                        class="w-11 h-11 rounded-xl object-cover shadow-sm border-2 border-brand-500/20 group-hover:scale-105 transition-transform" />
                    <div>
                        <div class="text-2xl font-black tracking-tight text-slate-900 leading-none">
                            LT<span class="text-brand-500">bio</span><span
                                class="text-xs font-bold text-bio-500 ml-0.5">.lk</span>
                        </div>
                        <span class="text-[10px] font-bold text-slate-400 tracking-wider uppercase">Lakshitha
                            Thennakoon</span>
                    </div>
                </a>

                <!-- Desktop Nav Links -->
                <div class="hidden md:flex items-center gap-8">
                    <a href="#home"
                        class="text-sm font-semibold text-slate-600 hover:text-brand-600 transition-colors">Home</a>
                    <a href="#about"
                        class="text-sm font-semibold text-slate-600 hover:text-brand-600 transition-colors">About</a>
                    <a href="#institutes"
                        class="text-sm font-semibold text-slate-600 hover:text-brand-600 transition-colors">Feedback &
                        Community</a>
                    <a href="#gallery"
                        class="text-sm font-semibold text-slate-600 hover:text-brand-600 transition-colors">Gallery</a>
                    <a href="{{ route('buyclass') }}"
                        class="text-sm font-semibold text-slate-600 hover:text-brand-600 transition-colors">Course
                        Packages</a>
                </div>

                <!-- Desktop Auth Actions -->
                <div class="hidden md:flex items-center gap-3">
                    @auth
                        @if(Auth::user()->usertype === 'admin')
                            <a href="{{ route('admindashboard') }}"
                                class="px-4 py-2.5 rounded-xl bg-slate-900 hover:bg-slate-800 text-white font-bold text-xs shadow-sm hover:shadow transition-all flex items-center gap-2">
                                <svg class="w-4 h-4 text-brand-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                                <span>Admin Panel</span>
                            </a>
                        @else
                            <a href="{{ route('dashboard') }}"
                                class="px-4 py-2.5 rounded-xl bg-gradient-to-r from-brand-600 to-brand-500 hover:from-brand-500 hover:to-brand-600 text-white font-bold text-xs shadow-md shadow-brand-500/20 hover:shadow-brand-500/30 transition-all flex items-center gap-2">
                                <span>My Dashboard</span>
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                        d="M14 5l7 7m0 0l-7 7m7-7H3" />
                                </svg>
                            </a>
                        @endif
                    @else
                        <a href="{{ route('login') }}"
                            class="px-4 py-2.5 rounded-xl text-slate-700 hover:text-brand-600 hover:bg-slate-100 font-bold text-xs transition-colors">
                            Sign In
                        </a>
                        <a href="{{ route('register') }}"
                            class="px-4 py-2.5 rounded-xl bg-gradient-to-r from-brand-600 to-brand-500 hover:from-brand-500 hover:to-brand-600 text-white font-bold text-xs shadow-md shadow-brand-500/20 hover:shadow-brand-500/30 hover:-translate-y-0.5 transition-all">
                            Student Register
                        </a>
                    @endauth
                </div>

                <!-- Mobile Menu Button -->
                <div class="flex md:hidden items-center">
                    <button id="navToggle" type="button" aria-label="Toggle navigation"
                        class="p-2 rounded-xl text-slate-600 hover:text-slate-900 hover:bg-slate-100 transition-colors focus:outline-none">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path id="navIconOpen" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16" />
                            <path id="navIconClose" class="hidden" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

            </div>
        </div>

        <!-- Mobile Menu Dropdown Drawer -->
        <div id="mobileMenu"
            class="hidden md:hidden border-t border-slate-200 bg-white/95 backdrop-blur-xl px-4 pt-3 pb-6 space-y-3 shadow-xl">
            <div class="flex flex-col space-y-2">
                <a href="#home"
                    class="mobile-nav-link px-3 py-2 rounded-lg font-semibold text-slate-700 hover:bg-slate-50 hover:text-brand-600">Home</a>
                <a href="#about"
                    class="mobile-nav-link px-3 py-2 rounded-lg font-semibold text-slate-700 hover:bg-slate-50 hover:text-brand-600">About</a>
                <a href="#institutes"
                    class="mobile-nav-link px-3 py-2 rounded-lg font-semibold text-slate-700 hover:bg-slate-50 hover:text-brand-600">Feedback
                    & Community</a>
                <a href="#gallery"
                    class="mobile-nav-link px-3 py-2 rounded-lg font-semibold text-slate-700 hover:bg-slate-50 hover:text-brand-600">Gallery</a>
                <a href="{{ route('buyclass') }}"
                    class="mobile-nav-link px-3 py-2 rounded-lg font-semibold text-slate-700 hover:bg-slate-50 hover:text-brand-600">Course
                    Packages</a>
            </div>

            <div class="pt-3 border-t border-slate-100 flex flex-col gap-2">
                @auth
                    @if(Auth::user()->usertype === 'admin')
                        <a href="{{ route('admindashboard') }}"
                            class="w-full text-center py-2.5 rounded-xl bg-slate-900 text-white font-bold text-sm">Admin
                            Panel</a>
                    @else
                        <a href="{{ route('dashboard') }}"
                            class="w-full text-center py-2.5 rounded-xl bg-brand-600 text-white font-bold text-sm">My
                            Dashboard</a>
                    @endif
                @else
                    <a href="{{ route('login') }}"
                        class="w-full text-center py-2.5 rounded-xl border border-slate-200 text-slate-800 font-bold text-sm">Sign
                        In</a>
                    <a href="{{ route('register') }}"
                        class="w-full text-center py-2.5 rounded-xl bg-brand-600 text-white font-bold text-sm">Student
                        Register</a>
                @endauth
            </div>
        </div>
    </nav>

    <!-- HERO SECTION -->
    <main class="relative pt-32 pb-20 lg:pt-40 lg:pb-28 overflow-hidden" id="home">
        <!-- Ambient Background Glows -->
        <div
            class="absolute top-20 left-1/2 -translate-x-1/2 w-full max-w-7xl h-96 bg-gradient-to-tr from-brand-500/10 via-bio-500/5 to-transparent rounded-full blur-3xl pointer-events-none -z-10">
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-8 items-center">

                <!-- Left Content Column (7 cols) -->
                <div class="lg:col-span-7 space-y-6 text-center lg:text-left">
                    <!-- Pill Tagline -->
                    <div
                        class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-brand-50 border border-brand-200/80 text-brand-600 text-xs font-extrabold uppercase tracking-wider shadow-xs">
                        <span class="w-2 h-2 rounded-full bg-brand-500 animate-pulse"></span>
                        ADVANCED LEVEL Biology | 2026 & 2027 A/L
                    </div>

                    <!-- Title & Name -->
                    <div>
                        <h1 class="text-4xl sm:text-6xl font-black text-slate-900 tracking-tight leading-none mb-2">
                            Lakshitha <span
                                class="text-transparent bg-clip-text bg-gradient-to-r from-brand-600 via-brand-500 to-rose-500">Thennakoon</span>
                        </h1>
                        <p class="text-base sm:text-lg font-bold text-bio-600 mt-2">
                            BSc (UG) Biochemistry & Molecular Biology — University Of Colombo
                        </p>
                    </div>

                    <!-- Sinhala Focus Description -->
                    <p
                        class="text-slate-600 text-base sm:text-lg leading-relaxed max-w-2xl mx-auto lg:mx-0 font-medium">
                        කට්ටපාඩම් සංස්කෘතියෙන් බැහැරව, සංකල්පීය අවබෝධය හා තාර්කික කෙටි ක්‍රම ඔස්සේ ජීව විද්‍යාව ඉහළම
                        සාමාර්ථයක් දක්වා මෙහෙයවන ශ්‍රී ලංකාවේ නවීනතම Digital පන්ති කාමරය.
                    </p>

                    <!-- Feature Badges -->
                    <div class="flex flex-wrap items-center justify-center lg:justify-start gap-2.5 pt-1">
                        <span
                            class="px-3.5 py-1.5 rounded-xl bg-white border border-slate-200 text-xs font-bold text-slate-700 shadow-xs flex items-center gap-1.5">
                            <span class="text-brand-500">✓</span> Online පන්තිය
                        </span>
                        <span
                            class="px-3.5 py-1.5 rounded-xl bg-white border border-slate-200 text-xs font-bold text-slate-700 shadow-xs flex items-center gap-1.5">
                            <span class="text-bio-500">✓</span> Theory & Revision
                        </span>
                        <span
                            class="px-3.5 py-1.5 rounded-xl bg-white border border-slate-200 text-xs font-bold text-slate-700 shadow-xs flex items-center gap-1.5">
                            <span class="text-emerald-500">✓</span> HD Video Lectures
                        </span>
                        <span
                            class="px-3.5 py-1.5 rounded-xl bg-white border border-slate-200 text-xs font-bold text-slate-700 shadow-xs flex items-center gap-1.5">
                            <span class="text-amber-500">★</span> 837+ Island Ranks
                        </span>
                    </div>

                    <!-- Call To Action Buttons -->
                    <div class="flex flex-col sm:flex-row items-center justify-center lg:justify-start gap-3.5 pt-3">
                        @auth
                            <a href="{{ Auth::user()->usertype === 'admin' ? route('admindashboard') : route('dashboard') }}"
                                class="w-full sm:w-auto px-8 py-4 rounded-xl bg-gradient-to-r from-brand-600 to-brand-500 hover:from-brand-500 hover:to-brand-600 text-white font-extrabold text-sm shadow-xl shadow-brand-500/25 hover:shadow-brand-500/35 hover:-translate-y-0.5 transition-all flex items-center justify-center gap-2">
                                <span>Go to LMS Portal</span>
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                        d="M14 5l7 7m0 0l-7 7m7-7H3" />
                                </svg>
                            </a>
                        @else
                            <a href="{{ route('login') }}"
                                class="w-full sm:w-auto px-8 py-4 rounded-xl bg-gradient-to-r from-brand-600 to-brand-500 hover:from-brand-500 hover:to-brand-600 text-white font-extrabold text-sm shadow-xl shadow-brand-500/25 hover:shadow-brand-500/35 hover:-translate-y-0.5 transition-all flex items-center justify-center gap-2">
                                <span>Student Login</span>
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                        d="M14 5l7 7m0 0l-7 7m7-7H3" />
                                </svg>
                            </a>
                        @endauth

                        <a href="{{ route('buyclass') }}"
                            class="w-full sm:w-auto px-7 py-4 rounded-xl bg-white hover:bg-slate-100 border border-slate-200 text-slate-800 font-extrabold text-sm shadow-sm hover:shadow transition-all flex items-center justify-center gap-2">
                            <span>Explore Classes & Packages</span>
                            <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 9l-7 7-7-7" />
                            </svg>
                        </a>
                    </div>
                </div>

                <!-- Right Visual Stage Column (5 cols) -->
                <div class="lg:col-span-5 flex justify-center hero-stage">
                    <div class="relative w-full max-w-sm sm:max-w-md preserve-3d" id="heroImageCard">

                        <!-- Decorative Double Helix Vector -->
                        <svg class="absolute -left-12 -top-8 w-28 h-80 opacity-20 pointer-events-none -z-10"
                            viewBox="0 0 120 420" xmlns="http://www.w3.org/2000/svg">
                            <defs>
                                <linearGradient id="dnaGrad" x1="0" x2="1">
                                    <stop offset="0" stop-color="#17A2B8" />
                                    <stop offset="1" stop-color="#F53003" />
                                </linearGradient>
                            </defs>
                            <g fill="none" stroke="url(#dnaGrad)" stroke-width="3" stroke-linecap="round">
                                <path d="M20 10 C40 40, 80 70, 20 100" />
                                <path d="M20 70 C40 100, 80 130, 20 160" />
                                <path d="M20 130 C40 160, 80 190, 20 220" />
                                <path d="M20 190 C40 220, 80 250, 20 280" />
                                <path d="M20 250 C40 280, 80 310, 20 340" />
                                <path d="M20 310 C40 340, 80 370, 20 400" />
                            </g>
                        </svg>

                        <!-- Main Photo Frame -->
                        <div
                            class="relative rounded-3xl p-3 bg-white/90 shadow-2xl border border-white/60 backdrop-blur-sm transition-transform duration-200">
                            <div class="rounded-2xl overflow-hidden aspect-[4/5] bg-slate-100 relative">
                                <img src="{{ asset('images/profile1.jpeg') }}" alt="Lakshitha Thennakoon"
                                    class="w-full h-full object-cover object-top" />
                                <div
                                    class="absolute inset-0 bg-gradient-to-t from-slate-950/70 via-transparent to-transparent">
                                </div>
                                <div class="absolute bottom-4 left-4 text-white">
                                    <div class="text-xs font-bold uppercase tracking-wider text-brand-400">Chief Biology
                                        Mentor</div>
                                    <div class="text-lg font-black">Lakshitha Thennakoon</div>
                                </div>
                            </div>

                            <!-- Floating Achievement Pill -->
                            <div
                                class="absolute -bottom-5 -right-5 bg-gradient-to-br from-brand-600 to-brand-500 text-white p-4 rounded-2xl shadow-xl shadow-brand-500/30 flex items-center gap-3.5 border-2 border-white">
                                <div
                                    class="w-12 h-12 rounded-xl bg-white/20 flex items-center justify-center font-black text-xl">
                                    10+
                                </div>
                                <div class="text-left pr-1">
                                    <div class="text-xs font-extrabold uppercase tracking-wider text-brand-100">Top
                                        Honors</div>
                                    <div class="text-sm font-black leading-tight">District Ranks</div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </main>

    <!-- ABOUT SECTION -->
    <section class="py-20 bg-white border-y border-slate-200/80" id="about">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="max-w-3xl mb-12">
                <span class="text-xs font-extrabold text-bio-600 uppercase tracking-widest">WHO WE ARE</span>
                <h2 class="text-3xl sm:text-4xl font-extrabold text-slate-900 tracking-tight mt-1">
                    About Lakshitha Thennakoon
                </h2>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 items-start">
                <!-- Text Narrative (7 cols) -->
                <div
                    class="lg:col-span-7 bg-slate-50 p-8 sm:p-10 rounded-2xl border border-slate-200/80 shadow-xs space-y-5 text-slate-700 leading-relaxed font-medium fadeInUp">
                    <p>
                        කැකිරාව මධ්‍ය විද්‍යාලයෙන් සිප් සතර හදාරා අ.පො.ස. උසස් පෙළ විශිෂ්ට ප්‍රතිඵල ලබා ගනිමින් කොළඹ
                        විශ්වවිද්‍යාලයට ඇතුළත් වීමට වරම් ලැබූ ලක්ෂිත තෙන්නකෝන්, ජීව රසායනය හා අනුක ජීව විද්‍යාව පිළිබඳ
                        උපාධිය හදාරමින් සිටි අතර වසර දෙකක් පුරා ගුරු භූමිකාවට පණ පොවූ විට, කට්ටපාඩම් සංස්කෘතියෙන් බැහැර
                        වූ නවීන හා කෙටි ක්‍රම මගින් සාම්ප්‍රදායික ජීව විද්‍යා ගුරුවරුන්ට ඉහළ අභියෝගයක් වෙමිනි.
                    </p>
                    <p>
                        සිය ගුරු භූමිකාව තුළ තමන්ගේ දරු පරම්පරාව වෙත ලබා දිය හැකි දැනුම හුදු පන්ති කාමරයට පමණක් සීමා
                        නොකර ඔවුන්ගේ ජීවිත සාර්ථක කිරීමට අවශ්‍ය මගපෙන්වීම ද සිදු කරන්නේ සාම්ප්‍රදායික අධ්‍යාපන රටාවට
                        අභියෝග කරමින් ය.
                    </p>
                </div>

                <!-- 3 Pillars Cards (5 cols) -->
                <div class="lg:col-span-5 space-y-4">
                    <div
                        class="p-6 rounded-2xl bg-white border border-slate-200/90 shadow-xs hover:shadow-md hover:border-brand-500/40 transition-all fadeInUp">
                        <div class="flex items-start gap-4">
                            <div
                                class="w-10 h-10 rounded-xl bg-brand-50 text-brand-600 flex items-center justify-center shrink-0 font-bold">
                                🎓
                            </div>
                            <div>
                                <h3 class="text-base font-bold text-slate-900 mb-1">විශිෂ්ට අධ්‍යාපන පදනම</h3>
                                <p class="text-xs text-slate-500 leading-relaxed font-semibold">BSc (UG) Biochemistry &
                                    Molecular Biology — University Of Colombo</p>
                            </div>
                        </div>
                    </div>

                    <div
                        class="p-6 rounded-2xl bg-white border border-slate-200/90 shadow-xs hover:shadow-md hover:border-bio-500/40 transition-all fadeInUp">
                        <div class="flex items-start gap-4">
                            <div
                                class="w-10 h-10 rounded-xl bg-bio-50 text-bio-600 flex items-center justify-center shrink-0 font-bold">
                                📈
                            </div>
                            <div>
                                <h3 class="text-base font-bold text-slate-900 mb-1">වසර ගණනාවක පළපුරුද්ද</h3>
                                <p class="text-xs text-slate-500 leading-relaxed font-semibold">2022 සිට දිවයිනේ ඉහළම A
                                    සාමාර්ථයන් නිරන්තරයෙන් නිෂ්පාදනය කිරීම.</p>
                            </div>
                        </div>
                    </div>

                    <div
                        class="p-6 rounded-2xl bg-white border border-slate-200/90 shadow-xs hover:shadow-md hover:border-emerald-500/40 transition-all fadeInUp">
                        <div class="flex items-start gap-4">
                            <div
                                class="w-10 h-10 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center shrink-0 font-bold">
                                💻
                            </div>
                            <div>
                                <h3 class="text-base font-bold text-slate-900 mb-1">නවීන Digital පහසුකම්</h3>
                                <p class="text-xs text-slate-500 leading-relaxed font-semibold">Online පන්ති,
                                    Interactive වීඩියෝ පාඩම්, Digital tutes & model papers.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>

    <!-- COMMUNITY, TELEGRAM & FEEDBACK SECTION -->
    <section class="py-20 bg-slate-50" id="institutes">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <!-- Section Header & Telegram Channels -->
            <div class="flex flex-col md:flex-row md:items-end justify-between gap-6 mb-12">
                <div>
                    <span class="text-xs font-extrabold text-brand-600 uppercase tracking-widest">CONNECT WITH US</span>
                    <h2 class="text-3xl sm:text-4xl font-extrabold text-slate-900 tracking-tight mt-1">
                        Student Feedback & Study Groups
                    </h2>
                </div>

                <!-- Telegram Links -->
                <div class="flex flex-wrap gap-3">
                    <a href="https://t.me/LTbio26" target="_blank" rel="noopener noreferrer"
                        class="inline-flex items-center gap-2.5 px-4 py-3 rounded-xl bg-white hover:bg-slate-100 border border-slate-200 text-slate-800 font-bold text-xs shadow-xs hover:shadow transition-all group">
                        <img src="https://upload.wikimedia.org/wikipedia/commons/8/82/Telegram_logo.svg" alt="Telegram"
                            class="w-5 h-5 group-hover:scale-110 transition-transform" />
                        <span>2026 Biology Revision</span>
                    </a>
                    <a href="https://t.me/LTbio26" target="_blank" rel="noopener noreferrer"
                        class="inline-flex items-center gap-2.5 px-4 py-3 rounded-xl bg-white hover:bg-slate-100 border border-slate-200 text-slate-800 font-bold text-xs shadow-xs hover:shadow transition-all group">
                        <img src="https://upload.wikimedia.org/wikipedia/commons/8/82/Telegram_logo.svg" alt="Telegram"
                            class="w-5 h-5 group-hover:scale-110 transition-transform" />
                        <span>2027 Theory Biology</span>
                    </a>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start mb-16">

                <!-- FEEDBACK FORM (5 cols) -->
                <div class="lg:col-span-5 bg-white p-6 sm:p-8 rounded-2xl border border-slate-200 shadow-sm">
                    <div class="mb-5">
                        <h3 class="text-xl font-black text-slate-900">Submit Your Feedback</h3>
                        <p class="text-xs text-slate-500 mt-1">Share your thoughts, suggestions, or learning experience
                            with us.</p>
                    </div>

                    <!-- Flash Message -->
                    @if (session('success'))
                        <div
                            class="mb-4 p-3.5 rounded-xl bg-emerald-50 border border-emerald-200 text-emerald-800 text-xs font-bold flex items-center gap-2">
                            <svg class="w-4 h-4 text-emerald-600 shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                    clip-rule="evenodd" />
                            </svg>
                            <span>{{ session('success') }}</span>
                        </div>
                    @endif

                    @if (isset($errors) && $errors->any())
                        <div
                            class="mb-4 p-3 rounded-xl bg-rose-50 border border-rose-200 text-rose-800 text-xs font-semibold">
                            <ul class="list-disc list-inside space-y-0.5">
                                @foreach($errors->all() as $err)
                                    <li>{{ $err }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <!-- FORM -->
                    <form action="{{ route('feedbackstore') }}" method="POST" class="space-y-4">
                        @csrf

                        <div>
                            <label for="name"
                                class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1">Your
                                Name</label>
                            <input id="name" type="text" name="name" required placeholder="Kasun Perera"
                                class="w-full px-3.5 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-xs font-medium text-slate-900 focus:bg-white focus:outline-none focus:ring-2 focus:ring-brand-500/20 focus:border-brand-500 transition-all" />
                        </div>

                        <div>
                            <label for="email"
                                class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1">Email
                                Address</label>
                            <input id="email" type="email" name="email" required placeholder="student@example.com"
                                class="w-full px-3.5 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-xs font-medium text-slate-900 focus:bg-white focus:outline-none focus:ring-2 focus:ring-brand-500/20 focus:border-brand-500 transition-all" />
                        </div>

                        <div>
                            <label for="phone_number"
                                class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1">Phone
                                Number</label>
                            <input id="phone_number" type="text" name="phone_number" required placeholder="0712345678"
                                class="w-full px-3.5 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-xs font-medium text-slate-900 focus:bg-white focus:outline-none focus:ring-2 focus:ring-brand-500/20 focus:border-brand-500 transition-all" />
                        </div>

                        <div>
                            <label for="message"
                                class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1">Your
                                Message</label>
                            <textarea id="message" name="message" rows="3" required
                                placeholder="Write your review or question..."
                                class="w-full px-3.5 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-xs font-medium text-slate-900 focus:bg-white focus:outline-none focus:ring-2 focus:ring-brand-500/20 focus:border-brand-500 transition-all resize-none"></textarea>
                        </div>

                        <button type="submit"
                            class="w-full py-3 px-4 rounded-xl bg-gradient-to-r from-brand-600 to-brand-500 hover:from-brand-500 hover:to-brand-600 text-white font-bold text-xs shadow-md shadow-brand-500/25 hover:shadow-brand-500/35 transition-all flex items-center justify-center gap-2">
                            <span>Submit Feedback</span>
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                    d="M14 5l7 7m0 0l-7 7m7-7H3" />
                            </svg>
                        </button>
                    </form>
                </div>

                <!-- PHOTO SHOWCASE CAROUSEL (7 cols) -->
                <div class="lg:col-span-7">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-base font-extrabold text-slate-900">Classroom Moments & Testimonials</h3>
                        <span class="text-xs text-slate-400 font-semibold">Scroll horizontally →</span>
                    </div>

                    <div id="scrollBox"
                        class="flex gap-4 overflow-x-auto pb-4 no-scrollbar snap-x snap-mandatory cursor-grab active:cursor-grabbing">
                        <div
                            class="flex-none w-64 sm:w-72 snap-start rounded-2xl overflow-hidden border border-slate-200 bg-white shadow-xs group">
                            <div class="aspect-[4/5] overflow-hidden bg-slate-100">
                                <img src="{{ asset('images/feed1.jpeg') }}" alt="Student Feedback 1"
                                    class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300" />
                            </div>
                        </div>
                        <div
                            class="flex-none w-64 sm:w-72 snap-start rounded-2xl overflow-hidden border border-slate-200 bg-white shadow-xs group">
                            <div class="aspect-[4/5] overflow-hidden bg-slate-100">
                                <img src="{{ asset('images/feed2.jpeg') }}" alt="Student Feedback 2"
                                    class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300" />
                            </div>
                        </div>
                        <div
                            class="flex-none w-64 sm:w-72 snap-start rounded-2xl overflow-hidden border border-slate-200 bg-white shadow-xs group">
                            <div class="aspect-[4/5] overflow-hidden bg-slate-100">
                                <img src="{{ asset('images/feed3.jpeg') }}" alt="Student Feedback 3"
                                    class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300" />
                            </div>
                        </div>
                        <div
                            class="flex-none w-64 sm:w-72 snap-start rounded-2xl overflow-hidden border border-slate-200 bg-white shadow-xs group">
                            <div class="aspect-[4/5] overflow-hidden bg-slate-100">
                                <img src="{{ asset('images/feed4.jpeg') }}" alt="Student Feedback 4"
                                    class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300" />
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <!-- OUTSTANDING RESULTS METRICS -->
            <div>
                <div class="text-center max-w-xl mx-auto mb-8">
                    <span class="text-xs font-extrabold text-bio-600 uppercase tracking-widest">PROVEN TRACK
                        RECORD</span>
                    <h3 class="text-2xl sm:text-3xl font-extrabold text-slate-900 tracking-tight mt-1">Outstanding
                        Results</h3>
                </div>

                <div class="grid grid-cols-2 md:grid-cols-4 gap-4 sm:gap-6">
                    <div
                        class="p-6 rounded-2xl bg-white border border-slate-200 text-center shadow-xs hover:shadow-md transition-all">
                        <div class="text-3xl sm:text-4xl font-black text-brand-500">4500+</div>
                        <div class="text-xs font-bold text-slate-500 mt-1">A සාමාර්ථ (2015-2023)</div>
                    </div>
                    <div
                        class="p-6 rounded-2xl bg-white border border-slate-200 text-center shadow-xs hover:shadow-md transition-all">
                        <div class="text-3xl sm:text-4xl font-black text-slate-900">837</div>
                        <div class="text-xs font-bold text-slate-500 mt-1">Island Ranks</div>
                    </div>
                    <div
                        class="p-6 rounded-2xl bg-white border border-slate-200 text-center shadow-xs hover:shadow-md transition-all">
                        <div class="text-3xl sm:text-4xl font-black text-bio-600">20+</div>
                        <div class="text-xs font-bold text-slate-500 mt-1">Years Legacy</div>
                    </div>
                    <div
                        class="p-6 rounded-2xl bg-white border border-slate-200 text-center shadow-xs hover:shadow-md transition-all">
                        <div class="text-3xl sm:text-4xl font-black text-slate-900">15+</div>
                        <div class="text-xs font-bold text-slate-500 mt-1">Institute Locations</div>
                    </div>
                </div>
            </div>

        </div>
    </section>

    <!-- GALLERY SECTION -->
    <section class="py-20 bg-white border-t border-slate-200" id="gallery">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="max-w-3xl mb-12">
                <span class="text-xs font-extrabold text-brand-600 uppercase tracking-widest">SEE OUR WORK</span>
                <h2 class="text-3xl sm:text-4xl font-extrabold text-slate-900 tracking-tight mt-1">
                    Activity & Seminar Gallery
                </h2>
                <p class="text-sm text-slate-500 mt-1">Moments from practical workshops, exam seminars, and revision
                    sessions.</p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                <div class="rounded-2xl overflow-hidden border border-slate-200 bg-slate-50 shadow-xs group">
                    <div class="aspect-video sm:aspect-square overflow-hidden bg-slate-200 relative">
                        <img src="{{ asset('images/feed1.jpeg') }}" alt="Gallery Feed 1"
                            class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300" />
                        <div
                            class="absolute inset-0 bg-gradient-to-t from-slate-950/60 to-transparent opacity-0 group-hover:opacity-100 transition-opacity flex items-end p-4">
                            <span class="text-xs font-bold text-white">Seminar Discussion</span>
                        </div>
                    </div>
                    <div class="p-4 bg-white">
                        <h4 class="text-sm font-bold text-slate-900">Revision Seminar</h4>
                        <p class="text-xs text-slate-400 mt-0.5">Comprehensive paper discussions</p>
                    </div>
                </div>

                <div class="rounded-2xl overflow-hidden border border-slate-200 bg-slate-50 shadow-xs group">
                    <div class="aspect-video sm:aspect-square overflow-hidden bg-slate-200 relative">
                        <img src="{{ asset('images/feed2.jpeg') }}" alt="Gallery Feed 2"
                            class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300" />
                        <div
                            class="absolute inset-0 bg-gradient-to-t from-slate-950/60 to-transparent opacity-0 group-hover:opacity-100 transition-opacity flex items-end p-4">
                            <span class="text-xs font-bold text-white">Laboratory Insights</span>
                        </div>
                    </div>
                    <div class="p-4 bg-white">
                        <h4 class="text-sm font-bold text-slate-900">Theory Masterclass</h4>
                        <p class="text-xs text-slate-400 mt-0.5">Biochemistry & cell biology</p>
                    </div>
                </div>

                <div class="rounded-2xl overflow-hidden border border-slate-200 bg-slate-50 shadow-xs group">
                    <div class="aspect-video sm:aspect-square overflow-hidden bg-slate-200 relative">
                        <img src="{{ asset('images/feed3.jpeg') }}" alt="Gallery Feed 3"
                            class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300" />
                        <div
                            class="absolute inset-0 bg-gradient-to-t from-slate-950/60 to-transparent opacity-0 group-hover:opacity-100 transition-opacity flex items-end p-4">
                            <span class="text-xs font-bold text-white">Model Paper Test</span>
                        </div>
                    </div>
                    <div class="p-4 bg-white">
                        <h4 class="text-sm font-bold text-slate-900">Time-Trial Exams</h4>
                        <p class="text-xs text-slate-400 mt-0.5">Simulated exam conditions</p>
                    </div>
                </div>

                <div class="rounded-2xl overflow-hidden border border-slate-200 bg-slate-50 shadow-xs group">
                    <div class="aspect-video sm:aspect-square overflow-hidden bg-slate-200 relative">
                        <img src="{{ asset('images/feed4.jpeg') }}" alt="Gallery Feed 4"
                            class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300" />
                        <div
                            class="absolute inset-0 bg-gradient-to-t from-slate-950/60 to-transparent opacity-0 group-hover:opacity-100 transition-opacity flex items-end p-4">
                            <span class="text-xs font-bold text-white">Interactive Session</span>
                        </div>
                    </div>
                    <div class="p-4 bg-white">
                        <h4 class="text-sm font-bold text-slate-900">Q&A Workshop</h4>
                        <p class="text-xs text-slate-400 mt-0.5">Individual doubt clearance</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- FOOTER -->
    <footer class="bg-slate-950 text-slate-400 pt-16 pb-12 border-t border-slate-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-10 pb-12 border-b border-slate-800/80">

                <!-- Col 1: Instructor Identity -->
                <div class="space-y-4">
                    <div class="flex items-center gap-3">
                        <img src="{{ asset('images/logo1.jpeg') }}" alt="LTbio Logo"
                            class="w-10 h-10 rounded-xl object-cover border border-white/20" />
                        <span class="text-xl font-black text-white">LT<span class="text-brand-500">bio</span><span
                                class="text-bio-500 text-xs font-bold ml-1">.lk</span></span>
                    </div>
                    <p class="text-xs leading-relaxed text-slate-400 font-medium">
                        Lakshitha Thennakoon — BSc (UG) Biochemistry & Molecular Biology, University Of Colombo.
                        Advanced Level Biology education reimagined for maximum student achievement.
                    </p>
                </div>

                <!-- Col 2: Quick Links -->
                <div>
                    <h4 class="text-xs font-bold uppercase tracking-widest text-white mb-4">Quick Links</h4>
                    <ul class="space-y-2.5 text-xs font-semibold">
                        <li><a href="#home" class="hover:text-brand-400 transition-colors">Home</a></li>
                        <li><a href="#about" class="hover:text-brand-400 transition-colors">About Instructor</a></li>
                        <li><a href="#institutes" class="hover:text-brand-400 transition-colors">Feedback & Groups</a>
                        </li>
                        <li><a href="#gallery" class="hover:text-brand-400 transition-colors">Activity Gallery</a></li>
                        <li><a href="{{ route('buyclass') }}" class="hover:text-brand-400 transition-colors">Course
                                Packages</a></li>
                    </ul>
                </div>

                <!-- Col 3: Contact Details -->
                <div>
                    <h4 class="text-xs font-bold uppercase tracking-widest text-white mb-4">Contact Info</h4>
                    <ul class="space-y-2.5 text-xs font-medium">
                        <li class="flex items-center gap-2">
                            <span>📞</span>
                            <a href="tel:+94742877640" class="hover:text-white transition-colors">+94 74 287 7640</a>
                        </li>
                        <li class="flex items-center gap-2">
                            <span>✉️</span>
                            <a href="mailto:info@ltbio.edu.lk"
                                class="hover:text-white transition-colors">info@ltbio.edu.lk</a>
                        </li>
                        <li class="flex items-center gap-2">
                            <span>🌐</span>
                            <span class="text-slate-300">www.ltbio.edu.lk</span>
                        </li>
                    </ul>
                </div>

                <!-- Col 4: Community & Social Links -->
                <div>
                    <h4 class="text-xs font-bold uppercase tracking-widest text-white mb-4">Follow Us</h4>
                    <div class="flex flex-wrap gap-2 text-xs font-semibold">
                        <a href="https://t.me/LTbio26" target="_blank" rel="noopener noreferrer"
                            class="px-3 py-1.5 rounded-lg bg-slate-900 hover:bg-brand-600 hover:text-white text-slate-300 transition-colors">Telegram</a>
                        <a href="https://wa.me/94742877640" target="_blank" rel="noopener noreferrer"
                            class="px-3 py-1.5 rounded-lg bg-slate-900 hover:bg-emerald-600 hover:text-white text-slate-300 transition-colors">WhatsApp</a>
                        <a href="https://www.facebook.com" target="_blank" rel="noopener noreferrer"
                            class="px-3 py-1.5 rounded-lg bg-slate-900 hover:bg-blue-600 hover:text-white text-slate-300 transition-colors">Facebook</a>
                        <a href="https://www.youtube.com" target="_blank" rel="noopener noreferrer"
                            class="px-3 py-1.5 rounded-lg bg-slate-900 hover:bg-red-600 hover:text-white text-slate-300 transition-colors">YouTube</a>
                    </div>
                </div>

            </div>

            <!-- Bottom Copyright & Credit -->
            <div class="pt-8 flex flex-col sm:flex-row items-center justify-between gap-4 text-xs text-slate-500">
                <p>&copy; {{ date('Y') }} ltbio.edu.lk - All Rights Reserved.</p>
                <p>
                    Designed with
                    <a href="https://www.facebook.com/sachintha.bandara.9277/" target="_blank" rel="noopener noreferrer"
                        class="text-slate-400 hover:text-white underline underline-offset-2">
                        Pramuditha Bandara
                    </a>
                </p>
            </div>
        </div>
    </footer>

    <!-- FLOATING WHATSAPP BUTTON -->
    <a href="https://wa.me/94742877640" target="_blank" rel="noopener noreferrer" aria-label="Chat on WhatsApp"
        class="fixed right-6 bottom-6 z-40 w-14 h-14 rounded-full bg-emerald-500 hover:bg-emerald-600 text-white shadow-xl shadow-emerald-500/30 flex items-center justify-center border-2 border-white hover:scale-105 active:scale-95 transition-transform duration-200">
        <svg class="w-7 h-7" viewBox="0 0 24 24" fill="none" aria-hidden="true">
            <path d="M21.8 4.2a11.9 11.9 0 0 0-17 0 11.9 11.9 0 0 0 0 17L2 22l3-2.1A11.9 11.9 0 0 0 21.8 4.2z"
                fill="white" />
            <path
                d="M17 14.2c-.5 1.4-2 2.5-3.1 2.7-.9.2-1.5.3-4.1-1.1-3.2-1.9-5.2-6.6-2.4-9.6 1.8-1.9 4.5-1.5 5.2-1.4.8.2 2 .6 2.9 1.6.8.9 1.2 1.9 1.3 2.6.1.6-.1 1.6-.8 2.2z"
                fill="#22c55e" />
        </svg>
    </a>

    <!-- CLIENT INTERACTIVITY JAVASCRIPT -->
    <script>
        // Reveal on scroll (IntersectionObserver)
        (function () {
            const observer = new IntersectionObserver((entries, obs) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('in-view');
                        obs.unobserve(entry.target);
                    }
                });
            }, { threshold: 0.1 });

            document.querySelectorAll('.fadeInUp').forEach(el => observer.observe(el));
        })();

        // Mobile Nav Drawer Toggle
        (function () {
            const toggle = document.getElementById('navToggle');
            const menu = document.getElementById('mobileMenu');
            const iconOpen = document.getElementById('navIconOpen');
            const iconClose = document.getElementById('navIconClose');

            if (!toggle || !menu) return;

            toggle.addEventListener('click', () => {
                const isOpen = !menu.classList.contains('hidden');
                if (isOpen) {
                    menu.classList.add('hidden');
                    iconOpen.classList.remove('hidden');
                    iconClose.classList.add('hidden');
                } else {
                    menu.classList.remove('hidden');
                    iconOpen.classList.add('hidden');
                    iconClose.classList.remove('hidden');
                }
            });

            // Close when clicking link
            document.querySelectorAll('.mobile-nav-link').forEach(link => {
                link.addEventListener('click', () => {
                    menu.classList.add('hidden');
                    iconOpen.classList.remove('hidden');
                    iconClose.classList.add('hidden');
                });
            });
        })();

        // 3D Hero Card Tilt Effect
        (function () {
            const card = document.getElementById('heroImageCard');
            if (!card) return;

            function onMove(e) {
                const rect = card.getBoundingClientRect();
                const cx = rect.left + rect.width / 2;
                const cy = rect.top + rect.height / 2;
                const clientX = e.clientX || (e.touches && e.touches[0].clientX);
                const clientY = e.clientY || (e.touches && e.touches[0].clientY);
                if (!clientX || !clientY) return;

                const rx = ((clientY - cy) / rect.height) * -10;
                const ry = ((clientX - cx) / rect.width) * 12;

                card.style.transform = `rotateX(${rx}deg) rotateY(${ry}deg) translateZ(10px)`;
            }

            function reset() {
                card.style.transform = 'rotateX(0deg) rotateY(0deg) translateZ(0px)';
            }

            card.addEventListener('mousemove', onMove);
            card.addEventListener('mouseleave', reset);
            card.addEventListener('touchmove', onMove, { passive: true });
            card.addEventListener('touchend', reset);
        })();

        // Horizontal Drag to Scroll for Showcase
        (function () {
            const box = document.getElementById('scrollBox');
            if (!box) return;

            let isDown = false;
            let startX, scrollLeft;

            box.addEventListener('mousedown', (e) => {
                isDown = true;
                startX = e.pageX - box.offsetLeft;
                scrollLeft = box.scrollLeft;
            });
            window.addEventListener('mouseup', () => isDown = false);
            box.addEventListener('mousemove', (e) => {
                if (!isDown) return;
                e.preventDefault();
                const x = e.pageX - box.offsetLeft;
                const walk = (x - startX) * 1.5;
                box.scrollLeft = scrollLeft - walk;
            });
        })();
    </script>

</body>

</html>