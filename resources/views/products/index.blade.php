{{--
titel: Address index Blade
beschrijving: De pagina waar de admin de bestaande producten kan zien.
auteur: Pascal Thomasse Mol
versie: 2
aanmaakdatum: 20 jun 2023
laatste wijzigingsdatum: 6 jul 2023
--}}

<x-layout>
    <div class="mt-5">
        <div class="container">
            <div class="row">
                {{-- Loop door de producten --}}
                @foreach ($products as $product)
                    <div class="col-md-4 product-card">
                        {{-- Gerbuik het component om het product te tonen--}}
                        <x-admin-product-card :product="$product" />                   
                    </div>
                @endforeach
            </div>
            <nav class="mt-6 p-4">
                <!-- De paginatie -->
                {{ $products->links() }}
            </nav>
        </div>
    </div>
    {{-- Het terug knopje --}}
    <x-return-button/>
</x-layout>
