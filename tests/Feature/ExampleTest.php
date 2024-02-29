<?php

/*
titel: Example Test
beschrijving: De testen kijken of de site reageert.
auteur: Pascal Thomasse Mol
versie: 2
aanmaakdatum: 18 jun 2023
laatste wijzigingsdatum: 22 aug 2023
*/

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    // Test of de hompage laadt. 
    public function test_the_application_returns_a_successful_response(): void
    {
        $response = $this->get('/home');

        $response->assertStatus(200);
    }
    // Test of de "/" doorverwijst. 
    public function test_the_application_returns_a_successful_redirect(): void
    {
        $response = $this->get('/');

        $response->assertStatus(302);
    }
}
