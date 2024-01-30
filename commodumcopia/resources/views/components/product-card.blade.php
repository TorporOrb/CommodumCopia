
{{--
titel: Product Card Blade
beschrijving: Het herbruikbare producten component.
auteur: Pascal Thomasse Mol
versie: 2
aanmaakdatum: 20 jun 2023
laatste wijzigingsdatum: 06 jul 2023
--}}

@props(['product'])

<div class="card m-2">
    {{-- Afbeelding --}}
    <div class="imagebox my-3 text-center">
        <div class="mt-2 mx-auto" style="height: 10rem; width: 10rem; position: relative;">
            {{-- De link naar de show pagina van het product--}}
            <a href="{{ route('products.show', ['product' => $product->id]) }}">
                <img src="{{ asset(str_replace('uploads/', 'uploads/image/', $product->image)) }}"
                    class="card-img-top mx-auto rounded" alt="Product Image"
                    style="height: 10rem; width: 10rem; object-fit: cover;">
                <!-- De discount box wordt alleen getoond als er een discount is.  -->
                @if ($product->discount)
                    <div class="discountbox">
                        <p>{{ $product->discount->name }}</p>
                    </div>
                @endif
            </a>
        </div>

    </div>
    {{-- tekst --}}
    <div class="card-body d-flex justify-content-between">
        <div>
            {{-- De link naar de show pagina van het product--}}
            <a href="{{ route('products.show', ['product' => $product->id]) }}">
                <h5 class="lead">{{ $product->name }}</h5>
            </a>
            <p class="lead">Prijs: {{ $product->price }}</p>
        </div>
        <div>
            {{-- Artikel toevoegen aan de winkelmand --}}
            <form action="{{ route('cart.add') }}" method="POST" style="display: inline;">
                @csrf
                <input type="hidden" name="product_id" value="{{ $product->id }}">
                <input type="hidden" name="quantity" value="1">
                {{-- De bestel knop --}}
                <button type="submit" class="button_1">Bestel</button>
            </form>
        </div>
    </div>
</div>
