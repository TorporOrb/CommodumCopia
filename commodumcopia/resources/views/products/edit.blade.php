{{--
titel: Products Edit Blade
beschrijving: Formulier om een product aan te passen.
auteur: Pascal Thomasse Mol
versie: 3
aanmaakdatum: 20 jun 2023
laatste wijzigingsdatum: 28 aug 2023
--}}

<x-layout>
    <div class="form_container">
        <div class="form_box">
            <h1>Product bewerken</h1>
            <form method="POST" 
                action="{{ route('products.update', $product->id) }}"
                enctype="multipart/form-data">
                {{-- cross site request forgery beveiliging --}}
                @csrf
                @method('PUT')
                {{-- De naam --}}
                <div class="text_field pt-2">
                    <label>Naam</label>
                    <br>
                    <input type="text" name="name" class="form_field" placeholder="Product naam" value="{{ $product->name }}" />
                    @error('name')
                        <span class="fail">{{ $message }}</span>
                    @enderror
                </div>
                <br>
                {{-- De tekst --}}
                <div class="text_field">
                    <label>Omschrijving</label>
                    <br>
                    <textarea name="body" class="form_field" placeholder="Omschrijving" style="min-height: 10rem;">{{ $product->body }}</textarea>
                    @error('body')
                        <span class="fail">{{ $message }}</span>
                    @enderror
                </div>
                <br>
                {{-- De prijs--}}
                <div class="text_field">
                    <label>Prijs</label>
                    <br>
                    <input type="number" name="price" step="0.01" class="form_field" placeholder="Prijs" value="{{ $product->price }}" />
                    @error('price')
                        <span class="fail">{{ $message }}</span>
                    @enderror
                </div>
                <br>
                {{-- De categorie --}}
                <div class="text_field">
                    <label>Categorie</label>
                    <br>
                    <select name="category_id" class="form_field">
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" {{ $category->id === $product->category_id ? 'selected' : '' }}>{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
                <br>
                {{-- De subcategorie --}}
                <div class="text_field">
                    <label>Sub-Categorie</label>
                    <br>
                    <select name="sub_category_id" class="form_field">
                        @foreach ($subCategories as $subCategory)
                            <option value="{{ $subCategory->id }}" {{ $subCategory->id === $product->sub_category_id ? 'selected' : '' }}>{{ $subCategory->name }}</option>
                        @endforeach
                    </select>
                </div>
                <br>
                {{-- De korting --}}
                <div>
                    <label>Korting</label>
                    <br>
                    <select name="discount_id" class="form_field">
                        <option value="">Geen korting</option>
                        <option value="1" {{ $product->discount_id === 1 ? 'selected' : '' }}>5%</option>
                        <option value="2" {{ $product->discount_id === 2 ? 'selected' : '' }}>10%</option>
                        <option value="3" {{ $product->discount_id === 3 ? 'selected' : '' }}>15%</option>
                        <option value="4" {{ $product->discount_id === 4 ? 'selected' : '' }}>20%</option>
                        <option value="5" {{ $product->discount_id === 5 ? 'selected' : '' }}>25%</option>
                        <option value="6" {{ $product->discount_id === 6 ? 'selected' : '' }}>3 halen, 2 betalen</option>
                        <option value="7" {{ $product->discount_id === 7 ? 'selected' : '' }}>2 halen, 1 betalen</option>
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
                <button type="submit" class="submitbutton">Opslaan</button>
            </form>
        </div>
    </div>
        {{-- Product verwijderen --}}
        <div class="form_box">
            <h1 class="my-2">Product verwijderen</h1>
            <form action="{{ route('products.destroy', ['id' => $product->id]) }}" method="POST">
                {{-- cross site request forgery beveiliging --}}
                @csrf
                @method('DELETE')
                <button type="submit" class="deletebutton">Delete</button>
            </form>
        </div>
    {{-- Het terug knopje --}}
    <x-return-button/>
</x-layout>
