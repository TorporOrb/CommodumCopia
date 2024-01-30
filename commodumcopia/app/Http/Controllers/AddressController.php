<?php

/*
titel: AddressController
beschrijving:  De AddressController is verantwoordelijk voor het beheren van adresgegevens in de applicatie.
    De store-methode wordt aangeroepen vanuit de store-methode van zowel de AuthController als de AdminUserController zodat het opslaan van de adresgegevens op één plaats blijft.
    De edit-methode haalt het formulier op waarmee de gebruiker de gegevens kan aanpassen.
    De update-methode wordt gebruikt om de nieuwe gegevens op te slaan en deze wordt ook aangeroepen in de update-methode van de AdminUserController.
auteur: Pascal Thomasse Mol
versie: 3
aanmaakdatum: 10 jul 2023
laatste wijzigingsdatum: 21 jul 2023
*/

namespace App\Http\Controllers;

use App\Models\Address;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AddressController extends Controller
{
    // Slaat een nieuw adres op in de database.
    public function store(array $addressData)
    {
        // De data valideren
        $validatedData = (new Request($addressData))->validate([
            'street_name' => 'required|not_regex:/[<>]/',
            'house_number' => 'required|not_regex:/[<>]/',
            'postal_code' => 'required|not_regex:/[<>]/',
            'city' => 'required|not_regex:/[<>]/',  
            'user_id' => 'required',
        ]);  

        // De data naar de database svhrijven
        $address = new Address;
        $address->address = $validatedData['street_name'] . ' ' . $validatedData['house_number'];
        $address->postal_code = $validatedData['postal_code'];
        $address->city = $validatedData['city'];
        $address->user_id = $validatedData['user_id'];
        $address->save();  
    }

    //Toont het bewerkingsformulier voor een adres.
    public function edit($id)
    {
        $address = Address::findOrFail($id);
        $addressArray = explode(" ", $address->address );
        $address->street_name = $addressArray[0];
        $address->house_number = $addressArray[1];
        return view('address.edit', compact('address'));
    }
    
    // Werkt een bestaand adres bij in de database.
    public function update(Request $request, $id)
    {
        // Validatie
        $validatedData = $request->validate([
            'street_name' => 'required',
            'house_number' => 'required',
            'postal_code' => 'required',
            'city' => 'required',   
        ]);  
        // Haal de huidige gebruiker en het huidige adres_id op:
        $user = Auth::user();
        $address = Address::findOrFail($id);

        // Check of de gebruiker matched met het adres-id of een admin is.  
        if ($user->id === $address->user_id || $user->isAdmin()) {
            // Pas de gegevens aan
            $address->address = $validatedData['street_name'] . ' ' . $validatedData['house_number'];
            $address->postal_code = $validatedData['postal_code'];
            $address->city = $validatedData['city'];
            $address->save();  

            // Bij succes doorsturen naar de profiel pagina met een succes boodschap. 
            return redirect()->route('profile.index')->with('success', 'De gegevens zijn aangepast');
        } else {
            // Bij een fout terugsturen met een foutmelding. 
            return redirect()->back()->with('error', 'Je hebt geen toestemming om deze gegevens aan te passen.');
        }
    }
}