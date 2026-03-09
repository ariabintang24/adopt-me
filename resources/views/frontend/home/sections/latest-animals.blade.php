<section class="bg-gray-50 py-20">
    <div class="max-w-6xl mx-auto px-6">

        <div class="flex justify-between items-center mb-14">
            <h2 class="text-3xl font-bold">
                Latest Animals
            </h2>

            <a href="{{ route('animals.index') }}" class="text-indigo-600 text-sm font-semibold">
                View all
            </a>
        </div>

        <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-10">
            @foreach ($latestAnimals as $animal)
                @include('frontend.components.animal-card', ['animal' => $animal])
            @endforeach
        </div>

    </div>
</section>
