<x-admin-layout title="Edit Lesson: {{ $lesson->name }}" subtitle="Modify video URL, attached worksheets, notices, or paid status">

    <div class="max-w-4xl mx-auto space-y-6">

        <!-- Header Back Bar -->
        <div class="flex items-center justify-between">
            <a href="{{ route('admindashboard') }}" 
               class="inline-flex items-center gap-2 text-xs font-bold text-slate-600 hover:text-brand-500 bg-white hover:bg-slate-50 border border-slate-200 px-4 py-2 rounded-xl transition shadow-xs">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                <span>Back to Dashboard</span>
            </a>

            <span class="text-xs font-mono text-slate-400">Lesson ID #{{ $lesson->id }}</span>
        </div>

        <!-- Edit Form Card -->
        <div class="bg-white rounded-3xl border border-slate-200/80 p-6 sm:p-8 shadow-xs">
            <form action="{{ route('lesson.update', $lesson->id) }}" method="POST" enctype="multipart/form-data" class="space-y-5">
                @csrf
                @method('PUT')

                <!-- Class Selection -->
                <div>
                    <label for="class_id" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">
                        Class / Course <span class="text-red-500">*</span>
                    </label>
                    <select id="class_id" 
                            name="class_id" 
                            class="w-full px-4 py-3 rounded-xl border border-slate-200 text-sm focus:outline-none focus:ring-2 focus:ring-brand-500/20 focus:border-brand-500 transition bg-white" 
                            required>
                        @foreach($classes as $c)
                            <option value="{{ $c->id }}" {{ old('class_id', $lesson->class_id) == $c->id ? 'selected' : '' }}>
                                {{ $c->className }} @if($c->month) ({{ $c->month }}) @endif
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Lesson Name -->
                <div>
                    <label for="name" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">
                        Lesson Name <span class="text-red-500">*</span>
                    </label>
                    <input type="text" 
                           id="name" 
                           name="name" 
                           value="{{ old('name', $lesson->name) }}" 
                           class="w-full px-4 py-3 rounded-xl border border-slate-200 text-sm focus:outline-none focus:ring-2 focus:ring-brand-500/20 focus:border-brand-500 transition font-semibold" 
                           required>
                </div>

                <!-- Description -->
                <div>
                    <label for="description" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">
                        Description
                    </label>
                    <textarea id="description" 
                              name="description" 
                              rows="3" 
                              class="w-full px-4 py-3 rounded-xl border border-slate-200 text-sm focus:outline-none focus:ring-2 focus:ring-brand-500/20 focus:border-brand-500 transition">{{ old('description', $lesson->description) }}</textarea>
                </div>

                <!-- Video Link -->
                <div>
                    <label for="link" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">
                        YouTube Video Link / URL
                    </label>
                    <div class="relative">
                        <input type="text" 
                               id="link" 
                               name="link" 
                               value="{{ old('link', $lesson->link) }}" 
                               class="w-full px-4 py-3 pl-10 rounded-xl border border-slate-200 text-sm focus:outline-none focus:ring-2 focus:ring-brand-500/20 focus:border-brand-500 transition font-mono text-xs">
                        <svg class="w-5 h-5 text-red-500 absolute left-3 top-3.5" fill="currentColor" viewBox="0 0 24 24"><path d="M10 15l5.19-3L10 9v6m11.56-7.83c.13.47.22 1.1.28 1.9.07.8.1 1.49.1 2.09L22 12c0 2.19-.16 3.8-.44 4.83-.25.9-.83 1.48-1.73 1.73-.47.13-1.33.22-2.65.28-1.3.07-2.49.1-3.59.1L12 22c-4.19 0-6.8-.16-7.83-.44-.9-.25-1.48-.83-1.73-1.73-.13-.47-.22-1.1-.28-1.9-.07-.8-.1-1.49-.1-2.09L2 12c0-2.19.16-3.8.44-4.83.25-.9.83-1.48 1.73-1.73.47-.13 1.33-.22 2.65-.28 1.3-.07 2.49-.1 3.59-.1L12 2c4.19 0 6.8.16 7.83.44.9.25 1.48.83 1.73 1.73z"/></svg>
                    </div>
                </div>

                <!-- Attached File -->
                <div>
                    <label for="file" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">
                        Attached Lecture Notes / PDF File
                    </label>

                    @if($lesson->file_path)
                        <div class="mb-3 p-3 rounded-xl bg-slate-50 border border-slate-200 flex items-center justify-between text-xs">
                            <div class="flex items-center gap-2 text-slate-700">
                                <svg class="w-4 h-4 text-bio-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                                <span class="font-medium">Current file: {{ basename($lesson->file_path) }}</span>
                            </div>
                            <a href="{{ route('storage.file', ['encoded' => base64_encode($lesson->file_path)]) }}" target="_blank" class="text-xs font-bold text-bio-600 hover:underline">Download</a>
                        </div>
                    @endif

                    <input type="file" 
                           id="file" 
                           name="file" 
                           accept="application/pdf,image/*" 
                           class="w-full text-xs text-slate-500 file:mr-4 file:py-2.5 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-brand-50 file:text-brand-600 hover:file:bg-brand-100">
                    <p class="text-[11px] text-slate-400 mt-1">Leave empty to keep current file (if one exists).</p>
                </div>

                <!-- Notice -->
                <div>
                    <label for="notice" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">
                        Notice for Students
                    </label>
                    <textarea id="notice" 
                              name="notice" 
                              rows="2" 
                              class="w-full px-4 py-3 rounded-xl border border-slate-200 text-sm focus:outline-none focus:ring-2 focus:ring-brand-500/20 focus:border-brand-500 transition">{{ old('notice', $lesson->notice) }}</textarea>
                </div>

                <!-- Paid Version -->
                <div>
                    <label for="is_paid" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">
                        Access Level <span class="text-red-500">*</span>
                    </label>
                    <select id="is_paid" 
                            name="is_paid" 
                            class="w-full px-4 py-3 rounded-xl border border-slate-200 text-sm focus:outline-none focus:ring-2 focus:ring-brand-500/20 focus:border-brand-500 transition bg-white" 
                            required>
                        <option value="1" {{ old('is_paid', $lesson->is_paid) == 1 ? 'selected' : '' }}>Yes (Paid Lesson)</option>
                        <option value="0" {{ old('is_paid', $lesson->is_paid) == 0 ? 'selected' : '' }}>No (Free Preview)</option>
                    </select>
                </div>

                <!-- Actions -->
                <div class="pt-4 border-t border-slate-100 flex items-center justify-end gap-3">
                    <a href="{{ route('admindashboard') }}" 
                       class="px-5 py-3 rounded-xl text-slate-600 hover:text-slate-900 font-semibold text-xs border border-slate-200 hover:bg-slate-50 transition">
                        Cancel
                    </a>

                    <button type="submit" 
                            class="inline-flex items-center gap-2 px-6 py-3 rounded-xl font-bold text-sm text-white bg-purple-600 hover:bg-purple-700 active:scale-[0.99] shadow-md shadow-purple-600/20 transition duration-150">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                        <span>Update Lesson</span>
                    </button>
                </div>

            </form>
        </div>

    </div>

</x-admin-layout>
