@extends('frontend.layouts.app')

@section('content')
    <section class="bg-white">
        <div class="max-w-7xl mx-auto px-6 py-20 grid md:grid-cols-2 gap-12 items-center">

            <div>
                <h1 class="text-4xl md:text-5xl font-bold leading-tight">
                    Give Them a <span class="text-indigo-600">Second Chance</span>
                </h1>

                <p class="mt-6 text-gray-600 text-lg">
                    Find your new best friend today. Adopt a loving animal and make a difference.
                </p>

                <a href="/animals"
                    class="inline-block mt-8 bg-indigo-600 text-white px-6 py-3 rounded-lg shadow hover:bg-indigo-700 transition">
                    Explore Animals
                </a>
            </div>

            <div>
                <img src="{{ asset('images/hero-adopt.png') }}" class="rounded-2xl"
                    alt="Adopt Animal">
            </div>

        </div>
    </section>
@endsection
