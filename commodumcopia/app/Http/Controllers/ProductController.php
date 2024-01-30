<?php

/*
titel: ProductController
beschrijving: De ProductController is verantwoordelijk voor het beheren van de producten.
    De index-methode toont alle producten.
    De show-methode toont een individueel product.
    De create-methode toont het formulier om een nieuw product aan te maken.
    De store-methode is verantwoordelijk voor het opslaan van een nieuw product in de database.
    De edit-methode toont het formulier om een bestaand product aan te passen.
    De update-methode werkt een bestaand product bij in de database.
    De destroy-methode verwijdert een product uit de database.
auteur: Pascal Thomasse Mol
versie: 3
aanmaakdatum: 19 jun 2023
laatste wijzigingsdatum: 1 jul 2023
*/

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;

// De controller om producten te beheren
class ProductController extends Controller
{
    // Toon alle producten per 10.
    public function index()
    {
        $products = Product::with('discount')->paginate(10);

        return view('products.index', ['products' => $products]);
    }

    // Toon een product
    public function show($id)
    {
        $product = Product::with('discount')->findOrFail($id);

        return view('products.show', compact('product'));
    }
    
    // Toon het formulier om een product aan te maken 
    public function create()
    {
        // Haal de categorieën en subcategorieën op
        $categories = Category::all();
        $subCategories = SubCategory::all();

        return view('products.create', compact('categories', 'subCategories'));
    }

    // Sla een nieuw product op
    public function store(Request $request)
    {
        // validatie
        $validatedData = $request->validate([
            'name' => 'required|not_regex:/[<>]/',
            'body' => 'required|not_regex:/[<>]/',
            'price' => 'required|numeric',
            'category_id' => 'required|numeric',
            'sub_category_id' => 'required|numeric',
            'discount_id' => 'nullable|numeric',
            'image' => 'nullable|image',
        ]);
        

        $path = $request->file('image')->store('image', 'public_uploads');
        $validatedData['image'] = str_replace('image/', 'uploads/', $path);

        // Maak het product aan
        $product = Product::create($validatedData);

        return redirect()->route('products.index')->with('success', 'Product succesvol aangemaakt.');
    }

    // Toon het formulier om een product aan te passen
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        // Haal de categorieën en subcategorieën op
        $categories = Category::all();
        $subCategories = SubCategory::all();

        return view('products.edit', compact('product', 'categories', 'subCategories'));
    }

    // Pas het product aan
    public function update(Request $request, Product $product)
    {
        // Validatie
        $validatedData = $request->validate([
            'name' => 'required|not_regex:/[<>]/',
            'body' => 'required|not_regex:/[<>]/',
            'price' => 'required|numeric',
            'category_id' => 'required|numeric',
            'sub_category_id' => 'required|numeric',
            'discount_id' => 'nullable|numeric',
            'image' => 'nullable|image',
        ]);

        // Pas de afbeelding alleen aan als er een nieuwe aangeleverd is
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('uploads', 'public');
            $validatedData['image'] = str_replace('public/', '', $path);
        }

        // Pas het product aan
        $product->update($validatedData);

        return redirect()->route('products.index')->with('success', 'Product succesvol aangepast.');
    }    

    //Verwijder het product
    public function destroy($id)
    {
        $product = Product::findOrFail($id);     
        $product->delete();

        return redirect()->route('products.index')->with('success', 'Product succesvol verwijderd.');
    }

   
}
