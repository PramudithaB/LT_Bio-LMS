<x-admin-layout title="User Management" subtitle="Manage registered students, exam batches, and platform administrators">

    @php
        $grouped = collect($users)
            ->groupBy(function($u){
                $y = $u->exam_year ?? 'Unspecified';
                return $y === '' ? 'Unspecified' : $y;
            })->sortKeysDesc();
    @endphp

    <!-- Header Stats Banner -->
    <div class="bg-white rounded-3xl border border-slate-200/80 p-6 shadow-xs flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <h2 class="text-xl font-bold text-slate-900 tracking-tight flex items-center gap-2">
                <span class="w-2.5 h-5 rounded-full bg-brand-500 inline-block"></span>
                Registered Students & Batches
            </h2>
            <p class="text-xs text-slate-500 mt-0.5">
                Total <strong class="text-slate-800">{{ $users->count() }}</strong> registered users across <strong class="text-slate-800">{{ $grouped->count() }}</strong> exam year groups
            </p>
        </div>

        <div class="flex items-center gap-3">
            <div class="relative">
                <input type="text" 
                       id="userSearch"
                       placeholder="Filter by name or email..." 
                       class="px-4 py-2 pl-9 rounded-xl border border-slate-200 text-xs focus:outline-none focus:ring-2 focus:ring-brand-500/20 focus:border-brand-500 transition w-56 sm:w-64">
                <svg class="w-4 h-4 text-slate-400 absolute left-3 top-2.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
            </div>

            <a href="{{ route('register') }}" 
               target="_blank"
               class="inline-flex items-center gap-1.5 px-4 py-2 rounded-xl bg-brand-500 hover:bg-brand-600 text-white font-bold text-xs shadow-xs transition whitespace-nowrap">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                <span>Register User</span>
            </a>
        </div>
    </div>

    @if($grouped->isEmpty())
        <div class="bg-white rounded-3xl border border-slate-200/80 p-12 text-center max-w-md mx-auto shadow-xs">
            <p class="text-slate-500 text-sm">No registered users found in the system.</p>
        </div>
    @else
        <div class="space-y-6">
            @foreach($grouped as $year => $usersInYear)
                <section class="bg-white rounded-3xl border border-slate-200/80 shadow-xs overflow-hidden space-y-3">
                    
                    <!-- Batch Header -->
                    <div class="p-5 bg-slate-50/80 border-b border-slate-200/80 flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            <span class="px-3 py-1 rounded-full text-xs font-black uppercase tracking-wider bg-brand-500 text-white shadow-xs">
                                {{ $year }} Batch
                            </span>
                            <span class="text-xs text-slate-500 font-semibold">
                                {{ $usersInYear->count() }} Students
                            </span>
                        </div>

                        <span class="text-[11px] text-slate-400 font-medium hidden sm:inline">
                            A/L Examination Group
                        </span>
                    </div>

                    <!-- Responsive Table -->
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse text-xs sm:text-sm user-table">
                            <thead>
                                <tr class="border-b border-slate-100 text-slate-400 font-bold uppercase text-[10px] tracking-wider">
                                    <th class="py-3 px-6 w-12">#</th>
                                    <th class="py-3 px-6">Student Name</th>
                                    <th class="py-3 px-6">Email Address</th>
                                    <th class="py-3 px-6">WhatsApp</th>
                                    <th class="py-3 px-6">NIC / ID</th>
                                    <th class="py-3 px-6">Address</th>
                                    <th class="py-3 px-6">Role</th>
                                    <th class="py-3 px-6 text-right">Joined</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-100">
                                @foreach($usersInYear as $u)
                                    @php
                                        $initials = strtoupper(substr($u->name, 0, 2));
                                        $isAdmin = ($u->usertype === 'admin');
                                    @endphp
                                    <tr class="hover:bg-slate-50/70 transition user-row">
                                        <td class="py-3.5 px-6 font-mono text-slate-400 text-xs">
                                            {{ $u->id }}
                                        </td>
                                        <td class="py-3.5 px-6 font-semibold text-slate-900 whitespace-nowrap">
                                            <div class="flex items-center gap-2.5">
                                                <div class="w-7 h-7 rounded-lg {{ $isAdmin ? 'bg-purple-600' : 'bg-brand-500' }} text-white font-bold text-[10px] flex items-center justify-center shadow-xs">
                                                    {{ $initials }}
                                                </div>
                                                <span class="user-search-name">{{ $u->name }}</span>
                                            </div>
                                        </td>
                                        <td class="py-3.5 px-6 text-slate-600 user-search-email whitespace-nowrap">
                                            {{ $u->email }}
                                        </td>
                                        <td class="py-3.5 px-6 text-slate-600 whitespace-nowrap">
                                            @if($u->whatsapp_number)
                                                <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $u->whatsapp_number) }}" target="_blank" class="text-emerald-600 hover:underline inline-flex items-center gap-1 font-mono text-xs">
                                                    {{ $u->whatsapp_number }}
                                                </a>
                                            @else
                                                <span class="text-slate-400">-</span>
                                            @endif
                                        </td>
                                        <td class="py-3.5 px-6 font-mono text-slate-600 text-xs whitespace-nowrap">
                                            {{ $u->id_number ?: '-' }}
                                        </td>
                                        <td class="py-3.5 px-6 text-slate-500 max-w-xs truncate" title="{{ $u->address }}">
                                            {{ $u->address ?: '-' }}
                                        </td>
                                        <td class="py-3.5 px-6 whitespace-nowrap">
                                            @if($isAdmin)
                                                <span class="px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-purple-100 text-purple-800">Administrator</span>
                                            @else
                                                <span class="px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-slate-100 text-slate-700">Student</span>
                                            @endif
                                        </td>
                                        <td class="py-3.5 px-6 text-right text-slate-400 font-mono text-xs whitespace-nowrap">
                                            {{ optional($u->created_at)->format('Y-m-d') }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </section>
            @endforeach
        </div>
    @endif

    <!-- Client-side real-time filter script -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const input = document.getElementById('userSearch');
            if (!input) return;

            input.addEventListener('input', function(e) {
                const q = e.target.value.toLowerCase().trim();
                const rows = document.querySelectorAll('.user-row');

                rows.forEach(row => {
                    const name = row.querySelector('.user-search-name')?.textContent.toLowerCase() || '';
                    const email = row.querySelector('.user-search-email')?.textContent.toLowerCase() || '';
                    if (name.includes(q) || email.includes(q)) {
                        row.style.display = '';
                    } else {
                        row.style.display = 'none';
                    }
                });
            });
        });
    </script>

</x-admin-layout>