@extends('frontend.layouts.app')

@section('content')
    <section class="py-16 bg-gray-50">
        <div class="max-w-xl mx-auto bg-white p-6 rounded-xl shadow">

            <h1 class="text-xl font-bold mb-6">Edit Animal Post</h1>

            <form action="{{ route('profile.posts.update', $animal->id) }}" method="POST">
                @csrf
                @method('PUT')

                <input type="text" name="name" value="{{ $animal->name }}" class="w-full border p-3 mb-4 rounded">

                <select name="category_id" class="w-full border p-3 mb-4 rounded">
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" {{ $animal->category_id == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>

                <input type="number" name="age_in_months" value="{{ $animal->age_in_months }}"
                    class="w-full border p-3 mb-4 rounded">

                <select name="gender" class="w-full border p-3 mb-4 rounded">
                    <option value="male" {{ $animal->gender == 'male' ? 'selected' : '' }}>Male</option>
                    <option value="female" {{ $animal->gender == 'female' ? 'selected' : '' }}>Female</option>
                </select>

                <textarea name="description" class="w-full border p-3 mb-4 rounded">{{ $animal->description }}</textarea>

                <button class="bg-indigo-600 text-white px-6 py-2 rounded">
                    Update Post
                </button>

            </form>

        </div>
    </section>
@endsection
