<?php

/*
titel: PostController
beschrijving: De PostController is verantwoordelijk voor het beheren van de blogberichten op de website.
    De show-methode toont een individueel blogbericht met het gegeven ID.
    De index-methode haalt alle blogberichten op en toont deze met paginering.
    De create-methode toont het formulier om een nieuw blogbericht te maken.
    De store-methode verwerkt het opslaan van een nieuw blogbericht,
    waarbij de gevalideerde gegevens worden opgeslagen in de database en de gebruiker wordt doorgestuurd naar het overzicht van blogberichten.
    De edit-methode laadt de gegevens van een bestaand blogbericht voor aanpassingen.
    De update(Request $request, $id)-methode past een bestaand blogbericht aan aan de hand van de gegevens uit het Request-object,
    waarbij de afbeelding alleen wordt gewijzigd als er een nieuwe afbeelding is opgegeven.
    De destroy-methode verwijdert een blogbericht met het opgegeven ID uit de database en stuurt de gebruiker door naar het overzicht van blogberichten met een succesbericht.
auteur: Pascal Thomasse Mol
versie: 2
aanmaakdatum: 20 jun 2023
laatste wijzigingsdatum: 29 jun 2023
*/

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

// De controller voor het beheren van de posts
class PostController extends Controller
{
    // Post tonen
    public function show($id)
    {
        $post = Post::findOrFail($id);
        return view('posts.show', compact('post'));
    }
    
    // Alle posts ophalen
    public function index()
    {
        $posts = Post::paginate(10);

        return view('posts.index', compact('posts'));
    }

    // Het formulier ophalen om een post te kunnen maken
    public function create(){
        return view('posts.create');
    }

    // Post opslaan
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
        
        // Sla de gevalideerde data op
        $post = new Post();
        $post->header = $validatedData['header'];
        $post->sub_header = $validatedData['sub_header'];
        $post->text = $validatedData['text'];
        $post->image = $validatedData['image'];
        $post->save();

        return redirect()->route('posts.index')->with('success', 'Post succesvol aangemaakt.');
    }

    // Laad de data van een post voor aanpassingen
    public function edit($id){
        $post = Post::findOrFail($id);
        return view('posts.edit', compact('post'));
    }

    // Pas de post aan
    public function update(Request $request, $id)
    {
        $post = Post::findOrFail($id);

        // Validatie
        $validatedData = $request->validate([
            'header' => 'required|not_regex:/[<>]/',
            'sub_header' => 'required|not_regex:/[<>]/',
            'text' => 'required|not_regex:/[<>]/',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', 
        ]);

        // Pas de post aan met de gavalideerde data
        $post->header = $validatedData['header'];
        $post->sub_header = $validatedData['sub_header'];
        $post->text = $validatedData['text'];

        // Pas de afbeelding alleen aan als er een nieuwe afbeelding gegeven is.
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('image', 'public_uploads');
            $validatedData['image'] = str_replace('image/', 'uploads/', $path);
            $post->image = $validatedData['image'];
        }

        $post->save();

        // Redirect to a success page or perform any additional actions

        return redirect()->route('posts.index')->with('success', 'Post succesvol aangepast.');
    }

    // Verwijder de post
    public function destroy($id)
    {
        
        $post = Post::findOrFail($id);
        $post->delete();        

        return redirect()->route('posts.index')->with('success', 'Post succesvol verwijderd.');
    }

}
