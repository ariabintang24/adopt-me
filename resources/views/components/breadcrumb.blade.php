<nav class="text-sm text-gray-400 mb-6">
    <ol class="flex items-center gap-2">

        <li>
            <a href="{{ route('profile.index') }}" class="hover:text-gray-600">
                Profile
            </a>
        </li>

        @if (isset($current))
            <li>/</li>
            <li class="text-gray-600">
                {{ $current }}
            </li>
        @endif

    </ol>
</nav>
