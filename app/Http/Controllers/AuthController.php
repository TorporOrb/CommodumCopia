<?php

/*
titel: AuthController
beschrijving:  De AuthController is verantwoordelijk voor het registreren, inloggen en uitloggen van de gebruikers.
- De login-methode controleert de inloggegevens en gebruikt Rate Limiting om brute force aanvallen tegen te gaan alvorens een nieuwe sessie te starten.
- De logout-methode stopt de huidige sessie en genereert een nieuwe csrf-token.  
- De create-methode toont het registratieformulier voor nieuwe gebruikers. 
- De store-methode slaat een nieuwe gebruiker op in de database. 
    De ingevoerde gegevens worden gevalideerd, het password wordt beveiligd en er wordt een nieuwe User aangemaakt met de standaardrol 'user'. 
    Het adres van de gebruiker wordt ook opgeslagen met behulp van de AddressController, zodat de logica met betrekking tot adressen op één plaats blijft.
auteur: Pascal Thomasse Mol
versie: 4
aanmaakdatum: 25 jun 2023
laatste wijzigingsdatum: 18 jul 2023
*/

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AddressController;
use Illuminate\Support\Facades\RateLimiter;

// Controller voor autorisatie doeleinden 
class AuthController extends Controller
{
    public function login(Request $request)
    {
        // Rate limiting configuratie
        $maxAttempts = 5;
        $decayMinutes = 1;

        // Validatie
        $formFields = $request->validate([
            'email' => ['required', 'email'],
            'password' => 'required', 
        ]);

        // Rate limiting controleren
        if (RateLimiter::tooManyAttempts($request->email, $maxAttempts, $decayMinutes)) {
            // Verdere actie uitvoeren wanneer de limiet is overschreden, bijvoorbeeld foutmelding tonen
            return back()->with('error', 'Te veel inlogpogingen. Probeer het later opnieuw.');
        }

        // Inlogpoging controleren
        if (Auth::attempt($formFields)) {
            // Start een sessie
            $request->session()->regenerate();

            // Reset rate limiting voor het e-mailadres
            RateLimiter::clear($request->email);

            return redirect()->route('home')->with('success', 'Je bent ingelogd.');
        }

        // Rate limiting verhogen bij mislukte inlogpoging
        RateLimiter::hit($request->email, $decayMinutes);

        // Foutmelding tonen als de gegevens niet kloppen
        return back()->with('error', 'Deze gegevens kloppen niet.');
    }

    // Uitloggen
    public function logout(Request $request){
        auth()->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home')->with('success', 'Je bent uitgelogd.');
    }

    // Registratie formulier tonen
    public function create(){
        return view('auth.register');
    }

    // Gebruiker opslaan
    public function store(Request $request, AddressController $addressController)
    {
        // Validatie
        $validatedData = $request->validate([
            'name' => 'required|not_regex:/[<>]/',
            'email' => 'required|email',
            'password' => 'required|confirmed',
        ]);

        // Gevalideerde data opslaan
        $user = new User;
        $user->name = $validatedData['name'];
        $user->email = $validatedData['email'];
        $user->password = bcrypt($validatedData['password']);
        $user->role = 'user'; 
        $user->save();
        // Adresgegevens klaarzetten in een array
        $addressData = [
            'street_name' => $request->input('street_name'),
            'house_number' => $request->input('house_number'),
            'postal_code' => $request->input('postal_code'),
            'city' => $request->input('city'),
            'user_id' => $user->id,
        ];
        // Array met adresgeevens doorsturen naar de AdresController om opgeslagen te worden
        $addressController->store($addressData);
        
        // Terug naar de vorige pagina
        return redirect()->back()->with('success', 'Bedankt voor het registreren.');
    }

}
