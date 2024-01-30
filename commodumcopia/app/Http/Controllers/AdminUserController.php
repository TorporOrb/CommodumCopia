<?php

/*
titel: AdminUserController
beschrijving:  De AdminUserController is verantwoordelijk voor het beheren van gebruikers voor beheerders.
Hiermee kunnen beheerders gebruikers bekijken, maken, bewerken en verwijderen.
Bij het aanmaken van een nieuwe gebruiker worden de adresgegevens doorgegeven aan de adrescontroller zodat de logica met betrekking tot adressen op één plaats blijft.
    De index-methode toont alle gebruikers in paginavorm met paginering.
    De create-methode toont het formulier voor het aanmaken van een nieuwe gebruiker. Het verschil met de reguliere klantregistratie is dat hier een rol ingesteld kan worden.
    De edit-methode haalt een specifieke gebruiker op voor bewerking. Ook worden de adresgegevens van de gebruiker opgehaald en gesplitst in straatnaam en huisnummer.
    De update-methode werkt een bestaande gebruiker bij in de database met behulp van de ingevoerde gegevens. Het wachtwoord wordt alleen opnieuw ingesteld als er een nieuwe is opgegeven.
    De destroy-methode verwijdert een specifieke gebruiker met het gegeven ID uit de database. Na het verwijderen wordt de gebruiker teruggestuurd naar de vorige pagina met een succesbericht.
auteur: Pascal Thomasse Mol
versie: 6
aanmaakdatum: 20 jun 2023
laatste wijzigingsdatum: 22 jul 2023
*/

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\AddressController;

// De controller voor administratoren om gebruikers te beheren

class AdminUserController extends Controller
{
    // Toon alle gebruikers
    public function index()
    {
        // Gebruikers ophalen met paginering
        $users = User::paginate(10);

        return view('admin_users.index', compact('users'));
    }
    
    // Weergave van het formulier voor het aanmaken van een gebruiker
    public function create()
    {
        return view('admin_users.create');
    }

    // Een niewe gebruiker opslaan
    public function store(Request $request, AddressController $addressController)
    {
        // Validatie
        $validatedData = $request->validate([
            'name' => 'required|not_regex:/[<>]/',
            'email' => 'required|email',
            'password' => 'required|confirmed',
            'role' => 'required|in:user,admin',
               
        ]); 

        // Opslaan gevalideerde data
        $user = new User;
        $user->name = $validatedData['name'];
        $user->email = $validatedData['email'];
        $user->password = bcrypt($validatedData['password']);
        $user->role = $validatedData['role'];
        $user->save();

        // De adresgegevens in een array zetten
        $addressData = [
            'street_name' => $request->input('street_name'),
            'house_number' => $request->input('house_number'),
            'postal_code' => $request->input('postal_code'),
            'city' => $request->input('city'),
            'user_id' => $user->id,
        ];
        // De adresgegevens aan de AdresController doorgeven om opgeslagen te worden. 
        $addressController->store($addressData);

        return redirect()->back()->with('success', 'Gebruiker aangemaakt.');
    }

    // Gebruiker ophalen voor bewerking
    public function edit($id)
    {
        // Gebruikersgegevens ophalen
        $user = User::findOrFail($id);
        $address = $user->addresses()->first();
        // address opsplitsen in straatnaam en huisnummer
        $addressArray = explode(" ", $address->address );
        $address->street_name = $addressArray[0];
        $address->house_number = $addressArray[1];
        // View ophalen
        return view('admin_users.edit', compact('user', 'address'));
    }

    // De gebruiker aanpassen
    public function update(Request $request, $id, AddressController $addressController)
    {
        // Validatie
        $validatedData = $request->validate([
            'name' => 'required|not_regex:/[<>]/',
            'email' => 'required|email|unique:users,email,'.$id,
            'password' => 'nullable|confirmed',
            'role' => 'required|in:user,admin',
        ]);
        
        // Opslaan gevalideerde data
        $user = User::findOrFail($id);
        $user->name = $validatedData['name'];
        $user->email = $validatedData['email'];
        $user->role = $validatedData['role'];
        // wachtwoord alleen aanpassen als er een nieuw wachtwoord opgegeven is.
        if ($request->filled('password')) {
            // Wachtwoord beveiligen.
            $user->password = bcrypt($request->input('password'));
        }
        // gegevens opslaan
        $user->save();
        // Adresgevens klaarzetten in een array
        $addressData = [
            'postal_code' => $request->input('postal_code'),
            'city' => $request->input('city'),
            'user_id' => $user->id,
            'street_name' => $request->input('street_name'),
            'house_number' => $request->input('house_number'),
        ];
        // Array doorsturen naar de AdresController
        $addressController->store($addressData);

        return redirect()->back()->with('success', 'Gebruiker bijgewerkt.');
    }

    // Gebruiker verwijderen
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->back()->with('success', 'Gebruiker verwijderd.');
    }
}