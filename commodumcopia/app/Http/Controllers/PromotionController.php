<?php

/*
titel: PromotionController
beschrijving: De PromotionController is verantwoordelijk voor het beheren van de promoties op de website.
    De show-methode toont een individuele promotie met het gegeven ID.
    De index-methode haalt alle promoties op en toont ze met paginering.
    De create-methode toont het formulier om een nieuwe promotie te maken.
    De store-methode verwerkt het opslaan van een nieuwe promotie, waarbij de gevalideerde gegevens worden opgeslagen in de database.
    De edit-methode laadt de gegevens van een bestaande promotie voor aanpassingen.
    De update-methode past een bestaande promotie aan, waarbij de afbeelding alleen wordt gewijzigd als er een nieuwe afbeelding is opgegeven.
    De destroy-methode verwijdert een promotie uit de database. 
auteur: Pascal Thomasse Mol
versie: 2
aanmaakdatum: 21 jun 2023
laatste wijzigingsdatum: 30 jun 2023
*/

namespace App\Http\Controllers;

use App\Models\Promotion;
use Illuminate\Http\Request;

// Controller om promoties te beheren
class PromotionController extends Controller
{
    // Toon een promotie
    public function show($id)
    {
        $promotion = Promotion::findOrFail($id);
        return view('promotions.show', compact('promotion'));
    }
    
    // Toon alle promoties
    public function index()
    {
        $promotions = Promotion::paginate(10);

        return view('promotions.index', compact('promotions'));
    }

    // Toon het formulier om een promotie aan te maken
    public function create(){
        return view('promotions.create');
    }

    // Sla een promotie op
    public function store(Request $request)
    {
        // Validatie
        $validatedData = $request->validate([
            'header' => 'required|not_regex:/[<>]/',
            'sub_header' => 'required|not_regex:/[<>]/',
            'text' => 'required|not_regex:/[<>]/',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', 
        ]);

        $path = $request->file('image')->store('image', 'public_uploads');
        $validatedData['image'] = str_replace('image/', 'uploads/', $path);
        
        // Maak een nieuwe promotie aan met de gevalideerde data
        $promotion = new Promotion();
        $promotion->header = $validatedData['header'];
        $promotion->sub_header = $validatedData['sub_header'];
        $promotion->text = $validatedData['text'];
        $promotion->image = $validatedData['image'];
        $promotion->save();

        return redirect()->route('promotions.index')->with('success', 'Promotie succesvol aangemaakt.');
    }

    // Toon het formulier om een promotie aan te passen
    public function edit($id){
        $promotion = Promotion::findOrFail($id);
        return view('promotions.edit', compact('promotion'));
    }

    // Pas de promotie aan
    public function update(Request $request, $id)
    {
        $post = Promotion::findOrFail($id);

        // Validatie
        $validatedData = $request->validate([
            'header' => 'required|not_regex:/[<>]/',
            'sub_header' => 'required|not_regex:/[<>]/',
            'text' => 'required|not_regex:/[<>]/',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', 
        ]);

        // Geef de nieuwe waardes aan de promotie
        $promotion->header = $validatedData['header'];
        $promotion->sub_header = $validatedData['sub_header'];
        $promotion->text = $validatedData['text'];

        // Pas de afbeelding alleen aan als er een nieuwe opgegeven is
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('image', 'public_uploads');
            $validatedData['image'] = str_replace('image/', 'uploads/', $path);
            $promotion->image = $validatedData['image'];
        }
        // Sla de wijzigingen op
        $promotion>save();

        return redirect()->route('promotions.index')->with('success', 'Promotie succesvol aangepast.');
    }

    // Verwijder de promotie
    public function destroy($id)
    {
        $promotion = Promotion::findOrFail($id);     
        $promotion->delete();

        return redirect()->route('promotions.index')->with('success', 'Promotie succesvol verwijderd.');
    }
}
