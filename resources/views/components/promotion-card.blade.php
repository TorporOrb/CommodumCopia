{{--
titel: Promotion Card Blade
beschrijving: Het herbruikbare promotie component.
auteur: Pascal Thomasse Mol
versie: 2
aanmaakdatum: 22 jun 2023
laatste wijzigingsdatum: 29 jun 2023
--}} 

@props(['promotion'])


<div class="postComponent container">
    {{-- Link naar de betreffende promotie --}}
    <a href="{{ route('promotions.show', ['id' => $promotion->id]) }}">
        {{-- Afbeelding --}}
        <img src="{{ asset(str_replace('uploads/', 'uploads/image/', $promotion->image)) }}" class="rounded"
            style="width: 100%;" alt="Promotion Image">
    </a>
    {{-- Headers --}}
    <div class="headerTL">
        <h1>{{ $promotion->header }}</h1>
        <h2>{{ $promotion->sub_header }}</h2>
    </div>
    {{-- Text --}}
    <div class="textBL">
        <h4>{{ $promotion->text }}</h4>
    </div>
</div>
