@extends('frontend.layouts.app')

@section('content')
    <section class="max-w-3xl mx-auto py-16 px-6">

        <h1 class="text-3xl font-bold mb-8">
            Post Animal for Adoption
        </h1>

        <form action="{{ route('animals.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf

            <div>
                <label>Name</label>
                <input type="text" name="name" class="w-full border rounded-xl p-3">
            </div>

            <div>
                <label>Category</label>
                <select name="category_id" class="w-full border rounded-xl p-3">
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block mb-2 font-medium">Age (months)</label>
                <input type="number" name="age_in_months" class="w-full border rounded-xl p-3" placeholder="Example: 6"
                    required>
            </div>

            <div>
                <label>Gender</label>
                <select name="gender" class="w-full border rounded-xl p-3">
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                </select>
            </div>

            <div>
                <label>Description</label>
                <textarea name="description" class="w-full border rounded-xl p-3"></textarea>
            </div>

            <div>
                <label>Images</label>
                <input type="file" name="images[]" multiple>
            </div>

            <button class="bg-indigo-600 text-white px-6 py-3 rounded-xl">
                Post Animal
            </button>

        </form>

    </section>
@endsection
