{{--
titel: Fail Banner Blade
beschrijving: De banner om een error boodschap te tonen. Zoals bij het inlogggen.
auteur: Pascal Thomasse Mol
versie: 1
aanmaakdatum: 20 jul 2023
laatste wijzigingsdatum: 20 jul 2023
--}}

{{-- De banner om een error boodschap te tonen. Zoals bij het inlogggen --}}
@if (session()->has('failure'))
    <div class="container container--narrow my-3">
        <div class="alert alert-warning text-center">
            {{-- De foutmelding --}}
            {{ session('failure') }}
        </div>
    </div>
@else 
    <br>
@endif