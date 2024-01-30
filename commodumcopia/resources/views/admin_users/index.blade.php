{{--
titel: Admin Index Blade
beschrijving: Weergave van de bestaande gebruikers voor administratoren.
auteur: Pascal Thomasse Mol
versie: 1
aanmaakdatum: 22 jun 2023
laatste wijzigingsdatum: 17 jul 2023
--}}

{{--  --}}
<x-layout>
    <div style="width: 80vw; align-items: center;" class="mx-auto">
        @if (count($users) > 0)
            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    {{-- De tabel --}}
                    <thead>
                        <tr>
                            <th>Naam</th>
                            <th>Email</th>
                            <th>Taken</th>
                            <th>Aanpassen</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- Vul de tabel met de data van de gebruikers --}}
                        @foreach ($users as $user)
                            <tr>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->role }}</td>
                                <td>
                                    {{-- Naar de edit pagina --}}
                                    <a href="{{ route('admin.users.edit', ['id' => $user->id]) }}">
                                        <button class="btn btn-primary">Aanpassen</button>
                                    </a>
                                    <br>
                                    {{-- Gebruiker verwijderen --}}
                                    <form action="{{ route('admin.users.destroy', ['id' => $user->id]) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-primary mt-3">Verwijderen</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <nav class="mt-6 p-4">
                <!-- Pagination links -->
                {{ $users->links() }}
            </nav>
        {{-- Bij geen gebruikers: --}}
        @else
            <p>Geen gebruiker gevonden</p>
        @endif
    </div>
    {{-- Het terug knopje --}}
    <x-return-button/>
</x-layout>
