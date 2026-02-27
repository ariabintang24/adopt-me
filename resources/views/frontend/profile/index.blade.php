@extends('frontend.layouts.app')

@section('content')
    <section class="bg-gray-50 py-10">
        <div class="max-w-5xl mx-auto px-6 space-y-12">

            {{-- ================= USER INFO ================= --}}
            <div class="bg-white rounded-3xl shadow-xl p-10 border border-gray-100">

                <div class="flex items-center justify-between mb-8">
                    <h2 class="text-2xl font-bold">My Information</h2>

                    <span class="text-sm text-gray-400">
                        Member since {{ $user->created_at->format('M Y') }}
                    </span>
                </div>

                <div class="grid md:grid-cols-2 gap-8 text-sm">

                    <div class="space-y-6">
                        <div>
                            <p class="text-gray-400 text-xs uppercase tracking-wide">Name</p>
                            <p class="text-lg font-semibold">{{ $user->name }}</p>
                        </div>

                        <div>
                            <p class="text-gray-400 text-xs uppercase tracking-wide">Phone</p>
                            <p class="text-lg font-semibold">{{ $user->phone ?? '-' }}</p>
                        </div>
                    </div>

                    <div class="space-y-6">
                        <div>
                            <p class="text-gray-400 text-xs uppercase tracking-wide">Email</p>
                            <p class="text-lg font-semibold">{{ $user->email }}</p>
                        </div>

                        <div>
                            <p class="text-gray-400 text-xs uppercase tracking-wide">Address</p>
                            <p class="text-lg font-semibold">{{ $user->address ?? '-' }}</p>
                        </div>
                    </div>

                </div>
            </div>


            {{-- ================= ADOPTION HISTORY ================= --}}
            <div class="bg-white rounded-3xl shadow-xl p-10 border border-gray-100">

                <h2 class="text-2xl font-bold mb-8">My Adoption History</h2>

                @forelse($adoptions as $adoption)
                    <div class="flex items-center justify-between p-6 border rounded-2xl hover:shadow-lg transition mb-6">

                        {{-- Left Side --}}
                        <div class="flex items-center gap-5">

                            {{-- Animal Image --}}
                            <img src="{{ $adoption->animal->images->first()
                                ? asset('storage/' . $adoption->animal->images->first()->image)
                                : 'https://via.placeholder.com/120' }}"
                                class="w-24 h-24 rounded-xl object-cover">

                            {{-- Info --}}
                            <div>
                                <p class="text-lg font-semibold">
                                    {{ $adoption->animal->name }}
                                </p>

                                <p class="text-sm text-gray-500">
                                    Requested at {{ $adoption->created_at->format('d M Y') }}
                                </p>

                                {{-- Status --}}
                                <span
                                    class="inline-block mt-2 px-3 py-1 text-xs rounded-full
                        @if ($adoption->status === 'approved') bg-green-100 text-green-700
                        @elseif($adoption->status === 'rejected') bg-red-100 text-red-700
                        @else bg-yellow-100 text-yellow-700 @endif">
                                    {{ ucfirst($adoption->status) }}
                                </span>
                            </div>

                        </div>

                        {{-- Right Side --}}
                        <a href="{{ route('animals.show', $adoption->animal->slug) }}"
                            class="bg-indigo-600 text-white px-5 py-2 rounded-xl text-sm hover:bg-indigo-700 transition">
                            View Detail
                        </a>

                    </div>

                @empty
                    <p class="text-gray-500">No adoption requests yet.</p>
                @endforelse

            </div>

            {{-- ================= FAVORITES ================= --}}
            <div class="bg-white rounded-3xl shadow-xl p-10 border border-gray-100">

                <h2 class="text-2xl font-bold mb-8">My Favorites</h2>

                <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-8">

                    @forelse($favorites as $favorite)
                        <a href="{{ route('animals.show', $favorite->animal->slug) }}"
                            class="group bg-gray-50 rounded-2xl overflow-hidden hover:shadow-xl transition">

                            <img src="{{ $favorite->animal->images->first()
                                ? asset('storage/' . $favorite->animal->images->first()->image)
                                : 'https://via.placeholder.com/400x300' }}"
                                class="w-full h-52 object-cover group-hover:scale-105 transition">

                            <div class="p-5">
                                <p class="text-lg font-semibold group-hover:text-indigo-600 transition">
                                    {{ $favorite->animal->name }}
                                </p>
                            </div>

                        </a>

                    @empty
                        <p class="text-gray-500 col-span-full">
                            No favorites yet.
                        </p>
                    @endforelse

                </div>

            </div>

        </div>
    </section>
@endsection
