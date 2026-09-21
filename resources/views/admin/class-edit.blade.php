<x-admin-layout title="Edit Class: {{ $class->className }}" subtitle="Update course information, scheduled timings, and monthly session counts">

    <div class="max-w-4xl mx-auto space-y-6">

        <!-- Header Back Bar -->
        <div class="flex items-center justify-between">
            <a href="{{ route('admindashboard') }}" 
               class="inline-flex items-center gap-2 text-xs font-bold text-slate-600 hover:text-brand-500 bg-white hover:bg-slate-50 border border-slate-200 px-4 py-2 rounded-xl transition shadow-xs">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                <span>Back to Dashboard</span>
            </a>

            <span class="text-xs font-mono text-slate-400">Class ID #{{ $class->id }}</span>
        </div>

        <!-- Edit Form Card -->
        <div class="bg-white rounded-3xl border border-slate-200/80 p-6 sm:p-8 shadow-xs">
            <form action="{{ route('class.update', $class->id) }}" method="POST" class="space-y-5">
                @csrf
                @method('PUT')

                <!-- Class Name -->
                <div>
                    <label for="className" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">
                        Class / Course Title <span class="text-red-500">*</span>
                    </label>
                    <input type="text" 
                           id="className" 
                           name="className" 
                           value="{{ old('className', $class->className) }}" 
                           class="w-full px-4 py-3 rounded-xl border border-slate-200 text-sm focus:outline-none focus:ring-2 focus:ring-brand-500/20 focus:border-brand-500 transition font-semibold" 
                           required>
                </div>

                <!-- Description -->
                <div>
                    <label for="description" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">
                        Course Description
                    </label>
                    <textarea id="description" 
                              name="description" 
                              rows="3" 
                              class="w-full px-4 py-3 rounded-xl border border-slate-200 text-sm focus:outline-none focus:ring-2 focus:ring-brand-500/20 focus:border-brand-500 transition">{{ old('description', $class->description) }}</textarea>
                </div>

                <!-- Teacher Name & Schedule Time -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label for="teacherName" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">
                            Teacher Name
                        </label>
                        <input type="text" 
                               id="teacherName" 
                               name="teacherName" 
                               value="{{ old('teacherName', $class->teacherName) }}" 
                               class="w-full px-4 py-3 rounded-xl border border-slate-200 text-sm focus:outline-none focus:ring-2 focus:ring-brand-500/20 focus:border-brand-500 transition">
                    </div>

                    <div>
                        <label for="classTime" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">
                            Schedule / Class Time
                        </label>
                        <input type="text" 
                               id="classTime" 
                               name="classTime" 
                               value="{{ old('classTime', $class->classTime) }}" 
                               class="w-full px-4 py-3 rounded-xl border border-slate-200 text-sm focus:outline-none focus:ring-2 focus:ring-brand-500/20 focus:border-brand-500 transition">
                    </div>
                </div>

                <!-- Total Sessions & Month -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label for="sessionCount" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">
                            Total Sessions
                        </label>
                        <input type="number" 
                               id="sessionCount" 
                               name="sessionCount" 
                               value="{{ old('sessionCount', $class->sessionCount) }}" 
                               min="1" 
                               class="w-full px-4 py-3 rounded-xl border border-slate-200 text-sm focus:outline-none focus:ring-2 focus:ring-brand-500/20 focus:border-brand-500 transition">
                    </div>

                    <div>
                        <label for="month" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">
                            Month
                        </label>
                        <input type="text" 
                               id="month" 
                               name="month" 
                               value="{{ old('month', $class->month) }}" 
                               placeholder="e.g., January 2025" 
                               class="w-full px-4 py-3 rounded-xl border border-slate-200 text-sm focus:outline-none focus:ring-2 focus:ring-brand-500/20 focus:border-brand-500 transition">
                    </div>
                </div>

                <!-- Form Actions -->
                <div class="pt-4 border-t border-slate-100 flex items-center justify-end gap-3">
                    <a href="{{ route('admindashboard') }}" 
                       class="px-5 py-3 rounded-xl text-slate-600 hover:text-slate-900 font-semibold text-xs border border-slate-200 hover:bg-slate-50 transition">
                        Cancel
                    </a>

                    <button type="submit" 
                            class="inline-flex items-center gap-2 px-6 py-3 rounded-xl font-bold text-sm text-white bg-brand-500 hover:bg-brand-600 active:scale-[0.99] shadow-md shadow-brand-500/20 transition duration-150">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                        <span>Update Class</span>
                    </button>
                </div>

            </form>
        </div>

    </div>

</x-admin-layout>
