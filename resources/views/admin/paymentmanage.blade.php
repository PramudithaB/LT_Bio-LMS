<x-admin-layout title="Payment Management" subtitle="Review student bank slips, verify transfers, and grant instant course access">

    @php
        $totalCheckouts = $checkouts->count();
        $approvedCount = $checkouts->where('status', 'approved')->count();
        $pendingCount = $checkouts->where('status', 'pending')->count();
        $rejectedCount = $checkouts->where('status', 'rejected')->count();
    @endphp

    <!-- Stats Ribbon -->
    <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
        <div class="bg-white rounded-3xl border border-slate-200/80 p-5 shadow-xs">
            <p class="text-[10px] font-extrabold uppercase tracking-wider text-slate-400">Total Slips</p>
            <p class="text-2xl font-black text-slate-900 mt-1">{{ $totalCheckouts }}</p>
        </div>

        <div class="bg-white rounded-3xl border border-slate-200/80 p-5 shadow-xs">
            <p class="text-[10px] font-extrabold uppercase tracking-wider text-slate-400">Pending Review</p>
            <p class="text-2xl font-black text-amber-500 mt-1">{{ $pendingCount }}</p>
        </div>

        <div class="bg-white rounded-3xl border border-slate-200/80 p-5 shadow-xs">
            <p class="text-[10px] font-extrabold uppercase tracking-wider text-slate-400">Approved Payments</p>
            <p class="text-2xl font-black text-emerald-600 mt-1">{{ $approvedCount }}</p>
        </div>

        <div class="bg-white rounded-3xl border border-slate-200/80 p-5 shadow-xs">
            <p class="text-[10px] font-extrabold uppercase tracking-wider text-slate-400">Rejected</p>
            <p class="text-2xl font-black text-red-500 mt-1">{{ $rejectedCount }}</p>
        </div>
    </div>

    <!-- Payment Slips Table Card -->
    <div class="bg-white rounded-3xl border border-slate-200/80 shadow-xs overflow-hidden space-y-4">
        <div class="p-6 border-b border-slate-100 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <div>
                <h2 class="text-lg font-bold text-slate-900 tracking-tight flex items-center gap-2">
                    <span class="w-2.5 h-5 rounded-full bg-brand-500 inline-block"></span>
                    Student Payment Verification Queue
                </h2>
                <p class="text-xs text-slate-500 mt-0.5">Click on the attached deposit slip to inspect before approving class access</p>
            </div>

            <div class="flex items-center gap-2">
                <span class="text-xs font-semibold text-slate-400">Auto-sorted by latest submissions</span>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse text-xs sm:text-sm">
                <thead>
                    <tr class="bg-slate-50/80 border-b border-slate-200 text-slate-500 font-bold uppercase text-[11px] tracking-wider">
                        <th class="py-3.5 px-6">Student</th>
                        <th class="py-3.5 px-6">Enrolled Course(s)</th>
                        <th class="py-3.5 px-6">Student Remark</th>
                        <th class="py-3.5 px-6">Deposit Slip</th>
                        <th class="py-3.5 px-6">Submission Date</th>
                        <th class="py-3.5 px-6">Status</th>
                        <th class="py-3.5 px-6 text-right">Verification Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($checkouts as $checkout)
                        @php
                            $status = $checkout->status ?? 'pending';
                            $initials = strtoupper(substr($checkout->student_name, 0, 2));
                        @endphp
                        <tr class="hover:bg-slate-50/70 transition">
                            
                            <!-- Student -->
                            <td class="py-4 px-6 font-bold text-slate-900 whitespace-nowrap">
                                <div class="flex items-center gap-2.5">
                                    <div class="w-8 h-8 rounded-xl bg-slate-800 text-white font-bold text-xs flex items-center justify-center shadow-xs">
                                        {{ $initials }}
                                    </div>
                                    <div>
                                        <p class="font-bold text-slate-900">{{ $checkout->student_name }}</p>
                                        @if($checkout->user_id)
                                            <p class="text-[10px] text-slate-400 font-mono">User #{{ $checkout->user_id }}</p>
                                        @endif
                                    </div>
                                </div>
                            </td>

                            <!-- Course Name -->
                            <td class="py-4 px-6 font-semibold text-slate-800 whitespace-nowrap">
                                <span class="px-2.5 py-1 rounded-lg bg-slate-100 text-slate-700 text-xs font-bold">
                                    {{ $checkout->class_name }}
                                </span>
                            </td>

                            <!-- Remark -->
                            <td class="py-4 px-6 text-slate-500 max-w-xs truncate">
                                {{ $checkout->remark ?: '-' }}
                            </td>

                            <!-- Deposit Slip File Link -->
                            <td class="py-4 px-6 whitespace-nowrap">
                                @if($checkout->file_path)
                                    <a href="{{ route('storage.file', ['encoded' => base64_encode($checkout->file_path)]) }}" 
                                       target="_blank" 
                                       class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-xl bg-bio-50 hover:bg-bio-100 text-bio-700 font-bold text-xs border border-bio-200/70 transition">
                                        <svg class="w-4 h-4 text-bio-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                        <span>View Slip</span>
                                    </a>
                                @else
                                    <span class="text-slate-400 italic">No file</span>
                                @endif
                            </td>

                            <!-- Submission Date -->
                            <td class="py-4 px-6 text-slate-600 font-mono text-xs whitespace-nowrap">
                                {{ optional($checkout->created_at)->format('Y-m-d H:i') }}
                            </td>

                            <!-- Status Badge -->
                            <td class="py-4 px-6 whitespace-nowrap">
                                @if($status === 'approved')
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-bold bg-emerald-100 text-emerald-800">
                                        <svg class="w-3 h-3 text-emerald-600" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" /></svg>
                                        Approved
                                    </span>
                                @elseif($status === 'rejected')
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-bold bg-red-100 text-red-800">
                                        <svg class="w-3 h-3 text-red-600" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" /></svg>
                                        Rejected
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
                                    
                                    <!-- Approve Form -->
                                    <form action="{{ route('payment.approve', $checkout->id) }}" method="POST" class="inline-block">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" 
                                                class="inline-flex items-center gap-1 px-3 py-1.5 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-xs shadow-xs transition disabled:opacity-50"
                                                {{ $status === 'approved' ? 'disabled' : '' }}>
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                            <span>Approve</span>
                                        </button>
                                    </form>

                                    <!-- Reject Form -->
                                    <form action="{{ route('payment.reject', $checkout->id) }}" method="POST" class="inline-block">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" 
                                                class="inline-flex items-center gap-1 px-3 py-1.5 rounded-xl bg-slate-100 hover:bg-red-50 text-slate-700 hover:text-red-600 border border-slate-200 hover:border-red-200 font-bold text-xs transition disabled:opacity-50"
                                                {{ $status === 'rejected' ? 'disabled' : '' }}>
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                                            <span>Reject</span>
                                        </button>
                                    </form>

                                </div>
                            </td>

                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="py-10 text-center text-slate-400">
                                No payment submissions found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</x-admin-layout>
