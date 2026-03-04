@extends('frontend.layouts.app')

@section('content')
    <section class="bg-gray-50 py-10">
        <div class="max-w-5xl mx-auto px-4 sm:px-6">

            @include('frontend.components.profile-header', [
                'title' => 'My Adoption History',
            ])

            <div x-data="{ loading: true }" x-init="setTimeout(() => loading = false, 400)">

                {{-- ================= SKELETON ================= --}}
                <div x-show="loading">

                    @for ($i = 0; $i < 3; $i++)
                        <div class="p-5 md:p-6 border rounded-2xl mb-6 bg-white animate-pulse">

                            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">

                                {{-- LEFT --}}
                                <div class="flex items-center gap-4 md:gap-5">

                                    {{-- Image --}}
                                    <div class="w-20 h-20 rounded-xl bg-gray-200"></div>

                                    <div class="space-y-2">

                                        {{-- Name --}}
                                        <div class="h-5 bg-gray-200 rounded w-40"></div>

                                        {{-- Date --}}
                                        <div class="h-4 bg-gray-200 rounded w-28"></div>

                                        {{-- Status badge --}}
                                        <div class="h-6 bg-gray-200 rounded-full w-24 mt-2"></div>

                                    </div>
                                </div>

                                {{-- Button --}}
                                <div class="h-10 bg-gray-200 rounded-xl w-full md:w-32"></div>

                            </div>

                        </div>
                    @endfor

                </div>

                {{-- ================= REAL CONTENT ================= --}}
                <div x-show="!loading" x-transition.opacity.duration.300ms>

                    @forelse($adoptions as $adoption)
                        <div class="p-5 md:p-6 border rounded-2xl mb-6 bg-white">

                            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">

                                {{-- LEFT --}}
                                <div class="flex items-center gap-4 md:gap-5">
                                    <img src="{{ $adoption->animal->images->first()
                                        ? asset('storage/' . $adoption->animal->images->first()->image)
                                        : 'https://via.placeholder.com/120' }}"
                                        class="w-20 h-20 rounded-xl object-cover">

                                    <div>
                                        <p class="text-lg font-semibold">
                                            {{ $adoption->animal->name }}
                                        </p>

                                        <p class="text-sm text-gray-500">
                                            {{ $adoption->created_at->format('d M Y') }}
                                        </p>

                                        <span
                                            class="inline-block mt-2 px-3 py-1 text-xs rounded-full {{ $adoption->status_color }}">
                                            {{ $adoption->status_label }}
                                        </span>
                                    </div>
                                </div>

                                {{-- BUTTON --}}
                                <a href="{{ route('animals.show', $adoption->animal->slug) }}"
                                    class="bg-indigo-600 text-white px-5 py-2 rounded-xl text-sm 
                                w-full md:w-auto text-center">
                                    View Detail
                                </a>
                            </div>

                            {{-- ADMIN NOTE --}}
                            @if (in_array($adoption->status, ['rejected', 'auto_rejected']) && $adoption->admin_note)
                                <div class="mt-4 bg-red-50 border-l-4 border-red-500 p-4 rounded-lg">
                                    <p class="text-sm text-red-700">
                                        <span class="font-semibold">Admin Note:</span>
                                        {{ $adoption->admin_note }}
                                    </p>
                                </div>
                            @endif

                        </div>
                    @empty
                        <p class="text-gray-500">No adoption requests yet.</p>
                    @endforelse

                </div>

            </div>

            {{-- PAGINATION --}}
            @if ($adoptions->hasPages())
                <div class="mt-10">
                    {{ $adoptions->links() }}
                </div>
            @endif

        </div>

    </section>
@endsection
