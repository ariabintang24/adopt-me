<div class="bg-white rounded-3xl shadow-md overflow-hidden">

    @php
        $image = optional($animal->images)->first();
    @endphp

    {{-- IMAGE --}}
    <div class="relative">
        <img src="{{ $image ? asset('storage/' . $image->image) : asset('images/no-data.png') }}"
            class="w-full h-80 object-cover" alt="{{ $animal->name }}">

        {{-- Status Badge --}}
        <div class="absolute top-4 left-4">
            <span
                class="px-4 py-1.5 rounded-full text-sm font-medium
                {{ $animal->status === 'available' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                {{ ucfirst($animal->status) }}
            </span>
        </div>
    </div>

    {{-- CONTENT --}}
    <div class="p-8">

        <h2 class="text-3xl font-bold mb-6">
            {{ $animal->name }}
        </h2>

        <div class="space-y-4 text-gray-600 text-sm">

            <div class="flex justify-between">
                <span class="font-medium text-gray-700">Category</span>
                <span>{{ $animal->category->name ?? '-' }}</span>
            </div>

            <div class="flex justify-between">
                <span class="font-medium text-gray-700">Age</span>
                <span>{{ $animal->age }}</span>
            </div>

            <div class="flex justify-between">
                <span class="font-medium text-gray-700">Gender</span>
                <span>{{ ucfirst($animal->gender) }}</span>
            </div>

        </div>

    </div>
</div>
