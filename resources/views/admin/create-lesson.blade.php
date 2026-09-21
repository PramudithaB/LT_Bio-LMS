<x-admin-layout title="Create Lesson" subtitle="Upload a new lecture video link, lesson notes PDF, and student notices">

    <div class="max-w-4xl mx-auto space-y-6">

        <!-- Header Bar -->
        <div class="bg-gradient-to-r from-slate-900 via-slate-800 to-slate-900 text-white rounded-3xl p-6 sm:p-8 shadow-lg border border-slate-800 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <div class="space-y-1">
                <span class="px-2.5 py-0.5 rounded-md text-[10px] font-extrabold uppercase tracking-wider bg-purple-500 text-white">Lesson Authoring</span>
                <h2 class="text-xl sm:text-2xl font-black text-white">Add New Lecture Module</h2>
                <p class="text-xs text-slate-300">Publish YouTube video streams and attach syllabus theory worksheets</p>
            </div>

            <a href="{{ route('admindashboard') }}" 
               class="inline-flex items-center gap-1.5 px-4 py-2 rounded-xl bg-slate-800 hover:bg-slate-700 text-white font-bold text-xs border border-slate-700 transition self-start sm:self-auto">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                <span>View Dashboard</span>
            </a>
        </div>

        <!-- Form Card -->
        <div class="bg-white rounded-3xl border border-slate-200/80 p-6 sm:p-8 shadow-xs">
            <form action="{{ route('lesson.lessonstore') }}" method="POST" enctype="multipart/form-data" class="space-y-5">
                @csrf

                <!-- Select Class -->
                <div>
                    <label for="class_id" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">
                        Assign to Class / Course <span class="text-red-500">*</span>
                    </label>
                    <select id="class_id" 
                            name="class_id" 
                            class="w-full px-4 py-3 rounded-xl border border-slate-200 text-sm focus:outline-none focus:ring-2 focus:ring-brand-500/20 focus:border-brand-500 transition bg-white" 
                            required>
                        <option value="" disabled selected>-- Select Target Class --</option>
                        @foreach($classes as $c)
                            <option value="{{ $c->id }}" {{ old('class_id') == $c->id ? 'selected' : '' }}>
                                {{ $c->className }} @if($c->month) ({{ $c->month }}) @endif
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Lesson Name -->
                <div>
                    <label for="name" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">
                        Lesson / Lecture Title <span class="text-red-500">*</span>
                    </label>
                    <input type="text" 
                           id="name" 
                           name="name" 
                           value="{{ old('name') }}" 
                           placeholder="e.g., Lesson 01: Introduction to Cell Biology & Microscopy" 
                           class="w-full px-4 py-3 rounded-xl border border-slate-200 text-sm focus:outline-none focus:ring-2 focus:ring-brand-500/20 focus:border-brand-500 transition font-semibold" 
                           required>
                </div>

                <!-- Description -->
                <div>
                    <label for="description" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">
                        Lesson Overview & Description
                    </label>
                    <textarea id="description" 
                              name="description" 
                              rows="3" 
                              placeholder="Key topics discussed in this video session..." 
                              class="w-full px-4 py-3 rounded-xl border border-slate-200 text-sm focus:outline-none focus:ring-2 focus:ring-brand-500/20 focus:border-brand-500 transition">{{ old('description') }}</textarea>
                </div>

                <!-- Video / External Link -->
                <div>
                    <label for="link" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">
                        YouTube Video URL / Embed Link
                    </label>
                    <div class="relative">
                        <input type="text" 
                               id="link" 
                               name="link" 
                               value="{{ old('link') }}" 
                               placeholder="e.g., https://www.youtube.com/watch?v=fiV0SrYa_lM or https://youtu.be/fiV0SrYa_lM" 
                               class="w-full px-4 py-3 pl-10 rounded-xl border border-slate-200 text-sm focus:outline-none focus:ring-2 focus:ring-brand-500/20 focus:border-brand-500 transition">
                        <svg class="w-5 h-5 text-red-500 absolute left-3 top-3.5" fill="currentColor" viewBox="0 0 24 24"><path d="M10 15l5.19-3L10 9v6m11.56-7.83c.13.47.22 1.1.28 1.9.07.8.1 1.49.1 2.09L22 12c0 2.19-.16 3.8-.44 4.83-.25.9-.83 1.48-1.73 1.73-.47.13-1.33.22-2.65.28-1.3.07-2.49.1-3.59.1L12 22c-4.19 0-6.8-.16-7.83-.44-.9-.25-1.48-.83-1.73-1.73-.13-.47-.22-1.1-.28-1.9-.07-.8-.1-1.49-.1-2.09L2 12c0-2.19.16-3.8.44-4.83.25-.9.83-1.48 1.73-1.73.47-.13 1.33-.22 2.65-.28 1.3-.07 2.49-.1 3.59-.1L12 2c4.19 0 6.8.16 7.83.44.9.25 1.48.83 1.73 1.73z"/></svg>
                    </div>
                    <p class="text-[11px] text-slate-400 mt-1">Supports standard YouTube URLs, short links, or direct 11-char video IDs.</p>
                </div>

                <!-- PDF / File Attachment Dropzone -->
                <div>
                    <label for="file" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">
                        Lecture Worksheet / PDF Notes
                    </label>
                    <div class="border-2 border-dashed border-slate-200 hover:border-brand-500 rounded-2xl p-5 text-center transition bg-slate-50/50 hover:bg-white relative">
                        <input type="file" 
                               id="file" 
                               name="file" 
                               accept="application/pdf,image/*" 
                               class="absolute inset-0 w-full h-full opacity-0 cursor-pointer">
                        <div class="space-y-1 pointer-events-none">
                            <svg class="w-8 h-8 text-slate-400 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/></svg>
                            <p class="text-xs font-semibold text-slate-700">Click or drag & drop lecture PDF / Image</p>
                            <p class="text-[10px] text-slate-400">PDF, JPG, PNG up to 4MB</p>
                        </div>
                    </div>
                </div>

                <!-- Notice -->
                <div>
                    <label for="notice" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">
                        Teacher Callout Notice (Optional)
                    </label>
                    <textarea id="notice" 
                              name="notice" 
                              rows="2" 
                              placeholder="e.g., Please complete questions 1–15 from the attached tute before attending the next live discussion..." 
                              class="w-full px-4 py-3 rounded-xl border border-slate-200 text-sm focus:outline-none focus:ring-2 focus:ring-brand-500/20 focus:border-brand-500 transition">{{ old('notice') }}</textarea>
                </div>

                <!-- Paid or Free Access Flag -->
                <div>
                    <label for="is_paid" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">
                        Access Level <span class="text-red-500">*</span>
                    </label>
                    <select id="is_paid" 
                            name="is_paid" 
                            class="w-full px-4 py-3 rounded-xl border border-slate-200 text-sm focus:outline-none focus:ring-2 focus:ring-brand-500/20 focus:border-brand-500 transition bg-white" 
                            required>
                        <option value="1" {{ old('is_paid', '1') == '1' ? 'selected' : '' }}>Yes (Paid - Requires Enrolled & Approved Checkout)</option>
                        <option value="0" {{ old('is_paid') == '0' ? 'selected' : '' }}>No (Free - Public Student Preview)</option>
                    </select>
                </div>

                <!-- Form Actions -->
                <div class="pt-4 border-t border-slate-100 flex items-center justify-end gap-3">
                    <a href="{{ route('admindashboard') }}" 
                       class="px-5 py-3 rounded-xl text-slate-600 hover:text-slate-900 font-semibold text-xs border border-slate-200 hover:bg-slate-50 transition">
                        Cancel
                    </a>

                    <button type="submit" 
                            class="inline-flex items-center gap-2 px-6 py-3 rounded-xl font-bold text-sm text-white bg-purple-600 hover:bg-purple-700 active:scale-[0.99] shadow-md shadow-purple-600/20 transition duration-150">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                        <span>Publish Lesson</span>
                    </button>
                </div>

            </form>
        </div>

    </div>

</x-admin-layout>
