<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Class View: 2026 Theory</title>
    <!-- Load Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Load Lucide Icons for professional icons -->
    <script src="https://unpkg.com/lucide@latest"></script>
    
    <!-- Custom Tailwind Configuration (Matching Dashboard) -->
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        // Colors are now using your specified red values
                        'primary-purple': '#ff0000', 
                        'dark-purple': '#cc0000', 
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
        .material-item:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -2px rgba(0, 0, 0, 0.06);
        }
    </style>
</head>
<body class="antialiased">

    <!-- Top Navigation Bar (Simplified) -->
    <nav class="bg-white shadow-md">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <!-- Back Button -->
              
                
                <!-- Branding -->
                <div class="flex-shrink-0">
                    <span class="text-2xl font-extrabold text-primary-purple tracking-tighter">LTbio</span>
                </div>
                
                <!-- Profile Placeholder -->
                <div class="w-10 h-10 rounded-full bg-primary-purple flex items-center justify-center text-white font-bold">name</div>
            </div>
        </div>
    </nav>

    <!-- Main Content Area -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

        <!-- CLASS HEADER / DETAILS -->
        <div class="bg-white p-8 rounded-xl shadow-xl mb-8 border-l-8 border-primary-purple">
            <h1 class="text-4xl font-extrabold text-gray-900">LTbio.lk</h1>
            <p class="text-lg text-gray-600 mt-2">Lakshitha Thennakoon</p>
            
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mt-6 text-sm">
                <!-- Class -->
                <div class="p-3 bg-fuchsia-50 rounded-lg border border-fuchsia-100">
                    <p class="font-bold text-fuchsia-700 uppercase">Class Type</p>
                    <p class="text-gray-800 font-semibold">ltbio</p>
                </div>
                <!-- Time -->
                <div class="p-3 bg-cyan-50 rounded-lg border border-cyan-100">
                    <p class="font-bold text-cyan-700 uppercase">Time</p>
                    <p class="text-gray-800 font-semibold"></p>
                </div>
                <!-- Teacher -->
                <div class="p-3 bg-amber-50 rounded-lg border border-amber-100">
                    <p class="font-bold text-amber-700 uppercase">Teacher</p>
                    <p class="text-gray-800 font-semibold">Lakshitha Thennakoon</p>
                </div>
                <!-- Month -->
                <div class="p-3 bg-green-50 rounded-lg border border-green-100">
                    <p class="font-bold text-green-700 uppercase">Month</p>
                    <p class="text-gray-800 font-semibold">December 2025</p>
                </div>
            </div>
        </div>

        <!-- WEEKLY MODULES (4 SMALL CARDS) -->
        <h2 class="text-3xl font-bold text-gray-800 mb-5 flex items-center"><i data-lucide="calendar-days" class="w-7 h-7 mr-2 text-primary-purple"></i> Weekly Lesson Breakdown</h2>
        
  <h2 class="text-3xl font-bold mb-5">{{ $class->className }} – Lessons</h2>

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-12">

    @forelse($class->lessons as $lesson)

        <div class="bg-white p-5 rounded-xl shadow-lg border-t-4 border-primary-purple transition duration-300 hover:shadow-xl">
            <h4 class="text-xl font-bold text-primary-purple mb-1">
                {{ $lesson->name }}
            </h4>

            <p class="text-gray-600 text-sm mb-4">
                {{ $lesson->description ?? 'No description.' }}
            </p>

            @php
                // default routes
                $videoRoute = route('classvideo', $lesson->id);
                $checkoutRoute = route('checkout.page') . '?class=' . $class->id . '&class_name=' . urlencode($class->className) . '&lesson=' . $lesson->id;

                // assume free lessons are viewable
                $canView = ! $lesson->is_paid;

                if ($lesson->is_paid && auth()->check()) {
                    $userId = auth()->id();
                    $userName = auth()->user()->name ?? null;
                    $classId = $lesson->class_id;

                    // exact-match on CSV class_id (same approach used elsewhere)
                    $hasApproved = \App\Models\Checkout::where('status', 'approved')
                        ->whereRaw("CONCAT(',', REPLACE(class_id, ' ', ''), ',') LIKE ?", ['%,' . $classId . ',%'])
                        ->where(function($q) use ($userId, $userName) {
                            $q->where('user_id', $userId);
                            if ($userName) {
                                $q->orWhere('student_name', $userName);
                            }
                        })
                        ->exists();

                    if ($hasApproved) {
                        $canView = true;
                    }
                }
            @endphp

            @if($canView)
                <a href="{{ $videoRoute }}"
                   class="w-full flex items-center justify-center py-2 bg-primary-purple text-white font-semibold text-sm rounded-lg hover:bg-dark-purple transition duration-150">
                    <i data-lucide="youtube" class="w-5 h-5 mr-2"></i> Go to Video
                </a>
            @else
                <a href="{{ route('buyclass')}}"
                   class="w-full flex items-center justify-center py-2 bg-yellow-500 text-white font-semibold text-sm rounded-lg hover:brightness-95 transition duration-150">
                    <i data-lucide="credit-card" class="w-5 h-5 mr-2"></i> Pay / Checkout
                </a>
            @endif

        </div>

    @empty
        <p class="text-gray-500">No lessons found for this class.</p>
    @endforelse

</div>



        <!-- STUDY MATERIALS (PDFs, Papers, Tutes) -->
        <h2 class="text-3xl font-bold text-gray-800 mb-5 flex items-center"><i data-lucide="folder-open" class="w-7 h-7 mr-2 text-primary-purple"></i> Essential Study Materials</h2>
        
        <div class="bg-white p-6 rounded-xl shadow-lg space-y-4">
            
            <!-- Material Item: PDF Notes -->
            <div class="material-item flex items-center justify-between p-4 rounded-lg bg-gray-50 border border-gray-200 transition duration-200 cursor-pointer">
                <div class="flex items-center space-x-4">
                    <i data-lucide="file-text" class="w-7 h-7 text-primary-purple"></i>
                    <div>
                        <p class="font-medium text-gray-800">Module 4 Comprehensive Notes (PDF)</p>
                        <p class="text-xs text-gray-500">Topics: Glycolysis, Krebs Cycle. (1.2 MB)</p>
                    </div>
                </div>
                <a href="#" class="text-white bg-primary-purple hover:bg-dark-purple px-4 py-2 rounded-lg text-sm font-semibold flex items-center">
                    <i data-lucide="download" class="w-4 h-4 mr-1"></i> Download
                </a>
            </div>

            <!-- Material Item: Past Paper Questions -->
            <div class="material-item flex items-center justify-between p-4 rounded-lg bg-gray-50 border border-gray-200 transition duration-200 cursor-pointer">
                <div class="flex items-center space-x-4">
                    <i data-lucide="book-open" class="w-7 h-7 text-green-600"></i>
                    <div>
                        <p class="font-medium text-gray-800">Past Paper Tutes - Respiration Section</p>
                        <p class="text-xs text-gray-500">Includes 20+ structured essay questions.</p>
                    </div>
                </div>
                <a href="#" class="text-white bg-green-600 hover:bg-green-700 px-4 py-2 rounded-lg text-sm font-semibold flex items-center">
                    <i data-lucide="download" class="w-4 h-4 mr-1"></i> Download
                </a>
            </div>

            <!-- Material Item: Supplementary Tutes -->
            <div class="material-item flex items-center justify-between p-4 rounded-lg bg-gray-50 border border-gray-200 transition duration-200 cursor-pointer">
                <div class="flex items-center space-x-4">
                    <i data-lucide="flask-round" class="w-7 h-7 text-blue-600"></i>
                    <div>
                        <p class="font-medium text-gray-800">Interactive Pathway Diagram (Image/Web)</p>
                        <p class="text-xs text-gray-500">High-resolution schematic of the Electron Transport Chain.</p>
                    </div>
                </div>
                <a href="#" class="text-white bg-blue-600 hover:bg-blue-700 px-4 py-2 rounded-lg text-sm font-semibold flex items-center">
                    <i data-lucide="link" class="w-4 h-4 mr-1"></i> View Online
                </a>
            </div>
            
        </div>
        
    </div>

    <!-- Initialize Lucide Icons -->
    <script>
        lucide.createIcons();
    </script>

</body>
</html>