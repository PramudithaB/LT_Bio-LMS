<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Dashboard</title>
    <!-- Load Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Load Lucide Icons for professional icons -->
    <script src="https://unpkg.com/lucide@latest"></script>
    
    <!-- Custom Tailwind Configuration -->
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        // Colors are now using your specified red values
                        'primary-purple': '#ff0000', 
                        'dark-purple': '#cc0000', // Adjusted dark shade for contrast/hover
                        'light-purple': '#f0c0c0', 
                        'accent-yellow': '#facc15',
                    },
                }
            }
        }
    </script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;800&display=swap');
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f3f4f6;
        }

        /* Styling for the main content section - Now single column on all sizes */
        .dashboard-grid {
            display: grid;
            gap: 1.5rem;
            grid-template-columns: 1fr;
        }

        @media (min-width: 1024px) {
            .dashboard-grid {
                /* Single column layout as requested (removed 2fr 1fr split) */
                grid-template-columns: 1fr;
            }
        }
    </style>
</head><div class="container mt-4">



</div>

<body class="antialiased">

    <!-- Top Navigation Bar -->
    <nav class="bg-white shadow-md sticky top-0 z-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <!-- Branding (LTBio) -->
                <div class="flex-shrink-0">
                    <span class="text-2xl font-extrabold text-primary-purple tracking-tighter">LTBio</span>
                    <span class="text-xs font-light text-gray-600 block leading-none">Online Education</span>
                </div>
                
                <!-- Desktop Menu Items -->
                <div class="hidden sm:ml-6 sm:flex sm:items-center space-x-4 text-gray-600 font-medium">
                    <a href="" class="hover:text-primary-purple transition duration-150 flex items-center"><i data-lucide="layout-dashboard" class="w-5 h-5 mr-1"></i> Dashboard</a>
                    <a href="" class="hover:text-primary-purple transition duration-150 flex items-center"><i data-lucide="book-open-text" class="w-5 h-5 mr-1"></i> My Classes</a>
                    <a href="#" class="hover:text-primary-purple transition duration-150 flex items-center"><i data-lucide="download" class="w-5 h-5 mr-1"></i> Study Materials</a>
                </div>

                <!-- Profile Dropdown -->
                <div class="flex items-center space-x-4">
                    <!-- Notification Button -->
                    <button class="text-gray-400 hover:text-primary-purple transition duration-150">
                         <i data-lucide="bell" class="w-6 h-6"></i>
                    </button>
                    
                    <!-- Dropdown Container -->
                    <div class="relative">
                        <!-- Button/Trigger -->
                        <button id="profile-menu-button" class="flex items-center space-x-2 border-l pl-4 focus:outline-none transition duration-150 hover:bg-gray-50 p-2 -my-2 rounded-lg">
                            <!-- Auth Blade Syntax Maintained -->
                            <span class="font-medium text-sm text-gray-700 hidden sm:block">{{ Auth::user()->name }}</span>
                            <div class="w-10 h-10 rounded-full bg-primary-purple flex items-center justify-center text-white font-bold">JD</div>
                            <i data-lucide="chevron-down" class="w-4 h-4 text-gray-400"></i>
                        </button>

                        <!-- Dropdown Menu Content -->
                        <div id="profile-dropdown" class="absolute right-0 mt-3 w-48 bg-white border border-gray-200 rounded-lg shadow-xl py-1 z-30 hidden origin-top-right">
                            
                            <!-- Profile Link -->
                            <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 transition duration-100">
                                {{ __('Profile') }}
                            </a>

                            <!-- Logout Form (Authentication and Submission Logic Maintained) -->
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <a href="{{ route('logout') }}"
                                    onclick="event.preventDefault(); this.closest('form').submit();"
                                    class="block w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-red-50 transition duration-100">
                                    {{ __('Log Out') }}
                                </a>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content Area -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

        <!-- Welcome Banner / Class Advertisement Bar (Biology Enrollment) -->
        <div class="bg-white p-6 rounded-xl shadow-lg mb-8 border-l-4 border-accent-yellow">
            <div class="flex flex-col md:flex-row items-start md:items-center justify-between">
                <div>
                    <!-- Auth Blade Syntax Maintained -->
                    <h1 class="text-3xl font-bold text-gray-900">Welcome Back, {{ Auth::user()->name }}</h1>
                    <p class="text-gray-600 mt-1">Ready for your next lesson?</p>
                </div>
                
                <!-- Advertisement Bar Content: Biology Class, Enrollment Months, Details -->
                <div class="mt-4 md:mt-0 bg-primary-purple/10 text-primary-purple p-3 rounded-lg flex items-center space-x-3 text-sm font-semibold border border-primary-purple/30 text-center md:text-left">
                    <i data-lucide="megaphone" class="w-5 h-5 flex-shrink-0"></i>
                    <span class="flex-grow">
                        New Course: <span class="text-dark-purple font-extrabold">Advanced Biology</span> - Enrollment for January & July Sessions Now Open! 
                        <a href='#' class='underline ml-1 hover:text-dark-purple'>View Details</a>
                    </span>
                </div>
            </div>
        </div>

        <!-- Dashboard Grid Layout (Now single column) -->  
      <div class="dashboard-grid">

    <h3 class="text-2xl font-bold text-gray-800 mb-4 flex items-center">
        <i data-lucide="book-open-text" class="w-6 h-6 mr-2 text-primary-purple"></i>
        Current Registered Classes
    </h3>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">

        @foreach($classes as $class)
        <!-- Class Card -->
        <div class="bg-white p-6 rounded-xl shadow-lg border-t-8 border-primary-purple hover:shadow-xl transition duration-300">
            
            <div class="flex items-center space-x-3 mb-3">
                <i data-lucide="graduation-cap" class="w-8 h-8 text-primary-purple"></i>
                <h4 class="text-2xl font-extrabold text-gray-900">{{ $class->className }}</h4>
            </div>

            <p class="text-gray-600 mb-4 text-sm">{{ $class->description }}</p>

            <div class="w-full bg-gray-200 rounded-full h-2.5 mb-2">
                <div class="bg-primary-purple h-2.5 rounded-full" style="width: 65%"></div>
            </div>

            <p class="text-right text-xs font-medium text-gray-500 mb-4">{{ $class->month }}</p>

            <a href="{{ route('classview') }}"
               class="w-full flex items-center justify-center py-3 bg-primary-purple text-white font-semibold rounded-lg hover:bg-dark-purple transition duration-150">
                <i data-lucide="arrow-right-circle" class="w-5 h-5 mr-2"></i>
                Go to Class
            </a>
        </div>
        @endforeach

    </div>

</div>



    <!-- Initialize Lucide Icons and Dropdown Logic -->
    <script>
        lucide.createIcons();

        document.addEventListener('DOMContentLoaded', () => {
            const button = document.getElementById('profile-menu-button');
            const dropdown = document.getElementById('profile-dropdown');

            // Toggle dropdown visibility on click
            button.addEventListener('click', (e) => {
                e.stopPropagation();
                dropdown.classList.toggle('hidden');
            });

            // Close dropdown when clicking outside
            document.addEventListener('click', (e) => {
                if (!button.contains(e.target) && !dropdown.contains(e.target)) {
                    dropdown.classList.add('hidden');
                }
            });
        });
    </script>

</body>
</html>