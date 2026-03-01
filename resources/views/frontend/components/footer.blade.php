<footer class="mt-20 bg-white px-6 sm:px-12 lg:px-24 pt-16 pb-8">

    <!-- TOP SECTION -->
    <div class="grid md:grid-cols-3 gap-12 md:items-start">

        <!-- LEFT -->
        <div>
            <h2 class="text-2xl font-bold text-gray-900">
                AdoptMe 🐾
            </h2>

            <p class="mt-4 text-gray-600 max-w-sm">
                Platform adopsi hewan untuk membantu anabul menemukan
                rumah dan keluarga baru yang penuh kasih.
            </p>

            <div class="mt-6 space-y-4">

                <div class="bg-white border border-gray-200 rounded-xl px-4 py-3 shadow-sm text-sm text-gray-700">
                    ✉️ support@adoptme.id
                </div>

                <div class="bg-white border border-gray-200 rounded-xl px-4 py-3 shadow-sm text-sm text-gray-700">
                    📍 Indonesia
                </div>

            </div>
        </div>

        <!-- MIDDLE -->
        <div class="md:justify-self-center">
            <h3 class="text-lg font-semibold mb-4 text-gray-900">
                Quick Links
            </h3>

            <ul class="space-y-3 text-gray-600">
                <li>
                    <a href="{{ route('home') }}" class="hover:text-emerald-600 transition-colors duration-300">
                        Home
                    </a>
                </li>

                <li>
                    <a href="{{ route('home') }}" class="hover:text-emerald-600 transition-colors duration-300">
                        Daftar Hewan
                    </a>
                </li>

                <li>
                    <a href="{{ route('home') }}" class="hover:text-emerald-600 transition-colors duration-300">
                        Pengajuan Adopsi
                    </a>
                </li>
            </ul>
        </div>

        <!-- RIGHT (Social Media) -->
        <div class="flex gap-4">

            <a href="https://github.com/" target="_blank"
                class="w-10 h-10 flex items-center justify-center
              bg-white border border-gray-200 rounded-lg shadow-md
              hover:scale-110 hover:text-emerald-600
              transition-all duration-300">
                <i class="fa-brands fa-github text-lg"></i>
            </a>

            <a href="https://instagram.com/" target="_blank"
                class="w-10 h-10 flex items-center justify-center
              bg-white border border-gray-200 rounded-lg shadow-md
              hover:scale-110 hover:text-emerald-600
              transition-all duration-300">
                <i class="fa-brands fa-instagram text-lg"></i>
            </a>

            <a href="https://facebook.com/" target="_blank"
                class="w-10 h-10 flex items-center justify-center
              bg-white border border-gray-200 rounded-lg shadow-md
              hover:scale-110 hover:text-emerald-600
              transition-all duration-300">
                <i class="fa-brands fa-facebook text-lg"></i>
            </a>

        </div>
    </div>

    <!-- DIVIDER -->
    <div class="border-t border-gray-300 mt-12 pt-6 text-center text-sm text-gray-500">
        © {{ date('Y') }} AdoptMe. All rights reserved.
        <br>
        Dibuat dengan ❤️ untuk para pecinta hewan
    </div>

</footer>
