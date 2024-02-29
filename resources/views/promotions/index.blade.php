{{--
titel: Promotions Index Blade
beschrijving: De pagina om bestaande promoties in te zien.
auteur: Pascal Thomasse Mol
versie: 2
aanmaakdatum: 21 jun 2023
laatste wijzigingsdatum: 1 jul 2023
--}}

<x-layout>
<div style="width: 80vw; align-items: center;" class="mx-auto">
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                {{-- De tabel --}}
                <thead>
                    <tr>
                        <th>Header</th>
                        <th>Sub_Header</th>
                        <th style="width:20rem">Text</th>
                        <th>Image</th>
                        <th>Edit</th>
                    </tr>
                </thead>
                <tbody>
                    {{-- Loop door de promoties en toon ze in de tabel --}}
                    @foreach ($promotions as $promotion)
                        <tr>
                            <td>{{ $promotion->header }}</td>
                            <td>{{ $promotion->sub_header }}</td>
                            <td>{{ $promotion->text }}</td>
                            <td>
                                <img src="{{ asset(str_replace('uploads/', 'uploads/image/', $promotion->image)) }}" 
                                alt="Image" class="rounded"
                                style="height: 10rem; width: 10rem; object-fit: cover;">
                            </td>
                            <td>
                                {{-- Naar de edit pagina --}}
                                <a href="{{ route('promotions.edit', ['id' => $promotion->id]) }}">
                                    <button class="button_1">Aanpassen</button>
                                </a>
                                <br>
                                {{-- Promotie verwijderen --}}
                                <form action="{{ route('promotions.destroy', ['id' => $promotion->id]) }}" method="POST">
                                    {{-- cross site request forgery beveiliging --}}
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="button_1">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <nav class="mt-6 p-4">
            <!-- De paginatie -->
            {{ $promotions->links() }}
        </nav>
</div>
{{-- Het terug knopje --}}
<x-return-button/>
</x-layout>
