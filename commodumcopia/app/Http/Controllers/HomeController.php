<?php

/*
titel: HomeController
beschrijving: De HomeController is verantwoordelijk voor het beheren van de startpagina van de website.
    De index-methode haalt de nieuwste promotie, de nieuwste blogpost en drie willekeurige producten met korting op uit de database.
    Deze gegevens worden vervolgens doorgegeven aan de view 'welcome', waar ze worden weergegeven op de startpagina van de website.
auteur: Pascal Thomasse Mol
versie: 1
aanmaakdatum: 22 jun 2023
laatste wijzigingsdatum: 29 jun 2023
*/

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Product;
use App\Models\Promotion;
use Illuminate\Http\Request;

// De controller voor de startpagina
class HomeController extends Controller
{
    // Haal de niewste post en promotie op en 3 willekeurige producten in de aanbieding
    public function index()
    {
        // De meest rrecente blogpost en promotie ophalen
        $latestPromotion = Promotion::latest()->first();
        $latestPost = Post::latest()->first();
        // 3 artikelen met korting ophalen
        $discountedProducts = Product::with('discount')
                                 ->where('discount_id', '>', 0)
                                 ->inRandomOrder()
                                 ->take(3)
                                 ->get();

        return view('welcome', compact('latestPromotion', 'latestPost', 'discountedProducts'));
    }
}
