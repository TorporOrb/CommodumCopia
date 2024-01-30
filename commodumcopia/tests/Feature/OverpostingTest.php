<?php

/*
titel: Overposting Test
beschrijving: De testen die de processen met betrekking tot het beveiligen tegen overposting controleren.
auteur: Pascal Thomasse Mol
versie: 2
aanmaakdatum: 22 aug 2023
laatste wijzigingsdatum: 28 aug 2023
*/

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Address;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class OverpostingTest extends TestCase
{
    use DatabaseTransactions;

    public function testOverpostingProtection()
    {
        // Maak een gebruiker en een adres aan
        $user = User::factory()->create();
        $address = Address::factory()->create(['user_id' => $user->id]);

        // Simuleer een ongeautoriseerde gebruiker die probeert user_id te wijzigen
        $aanvaller = User::factory()->create(); // Maak een aanvaller gebruiker aan
        $response = $this->actingAs($aanvaller)
            ->put(route('address.update', $address->id), [
                'user_id' => $user->id + 1, // Probeer user_id te wijzigen
                'street_name' => 'Bijgewerkte Straat',
                'house_number' => '123',
                'postal_code' => '12345',
                'city' => 'Bijgewerkte Stad',
            ]);

        $response->assertStatus(302); // Verwacht een doorverwijzing 
        $address->refresh();

        // Verifieer dat user_id niet is gewijzigd
        $this->assertNotEquals($user->id + 1, $address->user_id);
    }
}