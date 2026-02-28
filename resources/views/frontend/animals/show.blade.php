@extends('frontend.layouts.app')

@section('content')

    <section class="bg-gray-50 py-16">
        <div class="max-w-6xl mx-auto px-6">

            <div class="grid lg:grid-cols-2 gap-10">

                {{-- ================= PHOTO CARD ================= --}}
                @php
                    $images = $animal->images;
                @endphp

                <div class="bg-white rounded-3xl shadow-lg p-6">

                    {{-- MAIN IMAGE --}}
                    @if ($images->count())
                        <a href="{{ asset('storage/' . $images->first()->image) }}" class="glightbox"
                            data-gallery="animal-gallery">

                            <img src="{{ asset('storage/' . $images->first()->image) }}"
                                class="w-full h-[480px] object-cover rounded-2xl cursor-zoom-in">
                        </a>
                    @endif

                    {{-- THUMBNAILS --}}
                    @if ($images->count() > 1)
                        <div class="grid grid-cols-4 gap-4 mt-6">

                            @foreach ($images as $image)
                                <a href="{{ asset('storage/' . $image->image) }}" class="glightbox"
                                    data-gallery="animal-gallery"> {{-- 🔥 grouping disini --}}

                                    <img src="{{ asset('storage/' . $image->image) }}"
                                        class="h-24 w-full object-cover rounded-xl cursor-pointer hover:opacity-80 transition">
                                </a>
                            @endforeach

                        </div>
                    @endif

                </div>


                {{-- ================= DETAIL CARD ================= --}}
                <div class="bg-white rounded-3xl shadow-lg p-8">

                    {{-- Header --}}
                    <div class="flex justify-between items-start mb-6">
                        <h1 class="text-3xl font-bold">
                            {{ $animal->name }}
                        </h1>

                        {{-- <a href="{{ auth()->check() ? url('/adoption/create/' . $animal->id) : route('login') }}"
                            class="bg-indigo-600 text-white px-6 py-2.5 rounded-xl shadow hover:bg-indigo-700 transition">
                            Adopt Me 🐾
                        </a> --}}

                        <a href="{{ route('adoption.create', $animal->id) }}"
                            class="bg-indigo-600 text-white px-6 py-2.5 rounded-xl">
                            Adopt Me 🐾
                        </a>

                    </div>

                    @if (session('error'))
                        <div class="bg-red-100 text-red-600 px-4 py-3 rounded-xl mb-6">
                            {{ session('error') }}
                        </div>
                    @endif

                    {{-- Description --}}
                    <p class="text-gray-700 mb-8">
                        {{ $animal->description }}
                    </p>

                    <div class="border-t my-8"></div>

                    {{-- Detail Information --}}
                    <h3 class="text-lg font-semibold mb-6">
                        Detail Information
                    </h3>

                    <div class="space-y-5 text-sm">

                        <div class="flex justify-between">
                            <span class="text-gray-500">Status</span>
                            <span
                                class="px-4 py-1.5 rounded-full text-xs font-medium
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
                            <span class="font-medium">
                                {{ $animal->created_at->format('d M Y | H:i') }}
                            </span>
                        </div>

                    </div>

                </div>

            </div>

        </div>
    </section>

@endsection
