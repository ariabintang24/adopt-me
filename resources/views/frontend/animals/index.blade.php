@extends('frontend.layouts.app')

@section('content')
    <section class="bg-gray-50 py-16">
        <div class="max-w-7xl mx-auto px-6">

            <div class="flex justify-between items-center mb-10">
                <h2 class="text-3xl font-bold">
                    Available Animals 🐾
                </h2>
            </div>

            <div class="grid sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-10">

                @forelse($animals as $animal)
                    @include('frontend.components.animal-card', ['animal' => $animal])
                @empty
                    <p>No animals available right now.</p>
                @endforelse

            </div>

            <div class="mt-10">
                {{ $animals->links() }}
            </div>

        </div>
    </section>
@endsection
