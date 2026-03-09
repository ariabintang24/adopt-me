<section class="bg-gray-50">
    <div class="max-w-7xl mx-auto px-6 py-20 grid md:grid-cols-2 gap-12 items-center">

        <div>
            <h1 class="text-4xl md:text-5xl font-bold leading-tight">
                Give Them a <span class="text-indigo-600">Second Chance</span>
            </h1>

            <p class="mt-6 text-gray-600 text-lg">
                Find your new best friend today. Adopt a loving animal and make a difference.
            </p>

            {{-- CTA Buttons --}}
            <div class="mt-8 flex gap-4">

                {{-- Explore --}}
                <a href="{{ route('animals.index') }}"
                    class="group flex-1 flex items-center whitespace-nowrap justify-center gap-2
           bg-indigo-600 text-white px-6 py-3 rounded-xl shadow-md
           hover:bg-indigo-700 hover:shadow-lg
           transition-all duration-200">

                    {{-- paw icon --}}
                    <svg xmlns="http://www.w3.org/2000/svg"
                        class="w-5 h-5 transition-transform duration-200 group-hover:scale-110" fill="currentColor"
                        viewBox="0 0 24 24">
                        <path
                            d="M12 12c-2.5 0-4.5 1.6-4.5 3.5S9.5 19 12 19s4.5-1.6 4.5-3.5S14.5 12 12 12zM5 11c1 0 1.8-1.1 1.8-2.5S6 6 5 6 3.2 7.1 3.2 8.5 4 11 5 11zm14 0c1 0 1.8-1.1 1.8-2.5S20 6 19 6s-1.8 1.1-1.8 2.5S18 11 19 11zM8 7.5C9 7.5 9.8 6.4 9.8 5S9 2.5 8 2.5 6.2 3.6 6.2 5 7 7.5 8 7.5zm8 0c1 0 1.8-1.1 1.8-2.5S17 2.5 16 2.5 14.2 3.6 14.2 5 15 7.5 16 7.5z" />
                    </svg>

                    Explore Animals
                </a>


                {{-- Post Animal --}}
                <a href="{{ route('animals.create') }}"
                    class="group flex-1 flex items-center whitespace-nowrap justify-center gap-2
           bg-white border border-indigo-600 text-indigo-600
           px-6 py-3 rounded-xl shadow-md
           hover:bg-indigo-600 hover:text-white hover:shadow-lg
           transition-all duration-200">

                    {{-- plus icon --}}
                    <svg xmlns="http://www.w3.org/2000/svg"
                        class="w-5 h-5 transition-transform duration-200 group-hover:rotate-90" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                    </svg>

                    Post Animal
                </a>

            </div>
        </div>

        <div>
            <img src="{{ asset('images/hero-adopt.png') }}" class="rounded-3xl" alt="Adopt Animal">
        </div>

    </div>
</section>
