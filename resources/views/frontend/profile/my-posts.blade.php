@extends('frontend.layouts.app')

@section('content')
    <section class="bg-gray-50 py-16">
        <div class="max-w-6xl mx-auto px-6">

            <h1 class="text-2xl font-bold mb-8">
                My Animal Posts
            </h1>

            <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-8">

                @forelse($animals as $animal)
                    @include('frontend.components.animal-card', ['animal' => $animal])
                @empty
                    <p class="text-gray-500">
                        You haven't posted any animals yet.
                    </p>
                @endforelse

            </div>

            <div class="mt-10">
                {{ $animals->links() }}
            </div>

        </div>
    </section>
@endsection
