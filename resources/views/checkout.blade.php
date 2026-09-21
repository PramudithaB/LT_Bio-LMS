<!DOCTYPE html>
<html lang="en" class="h-full bg-slate-50">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Payment & Checkout - LTbio LMS</title>
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
      x-data="{ fileName: '' }">

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
            <a href="{{ route('cart.view') }}" class="hover:text-brand-500 transition">Cart</a>
            <svg class="w-3.5 h-3.5 text-slate-300" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
            </svg>
            <span class="text-slate-800 font-semibold">Payment Checkout</span>
        </nav>

        <div class="border-b border-slate-200 pb-4">
            <h1 class="text-2xl sm:text-3xl font-extrabold text-slate-900 tracking-tight flex items-center gap-2.5">
                <span class="w-2.5 h-6 rounded-full bg-brand-500 inline-block"></span>
                Payment & Slip Submission
            </h1>
            <p class="text-sm text-slate-500 mt-0.5">Please transfer the class fee and upload your bank deposit or online transfer slip for activation</p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">

            <!-- LEFT: Checkout Submission Form (7 Cols) -->
            <div class="lg:col-span-7 space-y-6">
                
                <!-- Bank Details Instructions Card -->
                <div class="bg-gradient-to-br from-slate-900 via-slate-800 to-slate-900 text-white rounded-3xl p-6 shadow-md border border-slate-800 space-y-3">
                    <div class="flex items-center gap-2 text-brand-400 text-xs font-bold uppercase tracking-wider">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/></svg>
                        Official Bank Transfer Details
                    </div>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-xs pt-1">
                        <div class="p-3 rounded-2xl bg-white/5 border border-white/10">
                            <p class="text-slate-400 font-medium">Account Name</p>
                            <p class="text-white font-bold text-sm mt-0.5">Lakshitha Thennakoon</p>
                        </div>
                        <div class="p-3 rounded-2xl bg-white/5 border border-white/10">
                            <p class="text-slate-400 font-medium">Bank & Branch</p>
                            <p class="text-white font-bold text-sm mt-0.5">Commercial Bank / Sampath Bank</p>
                        </div>
                    </div>
                    <p class="text-[11px] text-slate-300">
                        * Please note down your Student Name as reference on your bank deposit or mobile transfer receipt.
                    </p>
                </div>

                <!-- Checkout Form -->
                <form action="{{ route('checkout.submit') }}" 
                      method="POST" 
                      enctype="multipart/form-data" 
                      class="bg-white rounded-3xl border border-slate-200/80 p-6 sm:p-8 shadow-xs space-y-5">
                    @csrf

                    <!-- Student Name -->
                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">
                            Student Name <span class="text-red-500">*</span>
                        </label>
                        <input type="text" 
                               name="student_name" 
                               value="{{ Auth::user()->name ?? '' }}"
                               placeholder="WebSite එකට Register වුන නම පමනක් ඇතුලත් කරන්න"
                               class="w-full px-4 py-3 rounded-xl border border-slate-200 text-sm focus:outline-none focus:ring-2 focus:ring-brand-500/20 focus:border-brand-500 transition" 
                               required>
                        <p class="text-[11px] text-slate-400 mt-1">Make sure this matches your registered profile name.</p>
                    </div>

                    <!-- Class Name (Display + Hidden) -->
                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">
                            Enrolling Class / Packages
                        </label>
                        <input type="text"
                               id="class_name_display"
                               class="w-full px-4 py-3 rounded-xl border border-slate-200 text-sm bg-slate-50 text-slate-600 font-semibold cursor-not-allowed"
                               disabled>
                        <input type="hidden" id="class_name" name="class_name">
                        <input type="hidden" id="class_id" name="class_id">
                    </div>

                    <!-- Remark (Optional) -->
                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">
                            Remark (Optional)
                        </label>
                        <textarea name="remark" 
                                  rows="2" 
                                  placeholder="Add any additional notes (e.g. Bank reference number, date of deposit)"
                                  class="w-full px-4 py-3 rounded-xl border border-slate-200 text-sm focus:outline-none focus:ring-2 focus:ring-brand-500/20 focus:border-brand-500 transition"></textarea>
                    </div>

                    <!-- Payment Slip Upload Box -->
                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">
                            Payment Slip Receipt (PDF or Image) <span class="text-red-500">*</span>
                        </label>
                        
                        <div class="relative border-2 border-dashed border-slate-200 hover:border-brand-500 rounded-2xl p-6 text-center transition group bg-slate-50/50 hover:bg-white">
                            <input type="file" 
                                   name="file" 
                                   id="slip-input"
                                   accept="application/pdf,image/*" 
                                   @change="fileName = $event.target.files[0] ? $event.target.files[0].name : ''"
                                   class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10" 
                                   required>

                            <div class="space-y-2 pointer-events-none">
                                <div class="w-12 h-12 rounded-xl bg-brand-50 text-brand-500 flex items-center justify-center mx-auto transition group-hover:scale-105">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12" />
                                    </svg>
                                </div>
                                <div class="text-xs">
                                    <span class="font-bold text-brand-600">Click to upload slip</span> or drag and drop
                                    <p class="text-slate-400 text-[11px] mt-0.5">PDF, PNG, JPG up to 2MB</p>
                                </div>
                                <div x-show="fileName" style="display: none;" class="pt-2">
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-lg bg-emerald-50 border border-emerald-200 text-emerald-700 text-xs font-semibold">
                                        <svg class="w-3.5 h-3.5 text-emerald-600" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" /></svg>
                                        <span x-text="fileName"></span>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Hidden Lesson ID (if redirected from single lesson) -->
                    <input type="hidden" id="lesson_id" name="lesson_id" value="">

                    <!-- Submit Button -->
                    <button type="submit" 
                            class="w-full flex items-center justify-center gap-2 py-3.5 px-4 rounded-xl font-bold text-sm text-white bg-brand-500 hover:bg-brand-600 active:scale-[0.99] shadow-md shadow-brand-500/20 transition duration-150">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <span>Submit Slip & Complete Checkout</span>
                    </button>

                </form>

            </div>

            <!-- RIGHT: Order Summary Card (5 Cols) -->
            <div class="lg:col-span-5 space-y-6">
                <div class="bg-white rounded-3xl border border-slate-200/80 p-6 sm:p-8 shadow-xs space-y-6">
                    <h2 class="text-lg font-bold text-slate-900 pb-3 border-b border-slate-100 flex items-center gap-2">
                        <svg class="w-5 h-5 text-brand-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                        </svg>
                        Selected Course Summary
                    </h2>

                    <!-- Dynamic Cart Summary Container -->
                    <div id="cart-summary" class="space-y-3"></div>

                    <!-- Total Amount Display -->
                    <div class="pt-4 border-t border-slate-100 flex justify-between items-baseline">
                        <span class="text-sm font-bold text-slate-700">Total Amount</span>
                        <span id="checkout-total" class="text-2xl font-black text-brand-600">Rs. 0</span>
                    </div>

                    <!-- Special Offer / Important Notice -->
                    <div class="p-3.5 rounded-2xl bg-amber-50 border border-amber-200/80 text-amber-900 text-xs leading-relaxed">
                        <strong class="font-bold">විශේෂ දැනුම්දීම:</strong> 2026 Revision හා Paper Class දෙකටම මුදල් ගෙවීමේදී 5600 මුදලක් පෙන්වූවද 5000 පමනක් බැර කරන්න.
                    </div>

                    <!-- Approval Time Expectation -->
                    <div class="p-3.5 rounded-2xl bg-slate-50 border border-slate-200/70 text-slate-600 text-xs flex items-start gap-2.5">
                        <svg class="w-4 h-4 text-emerald-600 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                        <span>Slips are reviewed and classes unlocked within <strong>1–2 hours</strong> during standard academic hours.</span>
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

    <!-- Cart Data Loading Script -->
    <script>
        let cart = JSON.parse(localStorage.getItem("cart")) || [];
        let container = document.getElementById("cart-summary");

        let total = 0;
        let selectedNames = [];
        let selectedIds = [];

        if (cart.length > 0) {
            cart.forEach(item => {
                total += Number(item.price);
                selectedNames.push(item.name);
                selectedIds.push(item.id);

                const itemDiv = document.createElement("div");
                itemDiv.className = "flex items-center justify-between p-3.5 rounded-2xl bg-slate-50 border border-slate-100 text-xs";
                itemDiv.innerHTML = `
                    <div class="font-semibold text-slate-800 truncate pr-2">${item.name}</div>
                    <div class="font-black text-slate-900 whitespace-nowrap">Rs. ${Number(item.price).toLocaleString()}</div>
                `;
                container.appendChild(itemDiv);
            });
        } else {
            container.innerHTML = `<p class="text-xs text-slate-400 italic">No cart items found. If accessing a specific course, details are filled below.</p>`;
        }

        document.getElementById("checkout-total").textContent = "Rs. " + total.toLocaleString();

        // Fill form fields automatically from cart
        document.getElementById("class_name").value = selectedNames.join(", ");
        if (document.getElementById("class_name_display")) {
            document.getElementById("class_name_display").value = selectedNames.join(", ");
        }
        document.getElementById("class_id").value = selectedIds.join(",");

        // If page opened with query params (e.g. from "Go to Video" or "Pay/Checkout"), prefer those values
        const params = new URLSearchParams(window.location.search);
        if (params.has('class')) {
            document.getElementById("class_id").value = params.get('class');
        }
        if (params.has('class_name')) {
            const parsedName = decodeURIComponent(params.get('class_name'));
            document.getElementById("class_name").value = parsedName;
            if (document.getElementById("class_name_display")) {
                document.getElementById("class_name_display").value = parsedName;
            }
        }
        if (params.has('lesson')) {
            document.getElementById("lesson_id").value = params.get('lesson');
        }
    </script>

</body>
</html>
