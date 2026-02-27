@extends('frontend.layouts.app')

@section('content')

    <div class="max-w-7xl mx-auto px-6 py-16">

        <div class="grid md:grid-cols-2 gap-12">

            {{-- Image Gallery --}}
            <div>
                <img
                    src="{{ $animal->images->first()
                        ? asset('storage/' . $animal->images->first()->image)
                        : 'https://via.placeholder.com/400' }}">

                @if ($animal->images->count() > 1)
                    <div class="grid grid-cols-4 gap-4 mt-4">
                        @foreach ($animal->images as $image)
                            <img src="{{ $image->image }}" class="rounded-lg object-cover h-24 w-full">
                        @endforeach
                    </div>
                @endif
            </div>

            {{-- Animal Info --}}
            <div>
                <h1 class="text-3xl font-bold">
                    {{ $animal->name }}
                </h1>

                <p class="text-gray-500 mt-2">
                    {{ $animal->age }} year(s) • {{ ucfirst($animal->gender) }}
                </p>

                <p class="mt-6 text-gray-700 leading-relaxed">
                    {{ $animal->description }}
                </p>

                <div class="mt-8">
                    <a href="{{ auth()->check() ? url('/adoption/create/' . $animal->id) : route('login') }}"
                        class="inline-block bg-indigo-600 text-white px-6 py-3 rounded-lg shadow hover:bg-indigo-700 transition">
                        Adopt This Animal 🐾
                    </a>
                </div>
            </div>

        </div>

    </div>

@endsection
