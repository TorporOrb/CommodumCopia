{{--
titel: Admin Orders Show Blade
beschrijving: Het formulier om een klantorder te tonen aan de beheerders.
auteur: Pascal Thomasse Mol
versie: 3
aanmaakdatum: 26 aug 2023
laatste wijzigingsdatum: 28 aug 2023
--}}

<x-layout>
    <div class="container mt-5">
        {{-- Order details --}}
        <p class="display-6">Order details</h1>
        <p>Order ID: {{ $order->id }}</p>
        <p>Order Datum: {{ $order->order_date }}</p>
        <p>Wordt geleverd tussen {{ $order->delivery_start_time }} en {{ $order->delivery_end_time }} </p>
        <div class="my-5" style="border-bottom: 1px solid silver;"></div>
        {{-- Verzend gegevens --}}
        <p class="display-6">Verzonden naar:</p>
        <p>Adres: {{ $order->delivery_address }}</p>
        <p>Postcode: {{ $order->postal_code }}</p>
        <p>Stad: {{ $order->delivery_city }}</p>
        <!-- Add more order details as needed -->

        <div class="my-5" style="border-bottom: 1px solid silver;"></div>

        <p class="display-6">Producten</p>
        <table class="table">
            <thead>
                <tr>
                    {{-- Tabel header --}}
                    <th>Product naam</th>
                    <th>Aantal</th>
                    <th>Prijs</th>
                    <th>Korting</th>
                    <th>Totaal</th> 
                </tr>
            </thead>
            <tbody>
                {{-- Loop door de tabellen --}}
                @foreach ($orderProducts as $orderProduct)
                    <tr>
                        {{-- Toon de product data --}}
                        <td>{{ $orderProduct->product->name }}</td>
                        <td>{{ $orderProduct->quantity }}</td>
                        <td>€ {{ $orderProduct->set_price }}</td>
                        <td>
                            {{-- Toon de eventuele korting --}}
                            @if ($orderProduct->product->discount)
                                {{ $orderProduct->product->discount->name }}
                            @else
                                Geen korting
                            @endif
                        </td>
                        {{-- Het totaal per product --}}
                        <td>€ {{ $orderProduct->total }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="my-5" style="border-bottom: 1px solid silver;"></div>
        {{-- Kosten --}}
        <div class="">
            <p class="display-6">Kosten:</p>
            <p>Producten: € {{ $productTotal }}</p>
            <p>Verzendkosten: € {{ $order->delivery_price }}</p>
            <p>Totaalbedrag: €{{ number_format($productTotal + $order->delivery_price, 2) }} </p>
        </div>
    </div>

</x-layout>
