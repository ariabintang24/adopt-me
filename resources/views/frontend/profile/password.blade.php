@extends('frontend.layouts.app')

@section('content')
    <div class="max-w-3xl mx-auto py-12 px-6">

        <div class="bg-white rounded-3xl shadow-md p-10">

            <x-breadcrumb current="Change Password" />

            <h1 class="text-2xl font-semibold text-gray-700 mb-8">
                Change Password
            </h1>

            <form method="POST" action="{{ route('profile.password.update') }}">
                @csrf
                @method('PUT')

                <div class="space-y-6">

                    {{-- CURRENT PASSWORD --}}
                    <div>
                        <label class="text-sm text-gray-500">Current Password</label>

                        <div class="relative mt-1">
                            <input type="password" name="current_password" id="current_password"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md text-gray-600 focus:ring-2 focus:ring-indigo-500">

                            <button type="button" onclick="togglePassword('current_password')"
                                class="absolute right-3 top-2.5 text-gray-400">
                                👁
                            </button>
                        </div>
                    </div>


                    {{-- NEW PASSWORD --}}
                    <div>
                        <label class="text-sm text-gray-500">New Password</label>

                        <div class="relative mt-1">
                            <input type="password" name="password" id="password" oninput="checkStrength()"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md text-gray-600 focus:ring-2 focus:ring-indigo-500">

                            <button type="button" onclick="togglePassword('password')"
                                class="absolute right-3 top-2.5 text-gray-400">
                                👁
                            </button>
                        </div>

                        <div class="mt-2 h-2 bg-gray-200 rounded">
                            <div id="strengthBar" class="h-2 rounded transition-all"></div>
                        </div>

                        <p id="strengthText" class="text-xs text-gray-400 mt-1">
                            Password strength
                        </p>
                    </div>


                    {{-- CONFIRM PASSWORD --}}
                    <div>
                        <label class="text-sm text-gray-500">Confirm Password</label>

                        <div class="relative mt-1">
                            <input type="password" name="password_confirmation" id="password_confirmation"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md text-gray-600 focus:ring-2 focus:ring-indigo-500">

                            <button type="button" onclick="togglePassword('password_confirmation')"
                                class="absolute right-3 top-2.5 text-gray-400">
                                👁
                            </button>
                        </div>
                    </div>


                    <div class="flex gap-4 pt-4">

                        <a href="{{ route('profile.index') }}"
                            class="px-6 py-2 rounded-lg bg-gray-100 hover:bg-gray-200 transition">
                            Cancel
                        </a>

                        <button class="px-6 py-2 rounded-lg bg-indigo-600 text-white hover:bg-indigo-700 transition">
                            Update Password
                        </button>

                    </div>

                </div>

            </form>

        </div>

    </div>


    <script>
        function togglePassword(id) {
            const input = document.getElementById(id);
            input.type = input.type === "password" ? "text" : "password";
        }


        function checkStrength() {

            const password = document.getElementById("password").value;
            const bar = document.getElementById("strengthBar");
            const text = document.getElementById("strengthText");

            let strength = 0;

            if (password.length > 6) strength++;
            if (password.match(/[A-Z]/)) strength++;
            if (password.match(/[0-9]/)) strength++;
            if (password.match(/[^A-Za-z0-9]/)) strength++;

            if (strength === 0) {
                bar.style.width = "0%";
                text.innerText = "Password strength";
            }

            if (strength === 1) {
                bar.style.width = "25%";
                bar.className = "h-2 bg-red-500 rounded";
                text.innerText = "Weak password";
            }

            if (strength === 2) {
                bar.style.width = "50%";
                bar.className = "h-2 bg-yellow-500 rounded";
                text.innerText = "Medium password";
            }

            if (strength === 3) {
                bar.style.width = "75%";
                bar.className = "h-2 bg-blue-500 rounded";
                text.innerText = "Strong password";
            }

            if (strength === 4) {
                bar.style.width = "100%";
                bar.className = "h-2 bg-green-500 rounded";
                text.innerText = "Very strong password";
            }

        }
    </script>
@endsection
