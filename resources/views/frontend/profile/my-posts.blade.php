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

                {{-- CREATE POST --}}
                <a href="{{ route('animals.create') }}"
                    class="inline-flex items-center gap-2 bg-indigo-600 text-white px-5 py-3 rounded-xl shadow hover:bg-indigo-700 transition">

                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">

                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>

                    Post Animal
                </a>

            </div>


            {{-- POSTS GRID --}}
            <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-8">

                @forelse($animals as $animal)
                    <div class="bg-white rounded-2xl shadow-md overflow-hidden flex flex-col">

                        {{-- CARD --}}
                        @include('frontend.components.animal-card', ['animal' => $animal])

                        {{-- ACTIONS --}}
                        <div class="flex justify-end gap-3 px-5 py-4 border-t
            bg-gray-50 rounded-b-2xl">

                            {{-- EDIT --}}
                            <a href="{{ route('profile.posts.edit', $animal->id) }}"
                                class="group relative w-10 h-10 flex items-center justify-center
              rounded-lg bg-blue-100 hover:bg-blue-200 transition">

                                <svg class="w-5 h-5 text-blue-600" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-width="2">
                                    <path d="M3 17.25V21h3.75L17.81 9.94l-3.75-3.75L3 17.25z" />
                                    <path d="M14.06 4.94l3.75 3.75" />
                                </svg>

                                <span
                                    class="absolute -top-8 scale-0 group-hover:scale-100
                     bg-gray-900 text-white text-xs px-2 py-1 rounded transition">
                                    Edit
                                </span>
                            </a>


                            {{-- DELETE --}}
                            <form action="{{ route('profile.posts.delete', $animal->id) }}" method="POST">
                                @csrf
                                @method('DELETE')

                                <button onclick="return confirm('Delete this post?')"
                                    class="group relative w-10 h-10 flex items-center justify-center
                   rounded-lg bg-red-100 hover:bg-red-200 transition">

                                    <svg class="w-5 h-5 text-red-600" viewBox="0 0 24 24" fill="none"
                                        stroke="currentColor" stroke-width="2">
                                        <path d="M3 6h18" />
                                        <path d="M8 6V4h8v2" />
                                        <path d="M6 6l1 14h10l1-14" />
                                        <path d="M10 11v6" />
                                        <path d="M14 11v6" />
                                    </svg>

                                    <span
                                        class="absolute -top-8 scale-0 group-hover:scale-100
                         bg-gray-900 text-white text-xs px-2 py-1 rounded transition">
                                        Delete
                                    </span>

                                </button>
                            </form>

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
