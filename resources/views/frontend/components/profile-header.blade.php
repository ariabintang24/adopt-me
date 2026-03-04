<div class="flex items-center gap-3 mb-6 md:mb-8">

    <a href="{{ route('profile.index') }}"
        class="flex items-center justify-center w-9 h-9 rounded-full border border-gray-300 hover:bg-gray-100 transition">

        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-gray-600" fill="none" viewBox="0 0 24 24"
            stroke="currentColor">

            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />

        </svg>

    </a>

    <h2 class="text-xl md:text-2xl font-bold">
        {{ $title }}
    </h2>

</div>
