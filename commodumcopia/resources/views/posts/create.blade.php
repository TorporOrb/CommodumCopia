{{--
titel: Post Create Blade
beschrijving: Het formulier om een nieuwe post aan te maken.
auteur: Pascal Thomasse Mol
versie: 2
aanmaakdatum: 21 jun 2023
laatste wijzigingsdatum: 29 jun 2023
--}}

<x-layout>
    <div class="form_container">
        <div class="form_box">
            <h1>Nieuwe post</h1>
            <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">
                {{-- cross site request forgery beveiliging --}}
                @csrf
                {{-- de header --}}
                <div class="text_field">
                    <label for="header">Header:</label>
                    <br>
                    <input type="text" placeholder="De header" name="header"
                    value="{{ old('header') }}"  class="form_field" />
                    @error('header')
                        {{-- Foutmelding bij ongeldige header --}}
                        <span class="fail">{{ $message }}</span> 
                    @enderror
                </div>
                {{-- De sub_header --}}
                <div class="text_field">
                    <label for="sub_header">Sub Header:</label>
                    <br>
                    <input type="text" placeholder="De subheader" name="sub_header"
                    value="{{ old('sub_header') }}" class="form_field" />
                    @error('sub_header')
                        {{-- Foutmelding bij ongeldige subheader --}}
                        <span class="fail">{{ $message }}</span> 
                    @enderror
                </div>
                {{-- Het tekstveld --}}
                <div class="text_field mt-3">
                    <label for="text">Text:</label>
                    <br>
                    <textarea name="text" placeholder="De inhoud" class="form_field"
                    value="{{ old('text') }}" style="min-height: 12rem; min-width: 20rem;"></textarea>
                    @error('text')
                        {{-- Foutmelding bij ongeldige tekst --}}
                        <span class="fail">{{ $message }}</span> 
                    @enderror
                </div>
                <br>
                {{-- De afbeelding --}}
                <div class="text_field">
                    <label for="image">Afbeelding: </label>
                    <br>
                    <input type="file" name="image" class="form-control-file mx-2">
                    @error('image')
                        {{-- Foutmelding bij ongeldige afbeelding --}}
                        <span class="fail">{{ $message }}</span> 
                    @enderror
                </div>
                <br>
                <button type="submit" class="submitbutton">Aanmaken</button>
            </form>
        </div>
    </div>
    {{-- Het terug knopje --}}
    <x-return-button />
</x-layout>
