@extends('frontend.layouts.app')

@section('content')
    <section class="bg-gray-50 py-16">
        <div class="max-w-7xl mx-auto px-6">

            <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-10 gap-6">

                <!-- Title -->
                <h2 class="text-2xl md:text-3xl font-bold leading-tight">
                    Available Animals 🐾
                </h2>

                <form method="GET" action="{{ route('animals.index') }}" class="w-full md:w-auto">
                    <div class="flex items-center gap-3">

                        <!-- Search Wrapper -->
                        <div class="relative w-full md:w-80">

                            <!-- Icon Search -->
                            <div class="absolute inset-y-0 left-3 flex items-center pointer-events-none">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M21 21l-4.35-4.35M16 10a6 6 0 11-12 0 6 6 0 0112 0z" />
                                </svg>
                            </div>

                            <!-- Input -->
                            <input type="text" name="search" id="searchInput" value="{{ request('search') }}"
                                placeholder="Search animals..."
                                class="w-full pl-10 pr-10 py-3 rounded-full border border-gray-300 bg-white
                           focus:bg-white focus:outline-none focus:ring-2 focus:ring-blue-500
                           transition-all duration-200 shadow-sm">

                            <!-- Clear Button -->
                            @if (request('search'))
                                <a href="{{ route('animals.index') }}"
                                    class="absolute inset-y-0 right-3 flex items-center text-gray-400 hover:text-gray-600">
                                    ✕
                                </a>
                            @endif

                        </div>

                        {{-- <!-- Cancel Button -->
                        @if (request('search'))
                            <a href="{{ route('animals.index') }}" class="text-blue-500 font-medium hover:underline">
                                Cancel
                            </a>
                        @endif --}}

                    </div>
                </form>
            </div>

            <div class="grid sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 md:gap-8">
                @forelse($animals as $animal)
                    @include('frontend.components.animal-card', ['animal' => $animal])
                @empty
                    <div class="col-span-full flex flex-col items-center justify-center text-center py-16">

                        <img src="{{ asset('images/no-data.png') }}" alt="No Data" class="w-48 md:w-60 mb-6 opacity-90">

                        @if (request('search'))
                            <h3 class="text-xl font-semibold mb-2">
                                No results found for
                                <span class="text-blue-500">"{{ request('search') }}"</span>
                            </h3>

                            <p class="text-gray-500 mb-6">
                                Try searching with a different keyword.
                            </p>

                            <a href="{{ route('animals.index') }}"
                                class="px-5 py-2 rounded-full bg-blue-500 text-white hover:bg-blue-600 transition">
                                Reset Search
                            </a>
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
@endsection
