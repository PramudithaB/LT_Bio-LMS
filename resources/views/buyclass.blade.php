<!DOCTYPE html>
<html lang="en" class="h-full bg-slate-50">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Buy Class Packages - LTbio LMS</title>
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

<body class="min-h-full flex flex-col font-sans text-slate-800 bg-slate-50 antialiased selection:bg-brand-500 selection:text-white"
      x-data="{ toast: false, toastMsg: '' }">

    <!-- Top Navigation Component -->
    <x-lms-navbar />

    <!-- Toast Notification -->
    <div x-show="toast"
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0 translate-y-2"
         x-transition:enter-end="opacity-100 translate-y-0"
         x-transition:leave="transition ease-in duration-150"
         x-transition:leave-start="opacity-100 translate-y-0"
         x-transition:leave-end="opacity-0 translate-y-2"
         style="display: none;"
         class="fixed bottom-6 right-6 z-50 bg-slate-900 text-white px-5 py-3 rounded-2xl shadow-2xl flex items-center gap-3 border border-slate-700">
        <div class="w-7 h-7 rounded-full bg-emerald-500/20 text-emerald-400 flex items-center justify-center flex-shrink-0">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
        </div>
        <span class="text-sm font-semibold" x-text="toastMsg"></span>
        <a href="{{ route('cart.view') }}" class="ml-2 text-xs font-bold text-brand-400 hover:text-brand-300 underline">View Cart</a>
    </div>

    <!-- Main Content -->
    <main class="flex-grow max-w-7xl mx-auto w-full px-4 sm:px-6 lg:px-8 py-8 space-y-8">

        <!-- Page Header -->
        <div class="text-center max-w-3xl mx-auto space-y-3 pt-4">
            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-brand-500/10 text-brand-600 text-xs font-bold uppercase tracking-wider">
                Enrollment & Fees
            </div>
            <h1 class="text-3xl sm:text-4xl font-extrabold text-slate-900 tracking-tight">
                Choose Your Biology Class Package
            </h1>
            <p class="text-slate-500 text-sm sm:text-base leading-relaxed">
                Select your required Theory, Revision, or Paper Class packages below. Add them to your cart and submit the payment slip for activation.
            </p>
        </div>

        <!-- Special Fee Notice Card -->
        <div class="max-w-4xl mx-auto p-4 sm:p-5 rounded-2xl bg-amber-50 border border-amber-200 text-amber-900 shadow-xs flex items-center gap-4">
            <div class="w-10 h-10 rounded-xl bg-amber-100 text-amber-700 flex items-center justify-center flex-shrink-0">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>
            <div class="text-xs sm:text-sm leading-relaxed">
                <strong class="font-bold">විශේෂ දැනුම්දීම:</strong> 2026 Revision හා Paper Class දෙකටම මුදල් ගෙවීමේදී 5,600 මුදලක් පෙන්වූවද 5,000 ක මුදලක් පමනක් බැර කරන්න.
            </div>
        </div>

        <!-- Packages Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 pt-4">
            @forelse($packages as $pkg)
                <div class="group flex flex-col bg-white rounded-3xl border border-slate-200/80 shadow-xs hover:shadow-xl hover:border-brand-500/30 transition-all duration-200 overflow-hidden justify-between">
                    
                    <div>
                        <!-- Header Banner -->
                        <div class="p-6 bg-gradient-to-br from-slate-900 via-slate-800 to-slate-900 text-white">
                            <div class="flex items-center justify-between gap-2 mb-2">
                                <span class="px-2.5 py-0.5 rounded-md text-[10px] font-extrabold uppercase tracking-wider bg-brand-500 text-white">
                                    Monthly Package
                                </span>
                                <span class="text-xs text-slate-400 font-medium">A/L Biology</span>
                            </div>

                            <h2 class="text-xl font-bold text-white group-hover:text-brand-400 transition">
                                {{ $pkg->package_name }}
                            </h2>

                            <div class="mt-4 flex items-baseline gap-1">
                                <span class="text-3xl sm:text-4xl font-black text-white tracking-tight">
                                    Rs. {{ number_format($pkg->monthly_fee) }}
                                </span>
                                <span class="text-xs font-semibold text-slate-400">/ month</span>
                            </div>
                        </div>

                        <!-- Package Perks / Description -->
                        <div class="p-6 space-y-4">
                            @if($pkg->description)
                                <p class="text-xs text-slate-600 leading-relaxed">
                                    {{ $pkg->description }}
                                </p>
                            @endif

                            <div class="space-y-2.5 pt-2 text-xs text-slate-700">
                                <div class="flex items-center gap-2.5">
                                    <svg class="w-4 h-4 text-emerald-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                    <span>High-Definition YouTube Video Lectures</span>
                                </div>
                                <div class="flex items-center gap-2.5">
                                    <svg class="w-4 h-4 text-emerald-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                    <span>Downloadable PDF Lesson Tutes & Worksheets</span>
                                </div>
                                <div class="flex items-center gap-2.5">
                                    <svg class="w-4 h-4 text-emerald-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                    <span>Full Month Unlimited Streaming Access</span>
                                </div>
                                <div class="flex items-center gap-2.5">
                                    <svg class="w-4 h-4 text-emerald-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                    <span>Lakshitha Thennakoon Direct Discussion</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Card CTA -->
                    <div class="p-6 pt-0">
                        <button type="button"
                                onclick="handleAddToCart({{ $pkg->class_id ?? $pkg->id }}, '{{ addslashes($pkg->package_name) }}', {{ $pkg->monthly_fee }})"
                                class="w-full flex items-center justify-center gap-2 py-3 px-4 rounded-xl font-bold text-sm text-white bg-brand-500 hover:bg-brand-600 active:scale-[0.99] shadow-xs transition duration-150">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                            <span>Add to Cart</span>
                        </button>
                    </div>

                </div>
            @empty
                <div class="col-span-full bg-white rounded-3xl border border-slate-200/80 p-12 text-center max-w-md mx-auto shadow-xs">
                    <p class="text-slate-500 text-sm">No course packages are currently published. Please check back soon.</p>
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

    <!-- Cart Storage Logic -->
    <script>
        function handleAddToCart(id, name, price) {
            let cart = JSON.parse(localStorage.getItem("cart")) || [];
            const exists = cart.find(item => item.id === id);

            if (!exists) {
                cart.push({ id, name, price });
                localStorage.setItem("cart", JSON.stringify(cart));
            }

            // Fire event so navbar updates count immediately
            window.dispatchEvent(new Event('cart-updated'));

            // Show Alpine toast
            const bodyEl = document.querySelector('body');
            if (bodyEl && window.Alpine) {
                const alpineData = Alpine.$data(bodyEl);
                if (alpineData) {
                    alpineData.toastMsg = `"${name}" added to cart!`;
                    alpineData.toast = true;
                    setTimeout(() => { alpineData.toast = false; }, 3500);
                }
            }
        }
    </script>

</body>
</html>
