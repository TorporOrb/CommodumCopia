{{--
titel: Orders Index Blade
beschrijving: De pagina die de orders van een gebruiker toont.
auteur: Pascal Thomasse Mol
versie: 2
aanmaakdatum: 17 jul 2023
laatste wijzigingsdatum: 18 jul 2023
--}}
<x-layout>
    <div class="container">
        <p class="display-6">Mijn Bestellingen</p>

        <ul>
            {{-- Toon de orders van de ingelogde gebruiker --}}
            @foreach ($orders as $order)
            <a href="{{ route('orders.show', ['id' => $order->id]) }}">
                <li>Datum levering : {{ \Carbon\Carbon::parse($order->order_date)->format('Y-m-d') }}</li>
            </a>
            @endforeach
        </ul>
    </div>
</x-layout>
