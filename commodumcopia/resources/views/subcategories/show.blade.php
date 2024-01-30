{{--
titel: SubCategories Show Blade
beschrijving: Op deze pagina wordt een subcategorie en de bijhorende producten getoond.
auteur: Pascal Thomasse Mol
versie: 2
aanmaakdatum: 27 jun 2023
laatste wijzigingsdatum: 01 jul 2023
--}}

<x-layout>
    {{-- De afbeelding en naam --}}
    <div class="mx-auto" style="width: 80%; position: relative;">
        <img src="{{ asset($subcategory->image) }}" class="card-img-top mx-auto rounded mt-2" alt="Category Image"
            style="height: 12rem; object-fit: cover;">
        <h1 class="banner_text">{{ $subcategory->name }}</h1>
    </div>
    <div style="padding-bottom: 4rem; border-bottom: 1px solid #2691d9;"></div>
    <div style="padding-bottom: 4rem;"></div>

    <div class="row w-75 mx-auto">
        {{-- Loop door de bijbehorende producten --}}
        @foreach ($products as $product)
            <div class="col-md-4">
                {{-- Link naar het product --}}
                <a href="{{ route('products.show', ['product' => $product->id]) }}">
                    {{-- Gebruik het product component om het product te tonen  --}}
                    <x-product-card :product="$product" />
                </a>
            </div>
        @endforeach
    </div>
    {{-- Knop naar de bijbehorende subcategorie --}}
    <div class="container container--narrow my-3">
        <div class="text-center">
            <a href="{{ route('categories.show', ['id' => $subcategory->category_id]) }}" class="button_1">Terug</a>
        </div>
        <br>
    </div>
</x-layout>
