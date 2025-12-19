<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buy Class</title>

    <!-- Tailwind -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Icons -->
    <script src="https://unpkg.com/lucide@latest"></script>

    <!-- Tailwind Config -->
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'primary-purple': '#ff0000',
                        'dark-purple': '#cc0000',
                        'light-purple': '#ffe5e5',
                        'accent-yellow': '#facc15',
                    }
                }
            }
        }
    </script>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;800&display=swap');
        body {
            font-family: "Inter", sans-serif;
            background-color: #f3f4f6;
        }
    </style>
    <style>
.scale-125 {
    transform: scale(1.25);
    transition: transform 0.3s ease;
}
</style>

</head>

<body class="antialiased">

    <!-- 🔥 SAME NAV BAR -->
    <nav class="bg-white shadow-md sticky top-0 z-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">

                <!-- Brand -->
               <div class="flex items-center gap-3">
                    <span class="text-2xl font-extrabold text-primary-purple tracking-tighter">LTbio</span>
                    <span class="text-xs font-light text-gray-600 hidden sm:block">Online Education</span>
                </div>

                <!-- Menu -->
                <div class="hidden sm:flex items-center space-x-6 text-gray-700 font-medium">
                    <a href="{{ route('dashboard') }}" class="hover:text-primary-purple flex items-center">
                        <i data-lucide="layout-dashboard" class="w-5 h-5 mr-1"></i> Dashboard
                    </a>

                    <a href="{{ route('buyclass') }}" class="text-primary-purple font-semibold flex items-center">
                        <i data-lucide="book-open-text" class="w-5 h-5 mr-1"></i> Buy Class
                    </a>

               
                    <!-- Cart Icon -->
<a href="{{ route('cart.view') }}" class="relative">
    <i data-lucide="shopping-cart" class="w-7 h-7 text-gray-600 hover:text-primary-purple"></i>

    <span id="cart-count"
        class="absolute -top-2 -right-2 bg-primary-purple text-white text-xs font-bold w-5 h-5 flex items-center justify-center rounded-full">
        0
    </span>
</a>

                </div>

                <!-- Right section -->
                <div class="flex items-center space-x-4">

                    <button class="text-gray-500 hover:text-primary-purple">
                        <i data-lucide="bell" class="w-6 h-6"></i>
                    </button>

                    <!-- Mobile Cart Icon (visible only on small screens) -->
                    <a href="{{ route('cart.view') }}" class="sm:hidden inline-flex items-center mr-2 mobile-cart z-50">
                        <i data-lucide="shopping-cart" class="w-6 h-6 text-gray-600 hover:text-primary-purple"></i>
                        <span id="cart-count-mobile" class="ml-2 bg-primary-purple text-white text-xs font-bold w-5 h-5 flex items-center justify-center rounded-full">0</span>
                    </a>

                    <!-- Profile -->
                    <div class="relative">
                        <button id="profile-menu-button"
                            class="flex items-center space-x-2 border-l pl-4 p-2 rounded-lg hover:bg-gray-50">
                            
                            <span class="font-medium text-sm text-gray-700 hidden sm:block">
                                {{ Auth::user()->name }}
                            </span>

                            <div
                                class="w-10 h-10 bg-primary-purple rounded-full flex items-center justify-center text-white font-bold">
                                JD
                            </div>

                            <i data-lucide="chevron-down" class="w-4 h-4 text-gray-400"></i>
                        </button>

                        <div id="profile-dropdown"
                            class="absolute right-0 mt-3 w-48 bg-white border rounded-lg shadow-lg py-1 hidden">

                            <a href="{{ route('profile.edit') }}"
                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                Profile
                            </a>

                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <a href="{{ route('logout') }}"
                                   onclick="event.preventDefault(); this.closest('form').submit();"
                                   class="block px-4 py-2 text-sm text-red-600 hover:bg-red-50">
                                   Log Out
                                </a>
                            </form>

                        </div>
                    </div>

                </div>

            </div>
        </div>
    </nav>

    <!-- MAIN CONTENT -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">

        <h1 class="text-3xl font-bold text-gray-900 mb-6 flex items-center">
            <i data-lucide="shopping-cart" class="w-7 h-7 text-primary-purple mr-2"></i>
            Available Packages
        </h1>
        

        <!-- 🎁 MODERN PACKAGE CARDS -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">

            @foreach($packages as $pkg)
            <div class="bg-white p-6 rounded-xl shadow-lg border border-gray-200 hover:shadow-2xl hover:-translate-y-1 transition duration-300">

                <h2 class="text-xl font-bold text-primary-purple mb-2">
                    {{ $pkg->package_name }}
                </h2>

                <p class="text-gray-600 text-sm mb-4 leading-relaxed">
                    {{ $pkg->description }}
                </p>

                <div class="text-3xl font-extrabold text-dark-purple mb-4">
                    Rs. {{ number_format($pkg->monthly_fee) }}
                </div>

             <button
    onclick="addToCart({{ $pkg->class_id }}, '{{ $pkg->package_name }}', {{ $pkg->monthly_fee }})"
    class="w-full bg-primary-purple text-white py-3 rounded-lg font-semibold hover:bg-dark-purple transition">
    Add to Cart
</button>

            </div>
            @endforeach

        </div>

    </div>

    <!-- SCRIPTS -->
    <script>
        lucide.createIcons();

        const btn = document.getElementById('profile-menu-button');
        const drop = document.getElementById('profile-dropdown');

        btn.addEventListener('click', (e) => {
            e.stopPropagation();
            drop.classList.toggle('hidden');
        });

        document.addEventListener('click', () => drop.classList.add('hidden'));
    </script>
    <script>
    let cart = JSON.parse(localStorage.getItem("cart")) || [];

    updateCartBadge();

    function addToCart(id, name, price) {
        // Check if item already exists
        const exists = cart.find(item => item.id === id);

        if (!exists) {
            cart.push({ id, name, price });
            localStorage.setItem("cart", JSON.stringify(cart));
        }

        updateCartBadge();
        animateCart();
    }

    function updateCartBadge() {
        const count = cart.length;
        const desktop = document.getElementById("cart-count");
        const mobile = document.getElementById("cart-count-mobile");
        if (desktop) desktop.textContent = count;
        if (mobile) mobile.textContent = count;
    }

    // Cart animation (affects both badges if present)
    function animateCart() {
        const badges = [document.getElementById("cart-count"), document.getElementById("cart-count-mobile")].filter(Boolean);
        badges.forEach(b => b.classList.add("scale-125"));
        setTimeout(() => {
            badges.forEach(b => b.classList.remove("scale-125"));
        }, 300);
    }
</script>


</body>
</html>
