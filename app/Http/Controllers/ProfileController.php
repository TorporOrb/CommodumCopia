<?php

/*
titel: ProfileController
beschrijving: De ProfileController regelt de profielpagina.
    De Index-methode: Laadt de orders en adresgegevens van de gebruiker.
    Omdat de controller altijd de informatie van de huidige gebruiker oproept, kan je niet op iemand anders zijn profielpagina komen.
auteur: Pascal Thomasse Mol
versie: 2
aanmaakdatum: 12 jul 2023
laatste wijzigingsdatum: 19 jul 2023
*/

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index()
    {
        $user = auth()->user(); // Haal de geauthenticeerde gebruiker op
        $address = $user->addresses()->first();
        
        // Controleer of de gebruiker bestaat en overeenkomt met de geauthenticeerde gebruiker
        if ($user) {
            return view('profile.index', compact('user', 'address'));
        } else {
            // Behandel ongeautoriseerde toegang
            abort(403);
        }
    }
}