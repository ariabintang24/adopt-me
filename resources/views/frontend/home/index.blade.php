@extends('frontend.layouts.app')

@section('content')
    @php use Illuminate\Support\Facades\Storage; @endphp

    {{-- ================= HERO ================= --}}
    @include('frontend.home.sections.hero')

    {{-- ================= CATEGORIES ================= --}}
    @include('frontend.home.sections.categories', [
        'categories' => $categories,
    ])

    {{-- ================= LATEST ANIMALS ================= --}}
    @include('frontend.home.sections.latest-animals', [
        'latestAnimals' => $latestAnimals,
    ])

    {{-- ================= HOW IT WORKS ================= --}}
    @include('frontend.home.sections.how-it-works')

    {{-- ================= FAQ ACCORDION ================= --}}
    @include('frontend.home.sections.faq')

    {{-- ================= CONTACT ================= --}}
    @include('frontend.home.sections.contact')

    @include('frontend.components.footer')


    <script>
        document.querySelectorAll(".faq-question").forEach(button => {
            button.addEventListener("click", () => {
                const item = button.parentElement;
                const answer = item.querySelector(".faq-answer");
                const icon = item.querySelector(".faq-icon");

                const isOpen = answer.style.maxHeight;

                document.querySelectorAll(".faq-answer").forEach(a => {
                    a.style.maxHeight = null;
                });

                document.querySelectorAll(".faq-icon").forEach(i => {
                    i.classList.remove("rotate-180");
                });

                if (!isOpen) {
                    answer.style.maxHeight = answer.scrollHeight + "px";
                    icon.classList.add("rotate-180");
                }
            });
        });
    </script>
@endsection
