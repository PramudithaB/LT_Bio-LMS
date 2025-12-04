

<h2 class="text-3xl font-bold mb-6">Create Package</h2>

<form action="{{ route('package.store') }}" method="POST" class="space-y-4 bg-white p-6 rounded-xl shadow">
    @csrf

    <div>
        <label class="font-semibold">Package Name</label>
        <input type="text" name="package_name" class="w-full border p-2 rounded" required>
    </div>

    <div>
        <label class="font-semibold">Monthly Fee (Rs.)</label>
        <input type="number" name="monthly_fee" class="w-full border p-2 rounded" required>
    </div>

    <div>
        <label class="font-semibold">Description</label>
        <textarea name="description" class="w-full border p-2 rounded"></textarea>
    </div>

    <button class="bg-primary-purple text-white px-6 py-2 rounded-lg hover:bg-dark-purple">
        Create Package
    </button>
</form>

