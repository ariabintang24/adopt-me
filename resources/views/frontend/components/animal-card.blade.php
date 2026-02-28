<div x-data="{
    isFavorite: @json(auth()->check() && auth()->user()->favorites->contains($animal->id)),
    loading: false,
    toggle() {
        if (this.loading) return;
        this.loading = true;

        fetch('{{ route('favorite.toggle', $animal->id) }}', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json'
                }
            })
            .then(res => res.json())
            .then(data => {
                this.isFavorite = !this.isFavorite;
            })
            .finally(() => {
                this.loading = false;
            })
    }
}"
    class="relative group bg-white rounded-2xl shadow hover:shadow-xl transition overflow-hidden">

    {{-- ❤️ Favorite Button --}}
    <button type="button" @click.prevent.stop="toggle()"
        class="absolute top-4 right-4 z-30 bg-white rounded-full p-2 shadow-md hover:scale-110 transition pointer-events-auto">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
            :class="isFavorite ? 'text-red-500 scale-110' : 'text-gray-300'" class="w-6 h-6 transition duration-200">
            <path
                d="M11.645 20.91l-.345-.314C5.4 15.36 2 12.28 2 8.5 2 6 4 4 6.5 4c1.54 0 3.04.81 3.87 2.09C11.46 4.81 12.96 4 14.5 4 17 4 19 6 19 8.5c0 3.78-3.4 6.86-9.3 12.09l-.355.32z" />
        </svg>
    </button>

    <a href="/animals/{{ $animal->slug }}">

        {{-- Image --}}
        <div class="overflow-hidden">
            @php
                $image = optional($animal->images)->first();
            @endphp

            <img src="{{ $image ? asset('storage/' . $image->image) : asset('images/no-data.png') }}"
                class="w-full h-64 object-cover transition duration-500 group-hover:scale-105"
                alt="{{ $animal->name }}">
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
