{{--
titel: Post Index Blade
beschrijving: De pagina waar de posts getoond worden aan de admin.
auteur: Pascal Thomasse Mol
versie: 2
aanmaakdatum: 20 jun 2023
laatste wijzigingsdatum: 18 jul 2023
--}}
<x-layout>
<div style="width: 80vw; align-items: center;" class="mx-auto">
    @if (count($posts) > 0)
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        {{-- De opmaak van de tabel --}}
                        <th>Header</th>
                        <th>Sub_Header</th>
                        <th style="width:20rem">Text</th>
                        <th>Afbeelding</th>
                        <th>Aanpassen</th>
                    </tr>
                </thead>
                <tbody>
                    {{-- Loop door de posts --}}
                    @foreach ($posts as $post)
                        <tr>
                            {{-- Toon de data in de tabel --}}
                            <td>{{ $post->header }}</td>
                            <td>{{ $post->sub_header }}</td>
                            <td>{{ $post->text }}</td>
                            <td>
                                <img src="{{ asset(str_replace('uploads/', 'uploads/image/', $post->image)) }}" 
                                alt="Image" class="rounded"
                                style="height: 10rem; width: 10rem; object-fit: cover;">
                            </td>
                            <td>
                                {{-- Link naar de edit pagina --}}
                                <a href="{{ route('posts.edit', ['id' => $post->id]) }}">
                                    <button class="button_1 mt-3">Aanpassen</button>
                                </a>
                                <br>
                                {{-- Post verwijderen --}}
                                <form action="{{ route('posts.destroy', ['id' => $post->id]) }}" method="POST">
                                    {{-- cross site request forgery beveiliging --}}
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="button_1 mt-3">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <nav class="mt-6 p-4">
            <!-- De paginatie -->
            {{ $posts->links() }}
        </nav>
    @endif
</div>
{{-- Het terug knopje --}}
<x-return-button/>
</x-layout>
