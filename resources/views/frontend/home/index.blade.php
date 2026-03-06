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

                {{-- CTA Buttons --}}
                <div class="mt-8 flex gap-4">

                    {{-- Explore --}}
                    <a href="{{ route('animals.index') }}"
                        class="group flex-1 flex items-center whitespace-nowrap justify-center gap-2
           bg-indigo-600 text-white px-6 py-3 rounded-xl shadow-md
           hover:bg-indigo-700 hover:shadow-lg
           transition-all duration-200">

                        {{-- paw icon --}}
                        <svg xmlns="http://www.w3.org/2000/svg"
                            class="w-5 h-5 transition-transform duration-200 group-hover:scale-110" fill="currentColor"
                            viewBox="0 0 24 24">
                            <path
                                d="M12 12c-2.5 0-4.5 1.6-4.5 3.5S9.5 19 12 19s4.5-1.6 4.5-3.5S14.5 12 12 12zM5 11c1 0 1.8-1.1 1.8-2.5S6 6 5 6 3.2 7.1 3.2 8.5 4 11 5 11zm14 0c1 0 1.8-1.1 1.8-2.5S20 6 19 6s-1.8 1.1-1.8 2.5S18 11 19 11zM8 7.5C9 7.5 9.8 6.4 9.8 5S9 2.5 8 2.5 6.2 3.6 6.2 5 7 7.5 8 7.5zm8 0c1 0 1.8-1.1 1.8-2.5S17 2.5 16 2.5 14.2 3.6 14.2 5 15 7.5 16 7.5z" />
                        </svg>

                        Explore Animals
                    </a>


                    {{-- Post Animal --}}
                    <a href="{{ route('animals.create') }}"
                        class="group flex-1 flex items-center whitespace-nowrap justify-center gap-2
           bg-white border border-indigo-600 text-indigo-600
           px-6 py-3 rounded-xl shadow-md
           hover:bg-indigo-600 hover:text-white hover:shadow-lg
           transition-all duration-200">

                        {{-- plus icon --}}
                        <svg xmlns="http://www.w3.org/2000/svg"
                            class="w-5 h-5 transition-transform duration-200 group-hover:rotate-90" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                        </svg>

                        Post Animal
                    </a>

                </div>
            </div>

            <div>
                <img src="{{ asset('images/hero-adopt.png') }}" class="rounded-3xl" alt="Adopt Animal">
            </div>

        </div>
    </section>



    {{-- ================= CATEGORIES ================= --}}
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



    {{-- ================= LATEST ANIMALS ================= --}}
    <section class="bg-white py-20 border-t">
        <div class="max-w-6xl mx-auto px-6">

            <div class="flex justify-between items-center mb-14">
                <h2 class="text-3xl font-bold">
                    Latest Animals
                </h2>

                <a href="{{ route('animals.index') }}" class="text-indigo-600 text-sm font-semibold">
                    View all →
                </a>
            </div>

            <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-10">
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
                        <svg class="faq-icon w-5 h-5 transition-transform duration-300" fill="none"
                            stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
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

            <form action="{{ route('contact.send') }}" method="POST" class="space-y-6 text-left">
                @csrf

                <div>
                    <label class="block text-sm font-medium mb-2">Name</label>
                    <input type="text" name="name"
                        class="w-full border rounded-xl p-3 focus:ring-2 focus:ring-indigo-500" placeholder="Your name"
                        required>
                </div>

                <div>
                    <label class="block text-sm font-medium mb-2">Email</label>
                    <input type="email" name="email"
                        class="w-full border rounded-xl p-3 focus:ring-2 focus:ring-indigo-500" placeholder="Your email"
                        required>
                </div>

                <div>
                    <label class="block text-sm font-medium mb-2">Message</label>
                    <textarea name="message" rows="5" class="w-full border rounded-xl p-3 focus:ring-2 focus:ring-indigo-500"
                        placeholder="Write your message..." required></textarea>
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
