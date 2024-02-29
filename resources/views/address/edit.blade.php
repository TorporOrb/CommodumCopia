{{--
titel: Address Edit Blade
beschrijving: Het formulier om de adresgegevens aan te passen.
auteur: Pascal Thomasse Mol
versie: 3
aanmaakdatum: 10 jul 2023
laatste wijzigingsdatum: 14 aug 2023
--}}

<x-layout>
    <div class="container center">
        <div class="card m-5 p-5 rounded max-w-lg">
            <header class="text-center">
                <h2 class="text-2xl font-bold mb-3">
                    Adres Aanpassen
                </h2>
            </header>

            <form method="POST" action="{{ route('address.update' ,['id' => $address->id]) }}">
                {{-- Cross-Site Request Forgery-beveiliging --}}
                @csrf
                @method('PUT')
                {{-- Straatnaam --}}
                <div class="mb-3">
                    <label for="name" class="form-label">Straatnaam</label>
                    <input type="text" 
                    class="form-control" 
                    name="street_name"
                    value="{{ $address->street_name }}" />
                    @error('street_name')
                        <p class="text-danger text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                {{-- Huisnummer --}}
                <div class="mb-3">
                    <label for="email" class="form-label">Huisnummer</label>
                    <input type="text" 
                    class="form-control" 
                    name="house_number"
                    value="{{ $address->house_number }}" />
                    @error('house_number')
                        <p class="text-danger text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                {{-- Postcode --}}
                <div class="mb-3">
                    <label for="email" class="form-label">Postcode</label>
                    <input type="text" 
                    class="form-control" 
                    name="postal_code"
                    value="{{ $address->postal_code }}" />
                    @error('postal_code')
                        <p class="text-danger text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Stad --}}
                <div class="mb-3">
                    <label for="email" class="form-label">Stad</label>
                    <input type="text" 
                    class="form-control" 
                    name="city"
                    value="{{ $address->city }}" />
                    @error('city')
                        <p class="text-danger text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                

                <div class="my-3">
                    <button type="submit" class="button_1">
                        Adres aanpassen
                    </button>
                </div>

            </form>
        </div>
    </div>
</x-layout>