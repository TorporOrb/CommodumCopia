<?php

/*
titel: Register Link Test
beschrijving: De testen controleren of de registratielink in beeld is bij gasten. 
auteur: Pascal Thomasse Mol
versie: 2
aanmaakdatum: 07 aug 2023
laatste wijzigingsdatum: 22 aug 2023
*/

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RegisterLinkTest extends TestCase
{
    // Test of de registratielinks verschijnen wanneer niet ingelogd:
    public function test_if_register_links_appears_when_not_logged_in(): void
    {
        $response = $this->get('/home');
        $response->assertSee('Maak een account aan');
        $response->assertStatus(200);
    }

    // Test of de registratielinks niet verschijnen wanneer ingelogd:
    public function test_if_register_links_doesnt_appear_when_logged_in(): void
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)->get('/home'); 
        $response->assertDontSee('Maak een account aan');
        $response->assertStatus(200);
    }
}

