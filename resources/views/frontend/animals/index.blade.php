@extends('frontend.layouts.app')

@section('content')
    <div class="max-w-7xl mx-auto px-6 py-16">

        <h2 class="text-3xl font-bold mb-10">
            Available Animals 🐾
        </h2>

        <div class="grid sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">

            @foreach ($animals as $animal)
                @include('frontend.components.animal-card', ['animal' => $animal])
            @endforeach

        </div>

        <div class="mt-10">
            {{ $animals->links() }}
        </div>

    </div>
@endsection
