@extends('frontend.layouts.app')

@section('content')
    <div x-data="{ showLogout: false }" class="bg-gray-50 py-12">
        <div class="max-w-7xl mx-auto px-6">

            <div class="grid lg:grid-cols-3 gap-10">


                {{-- ================= LEFT PROFILE CARD ================= --}}
                <div>

                    <div class="bg-white rounded-3xl shadow-md p-8">

                        <div class="text-center">

                            <img src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}"
                                class="w-24 h-24 rounded-full mx-auto mb-4">

                            <h2 class="text-lg font-semibold">
                                {{ $user->name }}
                            </h2>

                            <p class="text-sm text-gray-400 mb-6">
                                Member since {{ $user->created_at->format('M Y') }}
                            </p>

                        </div>


                        <div class="space-y-4 text-sm">

                            <div class="bg-gray-50 rounded-xl p-3">
                                <p class="text-gray-400 text-xs">Email</p>
                                <p class="font-medium">{{ $user->email }}</p>
                            </div>

                            <div class="bg-gray-50 rounded-xl p-3">
                                <p class="text-gray-400 text-xs">Phone</p>
                                <p class="font-medium">{{ $user->phone ?? '-' }}</p>
                            </div>

                            <div class="bg-gray-50 rounded-xl p-3">
                                <p class="text-gray-400 text-xs">Address</p>
                                <p class="font-medium">{{ $user->address ?? '-' }}</p>
                            </div>

                        </div>


                        <button @click="showLogout = true"
                            class="w-full mt-6 bg-white text-red-600 border border-red-600 hover:bg-red-600 hover:text-white py-3 rounded-xl transition">
                            Logout
                        </button>

                    </div>

                </div>



                {{-- ================= RIGHT CONTENT ================= --}}
                <div class="lg:col-span-2 space-y-10">


                    {{-- ================= STATISTICS ================= --}}
                    <div class="grid grid-cols-3 gap-3 md:gap-6">

                        <div class="bg-white p-4 md:p-6 rounded-2xl shadow text-center">

                            <p class="text-xl md:text-3xl font-bold text-yellow-500">
                                {{ $pendingCount }}
                            </p>

                            <p class="text-xs md:text-sm text-gray-500">
                                Pending
                            </p>

                        </div>

                        <div class="bg-white p-4 md:p-6 rounded-2xl shadow text-center">

                            <p class="text-xl md:text-3xl font-bold text-green-600">
                                {{ $approvedCount }}
                            </p>

                            <p class="text-xs md:text-sm text-gray-500">
                                Approved
                            </p>

                        </div>

                        <div class="bg-white p-4 md:p-6 rounded-2xl shadow text-center">

                            <p class="text-xl md:text-3xl font-bold text-red-500">
                                {{ $rejectedCount }}
                            </p>

                            <p class="text-xs md:text-sm text-gray-500">
                                Rejected
                            </p>

                        </div>

                    </div>



                    {{-- ================= ADOPTION HISTORY ================= --}}
                    <div class="bg-white rounded-3xl shadow-md p-8">

                        <div class="flex justify-between items-center mb-6">

                            <h2 class="text-xl font-bold">
                                My Adoption History
                            </h2>

                            <a href="{{ route('profile.my-adoptions') }}"
                                class="text-indigo-600 font-medium">
                                View all →
                            </a>

                        </div>


                        <div class="space-y-4">

                            @forelse($adoptions as $adoption)
                                <div class="flex items-center justify-between border rounded-xl p-4">

                                    <div class="flex items-center gap-4">

                                        <img src="{{ $adoption->animal->images->first()
                                            ? asset('storage/' . $adoption->animal->images->first()->image)
                                            : 'https://via.placeholder.com/80' }}"
                                            class="w-14 h-14 rounded-lg object-cover">

                                        <div>

                                            <p class="font-semibold">
                                                {{ $adoption->animal->name }}
                                            </p>

                                            <p class="text-sm text-gray-500">
                                                {{ $adoption->created_at->format('d M Y') }}
                                            </p>

                                        </div>

                                    </div>

                                    <span class="px-3 py-1 text-xs rounded-full {{ $adoption->status_color }}">
                                        {{ $adoption->status_label }}
                                    </span>

                                </div>

                            @empty

                                <p class="text-gray-500 text-sm">
                                    No adoption requests yet.
                                </p>
                            @endforelse

                        </div>

                    </div>



                    {{-- ================= FAVORITES ================= --}}
                    <div class="bg-white rounded-3xl shadow-md p-8">

                        <div class="flex justify-between items-center mb-6">

                            <h2 class="text-xl font-bold">
                                My Favorites
                            </h2>

                            <a href="{{ route('profile.my-favorites') }}"
                                class="text-indigo-600 font-medium">
                                View all →
                            </a>

                        </div>


                        <div class="grid sm:grid-cols-2 md:grid-cols-3 gap-6">

                            @forelse($favorites as $animal)
                                @include('frontend.components.animal-card-compact', [
                                    'animal' => $animal,
                                ])

                            @empty

                                <p class="text-gray-500 text-sm">
                                    No favorites yet 🐾
                                </p>
                            @endforelse

                        </div>

                    </div>


                </div>

            </div>

        </div>

        {{-- ================= LOGOUT MODAL ================= --}}
        <div x-show="showLogout" x-transition
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

                        <button @click="showLogout = false"
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
