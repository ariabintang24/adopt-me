<nav class="bg-white shadow-sm">
    <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">

        <a href="/" class="text-xl font-bold text-indigo-600">
            AdoptMe 🐾
        </a>

        <div class="space-x-6 hidden md:flex">
            <a href="/" class="hover:text-indigo-600">Home</a>
            <a href="/animals" class="hover:text-indigo-600">Animals</a>

            @auth
                <a href="/profile" class="hover:text-indigo-600">Profile</a>
            @else
                <a href="/login" class="hover:text-indigo-600">Login</a>
            @endauth
        </div>
    </div>
</nav>
