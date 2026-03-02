@extends('frontend.layouts.app')

@section('content')
    <section class="bg-gray-50 py-10" x-data="{ tab: 'info', open: false }">
        <div class="max-w-5xl mx-auto px-4 sm:px-6">

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 md:gap-10">

                {{-- ================= LEFT PROFILE CARD ================= --}}
                <div class="md:col-span-1">
                    <div class="bg-white rounded-3xl shadow-xl p-6 md:p-8 border border-gray-100">

                        <div class="flex flex-col items-center text-center">

                            <img src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}"
                                class="w-24 h-24 rounded-full mb-4">

                            <h2 class="text-lg font-bold">
                                {{ $user->name }}
                            </h2>

                            <p class="text-sm text-gray-400 mb-6">
                                Member since {{ $user->created_at->format('M Y') }}
                            </p>

                            {{-- MOBILE DROPDOWN --}}
                            <div class="w-full md:hidden mt-6">

                                <button @click="open = !open"
                                    class="w-full bg-indigo-600 text-white rounded-xl px-4 py-3 text-left flex justify-between items-center">

                                    {{-- ACTIVE LABEL --}}
                                    <span class="font-medium"
                                        x-text="
                tab === 'info' ? 'My Information' :
                tab === 'adoption' ? 'My Adoption History' :
                'My Favorites'
            ">
                                    </span>

                                    {{-- CHEVRON --}}
                                    <svg class="w-5 h-5 transition-transform duration-300" :class="open ? 'rotate-180' : ''"
                                        fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                                    </svg>

                                </button>

                                {{-- DROPDOWN ITEMS --}}
                                <div x-show="open" x-transition @click.outside="open = false" class="mt-3 space-y-2">

                                    {{-- INFO --}}
                                    <button x-show="tab !== 'info'" @click="tab='info'; open=false"
                                        class="w-full text-left px-4 py-2 rounded-lg hover:bg-gray-100">
                                        My Information
                                    </button>

                                    {{-- ADOPTION --}}
                                    <button x-show="tab !== 'adoption'" @click="tab='adoption'; open=false"
                                        class="w-full text-left px-4 py-2 rounded-lg hover:bg-gray-100">
                                        My Adoption History
                                    </button>

                                    {{-- FAVORITES --}}
                                    <button x-show="tab !== 'favorites'" @click="tab='favorites'; open=false"
                                        class="w-full text-left px-4 py-2 rounded-lg hover:bg-gray-100">
                                        My Favorites
                                    </button>

                                    <div class="pt-3 border-t mt-3">
                                        <button @click="$dispatch('open-logout'); open=false"
                                            class="w-full text-left px-4 py-2 rounded-lg bg-red-600 text-white">
                                            Logout
                                        </button>
                                    </div>

                                </div>
                            </div>

                            {{-- DESKTOP MENU --}}
                            <div class="hidden md:block w-full space-y-3 mt-6">

                                <button @click="tab='info'"
                                    :class="tab === 'info' ? 'bg-indigo-600 text-white' : 'bg-gray-100'"
                                    class="w-full py-3 rounded-xl text-sm transition">
                                    My Information
                                </button>

                                <button @click="tab='adoption'"
                                    :class="tab === 'adoption' ? 'bg-indigo-600 text-white' : 'bg-gray-100'"
                                    class="w-full py-3 rounded-xl text-sm transition">
                                    My Adoption History
                                </button>

                                <button @click="tab='favorites'"
                                    :class="tab === 'favorites' ? 'bg-indigo-600 text-white' : 'bg-gray-100'"
                                    class="w-full py-3 rounded-xl text-sm transition">
                                    My Favorites
                                </button>

                                {{-- LOGOUT BUTTON --}}
                                <div class="pt-4 border-t mt-4">
                                    <button @click="$dispatch('open-logout')"
                                        class="w-full py-3 rounded-xl text-sm border bg-red-600 text-white transition">
                                        Logout
                                    </button>
                                </div>

                            </div>

                        </div>
                    </div>
                </div>


                {{-- ================= RIGHT CONTENT ================= --}}
                <div class="md:col-span-2 space-y-6 md:space-y-10">

                    {{-- ================= MY INFORMATION ================= --}}
                    <div x-show="tab==='info'" class="bg-white rounded-3xl shadow-xl p-6 md:p-10 border border-gray-100">

                        <h2 class="text-xl md:text-2xl font-bold mb-6 md:mb-8">
                            My Information
                        </h2>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 md:gap-8 text-sm">

                            <div class="space-y-6">
                                <div>
                                    <p class="text-gray-400 text-xs uppercase">Name</p>
                                    <p class="text-lg font-semibold">{{ $user->name }}</p>
                                </div>

                                <div>
                                    <p class="text-gray-400 text-xs uppercase">Phone</p>
                                    <p class="text-lg font-semibold">{{ $user->phone ?? '-' }}</p>
                                </div>
                            </div>

                            <div class="space-y-6">
                                <div>
                                    <p class="text-gray-400 text-xs uppercase">Email</p>
                                    <p class="text-lg font-semibold">{{ $user->email }}</p>
                                </div>

                                <div>
                                    <p class="text-gray-400 text-xs uppercase">Address</p>
                                    <p class="text-lg font-semibold">{{ $user->address ?? '-' }}</p>
                                </div>
                            </div>

                        </div>
                    </div>


                    {{-- ================= ADOPTION HISTORY ================= --}}
                    <div x-show="tab==='adoption'"
                        class="bg-white rounded-3xl shadow-xl p-6 md:p-10 border border-gray-100">

                        <h2 class="text-xl md:text-2xl font-bold mb-6 md:mb-8">
                            My Adoption History
                        </h2>

                        @forelse($adoptions as $adoption)
                            <div class="p-5 md:p-6 border rounded-2xl mb-6">

                                <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">

                                    {{-- LEFT --}}
                                    <div class="flex items-center gap-4 md:gap-5">
                                        <img src="{{ $adoption->animal->images->first()
                                            ? asset('storage/' . $adoption->animal->images->first()->image)
                                            : 'https://via.placeholder.com/120' }}"
                                            class="w-20 h-20 rounded-xl object-cover">

                                        <div>
                                            <p class="text-lg font-semibold">
                                                {{ $adoption->animal->name }}
                                            </p>

                                            <p class="text-sm text-gray-500">
                                                {{ $adoption->created_at->format('d M Y') }}
                                            </p>

                                            <span
                                                class="inline-block mt-2 px-3 py-1 text-xs rounded-full
                                                @if ($adoption->status === 'approved') 
                                                bg-green-100 text-green-700
                                                @elseif($adoption->status === 'rejected') 
                                                bg-red-100 text-red-700
                                                @elseif($adoption->status === 'auto_rejected')
                                                bg-red-700 text-white
                                                @else 
                                                bg-yellow-100 text-yellow-700 @endif">

                                                {{ $adoption->status_label }}
                                            </span>
                                        </div>
                                    </div>

                                    {{-- BUTTON --}}
                                    <a href="{{ route('animals.show', $adoption->animal->slug) }}"
                                        class="bg-indigo-600 text-white px-5 py-2 rounded-xl text-sm 
                                          w-full md:w-auto text-center">
                                        View Detail
                                    </a>
                                </div>

                                {{-- ADMIN NOTE --}}
                                @if (in_array($adoption->status, ['rejected', 'auto_rejected']) && $adoption->admin_note)
                                    <div class="mt-4 bg-red-50 border-l-4 border-red-500 p-4 rounded-lg">
                                        <p class="text-sm text-red-700">
                                            <span class="font-semibold">Admin Note:</span>
                                            {{ $adoption->admin_note }}
                                        </p>
                                    </div>
                                @endif

                            </div>
                        @empty
                            <p class="text-gray-500">No adoption requests yet.</p>
                        @endforelse
                    </div>


                    {{-- ================= FAVORITES ================= --}}
                    <div x-show="tab==='favorites'"
                        class="bg-white rounded-3xl shadow-xl p-6 md:p-10 border border-gray-100">

                        <h2 class="text-xl md:text-2xl font-bold mb-6 md:mb-8">
                            My Favorites ({{ $favorites->count() }})
                        </h2>

                        @if ($favorites->count())
                            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 md:gap-8">

                                @foreach ($favorites as $animal)
                                    @include('frontend.components.animal-card-compact', [
                                        'animal' => $animal,
                                    ])
                                @endforeach

                            </div>
                        @else
                            <div class="py-12 text-center text-gray-500">
                                No favorites yet 🐾
                            </div>
                        @endif

                    </div>

                </div>
            </div>
        </div>

        {{-- ================= LOGOUT MODAL ================= --}}
        <div x-data="{ show: false }" x-on:open-logout.window="show = true" x-show="show" x-transition
            class="fixed inset-0 z-50 flex items-center justify-center bg-black/40 backdrop-blur-sm">

            <div @click.outside="show = false" class="bg-white rounded-3xl shadow-2xl w-full max-w-sm p-6">

                <div class="text-center">

                    <div class="mb-4 text-red-500">
                        <i class="fa-solid fa-right-from-bracket text-4xl"></i>
                    </div>

                    <h3 class="text-lg font-semibold mb-2">
                        Konfirmasi Logout
                    </h3>

                    <p class="text-sm text-gray-500 mb-6">
                        Apakah kamu yakin ingin keluar dari akun ini?
                    </p>

                    <div class="flex gap-3">

                        <button @click="show = false"
                            class="w-full py-2 rounded-xl bg-gray-100 hover:bg-gray-200 transition">
                            Batal
                        </button>

                        <form method="POST" action="{{ route('logout') }}" class="w-full">
                            @csrf
                            <button type="submit"
                                class="w-full py-2 rounded-xl bg-red-600 text-white hover:bg-red-700 transition">
                                Ya, Keluar
                            </button>
                        </form>

                    </div>

                </div>
            </div>
        </div>
    </section>
@endsection
