<x-admin-layout title="Admin Dashboard" subtitle="Platform overview, classes, packages, and lesson management">

    @php
        $totalLessons = $classes->sum(fn($c) => $c->lessons->count());
    @endphp

    <!-- 1. Real KPI Stats Ribbon -->
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6">
        
        <!-- Stat: Total Users -->
        <div class="bg-white rounded-3xl border border-slate-200/80 p-5 sm:p-6 shadow-xs flex items-center justify-between">
            <div>
                <p class="text-xs font-bold uppercase tracking-wider text-slate-400">Total Users</p>
                <p class="text-2xl sm:text-3xl font-black text-slate-900 mt-1">{{ $users->count() }}</p>
                <span class="text-[11px] font-semibold text-emerald-600 bg-emerald-50 px-2 py-0.5 rounded-md mt-2 inline-block">Registered</span>
            </div>
            <div class="w-12 h-12 rounded-2xl bg-brand-50 text-brand-500 flex items-center justify-center flex-shrink-0">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                </svg>
            </div>
        </div>

        <!-- Stat: Active Classes -->
        <div class="bg-white rounded-3xl border border-slate-200/80 p-5 sm:p-6 shadow-xs flex items-center justify-between">
            <div>
                <p class="text-xs font-bold uppercase tracking-wider text-slate-400">Active Classes</p>
                <p class="text-2xl sm:text-3xl font-black text-slate-900 mt-1">{{ $classes->count() }}</p>
                <span class="text-[11px] font-semibold text-bio-600 bg-bio-50 px-2 py-0.5 rounded-md mt-2 inline-block">A/L Biology</span>
            </div>
            <div class="w-12 h-12 rounded-2xl bg-bio-50 text-bio-500 flex items-center justify-center flex-shrink-0">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                </svg>
            </div>
        </div>

        <!-- Stat: Total Lessons -->
        <div class="bg-white rounded-3xl border border-slate-200/80 p-5 sm:p-6 shadow-xs flex items-center justify-between">
            <div>
                <p class="text-xs font-bold uppercase tracking-wider text-slate-400">Total Lessons</p>
                <p class="text-2xl sm:text-3xl font-black text-slate-900 mt-1">{{ $totalLessons }}</p>
                <span class="text-[11px] font-semibold text-purple-600 bg-purple-50 px-2 py-0.5 rounded-md mt-2 inline-block">Video Modules</span>
            </div>
            <div class="w-12 h-12 rounded-2xl bg-purple-50 text-purple-500 flex items-center justify-center flex-shrink-0">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z" />
                </svg>
            </div>
        </div>

        <!-- Stat: Total Packages -->
        <div class="bg-white rounded-3xl border border-slate-200/80 p-5 sm:p-6 shadow-xs flex items-center justify-between">
            <div>
                <p class="text-xs font-bold uppercase tracking-wider text-slate-400">Class Packages</p>
                <p class="text-2xl sm:text-3xl font-black text-slate-900 mt-1">{{ $packages->count() }}</p>
                <span class="text-[11px] font-semibold text-amber-600 bg-amber-50 px-2 py-0.5 rounded-md mt-2 inline-block">Monthly Fees</span>
            </div>
            <div class="w-12 h-12 rounded-2xl bg-amber-50 text-amber-500 flex items-center justify-center flex-shrink-0">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                </svg>
            </div>
        </div>

    </div>

    <!-- Quick Action Launchpad -->
    <div class="bg-gradient-to-r from-slate-900 via-slate-800 to-slate-900 text-white rounded-3xl p-6 shadow-lg border border-slate-800 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <h3 class="text-lg font-bold text-white">Quick Creator Actions</h3>
            <p class="text-xs text-slate-300 mt-0.5">Rapidly add curriculum classes, upload lesson videos, or manage pricing packages</p>
        </div>

        <div class="flex flex-wrap items-center gap-2.5">
            <a href="{{ route('classmanage') }}"
               class="inline-flex items-center gap-1.5 px-3.5 py-2 rounded-xl bg-brand-500 hover:bg-brand-600 text-white font-bold text-xs shadow-xs transition">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                <span>Add Class</span>
            </a>

            <a href="{{ route('lesson.lessoncreate') }}"
               class="inline-flex items-center gap-1.5 px-3.5 py-2 rounded-xl bg-bio-500 hover:bg-bio-600 text-white font-bold text-xs shadow-xs transition">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"/></svg>
                <span>Add Lesson</span>
            </a>

            <a href="{{ route('package.create') }}"
               class="inline-flex items-center gap-1.5 px-3.5 py-2 rounded-xl bg-slate-800 hover:bg-slate-700 text-white font-bold text-xs border border-slate-700 transition">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>
                <span>Add Package</span>
            </a>

            <a href="{{ route('paymentmanage') }}"
               class="inline-flex items-center gap-1.5 px-3.5 py-2 rounded-xl bg-slate-800 hover:bg-slate-700 text-white font-bold text-xs border border-slate-700 transition">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                <span>Verify Payments</span>
            </a>
        </div>
    </div>

    <!-- 2. Classes Management Table Section -->
    <section class="bg-white rounded-3xl border border-slate-200/80 shadow-xs overflow-hidden space-y-4">
        <div class="p-6 border-b border-slate-100 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <div>
                <h2 class="text-lg font-bold text-slate-900 tracking-tight flex items-center gap-2">
                    <span class="w-2.5 h-5 rounded-full bg-brand-500 inline-block"></span>
                    All Classes & Courses
                </h2>
                <p class="text-xs text-slate-500 mt-0.5">Manage created biology classes, scheduled times, and sessions</p>
            </div>

            <a href="{{ route('classmanage') }}"
               class="inline-flex items-center gap-2 text-xs font-bold text-brand-600 hover:text-brand-700 bg-brand-50 hover:bg-brand-100 px-3.5 py-2 rounded-xl transition self-start sm:self-auto">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                Create New Class
            </a>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse text-xs sm:text-sm">
                <thead>
                    <tr class="bg-slate-50/80 border-b border-slate-200 text-slate-500 font-bold uppercase text-[11px] tracking-wider">
                        <th class="py-3.5 px-6">Class Name</th>
                        <th class="py-3.5 px-6">Description</th>
                        <th class="py-3.5 px-6">Teacher</th>
                        <th class="py-3.5 px-6">Schedule</th>
                        <th class="py-3.5 px-6">Sessions</th>
                        <th class="py-3.5 px-6">Month</th>
                        <th class="py-3.5 px-6 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($classes as $c)
                        <tr class="hover:bg-slate-50/70 transition">
                            <td class="py-4 px-6 font-bold text-slate-900 whitespace-nowrap">
                                <a href="{{ route('classview', $c->id) }}" class="hover:text-brand-500 transition" title="Preview Student View">
                                    {{ $c->className }}
                                </a>
                            </td>
                            <td class="py-4 px-6 text-slate-500 max-w-xs truncate">
                                {{ $c->description ?: 'No description provided' }}
                            </td>
                            <td class="py-4 px-6 font-medium text-slate-700 whitespace-nowrap">
                                {{ $c->teacherName ?: 'Lakshitha Thennakoon' }}
                            </td>
                            <td class="py-4 px-6 text-slate-600 whitespace-nowrap">
                                {{ $c->classTime ?: '-' }}
                            </td>
                            <td class="py-4 px-6 whitespace-nowrap">
                                <span class="font-bold text-slate-800">{{ $c->sessionCount }}</span> Sessions
                            </td>
                            <td class="py-4 px-6 whitespace-nowrap">
                                <span class="px-2.5 py-1 rounded-full text-[11px] font-bold bg-slate-100 text-slate-700">
                                    {{ $c->month ?: 'All Year' }}
                                </span>
                            </td>
                            <td class="py-4 px-6 text-right whitespace-nowrap">
                                <div class="inline-flex items-center gap-2">
                                    <a href="{{ route('class.edit', $c->id) }}"
                                       class="p-2 rounded-xl text-brand-600 hover:bg-brand-50 border border-slate-200 hover:border-brand-200 transition"
                                       title="Edit Class">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                                    </a>

                                    <form action="{{ route('class.delete', $c->id) }}" 
                                          method="POST" 
                                          class="inline-block"
                                          onsubmit="return confirm('Are you sure you want to delete this class? This cannot be undone.');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                class="p-2 rounded-xl text-red-600 hover:bg-red-50 border border-slate-200 hover:border-red-200 transition"
                                                title="Delete Class">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="py-10 text-center text-slate-400">
                                No classes created yet. Click "Create New Class" to get started.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </section>

    <!-- 3. Packages Table Section -->
    <section class="bg-white rounded-3xl border border-slate-200/80 shadow-xs overflow-hidden space-y-4">
        <div class="p-6 border-b border-slate-100 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <div>
                <h2 class="text-lg font-bold text-slate-900 tracking-tight flex items-center gap-2">
                    <span class="w-2.5 h-5 rounded-full bg-amber-500 inline-block"></span>
                    Course Fee Packages
                </h2>
                <p class="text-xs text-slate-500 mt-0.5">Pricing packages available for student purchase on the catalog</p>
            </div>

            <a href="{{ route('package.create') }}"
               class="inline-flex items-center gap-2 text-xs font-bold text-amber-700 hover:text-amber-800 bg-amber-50 hover:bg-amber-100 px-3.5 py-2 rounded-xl transition self-start sm:self-auto">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                Create New Package
            </a>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse text-xs sm:text-sm">
                <thead>
                    <tr class="bg-slate-50/80 border-b border-slate-200 text-slate-500 font-bold uppercase text-[11px] tracking-wider">
                        <th class="py-3.5 px-6">Package Name</th>
                        <th class="py-3.5 px-6">Description</th>
                        <th class="py-3.5 px-6">Monthly Fee</th>
                        <th class="py-3.5 px-6">Linked Class</th>
                        <th class="py-3.5 px-6 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($packages as $package)
                        <tr class="hover:bg-slate-50/70 transition">
                            <td class="py-4 px-6 font-bold text-slate-900 whitespace-nowrap">
                                {{ $package->package_name }}
                            </td>
                            <td class="py-4 px-6 text-slate-500 max-w-xs truncate">
                                {{ $package->description ?: '-' }}
                            </td>
                            <td class="py-4 px-6 whitespace-nowrap">
                                <span class="font-extrabold text-brand-600">LKR {{ number_format($package->monthly_fee) }}</span>
                            </td>
                            <td class="py-4 px-6 whitespace-nowrap">
                                @if($package->classModel)
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-bold bg-bio-50 text-bio-700 border border-bio-100">
                                        {{ $package->classModel->className }}
                                    </span>
                                @else
                                    <span class="text-slate-400">Unlinked</span>
                                @endif
                            </td>
                            <td class="py-4 px-6 text-right whitespace-nowrap">
                                <div class="inline-flex items-center gap-2">
                                    <a href="{{ route('package.edit', $package->id) }}"
                                       class="p-2 rounded-xl text-amber-600 hover:bg-amber-50 border border-slate-200 hover:border-amber-200 transition"
                                       title="Edit Package">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                                    </a>

                                    <form action="{{ route('package.delete', $package->id) }}" 
                                          method="POST" 
                                          class="inline-block"
                                          onsubmit="return confirm('Are you sure you want to delete this package?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                class="p-2 rounded-xl text-red-600 hover:bg-red-50 border border-slate-200 hover:border-red-200 transition"
                                                title="Delete Package">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="py-10 text-center text-slate-400">
                                No packages published yet.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </section>

    <!-- 4. Class Lessons Breakdown Section -->
    <div class="space-y-6">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-xl font-bold text-slate-900 tracking-tight flex items-center gap-2">
                    <span class="w-2.5 h-5 rounded-full bg-purple-500 inline-block"></span>
                    Lessons Breakdown by Class
                </h2>
                <p class="text-xs text-slate-500 mt-0.5">Manage YouTube lecture links, notes files, and paid access flags per module</p>
            </div>

            <a href="{{ route('lesson.lessoncreate') }}"
               class="inline-flex items-center gap-1.5 px-3.5 py-2 rounded-xl bg-purple-600 hover:bg-purple-700 text-white font-bold text-xs shadow-xs transition">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                Add New Lesson
            </a>
        </div>

        @foreach($classes as $class)
            <div class="bg-white rounded-3xl border border-slate-200/80 shadow-xs overflow-hidden space-y-3">
                <div class="p-5 bg-slate-50/80 border-b border-slate-200/80 flex items-center justify-between">
                    <div class="flex items-center gap-2.5">
                        <span class="w-3 h-3 rounded-full bg-brand-500"></span>
                        <h3 class="text-base font-bold text-slate-900">{{ $class->className }}</h3>
                        <span class="text-xs text-slate-400 font-medium">({{ $class->lessons->count() }} Lessons)</span>
                    </div>

                    <a href="{{ route('classview', $class->id) }}" target="_blank" class="text-xs font-semibold text-brand-600 hover:underline">
                        View in LMS &rarr;
                    </a>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse text-xs sm:text-sm">
                        <thead>
                            <tr class="border-b border-slate-100 text-slate-400 font-bold uppercase text-[10px] tracking-wider">
                                <th class="py-3 px-6 w-12">#</th>
                                <th class="py-3 px-6">Lesson Name</th>
                                <th class="py-3 px-6">Description</th>
                                <th class="py-3 px-6">Video Link</th>
                                <th class="py-3 px-6">Attached File</th>
                                <th class="py-3 px-6">Notice</th>
                                <th class="py-3 px-6">Type</th>
                                <th class="py-3 px-6 text-right">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">
                            @forelse($class->lessons as $idx => $lesson)
                                <tr class="hover:bg-slate-50/70 transition">
                                    <td class="py-3.5 px-6 font-mono text-slate-400">{{ $idx + 1 }}</td>
                                    <td class="py-3.5 px-6 font-bold text-slate-900 whitespace-nowrap">
                                        {{ $lesson->name }}
                                    </td>
                                    <td class="py-3.5 px-6 text-slate-500 max-w-xs truncate">
                                        {{ $lesson->description ?: '-' }}
                                    </td>
                                    <td class="py-3.5 px-6 whitespace-nowrap">
                                        @if($lesson->link)
                                            <a href="{{ $lesson->link }}" target="_blank" class="inline-flex items-center gap-1 text-xs font-semibold text-red-600 hover:underline">
                                                <svg class="w-3.5 h-3.5 fill-current" viewBox="0 0 24 24"><path d="M10 15l5.19-3L10 9v6m11.56-7.83c.13.47.22 1.1.28 1.9.07.8.1 1.49.1 2.09L22 12c0 2.19-.16 3.8-.44 4.83-.25.9-.83 1.48-1.73 1.73-.47.13-1.33.22-2.65.28-1.3.07-2.49.1-3.59.1L12 22c-4.19 0-6.8-.16-7.83-.44-.9-.25-1.48-.83-1.73-1.73-.13-.47-.22-1.1-.28-1.9-.07-.8-.1-1.49-.1-2.09L2 12c0-2.19.16-3.8.44-4.83.25-.9.83-1.48 1.73-1.73.47-.13 1.33-.22 2.65-.28 1.3-.07 2.49-.1 3.59-.1L12 2c4.19 0 6.8.16 7.83.44.9.25 1.48.83 1.73 1.73z"/></svg>
                                                <span>YouTube Link</span>
                                            </a>
                                        @else
                                            <span class="text-slate-400 italic">No link</span>
                                        @endif
                                    </td>
                                    <td class="py-3.5 px-6 whitespace-nowrap">
                                        @if($lesson->file_path)
                                            <a href="{{ route('storage.file', ['encoded' => base64_encode($lesson->file_path)]) }}" target="_blank" class="inline-flex items-center gap-1 text-xs font-semibold text-bio-600 hover:underline">
                                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>
                                                <span>Download PDF</span>
                                            </a>
                                        @else
                                            <span class="text-slate-400">-</span>
                                        @endif
                                    </td>
                                    <td class="py-3.5 px-6 text-slate-500 max-w-xs truncate">
                                        {{ $lesson->notice ?: '-' }}
                                    </td>
                                    <td class="py-3.5 px-6 whitespace-nowrap">
                                        @if($lesson->is_paid)
                                            <span class="px-2 py-0.5 rounded-md text-[10px] font-bold bg-emerald-100 text-emerald-800">Paid</span>
                                        @else
                                            <span class="px-2 py-0.5 rounded-md text-[10px] font-bold bg-blue-100 text-blue-800">Free</span>
                                        @endif
                                    </td>
                                    <td class="py-3.5 px-6 text-right whitespace-nowrap">
                                        <div class="inline-flex items-center gap-2">
                                            <a href="{{ route('lesson.edit', $lesson->id) }}"
                                               class="p-1.5 rounded-lg text-brand-600 hover:bg-brand-50 border border-slate-200 hover:border-brand-200 transition"
                                               title="Edit Lesson">
                                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                                            </a>

                                            <form action="{{ route('lesson.delete', $lesson->id) }}" 
                                                  method="POST" 
                                                  class="inline-block"
                                                  onsubmit="return confirm('Delete this lesson module?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" 
                                                        class="p-1.5 rounded-lg text-red-600 hover:bg-red-50 border border-slate-200 hover:border-red-200 transition"
                                                        title="Delete Lesson">
                                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="py-6 text-center text-slate-400">
                                        No lessons uploaded for this class yet.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        @endforeach
    </div>

</x-admin-layout>