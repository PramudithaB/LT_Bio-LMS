<x-admin-layout title="Student Feedback" subtitle="Moderate student testimonials, reviews, and website feedback">

    <!-- Header Stats Card -->
    <div class="bg-white rounded-3xl border border-slate-200/80 p-6 shadow-xs flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <h2 class="text-xl font-bold text-slate-900 tracking-tight flex items-center gap-2">
                <span class="w-2.5 h-5 rounded-full bg-brand-500 inline-block"></span>
                Student Feedback & Testimonials
            </h2>
            <p class="text-xs text-slate-500 mt-0.5">
                Total <strong class="text-slate-800">{{ count($feedbacks) }}</strong> submitted reviews from students
            </p>
        </div>

        <div class="flex items-center gap-2">
            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-emerald-50 text-emerald-700 border border-emerald-100">
                <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                {{ collect($feedbacks)->where('status', 'approved')->count() }} Approved
            </span>

            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-amber-50 text-amber-700 border border-amber-100">
                <span class="w-1.5 h-1.5 rounded-full bg-amber-500"></span>
                {{ collect($feedbacks)->where('status', '!=', 'approved')->count() }} Pending
            </span>
        </div>
    </div>

    <!-- Feedback Table Card -->
    <div class="bg-white rounded-3xl border border-slate-200/80 shadow-xs overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse text-xs sm:text-sm">
                <thead>
                    <tr class="bg-slate-50/80 border-b border-slate-200 text-slate-500 font-bold uppercase text-[11px] tracking-wider">
                        <th class="py-3.5 px-6">Student</th>
                        <th class="py-3.5 px-6">Message / Testimonial</th>
                        <th class="py-3.5 px-6">Email Address</th>
                        <th class="py-3.5 px-6">Phone Number</th>
                        <th class="py-3.5 px-6">Status</th>
                        <th class="py-3.5 px-6 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($feedbacks as $fb)
                        @php
                            $isApproved = ($fb->status === 'approved');
                            $initials = strtoupper(substr($fb->name, 0, 2));
                        @endphp
                        <tr class="hover:bg-slate-50/70 transition">
                            
                            <!-- Student Name + Avatar -->
                            <td class="py-4 px-6 font-bold text-slate-900 whitespace-nowrap">
                                <div class="flex items-center gap-2.5">
                                    <div class="w-8 h-8 rounded-xl bg-gradient-to-tr from-brand-600 to-brand-400 text-white font-bold text-xs flex items-center justify-center shadow-xs">
                                        {{ $initials }}
                                    </div>
                                    <span>{{ $fb->name }}</span>
                                </div>
                            </td>

                            <!-- Feedback Message -->
                            <td class="py-4 px-6 text-slate-700 max-w-sm">
                                <p class="line-clamp-3 leading-relaxed text-xs">{{ $fb->message }}</p>
                            </td>

                            <!-- Email -->
                            <td class="py-4 px-6 text-slate-500 whitespace-nowrap">
                                {{ $fb->email }}
                            </td>

                            <!-- Phone -->
                            <td class="py-4 px-6 font-mono text-slate-600 whitespace-nowrap">
                                {{ $fb->phone_number ?: '-' }}
                            </td>

                            <!-- Status Badge -->
                            <td class="py-4 px-6 whitespace-nowrap">
                                @if($isApproved)
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-bold bg-emerald-100 text-emerald-800">
                                        <svg class="w-3 h-3 text-emerald-600" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" /></svg>
                                        Approved
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-bold bg-amber-100 text-amber-800">
                                        <span class="w-1.5 h-1.5 rounded-full bg-amber-500 animate-pulse"></span>
                                        Pending Review
                                    </span>
                                @endif
                            </td>

                            <!-- Action Buttons -->
                            <td class="py-4 px-6 text-right whitespace-nowrap">
                                <div class="inline-flex items-center gap-2">
                                    
                                    <!-- Approve Button (if not already approved) -->
                                    @if(!$isApproved)
                                        <form action="{{ route('feedbackapprove', $fb->id) }}" method="POST" class="inline-block">
                                            @csrf
                                            @method('PUT')
                                            <button type="submit" 
                                                    class="inline-flex items-center gap-1 px-3 py-1.5 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-xs shadow-xs transition">
                                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                                <span>Approve</span>
                                            </button>
                                        </form>
                                    @endif

                                    <!-- Delete Button -->
                                    <form action="{{ route('feedbackdelete', $fb->id) }}" 
                                          method="POST" 
                                          class="inline-block"
                                          onsubmit="return confirm('Are you sure you want to delete this feedback?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                class="p-2 rounded-xl text-red-600 hover:bg-red-50 border border-slate-200 hover:border-red-200 transition"
                                                title="Delete Feedback">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                        </button>
                                    </form>

                                </div>
                            </td>

                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="py-10 text-center text-slate-400">
                                No feedback submissions found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</x-admin-layout>
