{{--
titel: Post Index Blade
beschrijving: Pagina waarop één post getoond wordt.
auteur: Pascal Thomasse Mol
versie: 2
aanmaakdatum: 27 jun 2023
laatste wijzigingsdatum: 30 jun 2023
--}}

<x-layout>
    {{-- De afbeelding en maan --}}
    <div class="container text-center">
        <h1 class="display-4">{{ $post->header }}</h1>
        <img class="rounded mt-4" src="{{ asset(str_replace('uploads/', 'uploads/image/', $post->image)) }}"
            style="width: 100%;" alt="Post Image" />
    </div>
    {{-- De tekst --}}
    <div class="container mt-5">
        <div class="text-center">
            <h2 class="h4">{{ $post->sub_header }}</h2>
            <br>
            <p class="lead">{{ $post->text }}</p>
        </div>
    </div>
    {{-- Het terug knopje --}}
    <x-return-button/>
</x-layout>

