{{--
titel: Search Index Blade
beschrijving: De pagina waar de zoekopdracht getoond wordt.
auteur: Pascal Thomasse Mol
versie: 2
aanmaakdatum: 26 jun 2023
laatste wijzigingsdatum: 17 jul 2023
--}}

{{-- De pagina waar de zoekopdracht getoond wordt --}}
<x-layout>
    {{-- Waar naar gezocht werd --}}
    <h2 class="text-center">U zocht naar {{ $keyword }}:</h2>
    {{-- Als niets gevonden is: --}}
    @if ($products->isEmpty())
    <p>Niets gevonden</p>
@else
{{-- Als er wel iets gevonden is --}}
<div class="mt-5">
    <div class="container">
        <div class="row">
            {{-- Loop door de producten--}}
            @foreach ($products as $product)
                <div class="col-md-4">
                    <!-- Link naar de edit product pagina.  -->
                    <a href="{{ route('products.show', ['product' => $product]) }}">
                        {{-- Toon het product door middel van het component --}}
                        <x-product-card :product="$product" />
                    </a>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endif
{{-- Het terug knopje --}}
<x-return-button/>

</x-layout>