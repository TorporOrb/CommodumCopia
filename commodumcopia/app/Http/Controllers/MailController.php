<?php

/*
titel: MailController
beschrijving: De MailController is verantwoordelijk voor het verzenden van e-mails.
    De sendEmail methode haalt de welkomstmail op en verzendt deze naar het opgegeven adres.
auteur: Pascal Thomasse Mol
versie: 1
aanmaakdatum: 19 jun 2023
laatste wijzigingsdatum: 29 jun 2023
*/

namespace App\Http\Controllers;

use App\Mail\WelcomeMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;

// De controller om de welkomsmail te verzenden
class MailController extends Controller
{
    // Stuur de welkomsmail
    // Om privacy redenen is ervoor gekozen om geen mailadres in een mailinglist op te slaan maar alleen de welkomsmail te sturen
    public function sendEmail(Request $request)
    {
        // Validatie
        $validatedData = $request->validate([
            'email' => 'required|email',
        ]);

        $to = $validatedData['email'];
        // csrf beveiliging
        $data = [
            'token' => csrf_token(),
        ];

        // Verstuur de mail
        Mail::to($to)->send(new WelcomeMail($data));

        return Redirect::back()->with('success', 'Bedankt voor het aanmelden op de nieuwsbrief.');
    }
}