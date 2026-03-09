<section class="bg-gray-50 py-20">
    <div class="max-w-6xl mx-auto px-6 text-center">

        <h2 class="text-3xl font-bold mb-14">
            How It Works
        </h2>

        <div class="grid md:grid-cols-3 gap-10">

            {{-- STEP 1 --}}
            <div class="bg-white p-8 rounded-3xl shadow">
                <div class="relative mb-6">
                    <img src="{{ asset('images/dog-cat.png') }}" class="rounded-2xl h-48 w-full object-cover">
                    <span
                        class="absolute top-4 left-4 bg-indigo-600 text-white w-8 h-8 rounded-full flex items-center justify-center text-sm font-bold">
                        1
                    </span>
                </div>

                <h4 class="font-semibold mb-2">Create an Account</h4>
                <p class="text-gray-600 text-sm">
                    Register and login to start adopting animals.
                </p>
            </div>

            {{-- STEP 2 --}}
            <div class="bg-white p-8 rounded-3xl shadow">
                <div class="relative mb-6">
                    <img src="{{ asset('images/hero-adopt.png') }}" class="rounded-2xl h-48 w-full object-cover">
                    <span
                        class="absolute top-4 left-4 bg-indigo-600 text-white w-8 h-8 rounded-full flex items-center justify-center text-sm font-bold">
                        2
                    </span>
                </div>

                <h4 class="font-semibold mb-2">Submit Adoption</h4>
                <p class="text-gray-600 text-sm">
                    Fill out the adoption form with correct information.
                </p>
            </div>

            {{-- STEP 3 --}}
            <div class="bg-white p-8 rounded-3xl shadow">
                <div class="relative mb-6">
                    <img src="{{ asset('images/dog-cat.png') }}" class="rounded-2xl h-48 w-full object-cover">
                    <span
                        class="absolute top-4 left-4 bg-indigo-600 text-white w-8 h-8 rounded-full flex items-center justify-center text-sm font-bold">
                        3
                    </span>
                </div>

                <h4 class="font-semibold mb-2">Wait for Approval</h4>
                <p class="text-gray-600 text-sm">
                    Track your adoption request until approved.
                </p>
            </div>

        </div>

    </div>
</section>
