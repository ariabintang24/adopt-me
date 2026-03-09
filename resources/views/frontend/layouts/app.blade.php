<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adopt Me</title>

    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('logo-adoptme.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('logo-adoptme.png') }}">
    <link rel="shortcut icon" href="{{ asset('logo-adoptme.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('logo-adoptme.png') }}">

    {{-- GLightbox CSS --}}
    <link href="https://cdn.jsdelivr.net/npm/glightbox/dist/css/glightbox.min.css" rel="stylesheet">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">

    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-50 text-gray-800">

    {{-- ================= GLOBAL TOAST (NEW) ================= --}}
    <div x-data="{
        show: false,
        type: 'success',
        message: '',
        timeout: null,
        trigger(type, message) {
            this.type = type;
            this.message = message;
            this.show = true;
            clearTimeout(this.timeout);
            this.timeout = setTimeout(() => this.show = false, 4000);
        }
    }" x-on:toast-success.window="trigger('success', $event.detail)"
        x-on:toast-error.window="trigger('error', $event.detail)"
        class="fixed top-6 right-4 left-4 sm:left-auto sm:w-96 z-[9999] space-y-3">

        <template x-if="show">
            <div x-transition class="relative overflow-hidden rounded-2xl shadow-2xl ring-1 ring-black/5 bg-white">

                <div class="flex items-start gap-4 p-5">

                    {{-- ICON --}}
                    <div class="flex items-center justify-center w-10 h-10 rounded-xl"
                        :class="type === 'success'
                            ?
                            'bg-emerald-100 text-emerald-600' :
                            'bg-rose-100 text-rose-600'">

                        <svg x-show="type === 'success'" xmlns="http://www.w3.org/2000/svg" class="w-5 h-5"
                            fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                        </svg>

                        <svg x-show="type === 'error'" xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </div>

                    {{-- CONTENT --}}
                    <div class="flex-1">
                        <p class="text-sm font-semibold text-gray-900"
                            x-text="type === 'success' ? 'Success' : 'Notice'">
                        </p>

                        <p class="mt-1 text-sm text-gray-600" x-text="message">
                        </p>
                    </div>

                    {{-- CLOSE --}}
                    <button @click="show = false" class="text-gray-400 hover:text-gray-600 transition">
                        ✕
                    </button>

                </div>

                <!-- PROGRESS BAR -->
                <div x-show="show" class="absolute bottom-0 left-0 h-1 toast-progress"
                    :class="type === 'success' ? 'bg-emerald-500' : 'bg-rose-500'">
                </div>

            </div>
        </template>
    </div>

    @include('frontend.components.navbar')

    <main>
        @yield('content')
    </main>

    {{-- @include('frontend.components.footer') --}}

    <script src="https://cdn.jsdelivr.net/npm/glightbox/dist/js/glightbox.min.js"></script>

    <script>
        function openFilter() {
            document.getElementById('filterPanel').classList.remove('translate-x-full');
            document.getElementById('filterOverlay').classList.remove('hidden');
        }

        function closeFilter() {
            document.getElementById('filterPanel').classList.add('translate-x-full');
            document.getElementById('filterOverlay').classList.add('hidden');
        }
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {

            const filterForm = document.querySelector('#filterPanel form');
            if (!filterForm) return;

            filterForm.addEventListener('submit', function() {

                const selects = this.querySelectorAll('select');

                selects.forEach(select => {
                    if (!select.value) {
                        select.removeAttribute('name'); // 🔥 hapus name kalau kosong
                    }
                });

            });

        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            GLightbox({
                selector: '.glightbox',
                loop: true,
                touchNavigation: true
            });
        });
    </script>

    @php
        $success = session()->pull('success');
    @endphp

    @if ($success)
        <script>
            document.addEventListener('DOMContentLoaded', function() {

                if (!window.performance || performance.navigation.type !== 2) {

                    window.dispatchEvent(new CustomEvent('toast-success', {
                        detail: "{{ $success }}"
                    }));

                }

            });
        </script>
    @endif

    @php
        $error = session()->pull('error');
    @endphp

    @if ($error)
        <script>
            document.addEventListener('DOMContentLoaded', function() {

                if (!window.performance || performance.navigation.type !== 2) {

                    window.dispatchEvent(new CustomEvent('toast-error', {
                        detail: "{{ $error }}"
                    }));

                }

            });
        </script>
    @endif

    <style>
        .toast-progress {
            animation: toast-progress 4s linear forwards;
        }

        @keyframes toast-progress {
            from {
                width: 100%;
            }

            to {
                width: 0%;
            }
        }
    </style>


</body>

</html>
