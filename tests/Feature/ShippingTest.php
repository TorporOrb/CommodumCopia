<?php

/*
titel: Shipping Test
beschrijving: De testen die de processen met betrekking tot de verzendingsgegevens controleren.
auteur: Pascal Thomasse Mol
versie: 2
aanmaakdatum: 23 aug 2023
laatste wijzigingsdatum: 28 aug 2023
*/

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Address;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Session;

class ShippingTest extends TestCase
{
    use DatabaseTransactions;
    
    // Test het bekijken van de verzendingsweergave
    public function testShippingView()
    {
        // Maak een gebruiker en een bijbehorend adres aan
        $user = User::factory()->create();
        $address = Address::factory()->create(['user_id' => $user->id]);

        // Simuleer authenticatie als de gebruiker
        $this->actingAs($user);

        // Voer een GET-verzoek uit naar de verzendingsaanmaakroute
        $response = $this->get(route('shipping.create'));

        // Verifieer dat de reactiestatus 200 (OK) is
        $response->assertStatus(200);

        // Verifieer dat de adresgegevens van de gebruiker zichtbaar zijn in de weergave
        $response->assertSee($address->street);
        $response->assertSee($address->city);
    }

    // Test dat bezorgdatum en -tijd worden opgeslagen in de sessie
    public function testDeliveryDateAndTimeAreSavedToSession()
    {
        // Maak een gebruiker aan en voer authenticatie uit
        $user = User::factory()->create();
        $this->actingAs($user);

        // Doe een POST-verzoek naar de opslaanroute met bezorgdatum en -tijd
        $deliveryDate = '2023-08-25';
        $deliveryTime = '10:00 AM';
        $response = $this->post(route('shipping.store'), [
            'delivery_date' => $deliveryDate,
            'delivery_time' => $deliveryTime,
        ]);

        // Verifieer dat de reactie doorverwijst naar de orders.aanmaak route
        $response->assertRedirect(route('orders.create'));

        // Verifieer dat de bezorgdatum en -tijd zijn opgeslagen in de sessie
        $this->assertEquals($deliveryDate, Session::get('delivery_date'));
        $this->assertEquals($deliveryTime, Session::get('delivery_time'));
    }
}
