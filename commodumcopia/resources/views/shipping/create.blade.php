{{--
titel: Shipping Edit Blade
beschrijving: Het formulier om de verzendgegevens aan te passen .
auteur: Pascal Thomasse Mol
versie: 3
aanmaakdatum: 21 jul 2023
laatste wijzigingsdatum: 14 aug 2023
--}}

<x-layout>
    <div class="center">
        <form action="{{ route('shipping.store') }}" method="POST">
            @csrf
             {{-- Verborgen velden voor leveringsdatum en -tijd --}}
            <input type="hidden" name="delivery_date" value="{{ session('delivery_date') }}">
            <input type="hidden" name="delivery_time" value="{{ session('delivery_time') }}">
            <div class="form-group mx-auto mt-5">
                <label for="order_date">Leveringsdatum:</label>
                {{-- Datumblokken --}}
                <div class="date-boxes mt-3">
                    <div class="row row-cols-3">
                        @php
                            // Bereken de komende 6 werkdagen
                            $startDate = \Carbon\Carbon::tomorrow();
                            $endDate = \Carbon\Carbon::tomorrow()->addDays(6);
                            $defaultDate = null;
                        @endphp
                        {{-- Loop voor het genereren van datumblokken --}}
                        @while ($startDate <= $endDate)
                            {{-- Zorg ervoor dat zondag wordt overgeslagen --}}
                            @if ($startDate->dayOfWeek !== \Carbon\Carbon::SUNDAY)
                                {{-- Stel de eerste beschikbare datum in als standaard --}}
                                @if ($defaultDate === null)
                                    @php
                                        $defaultDate = $startDate->toDateString(); // Stel de eerste beschikbare datum in als standaard
                                    @endphp
                                @endif
                                {{-- Aangepaste checkbox-stijl --}}
                                <label class="custom-checkbox p-1">
                                    <input type="radio" id="date_{{ $startDate->toDateString() }}"
                                        name="delivery_date" value="{{ $startDate->toDateString() }}"
                                        {{ $startDate->toDateString() === $defaultDate ? 'checked' : '' }}>
                                    <span class="checkmark">
                                        {{-- Datumblok met label --}}
                                        <label style="border:none; margin:1rem;"
                                            for="date_{{ $startDate->toDateString() }}" class="date-box">
                                            {{ $startDate->format('D, j M') }}
                                        </label>
                                    </span>
                                </label>
                            @endif
                            {{-- Verhoog de datum met 1 dag --}}
                            @php
                                $startDate->addDay();
                            @endphp
                        @endwhile
                    </div>
                </div>
            </div>

            <div style="margin-top: 5rem;">
                <div class="form-group center card p-5">
                    <label for="delivery_time">Leveringstijd:</label>
                    <!-- Toon leveringstijdopties met verzendknoppen -->
                    <div class="delivery-time-options">
                        <div class="delivery-time-option my-5">
                            <span class="delivery-time-label">08:00-22:00 €4.95</span>
                            <button type="submit" name="delivery_time" value="08:00-22:00"
                                class="button_1 mx-5">Kies</button>
                        </div>
                        <div class="delivery-time-option my-5">
                            <span class="delivery-time-label">16:00-22:00 €6.95</span>
                            <button type="submit" name="delivery_time" value="16:00-22:00"
                                class="button_1 mx-5">Kies</button>
                        </div>
                        <div class="delivery-time-option my-5">
                            <span class="delivery-time-label">19:00-21:00 €7.50</span>
                            <button type="submit" name="delivery_time" value="19:00-21:00"
                                class="button_1 mx-5">Kies</button>
                        </div>
                        <div class="delivery-time-option my-5">
                            <span class="delivery-time-label">20:00-22:00 €7.50</span>
                            <button type="submit" name="delivery_time" value="20:00-22:00"
                                class="button_1 mx-5">Kies</button>
                        </div>
                    </div>
                </div>
            </div>

    </div>
    <div class="card " style="height:20rem; margin-top:5rem;">
        <div class="row p-5" style="height:12rem;">
            <div class="col-sm-6">
                <div class="card p-3">
                    <div class="card-body d-block">
                        {{-- Adresgegevens --}}
                        <p>Uw boodschappen worden bezorgd op dit adres:</p>
                        <p>{{ $address->address }}</p>
                        <p>{{ $address->postal_code }}</p>
                        <p>{{ $address->city }}</p>
                    </div>
                </div>
            </div>

            <div class="col-sm-6 row align-items-center">
                <div class="d-flex justify-content-center ">
                    {{-- Aanpassen van de adresgegevens --}}
                    <a href="{{ route('address.edit', ['id' => $address->id]) }}" class="button_1">
                        Adres aanpassen</a>
                </div>
            </div>
        </div>
    </div>

</x-layout>
