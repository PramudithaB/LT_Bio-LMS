<x-admin-layout title="Courses & Lectures" subtitle="Create and configure new biology courses, schedules, and monthly sessions">

    <div class="max-w-4xl mx-auto space-y-6">

        <!-- Header Info Card -->
        <div class="bg-gradient-to-r from-slate-900 via-slate-800 to-slate-900 text-white rounded-3xl p-6 sm:p-8 shadow-lg border border-slate-800 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <div class="space-y-1">
                <span class="px-2.5 py-0.5 rounded-md text-[10px] font-extrabold uppercase tracking-wider bg-brand-500 text-white">Course Creator</span>
                <h2 class="text-xl sm:text-2xl font-black text-white">Add New Biology Class</h2>
                <p class="text-xs text-slate-300">Set up a new course syllabus for student enrollment and video uploads</p>
            </div>

            <a href="{{ route('admindashboard') }}" 
               class="inline-flex items-center gap-1.5 px-4 py-2 rounded-xl bg-slate-800 hover:bg-slate-700 text-white font-bold text-xs border border-slate-700 transition self-start sm:self-auto">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                <span>View All Classes</span>
            </a>
        </div>

        <!-- Class Creation Form -->
        <div class="bg-white rounded-3xl border border-slate-200/80 p-6 sm:p-8 shadow-xs">
            <form action="{{ route('classstore') }}" method="POST" enctype="multipart/form-data" class="space-y-5">
                @csrf

                <!-- Class Name -->
                <div>
                    <label for="className" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">
                        Class / Course Title <span class="text-red-500">*</span>
                    </label>
                    <input type="text" 
                           id="className" 
                           name="className" 
                           placeholder="e.g., 2026 Biology Theory or 2027 Revision" 
                           value="{{ old('className') }}"
                           class="w-full px-4 py-3 rounded-xl border border-slate-200 text-sm focus:outline-none focus:ring-2 focus:ring-brand-500/20 focus:border-brand-500 transition" 
                           required>
                    <p class="text-[11px] text-slate-400 mt-1">This title will be prominently displayed to students across the LMS.</p>
                </div>

                <!-- Description -->
                <div>
                    <label for="description" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">
                        Course Description <span class="text-red-500">*</span>
                    </label>
                    <textarea id="description" 
                              name="description" 
                              rows="3" 
                              placeholder="Outline the core topics, learning objectives, and curriculum summary..." 
                              class="w-full px-4 py-3 rounded-xl border border-slate-200 text-sm focus:outline-none focus:ring-2 focus:ring-brand-500/20 focus:border-brand-500 transition" 
                              required>{{ old('description') }}</textarea>
                </div>

                <!-- Teacher Name & Schedule Time -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label for="teacherName" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">
                            Teacher / Lecturer Name <span class="text-red-500">*</span>
                        </label>
                        <input type="text" 
                               id="teacherName" 
                               name="teacherName" 
                               value="{{ old('teacherName', 'Lakshitha Thennakoon') }}" 
                               placeholder="e.g., Lakshitha Thennakoon" 
                               class="w-full px-4 py-3 rounded-xl border border-slate-200 text-sm focus:outline-none focus:ring-2 focus:ring-brand-500/20 focus:border-brand-500 transition" 
                               required>
                    </div>

                    <div>
                        <label for="classTime" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">
                            Class Schedule / Time <span class="text-red-500">*</span>
                        </label>
                        <input type="text" 
                               id="classTime" 
                               name="classTime" 
                               value="{{ old('classTime') }}" 
                               placeholder="e.g., Every Tuesday 19:00 - 21:00 or Live Stream" 
                               class="w-full px-4 py-3 rounded-xl border border-slate-200 text-sm focus:outline-none focus:ring-2 focus:ring-brand-500/20 focus:border-brand-500 transition" 
                               required>
                    </div>
                </div>

                <!-- Total Sessions & Month -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label for="sessionCount" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">
                            Total Sessions <span class="text-red-500">*</span>
                        </label>
                        <input type="number" 
                               id="sessionCount" 
                               name="sessionCount" 
                               value="{{ old('sessionCount', 4) }}" 
                               placeholder="e.g., 4" 
                               min="1" 
                               class="w-full px-4 py-3 rounded-xl border border-slate-200 text-sm focus:outline-none focus:ring-2 focus:ring-brand-500/20 focus:border-brand-500 transition" 
                               required>
                    </div>

                    <div>
                        <label for="Month" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">
                            Academic Month <span class="text-red-500">*</span>
                        </label>
                        <select id="Month" 
                                name="month" 
                                class="w-full px-4 py-3 rounded-xl border border-slate-200 text-sm focus:outline-none focus:ring-2 focus:ring-brand-500/20 focus:border-brand-500 transition bg-white" 
                                required>
                            <option value="" disabled {{ old('month') ? '' : 'selected' }}>Select Academic Month</option>
                            @foreach(['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'] as $m)
                                <option value="{{ $m }}" {{ old('month') === $m ? 'selected' : '' }}>{{ $m }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <!-- Action Button -->
                <div class="pt-4 border-t border-slate-100 flex items-center justify-end gap-3">
                    <a href="{{ route('admindashboard') }}" 
                       class="px-5 py-3 rounded-xl text-slate-600 hover:text-slate-900 font-semibold text-xs border border-slate-200 hover:bg-slate-50 transition">
                        Cancel
                    </a>

                    <button type="submit" 
                            class="inline-flex items-center gap-2 px-6 py-3 rounded-xl font-bold text-sm text-white bg-brand-500 hover:bg-brand-600 active:scale-[0.99] shadow-md shadow-brand-500/20 transition duration-150">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                        <span>Create Class</span>
                    </button>
                </div>

            </form>
        </div>

    </div>

</x-admin-layout>