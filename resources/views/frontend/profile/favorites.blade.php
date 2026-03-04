@extends('frontend.layouts.app')

@section('content')
    <section class="bg-gray-50 py-10">
        <div class="max-w-5xl mx-auto px-4 sm:px-6">

            <div class="bg-white rounded-3xl p-6 md:p-10 border border-gray-100">

                @include('frontend.components.profile-header', [
                    'title' => 'My Favorites (' . $favorites->total() . ')',
                ])

                @if ($favorites->count())
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 md:gap-8">

                        @foreach ($favorites as $animal)
                            @include('frontend.components.animal-card-compact', [
                                'animal' => $animal,
                            ])
                        @endforeach

                    </div>
                @else
                    <div class="py-12 text-center text-gray-500">
                        No favorites yet 🐾
                    </div>
                @endif

            </div>

            {{-- PAGINATION --}}
            @if ($favorites->hasPages())
                <div class="mt-10">
                    {{ $favorites->links() }}
                </div>
            @endif
    </section>

@endsection
