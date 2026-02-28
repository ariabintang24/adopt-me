<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Adopt Me</title>

    {{-- GLightbox CSS --}}
    <link href="https://cdn.jsdelivr.net/npm/glightbox/dist/css/glightbox.min.css" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-50 text-gray-800">

    {{-- ================= GLOBAL TOAST ================= --}}
    <div x-data="{
        show: true,
        timeout: null,
        init() {
            this.timeout = setTimeout(() => this.show = false, 5000)
        }
    }" x-show="show" x-transition:enter="transform ease-out duration-300"
        x-transition:enter-start="translate-y-4 opacity-0 sm:translate-y-0 sm:translate-x-6"
        x-transition:enter-end="translate-y-0 opacity-100 sm:translate-x-0"
        x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0" class="fixed top-6 right-6 z-50 space-y-3 w-96">

        {{-- SUCCESS --}}
        @if (session('success'))
            <div class="relative overflow-hidden rounded-2xl bg-white shadow-2xl ring-1 ring-black/5">

                <div class="flex items-start gap-4 p-5 border-l-4 border-emerald-500">

                    {{-- Icon --}}
                    <div class="flex items-center justify-center w-10 h-10 rounded-xl bg-emerald-100 text-emerald-600">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                        </svg>
                    </div>

                    {{-- Content --}}
                    <div class="flex-1">
                        <p class="text-sm font-semibold text-gray-900">
                            Success
                        </p>
                        <p class="mt-1 text-sm text-gray-600">
                            {{ session('success') }}
                        </p>
                    </div>

                    {{-- Close --}}
                    <button @click="show = false" class="text-gray-400 hover:text-gray-600 transition">
                        ✕
                    </button>

                </div>

                {{-- Progress bar --}}
                <div class="absolute bottom-0 left-0 h-1 bg-emerald-500 animate-[toast_3s_linear_forwards] w-full">
                </div>
            </div>
        @endif


        {{-- ERROR --}}
        @php
            $errorMessage = session()->pull('error');
        @endphp

        @if ($errorMessage)
            <div class="relative overflow-hidden rounded-2xl bg-white shadow-2xl ring-1 ring-black/5">

                <div class="flex items-start gap-4 p-5">

                    {{-- Icon --}}
                    <div class="flex items-center justify-center w-10 h-10 rounded-xl bg-rose-100 text-rose-600">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </div>

                    {{-- Content --}}
                    <div class="flex-1">
                        <p class="text-sm font-semibold text-gray-900">
                            Notice
                        </p>
                        <p class="mt-1 text-sm text-gray-600">
                            {{ $errorMessage }}
                        </p>
                    </div>

                    {{-- Close --}}
                    <button @click="show = false" class="text-gray-400 hover:text-gray-600 transition">
                        ✕
                    </button>

                </div>

                {{-- Progress bar --}}
                <div class="absolute bottom-0 left-0 h-1 bg-rose-500 animate-[toast_3s_linear_forwards] w-full"></div>
            </div>
        @endif

    </div>

    @include('frontend.components.navbar')

    <main>
        @yield('content')
    </main>

    @include('frontend.components.footer')

    <script src="https://cdn.jsdelivr.net/npm/glightbox/dist/js/glightbox.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            GLightbox({
                selector: '.glightbox',
                loop: true,
                touchNavigation: true
            });
        });
    </script>

</body>

</html>
