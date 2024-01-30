{{--
titel: Welcome Blade
beschrijving: De homepage.
auteur: Pascal Thomasse Mol
versie: 2
aanmaakdatum: 18 jun 2023
laatste wijzigingsdatum: 6 jul 2023
--}}

<x-layout>
    <div style="overflow-x: hidden;">

        <br>
        {{-- Toon de nieuwste post door middel van het component --}}
        <x-post-card :post="$latestPost" />
        <br>
        <h2 class="text-center">Nu in de aanbieding:</h2>
        <div class="row w-75 p-3 mx-auto">
            {{-- Toon 3 willekeurige producten met korting door middel van het product component --}}
            @foreach ($discountedProducts as $product)
                <div class="col-md-4 product-card">
                    <x-product-card :product="$product" />
                </div>
            @endforeach
        </div>

        <br>
        {{-- Toon de nieuwste promotie door middel van het component --}}
        <x-promotion-card :promotion="$latestPromotion" />
        <br>

    </div>

</x-layout>
