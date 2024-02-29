<?php

/*
titel: SubCategoryController
beschrijving: De SubCategoryController is verantwoordelijk voor het tonen van een subcategorie met de bijbehorende producten.
    De show-methode haalt de subcategorie op met het opgegeven ID en vervolgens worden alle producten geladen die aan die subcategorie zijn gekoppeld.
auteur: Pascal Thomasse Mol
versie: 2
aanmaakdatum: 27 jun 2023
laatste wijzigingsdatum: 29 jun 2023
*/

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\SubCategory;
use Illuminate\Http\Request;

// De controller voor de sub_categorieën
class SubCategoryController extends Controller
{
    // Toon de sub_categorie met de bijbehorende producten
    public function show($id)
    {
        $subcategory = SubCategory::findOrFail($id);        
        $products = Product::where('sub_category_id', $subcategory->id)->get();
        
        return view('subcategories.show', compact('subcategory', 'products'));
    }
}
