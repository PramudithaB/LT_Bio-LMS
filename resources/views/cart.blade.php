<!DOCTYPE html>
<html lang="en" class="h-full bg-slate-50">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Your Shopping Cart - LTbio LMS</title>
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
            <a href="{{ route('dashboard') }}" class="hover:text-brand-500 transition">Dashboard</a>
            <svg class="w-3.5 h-3.5 text-slate-300" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
            </svg>
            <a href="{{ route('buyclass') }}" class="hover:text-brand-500 transition">Course Packages</a>
            <svg class="w-3.5 h-3.5 text-slate-300" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
            </svg>
            <span class="text-slate-800 font-semibold">Shopping Cart</span>
        </nav>

        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 border-b border-slate-200 pb-4">
            <div>
                <h1 class="text-2xl sm:text-3xl font-extrabold text-slate-900 tracking-tight flex items-center gap-2.5">
                    <span class="w-2.5 h-6 rounded-full bg-brand-500 inline-block"></span>
                    Your Shopping Cart
                </h1>
                <p class="text-sm text-slate-500 mt-0.5">Review the classes you wish to enroll in before proceeding to payment checkout</p>
            </div>

            <a href="{{ route('buyclass') }}"
               class="inline-flex items-center gap-2 text-xs sm:text-sm font-semibold text-brand-600 hover:text-brand-700 bg-brand-50 hover:bg-brand-100 px-4 py-2 rounded-xl transition self-start sm:self-auto">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                Add More Classes
            </a>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 items-start">
            
            <!-- LEFT: Items List (Col Span 2) -->
            <div class="lg:col-span-2 space-y-4">
                <div id="cart-items" class="space-y-4"></div>

                <!-- Empty State -->
                <div id="empty-cart-message" style="display: none;" class="bg-white rounded-3xl border border-slate-200/80 p-12 text-center shadow-xs">
                    <div class="w-16 h-16 rounded-2xl bg-brand-50 text-brand-500 flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-slate-900 mb-1">Your cart is empty</h3>
                    <p class="text-slate-500 text-sm mb-6">You haven't added any class packages to your cart yet.</p>
                    <a href="{{ route('buyclass') }}"
                       class="inline-flex items-center gap-2 px-6 py-3 rounded-xl bg-brand-500 hover:bg-brand-600 text-white font-bold text-sm shadow-xs transition">
                        Browse Available Classes
                    </a>
                </div>
            </div>

            <!-- RIGHT: Order Summary Card (Col Span 1) -->
            <div id="order-summary-sidebar" class="bg-white rounded-3xl border border-slate-200/80 p-6 sm:p-8 shadow-xs space-y-6">
                <h2 class="text-lg font-bold text-slate-900 pb-3 border-b border-slate-100">
                    Order Summary
                </h2>

                <div class="space-y-3 text-sm">
                    <div class="flex justify-between text-slate-500">
                        <span>Selected Items</span>
                        <span id="summary-count" class="font-semibold text-slate-700">0</span>
                    </div>

                    <div class="flex justify-between text-slate-500">
                        <span>Class Enrollment Fee</span>
                        <span id="summary-subtotal" class="font-semibold text-slate-700">Rs. 0</span>
                    </div>

                    <div class="pt-3 border-t border-slate-100 flex justify-between items-baseline">
                        <span class="text-base font-bold text-slate-900">Total Payable</span>
                        <span id="summary-total" class="text-2xl font-black text-brand-600">Rs. 0</span>
                    </div>
                </div>

                <!-- Special Discount Notice -->
                <div class="p-3.5 rounded-2xl bg-amber-50 border border-amber-200/80 text-amber-900 text-xs leading-relaxed">
                    <strong class="font-bold">විශේෂ දැනුම්දීම:</strong> 2026 Revision හා Paper Class දෙකටම මුදල් ගෙවීමේදී 5600 මුදලක් පෙන්වූවද 5000 පමනක් බැර කරන්න.
                </div>

                <!-- Checkout CTA -->
                <a href="{{ route('checkout.page') }}"
                   id="checkout-btn"
                   class="w-full flex items-center justify-center gap-2 py-3.5 px-4 rounded-xl font-bold text-sm text-white bg-brand-500 hover:bg-brand-600 active:scale-[0.99] shadow-md shadow-brand-500/20 transition duration-150">
                    <span>Proceed to Checkout</span>
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                    </svg>
                </a>

                <div class="text-center">
                    <button onclick="clearAllCart()" class="text-xs text-slate-400 hover:text-red-500 underline transition">
                        Clear All Items
                    </button>
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

    <!-- Cart Rendering Script -->
    <script>
        let cart = JSON.parse(localStorage.getItem("cart")) || [];
        const container = document.getElementById("cart-items");
        const emptyMsg = document.getElementById("empty-cart-message");
        const sidebar = document.getElementById("order-summary-sidebar");
        const checkoutBtn = document.getElementById("checkout-btn");

        function renderCart() {
            container.innerHTML = "";
            let total = 0;

            if (cart.length === 0) {
                emptyMsg.style.display = "block";
                sidebar.style.opacity = "0.5";
                checkoutBtn.classList.add("pointer-events-none", "opacity-50");
                document.getElementById("summary-count").textContent = "0";
                document.getElementById("summary-subtotal").textContent = "Rs. 0";
                document.getElementById("summary-total").textContent = "Rs. 0";
                return;
            }

            emptyMsg.style.display = "none";
            sidebar.style.opacity = "1";
            checkoutBtn.classList.remove("pointer-events-none", "opacity-50");

            cart.forEach(item => {
                const card = document.createElement("div");
                card.className = "bg-white p-5 sm:p-6 rounded-3xl border border-slate-200/80 shadow-xs flex flex-col sm:flex-row sm:items-center justify-between gap-4 transition hover:shadow-md";
                card.innerHTML = `
                    <div class="flex items-start gap-4">
                        <div class="w-12 h-12 rounded-2xl bg-brand-50 text-brand-500 flex items-center justify-center flex-shrink-0">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                            </svg>
                        </div>
                        <div>
                            <span class="text-[10px] font-extrabold uppercase tracking-wider text-brand-500 bg-brand-50 px-2 py-0.5 rounded-md">Course Package</span>
                            <h3 class="text-base sm:text-lg font-bold text-slate-900 mt-1">${item.name}</h3>
                            <p class="text-xs text-slate-500">Monthly access to all class modules and study materials</p>
                        </div>
                    </div>

                    <div class="flex items-center justify-between sm:justify-end gap-6 pt-3 sm:pt-0 border-t sm:border-t-0 border-slate-100">
                        <div class="text-left sm:text-right">
                            <p class="text-xs text-slate-400 font-medium">Monthly Fee</p>
                            <p class="text-lg font-black text-slate-900">Rs. ${Number(item.price).toLocaleString()}</p>
                        </div>
                        <button onclick="removeItem(${item.id})"
                                class="p-2.5 rounded-xl text-slate-400 hover:text-red-600 hover:bg-red-50 border border-slate-200 hover:border-red-200 transition"
                                title="Remove Item">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                            </svg>
                        </button>
                    </div>
                `;
                container.appendChild(card);
                total += Number(item.price);
            });

            document.getElementById("summary-count").textContent = cart.length;
            document.getElementById("summary-subtotal").textContent = "Rs. " + total.toLocaleString();
            document.getElementById("summary-total").textContent = "Rs. " + total.toLocaleString();
        }

        function removeItem(id) {
            cart = cart.filter(i => i.id !== id);
            localStorage.setItem("cart", JSON.stringify(cart));
            window.dispatchEvent(new Event('cart-updated'));
            renderCart();
        }

        function clearAllCart() {
            if (confirm("Are you sure you want to remove all items from your cart?")) {
                localStorage.removeItem("cart");
                cart = [];
                window.dispatchEvent(new Event('cart-updated'));
                renderCart();
            }
        }

        renderCart();
    </script>

</body>
</html>
