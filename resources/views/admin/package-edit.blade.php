<x-admin-layout title="Edit Package: {{ $package->package_name }}" subtitle="Update fee structure or course association">

    <div class="max-w-3xl mx-auto space-y-6">

        <!-- Header Back Bar -->
        <div class="flex items-center justify-between">
            <a href="{{ route('admindashboard') }}" 
               class="inline-flex items-center gap-2 text-xs font-bold text-slate-600 hover:text-brand-500 bg-white hover:bg-slate-50 border border-slate-200 px-4 py-2 rounded-xl transition shadow-xs">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                <span>Back to Dashboard</span>
            </a>

            <span class="text-xs font-mono text-slate-400">Package ID #{{ $package->id }}</span>
        </div>

        <!-- Form Card -->
        <div class="bg-white rounded-3xl border border-slate-200/80 p-6 sm:p-8 shadow-xs">
            <form action="{{ route('package.update', $package->id) }}" method="POST" class="space-y-5">
                @csrf
                @method('PUT')

                <!-- Class Selection -->
                <div>
                    <label for="class_id" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">
                        Linked Class <span class="text-red-500">*</span>
                    </label>
                    <select id="class_id" 
                            name="class_id" 
                            class="w-full px-4 py-3 rounded-xl border border-slate-200 text-sm focus:outline-none focus:ring-2 focus:ring-brand-500/20 focus:border-brand-500 transition bg-white" 
                            required>
                        @foreach($classes as $c)
                            <option value="{{ $c->id }}" {{ old('class_id', $package->class_id) == $c->id ? 'selected' : '' }}>
                                {{ $c->className }} @if($c->month) ({{ $c->month }}) @endif
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Monthly Fee -->
                <div>
                    <label for="monthly_fee" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">
                        Monthly Fee (Rs.) <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <span class="absolute left-4 top-3.5 text-xs font-bold text-slate-400">Rs.</span>
                        <input type="number" 
                               id="monthly_fee" 
                               name="monthly_fee" 
                               value="{{ old('monthly_fee', $package->monthly_fee) }}" 
                               min="0" 
                               class="w-full px-4 py-3 pl-11 rounded-xl border border-slate-200 text-sm focus:outline-none focus:ring-2 focus:ring-brand-500/20 focus:border-brand-500 transition font-bold" 
                               required>
                    </div>
                </div>

                <!-- Description -->
                <div>
                    <label for="description" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">
                        Description
                    </label>
                    <textarea id="description" 
                              name="description" 
                              rows="3" 
                              class="w-full px-4 py-3 rounded-xl border border-slate-200 text-sm focus:outline-none focus:ring-2 focus:ring-brand-500/20 focus:border-brand-500 transition">{{ old('description', $package->description) }}</textarea>
                </div>

                <!-- Form Actions -->
                <div class="pt-4 border-t border-slate-100 flex items-center justify-end gap-3">
                    <a href="{{ route('admindashboard') }}" 
                       class="px-5 py-3 rounded-xl text-slate-600 hover:text-slate-900 font-semibold text-xs border border-slate-200 hover:bg-slate-50 transition">
                        Cancel
                    </a>

                    <button type="submit" 
                            class="inline-flex items-center gap-2 px-6 py-3 rounded-xl font-bold text-sm text-white bg-amber-600 hover:bg-amber-700 active:scale-[0.99] shadow-md shadow-amber-600/20 transition duration-150">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                        <span>Update Package</span>
                    </button>
                </div>

            </form>
        </div>

    </div>

</x-admin-layout>
