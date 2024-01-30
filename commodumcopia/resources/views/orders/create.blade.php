{{--
titel: Orders Create Blade
beschrijving: De pagina waar een order ingezet kan worden.
auteur: Pascal Thomasse Mol
versie: 2
aanmaakdatum: 06 jul 2023
laatste wijzigingsdatum: 20 jul 2023
--}}
<x-layout>
    {{-- Titel van de pagina --}}
    <div class="container center">
        <h1 class="text-center">Controleer uw order</h1>
        {{-- Te bestellen producten --}}
        <table class="table mt-5">
            <thead>
                <tr>
                    {{-- De header van de tabel --}}
                    <th>Product naam</th>
                    <th>Aantal</th>
                    <th>Prijs</th>
                    <th>Korting</th>
                    <th>Totaal</th>
                </tr>
            </thead>
            <tbody>
                {{-- Loop door de producten --}}
                @foreach ($cartItems as $item)
                    <tr>
                        {{-- Toon de data van het product in de tabel --}}
                        <td>{{ $item['product']->name }}</td>
                        <td>{{ $item['quantity'] }}</td>
                        <td>{{ $item['product']->price }}</td>
                        <td>
                            {{-- Korting indien aanwezig --}}
                            @if ($item['product']->discount)
                                {{ $item['product']->discount->name }}
                            @else
                                Geen korting
                            @endif
                        </td>
                        <td>€{{ $item['total'] }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        
    
        <h3 class="center mt-5">Kosten boodschappen: €{{ $productTotal }}</h3>
        <div class="my-5" style="border-bottom: 1px solid silver;"></div>
        {{-- Bestelgegevens --}}
        <div class="mt-5 text-center">
            <p>Datum levering : {{ $deliveryDate }}</p>
            <p>Levertijd : {{ $deliveryTime }}</p>
            <p>Kosten boodschappen : {{ $productTotal }}</p>
            <P>Verzendkosten : {{ $shippingCost }}</P>
            <h3 style="margin-top: 2rem;">Totaalbedrag inclusief verzendkosten : €{{ number_format($productTotal + $shippingCost, 2) }}</h3>
            <div class="my-5" style="border-bottom: 1px solid silver;"></div>
        </div>  


        {{-- Other form fields --}}
        {{-- ... --}}
        <form action="{{ route('orders.store') }}" method="POST">
            @csrf
            {{-- Verborgen velden om de benodigde gegevens door te geven  --}}
            <input type="hidden" name="deliveryDate" value="{{ $deliveryDate }}">
            <input type="hidden" name="deliveryTime" value="{{ $deliveryTime }}">
            <input type="hidden" name="productTotal" value="{{ $productTotal }}">
            <input type="hidden" name="shippingCost" value="{{ $shippingCost }}"> 
            <div class="center">
                {{-- Submit knop --}}
                <button type="submit" class="button_1 mt-3">Order plaatsen</button>
            </div>
        </form>
        
    </div>
</div>

</x-layout>
