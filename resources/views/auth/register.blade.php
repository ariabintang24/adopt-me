<x-guest-layout>

    <h1 class="text-2xl font-semibold text-center text-gray-700 mb-6">
        Register
    </h1>

    <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
        @csrf

        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

            <!-- Name -->
            <div>
                <label class="text-sm text-gray-500">Name</label>
                <input type="text" name="name" value="{{ old('name') }}"
                    class="w-full mt-1 px-3 py-2 border border-gray-300 rounded-md text-gray-600 focus:ring-2 focus:ring-blue-500"
                    required>
            </div>

            <!-- Phone -->
            <div>
                <label class="text-sm text-gray-500">Phone Number</label>
                <input type="text" name="phone"
                    class="w-full mt-1 px-3 py-2 border border-gray-300 rounded-md text-gray-600 focus:ring-2 focus:ring-blue-500"
                    required>
            </div>

            <!-- Email -->
            <div class="md:col-span-2">
                <label class="text-sm text-gray-500">Email</label>
                <input type="email" name="email" value="{{ old('email') }}"
                    class="w-full mt-1 px-3 py-2 border border-gray-300 rounded-md text-gray-600 focus:ring-2 focus:ring-blue-500"
                    required>
            </div>

            <!-- Address -->
            <div class="md:col-span-2">
                <label class="text-sm text-gray-500">Address</label>
                <textarea name="address" rows="2"
                    class="w-full mt-1 px-3 py-2 border border-gray-300 rounded-md text-gray-600 focus:ring-2 focus:ring-blue-500"
                    required></textarea>
            </div>

            <!-- Avatar -->
            <div class="md:col-span-2">

                <label class="text-sm text-gray-500">Avatar</label>

                <div class="mt-2 flex items-center gap-4 border border-gray-300 rounded-md p-3">

                    <input type="file" name="avatar"
                        class="text-sm text-gray-500 file:mr-4 file:px-3 file:py-1 file:rounded-md file:border-0 file:bg-gray-100 file:text-gray-600 hover:file:bg-gray-200 cursor-pointer">

                </div>

            </div>

            <!-- Password -->
            <div class="md:col-span-2">
                <label class="text-sm text-gray-500">Password</label>
                <input type="password" name="password"
                    class="w-full mt-1 px-3 py-2 border border-gray-300 rounded-md text-gray-600 focus:ring-2 focus:ring-blue-500"
                    required>
            </div>

            <!-- Confirm Password -->
            <div class="md:col-span-2">
                <label class="text-sm text-gray-500">Confirm Password</label>
                <input type="password" name="password_confirmation"
                    class="w-full mt-1 px-3 py-2 border border-gray-300 rounded-md text-gray-600 focus:ring-2 focus:ring-blue-500"
                    required>
            </div>

        </div>

        <button class="w-full mt-8 bg-blue-600 hover:bg-blue-700 text-white py-3 rounded-md font-medium transition">
            Create account
        </button>

        <p class="text-center text-sm text-gray-500 mt-5">
            Already have an account?
            <a href="{{ route('login') }}" class="text-blue-600 font-medium">Login</a>
        </p>

    </form>

</x-guest-layout>
