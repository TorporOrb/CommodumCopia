{{--
titel: Auth Register Blade
beschrijving: Het registratie formulier voor nieuwe gebruikers.
auteur: Pascal Thomasse Mol
versie: 2
aanmaakdatum: 25 jun 2023
laatste wijzigingsdatum: 17 jul 2023
--}}

{{-- Het registratie formulier voor nieuwe gebruikers --}}
<x-layout>
    <div class="container w-50">
        <div class="card m-5 p-5 rounded max-w-lg mx-auto">
            <header class="text-center">
                <h2 class="text-2xl font-bold mb-3">
                    Registreren
                </h2>
            </header>
    
            <form method="POST" action="{{ route('register.submit')}}">
                {{-- cross site request forgery beveiliging --}}
                @csrf
                {{-- De naam --}}
                <div class="mb-3">
                    <label for="name" class="form-label">Naam</label>
                    <input type="text" 
                        class="form-control" 
                        name="name"
                        value="{{ old('name') }}" />
                    @error('name')
                        <p class="text-danger text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                {{-- Het mail adres --}}
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" 
                        class="form-control" 
                        name="email"
                        value="{{ old('email') }}" />
                    @error('email')
                        <p class="text-danger text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                {{-- Het password --}}
                <div class="mb-3">
                    <label for="password" class="form-label">Wachtwoord</label>
                    <input type="password" 
                        class="form-control" 
                        name="password" />
                    @error('password')
                        <p class="text-danger text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                {{-- Password bevestiging --}}
                <div class="mb-3">
                    <label for="password2" class="form-label">Wachtwoord bevestigen</label>
                    <input type="password" 
                        class="form-control" 
                        name="password_confirmation" />
                    @error('password_confirmation')
                        <p class="text-danger text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
    
                {{-- Straat naam --}}
                <div class="mb-3">
                    <label for="street_name" class="form-label">Straatnaam</label>
                    <input type="text" 
                        class="form-control" 
                        name="street_name"
                        value="{{ old('street_name') }}" />
                    @error('street_name')
                        <p class="text-danger text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
    
                {{-- Huis nummer --}}
                <div class="mb-3">
                    <label for="house_number" class="form-label">Huisnummer</label>
                    <input type="text" 
                        class="form-control" 
                        name="house_number"
                        value="{{ old('house_number') }}" />
                    @error('house_number')
                        <p class="text-danger text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                
                {{-- Postcode --}}
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="postal_code" class="form-label">Postcode</label>
                        <input type="text" 
                            class="form-control" 
                            name="postal_code"
                            value="{{ old('postal_code') }}" />
                        @error('postal_code')
                            <p class="text-danger text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
    
                    {{-- Stad --}}
                    <div class="form-group col-md-6">
                        <label for="city" class="form-label">Stad</label>
                        <input type="text" 
                            class="form-control" 
                            name="city"
                            value="{{ old('city') }}" />
                        @error('city')
                            <p class="text-danger text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                {{-- De registratie knop --}}
                <div class="my-3">
                    <button type="submit" class="button_1">
                        Registreren
                    </button>
                </div>
    
            </form>
        </div>
    </div>
</x-layout>