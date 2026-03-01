<div x-data="{
    isFavorite: true,
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
            .then(() => {
                window.dispatchEvent(new CustomEvent('toast-success', {
                    detail: 'Removed ❌ from favorites.'
                }));

                $el.remove();
            })
            .finally(() => this.loading = false)
    }
}"
    class="relative group bg-white rounded-2xl shadow hover:shadow-xl transition overflow-hidden">

    {{-- ❤️ Remove Favorite --}}
    <button type="button" @click.prevent.stop="toggle()"
        class="absolute top-3 right-3 z-30 bg-white rounded-full p-2 shadow-md hover:scale-110 transition">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5 text-red-500">
            <path
                d="M11.645 20.91l-.345-.314C5.4 15.36 2 12.28 2 8.5 2 6 4 4 6.5 4c1.54 0 3.04.81 3.87 2.09C11.46 4.81 12.96 4 14.5 4 17 4 19 6 19 8.5c0 3.78-3.4 6.86-9.3 12.09l-.355.32z" />
        </svg>
    </button>

    <a href="{{ route('animals.show', $animal->slug) }}">

        {{-- IMAGE (KOTAK) --}}
        <div class="aspect-square overflow-hidden">
            @php $image = optional($animal->images)->first(); @endphp

            <img src="{{ $image ? asset('storage/' . $image->image) : asset('images/no-data.png') }}"
                class="w-full h-full object-cover transition duration-500 group-hover:scale-105"
                alt="{{ $animal->name }}">
        </div>

        {{-- CONTENT (COMPACT) --}}
        <div class="p-4">

            <h3 class="text-base font-semibold text-gray-800">
                {{ $animal->name }}
            </h3>

            <div class="mt-3">
                <span
                    class="inline-block
                    {{ $animal->status === 'available' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}
                    text-xs font-medium px-3 py-1 rounded-full">
                    {{ ucfirst($animal->status) }}
                </span>
            </div>

        </div>
    </a>
</div>
