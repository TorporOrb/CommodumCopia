{{--
titel: Register Link Blade
beschrijving: Link naar het registratieformulier voor ingelogde bezoekers.
auteur: Pascal Thomasse Mol
versie: 2
aanmaakdatum: 27 jun 2023
laatste wijzigingsdatum: 30 jun 2023
--}}

{{-- Link naar het registratieformulier voor ingelogde bezoekers --}}
@auth
    {{-- User is authenticated --}}
@else
    <div class="container container--narrow my-3">
        <div class="text-center">
            {{-- De link --}}
            <a href="{{ route('register') }}" class="button_1">Maak een account aan.</a>
        </div>
        <br>
    </div>
@endauth