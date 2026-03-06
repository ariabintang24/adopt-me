@extends('frontend.layouts.app')

@section('content')
    <section class="bg-gray-50 py-16">

        <div class="max-w-3xl mx-auto px-6">

            <div class="bg-white rounded-3xl shadow-md p-10">

                <h1 class="text-3xl font-bold mb-10 text-center">
                    Post Animal for Adoption
                </h1>

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

                <form action="{{ route('animals.store') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
                    @csrf


                    {{-- NAME --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-600 mb-2">
                            Animal Name
                        </label>

                        <input type="text" name="name"
                            class="w-full border border-gray-300 rounded-xl p-3 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
                            required>
                    </div>


                    {{-- CATEGORY + AGE --}}

                    <div class="grid md:grid-cols-2 gap-6 items-start">
                        {{-- CATEGORY --}}
                        <div>
                            <label class="block text-sm font-medium text-gray-600 mb-2">
                                Category
                            </label>

                            <select name="category_id"
                                class="w-full border border-gray-300 rounded-xl p-3 focus:ring-2 focus:ring-indigo-500">

                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">
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

                                <option value="">Select age range</option>
                                <option value="0-11">0 - 11 months</option>
                                <option value="1-3">1 - 3 years</option>
                                <option value="3-5">3 - 5 years</option>
                                <option value="5+">5+ years</option>

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

                            <option value="male">Male</option>
                            <option value="female">Female</option>

                        </select>

                    </div>


                    {{-- DESCRIPTION --}}
                    <div>

                        <label class="block text-sm font-medium text-gray-600 mb-2">
                            Description
                        </label>

                        <textarea name="description" rows="4"
                            class="w-full border border-gray-300 rounded-xl p-3 focus:ring-2 focus:ring-indigo-500" required></textarea>

                    </div>


                    {{-- IMAGES --}}
                    <div x-data="imageUploader()" class="space-y-4">

                        <label class="block text-sm font-medium text-gray-600">
                            Animal Photos
                        </label>

                        <input type="file" name="images[]" multiple accept="image/*" @change="handleFiles($event)"
                            class="w-full border border-gray-300 rounded-xl p-3 bg-white">

                        <p class="text-sm text-gray-400">
                            You can upload multiple photos (max 2MB each)
                        </p>

                        {{-- Preview --}}
                        <div class="grid grid-cols-3 gap-3 mt-3" x-show="files.length">

                            <template x-for="(file, index) in files" :key="index">

                                <div class="relative">

                                    <img :src="URL.createObjectURL(file)" class="h-24 w-full object-cover rounded-lg">

                                    <button type="button" @click="remove(index)"
                                        class="absolute top-1 right-1 bg-red-500 text-white
                           text-xs px-2 py-1 rounded">
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

                            Post Animal

                        </button>

                    </div>

                </form>

            </div>

        </div>

    </section>

    <script>
        function imageUploader() {
            return {

                files: [],

                handleFiles(event) {

                    const selected = Array.from(event.target.files);

                    selected.forEach(file => {
                        this.files.push(file);
                    });

                    this.updateInput(event.target);

                },

                remove(index) {

                    this.files.splice(index, 1);
                    this.updateInput(document.querySelector('input[type=file]'));


                },

                updateInput(input) {

                    const dataTransfer = new DataTransfer();

                    this.files.forEach(file => {
                        dataTransfer.items.add(file);
                    });

                    input.files = dataTransfer.files;

                }

            }
        }
    </script>
@endsection
