{{--
titel: Products Show Blade
beschrijving: De pagina waar een product getoont wordt.
auteur: Pascal Thomasse Mol
versie: 2
aanmaakdatum: 23 jun 2023
laatste wijzigingsdatum: 6 jul 2023
--}}

<x-layout>
    <div class="container">
        <div class="mt-5">
            <div class="row">
                    <div class="card m-2 p-2">
                        {{-- De afbeelding --}}
                        <div class="imagebox mx-auto my-3">
                            <img src="{{ asset(str_replace('uploads/', 'uploads/image/', $product->image)) }}" class="card-img-top rounded"
                                alt="Product Image" style="height: 20rem; width: 20rem; object-fit: cover;">
                            <!-- The discount is only displayed if there is actually a discount. -->
                            @if ($product->discount)
                                <div class="discountbox">
                                    <p>{{ $product->discount->name }}</p>
                                </div>
                            @endif
                        </div>
                        <br>
                        {{-- De tekst --}}
                        <div class="text-center">
                                    <h2 class="display-6">{{ $product->name }}</h2>
                                </div>
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="m-3">   
                                {{-- Product informatie --}}                             
                                <p class="card-text lead">{{ $product->description }}</p>
                                <p class="card-text lead">Prijs: {{ $product->price }}</p>
                                <p class="card-text lead">{{ $product->body }}</p>
                            </div>
                            <div class="m-3">
                                {{-- Toevoegen aan de winkelmand --}}
                                <form action="{{ route('cart.add') }}" method="POST" style="display: inline;">
                                    @csrf
                                    {{-- Verborgen data die meegegeven wordt --}}
                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                    <input type="hidden" name="quantity" value="1">
                                    {{-- De submit knop --}}
                                    <button type="submit" class="button_1">Bestel</button>
                                </form>
                            </div> 
                                       
                    </div>
            </div>
        </div>
    </div>
    {{-- Het terug knopje --}}
    <x-return-button/>
</x-layout>
