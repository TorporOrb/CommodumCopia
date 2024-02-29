{{--
titel: Promotions Show Blade
beschrijving: Pagina waar een promotie getoond wordt.
auteur: Pascal Thomasse Mol
versie: 2
aanmaakdatum: 27 jun 2023
laatste wijzigingsdatum: 29 jun 2023
--}}

<x-layout>
    <div class="container text-center">
        {{-- De header --}}
        <h1 class="display-4">{{ $promotion->header }}</h1>
        {{-- De afbeelding --}}
        <img class="rounded mt-4" src="{{ asset(str_replace('uploads/', 'uploads/image/', $promotion->image)) }}"
            style="width: 100%;" alt="Promotion Image" />
    </div>
    {{-- De tekst --}}
    <div class="container mt-5">
        <div class="text-center">
            <h2 class="h4">{{ $promotion->sub_header }}</h2>
            <br>
            <p class="lead">{{ $promotion->text }}</p>
        </div>
    </div>
    {{-- Het terug knopje --}}
    <x-return-button/>
</x-layout>
