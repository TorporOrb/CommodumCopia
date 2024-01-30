{{--
titel: Admin Orders Show Blade
beschrijving: Het formulier om de klantorder van een gebruiker te tonen aan de beheerders.
auteur: Pascal Thomasse Mol
versie: 3
aanmaakdatum: 26 aug 2023
laatste wijzigingsdatum: 28 aug 2023
--}}

<x-layout>
    <div class="container">
        <p class="display-6">Bestellingen van Gebruiker</p>

        <ul>
            {{-- Toon de orders van de geselecteerde gebruiker --}}
            @foreach ($user->orders as $order)
            <a href="{{ route('admin.orders.show', ['user' => $user->id, 'order' => $order->id]) }}">
                <li>Datum levering : {{ \Carbon\Carbon::parse($order->order_date)->format('Y-m-d') }}</li>
            </a>
            @endforeach
        </ul>
    </div>
</x-layout>