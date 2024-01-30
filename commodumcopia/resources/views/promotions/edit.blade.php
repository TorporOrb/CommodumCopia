{{--
titel: Promotions Edit Blade
beschrijving: Het formulier om een promotie aan te passen.
auteur: Pascal Thomasse Mol
versie: 2
aanmaakdatum: 21 jun 2023
laatste wijzigingsdatum: 29 jun 2023
--}}
{{-- --}}
<x-layout>
    <div class="form_container">
        <div class="form_box">
            <h1>Promotie Bewerken</h1>
            <form action="{{ route('promotions.update', $promotion->id) }}" method="POST" enctype="multipart/form-data">
                {{-- cross site request forgery beveiliging --}}
                @csrf
                @method('PUT')
                {{-- De header --}}
                <div class="text_field">
                    <label for="name">Header:</label>
                    <br>
                    <input type="text" placeholder="De header" name="header" class="form_field" value="{{ $promotion->header }}" />
                    @error('header')
                    <span class="fail">{{ $message }}</span>
                    @enderror
                </div>
                {{-- De subheader --}}
                <div class="text_field">
                    <label for="name">Sub Header:</label>
                    <br>
                    <input type="text" placeholder="De subheader" name="sub_header" class="form_field" value="{{ $promotion->sub_header }}" />
                    @error('sub_header')
                    <span class="fail">{{ $message }}</span>
                    @enderror
                </div>
                {{-- De tekst --}}
                <div class="text_field mt-3">
                    <label for="text">Text:</label>
                    <br>
                    <textarea name="text" placeholder="De inhoud" class="form_field" style="min-height: 12rem; min-width: 20rem;">{{ $promotion->text }}</textarea>
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
                <button type="submit" class="submitbutton">Opslaan</button>
            </form>
        </div>
    </div>
    {{-- Het terug knopje --}}
    <x-return-button/>
</x-layout>
