<?php

/*
titel: Xss Test
beschrijving: De testen die de processen met betrekking tot de beveiliging tegen cross site scripting aanvallen.
auteur: Pascal Thomasse Mol
versie: 2
aanmaakdatum: 22 aug 2023
laatste wijzigingsdatum: 28 aug 2023
*/

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Product;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class XssTest extends TestCase
{
    use DatabaseTransactions;

    public function testXssProtection()
    {
        // Maak een product aan met een kwaadaardig
        $maliciousName = '<script>alert("XSS-aanval!");</script>';
        Product::factory()->create(['name' => $maliciousName]);

        // Voer een zoekopdracht uit met de kwaadaardige invoer
        $response = $this->get(route('search.index', ['keyword' => $maliciousName]));
        // Zorg ervoor dat het kwaadaardige script wordt geëscapet of gesaneerd
        $response->assertDontSee($maliciousName);
    }
}