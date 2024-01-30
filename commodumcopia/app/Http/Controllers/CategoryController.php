<?php

/*
titel: CategoryController
beschrijving:  De CategoryController is verantwoordelijk is voor het beheren van de categoriepagina's. Het heeft twee belangrijke methoden:
- De index-methode haalt alle categorieën op uit de database en stuurt ze door naar de view 'categories.index'. 
- De show-methode haalt een categorie op aan de hand van het opgegeven ID. 
    Vervolgens worden alle subcategorieën die aan deze categorie zijn gekoppeld, opgehaald en samen met de bijbehorende producten naar de view 'categories.show' gestuurd. 
auteur: Pascal Thomasse Mol
versie: 2
aanmaakdatum: 23 jun 2023
laatste wijzigingsdatum: 29 jun 2023
*/

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;

// Controller voor de categorie pagina's
class CategoryController extends Controller
{
    // Alle categorieën ophalen 
    public function index()
    {
        $categories = Category::get(); 

        return view('categories.index', compact('categories'));
    }

    // Een categorie ophalen met de bijhorende sub_categorieën en producten 
    public function show($id)
    {
        $category = Category::findOrFail($id);
        $subcategories = SubCategory::where('category_id', $category->id)->get();
        
        $productsBySubcategory = [];
        // Vul bovenstaande aray met de producten per sub_categorie
        foreach ($subcategories as $subcategory) {
            $products = Product::where('sub_category_id', $subcategory->id)->get();
            $productsBySubcategory[$subcategory->id] = $products;
        }
        
        return view('categories.show', compact('category', 'subcategories', 'productsBySubcategory'));
    }
}
