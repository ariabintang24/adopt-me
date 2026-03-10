@extends('frontend.layouts.app')

@section('content')
    <div class="max-w-5xl mx-auto py-12 px-6">

        <div class="bg-white rounded-3xl shadow-md p-10">

            @include('frontend.components.profile-header', [
                'title' => 'Edit Profile',
                'subtitle' => 'Update your account information',
                'back' => route('profile.index'),
            ])

            <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="grid md:grid-cols-3 gap-10">

                    {{-- AVATAR --}}
                    <div class="flex flex-col items-center">

                        <div class="relative">

                            @if ($user->avatar)
                                <img id="avatarPreview" src="{{ asset('storage/' . $user->avatar) }}"
                                    class="w-32 h-32 rounded-full object-cover">
                            @else
                                <div id="avatarPreview"
                                    class="w-32 h-32 rounded-full bg-gray-200 flex items-center justify-center text-2xl font-semibold">
                                    {{ strtoupper(substr($user->name, 0, 2)) }}
                                </div>
                            @endif

                        </div>

                        <label class="mt-4 text-sm text-indigo-600 cursor-pointer hover:underline">
                            Change Photo
                            <input type="file" name="avatar" class="hidden" onchange="previewAvatar(event)">
                        </label>

                        <p class="text-xs text-gray-400 mt-1">
                            JPG, PNG up to 2MB
                        </p>

                    </div>


                    {{-- FORM FIELDS --}}
                    <div class="md:col-span-2 space-y-6">

                        <div>
                            <label class="text-sm text-gray-500">Name</label>
                            <input type="text" name="name" value="{{ old('name', $user->name) }}"
                                class="w-full mt-1 px-3 py-2 border border-gray-300 rounded-md text-gray-600 focus:ring-2 focus:ring-indigo-500">
                        </div>

                        <div>
                            <label class="text-sm text-gray-500">Email</label>
                            <input type="email" value="{{ $user->email }}" disabled
                                class="w-full mt-1 px-3 py-2 border border-gray-200 rounded-md bg-gray-50 text-gray-400">
                        </div>

                        <div>
                            <label class="text-sm text-gray-500">Phone</label>
                            <input type="text" name="phone" value="{{ old('phone', $user->phone) }}"
                                class="w-full mt-1 px-3 py-2 border border-gray-300 rounded-md text-gray-600 focus:ring-2 focus:ring-indigo-500">
                        </div>

                        <div>
                            <label class="text-sm text-gray-500">Address</label>
                            <textarea name="address" rows="3"
                                class="w-full mt-1 px-3 py-2 border border-gray-300 rounded-md text-gray-600 focus:ring-2 focus:ring-indigo-500">{{ old('address', $user->address) }}</textarea>
                        </div>

                        <div class="flex gap-4 pt-4">

                            <a href="{{ route('profile.index') }}"
                                class="px-6 py-2 rounded-lg bg-gray-100 hover:bg-gray-200 transition">
                                Cancel
                            </a>

                            <button class="px-6 py-2 rounded-lg bg-indigo-600 text-white hover:bg-indigo-700 transition">
                                Save Changes
                            </button>

                        </div>

                    </div>

                </div>

            </form>

        </div>

    </div>


    <script>
        function previewAvatar(event) {
            const reader = new FileReader();
            reader.onload = function() {
                const preview = document.getElementById('avatarPreview');

                if (preview.tagName === 'IMG') {
                    preview.src = reader.result;
                } else {
                    preview.innerHTML = '';
                    preview.style.backgroundImage = `url(${reader.result})`;
                    preview.style.backgroundSize = 'cover';
                }
            }
            reader.readAsDataURL(event.target.files[0]);
        }
    </script>
@endsection
