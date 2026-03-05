@extends('frontend.layouts.app')

@section('content')
    <section class="bg-gray-50 py-12">
        <div class="max-w-6xl mx-auto px-6">

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-start">

                {{-- LEFT PREVIEW --}}
                @include('frontend.components.animal-preview', ['animal' => $animal])

                {{-- RIGHT FORM --}}
                <div x-data="{ openConfirm: false }" class="bg-white rounded-3xl shadow-md p-8">

                    <h1 class="text-2xl font-bold mb-6">
                        Adoption Form
                    </h1>

                    {{-- FORM --}}
                    <form x-ref="adoptionForm" @submit.prevent="openConfirm = true"
                        action="{{ route('adoption.store', $animal->id) }}" method="POST" class="space-y-6">
                        @csrf

                        <div>
                            <label class="block mb-2 font-medium">
                                Why do you want to adopt this animal?
                            </label>
                            <textarea name="reason" rows="4" class="w-full border rounded-xl p-3 focus:ring-2 focus:ring-indigo-500"
                                required></textarea>
                        </div>

                        <div>
                            <label class="block mb-2 font-medium">
                                Have you owned pets before?
                            </label>
                            <select name="has_experience" class="w-full border rounded-xl p-3" required>
                                <option value="">Select</option>
                                <option value="1">Yes</option>
                                <option value="0">No</option>
                            </select>
                        </div>

                        <div>
                            <label class="block mb-2 font-medium">
                                Residence Type
                            </label>
                            <input type="text" name="residence_type" class="w-full border rounded-xl p-3"
                                placeholder="House / Apartment / Etc" required>
                        </div>

                        <div>
                            <label class="block mb-2 font-medium">
                                Do you have other pets?
                            </label>
                            <select name="other_pets" id="otherPets" class="w-full border rounded-xl p-3" required>
                                <option value="">Select</option>
                                <option value="1">Yes</option>
                                <option value="0">No</option>
                            </select>
                        </div>

                        <div id="otherPetsDetail" class="hidden">
                            <label class="block mb-2 font-medium">
                                Other Pets Detail
                            </label>
                            <input type="text" name="other_pets_detail" class="w-full border rounded-xl p-3"
                                placeholder="Ex: 3 dogs, 1 cat">
                        </div>

                        <button type="submit"
                            class="w-full bg-indigo-600 text-white py-3 rounded-xl hover:bg-indigo-700 transition font-medium">
                            Submit
                        </button>
                    </form>


                    {{-- CONFIRM MODAL --}}
                    <div x-show="openConfirm" x-transition
                        class="fixed inset-0 z-50 flex items-center justify-center bg-black/40 px-4">

                        <div @click.away="openConfirm = false"
                            class="bg-white rounded-2xl shadow-md w-full max-w-md p-6 sm:p-8">

                            <h2 class="text-lg font-semibold mb-3">
                                Confirm Adoption Request
                            </h2>

                            <p class="text-sm text-gray-600 mb-6 leading-relaxed">
                                Are you sure you want to submit this adoption request?
                                Please make sure all information is correct.
                            </p>

                            {{-- BUTTONS --}}
                            <div class="flex flex-col sm:flex-row gap-3 sm:justify-end">

                                <button type="button" @click="openConfirm = false"
                                    class="w-full sm:w-auto px-4 py-2 rounded-lg bg-gray-100 hover:bg-gray-200 text-sm">
                                    Cancel
                                </button>

                                <button type="button" @click="$refs.adoptionForm.submit()"
                                    class="w-full sm:w-auto px-4 py-2 rounded-lg bg-indigo-600 text-white hover:bg-indigo-700 text-sm">
                                    Yes, Submit
                                </button>

                            </div>

                        </div>
                    </div>

                </div>
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
