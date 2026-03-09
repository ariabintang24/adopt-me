<div class="mb-8">

    {{-- BACK BUTTON --}}
    <a href="{{ $back ?? route('profile.index') }}"
        class="inline-flex items-center gap-2 text-sm text-blue-600
          bg-white border border-blue-600
          px-4 py-2 rounded-lg
          hover:bg-blue-50 transition mb-3">

        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">

            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7 7-7m-7 7h18" />

        </svg>

        Back

    </a>


    {{-- TITLE + ACTION --}}
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">

        <div>
            <h1 class="text-2xl md:text-3xl font-bold">
                {{ $title }}
            </h1>

            @isset($subtitle)
                <p class="text-gray-500 mt-1">
                    {{ $subtitle }}
                </p>
            @endisset
        </div>

        @isset($action)
            <div class="self-start md:self-auto">
                {!! $action !!}
            </div>
        @endisset

    </div>

</div>
