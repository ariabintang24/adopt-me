<section class="bg-gray-50 py-20">
    <div class="max-w-6xl mx-auto px-6">

        <div class="text-center mb-14">
            <h2 class="text-3xl font-bold">
                Browse by Category
            </h2>
        </div>

        <div class="grid grid-cols-2 lg:grid-cols-6 gap-6">

            @foreach ($categories as $category)
                <a href="{{ route('animals.index', ['category' => $category->slug]) }}"
                    class="bg-white p-6 rounded-2xl shadow-md text-center flex flex-col items-center justify-center ">

                    <img src="{{ asset('storage/' . $category->image) }}"
                        class="w-12 h-12 object-contain mb-3 transform transition-all duration-300 hover:-translate-y-2"
                        alt="{{ $category->name }}">

                    <p class="text-sm font-semibold text-gray-700">
                        {{ $category->name }}
                    </p>

                </a>
            @endforeach

        </div>

    </div>
</section>
