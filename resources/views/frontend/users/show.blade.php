@extends('frontend.layouts.app')

@section('content')
    <div class="max-w-7xl mx-auto px-6 py-12">

        {{-- MAIN GRID --}}
        <div class="grid lg:grid-cols-3 gap-10">

            {{-- ================= LEFT : PROFILE CARD ================= --}}
            <div>

                <div class="bg-white rounded-3xl shadow-md p-8 text-center">

                    {{-- Avatar --}}
                    <div class="w-24 h-24 mx-auto mb-4">
                        @if ($user->avatar)
                            <img src="{{ asset('storage/' . $user->avatar) }}"
                                class="w-24 h-24 rounded-full object-cover mx-auto">
                        @else
                            <div
                                class="w-24 h-24 rounded-full bg-gray-200 flex items-center justify-center text-xl font-semibold">
                                {{ strtoupper(substr($user->name, 0, 2)) }}
                            </div>
                        @endif
                    </div>

                    {{-- Name --}}
                    <h2 class="text-lg font-semibold">
                        {{ $user->name }}
                    </h2>

                    <p class="text-sm text-gray-400 mb-6">
                        Member since {{ $user->created_at->format('M Y') }}
                    </p>

                    {{-- Statistics --}}
                    <div class="flex justify-center mt-4">

                        <div class="bg-gray-50 rounded-xl p-5 text-center w-40">
                            <p class="text-2xl font-bold text-indigo-600">
                                {{ $animalsCount }}
                            </p>

                            <p class="text-xs text-gray-500 mt-1">
                                Animals Posted
                            </p>
                        </div>

                    </div>

                </div>

            </div>


            {{-- ================= RIGHT : ANIMALS ================= --}}
            <div class="lg:col-span-2">

                <div class="mb-6">

                    <h2 class="text-xl font-bold">
                        {{ $user->name }}'s Animals Posted
                        <span class="text-xl font-bold">
                            ({{ $animalsCount }})
                        </span>
                    </h2>

                </div>

                <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">

                    @forelse($animals as $animal)
                        @include('frontend.components.animal-card-compact', [
                            'animal' => $animal,
                        ])

                    @empty

                        <p class="text-gray-500 text-sm col-span-full text-center">
                            This user hasn't posted any animals yet 🐾
                        </p>
                    @endforelse

                </div>

            </div>

        </div>

    </div>
@endsection
