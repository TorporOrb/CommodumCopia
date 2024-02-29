{{--
titel: Admin orders index Blade
beschrijving: Het formulier om de gebruikers te tonen aan de beheerders.
auteur: Pascal Thomasse Mol
versie: 2
aanmaakdatum: 26 aug 2023
laatste wijzigingsdatum: 28 aug 2023
--}}

<x-layout>
    {{-- Blok voor het bekijken van orders --}}
    <div class="center">
        <div class="card">
            <div class="p-5">
                <h2 class="text-lg font-semibold mb-4">Gebruikerslijst</h2>
                
                {{-- Loop through the users and display their information --}}
                @foreach ($users as $user)
                    <div class="mb-3">
                        <a href="{{ route('admin.orders.user', $user->id) }}" class="text-blue-500 hover:underline">{{ $user->name }}</a>
                        <span class="text-gray-500"> - {{ $user->email }}</span>
                    </div>
                @endforeach
                
                {{-- Display pagination links --}}
                {{ $users->links() }}
            </div>
        </div>
    </div>
</x-layout>