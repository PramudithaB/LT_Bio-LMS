<x-admin-layout title="Create Package" subtitle="Configure a monthly class fee package for student online purchase">

    <div class="max-w-3xl mx-auto space-y-6">

        <!-- Header Bar -->
        <div class="bg-gradient-to-r from-slate-900 via-slate-800 to-slate-900 text-white rounded-3xl p-6 sm:p-8 shadow-lg border border-slate-800 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <div class="space-y-1">
                <span class="px-2.5 py-0.5 rounded-md text-[10px] font-extrabold uppercase tracking-wider bg-amber-500 text-white">Pricing & Enrollment</span>
                <h2 class="text-xl sm:text-2xl font-black text-white">Create New Package</h2>
                <p class="text-xs text-slate-300">Link a monthly fee to an existing biology course for student checkout</p>
            </div>

            <a href="{{ route('admindashboard') }}" 
               class="inline-flex items-center gap-1.5 px-4 py-2 rounded-xl bg-slate-800 hover:bg-slate-700 text-white font-bold text-xs border border-slate-700 transition self-start sm:self-auto">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                <span>View Dashboard</span>
            </a>
        </div>

        <!-- Form Card -->
        <div class="bg-white rounded-3xl border border-slate-200/80 p-6 sm:p-8 shadow-xs">
            <form action="{{ route('package.store') }}" method="POST" class="space-y-5">
                @csrf

                <!-- Select Class -->
                <div>
                    <label for="class_id" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">
                        Link to Class / Course <span class="text-red-500">*</span>
                    </label>
                    <select id="class_id" 
                            name="class_id" 
                            class="w-full px-4 py-3 rounded-xl border border-slate-200 text-sm focus:outline-none focus:ring-2 focus:ring-brand-500/20 focus:border-brand-500 transition bg-white" 
                            required>
                        <option value="" disabled selected>-- Select Course to Link --</option>
                        @foreach($classes as $c)
                            <option value="{{ $c->id }}" {{ old('class_id') == $c->id ? 'selected' : '' }}>
                                {{ $c->className }} @if($c->month) ({{ $c->month }}) @endif
                            </option>
                        @endforeach
                    </select>
                    <p class="text-[11px] text-slate-400 mt-1">Package name will automatically inherit the selected class title.</p>
                </div>

                <!-- Monthly Fee -->
                <div>
                    <label for="monthly_fee" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">
                        Monthly Fee in Sri Lankan Rupees (Rs.) <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <span class="absolute left-4 top-3.5 text-xs font-bold text-slate-400">Rs.</span>
                        <input type="number" 
                               id="monthly_fee" 
                               name="monthly_fee" 
                               value="{{ old('monthly_fee') }}" 
                               placeholder="e.g., 2500" 
                               min="0" 
                               class="w-full px-4 py-3 pl-11 rounded-xl border border-slate-200 text-sm focus:outline-none focus:ring-2 focus:ring-brand-500/20 focus:border-brand-500 transition font-bold" 
                               required>
                    </div>
                </div>

                <!-- Description -->
                <div>
                    <label for="description" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">
                        Package Description (Optional)
                    </label>
                    <textarea id="description" 
                              name="description" 
                              rows="3" 
                              placeholder="Add special notes or perks included in this monthly package..." 
                              class="w-full px-4 py-3 rounded-xl border border-slate-200 text-sm focus:outline-none focus:ring-2 focus:ring-brand-500/20 focus:border-brand-500 transition">{{ old('description') }}</textarea>
                </div>

                <!-- Form Actions -->
                <div class="pt-4 border-t border-slate-100 flex items-center justify-end gap-3">
                    <a href="{{ route('admindashboard') }}" 
                       class="px-5 py-3 rounded-xl text-slate-600 hover:text-slate-900 font-semibold text-xs border border-slate-200 hover:bg-slate-50 transition">
                        Cancel
                    </a>

                    <button type="submit" 
                            class="inline-flex items-center gap-2 px-6 py-3 rounded-xl font-bold text-sm text-white bg-amber-600 hover:bg-amber-700 active:scale-[0.99] shadow-md shadow-amber-600/20 transition duration-150">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                        <span>Create Package</span>
                    </button>
                </div>

            </form>
        </div>

    </div>

</x-admin-layout>
