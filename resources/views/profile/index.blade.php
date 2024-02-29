{{--
titel: Profile Index Blade
beschrijving: De profielpagina.
auteur: Pascal Thomasse Mol
versie: 2
aanmaakdatum: 12 jul 2023
laatste wijzigingsdatum: 18 jul 2023
--}}


<x-layout>
    <div class="container">
        {{-- Titel --}}
        <p class="display-6">Profiel pagina</p>

        {{-- Blok voor het bekijken van orders --}}
        <div class="center">
            <div class="card">
                <div class="p-5">
                    {{-- Titel voor orders bekijken --}}
                    <p class="display-6">Orders bekijken</p>
                    {{-- Link naar de orders index pagina --}}
                    <a href="{{ route('orders.index') }}">
                        <div class="button_1">Orders bekijken</div>
                    </a>
                </div>
            </div>
        </div>

        {{-- Kaart voor adresgegevens --}}
        <div class="card mt-5" style="height:20rem;">
            <div class="row p-5" style="height:12rem;">
                {{-- Adresinformatie --}}
                <div class="col-sm-6">
                    <div class="card p-3">
                        <div class="card-body d-block">
                            <p>Uw adresgegevens:</p>
                            <p>{{ $address->address }}</p>
                            <p>{{ $address->postal_code }}</p>
                            <p>{{ $address->city }}</p>
                        </div>
                    </div>
                </div>
                {{-- Link voor het aanpassen van het adres --}}
                <div class="col-sm-6 row align-items-center">
                    <div class="d-flex justify-content-center">
                        <a href="{{ route('address.edit', ['id' => $address->id]) }}" class="button_1">
                            Adres aanpassen</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layout>

