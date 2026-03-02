@extends('frontend.layouts.app')

@section('content')
    <section class="bg-gray-50 py-16">
        <div class="max-w-7xl mx-auto px-6">

            {{-- ================= HEADER CONTROL BAR ================= --}}
            <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-10 gap-6">

                <h2 class="text-2xl md:text-3xl font-bold leading-tight">
                    Available Animals 🐾
                </h2>

                <div class="flex items-center gap-3 w-full md:w-auto">

                    {{-- ================= SORT FORM (TERPISAH) ================= --}}
                    {{-- Form khusus sort agar tidak mengganggu filter & search --}}
                    <form method="GET" action="{{ route('animals.index') }}">

                        {{-- 🔹 Preserve semua query kecuali sort --}}
                        {{-- Supaya filter & search tetap ada saat ganti sort --}}
                        @foreach (request()->except('sort') as $key => $value)
                            <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                        @endforeach

                        <select name="sort" onchange="this.form.submit()"
                            class="px-5 py-3 pr-10 rounded-full border border-gray-300 bg-white hover:bg-gray-50 focus:ring-2 focus:ring-blue-500 transition shadow-sm">

                            <option value="">Newest</option>
                            <option value="oldest" {{ request('sort') == 'oldest' ? 'selected' : '' }}>
                                Oldest
                            </option>
                        </select>
                    </form>


                    {{-- ================= FILTER BUTTON ================= --}}
                    {{-- Hanya membuka slide panel --}}
                    <button type="button" onclick="openFilter()"
                        class="flex items-center gap-2 px-5 py-3 rounded-full border border-gray-300 bg-white hover:bg-gray-50 focus:ring-2 focus:ring-blue-500 transition shadow-sm">

                        {{-- Icon Filter --}}
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-5 h-5 text-gray-600">
                            <line x1="4" y1="6" x2="20" y2="6"></line>
                            <circle cx="14" cy="6" r="2"></circle>
                            <line x1="4" y1="12" x2="20" y2="12"></line>
                            <circle cx="8" cy="12" r="2"></circle>
                            <line x1="4" y1="18" x2="20" y2="18"></line>
                            <circle cx="16" cy="18" r="2"></circle>
                        </svg>

                        <span>Filter</span>
                    </button>


                    {{-- ================= SEARCH FORM (TERPISAH) ================= --}}
                    {{-- Form khusus search agar tidak menghapus filter & sort --}}
                    <form method="GET" action="{{ route('animals.index') }}" class="relative w-full md:w-80">

                        {{-- 🔹 Preserve semua query kecuali search --}}
                        @foreach (request()->except('search') as $key => $value)
                            <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                        @endforeach

                        {{-- Icon Search --}}
                        <div class="absolute inset-y-0 left-3 flex items-center pointer-events-none">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M21 21l-4.35-4.35M16 10a6 6 0 11-12 0 6 6 0 0112 0z" />
                            </svg>
                        </div>

                        <input type="text" name="search" value="{{ request('search') }}" placeholder="Search animals..."
                            class="w-full pl-10 pr-10 py-3 rounded-full border border-gray-300 bg-white focus:ring-2 focus:ring-blue-500 shadow-sm">
                    </form>

                </div>
            </div>


            {{-- ================= GRID LIST ================= --}}
            <div class="grid sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 md:gap-8">
                @forelse($animals as $animal)
                    @include('frontend.components.animal-card', ['animal' => $animal])
                @empty
                    <div class="col-span-full flex flex-col items-center justify-center text-center py-20">

                        <img src="{{ asset('images/no-data.png') }}" alt="No results" class="w-44 md:w-56 mb-6 opacity-90">

                        @php
                            $hasSearch = request()->filled('search');
                            $hasFilter = request()->hasAny(['category', 'age', 'gender']);
                        @endphp


                        {{-- ================= SEARCH PRIORITY ================= --}}
                        @if ($hasSearch)
                            <h3 class="text-xl font-semibold mb-2">
                                No results found for
                                <span class="text-blue-500">"{{ request('search') }}"</span>
                            </h3>

                            <p class="text-gray-500 mb-6 max-w-md">
                                Try using different keywords or adjust your filters.
                            </p>

                            {{-- Show active filters if any --}}
                            @if ($hasFilter)
                                <div class="flex flex-wrap justify-center gap-2 mb-6">
                                    @foreach (request()->only(['category', 'age', 'gender']) as $key => $value)
                                        @if ($value)
                                            <span class="px-3 py-1 text-sm bg-gray-100 rounded-full border">
                                                {{ ucfirst($key) }}: {{ $value }}
                                            </span>
                                        @endif
                                    @endforeach
                                </div>
                            @endif

                            <a href="{{ route('animals.index', request()->except('search')) }}"
                                class="px-5 py-2 rounded-full bg-blue-600 text-white hover:bg-blue-700 transition">
                                Clear Search
                            </a>


                            {{-- ================= FILTER ONLY ================= --}}
                        @elseif($hasFilter)
                            <h3 class="text-xl font-semibold mb-2">
                                No animals match your selected filters
                            </h3>

                            <p class="text-gray-500 mb-6 max-w-md">
                                Try adjusting or clearing some filters to see more animals.
                            </p>

                            <div class="flex flex-wrap justify-center gap-2 mb-6">
                                @foreach (request()->only(['category', 'age', 'gender']) as $key => $value)
                                    @if ($value)
                                        <span class="px-3 py-1 text-sm bg-gray-100 rounded-full border">
                                            {{ ucfirst($key) }}: {{ $value }}
                                        </span>
                                    @endif
                                @endforeach
                            </div>

                            <a href="{{ route('animals.index') }}"
                                class="px-5 py-2 rounded-full bg-blue-600 text-white hover:bg-blue-700 transition">
                                Clear All Filters
                            </a>


                            {{-- ================= DATABASE EMPTY ================= --}}
                        @else
                            <h3 class="text-xl font-semibold mb-2">
                                No animals available right now 🐾
                            </h3>

                            <p class="text-gray-500">
                                Please check back later.
                            </p>
                        @endif

                    </div>
                @endforelse
            </div>

            <div class="mt-10">
                {{ $animals->links() }}
            </div>

        </div>
    </section>



    {{-- ================= FILTER OVERLAY ================= --}}
    <div id="filterOverlay" class="fixed inset-0 bg-black/40 hidden z-40" onclick="closeFilter()"></div>


    {{-- ================= FILTER PANEL ================= --}}
    <div id="filterPanel"
        class="fixed top-0 right-0 h-full w-full sm:w-96 bg-white shadow-xl transform translate-x-full transition-transform duration-300 z-50 overflow-y-auto">

        <div class="p-6 border-b flex justify-between items-center">
            <h3 class="text-lg font-semibold">Filter</h3>
            <button onclick="closeFilter()">✕</button>
        </div>

        <form method="GET" action="{{ route('animals.index') }}" class="p-6 space-y-5">

            {{-- 🔹 Preserve search & sort --}}
            {{-- Supaya tidak hilang saat apply filter --}}
            @foreach (request()->except(['category', 'age', 'gender']) as $key => $value)
                <input type="hidden" name="{{ $key }}" value="{{ $value }}">
            @endforeach


            {{-- CATEGORY --}}
            <div>
                <label class="text-sm text-gray-500">Category</label>
                <select name="category" class="w-full mt-2 border rounded-xl px-4 py-3">
                    <option value="">All Categories</option>

                    @foreach ($categories as $cat)
                        <option value="{{ $cat->id }}" {{ request('category') == $cat->id ? 'selected' : '' }}>
                            {{ $cat->name }}
                        </option>
                    @endforeach
                </select>
            </div>


            {{-- AGE --}}
            <div>
                <label class="text-sm text-gray-500">Age</label>
                <select name="age" onchange="this.name = this.value ? 'age' : ''"
                    class="w-full mt-2 border rounded-xl px-4 py-3">
                    <option value="">All Age</option>
                    <option value="0-1" {{ request('age') == '0-1' ? 'selected' : '' }}>
                        0 - 1 year
                    </option>
                    <option value="1-3" {{ request('age') == '1-3' ? 'selected' : '' }}>
                        1 - 3 years
                    </option>
                    <option value="3-10" {{ request('age') == '3-10' ? 'selected' : '' }}>
                        3+ years
                    </option>
                </select>
            </div>


            {{-- GENDER --}}
            <div>
                <label class="text-sm text-gray-500">Gender</label>
                <select name="gender" onchange="this.name = this.value ? 'gender' : ''"
                    class="w-full mt-2 border rounded-xl px-4 py-3">
                    <option value="">All Gender</option>
                    <option value="Male" {{ request('gender') == 'Male' ? 'selected' : '' }}>
                        Male
                    </option>
                    <option value="Female" {{ request('gender') == 'Female' ? 'selected' : '' }}>
                        Female
                    </option>
                </select>
            </div>


            <button type="submit"
                class="w-full bg-blue-600 text-white py-3 rounded-xl mt-6 hover:bg-blue-700 transition">
                Apply Filter
            </button>

            {{-- RESET --}}
            <a href="{{ route('animals.index') }}"
                class="block text-center w-full border border-red-500 text-red-500 py-2 rounded-lg transition">
                Reset Filter
            </a>
        </form>
    </div>
@endsection
