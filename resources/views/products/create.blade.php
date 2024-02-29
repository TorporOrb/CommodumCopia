{{--
titel: Products Create Blade
beschrijving: Het formulier om een nieuw product aan te maken.
auteur: Pascal Thomasse Mol
versie: 2
aanmaakdatum: 19 jun 2023
laatste wijzigingsdatum: 29 jun 2023
--}}

<x-layout>
    <div class="form_container">
        <div class="form_box">
            <h1>Nieuw product</h1>
            <form method="POST" 
            action="{{ route('products.store') }}"
            enctype="multipart/form-data">
            {{-- cross site request forgery beveiliging --}}    
            @csrf
                {{-- De naam van het product --}}
                <div class="text_field pt-2">
                    <input type="text" name="name" class="form_field"
                    value="{{ old('name') }}" placeholder="Product naam" />
                    @error('name')
                        <span class="fail">{{ $message }}</span>
                    @enderror
                </div>
                <br>
                {{-- De tekst --}}
                <div class="text_field">
                    <textarea name="body" class="form_field" placeholder="Omschrijving"
                    value="{{ old('body') }}" style="min-height: 10rem;"></textarea>
                    @error('body')
                        <span class="fail">{{ $message }}</span>
                    @enderror
                </div>
                <br>
                {{-- De prijs --}}
                <div class="text_field">
                    <input type="number" name="price" step="0.01" value="{{ old('price') }}"
                     class="form_field" placeholder="Prijs" />
                    @error('price')
                        <span class="fail">{{ $message }}</span>
                    @enderror
                </div>
                <br>
                {{-- De categorie --}}
                <div class="text_field">
                    <label>Selecteer Categorie</label>
                    <br>
                    <select name="category_id" value="{{ old('category_id') }}" class="form_field">
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
                <br>
                {{-- De subcategorie --}}
                <div class="text_field">
                    <label>Selecteer Sub-Categorie</label>
                    <br>
                    <select name="sub_category_id" value="{{ old('sub_category_id') }}" class="form_field">
                        @foreach ($subCategories as $subCategory)
                            <option value="{{ $subCategory->id }}">{{ $subCategory->name }}</option>
                        @endforeach
                    </select>
                </div>
                <br>
                {{-- De korting --}}
                <div>
                    <select name="discount_id" value="{{ old('discount_id') }}" class="form_field">
                        <option value="">Geen korting</option>
                        <option value="1">5%</option>
                        <option value="2">10%</option>
                        <option value="3">15%</option>
                        <option value="4">20%</option>
                        <option value="5">25%</option>
                        <option value="6">3 halen, 2 betalen</option>
                        <option value="7">2 halen, 1 betalen</option>
                    </select>
                </div>
                <br>
                {{-- De afbeelding --}}
                <div class="text_field">
                    <label for="image">Afbeelding:</label>
                    <br>
                    <input type="file" class="form-control-file mx-2" id="image" name="image">
                </div>
                <br>
                <button type="submit" class="submitbutton">Aanmaken</button>
            </form>
        </div>
    </div>
    {{-- Het terug knopje --}}
    <x-return-button/>
</x-layout>
