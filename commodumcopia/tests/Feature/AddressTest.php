<?php

/*
titel: Address Test
beschrijving: De testen die de processen met betrekking tot de adresgegevens controleren.
auteur: Pascal Thomasse Mol
versie: 2
aanmaakdatum: 07 aug 2023
laatste wijzigingsdatum: 28 aug 2023
*/


namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Address;
use App\Http\Controllers\AddressController;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class AddressTest extends TestCase
{
    use DatabaseTransactions;

    // Controleer of de bewerkingspagina voor het adres correct wordt geladen.
    public function test_edit_route_loads_properly()
    {
        // Schik: Maak een gebruiker aan
        $user = User::factory()->create();

        // Maak een voorbeeldadres dat aan de gebruiker is gekoppeld
        $address = Address::factory()->create([
            'user_id' => $user->id,
        ]);

        $address->save(); 

        // Actie: Simuleer een HTTP GET-verzoek naar de bewerkingsroute
        $response = $this->followingRedirects()->get(route('address.edit', ['id' => $address->id]));

        // Assert: Controleer of de reactie een statuscode van 200 heeft en de adresgegevens bevat
        $response->assertStatus(200);
        $response->assertSee($address->street_name);
        $response->assertSee($address->house_number);
    }

    // Test of een adres kan worden opgeslagen.
    public function test_address_can_be_stored()
    {
        // Maak een gebruiker aan
        $user = User::factory()->create();

        // Bereid de adresgegevens voor om op te slaan
        $addressData = [
            'street_name' => 'Voorbeeldstraat',
            'house_number' => '123',
            'postal_code' => '12345',
            'city' => 'Voorbeeldstad',
            'user_id' => $user->id,
        ];

        // Actie: Roep de store-methode rechtstreeks aan met de adresgegevens
        $this->app->make(AddressController::class)->store($addressData);

        // Assert: Controleer of het adres in de database is opgeslagen met de juiste gegevens
        $this->assertDatabaseHas('addresses', [
            'address' => 'Voorbeeldstraat 123',
            'postal_code' => '12345',
            'city' => 'Voorbeeldstad',
            'user_id' => $user->id,
        ]);

        // Verwijder het adres na de test
        Address::where('user_id', $user->id)->delete();
    }

    // Test of een bestaand adres kan worden bijgewerkt.
    public function test_existing_address_can_be_updated()
    {
        // Schik: Maak een gebruiker aan
        $user = User::factory()->create();

        // Maak een voorbeeldadres dat aan de gebruiker is gekoppeld
        $address = Address::factory()->create([
            'user_id' => $user->id,
        ]);

        $address->save();

        // Bereid de bijgewerkte adresgegevens voor
        $updatedAddressData = [
            'street_name' => 'Bijgewerkte Straat',
            'house_number' => '456',
            'postal_code' => '6784NH',
            'city' => 'Bijgewerkte Stad',
        ];

        // Actie: Simuleer een HTTP PUT-verzoek naar de update route met de bijgewerkte adresgegevens
        $response = $this->actingAs($user)->put(route('address.update', ['id' => $address->id]), $updatedAddressData);

        // Assert: Controleer of de reactie een doorverwijsstatuscode heeft (wat een succesvolle update aangeeft)
        $response->assertStatus(302);

        // Assert: Controleer of het adres in de database is bijgewerkt met de juiste gegevens
        $this->assertDatabaseHas('addresses', [
            'id' => $address->id,
            'address' => 'Bijgewerkte Straat 456',
            'postal_code' => '6784NH',
            'city' => 'Bijgewerkte Stad',
            'user_id' => $user->id,
        ]);
    }
}