<?php

/*
titel: SearchController
beschrijving: De SearchController regelt de functionaliteit van de zoekbalk.
    De index-methode zoekt aan de hand van het ingevoerde keyword in de database in de producttabel en toont de resultaten op de indexpagina.
    Er wordt gezocht in de "name" en "body" kolommen. Als er ooit op meer plekken (zoals tags) gezocht moet worden, kan dit door een extra ->orWhere toe te voegen.
auteur: Pascal Thomasse Mol
versie: 2
aanmaakdatum: 26 jun 2023
laatste wijzigingsdatum: 29 jun 2023
*/

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

// De controller voor de zoekbalk 
class SearchController extends Controller
{
    // Zoek naar de producten met het keyword in de naam of text. 
    public function index(Request $request)
    {
        // Validatie
        $validatedData = $request->validate([
            'keyword' => 'required|not_regex:/[<>]/',
        ]);
        
        // Haal het keyword op
        $keyword = $validatedData['keyword'];
        // Zoek in de naam en de body naar het keyword. 
        $products = Product::where('name', 'like', '%' . $keyword . '%')
            ->orWhere('body', 'like', '%' . $keyword . '%')
            ->get();
        
        return view('search.index', [
            'products' => $products,
            'keyword' => $keyword,
        ]);
    }
}
