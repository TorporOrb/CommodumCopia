{{--
titel: Cart Show Blade
beschrijving: De pagina die de producten in het winkelmandje toont.
auteur: Pascal Thomasse Mol
versie: 3
aanmaakdatum: 06 jul 2023
laatste wijzigingsdatum: 14 aug 2023
--}}

<x-layout>
    <div class="container center">
        @if ($cartItems->count() > 0)
            {{-- Winkelmandje bevat items --}}
            <h1>Uw winkelmandje:</h1>
            <ul>
                {{-- Lus door elk item in het winkelmandje --}}
                @foreach ($cartItems as $item)
                    <li class="cart-list rounded p-4 mb-3">
                        <div class="cart-item p-4 d-flex justify-content-start align-items-center">
                            <div class="item-image">
                                {{-- Afbeelding van het product --}}
                                <img src="{{ asset(str_replace('uploads/', 'uploads/image/', $item['product']->image)) }}"
                                    style="width: 5rem;" class="rounded">
                            </div>
                            <div class="item-details ml-3">
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <div class="item-name">
                                        {{-- Naam van het product met link naar de productpagina --}}
                                        <a href="{{ route('products.show', ['product' => $item['product']->id]) }}">
                                            <span class="lead" style="font-size: 1.5rem;">{{ $item['product']->name }}</span>
                                        </a>
                                    </div>
                                    <div class="quantity-controls">
                                        {{-- Formulier voor het verminderen van de hoeveelheid --}}
                                        <form action="{{ route('decreaseQuantity', ['cartItemId' => $item['id']]) }}" method="POST"
                                            style="display: inline;">
                                            @csrf
                                            <button type="submit" name="action" value="decrease" class="btn btn-link p-0">
                                                <ion-icon name="remove-circle"></ion-icon>
                                            </button>
                                        </form>

                                        {{-- Weergave van de huidige hoeveelheid --}}
                                        <span class="item-quantity">{{ $item['quantity'] }}</span>

                                        {{-- Formulier voor het verhogen van de hoeveelheid --}}
                                        <form action="{{ route('increaseQuantity', ['cartItemId' => $item['id']]) }}" method="POST"
                                            style="display: inline;">
                                            @csrf
                                            <button type="submit" name="action" value="increase" class="btn btn-link p-0">
                                                <ion-icon name="add-circle"></ion-icon>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-between align-items-center">
                                    {{-- Prijs van het product --}}
                                    <span>Prijs: {{ $item['product']->price }}</span>
                                    @if ($item['product']->discount->name != null)
                                        {{-- Weergave van de korting, indien van toepassing --}}
                                        <span>Korting: {{ $item['product']->discount->name }}</span>
                                    @endif
                                    <div>
                                        {{-- Totaalprijs van het item --}}
                                        <span>Totaal: € {{ number_format($item['total'], 2) }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="my-4" style="border-bottom: 1px solid silver;"></div>
                    </li>

                     
                @endforeach
            </ul>
            {{-- Bevestigingsknop voor het afrekenen --}}
            <div class="d-flex justify-content-center ">
                <a href="{{ route('shipping.create') }}" class="button_1">Bevestigen</a>
            </div>
        @else
            {{-- Geen items in het winkelmandje --}}
            <p>U heeft nog geen artikelen in uw winkelmandje.</p>
        @endif
    </div>
</x-layout>