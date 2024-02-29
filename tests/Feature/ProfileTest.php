<?php

/*
titel: Product Test
beschrijving: De testen die de processen met betrekking tot de profielpagina controleren.
auteur: Pascal Thomasse Mol
versie: 2
aanmaakdatum: 24 aug 2023
laatste wijzigingsdatum: 28 aug 2023
*/

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Address;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ProfileTest extends TestCase
{
    use DatabaseTransactions;

    public function testProfileIndexWithAuthenticatedUser()
    {
        // Maak een gebruiker aan en een bijbehorend adres
        $user = User::factory()->create();
        $address = Address::factory()->create(['user_id' => $user->id]);

        // Simuleer een ingelogde gebruiker
        $this->actingAs($user);

        // Bezoek de profielpagina van de gebruiker
        $response = $this->get(route('profile.index'));

        // Voer verificaties uit om de weergegeven informatie te controleren
        $response->assertStatus(200);
        $response->assertViewHas('user', $user);
        $response->assertViewHas('address', $address);
        $response->assertSee($address->street); // Voorbeeld: controleer of adresgegevens zichtbaar zijn
    }

    public function testProfileIndexWithoutAuthenticatedUser()
    {
        // Bezoek de profielpagina zonder ingelogde gebruiker
        $response = $this->get(route('profile.index'));

        // Voer verificaties uit voor ongeautoriseerde toegang
        $response->assertStatus(302);
    }
}
