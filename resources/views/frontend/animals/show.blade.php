@extends('frontend.layouts.app')

@section('content')

    <section class="bg-gray-50 py-10 md:py-16">
        <div class="max-w-5xl mx-auto px-4 sm:px-6">

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 md:gap-10">

                {{-- ================= PHOTO CARD ================= --}}
                @php
                    $images = $animal->images;
                @endphp

                <div class="space-y-4">

                    {{-- 💛 ADOPTION TAGLINE --}}
                    <div class="text-center lg:text-left">
                        <h2 class="text-xl md:text-2xl font-bold text-gray-900">
                            Find Your New Best Friend Today
                        </h2>
                        <p class="text-sm text-gray-500 mt-1">
                            Give them a loving home and they’ll give you unconditional love.
                        </p>
                    </div>

                    <div class="bg-white rounded-3xl shadow-lg p-4 md:p-6">

                        {{-- MAIN IMAGE --}}
                        @if ($images->count())
                            <a href="{{ asset('storage/' . $images->first()->image) }}" class="glightbox"
                                data-gallery="animal-gallery">

                                <img src="{{ asset('storage/' . $images->first()->image) }}"
                                    class="w-full h-64 sm:h-80 md:h-[450px] object-cover rounded-2xl cursor-zoom-in">
                            </a>
                        @endif

                        {{-- THUMBNAILS --}}
                        @if ($images->count() > 1)
                            <div class="grid grid-cols-4 gap-3 mt-4 md:mt-6">
                                @foreach ($images as $image)
                                    <a href="{{ asset('storage/' . $image->image) }}" class="glightbox"
                                        data-gallery="animal-gallery">

                                        <img src="{{ asset('storage/' . $image->image) }}"
                                            class="h-16 sm:h-20 w-full object-cover rounded-xl hover:opacity-80 transition">
                                    </a>
                                @endforeach
                            </div>
                        @endif

                    </div>
                </div>


                {{-- ================= DETAIL CARD ================= --}}
                <div class="bg-white rounded-3xl shadow-lg p-6 md:p-8 flex flex-col">

                    {{-- TITLE --}}
                    <h1 class="text-2xl md:text-3xl font-bold leading-tight mb-6">
                        {{ $animal->name }}
                    </h1>

                    @if (session('error'))
                        <div class="bg-red-100 text-red-600 px-4 py-3 rounded-xl mb-6 text-sm">
                            {{ session('error') }}
                        </div>
                    @endif

                    {{-- DESCRIPTION --}}
                    <div class="text-gray-700 text-sm md:text-base leading-relaxed mb-8">
                        {!! nl2br(e($animal->description)) !!}
                    </div>

                    <div class="border-t my-6"></div>

                    {{-- DETAIL INFORMATION --}}
                    <h3 class="text-lg font-semibold mb-6">
                        Detail Information
                    </h3>

                    <div class="space-y-4 text-sm mb-8">

                        <div class="flex justify-between items-center">
                            <span class="text-gray-500">Status</span>
                            <span
                                class="px-3 py-1 rounded-full text-xs font-medium
                            {{ $animal->status === 'available' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                                {{ ucfirst($animal->status) }}
                            </span>
                        </div>

                        <div class="flex justify-between">
                            <span class="text-gray-500">Code</span>
                            <span class="font-medium">{{ $animal->code }}</span>
                        </div>

                        <div class="flex justify-between">
                            <span class="text-gray-500">Category</span>
                            <span class="font-medium">
                                {{ $animal->category->name ?? '-' }}
                            </span>
                        </div>

                        <div class="flex justify-between">
                            <span class="text-gray-500">Usia</span>
                            <span class="font-medium">
                                {{ $animal->age }} year(s)
                            </span>
                        </div>

                        <div class="flex justify-between">
                            <span class="text-gray-500">Gender</span>
                            <span class="font-medium">
                                {{ ucfirst($animal->gender) }}
                            </span>
                        </div>

                        <div class="flex justify-between">
                            <span class="text-gray-500">Created At</span>
                            <span class="font-medium text-right">
                                {{ $animal->created_at->format('d M Y') }}
                            </span>
                        </div>

                    </div>

                    {{-- 💙 ADOPT BUTTON DI PALING BAWAH --}}
                    <a href="{{ route('adoption.create', $animal->id) }}"
                        class="mt-auto bg-indigo-600 text-white px-6 py-3 rounded-xl 
                          text-sm font-semibold text-center
                          w-full hover:bg-indigo-700 transition shadow-md">
                        Adopt Me 🐾
                    </a>

                </div>

            </div>

        </div>
    </section>

@endsection
