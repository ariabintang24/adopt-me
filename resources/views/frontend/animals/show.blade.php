@extends('frontend.layouts.app')

@section('content')

    <section class="bg-gray-50 py-10 md:py-16">

        <div class="max-w-6xl mx-auto px-4 sm:px-6">

            {{-- TAGLINE --}}
            <div class="text-center lg:text-left mb-8">
                <h2 class="text-2xl md:text-3xl font-bold text-gray-900">
                    Find Your New Best Friend Today
                </h2>
                <p class="text-gray-500 mt-2">
                    Give them a loving home and they’ll give you unconditional love.
                </p>
            </div>


            {{-- MAIN WRAPPER CARD --}}
            <div class="bg-white rounded-3xl shadow-md overflow-hidden">

                <div class="grid grid-cols-1 lg:grid-cols-2">

                    {{-- ================= LEFT : PHOTO ================= --}}
                    @php
                        $images = $animal->images;
                    @endphp

                    <div class="p-6 md:p-8">

                        @if ($images->count())
                            <a href="{{ asset('storage/' . $images->first()->image) }}" class="glightbox"
                                data-gallery="animal-gallery">

                                <img src="{{ asset('storage/' . $images->first()->image) }}"
                                    class="w-full h-72 md:h-[420px] object-cover rounded-2xl cursor-zoom-in">
                            </a>
                        @endif


                        {{-- THUMBNAILS --}}
                        @if ($images->count() > 1)
                            <div class="grid grid-cols-4 gap-3 mt-5">
                                @foreach ($images as $image)
                                    <a href="{{ asset('storage/' . $image->image) }}" class="glightbox"
                                        data-gallery="animal-gallery">

                                        <img src="{{ asset('storage/' . $image->image) }}"
                                            class="h-16 w-full object-cover rounded-lg hover:opacity-80 transition">
                                    </a>
                                @endforeach
                            </div>
                        @endif

                    </div>



                    {{-- ================= RIGHT : DETAIL ================= --}}
                    <div class="p-6 md:p-10 border-t lg:border-t-0 lg:border-l flex flex-col">

                        {{-- TITLE --}}
                        <h1 class="text-2xl md:text-3xl font-bold mb-4">
                            {{ $animal->name }}
                        </h1>

                        {{-- ERROR MESSAGE
                        @if (session('error'))
                            <div class="bg-red-100 text-red-600 px-4 py-3 rounded-xl mb-6 text-sm">
                                {{ session('error') }}
                            </div>
                        @endif --}}

                        {{-- DESCRIPTION --}}
                        <div class="text-gray-700 text-sm md:text-base leading-relaxed mb-6">
                            {!! nl2br(e($animal->description)) !!}
                        </div>


                        <div class="border-t my-6"></div>


                        {{-- DETAIL INFO --}}
                        <h3 class="text-lg font-semibold mb-4">
                            Detail Information
                        </h3>


                        <div class="grid grid-cols-2 gap-y-4 text-sm mb-8">

                            <span class="text-gray-500">Status</span>
                            <span class="text-right">
                                <span
                                    class="px-3 py-1 rounded-full text-xs font-medium
                            {{ $animal->status === 'available' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                                    {{ ucfirst($animal->status) }}
                                </span>
                            </span>

                            <span class="text-gray-500">Code</span>
                            <span class="font-medium text-right">{{ $animal->code }}</span>

                            <span class="text-gray-500">Category</span>
                            <span class="font-medium text-right">{{ $animal->category->name ?? '-' }}</span>

                            <span class="text-gray-500">Usia</span>
                            <span class="font-medium text-right">{{ $animal->age }}</span>

                            <span class="text-gray-500">Gender</span>
                            <span class="font-medium text-right">{{ ucfirst($animal->gender) }}</span>

                            <span class="text-gray-500">Created At</span>
                            <span class="font-medium text-right">
                                {{ $animal->created_at->format('d M Y') }}
                            </span>

                            <span class="text-gray-500">Posted By</span>
                            <span class="font-medium text-right">
                                {{ $animal->createdBy ? $animal->createdBy->name : 'Admin' }}
                            </span>
                        </div>


                        {{-- ADOPT BUTTON --}}
                        @if (auth()->check())
                            <a href="{{ route('adoption.create', $animal->id) }}"
                                class="mt-auto bg-indigo-600 text-white px-6 py-3 rounded-xl
               text-sm font-semibold text-center
               hover:bg-indigo-700 transition shadow-md">
                                Adopt Me 🐾
                            </a>
                        @endif

                    </div>

                </div>

            </div>

        </div>

    </section>

@endsection
