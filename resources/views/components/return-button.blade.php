{{--
titel: Return Button Blade
beschrijving: Herbruikbare knop om naar de vorige pagina te gaan.
auteur: Pascal Thomasse Mol
versie: 2
aanmaakdatum: 28 jun 2023
laatste wijzigingsdatum: 29 jun 2023
--}}

@php
    use Illuminate\Support\Facades\URL;
@endphp

<div class="container container--narrow my-3">
    <div class="text-center">
        {{-- De link --}}
        <a href="{{ URL::previous() }}" class="button_1">Terug</a>
    </div>
    <br>
</div>