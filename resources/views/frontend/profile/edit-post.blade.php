@extends('frontend.layouts.app')

@section('content')

    <section class="bg-gray-50 py-16">

        <div class="max-w-3xl mx-auto px-6">

            <div class="bg-white rounded-3xl shadow-md p-10">

                @include('frontend.components.profile-header', [
                    'title' => 'Edit Animal Post',
                    'back' => route('profile.my-posts'),
                ])

                {{-- ERROR MESSAGE --}}
                @if ($errors->any())
                    <div class="bg-red-100 text-red-600 p-4 rounded-xl mb-6 text-sm">
                        <ul class="list-disc pl-5">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('profile.posts.update', $animal->id) }}" method="POST" enctype="multipart/form-data"
                    class="space-y-8">

                    @csrf
                    @method('PUT')

                    {{-- NAME --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-600 mb-2">
                            Animal Name
                        </label>

                        <input type="text" name="name" value="{{ old('name', $animal->name) }}"
                            class="w-full border border-gray-300 rounded-xl p-3 focus:ring-2 focus:ring-indigo-500">
                    </div>


                    {{-- CATEGORY + AGE --}}
                    <div class="grid md:grid-cols-2 gap-6">

                        {{-- CATEGORY --}}
                        <div>
                            <label class="block text-sm font-medium text-gray-600 mb-2">
                                Category
                            </label>

                            <select name="category_id"
                                class="w-full border border-gray-300 rounded-xl p-3 focus:ring-2 focus:ring-indigo-500">

                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}"
                                        {{ $animal->category_id == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach

                            </select>
                        </div>


                        {{-- AGE --}}
                        <div>
                            <label class="block text-sm font-medium text-gray-600 mb-2">
                                Age
                            </label>

                            <select name="age_range"
                                class="w-full border border-gray-300 rounded-xl p-3 focus:ring-2 focus:ring-indigo-500">

                                <option value="0-11" {{ $animal->age_range == '0-11' ? 'selected' : '' }}>
                                    0 - 11 months
                                </option>

                                <option value="1-3" {{ $animal->age_range == '1-3' ? 'selected' : '' }}>
                                    1 - 3 years
                                </option>

                                <option value="3-5" {{ $animal->age_range == '3-5' ? 'selected' : '' }}>
                                    3 - 5 years
                                </option>

                                <option value="5+" {{ $animal->age_range == '5+' ? 'selected' : '' }}>
                                    5+ years
                                </option>

                            </select>
                        </div>

                    </div>


                    {{-- GENDER --}}
                    <div>

                        <label class="block text-sm font-medium text-gray-600 mb-2">
                            Gender
                        </label>

                        <select name="gender"
                            class="w-full border border-gray-300 rounded-xl p-3 focus:ring-2 focus:ring-indigo-500">

                            <option value="male" {{ $animal->gender == 'male' ? 'selected' : '' }}>
                                Male
                            </option>

                            <option value="female" {{ $animal->gender == 'female' ? 'selected' : '' }}>
                                Female
                            </option>

                        </select>

                    </div>


                    {{-- DESCRIPTION --}}
                    <div>

                        <label class="block text-sm font-medium text-gray-600 mb-2">
                            Description
                        </label>

                        <textarea name="description" rows="4"
                            class="w-full border border-gray-300 rounded-xl p-3 focus:ring-2 focus:ring-indigo-500">{{ old('description', $animal->description) }}</textarea>

                    </div>

                    @if ($animal->images->count())
                        <div class="space-y-3">
                            <label class="block text-sm font-medium text-gray-600">
                                Current Photos
                            </label>

                            <div class="grid grid-cols-3 gap-3">

                                @foreach ($animal->images as $image)
                                    <div class="relative group">

                                        <img src="{{ asset('storage/' . $image->image) }}"
                                            class="h-24 w-full object-cover rounded-lg">

                                        <button type="button" onclick="removeOldImage({{ $image->id }}, this)"
                                            class="absolute top-1 right-1 bg-red-500 text-white text-xs px-2 py-1 rounded opacity-0 group-hover:opacity-100 transition">
                                            ✕
                                        </button>

                                        <input type="hidden" name="existing_images[]" value="{{ $image->id }}">

                                    </div>
                                @endforeach

                            </div>

                            <p class="text-xs text-gray-400">
                                Click ✕ to remove an image before saving.
                            </p>
                        </div>
                    @endif

                    <div x-data="imageUploader()" class="space-y-4">

                        <label class="block text-sm font-medium text-gray-600">
                            Add New Photos
                        </label>

                        <input type="file" name="images[]" multiple accept="image/*" @change="handleFiles($event)"
                            class="w-full border border-gray-300 rounded-xl p-3 bg-white">

                        <p class="text-sm text-gray-400">
                            Upload additional photos (max 2MB each)
                        </p>

                        <!-- Preview gambar baru -->
                        <div class="grid grid-cols-3 gap-3 mt-3" x-show="files.length">

                            <template x-for="(file, index) in files" :key="index">
                                <div class="relative">

                                    <img :src="URL.createObjectURL(file)" class="h-24 w-full object-cover rounded-lg">

                                    <button type="button" @click="remove(index)"
                                        class="absolute top-1 right-1 bg-red-500 text-white text-xs px-2 py-1 rounded">
                                        ✕
                                    </button>

                                </div>
                            </template>

                        </div>

                    </div>


                    {{-- BUTTON --}}
                    <div class="pt-4">

                        <button
                            class="w-full bg-indigo-600 text-white py-3 rounded-xl font-semibold hover:bg-indigo-700 transition">

                            Update Post

                        </button>

                    </div>

                </form>

            </div>

        </div>
    </section>

    <script>
        function removeOldImage(id, button) {

            const container = button.closest('.relative');

            container.remove();

            const hiddenInputs = document.querySelectorAll(
                'input[name="existing_images[]"]'
            );

            hiddenInputs.forEach(input => {
                if (input.value == id) {
                    input.remove();
                }
            });
        }
    </script>

    <script>
        function imageUploader() {
            return {

                files: [],

                handleFiles(event) {
                    const selected = Array.from(event.target.files);

                    selected.forEach(file => {
                        this.files.push(file);
                    });

                    this.syncInput(event.target);
                },

                remove(index) {
                    this.files.splice(index, 1);

                    const input = document.querySelector('input[name="images[]"]');
                    this.syncInput(input);
                },

                syncInput(input) {
                    const dt = new DataTransfer();

                    this.files.forEach(file => {
                        dt.items.add(file);
                    });

                    input.files = dt.files;
                }

            }
        }
    </script>
@endsection
