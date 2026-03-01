<nav x-data="{ open: false }" class="bg-white shadow-sm fixed top-0 left-0 w-full z-50">

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="flex justify-between items-center h-16">

            {{-- LOGO --}}
            <a href="{{ route('home') }}" class="text-xl font-bold text-indigo-600">
                Adopt<span class="text-gray-900">Me</span> 🐾
            </a>

            {{-- DESKTOP MENU --}}
            <div class="hidden md:flex items-center space-x-8">

                <a href="{{ route('home') }}"
                    class="{{ request()->routeIs('home') ? 'font-semibold text-indigo-600' : 'text-gray-600 hover:text-indigo-600' }}">
                    Home
                </a>

                <a href="{{ route('animals.index') }}"
                    class="{{ request()->routeIs('animals.*') ? 'font-semibold text-indigo-600' : 'text-gray-600 hover:text-indigo-600' }}">
                    Animals
                </a>

                @auth
                    <a href="{{ route('profile') }}"
                        class="{{ request()->routeIs('profile') ? 'font-semibold text-indigo-600' : 'text-gray-600 hover:text-indigo-600' }}">
                        Profile
                    </a>
                @endauth

            </div>

            {{-- RIGHT SIDE BUTTON --}}
            <div class="hidden md:flex items-center space-x-4">

                @guest
                    <a href="{{ route('login') }}"
                        class="px-4 py-2 rounded-xl border border-indigo-600 text-indigo-600 hover:bg-indigo-50 transition">
                        Login
                    </a>

                    <a href="{{ route('register') }}"
                        class="px-4 py-2 rounded-xl bg-indigo-600 text-white hover:bg-indigo-700 transition">
                        Register
                    </a>
                @endguest
            </div>

            {{-- HAMBURGER --}}
            <button @click="open = !open" class="md:hidden text-gray-700 focus:outline-none">

                <svg x-show="!open" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                </svg>

                <svg x-show="open" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>

            </button>

        </div>

    </div>

    {{-- MOBILE MENU --}}
    <div x-show="open" x-transition class="md:hidden bg-white border-t">

        <div class="px-4 py-4 space-y-4 text-center">

            <a href="{{ route('home') }}"
                class="block {{ request()->routeIs('home') ? 'font-semibold text-indigo-600' : 'text-gray-700' }}">
                Home
            </a>

            <a href="{{ route('animals.index') }}"
                class="block {{ request()->routeIs('animals.*') ? 'font-semibold text-indigo-600' : 'text-gray-700' }}">
                Animals
            </a>

            @auth
                <a href="{{ route('profile') }}"
                    class="block {{ request()->routeIs('profile') ? 'font-semibold text-indigo-600' : 'text-gray-700' }}">
                    Profile
                </a>
            @endauth

            @guest
                <div class="pt-4 space-y-3">

                    <a href="{{ route('login') }}"
                        class="block px-4 py-2 rounded-xl border border-indigo-600 text-indigo-600">
                        Login
                    </a>

                    <a href="{{ route('register') }}" class="block px-4 py-2 rounded-xl bg-indigo-600 text-white">
                        Register
                    </a>

                </div>
            @endguest

        </div>
    </div>

</nav>

{{-- IMPORTANT: kasih padding top supaya tidak ketutup fixed navbar --}}
<div class="h-16"></div>
