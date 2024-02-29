{{--
titel: Promotions Create Blade
beschrijving: De pagina om een nieuwe promotie aan te maken.
auteur: Pascal Thomasse Mol
versie: 2
aanmaakdatum: 21 jun 2023
laatste wijzigingsdatum: 29 jun 2023
--}}
{{-- De pagina om een nieuwe promotie aan te maken --}}
<x-layout>
<div class="form_container">
    <div class="form_box">
        <h1>Nieuwe Promotie</h1>
        <form action="{{ route('promotions.store') }}" method="POST" enctype="multipart/form-data">
            {{-- cross site request forgery beveiliging --}}
            @csrf
            {{-- De header --}}
            <div class="text_field">
                <label for="header">Header:</label>
                <br>
                <input type="text" placeholder="De header" name="header" 
                value="{{ old('header') }}" class="form_field" />
                @error('header')
                    <span class="fail">{{ $message }}</span>
                @enderror
            </div>
            {{-- De subheader --}}
            <div class="text_field">
                <label for="sub_header">Sub Header:</label>
                <br>
                <input type="text" placeholder="De subheader" name="sub_header"
                value="{{ old('sub_header') }}"  class="form_field" />
                @error('sub_header')
                    <span class="fail">{{ $message }}</span>
                @enderror
            </div>
            {{-- de tekst --}}
            <div class="text_field mt-3">
                <label for="text">Text:</label>
                <br>
                <textarea name="text" placeholder="De inhoud"
                value="{{ old('text') }}"  class="form_field" style="min-height: 12rem; min-width: 20rem;"></textarea>
                @error('text')
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
                    <span class="fail">{{ $message }}</span>
                @enderror
            </div>
            <br>
            <button type="submit" class="submitbutton">Aanmaken</button>
        </form>
    </div>
</div>
{{-- Het terug knopje --}}
<x-return-button/>
</x-layout>
