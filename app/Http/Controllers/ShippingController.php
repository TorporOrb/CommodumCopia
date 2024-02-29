<?php

/*
titel: ShippingController
beschrijving: De ShippingController regelt de verzendgegevens. Tot het bevestigen van de order worden verzendgegevens opgeslagen in de sessie in plaats van de database.
Dit is om te voorkomen dat een gebruiker op een later moment terugkomt om de bestelling door te zetten en de mogelijke verzendtijden niet meer kloppen.
    De create-methode haalt het formulier op om de verzendgegevens in te kunnen vullen.
    De store-methode slaat de gegevens op in de sessie in plaats van de database. Dit is zodat er geen oude niet meer geldige waarden opgeslagen kunnen zijn bij een klant die halverwege een order iets anders gaat doen.
auteur: Pascal Thomasse Mol
versie: 1
aanmaakdatum: 07 jul 2023
laatste wijzigingsdatum: 21 jul 2023
*/

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ShippingController extends Controller
{
    public function create()
    {
        // Haal de geauthenticeerde gebruiker op
        $user = auth()->user();

        // Haal het adres van de gebruiker op
        $address = $user->addresses()->first();

        return view('shipping.create', compact('address'));
    }
    
    public function edit()
    {
        // Haal de geauthenticeerde gebruiker op
        $user = auth()->user();

        // Haal het adres van de gebruiker op
        $address = $user->addresses()->first();

        return view('shipping.edit', compact('address'));
    }

    public function store(Request $request)
    {
        // Valideer de gegevens van het formulier
        $deliveryTime = $request->input('delivery_time');
        $deliveryDate = $request->input('delivery_date');
        session(['delivery_date' => $deliveryDate]);
        session(['delivery_time' => $deliveryTime]);

        // Doorverwijzen naar de orders.create pagina
        return redirect()->route('orders.create');
    }
    
}