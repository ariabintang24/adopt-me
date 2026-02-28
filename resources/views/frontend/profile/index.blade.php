@extends('frontend.layouts.app')

@section('content')
    <section class="bg-gray-50 py-10" x-data="{ tab: 'info', open: false }">
        <div class="max-w-6xl mx-auto px-6">

            <div class="grid md:grid-cols-3 gap-10">

                {{-- ================= LEFT PROFILE CARD ================= --}}
                <div class="md:col-span-1">
                    <div class="bg-white rounded-3xl shadow-xl p-8 border border-gray-100">

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
                            <div class="w-full md:hidden">
                                <button @click="open = !open"
                                    class="w-full bg-gray-100 rounded-xl px-4 py-3 text-left flex justify-between items-center">
                                    <span>Menu</span>
                                    <span x-text="open ? '▲' : '▼'"></span>
                                </button>

                                <div x-show="open" class="mt-3 space-y-2">
                                    <button @click="tab='info'; open=false"
                                        class="w-full text-left px-4 py-2 rounded-lg hover:bg-gray-100">
                                        My Information
                                    </button>

                                    <button @click="tab='adoption'; open=false"
                                        class="w-full text-left px-4 py-2 rounded-lg hover:bg-gray-100">
                                        My Adoption History
                                    </button>

                                    <button @click="tab='favorites'; open=false"
                                        class="w-full text-left px-4 py-2 rounded-lg hover:bg-gray-100">
                                        My Favorites
                                    </button>
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

                            </div>

                        </div>
                    </div>
                </div>


                {{-- ================= RIGHT CONTENT ================= --}}
                <div class="md:col-span-2 space-y-10">

                    {{-- ================= MY INFORMATION ================= --}}
                    <div x-show="tab==='info'" class="bg-white rounded-3xl shadow-xl p-10 border border-gray-100">

                        <h2 class="text-2xl font-bold mb-8">My Information</h2>

                        <div class="grid md:grid-cols-2 gap-8 text-sm">

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
                    <div x-show="tab==='adoption'" class="bg-white rounded-3xl shadow-xl p-10 border border-gray-100">

                        <h2 class="text-2xl font-bold mb-8">My Adoption History</h2>

                        @forelse($adoptions as $adoption)
                            <div class="flex items-center justify-between p-6 border rounded-2xl mb-6">

                                <div class="flex items-center gap-5">
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
                                        @if ($adoption->status === 'approved') bg-green-100 text-green-700
                                        @elseif($adoption->status === 'rejected') bg-red-100 text-red-700
                                        @else bg-yellow-100 text-yellow-700 @endif">
                                            {{ ucfirst($adoption->status) }}
                                        </span>
                                    </div>
                                </div>

                                <a href="{{ route('animals.show', $adoption->animal->slug) }}"
                                    class="bg-indigo-600 text-white px-5 py-2 rounded-xl text-sm">
                                    View Detail
                                </a>

                            </div>
                        @empty
                            <p class="text-gray-500">No adoption requests yet.</p>
                        @endforelse
                    </div>


                    {{-- ================= FAVORITES ================= --}}
                    <div x-show="tab==='favorites'" class="bg-white rounded-3xl shadow-xl p-10 border border-gray-100">

                        <h2 class="text-2xl font-bold mb-8">
                            My Favorites ({{ $favorites->count() }})
                        </h2>

                        @if ($favorites->count())
                            <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-8">
                                @foreach ($favorites as $animal)
                                    @include('frontend.components.animal-card', [
                                        'animal' => $animal,
                                        'forceFavorite' => true,
                                    ])
                                @endforeach
                            </div>
                        @else
                            <div class="p-12 text-center text-gray-500">
                                No favorites yet 🐾
                            </div>
                        @endif
                    </div>

                </div>
            </div>
        </div>
    </section>
@endsection
