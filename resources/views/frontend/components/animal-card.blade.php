<div class="bg-white rounded-3xl shadow-md hover:shadow-xl transition duration-300 overflow-hidden">

    <a href="/animals/{{ $animal->slug }}">

        {{-- Image --}}
        <div class="overflow-hidden">
            <img src="{{ $animal->images->first()
                ? asset('storage/' . $animal->images->first()->image)
                : 'https://via.placeholder.com/600x400' }}"
                class="w-full h-64 object-cover hover:scale-105 transition duration-500" alt="{{ $animal->name }}">
        </div>

        {{-- Content --}}
        <div class="p-6">

            {{-- Small Info Row --}}
            <div class="flex justify-between items-center text-sm text-gray-500 mb-3">

                <div class="flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-green-500" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17.657 16.657L13.414 12.414a4 4 0 10-5.657 5.657l4.243 4.243a8 8 0 1111.314 0z" />
                    </svg>
                    <span>
                        {{ $animal->category->name ?? 'Unknown' }}
                    </span>
                </div>

                <span>
                    {{ $animal->age }} year(s)
                </span>

            </div>

            {{-- Title --}}
            <h3 class="text-lg font-semibold text-gray-800">
                {{ $animal->name }}
            </h3>

            {{-- Gender --}}
            <p class="text-sm text-gray-500 mt-1">
                {{ ucfirst($animal->gender) }}
            </p>

            {{-- Status Badge --}}
            <div class="mt-4">
                <span class="inline-block bg-green-100 text-green-700 text-xs font-medium px-4 py-1.5 rounded-full">
                    Available
                </span>
            </div>

        </div>

    </a>

</div>
