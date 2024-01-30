{{--
titel: Admin Product-Card Blade
beschrijving: Het herbruikbare producten component voor de admin pagina's.
auteur: Pascal Thomasse Mol
versie: 2
aanmaakdatum: 06 jul 2023
laatste wijzigingsdatum: 17 jul 2023
--}}

@props(['product'])

<div class="card m-2">
    {{-- Afbeelding --}}
    <div class="imagebox my-3 text-center">
        <div class="mt-2 mx-auto" style="height: 10rem; width: 10rem; position: relative;" >
            <img src="{{ asset(str_replace('uploads/', 'uploads/image/', $product->image)) }}"
                class="card-img-top mx-auto rounded" alt="Product Image"
                style="height: 10rem; width: 10rem; object-fit: cover;">
            <!-- De discount box wordt alleen getoond als er een discount is.      -->
            @if ($product->discount)
                <div class="discountbox">
                    <p>{{ $product->discount->name }}</p>
                </div>
            @endif
        </div>

    </div>
    {{-- Tekst --}}
    <div class="card-body d-flex justify-content-between">
        <div>
            <h5 class="lead">{{ $product->name }}</h5>
            <p class="lead">Prijs: {{ $product->price }}</p>
        </div>
        <div>
            {{-- De knop voor het aanpassen --}}
            <a href="{{ route('products.edit', ['id' => $product->id]) }}" class="button_1">Aanpassen</a>
        </div>
    </div>
</div>
