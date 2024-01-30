{{--
titel: Page Header Blade
beschrijving: De header met het logo.
auteur: Pascal Thomasse Mol
versie: 2
aanmaakdatum: 19 jun 2023
laatste wijzigingsdatum: 29 jun 2023
--}}

<div class="header">
    {{-- Logo --}}
    <div class="logo">
        {{-- Link naar de homepage --}}
        <a href="{{ route('home') }}">
            <img src="{{ asset('images/logo3.png') }}" alt="logo" class="logo-image">
        </a>
    </div>
    <div class="company-name">
        Commodum Copia
    </div>
    {{-- flavor text --}}
    <div class="header-text">
        <div class="header-text-line">Duurzaam</div>
        <div class="header-text-line">Voordelig</div>
        <div class="header-text-line">Transparant</div>
    </div>
</div>
