<div class="bg-white rounded-2xl shadow hover:shadow-lg transition overflow-hidden">

    <a href="/animals/{{ $animal->slug }}">

        <img src="{{ $animal->images->first()->image ?? 'https://via.placeholder.com/400' }}"
            class="w-full h-48 object-cover" alt="{{ $animal->name }}">

        <div class="p-4">

            <h3 class="font-semibold text-lg">
                {{ $animal->name }}
            </h3>

            <p class="text-sm text-gray-500 mt-1">
                {{ $animal->age }} year(s) • {{ ucfirst($animal->gender) }}
            </p>

            <span class="inline-block mt-3 text-xs bg-green-100 text-green-700 px-3 py-1 rounded-full">
                Available
            </span>

        </div>
    </a>

</div>
