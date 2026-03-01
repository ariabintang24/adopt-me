<div x-data="{
    isLoggedIn: {{ auth()->check() ? 'true' : 'false' }},
    isFavorite: {{ auth()->check() ? (auth()->user()->favorites->contains($animal->id) ? 'true' : 'false') : 'false' }},
    loading: false,

    async toggle() {
        if (!this.isLoggedIn) {
            window.dispatchEvent(new CustomEvent('toast-error', {
                detail: 'Oops! You need to log in to add favorites.'
            }));
            return;
        }

        if (this.loading) return;
        this.loading = true;

        const res = await fetch('{{ route('favorite.toggle', $animal->id) }}', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json'
            }
        });

        if (res.ok) {
            this.isFavorite = !this.isFavorite;

            window.dispatchEvent(new CustomEvent('toast-success', {
                detail: this.isFavorite ?
                    'Added ✅ to favorites.' :
                    'Removed ❌ from favorites.'
            }));
        }

        this.loading = false;
    }
}"
    class="relative group bg-white rounded-2xl shadow hover:shadow-xl transition overflow-hidden">

    {{-- ❤️ Favorite Button --}}
    <button type="button" @click.prevent.stop="toggle()"
        class="absolute top-4 right-4 z-30 bg-white rounded-full p-2 shadow-md hover:scale-110 transition">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
            :class="isFavorite ? 'text-red-500 scale-110' : 'text-gray-300'" class="w-6 h-6 transition duration-200">
            <path
                d="M11.645 20.91l-.345-.314C5.4 15.36 2 12.28 2 8.5 2 6 4 4 6.5 4c1.54 0 3.04.81 3.87 2.09C11.46 4.81 12.96 4 14.5 4 17 4 19 6 19 8.5c0 3.78-3.4 6.86-9.3 12.09l-.355.32z" />
        </svg>
    </button>

    <a href="{{ route('animals.show', $animal->slug) }}">

        {{-- IMAGE --}}
        <div class="overflow-hidden">
            @php $image = optional($animal->images)->first(); @endphp

            <img src="{{ $image ? asset('storage/' . $image->image) : asset('images/no-data.png') }}"
                class="w-full h-64 object-cover transition duration-500 group-hover:scale-105"
                alt="{{ $animal->name }}">
        </div>

        {{-- CONTENT --}}
        <div class="p-6">

            <div class="flex justify-between items-center text-sm text-gray-500 mb-3">
                <span>{{ $animal->category->name ?? 'Unknown' }}</span>
                <span>{{ $animal->age }} year(s)</span>
            </div>

            <h3 class="text-lg font-semibold text-gray-800">
                {{ $animal->name }}
            </h3>

            <p class="text-sm text-gray-500 mt-1">
                {{ ucfirst($animal->gender) }}
            </p>

            <div class="mt-4">
                <span
                    class="inline-block
                    {{ $animal->status === 'available' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}
                    text-xs font-medium px-4 py-1.5 rounded-full">
                    {{ ucfirst($animal->status) }}
                </span>
            </div>

        </div>
    </a>
</div>
