@extends('frontend.layouts.app')

@section('content')
    <section class="bg-gray-50 py-10">
        <div class="max-w-3xl mx-auto px-6">

            <div class="bg-white rounded-3xl shadow-lg p-8">

                <h1 class="text-2xl font-bold mb-6">
                    Adoption Form - {{ $animal->name }}
                </h1>

                <form action="{{ route('adoption.store', $animal->id) }}" method="POST" class="space-y-6">
                    @csrf

                    {{-- Reason --}}
                    <div>
                        <label class="block mb-2 font-medium">Why do you want to adopt this animal?</label>
                        <textarea name="reason" rows="4" class="w-full border rounded-xl p-3 focus:ring-2 focus:ring-indigo-500" required></textarea>
                    </div>

                    {{-- Has Experience --}}
                    <div>
                        <label class="block mb-2 font-medium">Have you owned pets before?</label>
                        <select name="has_experience" class="w-full border rounded-xl p-3" required>
                            <option value="">Select</option>
                            <option value="1">Yes</option>
                            <option value="0">No</option>
                        </select>
                    </div>

                    {{-- Residence Type --}}
                    <div>
                        <label class="block mb-2 font-medium">Residence Type</label>
                        <input type="text" name="residence_type" class="w-full border rounded-xl p-3"
                            placeholder="House / Apartment / etc" required>
                    </div>

                    {{-- Other Pets --}}
                    <div>
                        <label class="block mb-2 font-medium">Do you have other pets?</label>
                        <select name="other_pets" id="otherPets" class="w-full border rounded-xl p-3" required>
                            <option value="">Select</option>
                            <option value="1">Yes</option>
                            <option value="0">No</option>
                        </select>
                    </div>

                    {{-- Other Pets Detail --}}
                    <div id="otherPetsDetail" class="hidden">
                        <label class="block mb-2 font-medium">Other Pets Detail</label>
                        <input type="text" name="other_pets_detail" class="w-full border rounded-xl p-3"
                            placeholder="Example: 1 cat, 2 rabbits">
                    </div>

                    <button type="submit"
                        class="w-full bg-indigo-600 text-white py-3 rounded-xl hover:bg-indigo-700 transition">
                        Submit Adoption Request
                    </button>

                </form>

            </div>

        </div>
    </section>

    <script>
        document.getElementById('otherPets').addEventListener('change', function() {
            const detail = document.getElementById('otherPetsDetail');
            detail.classList.toggle('hidden', this.value !== '1');
        });
    </script>
@endsection
