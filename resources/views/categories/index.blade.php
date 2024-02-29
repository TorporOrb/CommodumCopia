{{--
titel: Categories Index Blade
beschrijving: De pagina met de weergave van de beschikbare hoofdcategorieën.
auteur: Pascal Thomasse Mol
versie: 2
aanmaakdatum: 23 jun 2023
laatste wijzigingsdatum: 29 jun 2023
--}}

<x-layout>
<div class="d-flex justify-content-center">
    <div class="row" style="width: 80%">
        {{-- Loop door de categorieën --}}
        @foreach ($categories as $category)
        <div class="col-lg-4 col-md-6 col-sm-12">
            {{-- Link naar de categorie --}}
            <a href="{{ route('categories.show', ['id' => $category->id]) }}">
                <div class="card m-2">
                    {{-- De afbeelding --}}
                    <div class="imagebox mx-auto my-3 text-center">
                        <img src="{{ asset($category->image) }}" class="card-img-top mx-auto rounded mt-2"
                            alt="Category Image" style="height: 10rem; width: 10rem; object-fit: cover;">
                    </div>
                    {{-- De naam --}}
                    <div class="card-body">
                        <h5 class="card-title">{{ $category->name }}</h5>
                    </div>
                </div>
            </a>
        </div>
        @endforeach
    </div>
</div>
</x-layout>