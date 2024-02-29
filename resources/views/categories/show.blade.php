{{--
titel: Categories Show Blade
beschrijving: Weergave van een categorie met de bijhorende subcategerieën en producten.
auteur: Pascal Thomasse Mol
versie: 2
aanmaakdatum: 23 jun 2023
laatste wijzigingsdatum: 29 jun 2023
--}}

<x-layout>
    <div class="mx-auto" style="width: 80%; position: relative;">
        {{-- De afbeelding en naam van de categorie --}}
        <img src="{{ asset($category->image) }}" class="card-img-top mx-auto rounded mt-2" alt="Category Image"
            style="height: 12rem; object-fit: cover;">
        <h1 class="banner_text">{{ $category->name }}</h1>
    </div>
    <div class="my-5 d-flex justify-content-center">
        <div class="w-75" style="border-bottom: 1px solid #2691d9;"></div>
    </div>
    {{-- Loop door de subcategorieën --}}
    @foreach ($subcategories as $subcategory)
        <div class="row w-75 mx-auto">
            <div class="col-12 col-md-4">
                <div class="card m-2">
                    {{-- Link naar de sub-category --}}
                    <a href="{{ route('subcategories.show', ['id' => $subcategory->id]) }}">
                        {{-- Afbeelding en naam van de subcategorie --}}
                        <div class="imagebox mx-auto my-3 text-center py-4" style="position: relative;">
                            <img src="{{ asset($subcategory->image) }}" class="card-img-top mx-auto rounded my-3" 
                                alt="SubCategory Image" style="height: 13rem; width: 13rem; object-fit: cover;">
                            <h2 class="card-title text-white" style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); text-shadow: 2px 2px 4px #888888;">
                                {{ $subcategory->name }}
                            </h2>
                        </div>
                    </a>
                </div>
            </div> 
            {{-- Loop door de producten per subcategorie --}}           
            @foreach ($productsBySubcategory[$subcategory->id] as $product)
                <div class="col-md-4">
                    {{-- Link naar het product --}}
                    <a href="{{ route('products.show', ['product' => $product->id]) }}">
                        {{-- Gebruik het product component om het product te toenen --}}
                        <x-product-card :product="$product" />
                    </a>
                </div>
            @endforeach
        </div>
        <div class="my-5 d-flex justify-content-center">
            <div class="w-75" style="border-bottom: 1px solid #2691d9;"></div>
        </div>
    @endforeach
    {{-- Knopje naar de categieën pagina --}}
    <div class="container container--narrow my-3">
        <div class="text-center">
            <a href="{{ route('categories.index') }}" class="button_1">Terug</a>
        </div>
        <br>
    </div>

</x-layout>