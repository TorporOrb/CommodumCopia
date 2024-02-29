{{--
titel: Success Banner Blade
beschrijving: De banner om een succes boodschap te tonen. Zoals bij het inlogggen.
auteur: Pascal Thomasse Mol
versie: 2
aanmaakdatum: 27 jun 2023
laatste wijzigingsdatum: 29 jun 2023
--}}

{{-- De succesboodschap wordt alleen getoond als er een succes is --}}
@if (session()->has('success'))
    <div class="container container--narrow my-3">
        <div class="alert alert-success text-center">
            {{-- De boodschap --}}
            {{ session('success') }}
        </div>
    </div>
@else 
    <br>
@endif