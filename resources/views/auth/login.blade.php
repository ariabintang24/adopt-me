<x-guest-layout>

    <div class="max-w-md mx-auto">

        {{-- Logo / App Name --}}
        <div class="text-center mb-8">
            <a href="{{ route('home') }}" class="text-xl font-semibold text-gray-700">
                {{ config('app.name') }}
            </a>
            <p class="text-sm text-gray-600 mt-1">
                Log in to continue
            </p>
        </div>

        {{-- Session message --}}
        @if (session('status'))
            <div class="mb-4 text-sm text-green-600 text-center">
                {{ session('status') }}
            </div>
        @endif


        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="space-y-6">

                {{-- EMAIL --}}
                <div>
                    <label class="text-sm text-gray-600">Email</label>

                    <div class="relative mt-1">

                        <!-- icon -->
                        <div class="absolute left-3 inset-y-0 flex items-center pointer-events-none">
                            <img src="{{ asset('images//icons/mail.png') }}" class="w-5 h-5 opacity-60">
                        </div>

                        <!-- input -->
                        <input type="email" name="email" value="{{ old('email') }}" required autofocus
                            class="w-full pl-11 pr-3 py-2.5 border border-gray-300 rounded-md text-gray-600 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">

                    </div>

                    @error('email')
                        <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>


                {{-- PASSWORD --}}
                <div>
                    <label class="text-sm text-gray-600">Password</label>

                    <div class="relative mt-1">

                        <!-- lock icon -->
                        <div class="absolute left-3 inset-y-0 flex items-center pointer-events-none">
                            <img src="{{ asset('images/icons/locked.png') }}" class="w-5 h-5 opacity-60">
                        </div>

                        <!-- password input -->
                        <input id="password" type="password" name="password" required
                            class="w-full pl-11 pr-11 py-2.5 border border-gray-300 rounded-md text-gray-600 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">

                        <!-- toggle icon -->
                        <button type="button" onclick="togglePassword()"
                            class="absolute right-3 inset-y-0 flex items-center">

                            <img id="toggleIcon" src="{{ asset('images/icons/show.png') }}" class="w-5 h-5 opacity-60">

                        </button>

                    </div>

                    @error('password')
                        <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>


                {{-- REMEMBER + FORGOT --}}
                <div class="flex items-center justify-between text-sm">

                    <label class="flex items-center gap-2 text-gray-600">
                        <input type="checkbox" name="remember"
                            class="rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                        Remember me
                    </label>

                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="text-indigo-600 hover:underline">
                            Forgot password?
                        </a>
                    @endif

                </div>


                {{-- LOGIN BUTTON --}}
                <button
                    class="w-full bg-indigo-600 hover:bg-indigo-700 text-white py-2.5 rounded-lg font-medium transition">
                    Log in
                </button>


                {{-- REGISTER --}}
                <p class="text-center text-sm text-gray-600">
                    Don't have an account?
                    <a href="{{ route('register') }}" class="text-indigo-600 hover:underline">
                        Register
                    </a>
                </p>

            </div>

        </form>

    </div>


    <script>
        function togglePassword() {

            const input = document.getElementById("password");
            const icon = document.getElementById("toggleIcon");

            if (input.type === "password") {
                input.type = "text";
                icon.src = "{{ asset('images/icons/hide.png') }}";
            } else {
                input.type = "password";
                icon.src = "{{ asset('images/icons/show.png') }}";
            }

        }
    </script>

</x-guest-layout>
