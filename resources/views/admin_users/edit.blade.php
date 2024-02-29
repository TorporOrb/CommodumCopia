{{--
titel: Admin Edit Blade
beschrijving: Het formulier om een gebruiker aan te passen.
auteur: Pascal Thomasse Mol
versie: 2
aanmaakdatum: 22 jun 2023
laatste wijzigingsdatum: 20 jul 2023
--}}

<x-layout>
    <div class="container w-50">
        <div class="card m-5 p-5 rounded max-w-lg mx-auto">
            <header class="text-center">
                <h2 class="text-2xl font-bold mb-3">
                    Gebruiker aanpassen
                </h2>
            </header>

            <form method="POST" action="{{ route('admin.users.update', $user->id) }}">
                {{-- cross site request forgery beveiliging --}}
                @csrf
                @method('PUT')
                {{-- De naam --}}
                <div class="mb-3">
                    <label for="name" class="form-label">Naam</label>
                    <input type="text" class="form-control" name="name" value="{{ $user->name }}" />
                    @error('name')
                        <p class="text-danger text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                {{-- Het mail adres --}}
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" name="email" value="{{ $user->email }}" />
                    @error('email')
                        <p class="text-danger text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                {{-- De rechten --}}
                <div class="mb-3">
                    <label for="role" class="form-label">Taken</label>
                    <select class="form-select" id="role" name="role">
                        <option value="user" {{ $user->role === 'user' ? 'selected' : '' }}>User</option>
                        <option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }}>Admin</option>
                    </select>
                </div>
                {{-- Het password --}}
                <div class="mb-3">
                    <label for="password" class="form-label">Nieuw wachtwoord</label>
                    <input type="password" class="form-control" name="password" />
                    @error('password')
                        <p class="text-danger text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                {{-- Password bevestiging --}}
                <div class="mb-3">
                    <label for="password_confirmation" class="form-label">Bevestig nieuw wachtwoord</label>
                    <input type="password" class="form-control" name="password_confirmation" />
                    @error('password_confirmation')
                        <p class="text-danger text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                {{-- Street name --}}
            <div class="mb-3">
                <label for="street_name" class="form-label">Straatnaam</label>
                <input type="text" 
                    class="form-control" 
                    name="street_name"
                    value="{{ $address->street_name }}" />
                @error('street_name')
                    <p class="text-danger text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- House number --}}
            <div class="mb-3">
                <label for="house_number" class="form-label">Huisnummer</label>
                <input type="text" 
                    class="form-control" 
                    name="house_number"
                    value="{{ $address->house_number }}" />
                @error('house_number')
                    <p class="text-danger text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="postal_code" class="form-label">Postcode</label>
                    <input type="text" 
                        class="form-control" 
                        name="postal_code"
                        value="{{ $address->postal_code }}" />
                    @error('postal_code')
                        <p class="text-danger text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="form-group col-md-6">
                    <label for="city" class="form-label">Stad</label>
                    <input type="text" 
                        class="form-control" 
                        name="city"
                        value="{{ $address->city }}" />
                    @error('city')
                        <p class="text-danger text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="my-3">
                <button type="submit" class="button_1">
                    Aanpassen
                </button>
            </div>

            </form>
        </div>
    </div>
    {{-- Het terug knopje --}}
    <x-return-button/>
</x-layout>