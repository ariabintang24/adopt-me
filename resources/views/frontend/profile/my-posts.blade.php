@extends('frontend.layouts.app')

@section('content')
    <section class="bg-gray-50 py-16">
        <div class="max-w-7xl mx-auto px-6">

            {{-- HEADER --}}
            <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-10 gap-6">

                <div>
                    <h1 class="text-2xl md:text-3xl font-bold">
                        My Animal Posts
                    </h1>

                    <p class="text-gray-500 mt-1">
                        Manage animals you have posted for adoption
                    </p>
                </div>

                <a href="{{ route('animals.create') }}"
                    class="self-start inline-flex items-center gap-2 bg-indigo-600 text-white px-5 py-3 rounded-xl shadow hover:bg-indigo-700 transition">

                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">

                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />

                    </svg>

                    Post Animal
                </a>

            </div>


            {{-- POSTS GRID --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">

                @forelse($animals as $animal)
                    <div class="bg-white rounded-2xl shadow-md overflow-hidden flex flex-col">

                        {{-- IMAGE --}}
                        <img src="{{ $animal->images->first() ? asset('storage/' . $animal->images->first()->image) : asset('images/no-image.png') }}"
                            class="w-full h-56 object-cover transition duration-500 group-hover:scale-105">

                        {{-- CARD BODY --}}
                        <div class="p-6 flex flex-col flex-grow">

                            {{-- CATEGORY + AGE --}}
                            <div class="flex justify-between text-sm text-gray-500 mb-2">
                                <span>{{ $animal->category->name ?? 'Unknown' }}</span>
                                <span>{{ $animal->age ?? '-' }}</span>
                            </div>

                            {{-- NAME --}}
                            <h3 class="text-lg font-semibold text-gray-800">
                                <a href="{{ route('animals.show', $animal->slug) }}"
                                    class="hover:text-indigo-600 transition">
                                    {{ $animal->name }}
                                </a>
                            </h3>

                            {{-- GENDER --}}
                            <p class="text-sm text-gray-500 mt-1">
                                {{ ucfirst($animal->gender) }}
                            </p>


                            {{-- STATUS + ACTIONS --}}
                            <div class="mt-auto pt-4 flex items-center justify-between">

                                {{-- STATUS --}}
                                <span
                                    class="inline-block
                        {{ $animal->status === 'available' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}
                        text-xs font-medium px-4 py-1.5 rounded-full">

                                    {{ ucfirst($animal->status) }}

                                </span>


                                {{-- ACTION BUTTONS --}}
                                <div class="flex items-center gap-2">

                                    {{-- EDIT --}}
                                    <a href="{{ route('profile.posts.edit', $animal->id) }}"
                                        class="w-9 h-9 flex items-center justify-center
                           rounded-lg bg-blue-100 hover:bg-blue-200 transition">

                                        <svg class="w-4 h-4 text-blue-600" viewBox="0 0 24 24" fill="none"
                                            stroke="currentColor" stroke-width="2">

                                            <path d="M3 17.25V21h3.75L17.81 9.94
                                        l-3.75-3.75L3 17.25z" />
                                            <path d="M14.06 4.94l3.75 3.75" />

                                        </svg>

                                    </a>


                                    {{-- DELETE --}}
                                    <div x-data="{ open: false }">

                                        <button type="button" @click="open=true"
                                            class="w-9 h-9 flex items-center justify-center
                                rounded-lg bg-red-100 hover:bg-red-200 transition">

                                            <svg class="w-4 h-4 text-red-600" viewBox="0 0 24 24" fill="none"
                                                stroke="currentColor" stroke-width="2">

                                                <path d="M3 6h18" />
                                                <path d="M8 6V4h8v2" />
                                                <path d="M6 6l1 14h10l1-14" />
                                                <path d="M10 11v6" />
                                                <path d="M14 11v6" />

                                            </svg>

                                        </button>


                                        {{-- MODAL DELETE --}}
                                        <div x-show="open" x-transition
                                            class="fixed inset-0 flex items-center justify-center bg-black/40 z-50">

                                            <div class="bg-white rounded-xl shadow-xl p-6 w-80">

                                                <h3 class="text-lg font-semibold mb-2">
                                                    Delete Post
                                                </h3>

                                                <p class="text-sm text-gray-500 mb-6">
                                                    Are you sure you want to delete this animal post?
                                                </p>

                                                <div class="flex justify-end gap-3">

                                                    <button @click="open=false"
                                                        class="px-4 py-2 text-gray-600 hover:text-gray-900">
                                                        Cancel
                                                    </button>

                                                    <form action="{{ route('profile.posts.delete', $animal->id) }}"
                                                        method="POST">

                                                        @csrf
                                                        @method('DELETE')

                                                        <button
                                                            class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700">
                                                            Delete
                                                        </button>

                                                    </form>

                                                </div>

                                            </div>

                                        </div>

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                @empty

                    <div class="col-span-full flex flex-col items-center text-center py-20">

                        <img src="{{ asset('images/no-data.png') }}" class="w-40 mb-6 opacity-80">

                        <h3 class="text-xl font-semibold mb-2">
                            You haven't posted any animals yet
                        </h3>

                        <p class="text-gray-500 mb-6">
                            Start helping animals find a new home.
                        </p>

                        <a href="{{ route('animals.create') }}"
                            class="bg-indigo-600 text-white px-6 py-3 rounded-xl hover:bg-indigo-700 transition">
                            Post Your First Animal
                        </a>

                    </div>
                @endforelse

            </div>


            {{-- PAGINATION --}}
            <div class="mt-12">
                {{ $animals->links() }}
            </div>

        </div>
    </section>
@endsection
