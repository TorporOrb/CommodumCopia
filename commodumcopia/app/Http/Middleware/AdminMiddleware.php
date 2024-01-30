<?php

/*
titel: AdminMiddleware
beschrijving: Middleware die checkt of de gebruiker admin rechten heeft
auteur: Pascal Thomasse Mol
versie: 1
aanmaakdatum: 26 jun 2023
laatste wijzigingsdatum: 4 jul 2023
*/

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

// Middleware die checkt of de gebruiker admin rechten heeft
class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check of de gebruiker een admin is
        if ($request->user() && $request->user()->isAdmin()) {
            // Geef toestemming de route te gebruiken als de gebruiker een admin is
            return $next($request);
        }
        // Geef een foutmelding als de gebruiker geen admin is
        abort(403, 'Unauthorized');
    }
}