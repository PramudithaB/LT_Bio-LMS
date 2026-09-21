@props([
    'title' => null,
])

<nav x-data="{ mobileOpen: false, profileOpen: false, cartCount: 0 }"
     x-init="
        const syncCart = () => {
            try {
                const c = JSON.parse(localStorage.getItem('cart')) || [];
                cartCount = c.length;
            } catch(e) { cartCount = 0; }
        };
        syncCart();
        window.addEventListener('storage', syncCart);
        window.addEventListener('cart-updated', syncCart);
     "
     class="sticky top-0 z-40 bg-white/95 backdrop-blur-md border-b border-slate-200/80 shadow-xs">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16 sm:h-18">
            
            <!-- Brand / Logo -->
            <div class="flex items-center gap-6">
                <a href="{{ route('dashboard') }}" class="flex items-center gap-3 group">
                    <img src="{{ asset('images/logo1.jpeg') }}" 
                         alt="LTbio Logo" 
                         class="w-10 h-10 rounded-xl object-cover ring-2 ring-brand-500/20 group-hover:ring-brand-500/50 transition duration-200 shadow-xs">
                    <div class="flex flex-col">
                        <span class="text-xl font-extrabold tracking-tight text-slate-900 group-hover:text-brand-500 transition duration-200">
                            LT<span class="text-brand-500">bio</span>
                        </span>
                        <span class="text-[10px] uppercase tracking-wider font-semibold text-slate-400 -mt-1 hidden sm:block">
                            Online LMS
                        </span>
                    </div>
                </a>

                <!-- Desktop Nav Links -->
                <div class="hidden md:flex items-center space-x-1 pl-4 border-l border-slate-200">
                    <a href="{{ route('dashboard') }}"
                       class="px-3.5 py-2 rounded-lg text-sm font-semibold transition duration-150 flex items-center gap-2 {{ request()->routeIs('dashboard') ? 'text-brand-500 bg-brand-50/70 font-bold' : 'text-slate-600 hover:text-slate-900 hover:bg-slate-100/70' }}">
                        <svg class="w-4 h-4 {{ request()->routeIs('dashboard') ? 'text-brand-500' : 'text-slate-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                        </svg>
                        Dashboard
                    </a>

                    <a href="{{ route('buyclass') }}"
                       class="px-3.5 py-2 rounded-lg text-sm font-semibold transition duration-150 flex items-center gap-2 {{ request()->routeIs('buyclass') ? 'text-brand-500 bg-brand-50/70 font-bold' : 'text-slate-600 hover:text-slate-900 hover:bg-slate-100/70' }}">
                        <svg class="w-4 h-4 {{ request()->routeIs('buyclass') ? 'text-brand-500' : 'text-slate-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                        </svg>
                        Course Catalog
                    </a>

                    @auth
                        @if(Auth::user()->usertype === 'admin')
                            <a href="{{ route('admindashboard') }}"
                               class="px-3.5 py-2 rounded-lg text-sm font-semibold text-purple-700 bg-purple-50 hover:bg-purple-100 transition duration-150 flex items-center gap-2">
                                <svg class="w-4 h-4 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                                Admin Panel
                            </a>
                        @endif
                    @endauth
                </div>
            </div>

            <!-- Right Actions: Cart, User Profile, Mobile Hamburger -->
            <div class="flex items-center gap-3 sm:gap-4">

                <!-- Cart Button -->
                <a href="{{ route('cart.view') }}"
                   class="relative p-2.5 rounded-xl text-slate-600 hover:text-brand-500 hover:bg-slate-100/80 transition duration-150 group"
                   title="View Cart">
                    <svg class="w-5 h-5 text-slate-600 group-hover:text-brand-500 transition duration-150" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                    <span x-show="cartCount > 0"
                          x-text="cartCount"
                          style="display: none;"
                          class="absolute -top-1 -right-1 bg-brand-500 text-white text-[11px] font-extrabold w-5 h-5 rounded-full flex items-center justify-center ring-2 ring-white shadow-xs">
                    </span>
                </a>

                @auth
                    <!-- Profile Menu Dropdown (Desktop & Tablet) -->
                    <div class="relative">
                        <button @click="profileOpen = !profileOpen"
                                @click.outside="profileOpen = false"
                                type="button"
                                class="flex items-center gap-2.5 p-1.5 rounded-xl hover:bg-slate-100/80 transition duration-150 focus:outline-none ring-1 ring-transparent focus:ring-brand-500/30">
                            
                            <!-- Avatar / Initials -->
                            @php
                                $names = explode(' ', Auth::user()->name);
                                $initials = strtoupper(substr($names[0] ?? 'U', 0, 1) . substr($names[1] ?? '', 0, 1));
                            @endphp
                            <div class="w-9 h-9 rounded-xl bg-gradient-to-tr from-brand-600 to-brand-400 text-white font-bold text-xs flex items-center justify-center shadow-xs">
                                {{ $initials }}
                            </div>

                            <div class="hidden lg:flex flex-col text-left">
                                <span class="text-xs font-semibold text-slate-800 leading-tight truncate max-w-[120px]">
                                    {{ Auth::user()->name }}
                                </span>
                                <span class="text-[10px] text-slate-400 uppercase tracking-wider font-medium">
                                    {{ Auth::user()->usertype ?? 'Student' }}
                                </span>
                            </div>

                            <svg class="w-4 h-4 text-slate-400 hidden sm:block transition-transform duration-200"
                                 :class="{ 'rotate-180': profileOpen }"
                                 fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>

                        <!-- Dropdown Menu -->
                        <div x-show="profileOpen"
                             x-transition:enter="transition ease-out duration-150"
                             x-transition:enter-start="opacity-0 scale-95"
                             x-transition:enter-end="opacity-100 scale-100"
                             x-transition:leave="transition ease-in duration-100"
                             x-transition:leave-start="opacity-100 scale-100"
                             x-transition:leave-end="opacity-0 scale-95"
                             style="display: none;"
                             class="absolute right-0 mt-2 w-56 rounded-2xl bg-white border border-slate-100 shadow-xl py-2 z-50 divide-y divide-slate-100">
                            
                            <div class="px-4 py-2.5">
                                <p class="text-xs font-medium text-slate-400">Signed in as</p>
                                <p class="text-sm font-bold text-slate-800 truncate">{{ Auth::user()->name }}</p>
                                <p class="text-xs text-slate-500 truncate mt-0.5">{{ Auth::user()->email }}</p>
                            </div>

                            <div class="py-1">
                                <a href="{{ route('profile.edit') }}"
                                   class="flex items-center gap-2.5 px-4 py-2 text-sm text-slate-700 hover:text-brand-500 hover:bg-brand-50/50 transition">
                                    <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                    Account Settings
                                </a>

                                <a href="{{ route('dashboard') }}"
                                   class="flex items-center gap-2.5 px-4 py-2 text-sm text-slate-700 hover:text-brand-500 hover:bg-brand-50/50 transition">
                                    <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                    </svg>
                                    My Enrolled Classes
                                </a>
                            </div>

                            <div class="py-1">
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit"
                                            class="w-full flex items-center gap-2.5 px-4 py-2 text-sm text-red-600 hover:bg-red-50 transition text-left">
                                        <svg class="w-4 h-4 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                        </svg>
                                        Log Out
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="flex items-center gap-2">
                        <a href="{{ route('login') }}" class="px-4 py-2 text-sm font-semibold text-slate-700 hover:text-brand-500 transition">
                            Log In
                        </a>
                        <a href="{{ route('register') }}" class="px-4 py-2 text-sm font-semibold text-white bg-brand-500 hover:bg-brand-600 rounded-xl shadow-xs transition">
                            Register
                        </a>
                    </div>
                @endauth

                <!-- Mobile Hamburger Button -->
                <button @click="mobileOpen = !mobileOpen"
                        type="button"
                        class="md:hidden p-2 rounded-xl text-slate-600 hover:text-slate-900 hover:bg-slate-100 transition"
                        aria-label="Toggle navigation">
                    <svg x-show="!mobileOpen" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                    <svg x-show="mobileOpen" style="display: none;" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile Drawer -->
    <div x-show="mobileOpen"
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0 -translate-y-2"
         x-transition:enter-end="opacity-100 translate-y-0"
         x-transition:leave="transition ease-in duration-150"
         x-transition:leave-start="opacity-100 translate-y-0"
         x-transition:leave-end="opacity-0 -translate-y-2"
         style="display: none;"
         class="md:hidden bg-white border-b border-slate-200 px-4 pt-2 pb-4 space-y-2 shadow-lg">
        
        <a href="{{ route('dashboard') }}"
           class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-base font-semibold {{ request()->routeIs('dashboard') ? 'text-brand-500 bg-brand-50/80 font-bold' : 'text-slate-700 hover:bg-slate-50' }}">
            <svg class="w-5 h-5 {{ request()->routeIs('dashboard') ? 'text-brand-500' : 'text-slate-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
            </svg>
            Dashboard
        </a>

        <a href="{{ route('buyclass') }}"
           class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-base font-semibold {{ request()->routeIs('buyclass') ? 'text-brand-500 bg-brand-50/80 font-bold' : 'text-slate-700 hover:bg-slate-50' }}">
            <svg class="w-5 h-5 {{ request()->routeIs('buyclass') ? 'text-brand-500' : 'text-slate-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
            </svg>
            Course Catalog
        </a>

        <a href="{{ route('cart.view') }}"
           class="flex items-center justify-between px-3 py-2.5 rounded-xl text-base font-semibold text-slate-700 hover:bg-slate-50">
            <div class="flex items-center gap-3">
                <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                </svg>
                Shopping Cart
            </div>
            <span x-show="cartCount > 0" x-text="cartCount" class="bg-brand-500 text-white text-xs font-bold px-2 py-0.5 rounded-full"></span>
        </a>

        @auth
            <div class="pt-2 border-t border-slate-100 space-y-1">
                <a href="{{ route('profile.edit') }}" class="flex items-center gap-3 px-3 py-2 rounded-xl text-sm font-medium text-slate-600 hover:bg-slate-50">
                    <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                    My Profile
                </a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full flex items-center gap-3 px-3 py-2 rounded-xl text-sm font-medium text-red-600 hover:bg-red-50 text-left">
                        <svg class="w-5 h-5 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                        </svg>
                        Log Out
                    </button>
                </form>
            </div>
        @endauth
    </div>
</nav>
