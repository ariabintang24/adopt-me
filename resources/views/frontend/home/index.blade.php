@extends('frontend.layouts.app')

@section('content')
    @php use Illuminate\Support\Facades\Storage; @endphp
    {{-- ================= HERO ================= --}}
    <section class="bg-white">
        <div class="max-w-7xl mx-auto px-6 py-20 grid md:grid-cols-2 gap-12 items-center">

            <div>
                <h1 class="text-4xl md:text-5xl font-bold leading-tight">
                    Give Them a <span class="text-indigo-600">Second Chance</span>
                </h1>

                <p class="mt-6 text-gray-600 text-lg">
                    Find your new best friend today. Adopt a loving animal and make a difference.
                </p>

                <a href="{{ route('animals.index') }}"
                    class="inline-block mt-8 bg-indigo-600 text-white px-6 py-3 rounded-xl shadow hover:bg-indigo-700 transition">
                    Explore Animals
                </a>
            </div>

            <div>
                <img src="{{ asset('images/hero-adopt.png') }}" class="rounded-3xl" alt="Adopt Animal">
            </div>

        </div>
    </section>



    {{-- ================= CATEGORIES ================= --}}
    <section class="bg-gray-50 py-16">
        <div class="max-w-7xl mx-auto px-6">

            <div class="flex justify-between items-center mb-10">
                <h2 class="text-2xl font-bold">Browse by Category</h2>
            </div>

            <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-6">
                @foreach ($categories as $category)
                    <a href="{{ route('animals.index', ['category' => $category->id]) }}"
                        class="bg-white p-6 rounded-2xl shadow hover:shadow-xl transition text-center">

                        <div class="flex justify-center mb-4">
                            <img src="{{ Storage::url($category->image) }}" class="w-12 h-12 object-contain"
                                alt="{{ $category->name }}">
                        </div>

                        <p class="text-sm font-semibold text-gray-700">
                            {{ $category->name }}
                        </p>

                    </a>
                @endforeach
            </div>

        </div>
    </section>



    {{-- ================= LATEST ANIMALS ================= --}}
    <section class="bg-white py-16">
        <div class="max-w-7xl mx-auto px-6">

            <div class="flex justify-between items-center mb-10">
                <h2 class="text-2xl font-bold">Latest Animals</h2>

                <a href="{{ route('animals.index') }}" class="text-indigo-600 text-sm font-medium hover:underline">
                    View all →
                </a>
            </div>

            <div class="grid sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
                @foreach ($latestAnimals as $animal)
                    @include('frontend.components.animal-card', ['animal' => $animal])
                @endforeach
            </div>

        </div>
    </section>



    {{-- ================= HOW IT WORKS ================= --}}
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

    {{-- ================= ACCORDION ================= --}}

    <section class="py-16 bg-gray-50">
        <div class="max-w-4xl mx-auto px-6">

            <h2 class="text-3xl md:text-4xl font-bold text-center text-gray-900 mb-12">
                Pertanyaan Seputar Adopsi Hewan
            </h2>

            <div class="space-y-4">

                <!-- Item 1 -->
                <div class="faq-item bg-white rounded-xl shadow-sm border border-gray-200 transition">
                    <button
                        class="faq-question w-full flex justify-between items-center text-left p-6 font-semibold text-gray-800 text-lg">
                        <span>Bagaimana cara mengadopsi hewan di website ini?</span>
                        <svg class="faq-icon w-5 h-5 transition-transform duration-300" fill="none" stroke="currentColor"
                            stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>

                    <div class="faq-answer max-h-0 overflow-hidden transition-all duration-300 px-6">
                        <p class="pb-6 text-gray-600">
                            Pilih hewan yang ingin diadopsi, klik tombol "Ajukan Adopsi",
                            isi formulir yang tersedia, lalu tunggu konfirmasi dari admin.
                        </p>
                    </div>
                </div>

                <!-- Item 2 -->
                <div class="faq-item bg-white rounded-xl shadow-sm border border-gray-200 transition">
                    <button
                        class="faq-question w-full flex justify-between items-center text-left p-6 font-semibold text-gray-800 text-lg">
                        <span>Apakah ada biaya untuk proses adopsi?</span>
                        <svg class="faq-icon w-5 h-5 transition-transform duration-300" fill="none" stroke="currentColor"
                            stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>

                    <div class="faq-answer max-h-0 overflow-hidden transition-all duration-300 px-6">
                        <p class="pb-6 text-gray-600">
                            Beberapa hewan memiliki biaya adopsi untuk membantu biaya
                            perawatan, vaksin, dan sterilisasi. Detail biaya akan ditampilkan
                            pada halaman profil hewan.
                        </p>
                    </div>
                </div>

                <!-- Item 3 -->
                <div class="faq-item bg-white rounded-xl shadow-sm border border-gray-200 transition">
                    <button
                        class="faq-question w-full flex justify-between items-center text-left p-6 font-semibold text-gray-800 text-lg">
                        <span>Apakah saya bisa bertemu hewan sebelum mengadopsi?</span>
                        <svg class="faq-icon w-5 h-5 transition-transform duration-300" fill="none" stroke="currentColor"
                            stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>

                    <div class="faq-answer max-h-0 overflow-hidden transition-all duration-300 px-6">
                        <p class="pb-6 text-gray-600">
                            Ya, setelah pengajuan disetujui, kamu dapat menjadwalkan
                            pertemuan dengan shelter atau pemilik sebelumnya.
                        </p>
                    </div>
                </div>

                <!-- Item 4 -->
                <div class="faq-item bg-white rounded-xl shadow-sm border border-gray-200 transition">
                    <button
                        class="faq-question w-full flex justify-between items-center text-left p-6 font-semibold text-gray-800 text-lg">
                        <span>Bagaimana jika pengajuan adopsi saya ditolak?</span>
                        <svg class="faq-icon w-5 h-5 transition-transform duration-300" fill="none" stroke="currentColor"
                            stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>

                    <div class="faq-answer max-h-0 overflow-hidden transition-all duration-300 px-6">
                        <p class="pb-6 text-gray-600">
                            Pengajuan dapat ditolak jika tidak memenuhi kriteria adopsi.
                            Kamu tetap bisa mengajukan adopsi untuk hewan lainnya.
                        </p>
                    </div>
                </div>

            </div>
        </div>
    </section>



    {{-- ================= CONTACT ================= --}}
    <section class="bg-white py-20">
        <div class="max-w-3xl mx-auto px-6 text-center">

            <h2 class="text-3xl font-bold mb-4">
                Contact Us
            </h2>

            <p class="text-gray-600 mb-10">
                Have questions? Send us a message.
            </p>

            <form action="#" method="POST" class="space-y-6 text-left">
                @csrf

                <div>
                    <label class="block text-sm font-medium mb-2">Name</label>
                    <input type="text" class="w-full border rounded-xl p-3 focus:ring-2 focus:ring-indigo-500"
                        placeholder="Your name">
                </div>

                <div>
                    <label class="block text-sm font-medium mb-2">Email</label>
                    <input type="email" class="w-full border rounded-xl p-3 focus:ring-2 focus:ring-indigo-500"
                        placeholder="Your email">
                </div>

                <div>
                    <label class="block text-sm font-medium mb-2">Message</label>
                    <textarea rows="5" class="w-full border rounded-xl p-3 focus:ring-2 focus:ring-indigo-500"
                        placeholder="Write your message..."></textarea>
                </div>

                <button type="submit"
                    class="bg-indigo-600 text-white px-6 py-3 rounded-xl hover:bg-indigo-700 transition">
                    Send Message →
                </button>
            </form>

        </div>
    </section>

    <script>
        document.querySelectorAll(".faq-question").forEach(button => {
            button.addEventListener("click", () => {
                const item = button.parentElement;
                const answer = item.querySelector(".faq-answer");
                const icon = item.querySelector(".faq-icon");

                const isOpen = answer.style.maxHeight;

                document.querySelectorAll(".faq-answer").forEach(a => {
                    a.style.maxHeight = null;
                });

                document.querySelectorAll(".faq-icon").forEach(i => {
                    i.classList.remove("rotate-180");
                });

                if (!isOpen) {
                    answer.style.maxHeight = answer.scrollHeight + "px";
                    icon.classList.add("rotate-180");
                }
            });
        });
    </script>
@endsection
